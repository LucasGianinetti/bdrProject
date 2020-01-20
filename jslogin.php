<?php
session_start();
require_once "connexion bbd.php";


$username = $_POST['username'];
$password      = $_POST['password'];


$sql = "SELECT * FROM Customer WHERE username = ? AND pwd = ? LIMIT 1";
$stmtselect = $bdd->prepare($sql);
$result = $stmtselect->execute([$username, $password]);

if($result){
    $user = $stmtselect->fetch(PDO::FETCH_ASSOC);
    if($stmtselect->rowCount() > 0){
        $_SESSION['userlogin'] = $user;
        echo '1';
    }else{
        echo 'There no user for that combo';
    }
}else{
    echo 'There were errors while connecting to database';
}



?>