<?php

session_start();

function logged_in() {
  return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function login_redirect() {
  if (logged_in()) {
    header('location: index.php');
    exit();  // Ensure that no further code is executed after the redirect
  }
}