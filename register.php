<?php
  require 'Includes/connect.php';
  require 'Includes/navigationPanel.php';
  require 'Includes/Classes.php';

  if(isset($_POST['submitButton'])){
    $User = new User($pdo);
    $User->CreateUser($_POST['username'], $_POST['password']);
  }
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="CSS/index.css?version=9" type="text/css">
  <link rel="stylesheet" href="CSS/login.css?version=4" type="text/css">
  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  <script src="JavaScript/index.js"></script>
</head>
<body>
  <section class="container">
    <section class="content">
      <form action="" method="post" id="registerForm">
        <h1> Register </h1>
        <input name="username" class="input-button" type="text" placeholder="Username" />
        <input name="password" class="input-button" type="text" placeholder="Password" />
        <!-- <input id="DOB" name="DOB" class="input-button" type="date" /> -->
        <input id="submit-button" name="submitButton" class="input-button" type="submit" value="Create Account"/>
        <p> Already have an account? <a href="login.php"> Log in here. </a></p>
      </form>
    </section>
    <section class="page-footer">
        <section id="footer-company-details">
          <h1> The Bridge Inn </h1>
          <p> est 1890 </p>
          <section id="footer-media-links">
            <p class="footer-media-icon"> img </p>
            <p class="footer-media-icon"> img </p>
            <p class="footer-media-icon"> img </p>
            <p class="footer-media-icon"> img </p>
          </section>
        </section>
        <section id="footer-contact-details">
          <section id="footer-company-location">
            <p class="footer-contact-icon"> img </p>
            <section class="footer-icon-text">
              <span> 8 Bridge Street </span>
              Stourport On Severn
            </section>
          </section>
          <section id="footer-company-phone">
            <p class="footer-contact-icon"> img </p>
            <section class="footer-icon-text">
              <p> 01299 123456 </p>
            </section>
          </section>
        </section>
        <section id="footer-company-about">
          <h1> About The Pub </h1>
          <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            Quis commodo odio aenean sed adipiscing diam donec. In cursus 0turpis
            massa tincidunt dui ut ornare lectus. Commodo elit at imperdiet dui. </p>
        </section>
    </section>
  </section>
</body>
</html>
