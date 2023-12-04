<?php
include('../connectMySql.php');
$title = $_POST['title'];
$description = $_POST['description'];
$image= $_POST['image'];

    // Insert the new user
$sql = "INSERT INTO event 
(
title,
description,
image
)
VALUES 
(
'$title',
'$description',
'$image'
)";
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
        include 'event.php';
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
        include 'event.php';
    }

?>
