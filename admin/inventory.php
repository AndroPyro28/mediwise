<?php
include '../connectMySQL.php';
include '../loginverification.php';
//Retrieve data from the inventory table
if (logged_in()) {
    $session_user_id = $_SESSION['user_id'];
    //  $barangay_id = isset($_SESSION['barangay_id']) ? $_SESSION['barangay_id'] : null;

    // query the admin get his barangay_id
    $barangay_query = "SELECT barangay_id FROM admin WHERE admin_id = $session_user_id";

    $barangay_result = $conn->query($barangay_query);

    if ($barangay_result->num_rows > 0) {
        $barangay_row = $barangay_result->fetch_assoc();
        $barangay_id = $barangay_row['barangay_id'];

        $request_query = "SELECT * FROM requests WHERE barangay_id = ? AND (request_status = 'PENDING' OR request_status = 'ONGOING')";
        $request_stmt = $conn->prepare($request_query);
        $request_stmt->bind_param("i", $barangay_id);
        $request_stmt->execute();
        $request_result = $request_stmt->get_result();
        $request_row = $request_result->fetch_assoc();
        $request_id = $request_row ? $request_row['id'] : null;
        $request_status = $request_row ? $request_row['request_status'] : null;
        // want to extract the request id here
        $request_exists = $request_result->num_rows > 0;



        // Now you have $barangay_id, which is the admin's barangay_id
    } else {
        // Handle the case where no data is returned (optional)
        $barangay_id = null;
        // You might want to set a default value or display an error message
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <title>Inventory Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            padding: 10px;
            margin-top: 10px;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }
    </style>

<style>
    /* Add this style for the badge */
    .badge {
        display: inline-block;
        padding: 0.25em 0.5em;
        font-size: 0.8em;
        font-weight: bold;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
    }

    /* Style for the badge based on different request statuses */
    .badge.pending {
        background-color: #ffc107; /* Yellow */
    }

    .badge.ongoing {
        background-color: #007bff; /* Blue */
    }

    .badge.completed {
        background-color: #28a745; /* Green */
    }
</style>
</head>

<body>

    <h2>Inventory Management</h2>

    <div style="flex; justify-content:space-between;" class="flex w-full justify-between">
        <div style="flex">
            <label for="search">Search by Item Name:</label>
            <input type="text" id="search" class="bg-gray-200" oninput="sortTableByName()">
        </div>
        <div>
            <button onclick="openModal()" class="bg-green-500 text-white rounded-md">Add Item</button>
            <?php if ($request_exists && $request_status === "PENDING"): ?>
                <button onclick="cancelRequest()" data-request-id="<?php echo $request_id; ?>"
                    class="bg-red-500 text-white rounded-md">Cancel Request</button>
                <!-- i dont have a view request modal create it for me -->
            <?php elseif ($request_exists && $request_status === "ONGOING"): ?>
                <button onclick="openRequestDetailsModal(<?php echo $request_id; ?>)"
                    class="bg-blue-500 text-white rounded-md">View Request</button>
            <?php else: ?>
                <!-- Make Request Button -->
                <button onclick="openRequestModal()" class="bg-green-500 text-white rounded-md">Make Request</button>
            <?php endif; ?>
        </div>
    </div>
   
<!-- request detail modals -->
<div id="requestDetailsModal" class="modal">
    <div class="modal-content bg-white w-96 mx-auto mt-10 rounded shadow-lg p-4">
        <span onclick="closeRequestDetailsModal()" class="float-right cursor-pointer">&times;</span>
        <h3 class="text-lg font-semibold mb-4">Request Details</h3>
        <div id="requestDetailsContent" class="flex flex-col">
            <strong>Request ID:</strong> <span id="requestId"></span><br>
            
            <!-- Request Status Badge -->
            <strong>Request Status:</strong> 
            <span id="requestStatus" class="badge" style="width:fit-content;"></span><br>

            <strong>Request details:</strong> 
            <p id="requestDetails"></p><br>
            
            <strong>Requested Items:</strong>
            <ul id="requestedItems"></ul>

            <!-- Mark as Completed Button -->
            <button onclick="markRequestCompleted()" class="bg-blue-500 text-white rounded-md mt-4">
                Mark as Completed
            </button>
        </div>
    </div>
</div>




    <!-- Item Modal -->
    <div id="itemModal" class="modal">
        <div class="modal-content bg-white w-96 mx-auto mt-10 rounded shadow-lg p-4">
            <span onclick="closeModal()" class="float-right cursor-pointer">&times;</span>
            <h3 class="text-lg font-semibold mb-4">Create Item</h3>
            <div class="flex flex-col">
                <label for="item_name" class="mb-2">Item Name:</label>
                <input type="text" name="item_name" class="item_name" class="border p-2 mb-4 rounded" required>

                <label for="quantity" class="mb-2">Quantity:</label>
                <input type="number" name="quantity" class="quantity" class="border p-2 mb-4 rounded" required>

                <input type="hidden" name="barangay" class="barangay" value="<?php echo $barangay_id ?>">
                    
                <button type="submit" class="bg-green-500 text-white rounded-md py-2 px-4 hover:bg-green-600 addItemBtn" id="addItemBtn">Add Item</button>
            </div>
        </div>
    </div>

    <!-- Request Modal -->
    <div id="requestModal" class="modal">
        <div class="modal-content bg-white w-96 mx-auto mt-10 rounded shadow-lg p-4">
            <span onclick="closeRequestModal()" class="float-right cursor-pointer">&times;</span>
            <h3 class="text-lg font-semibold mb-4">Make Request</h3>
            <div class="flex flex-col">
                <label for="requestDetails" class="mb-2">Request Details:</label>
                <textarea id="requestDetails" class="requestDetails" name="requestDetails" rows="4" class="border p-2 mb-4 rounded"
                    required></textarea>
                <button type="button" onclick="submitRequest()"
                    class="bg-green-500 text-white rounded-md py-2 px-4 hover:bg-green-600">Submit Request</button>
            </div>
        </div>
    </div>

    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span onclick="closeUpdateModal()" style="float: right; cursor: pointer;">&times;</span>
            <h3>Update Quantity</h3>
            <div>
                <input type="hidden" id="inventory_id" name="inventory_id" class="inventory_id">
                <label for="quantityToDecrease">Decrease by:</label>
                <input type="number" id="quantityToDecrease" class="quantityToDecrease" name="quantityToDecrease"
                    required>
                <br>
                <button type="submit" class="updateQuantityBtn">Update Quantity</button>
            </div>
        </div>
    </div>
    <!-- Display Inventory Table -->
    <table id="inventoryTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Barangay</th>
            </tr>
        </thead>
        <tbody>
            <?php

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            // Retrieve items from the database
            $sql = "SELECT i.*, b.name as barangay_name FROM inventory i INNER JOIN barangay b ON i.barangay_id = b.barangay_id WHERE i.barangay_id = ? AND i.isArchive = 'false'";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $barangay_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["inventory_id"] . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["quantity"] . "</td>
                        <td>" . $row["barangay_name"] . "</td>
                        <td > <button class='bg-green-500 text-white rounded-md' onclick='openUpdateModal(" . $row["inventory_id"] . ", " . $row["quantity"] . ")'>Update</button> </td>
                      </tr>";
                }
            } else {
                echo "<tr><td colspan='3' >No items found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <script>
        function openModal() {
            document.getElementById("itemModal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("itemModal").style.display = "none";
        }
    </script>

    <script>
  async function openRequestDetailsModal(requestId) {
    // Use Fetch API to send a request to get_request_details.php with the request ID
    const result = await fetch('get_request_details.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'request_id=' + requestId,
    });

    const response = await result.json();
    const { requestDetails, inventoryItems } = response;
    requestDetails
    // Populate the request details in the modal
    document.getElementById('requestId').innerText = requestDetails.id;
    document.getElementById('requestDetails').innerText = requestDetails.content;
    document.getElementById('requestStatus').innerText = requestDetails.request_status;
    document.getElementById('requestStatus').classList.add(requestDetails.request_status.toLowerCase());

    const requestedItemsList = document.getElementById('requestedItems');
    requestedItemsList.innerHTML = '';

    inventoryItems.forEach(item => {
        const li = document.createElement('li');
        li.innerText = `${item.item_name} - ${item.quantity} qty`;
        requestedItemsList.appendChild(li);
    });

    // Show the modal
    document.getElementById('requestDetailsModal').style.display = 'flex';
}
        function closeRequestDetailsModal() {
            document.getElementById('requestDetailsModal').style.display = 'none';
        }
    </script>
    <script>
        async function markRequestCompleted() {
    const requestId = document.getElementById('requestId').innerText;

    // Use Fetch API to send a request to mark_completed.php with the request ID
    const result = await fetch('mark_completed.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'request_id=' + requestId,
    });

    const data = await result.json();

    if (result.status === 200 && data.status === 'success') {
        // Handle success (e.g., show a success message, update UI)
        alert('Request marked as completed successfully');
        window.location.reload(); // You might want to update the UI dynamically instead of reloading the page
    } else {
        // Handle errors
        alert('Failed to mark request as completed');
    }

    // Close the modal after marking as completed
    closeRequestDetailsModal();
}
    </script>

    <script>
        function openRequestModal() {
            document.getElementById("requestModal").style.display = "flex";
        }

        function closeRequestModal() {
            document.getElementById("requestModal").style.display = "none";
        }

        async function submitRequest() {
            const requestDetails = document.querySelector('.requestDetails').value;
            console.log(requestDetails)
            if (!requestDetails) {
                return alert("Request details must be filled");
            }

            const result = await fetch("submit_request.php", {
                method: "POST",
                headers: { "Content-type": "application/x-www-form-urlencoded" },
                body: `requestDetails=${encodeURIComponent(requestDetails)}`
            });

            const data = await result.json();

            if (result.status === 200 && data.status === 'success') {
                // Handle success (e.g., show a success message, refresh the page)
                alert("Request submitted successfully");
                window.location.reload();
            } else {
                // Handle errors
                alert("Failed to submit request");
            }

            // Close the modal after submission
            closeRequestModal();
        }

        function cancelRequest() {
            // Assuming you have the request ID stored in a variable
            const requestId = document.querySelector('[data-request-id]').dataset.requestId;
            // Use Fetch API to send a request to cancel_request.php with the request ID
            fetch('cancel_request.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'request_id=' + requestId,
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Handle the response, e.g., show a success message or reload the page
                    if (data.status === 'success') {
                        alert("Request canceled successfully");
                        window.location.reload();
                    } else {
                        alert("Failed to cancel request");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while canceling the request');
                });
        }

    </script>


    <script>
        const addItemBtn = document.querySelector('#addItemBtn');

        const nameNode = document.querySelector('.item_name');
        const quantityNode = document.querySelector('.quantity');
        const barangayNode = document.querySelector('.barangay');


        addItemBtn.addEventListener('click', async () => {
            const name = nameNode.value
            const quantity = quantityNode.value
            const barangay = barangayNode.value
            
            if (!name || !quantity) {
                return alert("name or quantity must be filled")
            }
            const result = await fetch("http://localhost:3001/inventory", {
                // sending data to the server
                method: "POST",
                headers: { "Content-type": "application/json" },
                body: JSON.stringify({ name, quantity, barangay })
            });

            const data = await result.json();

            if (result.status === 201) {
                window.location.reload()
            }
        })
    </script>

    <script>
        const updateQuantityBtn = document.querySelector('.updateQuantityBtn');

        updateQuantityBtn.addEventListener('click', async () => {
            const inventory_id = document.querySelector('.inventory_id').value;
            const quantityToDecrease = document.querySelector('.quantityToDecrease');
            const quantity = quantityToDecrease.value

            if (!quantity) {
                return alert("quantity must be filled")
            }
            const result = await fetch(`http://localhost:3001/inventory/${inventory_id}`, {
                // sending data to the server
                method: "PATCH",
                headers: { "Content-type": "application/json" },
                body: JSON.stringify({ quantity })
            });

            const data = await result.json();

            if (result.status === 201) {
                window.location.reload()
            }
        })
    </script>


    <script>
        function openUpdateModal(itemId) {
            document.getElementById("inventory_id").value = itemId;
            document.getElementById("updateModal").style.display = "flex";
        }

        function closeUpdateModal() {
            document.getElementById("updateModal").style.display = "none";
        }
    </script>

    <script>
        function sortTableByName() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("inventoryTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Column index 1 is for item_name
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>


</body>

</html>