<?php
error_reporting(0);
require_once "connexion bbd.php";
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION);
        header("Location: Login.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="loginStyle.css">
</head>
<body>
    
    <a href="Tracks.php?logout=true" class="btn btn-primary">Logout</a>    
    <a href="Account.php" class="btn btn-primary">Account info</a> 
    <a href="index.php" class="btn btn-primary">Home</a>   
    
    
    
<?php
    $id = $_GET['id'];
    $genre = $_GET['genre'];
    $title = $_GET['title'];
    $genre = $_GET['genre'];
    $adaptation = $_GET['adaptation'];
    ?>
    
<?php
    $reponse2 = $bdd->query("SELECT releaseDate, length FROM Track INNER JOIN Track_Adaptation ON Track.id = Track_Adaptation.idTrack INNER JOIN Music ON Music.id = Track.id WHERE Track.id = " . $_GET['id']);
    $ligne2 = $reponse2->fetch();
    ?>
    <h1>Informations:</h1>
    <p>Title: <?= $title ?></p>
    <p>Adaptation: <?=$adaptation?></p>
    <p>Release date : <?=$ligne2["releaseDate"]?></p>
    <p>Length : <?= $ligne2["length"] ?> </p>
    <p>Genre : <?= $genre ?></p>
    
    <h1>Recommendations:</h1>
<?php
    $reponse3 = $bdd->query("SELECT Music.id, Music.title, adaptationName FROM Music INNER JOIN Track ON Track.id = Music.id INNER JOIN Track_Adaptation ON idTrack = Track.id WHERE Music.title = '$title' AND Track_Adaptation.adaptationName != '$adaptation'");
    while($ligne3 = $reponse3->fetch()){
        ?>
            <a href="Tracks.php?id=<?= $ligne3["id"] ?>"><p><?= $ligne3["adaptationName"]?></p></a>
        <?php 
    }
    ?>

<?php
    $reponse4 = $bdd->query("SELECT Music.id, Music.title FROM Music INNER JOIN Track ON Track.id = Music.id INNER JOIN Track_Genre ON Track.id = Track_Genre.idTrack WHERE Music.title != '$title' AND Track_Genre.idGenre = '$genre' LIMIT 3");
    while($ligne4 = $reponse4->fetch()){
        ?>
            <a href="Tracks.php?id=<?= $ligne4["id"] ?>"><p><?= $ligne4["title"]?></p></a>
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
