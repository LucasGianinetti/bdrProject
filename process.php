<?php
require_once "connexion bbd.php";
?>

<?php

    if(isset($_POST)){
        
        $pseudo = $_POST['pseudo'];
        $password   = $_POST["password"];
        $firstName   = $_POST["firstName"]; 
        $lastName   = $_POST["lastName"];
        $birthDate   = $_POST["birthDate"];
    
        
        $sql =" BEGIN;
                INSERT INTO Person(lastname,firstname,birthdate) VALUES(?,?,?);
                INSERT INTO Customer(id,username,pwd) VALUES(LAST_INSERT_ID(),?,?);
                COMMIT;";
        $stmtinsert = $bdd->prepare($sql);
        $result = $stmtinsert->execute([$lastName,$firstName,$birthDate,$pseudo,$password]);
        if($result){
            echo 'Successfully saved.';
        }else{
            echo 'There were errors while saving your data.';
        }
        
    }else{
        echo 'No data';
    }

?>
