<?php
include '../connectMySQL.php';  // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    // Get the appointment ID from the form
    $appointmentId = $_POST["appointment_id"];

    // Specify the target directory for uploads
    $targetDirectory = "../public/uploads/";
    // Generate a unique file name to avoid overwriting existing files
    $targetFileName = uniqid() . '_' . basename($_FILES["image"]["name"]);
    // Full path to the uploaded file
    $targetFilePath = $targetDirectory . $targetFileName;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
        // Update the database with the file path
        $updateQuery = "UPDATE appointment SET image_path = '$targetFilePath' WHERE appointment_id = $appointmentId";
        $conn->query($updateQuery);

        // Redirect back to the appointments page or perform any other action
        header("Location: appointment.php");
        exit();
    } else {
        echo "Error uploading file.";
    }
}
?>