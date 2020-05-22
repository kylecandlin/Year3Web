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

        session_start();
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
      }
    }

    public function SignIn($username, $password){
      $sql = "SELECT * FROM Person WHERE Username = :username";
      $stmt = $this->pdo->prepare($sql);

      $stmt->bindValue(':username', $username);

      $stmt->execute();

      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if($user && password_verify($password.$this->salt, $user['Password'])){
        session_start();
        $_SESSION['username'] = $user['Username'];
        header('Location: index.php');
      }
      else {
        echo "<script> alert('Incorrect username or password.') </script>";
      }
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
      $sql = "SELECT * FROM recipe ORDER BY $orderBy ASC";
      $stmt = $this->pdo->prepare($sql);

      $stmt->execute();

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<a id=".$row['RecipeID']." class='clickable'>";
        echo "<section class='info-container'>";
        echo "<img src='CSS/Images/ramen.jpg' class='info-container-image' />";
        echo "<h1 class='info-container-header'>".$row['Name']."</h1>";
        echo "<p class='info-container-text'>This recipe serves ".$row['Serving']." people. </p></section></a>";
      }
    }

    function showSingle($ID){
      $sql = "SELECT * FROM recipe WHERE ID = $ID";
      $stmt = $this->pdo->prepare($sql);

      $stmt->execute();

      $recipe = $stmt->fetch(PDO::FETCH_ASSOC);
      echo "<h1>".$recipe['Name']."</h1>";
    }
  }
?>
