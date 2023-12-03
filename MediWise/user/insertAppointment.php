<?php
include('../connectMySql.php');
$description = $_POST['description'];
$doctor_id = $_POST['doctor_id'];
$date = $_POST['date'];

    // Insert the new user
    $sql = "INSERT INTO appointment (description, doctor_id, date)
        VALUES ('$description',  '$doctor_id', '$date')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script src='../dist/js/sweetalert2.all.min.js'></script>
        <body onload='save()'></body>
        <script> 
        function save(){
        Swal.fire(
            'Record Saved!',
            '',
            'success'
        )
        }</script>";
        include 'dashboard.php';
    } else {
        echo "<script src='../dist/js/sweetalert2.all.min.js'></script>
        <body onload='error()'></body>
        <script> 
        function error(){
        Swal.fire({
            icon: 'error',
            title: 'Record failed!'
        })
        }</script>";
        include 'dashboard.php';
    }

?>
