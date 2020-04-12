<?php


 function connexpdo (String $bdd){
	$pass ="LuzEmpire10";
	$sgbd="mysql"; 
	$host="mysql-fol-49.alwaysdata.net";
	$user="fol-49";
 	$pdo = new PDO ("$sgbd:host=$host;dbname=$bdd;charset=utf8",$user,$pass);
 	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $pdo;
 }


?>