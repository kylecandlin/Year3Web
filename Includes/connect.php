<?php
  // Connection variables
  $host = 'localhost';
  $user = 'root';
  $pass = '';
  $dbms = 'recipedb';

  // Create connection
  try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbms", $user, $pass);

    //Set error mode to exceptional
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection successful";
  }

  catch(PDOException $e){
    echo "Connection error: " . $e->getMessage();
  }
?>
