<?php
  require 'connect.php';

  /**
  * Uses 'isset' to determine which function was called by jQuery AJAX
  */
  // AJAX call for recipe.showAll
  if(isset($_POST['callShowAll'])){
    $var = new Recipe($pdo);
    $var->showAll($_POST['callShowAll']);
  }

  // AJAX call for recipe.showSingle
  if(isset($_POST['callShowSingle'])){
    $var = new Recipe($pdo);
    $var->showSingle($_POST['callShowSingle']);
  }

  // AJAX call for recipe.addFav
  if(isset($_POST['callAddFav'])){
    $var = new Recipe($pdo);
    $output = $var->addFav($_POST['callAddFav']);

    // output
    echo $output;
  }

  /**
  * Class that defines user functions
  */
  class User {
    protected $pdo = null;
    protected $salt = "NS{3c (RJuAtIF;*e,ol@AtjUT+^+;qHxcQd~HVCr[m},JwH&+%AhinWie@*7[V`t|#MN";

    // Constructor
    public function __construct($pdo){
      $this->pdo = $pdo;
    }

    // Creates user using html form
    public function CreateUser($username, $password){
      // password hashing
      $options = [
        'cost' => 14,
      ];
      $passwordHash = password_hash($password.$this->salt, PASSWORD_BCRYPT, $options);

      // SQL query
      $sql = "SELECT * FROM Person WHERE Username = :username";
      $stmt = $this->pdo->prepare($sql);

      $stmt->bindValue(':username', $username);

      $stmt->execute();

      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if($user){
        echo "<script> alert('Sorry, that user already exists.')</script>";
      }
      else {
        $sqlInsert = "INSERT INTO Person(Username, Password) VALUES('$username', '$passwordHash')";
        $stmt = $this->pdo->prepare($sqlInsert);

        $stmt->execute();

        $_SESSION['username'] = $username;
        header('Location: index.php');
      }
    }

    // Signs user in
    public function SignIn($username, $password){
      $sql = "SELECT * FROM Person WHERE Username = :username";
      $stmt = $this->pdo->prepare($sql);

      $stmt->bindValue(':username', $username);

      $stmt->execute();

      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      // If user exists and password is correct, sign in and redirect to index.php
      if($user && password_verify($password.$this->salt, $user['Password'])){
        session_start();
        $_SESSION['username'] = $user['Username'];
        header('Location: index.php');
      }
      else {
        echo "<script> alert('Incorrect username or password.') </script>";
      }
    }

    // Gets all account information and displays in table
    function getInfo($username){
      $sql = "SELECT * FROM Person WHERE Username = :username";
      $stmt = $this->pdo->prepare($sql);

      $stmt->bindvalue(':username', $username);

      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // Echo table displaying information
      echo "<table>";
      echo "<tr><th> ID </th><td>".$row['PersonID']."</td></tr>";
      echo "<tr><th> Username </th><td>".$row['Username']."</td></tr>";
      echo "</table>";
    }

    // logout and redirect to home page
    function logout($username){
      unset($_SESSION['username']);
      header('location: index.php');
    }
  }

  /**
   * Defines functions used to interact with recipes
   */
  class Recipe
  {
    protected $pdo = null;

    function __construct($pdo)
    {
      $this->pdo = $pdo;
    }

    function showAll($orderBy){
      $sql = "SELECT Recipe.RecipeID, Recipe.Name as rName, Recipe.Serving, Recipe.FoodTypeID, FoodType.Name as ftName
              FROM Recipe
              INNER JOIN FoodType USING(FoodTypeID)
              ORDER BY Recipe.$orderBy ASC";
      $stmt = $this->pdo->prepare($sql);

      $stmt->execute();

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<section id=".$row['RecipeID']." class='info-container'>";
        echo "<img src='CSS/Images/ramen.jpg' class='info-container-image' />";
        echo "<h1 class='info-container-header'>".$row['rName']."</h1>";
        echo "<p class='info-container-text'>This recipe serves ".$row['Serving']." people. </p>";
        echo "<p class='info-container-text'>".$row['ftName']."</p></section>";
      }
    }

    // Outputs all details for a single recipe
    function showSingle($ID){

      // prepare SQL to join tables and retrieve recipe
      $sql = "SELECT recipe.Name as rName, recipe.Serving, ingredient.Name as iName, foodtype.Name as ftName, instructionlist.*, instruction.Details as iDetails
              FROM recipe
              INNER JOIN ingredient USING(IngredientID)
              INNER JOIN foodtype USING(FoodTypeID)
              INNER JOIN instructionList USING(RecipeID)
              INNER JOIN instruction USING(InstructionID)
              WHERE RecipeID = $ID";
      $stmt = $this->pdo->prepare($sql);

      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      // Output recipe details
      echo "<h1>".$row['rName']."</h1>";
      echo "<h1>".$row['Serving']."</h1>";
      echo "<h1>".$row['ftName']."</h1>";

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // Amend DB to include link table and do below
        echo "<h1>".$row['iName']."</h1>";

        // Put in while loop and table to show multiple table rows
        echo "<h1>".$row['iDetails']."</h1>";
      }
    }

    function addFav($RecipeID){
      $ID = $this->getIdFromUser($_SESSION['username']);

      try {
        $sql = "INSERT INTO AccFav(PersonID, RecipeID) VALUES('$ID', '$RecipeID')";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return "Added to Favourites";
      }
      catch (PDOException $e) {
        return $e;
      }
    }

    function delFav($RecipeID){
      $ID = $this->getIdFromUser($_SESSION['username']);

      try {
        $sql = "INSERT INTO AccFav(PersonID, RecipeID) VALUES('$ID', '$RecipeID')";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return "Added to Favourites";
      }
      catch (PDOException $e) {
        return $e;
      }
    }

    function getFav($username){
      $ID = $this->getIdFromUser($username);

      $sql = "SELECT Recipe.RecipeID, Recipe.Name, Recipe.Serving
              FROM Recipe
              INNER JOIN AccFav ON Recipe.RecipeID = AccFav.RecipeID
              INNER JOIN Person ON AccFav.PersonID = Person.PersonID
              WHERE Person.Username = :username";
      $stmt = $this->pdo->prepare($sql);

      $stmt->bindValue(':username', $username);

      $stmt->execute();

      echo "<table>
            <tr><th>Name</th><th>Serving</th></tr>";

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>";
        echo "<td>".$row['Name']."</td>";
        echo "<td>".$row['Serving']."</td>";
        echo "<td> Full recipe </td>";
        echo "</tr>";
      }

      echo "</table>";
    }

    function getIdFromUser($username){
      $sql = "SELECT PersonID
              FROM Person
              WHERE Username = :username";
      $stmt = $this->pdo->prepare($sql);

      $stmt->bindValue(':username', $username);

      $stmt->execute();

      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      $ID = $user['PersonID'];
      return $ID;
    }
  }
?>
