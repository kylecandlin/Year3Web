<?php
  require 'Includes/connect.php';
  require 'Includes/Classes.php';
  include 'Includes/sessionStart.php';

  if(isset($_POST['logout'])){
    $user = new User($pdo);
    $user->logout($username);
  }
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <script>
    var username = '<?php echo $username; ?>';
  </script>
  <title>Account</title>
  <link rel="stylesheet" href="CSS/index.css?version=9" type="text/css">
  <link rel="stylesheet" href="CSS/login.css?version=4" type="text/css">
  <link rel="stylesheet" href="CSS/account.css" type="text/css">
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
      <section id="account" class="acc-page">
        <h1>Account</h1>
        <?php
          $acc = new User($pdo);
          $acc->getInfo($_SESSION['username']);
        ?>
        <form action="" method="post">
          <input name="logout" type="submit" value="Logout" />
        </form>
      </section>
      <section id="recipe" class="acc-page">
        <h1>Favourite Recipes</h1>
        <?php
          $rec = new Recipe($pdo);
          $rec->getFav($_SESSION['username']);
        ?>
      </section>
    </section>
    <section class="page-footer">
      <?php require 'Includes/footer.php'; ?>
    </section>
  </section>
</body>
</html>
