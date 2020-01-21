<?php
error_reporting(0);
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
    $reponse1 = $bdd->query("SELECT Adaptation.adaptationName FROM Track INNER JOIN Track_Adaptation ON Track.id = Track_Adaptation.idTrack INNER JOIN Adaptation ON Track_Adaptation.adaptationName = Adaptation.adaptationName WHERE Track.id = " . $_GET['id']);
    $ligne1 = $reponse1->fetch();
    ?>
<?php
    $reponse2 = $bdd->query("SELECT releaseDate, length, title FROM Track INNER JOIN Track_Adaptation ON Track.id = Track_Adaptation.idTrack INNER JOIN Music ON Music.id = Track.id WHERE Track.id = " . $_GET['id']);
    $ligne2 = $reponse2->fetch();
    ?>
    <h1>Informations:</h1>
    <p>Title: <?=$ligne2["title"]?></p>
    <p>Adaptation: <?=$ligne1["adaptationName"]?></p>
    <p>Release date : <?=$ligne2["releaseDate"]?></p>
    <p>Durée: <?= $ligne2["length"] ?> </p>
    
    <h1>Recommendations:</h1>
<?php
    $reponse3 = $bdd->query("SELECT Track.id, Music.title FROM Track INNER JOIN Music ON Music.id = Track.id INNER JOIN Track_Genre ON Track.id = Track_Genre.idTrack INNER JOIN Genre ON Track_Genre.idGenre = Genre.label WHERE Track.id =" . $_GET['id']);
    while($ligne3 = $reponse3->fetch()){
        ?>
        <a href="Tracks.php?id=<?= $ligne3["id"] ?>"><p><?= $ligne3["title"]?> </p></a>
        <?php
    }
    ?>
    
<?php
    $reponse = $bdd->query("SELECT idTrack, link FROM LinkTrack INNER JOIN Track ON Track.id = idTrack WHERE idTrack =" . $_GET['id']);
    
    while($ligne = $reponse->fetch()){
        ?>
        <iframe src= "<?= $ligne["link"]?>" width="100%"></iframe>
        <?php
    }
    ?>

    
</body>
</html>
