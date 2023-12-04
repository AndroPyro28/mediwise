<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
</head>

<body>

    <h2>Inventory Management</h2>

    <div style="flex; justify-content:space-between;">
        <div style="flex">
            <label for="search">Search by Item Name:</label>
            <input type="text" id="search" oninput="sortTableByName()">
        </div>
        <button onclick="openModal()">Add Item</button>
    </div>





    <!-- Item Modal -->
    <div id="itemModal" class="modal">
        <div class="modal-content">
            <span onclick="closeModal()" style="float: right; cursor: pointer;">&times;</span>
            <h3>Create Item</h3>
            <div style="display:flex;flex-direction:column;">
                <label for="item_name">Item Name:</label>
                <input type="text" name="item_name" class="name" required>
                <br>
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" class="quantity" required>
                <br>
                <button type="submit" class="addItemBtn">Add Item</button>
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
            include '../connectMySQL.php';
            include '../loginverification.php';
            //Retrieve data from the inventory table
            
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve items from the database
            $sql = "
            SELECT i.*, b.name as barangay_name FROM inventory i INNER JOIN barangay b ON i.barangay_id = b.barangay_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["inventory_id"] . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["quantity"] . "</td>
                        <td>" . $row["barangay_name"] . "</td>
                        <td > <button onclick='openUpdateModal(" . $row["inventory_id"] . ", " . $row["quantity"] . ")'>Update</button> </td>
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
        const addItemBtn = document.querySelector('.addItemBtn');

        const nameNode = document.querySelector('.name');
        const quantityNode = document.querySelector('.quantity');

        addItemBtn.addEventListener('click', async () => {
            const name = nameNode.value
            const quantity = quantityNode.value

            if (!name || !quantity) {
                return alert("name or quantity must be filled")
            }
            const result = await fetch("http://localhost:3001/inventory", {
                // sending data to the server
                method: "POST",
                headers: { "Content-type": "application/json" },
                body: JSON.stringify({ name, quantity })
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