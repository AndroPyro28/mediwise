<?php
include '../connectMySQL.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointmentId = $_POST['appointmentId'];
    $barangayId = $_POST['barangayId'];
    $appointmentItems = $_POST['appointmentItems'];

    try {
        // Start a transaction
        $conn->begin_transaction();

        foreach ($appointmentItems as $itemId => $item) {
            $quantity = $item['quantity'];

            // Update inventory quantity (deduct)
            $updateInventorySql = "UPDATE inventory SET quantity = quantity - $quantity WHERE inventory_id = $itemId";

            if ($conn->query($updateInventorySql) !== TRUE) {
                throw new Exception("Error updating inventory: " . $conn->error);
            }

            // Insert into appointment_item
            $insertAppointmentItemSql = "INSERT INTO appointment_item (appointment_id, inventory_id, quantity) VALUES ('$appointmentId', '$itemId', '$quantity')";

            if ($conn->query($insertAppointmentItemSql) !== TRUE) {
                throw new Exception("Error inserting into appointment_item: " . $conn->error);
            }
        }

        // Commit the transaction if all queries are successful
        $conn->commit();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        // An error occurred, rollback the changes
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    } finally {
        // Close the connection
        $conn->close();
    }
}
?>