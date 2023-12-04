<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'><link rel="stylesheet" href="./login.css">

</head>
<body>
<div class="overlay">

<form>
   <div class="con">
   <header class="head-form">
      <h2>Log In</h2>
      <p>Enter you username and password</p>
   </header>
   <br>
   <div class="field-set" style="width:100%; ">
     
         <div class="" style="display:flex; align-items:center; height:fit; padding:5px; background-color:white; border-radius:5px;">
           <i class="fa fa-user-circle"></i>
           <input class="form-input" type="text" style="flex:1;" placeholder="@UserName" id="username" required>
         </div>
     
      <br>
      <div class="" style="display:flex; align-items:center; height:fit; padding:5px; background-color:white; border-radius:5px;">
            <i class="fa fa-key"></i>
            <input class="form-input" type="password" placeholder="Password"  style="flex:1;" id="password" required>
            <i class="fa fa-eye" aria-hidden="true" id="eye"></i>
         </div>

     <button class="log-in" style="margin-top:25px; width:100%;"> Log In </button>
     <center style="margin-top:25px;"> <a href="login.php" ><p>Login as admin/doctor? Click here to create</p> </center>
     <center style="margin-top:25px;"> <a href="patient-registration.php" ><p>Don't have an account? Click here to create</p> </center>
   </div>
  
   <div class="other" style="display:flex; flex-direction:column; align-items:center; justify-content:center;">
      <!-- <button class="btn submits frgt-pass">Forgot Password</button> -->
      </button>
   </div>
  </div>
</form>
</div>
  <script  src="./login.js">
    // Show/hide password onClick of button using Javascript only
// https://stackoverflow.com/questions/31224651/show-hide-password-onclick-of-button-using-javascript-only
  </script>

  <script src="./user/reverseAuth.js"></script>

</body>
</html>
