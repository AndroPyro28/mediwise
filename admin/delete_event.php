<?php
include('../connectMySql.php');
$sql = "DELETE FROM event WHERE event_id  = '".$_POST['event_id']."'";
if ($conn->query($sql) === TRUE) {
   echo "<script src='../dist/js/sweetalert2.all.min.js'></script>
    <body onload='save()'></body>
    <script> 
    function save(){
    Swal.fire(
         'Event deleted!',
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
                    title: 'Delete failed!'
              })
    }</script>";
    include 'event.php';
}
?>