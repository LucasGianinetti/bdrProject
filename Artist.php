<?php
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css">
</head>
<body class="bg-info">
 
 <a href="Artist.php?logout=true" class="btn btn-primary">Logout</a>    
<a href="Account.php" class="btn btn-primary">Account info</a>
<a href="index.php" class="btn btn-primary">Home</a>    


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
    $reponse = $bdd->query("SELECT music.id, music.title FROM music INNER JOIN track_adaptation ON track_adaptation.idTrack = music.id
    WHERE track_adaptation.idAlbum IS NULL AND music.idArtist =" . $_GET['id']);
    ?>
     <table data-toggle="table" class="bg-light text-dark">
    <thead >
        <th scope="col"> Musics: </th>
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
    <h1>Albums:</h1>
<?php
    $reponse2 = $bdd->query("SELECT Music.id, title FROM Music INNER JOIN Artist ON Artist.id = Music.idArtist INNER JOIN Album ON Album.id = Music.id  WHERE Music.idArtist = " . $_GET['id']);
    ?>
     <table data-toggle="table" class="bg-light text-dark">
    <thead >
        <th scope="col"> Albums : </th>
    </thead>
    <tbody>
    <?php
    while($ligne2 = $reponse2->fetch()){
    ?>
    <tr><td>
    <a href="Album.php?id=<?= $ligne2["id"] ?>"><p><?= $ligne2["title"]?></p></a></td></tr>
        <?php 
    }
    ?>
     </tbody></table>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
</body>
</html>
