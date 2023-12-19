<?php
include '../connectMySQL.php';
include '../loginverification.php';

// Assuming you have the request ID sent in the POST request
$request_id = isset($_POST['request_id']) ? $_POST['request_id'] : null;

if ($request_id) {
    try {
        // Use a prepared statement to update the status of the request
        $cancel_query = "UPDATE requests SET request_status = 'CANCELLED' WHERE id = ?";
        $cancel_stmt = $conn->prepare($cancel_query);

        if (!$cancel_stmt) {
            throw new Exception("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }

        $cancel_stmt->bind_param("i", $request_id);

        if ($cancel_stmt->execute()) {
            // If the update was successful, send a success response
            $response = ['status' => 'success'];
        } else {
            // If the update failed, send an error response with detailed information
            throw new Exception("Execute failed: (" . $cancel_stmt->errno . ") " . $cancel_stmt->error);
        }

        $cancel_stmt->close();
    } catch (Exception $e) {
        // Handle exceptions and send an error response
        $response = ['status' => 'error', 'message' => $e->getMessage()];
    }
} else {
    // If no request ID is provided, send an error response
    $response = ['status' => 'error', 'message' => 'Invalid request'];
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>