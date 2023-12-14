
<?php
// OCR.space API key
$apiKey = '2227cfc83888957';


// Path to the image file you want to perform OCR on
$imagePath = 'C:/xampp/htdocs/mediwise/public/uploads/prescription2.png';


// OCR.space API endpoint URL
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
    echo 'Extracted Text: ' . $result['ParsedResults'][0]['ParsedText'];
} else {
    // Display an error message
    if (is_array($result['ErrorMessage'])) {
        // If ErrorMessage is an array, implode it to a string
        echo 'OCR Errora: ' . implode(', ', $result['ErrorMessage']);
    } else {
        // If ErrorMessage is not an array, display it as is
        echo 'OCR Errorb: ' . $result['ErrorMessage'];
    }
}
?>