<?php
include '../connectMySQL.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['appointmentId'])) {
    $appointmentId = $_POST['appointmentId'];

    // Fetch appointment details
    $query = "SELECT a.*, a.image_path, b.name as barangay_name, b.barangay_id as barangay_id, CONCAT(d.first_name, ' ', d.last_name) AS docName , CONCAT(p.first_name,' ',  p.last_name) AS patient_name
              FROM appointment a
              LEFT JOIN patient p ON p.patient_id = a.patient_id
              INNER JOIN barangay b ON p.barangay_id = b.barangay_id
              LEFT JOIN doctor d ON d.doctor_id = a.doctor_id
              WHERE a.appointment_id = '$appointmentId'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Return the data as JSON
        echo json_encode([
            'appointmentId' => $row['appointment_id'],
            'description' => $row['description'],
            'docName' => $row['docName'],
            'barangayName' => $row['barangay_name'],
            'barangayId' => $row['barangay_id'],
            'patientName' => $row['patient_name'],
            'date' => $row['date'],
            'status' => $row['request_status'],
            'imagePath' => $row['image_path'],
        ]);
    } else {
        echo json_encode(['error' => 'Appointment details not found.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request.']);
}
?>