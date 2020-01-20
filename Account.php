<?php
session_start();
require_once "connexion bbd.php";
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="loginStyle.css">
</head>
<body>
    
    
    
<?php
    $idCustomer = $_SESSION['userlogin']['id'];
    $usernameCustomer = $_SESSION['userlogin']['username'];
    $reponse = $bdd->query("SELECT firstname, lastname, birthdate FROM Person INNER JOIN Customer ON Customer.id = Person.id WHERE Person.id=" . $idCustomer);
    $ligne = $reponse->fetch();
?>
    <h1>Account from  <?= $usernameCustomer ?> </h1>
    <p> Firstname: <?= $ligne["firstname"] ?> </p>
    <p> Lastname: <?= $ligne["lastname"] ?> </p>
    <p> Birthday: <?= $ligne["birthdate"] ?> </p>
    

    
    
    
    </body>
</html>
    
    