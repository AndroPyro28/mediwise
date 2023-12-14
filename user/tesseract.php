<?php

require '../vendor/autoload.php';

use thiagoalessio\TesseractOCR\TesseractOCR;

// Specify the path to the image file
$imagePath = 'C:/xampp/htdocs/mediwise/public/uploads/prescription.png';
// Specify the path to the Tesseract executable
$tesseract = new TesseractOCR($imagePath);
$tesseract->executable('C:\Program Files\Tesseract-OCR\tesseract.exe'); // Adjust the path accordingly

// Debugging: Output the Tesseract command being run
// var_dump($tesseract->cmd());

// Optionally, you can set additional options
// $tesseract->setWhitelist(range('a', 'z')); // Set whitelist characters

// Perform OCR on the image
$text = $tesseract->run();

// Output the extracted text
echo "Extracted Text:\n";
echo "<pre> ' . $text . ' </pre>" ;
?>