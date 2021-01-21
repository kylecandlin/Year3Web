<?php
  require 'Includes/connect.php';
  include 'Includes/sessionStart.php';
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script>
    var username = '<?php echo $username; ?>';
  </script>
  <title>Recipe List</title>
  <link rel="stylesheet" href="CSS/index.css?version=12" type="text/css">
  <link rel="stylesheet" href="CSS/recipe.css?version=5" type="text/css">
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
        <input id="fav" type="button" value="Favourite" class="submit-button">
      </section>
    </section>
    <section class="page-footer">
      <?php require 'Includes/footer.php'; ?>
    </section>
  </section>
</body>
</html>
