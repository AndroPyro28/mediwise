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

        // OCR.space API key
        $apiKey = '2227cfc83888957';

        // OCR.space API endpoint URL
        $apiUrl = 'https://api.ocr.space/parse/image';

        // Check if the image file exists
        if (!file_exists($imagePath)) {
            die('Error: Image file not found.');
        }

        // Prepare the image data for sending
        $imageData = base64_encode(file_get_contents($imagePath));

        // Prepare the POST data
        $postData = [
            'apikey' => $apiKey,
            'language' => 'eng', // Set the language code (e.g., 'eng' for English)
            'base64Image' => 'data:image/jpeg;base64,' . $imageData,
            'OCREngine' => 2, // Set OCR Engine to 2
        ];

        // Initialize cURL session
        $ch = curl_init($apiUrl);

        // Set cURL options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL session and get the response
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            die('Error: cURL request failed - ' . curl_error($ch));
        }

        // Close cURL session
        curl_close($ch);

        // Decode the JSON response
        $result = json_decode($response, true);

        // Check if the API request was successful
        if ($result['OCRExitCode'] == 1) {
            // Display the extracted text
            $text = $result['ParsedResults'][0]['ParsedText'];
        } else {
            // Display an error message
            $text = 'OCR Error: ' . (is_array($result['ErrorMessage']) ? implode(', ', $result['ErrorMessage']) : $result['ErrorMessage']);
        }

        // Display the image and extracted text
        echo '<p style="margin:10px; max-height: 250px; max-width:400px; overflow:auto;">';
        echo '<strong>Image: </strong><img src="' . $prescriptionDetails['image'] . '" alt="Prescription Image">';
        echo '</p>';
        echo '<p style="margin:10px; max-height: 100px; overflow:auto;">';
        echo '<strong>Extracted text from image:</strong> <pre style="font-size:13px; margin:10px; max-height: 250px; max-width:400px; overflow:auto; border:solid 1px gray; padding:5px;">' . $text . '</pre>';
        echo '</p>';
        echo '<p style="margin:10px;">';
        echo '<strong>Created At:</strong> ' . date('Y-m-d g:i A', strtotime($prescriptionDetails['createdAt'])) . '</p>';
    } else {
        echo '<p class="text-red-500">Prescription not found.</p>';
    }

    $stmt->close();
} else {
    echo '<p class="text-red-500">Prescription ID not provided.</p>';
}

$conn->close();
?>
