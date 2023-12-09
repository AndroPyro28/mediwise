<?php
include '../connectMySQL.php';
include '../loginverification.php';
if (logged_in()) {
    $session_user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css?v=3.2.0">
  <script src="../plugins/jquery/jquery.min.js"></script>
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../dist/js/adminlte.js"></script>
  <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>  
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> 
  <link rel="stylesheet" href="../designs.css">
<style>
.badge-info {
    color: #fff;
    background-color: #86B049;
}
</style>
<form method="post">
<h5 class="mb-2 mt-4"></h5>
<div class="col-lg-12 col-12">
    <div class="small-box badge-info">
        <div class="inner"><center>
            <h3>PATIENTS</h3></center>
        </div>
        <a href="#top" class="small-box-footer create_account">
                Create Patient <i class="fas fa-plus-square"></i>
         </a>
    </div>
</div>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-12">
                <h1 class="m-0" id="concernInfo">List </h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="card">
        <div class="card-header border-1">
            <div class="d-flex flex-row justify-content-end">
                <?php
                $query = "SELECT p.*, b.name as barangay_name  FROM patient p INNER JOIN barangay b ON b.barangay_id = p.barangay_id";
                $result = $conn->query($query);
                echo "<div id='successz' class = 'col-lg-12'>
                <table class='table table-bordered table-striped dataTable dtr-inline ' id='table'>
                <thead><tr>
                <th nowrap>Username</th>
                <th nowrap>First Name</th>
                <th nowrap>Middle Name</th>
                <th nowrap>Last Name</th>
                <th nowrap>Suffix</th>
                <th nowrap>Birthdate</th>
                <th nowrap>Contact Number</th>
                <th nowrap>Email</th>
                <th nowrap>Barangay</th>
                <th nowrap>Update</th>
                </tr></thead><tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr role='row'>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['middle_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['suffix'] . "</td>";
                    echo "<td>" . $row['birthdate'] . "</td>";
                    echo "<td>" . $row['contact_number'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['barangay_name'] . "</td>";
                    echo ' <td><a name="view" value="Update" id="' . $row["patient_id"] . '" class="btn btn-success btn-block update_account" style="color:white;"><i class="fas fa-edit" style="color:white;"></i></a></td>';
                }
                ?>
</form>
<?php
} else {
    header('location:../index.php');
}
?>
</body>

<!--MODAL CREATE ACCOUNT-->
<div class="modal fade" id="modal-default1" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-default">
     <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title"><i class="fas fa-user-plus"></i> Create</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
         </button>
       </div>
       <div class="modal-body" id="createAccount"> 
       
        </div>
   </div>
 </div> 
</div>
<!--MODAL-->

<!--MODAL UPDATE ACCOUNT-->
<div class="modal fade" id="modal-default2" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-default">
     <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title"><i class="fas fa-user-plus"></i> Update </h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
         </button>
       </div>
       <div class="modal-body" id="updateAccount"> 
       asd
        </div>
   </div>
 </div> 
</div>
<!--MODAL-->
<script>
  $(function () {
    $("#table").DataTable({
      "responsive": true,
      "autoWidth": false,
      "bDestroy": true,
    });
    $('#table1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
  $(document).ready(function(){ 
  $(document).on('click', '.create_account', function(){
  var user_id = $(this).attr("id");
  $.ajax({
   url:"modalCreatePatient.php",
   method:"POST",
   data:{user_id:user_id},
   success:function(data){
    $('#createAccount').html(data);
    $('#modal-default1').modal('show');
   }
  })
 })
});
</script>
<script>
  $(document).ready(function(){ 
  $(document).on('click', '.update_account', function(){
  var user_id = $(this).attr("id");
  $.ajax({
   url:"modalGetPatient.php",
   method:"POST",
   data:{user_id:user_id},
   success:function(data){
    $('#updateAccount').html(data);
    $('#modal-default2').modal('show');
   }
  })
 })
});
</script>
</html>
