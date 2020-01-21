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
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="loginStyle.css">
</head>
<body>

    <a href="index.php?logout=true" class="btn btn-primary">Logout</a>    
	<a href="Account.php" class="btn btn-primary">Account info</a>
    <a href="index.php" class="btn btn-primary">Home</a>    


<?php 

	$reponse = $bdd->query("SELECT title FROM Music INNER JOIN Artist ON Artist.id = Music.idArtist INNER JOIN Album ON Album.id = Music.id WHERE Music.id = " .$_GET['id']);
	$ligne = $reponse->fetch();


	$reponse2 = $bdd->query("    SELECT Music.id, title, adaptationName, Track_Genre.idGenre  FROM Music INNER JOIN Track ON Track.id = Music.id INNER JOIN Track_Adaptation ON Track_Adaptation.idTrack = Track.id  INNER JOIN Track_Genre ON Track.id = Track_Genre.idTrack INNER JOIN album ON track_adaptation.idAlbum = album.id WHERE album.id = " . $_GET['id']);
	?>


	<table data-toggle="table" class="bg-light text-dark">
    <thead >
        <th scope="col"> <?= $ligne["title"] ?></th>
    </thead>
    <tbody>
    <?php
    while($ligne2 = $reponse2->fetch()){
    ?>
    <tr><td>
    <a href="Tracks.php?id=<?= $ligne2["id"] ?>"><p><?= $ligne2["title"]?></p></a></td></tr>
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
