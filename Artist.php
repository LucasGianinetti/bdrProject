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
    
    <h1>Songs:</h1>
<?php
    $reponse = $bdd->query("SELECT Music.id, title FROM Music INNER JOIN Artist ON Artist.id = Music.id INNER JOIN Track ON Track.id = Music.id INNER JOIN Track_Adaptation ON Track.id = Track_Adaptation.idTrack WHERE Music.idArtist = " . $_GET['id']);
    while($ligne = $reponse->fetch()){
        ?> 
    <a href="Tracks.php?id=<?= $ligne["id"] ?>"><p><?= $ligne["title"]?></p></a>
        <?php 
    }
    ?>
    <h1>Albums:</h1>
<?php
    $reponse2 = $bdd->query("SELECT Music.id, title FROM Music INNER JOIN Artist ON Artist.id = Music.id INNER JOIN Album ON Album.id = Music.id WHERE Music.idArtist = " . $_GET['id']);
    while($ligne2 = $reponse2->fetch()){
        ?> 
    <a href="Album.php?id=<?= $ligne2["id"] ?>"><p><?= $ligne2["title"]?></p></a>
        <?php 
    }
    ?>
     

</body>
</html>
