<?php
require_once "connexion bbd.php";
session_start();
    if(!isset($_SESSION['userlogin'])){
        header("Location: Login.php");
    }
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION);
        header("Location: Login.php");
    }if(isset($_GET['account'])){
        header("Location: Account.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="loginStyle.css">
</head>
<body>


<a href="index.php?logout=true" class="btn btn-primary">Logout</a>    
<a href="Account.php" class="btn btn-primary">Account info</a>
    
    
<form style="text-align:center;" method="get" action="search.php">
  <label>
    Search
    <input type="text"name="keywords" autocomplete="on">
  </label>
<select name="field">
  <option value="title">title</option>
  <option value="artist">artist</option>
  <option value="album">album</option>
</select>

  <input type="submit" value="Search"><br>
</form>
    
</body>
</html>
