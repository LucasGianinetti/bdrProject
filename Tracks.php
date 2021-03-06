<?php
session_start();
require_once "connexion bbd.php";
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION);
        header("Location: Login.php");
    }if(isset($_POST['like'])){  
                   $idUser = $_SESSION['userlogin']['id'];
                    $idMusic = $_GET['id'];
                   $sql = "INSERT INTO Customer_Music (idUser, idMusic)
                            VALUES(?,?);";
                    $stmtinsert = $bdd->prepare($sql);
                    $result = $stmtinsert->execute([$idUser,$idMusic]);
        }
        if(isset($_POST['dislike'])){
                    $idUser = $_SESSION['userlogin']['id'];
                    $idMusic = $_GET['id'];
                    $sql = "DELETE FROM Customer_Music WHERE idUser ='$idUser' AND idMusic ='$idMusic'";
                    $bdd->exec($sql);
    }

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="loginStyle.css">

        <script src="jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
    
    
    
    <h1><?=$title?></h1>
    
<?php
    $reponse2 = $bdd->query("SELECT releaseDate, length, stagename, Artist.id FROM Track INNER JOIN Track_Adaptation ON Track.id = Track_Adaptation.idTrack INNER JOIN Music ON Music.id = Track.id INNER JOIN Artist ON Artist.id = Music.idArtist WHERE Track.id = " . $_GET['id']);
    $ligne2 = $reponse2->fetch();
    ?>
    <h1>Informations:</h1>
    <p>Title: <?= $title ?></p>
    <p>Adaptation: <?=$adaptation?></p>
    <p>Release date : <?=$ligne2["releaseDate"]?></p>
    <p>Length : <?= $ligne2["length"] ?> </p>
    <p>Artist : <a href="Artist.php?id=<?= $ligne2["id"] ?>"><?= $ligne2["stagename"]?></a>
    <p>Genre : <?= $genre ?></p>

<form method="post">
<input type="submit" class="button" name="like" value="like" />
<input type="submit" class="button" name="dislike" value="dislike" />
</form>
    <h1>Recommendations:</h1>
<?php
    $reponse3 = $bdd->query("SELECT Music.id, title, adaptationName, Track_Genre.idGenre  FROM Music INNER JOIN Track ON Track.id = Music.id INNER JOIN Track_Adaptation ON Track_Adaptation.idTrack = Track.id  INNER JOIN Track_Genre ON Track.id = Track_Genre.idTrack WHERE Music.title = '$title' AND Track_Adaptation.adaptationName != '$adaptation'");
    while($ligne3 = $reponse3->fetch()){
        ?>
           <a href="Tracks.php?id=<?= $ligne3["id"] ?>&title=<?= $ligne3["title"]?>&adaptation=<?= $ligne3["adaptationName"]?>&genre=<?= $ligne3["idGenre"]?>"><p><?= $ligne3["title"]?> (<?= $ligne3["adaptationName"]?>)</p></a>
        <?php 
    }
    ?>

<?php
    $reponse4 = $bdd->query("SELECT Music.id, title, adaptationName, Track_Genre.idGenre  FROM Music INNER JOIN Track ON Track.id = Music.id INNER JOIN Track_Adaptation ON Track_Adaptation.idTrack = Track.id  INNER JOIN Track_Genre ON Track.id = Track_Genre.idTrack WHERE Music.title != '$title' AND Track_Genre.idGenre = '$genre' ORDER BY rand() LIMIT 4");
    while($ligne4 = $reponse4->fetch()){
        ?>
           <a href="Tracks.php?id=<?= $ligne4["id"] ?>&title=<?= $ligne4["title"]?>&adaptation=<?= $ligne4["adaptationName"]?>&genre=<?= $ligne4["idGenre"]?>"><p><?= $ligne4["title"]?>
               
           <?php
            if($ligne4["adaptationName"] != "Original"){
                ?>
                    (<?=$ligne4["adaptationName"]?>)
            <?php
                } 
            ?>
               
               </p></a>
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
