<?php

session_start();
function logged_in(){
  if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
    return true;

  }else {
    return false;
  }
}

function login_redirect(){
  if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
    header('location:index.php');

  }
}


?>