<?php
include '../connectMySQL.php';
include '../loginverification.php';
if (logged_in()) {
    $session_user_id = $_SESSION['user_id'];
} else {
    header('location:../index.php');
}

// Database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch appointments
$query = "SELECT a.* , a.image_path,  CONCAT(p.first_name,' ',  p.last_name) AS patient_name, CONCAT(d.first_name, ' ', d.last_name) AS doc_name
          FROM appointment a
          LEFT JOIN doctor d ON d.doctor_id = a.doctor_id
          LEFT JOIN patient p ON p.patient_id = a.patient_id
          WHERE a.request_status = 'ACCEPTED'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments List</title>
    <!-- Include Tailwind CSS file -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto my-8">
        <h2 class="text-2xl font-semibold mb-4">Appointments List</h2>

        <table id="appointmentsTable" class="w-full  shadow-md rounded my-6">
            <thead>
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Description</th>
                    <th class="border px-4 py-2">Doctor's Name</th>
                    <th class="border px-4 py-2">patients's Name</th>
                    <th class="border px-4 py-2">Date</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td class="border px-4 py-2">
                            <?= $row['appointment_id']; ?>
                        </td>
                        <td class="border px-4 py-2">
                            <?= $row['description']; ?>
                        </td>
                        <td class="border px-4 py-2">
                            <?= $row['doc_name']; ?>
                        </td>
                        <td class="border px-4 py-2">
                            <?= $row['patient_name']; ?>
                        </td>
                        <td class="border px-4 py-2">
                            <?= date('Y-m-d H:i:s', strtotime($row['date'])); ?>
                        </td>
                        <td class="border px-4 py-2">
                            <?= $row['request_status']; ?>
                        </td>
                        <td class="border px-4 py-2">
                            <?php if ($row['request_status'] === 'ACCEPTED'): ?>
                                <button class="bg-blue-500 text-white px-4 py-2 rounded view-details-btn"
                                    data-appointment-id="<?= $row['appointment_id']; ?>">View Details</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>


    <!-- Modal -->

    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center" style="display:none;">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <!-- Modal container for two sides -->
        <div class="modal-container flex w-11/12 md:max-w-3xl mx-auto rounded shadow-lg z-50 overflow-y-auto relative bg-white">

            <!-- Left side content (Appointment Details) -->
            <div class="w-1/2 py-4 px-6">
                <div
                    class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                    <span class="modal-close-button text-black">X</span>
                </div>
                <h2 class="text-2xl font-semibold mb-4">Appointment Details</h2>
                <p><strong>ID:</strong> <span id="modalAppointmentId"></span></p>
                <p><strong>Description:</strong> <span id="modalDescription"></span></p>
                <p><strong>Doctor's Name:</strong> <span id="modalDocName"></span></p>
                <p><strong>Patient's Name:</strong> <span id="modalPatientName"></span></p>
                <p><strong>Date:</strong> <span id="modalDate"></span></p>
                <p><strong>Status:</strong> <span id="modalStatus"></span></p>

                <!-- Display uploaded image -->
                <div id="modalImageContainer">
                    <!-- ... (existing image display code) ... -->
                </div>

                <!-- Image upload form -->
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <label for="image">Upload Prescription below:</label>
                    <input type="file" name="image" id="image" accept="image/*">
                    <input type="hidden" name="appointment_id" id="appointmentIdInput">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Upload</button>
                </form>
            </div>

            <!-- Right side content (List of Items) -->
            <div class="overflow-hidden py-4 px-6" id="modalItemListContainer">
                <h2 class="text-2xl font-semibold mb-4">List of Items</h2>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                ID</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Name</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Quantity</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody id="modalItemList"></tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            // Initialize DataTable
            $('#appointmentsTable').DataTable();

            // Event delegation for dynamically added elements
            $(document).on('click', '.view-details-btn', function () {
                var appointmentId = $(this).data('appointment-id');

                // Make an AJAX request to fetch appointment details and items
                $.ajax({
                    url: 'get_appointment_details.php', // Create this PHP file to handle the AJAX request
                    method: 'POST',
                    data: { appointmentId: appointmentId },
                    success: function (response) {
                        var data = JSON.parse(response);
                        console.log(data)
                        // Set modal content (left side)
                        $('#modalAppointmentId').text(data.appointmentId);
                        $('#modalDescription').text(data.description);
                        $('#modalDocName').text(data.docName);
                        $('#modalDate').text(data.date);
                        $('#modalStatus').text(data.status);
                        $('#modalPatientName').text(data.patientName);

                        // Display the image or a message
                        var imageContainer = $('#modalImageContainer');
                        if (data.imagePath !== null && data.imagePath !== '') {
                            imageContainer.html('<img src="' + data.imagePath + '" alt="Prescription Image" class="max-w-full h-auto mb-4">');
                        } else {
                            imageContainer.html('<p>No image available</p>');
                        }

                        // Set the appointment ID in the upload form
                        $('#appointmentIdInput').val(data.appointmentId);

                        // Set modal items content (right side)
                        displayModalItems(data.appointmentId);

                        // Display the modal
                        $('.modal').css('display', 'flex');
                    },
                    error: function (error) {
                        console.error('Error fetching appointment details:', error);
                    }
                });
            });

            // Modal close button click event
            $('.modal-close-button').on('click', function () {
                closeModal();
            });
        });

        function closeModal() {
            $('.modal').css('display', 'none');
        }

        function displayModalItems(appointmentId) {
        // Make an AJAX request to fetch items for the given appointmentId
        $.ajax({
            url: 'get_appointment_items.php', // Create this PHP file to handle the AJAX request
            method: 'POST',
            data: { appointmentId: appointmentId },
            success: function (response) {
                var items = JSON.parse(response);

                // Display items in the modal table
                var itemList = $('#modalItemList');

                itemList.empty(); // Clear previous items
                if (items.length > 0) {
                    items.forEach(function (item) {
                        itemList.append('<tr>' +
                            '<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">' + item.inventory_id + '</td>' +
                            '<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">' + item.name + '</td>' +
                            '<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">' + item.quantity + '</td>' +
                            '<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 flex gap-x-3">' +
                            '<button class="bg-red-500 text-white px-2 py-1 rounded" onclick="decrementQuantity(' + item.inventory_id + ')">-</button>' +
                            '<button class="bg-blue-500 text-white px-2 py-1 rounded mr-2" onclick="incrementQuantity(' + item.inventory_id + ')">+</button>' +
                            '</td>' +
                            '</tr>');
                    });
                } else {
                    itemList.html('<tr><td colspan="4">No items available</td></tr>');
                }
            },
            error: function (error) {
                console.error('Error fetching appointment items:', error);
            }
        });
    }

    // Increment quantity function
    function incrementQuantity(itemId) {
        // Add logic to increment quantity in the database or perform other actions
        console.log('Increment quantity for item with ID:', itemId);
    }

    // Decrement quantity function
    function decrementQuantity(itemId) {
        // Add logic to decrement quantity in the database or perform other actions
        console.log('Decrement quantity for item with ID:', itemId);
    }
    </script>

</body>

</html>