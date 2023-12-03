
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
</head>
<style type="text/css">
</style>
<body>
<div class="card-body"><h1 class="m-0">FORUM</h1>
<div class="tab-content">
<div class="active tab-pane" id="activity">
<hr><hr>

<?php
include '../connectMySQL.php';
$query = "SELECT * FROM event ORDER BY event_id DESC";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
echo '<div class="post">
<div class="user-block">
<img class="img-circle img-bordered-sm" src="../Clogo.png" alt="user image">
<span class="username">
<a href="#">MediWise : '.$row['title'].'</a>
</span>
<span class="description">Date : '.$row['date'].'</span>
</div>
<div class="col-sm-12">
<center>';

if($row['image']!=''){
echo '<img class="img-fluid" src="'.$row['image'].'" alt="Photo">';
}

echo '
</center>
</div>
<p>
'.$row['description'].'
</p>
</div>
<hr><hr>';

}
?>




</div>



</div>

</div>

</body>

</html>