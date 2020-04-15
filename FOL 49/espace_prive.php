<?php
	session_start();
	if ($_SESSION['connected'] != true){
		header("Location: ./connexion.php");
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta dir="ltr" lang="fr-FR" charset="utf-8">
	<meta name="viewport" content="width=device=width, initial-scale=1">
	<link rel="icon" href="http://www.fol49.org/laligue49/wp-content/uploads/2016/05/icone-ligue.png" sizes="32x32" />
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	<link rel="stylesheet" type="text/css" href="./CSS/espace_prive.css">
	<title>Mon espace</title>
	
</head>
<body>
<?php include "header.php";?>
<div class="left">
<div class="item">
<span class="glyphicon glyphicon-th-large"><i class="fas fa-user"></i>

	<?php echo $_SESSION['prenom']." ".$_SESSION['nom']?>



</span>
</div>
<div class="item active">
<a href="./espace_prive.php?onglet=1"><span class="glyphicon glyphicon-th-list"><i class="fas fa-file-contract"></i>Mon Contrat</span></a>
 </div>
<div class="item">
<a href="./espace_prive.php?onglet=2"><span class="glyphicon glyphicon-random"><i class="fas fa-calendar-alt"></i></i>Mes horaires</span></a>
    </div>

<div class="item">
<a href="./espace_prive.php?onglet=3"><span class="glyphicon glyphicon-log-out"><i class="fas fa-users"></i>Les Salarié.e.s</span></a>
    </div>
<div class="item">
<a href="./espace_prive.php?onglet=4"><span class="glyphicon glyphicon-log-in"><i class="fas fa-edit"></i>Gerer les contrats</span></a>
    </div> 
<div class="item">
<a href="./espace_prive.php?onglet=5"><span class="glyphicon glyphicon-random"><i class="fas fa-file-signature"></i>Contrat à validez</span></a>
    </div>
 <div class="item">
<a href="./espace_prive.php?onglet=6"><span class="glyphicon glyphicon-random"><i class="fas fa-sign-out-alt"></i>Deconexion</span></a>
    </div>

<div>

	
</div>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>

<?php
$onglet= isset($_GET["onglet"]) ? $_GET["onglet"] : 0;  
if ($onglet==6){
	session_destroy();
	header("Location: ./connexion.php");
}

?>