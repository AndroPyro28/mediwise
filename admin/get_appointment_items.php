<?php
// get_appointment_items.php
include '../connectMySQL.php';

// Include your database connection and necessary functions

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointmentId = $_POST['appointmentId'];
    $barangayId = $_POST['barangayId'];

    // Use this $appointmentId to fetch items related to the appointment from the database

    // Example query
    $query = "SELECT * FROM inventory  WHERE barangay_id = '$barangayId'";
    $result = $conn->query($query);

    $items = array();
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }

    echo json_encode($items);
}
?>