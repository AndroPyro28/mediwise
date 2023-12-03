<?php
include '../connectMySQL.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MediWise</title>
  <link rel="icon" type="image/x-icon" href="../Clogo.png">
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

</style>
</head>
<body>

<section>

<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6 row">

<h1 class="m-0">Appointment</h1>&nbsp<button class="btn btn-info-new create_appointment"><i class="fas fa-plus-circle"></i></button>
</div>
</div>
</div>
</div>
<div class="content">
    <div class="card">
        <div class="card-header border-1">

            <div class="d-flex flex-row justify-content-end">
                <?php
                $query = "SELECT *,concat(b.first_name,' ',b.last_name) as doc_name FROM appointment a 
                left join doctor b on b.doctor_id = a.doctor_id ";
                $result = $conn->query($query);
                echo "<div id='successz' class = 'col-lg-12'>
                <table class='table table-bordered table-striped dataTable dtr-inline ' id='table'>
                <thead><tr>
                <th nowrap>Description</th>
                <th nowrap>Doctor's Name</th>
                <th nowrap>Date</th>
                <th nowrap>Status</th>
                </tr></thead><tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr role='row'>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['doc_name'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                }
                ?>
              </div>
            </div>
          </div>
        </div>
</section>


<!--MODAL CREATE ACCOUNT-->
<div class="modal fade" id="modal-default1" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-default">
     <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title"><i class="fas fa-calendar"></i> Create</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
         </button>
       </div>
       <div class="modal-body" id="createAccount"> 
       
        </div>
   </div>
 </div> 
</div>

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
  $(document).on('click', '.create_appointment', function(){
  var user_id = $(this).attr("id");
  $.ajax({
   url:"modalCreateAppointment.php",
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
</body>
</html>