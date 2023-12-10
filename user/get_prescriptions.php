<?php
include '../connectMySQL.php';
include '../loginverification.php';

// Create a database connection

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate and sanitize input
$patient_id = isset($_POST['patient_id']) ? intval($_POST['patient_id']) : 0;

// Prepare and execute the SQL statement
$sql = "SELECT prescription_id as id, image as imagePath, createdAt FROM prescription WHERE patient_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    // Handle the error in preparing the statement
    $response = ['error' => 'Error preparing the SQL statement'];
} else {
    $stmt->bind_param('i', $patient_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        // Handle the error in executing the query
        $response = ['error' => 'Error executing the query'];
    } else {
        // Initialize an array to store prescription data
        $prescriptions = [];

        // Fetch all rows
        while ($row = $result->fetch_assoc()) {
            $prescriptions[] = $row;
        }

        // Return the data as JSON
        $response = $prescriptions;
    }
}

// Close the database connection
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>