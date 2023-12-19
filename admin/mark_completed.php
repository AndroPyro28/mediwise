<?php
include '../connectMySQL.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_id'])) {
    $requestId = $_POST['request_id'];

    // Update the request status to 'COMPLETED' in the requests table
    $updateRequestQuery = "UPDATE requests SET request_status = 'COMPLETED' WHERE id = ?";
    $updateRequestStmt = $conn->prepare($updateRequestQuery);
    $updateRequestStmt->bind_param("i", $requestId);

    if ($updateRequestStmt->execute()) {
        // Now, update the isArchive column in the inventory table
        $updateInventoryQuery = "UPDATE inventory SET isArchive = false WHERE request_id = ?";
        $updateInventoryStmt = $conn->prepare($updateInventoryQuery);
        $updateInventoryStmt->bind_param("i", $requestId);

        if ($updateInventoryStmt->execute()) {
            $response = ['status' => 'success'];
            echo json_encode($response);
            exit();
        } else {
            $response = ['status' => 'error', 'message' => 'Failed to update inventory'];
            echo json_encode($response);
            exit();
        }
    } else {
        $response = ['status' => 'error', 'message' => 'Failed to mark request as completed'];
        echo json_encode($response);
        exit();
    }
} else {
    $response = ['status' => 'error', 'message' => 'Invalid request'];
    echo json_encode($response);
    exit();
}
?>
