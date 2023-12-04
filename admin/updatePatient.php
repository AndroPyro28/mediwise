<?php 
include('../connectMySql.php');
$user_id = $_POST['user_id'];
$username = $_POST['username'];
$password = $_POST['password'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$suffix = $_POST['suffix'];
$birthdate = $_POST['birthdate'];
$email = $_POST['email_address'];
$contact_number = $_POST['contact_number'];
$barangay = $_POST['barangay'];
$status = $_POST['status'];

$sql= sprintf("UPDATE patient
SET 
username = '".$username."',
password = '".$password."',
first_name = '".$first_name."',
middle_name = '".$middle_name."',
last_name = '".$last_name."',
suffix = '".$suffix."',
birthdate = '".$birthdate."',
email = '".$email."',
contact_number = '".$contact_number."',
barangay = '".$barangay."',
status = '".$status."'
WHERE patient_id = '". $user_id ."'");

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
    include 'patient.php';
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
    include 'patient.php';
}

?>