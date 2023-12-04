<?php
include '../connectMySQL.php';

$user_id = $_POST['user_id'];
$first_name ="";
$middle_name ="";
$last_name ="";
$suffix ="";
$barangay  ="";
$specialist ="";
$id_number ="";

$query = "select * from doctor where doctor_id = '$user_id'";
    $result = $conn->query($query);
        while($row = $result->fetch_assoc())
        {
            $first_name = $row['first_name'];
            $middle_name = $row['middle_name'];
            $last_name = $row['last_name'];
            $suffix  = $row['suffix'];
            $barangay = $row['barangay'];
            $specialist = $row['specialist'];
            $id_number = $row['id_number'];
            }
?>
<!DOCTYPE html>
<html>
<head>
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GIS</title>
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
</head>
<body>
<!--INFO-->
<form method="post" action="updateDoctor.php" enctype="multipart/form-data">

  <div class="row">
    <div class="col-sm-12 col-12"> 
      <div class="form_group">
        <label for="first_name">First Name</label>
        <input class="form-control" type="text" name="first_name" id="first_name" value="<?php echo $first_name;?>" maxlength="50"  required/ >
      </div>
    </div> 
  </div> 

  <div class="row">
    <div class="col-sm-12 col-12"> 
      <div class="form_group">
        <label for="middle_name">Middle Name</label>
        <input class="form-control" type="text" name="middle_name" id="middle_name" value="<?php echo $middle_name;?>" maxlength="50"  / >
      </div>
    </div> 
  </div> 

  <div class="row">
    <div class="col-sm-12 col-12"> 
      <div class="form_group">
        <label for="last_name">Last Name</label>
        <input class="form-control" type="text" name="last_name" id="last_name" value="<?php echo $last_name;?>" maxlength="50"  required/ >
      </div>
    </div> 
  </div> 

  <div class="row">
    <div class="col-sm-12 col-12"> 
      <div class="form_group">
        <label for="suffix">Suffix</label>
        <input class="form-control" type="text" name="suffix" id="suffix" value="<?php echo $suffix;?>" maxlength="50"  required/ >
      </div>
    </div> 
  </div> 

  <div class="row">
    <div class="col-sm-12 col-12"> 
      <div class="form_group">
        <label for="specialist">Specialist</label>
        <input class="form-control" type="text" name="specialist" id="specialist" value="<?php echo $specialist;?>" maxlength="250"  required/ >
      </div>
    </div> 
  </div> 

  <div class="row">
    <div class="col-sm-12 col-12"> 
      <div class="form_group">
        <label for="id_number">ID Number</label>
        <input class="form-control" type="text" name="id_number" id="id_number" value="<?php echo $id_number;?>" maxlength="11"  required/ >
        <input class="form-control" type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>" required/ >
      </div>
    </div> 
  </div> 
 
 <div class="row">
    <div class="col-sm-12 col-12"> 
      <div class="form_group">
        <label for="barangay">Barangay</label>
        <select class="form-control" name="barangay" required>
          <option value="<?php echo $barangay;?>"><?php echo $barangay;?></option>
          <option value="174">174</option>
          <option value="175">175</option>
          <option value="178 A">178 A</option>
          <option value="178 B">178 B</option>
        </select>
      </div>
    </div> 
  </div> 

  <br>
  <div class="row">
        <div class="col-sm-6 col-6"> 
      <div class="form_group">
        <input type="submit" class="btn btn-success form-control" name="btn_edit" id="btn_edit" value="SAVE"  />
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

