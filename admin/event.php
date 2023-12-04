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
  <script src='../dist/js/sweetalert2.all.min.js'></script>
<style>
.badge-info {
    color: #fff;
    background-color: #86B049;
}
</style>
<body id="main_body">
<form method="post">
<h5 class="mb-2 mt-4"></h5>
<div class="col-lg-12 col-12">
    <div class="small-box badge-info">
        <div class="inner"><center>
            <h3>EVENT</h3></center>
        </div>
        <a href="#top" class="small-box-footer create_account">
                Create Event <i class="fas fa-plus-square"></i>
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
                $query = "SELECT * FROM event";
                $result = $conn->query($query);
                echo "<div id='successz' class = 'col-lg-12'>
                <table class='table table-bordered table-striped dataTable dtr-inline ' id='table'>
                <thead><tr>
                <th nowrap>Title</th>
                <th nowrap>Description</th>
                <th nowrap>Date</th>
                <th nowrap>Delete</th>
                </tr></thead><tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr role='row'>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo ' <td><a name="view" value="Update" id="' . $row["event_id"] . '" class="btn btn-danger btn-block delete_event" style="color:white;"><i class="fas fa-trash" style="color:white;"></i></a></td>';
                }
                ?>
</form>
</body>
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
   url:"modalCreateEvent.php",
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
   url:"modalGetDoctor.php",
   method:"POST",
   data:{user_id:user_id},
   success:function(data){
    $('#updateAccount').html(data);
    $('#modal-default2').modal('show');
   }
  })
 })
});


    $(document).ready(function(){ 
  $(document).on('click', '.delete_event', function(){
  var event_id = $(this).attr("id");

Swal.fire({
  title: 'Do you want to save the changes?',
  showDenyButton: true,
  confirmButtonText: 'Save',
  denyButtonText: `Don't save`,
}).then((result) => {

  if (result.isConfirmed) {
    Swal.fire('Saved!', '', 'success')
    $.ajax({
     url:"delete_event.php",
     method:"POST",
     data:{event_id:event_id},
     success:function(data){
      $('#main_body').html(data);
     }
    })

  } else if (result.isDenied) {
    Swal.fire('Changes are not saved', '', 'info')
  }
})

 })
});
</script>
</html>
