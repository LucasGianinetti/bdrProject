
<?php
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

<p>Welcome to index</p>

<a href="index.php?logout=true">Logout</a>