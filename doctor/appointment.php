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
            <h3>Appointment</h3></center>
        </div>
      
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
<section>

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
                <th nowrap>id</th>
                <th nowrap>Description</th>
                <th nowrap>Doctor's Name</th>
                <th nowrap>Date</th>
                <th nowrap>Status</th>
                <th nowrap>Action</th>
                </tr></thead><tbody>";
  
                while ($row = $result->fetch_assoc()) {
                  echo "<tr role='row'>";
                  echo "<td>" . $row['appointment_id'] . "</td>";
                  echo "<td>" . $row['description'] . "</td>";
                  echo "<td>" . $row['doctor_name'] . "</td>";
                  echo "<td>" . $row['date'] . "</td>";
                  echo "<td>" . $row['request_status'] . "</td>";
                  if($row['request_status'] === 'PENDING') {
                    echo "<td> 
                    <button class='btn btn-info clickBtnAccept'>Accept</button>
                    <button class='btn btn-info clickBtnDecline' style='background:red;'>Decline</button>
                    </td>";
                  } else {
                    echo "<td> - </td>";
                  }
              }
                ?>
              </div>
            </div>
          </div>
        </div>
        <?php 

        echo "<input type='hidden' id='user_id' value='$session_user_id' />"
         
        ?>
</section>

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
   url:"modalCreateDoctor.php",
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
</script>

<script>
      const user_id = document.querySelector('#user_id').value;


  $(document).ready(function (e) {

    // Attach click event to the button with class 'clickBtn'
    $(document).on('click', '.clickBtnAccept', async function (e) {
      // Get the data from the clicked row
      e.preventDefault()
      var rowData = $(this).closest('tr').find('td').map(function () {
        return $(this).text();
      }).get();

      // Extract the appointment ID from the first column (index 0)
      var appointmentId = rowData[0];
      // Send an AJAX request to update the status
      const result = await fetch('http://localhost:3001/appointments', { // sending data to the server
        method: 'PATCH',
        body: JSON.stringify({
          appointmentId: appointmentId,
          status:'ACCEPTED',
          user_id
        }),
        headers: {
        'Content-type': 'application/json; charset=UTF-8',
  },
        // body: JSON.stringify({ appointmentId }),
        
      })
      
      const data = await result.json();
      if(result.status === 201) {
        window.location.reload()
      }
    });

    $(document).on('click', '.clickBtnDecline', async function (e) {
      // Get the data from the clicked row
      e.preventDefault()
      var rowData = $(this).closest('tr').find('td').map(function () {
        return $(this).text();
      }).get();

      // Extract the appointment ID from the first column (index 0)
      var appointmentId = rowData[0];

      // Send an AJAX request to update the status


      const result = await fetch('http://localhost:3001/appointments', { // sending data to the server
        method: 'PATCH',
        body: JSON.stringify({
          appointmentId: appointmentId,
          status:'DECLINE',
          user_id,
        }),
        headers: {
        'Content-type': 'application/json; charset=UTF-8',
  },
        // body: JSON.stringify({ appointmentId }),
        
      })
      
      const data = await result.json();
      if(result.status === 201) {
        window.location.reload()
      }
    });

  });
</script>

</html>
