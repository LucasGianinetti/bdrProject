<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css">
  </head>
<body class="bg-info">

<a href="search.php?logout=true" class="btn btn-primary">Logout</a>    
<a href="Account.php" class="btn btn-primary">Account info</a>
<a href="index.php" class="btn btn-primary">Home</a>    


<h1>Results : </h1>


<?php
error_reporting(0);
require_once "connexion bbd.php";
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION);
        header("Location: Login.php");
    }


    if(isset($_GET['keywords']) && isset($_GET['field'])) {
      $keywords = $bdd->quote($_GET['keywords']);
      $keywords = str_replace("'","",$keywords);
      $field = $_GET['field'];
        
        switch($field){
            case "artist":
                $reponse = $bdd->query("SELECT id, stagename FROM Artist WHERE Artist.stagename LIKE '%$keywords%' ");
                ?>
                <table data-toggle="table" class="bg-light text-dark">
                <thead >
                    <th> Stage name : </th>
                </thead>
                <tbody>
                <?php   
                while($ligne = $reponse->fetch()){
                    ?>
                <tr> <td>   
                <a href="Artist.php?id=<?= $ligne["id"] ?>"><p><?= $ligne["stagename"]?></p></a></td></tr>
                <?php
                }
                ?>
            </tbody></table>
                <?php
                  
                break;
            case "title":
                $reponse = $bdd->query("SELECT id, title FROM Music WHERE Music.title LIKE '%$keywords%'");
                ?>
                 <table data-toggle="table" class="bg-light text-dark">
                <thead >
                    <th scope="col"> Music Title : </th>
                </thead>
                <tbody>
                <?php
                while($ligne = $reponse->fetch()){
                ?>
                <tr><td>
                <a href="Tracks.php?id=<?= $ligne["id"] ?>"><p><?= $ligne["title"]?></p></a></td></tr>
                <?php 
                }
                ?>
            </tbody></table>
            <?php
                break;
            case "album":
                $reponse = $bdd->query("SELECT Music.id, title, releaseDate FROM Music INNER JOIN Album ON Music.id = Album.id WHERE Music.title LIKE '%$keywords%'");
                 ?>
                <table data-toggle="table" class="bg-light text-dark">
                <thead >
                    <th scope="col"> Album title : </th>
                </thead>
                <tbody>
                <?php  
                while($ligne = $reponse->fetch()){
                    ?>
                    <tr><td>
                <a href="Tracks.php?id=<?= $ligne["id"] ?>"><p><?= $ligne["title"]?></p></a></td></tr>
                <?php
                }
                ?>
            </tbody></table>
            <?php
                break;
        }
    }
?>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
  </body>
</html>
