<?php
include('connectMySql.php');
$username = $_POST['username'];
$password = $_POST['password'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$email_address = $_POST['email_address'];
$contact_number = $_POST['contact_number'];

    // Insert the new user
    $sql = "INSERT INTO admin (username, password,  first_name, middle_name, last_name, email_address, contact_number,status)
        VALUES ('$username', '$password','$first_name', '$middle_name', '$last_name', '$email_address', '$contact_number','ACTIVE')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script src='dist/js/sweetalert2.all.min.js'></script>
        <body onload='save()'></body>
        <script> 
        function save(){
        Swal.fire(
            'Registered!',
            '',
            'success'
        )
        }</script>";
        include 'index.php';
    } else {
        echo "<script src='dist/js/sweetalert2.all.min.js'></script>
        <body onload='error()'></body>
        <script> 
        function error(){
        Swal.fire({
            icon: 'error',
            title: 'Register failed!'
        })
        }</script>";
        include 'index.php';
    }

?>
