<?php
  require 'Includes/connect.php';
  require 'Includes/Classes.php';
  include 'Includes/sessionStart.php';

  if(isset($_POST['submitButton'])){
    $newUser = new User($pdo);
    $newUser->CreateUser($_POST['username'], $_POST['password']);
  }
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script>
    var username = '<?php echo $username; ?>';
  </script>
  <title>Login</title>
  <link rel="stylesheet" href="CSS/index.css?version=9" type="text/css">
  <link rel="stylesheet" href="CSS/login.css?version=4" type="text/css">
  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  <script src="Includes/index.js"></script>
  <script src="Includes/validation.js"></script>
</head>
<body>
  <section class="container">
    <section class="top-container">
      <?php
        require 'Includes/navigationPanel.php';
      ?>
    </section>
    <section class="content">
      <form action="" method="post" id="registerForm">
        <h1> Register </h1>
        <input name="username" class="input-button" type="text" placeholder="Username" />
        <input name="password" id="password" class="input-button" type="text" placeholder="Password" />
        <p id="error"></p>
        <!-- <input id="DOB" name="DOB" class="input-button" type="date" /> -->
        <input id="submit-button" name="submitButton" class="input-button" type="submit" value="Create Account"/>
        <p> Already have an account? <a href="login.php"> Log in here. </a></p>
      </form>
    </section>
    <section class="page-footer">
      <?php require 'Includes/footer.php'; ?>
    </section>
  </section>
</body>
</html>
