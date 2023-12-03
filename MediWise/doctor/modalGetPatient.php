<?php
include '../connectMySQL.php';

$user_id = $_POST['user_id'];
$username ="";
$password ="";
$first_name ="";
$middle_name ="";
$last_name ="";
$suffix  ="";
$email_address ="";
$contact_number ="";
$birthdate = "";
$status="";
$barangay = "";

$query = "select * from patient where patient_id = '$user_id'";
    $result = $conn->query($query);
        while($row = $result->fetch_assoc())
        {
            $username = $row['username'];
            $password = $row['password'];
            $first_name = $row['first_name'];
            $middle_name = $row['middle_name'];
            $last_name = $row['last_name'];
            $suffix  = $row['suffix'];
            $email_address = $row['email'];
            $contact_number = $row['contact_number'];
            $status = $row['status'];
            $birthdate = $row['birthdate'];
            $barangay= $row['barangay'];
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
<form method="post" action="updatePatient.php" enctype="multipart/form-data">

  <div class="row">
    <div class="col-sm-12 col-12"> 
      <div class="form_group">
        <label for="username">Username</label>
        <input class="form-control" type="text" name="username" id="username" value="<?php echo $username;?>" maxlength="50"  required/ >
      </div>
    </div> 
  </div> 

  <script>
    function togglePasswordVisibility() {
      var passwordInput = document.getElementById("password");
      var passwordToggle = document.getElementById("passwordToggle");
      
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        passwordToggle.innerHTML = '<i class="fas fa-eye-slash"></i>';
      } else {
        passwordInput.type = "password";
        passwordToggle.innerHTML = '<i class="fas fa-eye"></i>';
      }
    }
  </script>


  <div class="row">
    <div class="col-sm-12 col-12"> 
      <div class="form_group">
        <label for="password">Password</label>
        <div class="input-group margin">
        <input type="password" class="form-control" name="password" id="password" value="<?php echo $password;?>" required>
        <span class="input-group-btn">
        <button type="button" class="btn btn-info btn-flat"id="passwordToggle" onclick="togglePasswordVisibility()"><i class="fas fa-eye"></i></button>
        </span>
        </div>
      </div>
    </div> 
  </div> 

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
        <input class="form-control" type="text" name="suffix" id="suffix" maxlength="50" value="<?php echo $suffix;?>"  / >
      </div>
    </div> 
  </div> 

  <div class="row">
    <div class="col-sm-12 col-12"> 
      <div class="form_group">
        <label for="birthdate">Birthdate</label>
        <input class="form-control" type="date" name="birthdate" id="birthdate"  value="<?php echo $birthdate;?>" maxlength="250"  required/ >
      </div>
    </div> 
  </div> 


  <div class="row">
    <div class="col-sm-12 col-12"> 
      <div class="form_group">
        <label for="email_address">Email address</label>
        <input class="form-control" type="email" name="email_address" id="email_address" value="<?php echo $email_address;?>" maxlength="250"  required/ >
      </div>
    </div> 
  </div> 

  <div class="row">
    <div class="col-sm-12 col-12"> 
      <div class="form_group">
        <label for="contact_number">Contact Number</label>
        <input class="form-control" type="number" name="contact_number" id="contact_number" value="<?php echo $contact_number;?>" maxlength="11"  required/ >
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

  <div class="row">
    <div class="col-sm-12 col-12"> 
      <div class="form_group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control col-lg-12" required>
          <option value="<?php echo $status;?>"><?php echo $status;?></option>
          <option value="ACTIVE">ACTIVE</option>
          <option value="INACTIVE">INACTIVE</option>
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

