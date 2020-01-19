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
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>   
    
    
<h1>List of artist:</h1>
<?php

    $reponse = $bdd->query("SELECT stageName, id FROM Artist");
    while($ligne = $reponse->fetch()){
        ?> 
        <a href="Music_Person.php?id=<?= $ligne["id"] ?> "><p> <?= $ligne["stageName"]?> </p>
    </a>
    
    
    
        <?php 
    }
    ?>

</body>

</html>