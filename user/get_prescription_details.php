<?php
// get_prescription_details.php
include '../connectMySQL.php';
include '../loginverification.php';
require '../vendor/autoload.php';
use thiagoalessio\TesseractOCR\TesseractOCR;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch prescription details based on the prescription ID passed from the front end
if (isset($_POST['prescription_id'])) {
    $prescriptionId = $_POST['prescription_id'];

    $sql = "SELECT * FROM prescription WHERE prescription_id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $prescriptionId);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $prescriptionDetails = $result->fetch_assoc();

        // Specify the path to the image file
        $imagePath = 'C:/xampp/htdocs/mediwise/public/uploads/' . basename($prescriptionDetails['image']);
        // Specify the path to the Tesseract executable
        $tesseract = new TesseractOCR($imagePath);
        $tesseract->executable('C:\Program Files\Tesseract-OCR\tesseract.exe'); // Adjust the path accordingly

        try {
            // Perform OCR on the image
            $text = $tesseract->run();

            // Check if the text was successfully extracted
            if (!empty($text)) {
                echo ' <p style="margin:10px; max-height: 250px; max-width:400px; overflow:auto;"> <strong>Image: </strong> <img src="' . $prescriptionDetails['image'] . '" alt="Prescription Image"> </p> ';
                echo '<p style="margin:10px; max-height: 100px; overflow:auto;"> <strong>Extracted text from image:</strong>  <pre style="font-size:13px; margin:10px;">' . $text . '</pre>  </p>';
            } else {
                echo '<p style="margin:10px; color: red;">Text extraction failed for the image.</p>';
            }
        } catch (Exception $e) {
            // Handle Tesseract OCR errors
            echo ' <p style="margin:10px; max-height: 250px; max-width:400px; overflow:auto;"> <strong>Image: </strong> <img src="' . $prescriptionDetails['image'] . '" alt="Prescription Image"> </p> ';

            echo '<p style="margin:10px; color: red;">Error extracting text</p>';
        }

        // Display createdAt information regardless of text extraction success/failure
        echo '<p style="margin:10px;"> <strong>Created At:</strong> ' . $prescriptionDetails['createdAt'] . '</p>';
    } else {
        echo '<p class="text-red-500">Prescription not found.</p>';
    }

    $stmt->close();
} else {
    echo '<p class="text-red-500">Prescription ID not provided.</p>';
}

$conn->close();
?>