<?php
include 'connectMySQL.php';

if (isset($_POST['LOGIN'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (empty($username) || empty($password)) {
        // Display error message if username or password is empty
        echo "<script src='dist/js/sweetalert2.all.min.js'></script>
           <body onload='error()'></body>
           <script> 
           function error(){
           Swal.fire({
                icon: 'error',
                title: 'Login failed!'
           })
           }</script>";
        include 'login.php';
        exit; // Added exit to stop execution if credentials are empty
    }

    $query = "";
    $table = "";
    $idField = "";
    $redirectPath = "";

    if ($role === 'Admin') {
        $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password' AND status = 'ACTIVE'";
        $table = "admin";
        $idField = "admin_id";
        $redirectPath = "admin/";
    } elseif ($role === 'Doctor') {
        $query = "SELECT * FROM doctor WHERE username = '$username' AND password = '$password' AND status = 'ACTIVE'";
        $table = "doctor";
        $idField = "doctor_id";
        $redirectPath = "doctor/";
    }

    if ($query && $table && $idField && $redirectPath) {
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                session_start();
                $_SESSION['user_id'] = $row[$idField];
                $_SESSION['username'] = $row['username'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['middle_name'] = $row['middle_name'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['email_address'] = $row['email_address'];
                $_SESSION['contact_number'] = $row['contact_number'];
                $_SESSION['role'] = $role;
                $_SESSION['barangay_id'] = $row['barangay_id'];

                header('location:' . $redirectPath);
                exit; // Added exit after header to stop further execution
            }
        }
    } 
         // If the loop didn't execute (no matching credentials)
            echo "<script src='dist/js/sweetalert2.all.min.js'></script>
            <body onload='error()'></body>
            <script> 
            function error(){
            Swal.fire({
                icon: 'error',
                title: 'Login failed!'
            })
            }</script>";
        include "login-{$table}.php";
}
?>