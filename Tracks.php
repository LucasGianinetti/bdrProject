<?php
require_once "connexion bbd.php";
?>










    
    
    
<?php
    $reponse2 = $bdd->query("SELECT idTrack, link FROM LinkTrack INNER JOIN Track ON Track.id = idTrack WHERE idTrack = " . $_GET['id']);

    $ligne = $reponse2->fetch();
?>
    
    <iframe src= "<?= $ligne["link"]?>" width="100%">
    </iframe>

    
    
    <?php
    $reponse = $bdd->query("SELECT Track.id, Track.length FROM Track INNER JOIN Music ON Music.id = Track.id WHERE Track.id = " . $_GET['id']);
    $ligne = $reponse->fetch();
    ?>
<p>Durée: <?= $ligne["length"] ?> </p> </a>
    
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span>
    

    
</body>

</html>