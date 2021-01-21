<?php
  // Connection variables
  $host = '172.16.11.22:3306';
  $user = 'cank1_web';
  $pass = '^tz6k1S5';
  $dbms = 'cank1_17_web';

  // Create connection
  try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbms", $user, $pass);

    //Set error mode to exceptional
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  catch(PDOException $e){

  }
?>
