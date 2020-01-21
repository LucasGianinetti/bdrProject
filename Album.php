<?php
require_once "connexion bbd.php";
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="loginStyle.css">
</head>
<body>
    
    
    
<?php
    $reponse = $bdd->query("SELECT Music.id, title, releaseDate FROM Music INNER JOIN Album ON Album.id = Music.id WHERE Music.id = " . $_GET['id']);
    $ligne = $reponse->fetch();
?>
    <title> <?= $ligne["title"] ?> </title>
    

    
</body>
</html>