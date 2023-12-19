<?php
 include '../connectMySQL.php';
 include '../loginverification.php';
 //Retrieve data from the inventory table


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['requestDetails'])) {

    if (logged_in()) {
        $session_user_id = $_SESSION['user_id'];
       //  $barangay_id = isset($_SESSION['barangay_id']) ? $_SESSION['barangay_id'] : null;
   
        // query the admin get his barangay_id
        $barangay_query = "SELECT barangay_id FROM admin WHERE admin_id = $session_user_id";
   
        $barangay_result = $conn->query($barangay_query);
   
       if ($barangay_result->num_rows > 0) {
           $barangay_row = $barangay_result->fetch_assoc();
           $barangay_id = $barangay_row['barangay_id'];
   
         
           // Now you have $barangay_id, which is the admin's barangay_id
       } else {
           // Handle the case where no data is returned (optional)
           $barangay_id = null;
           // You might want to set a default value or display an error message
       }
   
    }

    // Sanitize the input
    $requestDetails = mysqli_real_escape_string($conn, $_POST['requestDetails']);
    
    // Assuming you have a table named 'requests' to store the requests
    $sql = "INSERT INTO requests (admin_id, content, barangay_id) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Assuming $_SESSION['user_id'] and $_SESSION['barangay_id'] contain the user's and barangay's ID
    $stmt->bind_param('iss', $session_user_id, $requestDetails, $barangay_id);

    // Execute the statement
    $stmt->execute();

    // Check for success
    if ($stmt->affected_rows > 0) {
        $response = ['status' => 'success'];
    } else {
        $response = ['status' => 'error', 'message' => 'Failed to submit request'];
    }

    // Close the statement
    $stmt->close();
} else {
    $response = ['status' => 'error', 'message' => 'Failed to prepare statement'];
}
} else {
    $response = ['status' => 'error', 'message' => 'Invalid request'];
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>