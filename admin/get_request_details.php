<?php
// Assuming you have included necessary files and initialized your database connections
include '../connectMySQL.php';

// Retrieve the request ID from the POST data
$requestId = isset($_POST['request_id']) ? $_POST['request_id'] : null;

// Check if the request ID is provided
if (!$requestId) {
    $response = ['status' => 'error', 'message' => 'Request ID is missing'];
    echo json_encode($response);
    exit;
}

// Get request details
$requestQuery = "SELECT * FROM requests WHERE id = $requestId";
$requestResult = $conn->query($requestQuery);

// Get inventory items associated with the request
$inventoryQuery = "SELECT * FROM inventory WHERE request_id = $requestId";
$inventoryResult = $conn->query($inventoryQuery);

// Check if both queries were successful
if ($requestResult === false || $inventoryResult === false) {
    $response = ['status' => 'error', 'message' => 'Failed to fetch request details or inventory items'];
    echo json_encode($response);
    exit;
}

// Fetch request details
$requestDetails = $requestResult->fetch_assoc();

// Fetch inventory items
$inventoryItems = [];
while ($row = $inventoryResult->fetch_assoc()) {
    $inventoryItems[] = [
        'inventory_id' => $row['inventory_id'],
        'item_name' => $row['name'], // Replace with the actual column name
        'quantity' => $row['quantity'], // Replace with the actual column name
        // Include other inventory-related fields
    ];
}

// Combine request details and inventory items in the response
$response = ['status' => 'success', 'requestDetails' => $requestDetails, 'inventoryItems' => $inventoryItems];
echo json_encode($response);

// Close the database connection
$conn->close();
?>
