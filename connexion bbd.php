<?php
try
{
	$bdd = new PDO('mysql:host=127.0.0.1:3306;dbname=project;charset=utf8', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>