<?php
require_once "connexion bbd.php";
?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Frontpage</title>
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