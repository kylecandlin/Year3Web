<?php
  require 'Includes/connect.php';
  $username = $_POST['username'];
  $sql = "SELECT * FROM Person WHERE Username = :username";
  $stmt = $pdo->prepare($sql);

  $stmt->bindValue(':username', $username);

  $stmt->execute();

  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  if($user) {
    echo 1;
  }
  else {
    echo 0;
  }
?>
