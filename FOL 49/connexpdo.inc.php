<?php


 function connexpdo (String $bdd){
	$pass ="LuzEmpire10";
	$sgbd="pgsql"; 
	$host="postgresql-fol-49.alwaysdata.net";
	$user="fol-49";
 	$pdo = new PDO ("$sgbd:host=$host;dbname=$bdd;",$user,$pass);
 	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $pdo;
 }


?>