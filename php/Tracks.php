<?php
require_once "connexion bbd.php";
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webapp</title>
	<meta name="Author" content=""/>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .checked {
            color:orange;
        }
    </style>
</head>
<body>   
    
    <?php
        $reponse2 = $bdd->query("SELECT idTrack, link FROM LinkTrack INNER JOIN Track ON Track.id = idTrack WHERE idTrack = " . $_GET['id']);
    
        $ligne = $reponse2->fetch();
    ?>
    
    <iframe src= "<?= $ligne["link"]?>" width="100%">
    </iframe>

    
    
    <?php
    $reponse = $bdd->query("SELECT Track.id, Track.length FROM Track INNER JOIN Music ON Music.id = Track.id WHERE Track.id = " . $_GET['id']);
    $ligne = $reponse->fetch();
    ?>
<p>Durée: <?= $ligne["length"] ?> </p> </a>
    
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span>
    

    
</body>

</html>