<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="loginStyle.css">
</head>
<body>

<h1>Results : </h1>


<?php
error_reporting(0);
require_once "connexion bbd.php";
    if(isset($_GET['keywords']) && isset($_GET['field'])) {
      $keywords = $bdd->quote($_GET['keywords']);
      $field = $_GET['field'];
        
        switch($field){
            case "artist":
                $reponse = $bdd->query("SELECT id, stagename FROM Artist WHERE Artist.stagename= " . $keywords);
                $ligne = $reponse->fetch();
                if (empty($ligne)) { 
                    echo 'No results found'; 
                }
                ?> 
                <a href="Artist.php?id=<?= $ligne["id"] ?>"><p><?= $ligne["stagename"]?></p></a>
                <?php  
                break;
            case "title":
                $reponse = $bdd->query("SELECT id, title FROM Music WHERE Music.title= " . $keywords);
                $ligne = $reponse->fetch();
                if (empty($ligne)) { 
                    echo 'No results found'; 
                }
                ?> 
                <a href="Tracks.php?id=<?= $ligne["id"] ?>"><p><?= $ligne["title"]?></p></a>
                <?php 
                break;
            case "album":
                $reponse = $bdd->query("SELECT Music.id, title, releaseDate FROM Music INNER JOIN Album ON Music.id = Album.id WHERE Music.title= " . $keywords);
                $ligne = $reponse->fetch();
                if (empty($ligne)) { 
                    echo 'No results found'; 
                }
                ?> 
                <a href="Tracks.php?id=<?= $ligne["id"] ?>"><p><?= $ligne["title"]?></p></a>
                <?php  
                break;
        }
    }
?>
    
</body>
</html>