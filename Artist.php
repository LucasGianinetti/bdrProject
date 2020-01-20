<?php
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
    $reponse = $bdd->query("SELECT Person.id, firstname, lastname, stagename, birthdate, biography FROM Person INNER JOIN Artist ON Person.id = Artist.id INNER JOIN Solo ON Solo.id = Person.id WHERE Person.id=" . $_GET['id']);
    $ligne = $reponse->fetch();
    ?>

    <h1> <?= $ligne['stagename'] ?> </h1>
    <h1>Informations: </h1>
    <p> Firstname: <?= $ligne["firstname"] ?> </p>
    <p> Lastname: <?= $ligne["lastname"] ?> </p>
    <p> Birthday: <?= $ligne["birthdate"] ?> </p>
    
    <h1>Biography:</h1>
    <?= $ligne['biography'] ?>
    
    <h1>Ses sons:</h1>
<?php
     
    $reponse = $bdd->query("SELECT Music.id, title FROM Music INNER JOIN Artist ON Artist.id = Music.id WHERE Music.idArtist = " . $_GET['id']);
    while($ligne = $reponse->fetch()){
        ?> 
    <a href="Tracks.php?id=<?= $ligne["id"] ?>"><p><?= $ligne["title"]?></p></a>
        <?php 
    }
    ?>
    

</body>
</html>
