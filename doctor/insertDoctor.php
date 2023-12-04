<?php
include('../connectMySql.php');
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$suffix = $_POST['suffix'];
$barangay = $_POST['barangay'];
$specialist = $_POST['specialist'];
$id_number = $_POST['id_number'];

    // Insert the new user
    $sql = "INSERT INTO doctor (first_name, middle_name, last_name,suffix,barangay, specialist, id_number)
        VALUES ('$first_name', '$middle_name', '$last_name', '$suffix','$barangay', '$specialist', '$id_number')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script src='../dist/js/sweetalert2.all.min.js'></script>
        <body onload='save()'></body>
        <script> 
        function save(){
        Swal.fire(
            'Registered!',
            '',
            'success'
        )
        }</script>";
        include 'doctor.php';
    } else {
        echo "<script src='../dist/js/sweetalert2.all.min.js'></script>
        <body onload='error()'></body>
        <script> 
        function error(){
        Swal.fire({
            icon: 'error',
            title: 'Register failed!'
        })
        }</script>";
        include 'doctor.php';
    }

?>
