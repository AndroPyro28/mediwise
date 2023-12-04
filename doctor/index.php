<?php
include '../connectMySQL.php';
include '../loginverification.php';
if(logged_in()){
    $session_user_id = $_SESSION['user_id'];
    $session_username = $_SESSION['username'];
    $session_first_name = $_SESSION['first_name'];
    $session_middle_name = $_SESSION['middle_name'];
    $session_last_name = $_SESSION['last_name'];
    $role = $_SESSION['role'];

    if($role !== 'Doctor') {
      header('location:../index.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
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
  .brand-link {
  display: flex;
  align-items: center;
}

.brand-link img {
  width: 250px;
  height: 60px; 
}

</style>

</head>
<style>
  [class*=sidebar-dark-] {
    background-color: #476930;
}

</style>
<body id="main_body" class="hold-transition sidebar-mini " onload="load_home()">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

       <img src="../logo.png" style="width:150px;height:70px;">
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- brand logo -->
      <a href="#" onclick="load_home()" class="brand-link">
      <img src="../clogo.png"  class="brand-image img-circle elevation-3" style="opacity: .8"> <span class="brand-text font-weight-light">MediWise</span>
    </a>
    </a>
</a>
    <a onclick="load_home()" class="brand-link">
      <span class="brand-text font-weight-light"><?php echo $session_first_name.' '.$session_last_name;?></span>
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <!-- <li class="nav-item">
            <a href="#" onclick="load_home()" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="#" onclick="load_appointment()" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Appointment
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="#" onclick="load_admin()" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Profile
              </p>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a href="#" onclick="load_doctor()" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Doctor
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="#" onclick="load_history()" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                history
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="#" onclick="()" class="nav-link">
              <i class="nav-icon fas fa-cubes"></i>
              <p>
                Inventory
              </p>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a href="#" onclick="load_event()" class="nav-link">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Event
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="../logout.php" class="nav-link">
              <i class="far fas fa-power-off nav-icon"></i>
              <p>Log-out
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- page content -->
  <div class="content-wrapper">
    <section class="content">
      <script>
       function load_admin() {
                  document.getElementById("pgm1").innerHTML='<object type="text/html" data="admin.php" width="100%" height="100%"></object>';
                  }
       function load_doctor() {
                  document.getElementById("pgm1").innerHTML='<object type="text/html" data="doctor.php" width="100%" height="100%"></object>';
                  }
       function load_history() {
                  document.getElementById("pgm1").innerHTML='<object type="text/html" data="history.php" width="100%" height="100%"></object>';
                  }
      function load_appointment() {
                  document.getElementById("pgm1").innerHTML='<object type="text/html" data="appointment.php" width="100%" height="100%"></object>';
                  }
      function load_event() {
                  document.getElementById("pgm1").innerHTML='<object type="text/html" data="event.php" width="100%" height="100%"></object>';
                  }
      </script>
      <style>
                    .container-outer { width: 100%;
                                       height: 800px;
                                      margin: auto;
                                      
                                    }
                    
      </style>
      <div class="container-outer"  id="pgm1">
      </div>
    </section>
    
  </div>
</div>
</body>


<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "bDestroy": true,
    });
    $('#example2').DataTable({
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

<?php
}
else{
  header('location:../index.php');
}
?>
</html>
