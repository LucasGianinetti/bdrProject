<?php
require_once "connexion bbd.php";
?>



















<?php
    $reponse2 = $bdd->query("SELECT firstname, lastname, birthdate, Person.id FROM Person INNER JOIN Artist ON Artist.id = Person.id WHERE Artist.id = " .$_GET['id']);
    $ligne = $reponse2->fetch();
?>
    
    <h1>Informations:</h1>
    <p>Nom: <?= $ligne["lastname"]?> </p>
    <p>Prenom: <?= $ligne["firstname"]?> </p>
    <p>Année de naissance: <?= $ligne["birthdate"]?> </p>
    
    <h1>Ses sons:</h1>
<?php
     
    $reponse = $bdd->query("SELECT Music.id, title FROM Music INNER JOIN Artist ON Artist.id = Music.id WHERE Music.idArtist = " . $_GET['id']);
    while($ligne = $reponse->fetch()){
        ?> 
    <a href="Tracks.php?id=<?= $ligne["id"] ?>"><p><?= $ligne["title"]?></p></a>
        <?php 
    }
    ?>

    
</body>

</html>