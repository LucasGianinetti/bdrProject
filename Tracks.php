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
    $reponse2 = $bdd->query("SELECT idTrack, link FROM LinkTrack INNER JOIN Track ON Track.id = idTrack WHERE idTrack = " . $_GET['id']);
    $ligne = $reponse2->fetch();
?>
    
<?php
    $reponse3 = $bdd->query("SELECT Track.id, length, releaseDate, Adaptation.adaptationName FROM Track INNER JOIN Track_Adaptation ON Track.id = Track_Adaptation.idTrack INNER JOIN Adaptation ON Track_Adaptation.adaptationName = Adaptation.adaptationName WHERE Track.id = " . $_GET['id']);
    $ligne3 = $reponse3->fetch();
    ?>
    <h1>Informations:</h1>
    <p>Adaptation: <?=$ligne3["adaptationName"]?></p>
    <p>Release date : <?=$ligne3["releaseDate"]?></p>
    <p>Durée: <?= $ligne3["length"] ?> </p>
    
    

    
</body>
</html>
