<?php
session_start();
require_once "connexion bbd.php";
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION);
        header("Location: Login.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="loginStyle.css">
</head>
<body>
<a href="account.php?logout=true" class="btn btn-primary">Logout</a>    
<a href="index.php" class="btn btn-primary">Home</a>    

    
    
<?php
    $idCustomer = $_SESSION['userlogin']['id'];
    $usernameCustomer = $_SESSION['userlogin']['username'];
    $reponse = $bdd->query("SELECT firstname, lastname, birthdate FROM Person INNER JOIN Customer ON Customer.id = Person.id WHERE Person.id=" . $idCustomer);
    $ligne = $reponse->fetch();
?>
    <h1>Account from  <?= $usernameCustomer ?> </h1>
    <p> Firstname: <?= $ligne["firstname"] ?> </p>
    <p> Lastname: <?= $ligne["lastname"] ?> </p>
    <p> Birth date: <?= $ligne["birthdate"] ?> </p>
    

    
    
    
    </body>
</html>
