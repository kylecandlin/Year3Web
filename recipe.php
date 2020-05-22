<?php
  require 'Includes/connect.php';
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Recipe List</title>
  <link rel="stylesheet" href="CSS/index.css?version=12" type="text/css">
  <link rel="stylesheet" href="CSS/recipe.css?version=3" type="text/css">
  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  <script src="Includes/index.js"></script>
  <script src="Includes/recipe.js"></script>
</head>
<body>
  <section class="container">
    <section class="top-container">
      <?php
        require 'Includes/navigationPanel.php';
      ?>
    </section>
    <section class="content">
      <section id="list">
        <p id="filter-title">Order by</p>
        <select id="orderBy">
          <option selected="selected">Name</option>
          <option>Serving</option>
          <option value="FoodTypeID">Type</option>
        </select>
      </section>
      <section id="single">
      </section>
    </section>
    <section class="page-footer">
      <?php require 'Includes/footer.php'; ?>
    </section>
  </section>
</body>
</html>
