<!DOCTYPE html>
<html>
<head>
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css?v=3.2.0">
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/js/adminlte.js"></script>
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>  
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> 
  <link rel="stylesheet" href="designs.css">
</head>
<body>
<!--INFO-->
<form method="post" action="insertAppointment.php" enctype="multipart/form-data" >

  <div class="row">
    <div class="col-sm-12 col-12"> 
      <div class="form_group">
        <label for="description">Description</label>
        <input class="form-control" type="text" name="description" id="description" value="" maxlength="50"  required/ >
      </div>
    </div> 
  </div> 

  <div class="row">
    <div class="col-sm-12 col-12"> 
      <div class="form_group">
        <label for="doctor_id">Name of Doctor</label>
        <select class="form-control" name="doctor_id" required>
          <option value="">Select</option>
           <?php
                include '../connectMySQL.php';
                $query = "SELECT * FROM doctor";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo ' <option value="'.$row['doctor_id'].'">'.$row['first_name'].' '.$row['last_name'].'</option>';
                }
                ?>
        </select>
      </div>
    </div> 
  </div> 


  <div class="row">
    <div class="col-sm-12 col-12"> 
      <div class="form_group">
        <label for="date">Date</label>
        <input class="form-control" type="date" name="date" id="date" value="" maxlength="11"  required/ >
      </div>
    </div> 
  </div> 

  <br>
  <div class="row">
        <div class="col-sm-6 col-6"> 
      <div class="form_group">
        <div id="formField">
        <input type="submit" class="btn btn-success form-control" name="btn_edit" id="btn_edit" value="SAVE" /></div>
      </div>
    </div> 
    <div class="col-sm-6 col-6"> 
      <div class="form_group">
        <input type="button" class="btn btn-danger form-control" name="btn_cancel" id="btn_cancel" data-dismiss="modal" value="CANCEL" />
      </div>
    </div> 
  </div>
</form>
</body>
</html>
