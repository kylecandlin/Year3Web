<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <link rel="stylesheet" href="CSS/index.css?version=20" type="text/css">
  <link rel="stylesheet" href="CSS/home.css?version=4" type="text/css">
  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  <script src="Includes/index.js"></script>
</head>
<body>
  <section class="container">
    <section class="top-container">
      <?php require 'Includes/navigationPanel.php'; ?>
      <section class="header-content">
        <h1 id="pub-title-header"> Recipes R Us </h1>
      </section>
    </section>
    <section class="content">
      <section class="info-container">
        <img src="CSS/Images/pizza.jpg" class="info-container-image" />
        <h1 class="info-container-header"> This is a Test </h1>
        <p class="info-container-text"> This is to help me style this box. </p>
      </section>
      <section class="info-container">
        <img src="CSS/Images/pizza.jpg" class="info-container-image" />
        <h1 class="info-container-header"> This is a Test </h1>
        <p class="info-container-text"> This is to help me style this box. </p>
      </section>
      <section class="info-container">
        <img src="CSS/Images/pizza.jpg" class="info-container-image" />
        <h1 class="info-container-header"> This is a Test </h1>
        <p class="info-container-text"> This is to help me style this box. </p>
      </section>
    </section>
    <section class="page-footer">
      <?php require 'Includes/footer.php'; ?>
    </section>
  </section>
</body>
</html>
