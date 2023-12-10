<?php 
include '../connectMySQL.php';
include '../loginverification.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $targetDir = "../public/uploads/";
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an image
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo '<p class="text-red-500">File is not an image.</p>';
        $uploadOk = 0;
    }

    // ... (same validation as before)

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo '<p class="text-red-500">Sorry, your file was not uploaded.</p>';
    } else {
        // Get patient ID from the request
        $patient_id = $_POST['patient_id']; // Assuming it's passed in the request

        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            // Insert the file information into the database
            $fileName = basename($_FILES["file"]["name"]);
            $imagePath = $targetDir . $fileName;
            // Modify the SQL query to include patient_id
            $sql = "INSERT INTO prescription (image, patient_id) VALUES ('$imagePath', '$patient_id')";
            
            if ($conn->query($sql) === TRUE) {
                // echo '<p class="text-green-500">The file ' . htmlspecialchars($fileName) . ' has been uploaded.</p>';
                header("location:./upload-prescription.php");
            } else {
                echo '<p class="text-red-500">Error: ' . $sql . '<br>' . $conn->error . '</p>';
            }
        } else {
            echo '<p class="text-red-500">Sorry, there was an error uploading your file.</p>';
        }
    }
}
?>