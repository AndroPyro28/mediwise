<?php
include '../connectMySQL.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemId = $_POST['itemId'];

    // Perform the database update to increment quantity
    $query = "UPDATE items SET quantity = quantity + 1 WHERE item_id = $itemId";
    if ($conn->query($query) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }

    $conn->close();
}
?>