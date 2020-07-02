<?php
  if(!isset($_SESSION)) {
    session_start();
  }

  if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }
  else {
    $username = '';
  }
?>
