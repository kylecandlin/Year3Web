<?php
  require 'Includes/connect.php';
  require 'Includes/Classes.php';

  if(isset($_POST['submitButton'])){
    $user = new User($pdo);
    $user->SignIn($_POST['username'], $_POST['password']);
  }
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="CSS/index.css?version=9" type="text/css">
  <link rel="stylesheet" href="CSS/login.css?version=3" type="text/css">
  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  <script src="Includes/index.js"></script>
</head>
<body>
  <section class="container">
    <section class="top-container">
      <?php
        require 'Includes/navigationPanel.php';
      ?>
    </section>
    <section class="content">
      <form action="" method="post" id="loginForm">
        <h1> Login </h1>
        <input id="username" name="username" class="input-button" type="text" placeholder="Username" />
        <p id="usernameError" class="validError"></p>
        <input id="password" name="password" class="input-button" type="text" placeholder="Password" />
        <p id="passwordError" class="validError"></p>
        <input id="submit-button" name="submitButton" class="input-button" type="submit" value="Log In"/>
        <p> No account? <a href="register.php"> Create one here. </a></p>
      </form>
    </section>
    <section class="page-footer">
      <?php require 'Includes/footer.php'; ?>
    </section>
  </section>
</body>
</html>
