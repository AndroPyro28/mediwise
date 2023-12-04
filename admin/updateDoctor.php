<?php 
include('../connectMySql.php');
$user_id = $_POST['user_id'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$suffix = $_POST['suffix'];
$specialist = $_POST['specialist'];
$barangay = $_POST['barangay'];
$id_number = $_POST['id_number'];

$sql= sprintf("UPDATE doctor
SET 
first_name  = '". $first_name ."', 
middle_name  = '". $middle_name ."',
last_name  = '". $last_name ."',
suffix  = '". $suffix ."',
specialist = '". $specialist ."',
barangay = '". $barangay ."',
id_number = '". $id_number ."'
WHERE doctor_id = '". $user_id ."'");

if ($conn->query($sql) === TRUE) {
    echo "<script src='../dist/js/sweetalert2.all.min.js'></script>
    <body onload='save()'></body>
    <script> 
    function save(){
    Swal.fire(
         'Record Updated!',
         '',
         'success'
       )
    }</script>";
    include 'doctor.php';
}
else
{
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