<?php
require_once "connexion bbd.php";
session_start();
    if(!isset($_SESSION['userlogin'])){
        header("Location: Login.php");
    }
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


<a href="index.php?logout=true" class="btn btn-primary">Logout</a>    
<a href="Account.php" class="btn btn-primary">Account info</a>
    
    
<form style="text-align:center;" method="get" action="search.php">
  <label>
    Search
    <input type="text"name="keywords" autocomplete="on">
  </label>
<select name="field">
  <option value="title">title</option>
  <option value="artist">artist</option>
  <option value="album">album</option>
</select>

  <input type="submit" value="Search"><br>
</form>

<?php 
  $reponse = $bdd->query("SELECT music.id, music.title FROM music INNER JOIN track_adaptation ON track_adaptation.idTrack = music.id
    ORDER BY releaseDate DESC LIMIT 10");
  ?>



  <table data-toggle="table" class="bg-light text-dark">
    <thead >
        <th scope="col"> New musics ! :</th>
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
    
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
    
</body>
</html>
