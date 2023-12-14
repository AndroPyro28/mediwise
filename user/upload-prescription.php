<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload with PHP and Tailwind CSS</title>
    <!-- Include Tailwind CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-gray-100 p-8">

    <div class="max-w-xl mx-auto bg-white p-6 rounded-md shadow-md">
    <a href="home.php" style=" margin: 5px; text-decoration:none; "> <i class="fa-solid fa-circle-chevron-left fa-2x" ></i></a>

        <h2 class="text-2xl font-bold mb-4">Prescription upload</h2>

        <form id="imageUploadForm" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="file" class="block text-sm font-medium text-gray-600">Choose an image</label>
                <input type="file" name="file" id="file" accept="image/*" class="mt-1 p-2 border rounded-md w-full">
            </div>

            <button type="button" onclick="uploadImage()" class="bg-blue-500 text-white py-2 px-4 rounded-md">Upload</button>
        </form>

        <!-- Display the list of uploaded images -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Uploaded Prescriptions</h2>
            <div class="grid grid-cols-3 gap-4">
                <!-- Prescription data will be displayed here -->
            </div>
        </div>

        <!-- Container for displaying prescription data in a table -->
        <div id="prescriptionsContainer" class="mt-8">
            <table class="w-full table-fixed flex  flex-col items-center w-full">
                <thead class="flex items-center w-full">
                    <tr class="flex items-center w-full">
                        <th class="flex-1">ID</th>
                        <th class="flex-1">Image Path</th>
                        <th class="flex-1">Created At</th>
                        <th class="flex-1">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Prescription data rows will be added dynamically here -->
                </tbody>
            </table>
        </div>

        <!-- Add this HTML code after the prescription table -->
<div id="prescriptionModal" class="hidden fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-75 flex items-center justify-center">
    <div class="bg-white p-6 rounded-md shadow-md">
        <!-- Modal content goes here -->
        <h2 class="text-2xl font-bold mb-4">Prescription Details</h2>
        <div id="modalContent" ></div>
        <button onclick="closeModal()" class="bg-gray-500 text-white py-2 px-4 rounded-md mt-4">Close</button>
    </div>
</div>

<!-- Add this button inside each prescription row in the table -->


    </div>

    <script>

function openModal(prescriptionId) {
    // Make an AJAX request to fetch prescription details by ID
    $.ajax({
        url: 'get_prescription_details.php',
        method: 'POST',
        data: { prescription_id: prescriptionId },
        success: function (response) {
            // Display prescription details in the modal
            $('#modalContent').html(response);
            $('#prescriptionModal').removeClass('hidden');
        },
        error: function (error) {
            console.error('Error fetching prescription details:', error);
            // Display an error message
            $('#modalContent').html('<p class="text-red-500">Error fetching prescription details.</p>');
            $('#prescriptionModal').removeClass('hidden');
        }
    });
}

function closeModal() {
    // Close the modal
    $('#prescriptionModal').addClass('hidden');
    // Clear modal content
    $('#modalContent').html('');
}

    </script>

    <script>

        function decodeJwtToken(token) {
            try {
                var base64Url = token.split('.')[1];
                var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
                var jsonPayload = decodeURIComponent(atob(base64).split('').map(function (c) {
                    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                }).join(''));

                var decodedPayload = JSON.parse(jsonPayload);

                // Access specific claims from the payload
                var userId = decodedPayload.id;  // Example: Assuming 'sub' is the user ID claim
                return userId

                // You can use the decoded information here for display or other purposes
            } catch (e) {
                console.error('Error decoding JWT token:', e.message);
            }
        }

        function uploadImage() {
            const token = localStorage.getItem('token');
            const userId = decodeJwtToken(token);

            if (userId) {
                const form = document.getElementById('imageUploadForm');
                const formData = new FormData(form);

                // Append token to the FormData
                formData.append('patient_id', userId);

                // Make an AJAX request to upload the image
                $.ajax({
                    url: './upload.php',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        window.location.reload()
                    },
                    error: function (error) {
                        alert('Prescription Error')
                        console.error('Error uploading image:', error);
                        // Handle the error as needed
                    }
                });
            }
        }

        const dateAndTimeParser = (dateTimeLocal) => {
        const date = new Date(dateTimeLocal)?.toISOString().slice(0, 10);

        const time = new Date(dateTimeLocal)?.toLocaleString("en-US", {
            timeZone: "Asia/Manila",
            hour: "numeric",
            minute: "numeric",
            hour12: true,
        });

        return {
            date,
            time,
        };
}

        // Call the function with the JWT token
        $(document).ready(function () {
            const token = localStorage.getItem('token');
            const userId = decodeJwtToken(token)

            // Make an AJAX request to fetch prescription details when the page loads
            $.ajax({
                url: 'get_prescriptions.php',
                method: 'POST',
                data: { patient_id: userId },
                success: function (response) {
                    console.log(response)
                    // Check if the response is an array and not empty
                    if (Array.isArray(response) && response.length > 0) {
                        // Display the data in the table
                        $('#prescriptionsContainer tbody').empty();
                        $.each(response, function (index, prescription) {
                            const {date, time} = dateAndTimeParser(prescription.createdAt)
                            $('#prescriptionsContainer tbody').append(`
                                <tr class="flex items-center w-full my-10">
                                    <td class="flex-1 text-center">  ${prescription.id}</td>
                                    <td class="flex-1 text-center"> <img src="${prescription.imagePath}"/> </td>
                                    <td class="flex-1 text-center">${date} <br/> ${time} </td>
                                    <td class="flex-1 text-center">
                                    <button onclick="openModal('${prescription.id}')" style="text-decoration:underline; color:blue;">View Details</button>
                                </td>
                                </tr>
                            `);
                        });
                    } else {
                        // Display a message when no prescription data is found
                        $('#prescriptionsContainer tbody').html('<tr><td colspan="3" class="text-gray-500 text-center">No prescription data found.</td></tr>');
                    }
                },
                error: function (error) {
                    console.error('Error fetching prescription details:', error);
                    // Display an error message
                    $('#prescriptionsContainer tbody').html('<tr><td colspan="3" class="text-red-500 text-center">Error fetching prescription details.</td></tr>');
                }
            });
        });
    </script>
</body>

</html>
