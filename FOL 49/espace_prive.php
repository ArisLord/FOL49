<?php
	session_start();
	if ($_SESSION['connected'] != true){
		header("Location: ./index.php");
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
	<link rel="stylesheet" type="text/css" href="./CSS/calendrier.css">
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
<a href="./espace_prive.php?onglet=3"><span class="glyphicon glyphicon-random"><i class="fas fa-calendar-check"></i>Gestion des Horaires</span></a>
</div>

<div class="item">
<a href="./espace_prive.php?onglet=4"><span class="glyphicon glyphicon-log-out"><i class="fas fa-users"></i>Les Salarié.e.s</span></a>
    </div>
<div class="item">
<a href="./espace_prive.php?onglet=5"><span class="glyphicon glyphicon-log-in"><i class="fas fa-edit"></i>Gerer les contrats</span></a>
    </div> 
<div class="item">
<a href="./espace_prive.php?onglet=6"><span class="glyphicon glyphicon-random"><i class="fas fa-file-signature"></i>Contrat à validez</span></a>
    </div>
 <div class="item">
<a href="./espace_prive.php?onglet=7"><span class="glyphicon glyphicon-random"><i class="fas fa-sign-out-alt"></i>Deconexion</span></a>
    </div>

<div >
	
</div>
</div>
<?php
	
		$onglet= isset($_GET["onglet"]) ? $_GET["onglet"] : 0;  
		if($onglet==1){
			include 'connexpdo.inc.php';
		
			$pdo = connexpdo("fol-49_postgres");
			$query = "SELECT C.type_contrat,C.date_embauche,C.classification,C.groupe,C.coefficient,C.fonction,C.fonction,C.lieu_travail,(C.cdd).type_cdd,(C.cdd).motif,((C.cdd).personne_remplace).nom,((C.cdd).personne_remplace).prenom,(C.cdd).date_debut,(C.cdd).date_fin,(C.cdi).volume_hebdo,(C.cdi).Volume_horaire_vacances FROM CONTRAT C WHERE (C.salarie).num_secu = '$_SESSION[num_secu]'";
        	
        	$stt=$pdo->query($query);
   			echo "<table>";
	        while($donne=$stt->fetch(PDO::FETCH_ASSOC))
	        {
	      		echo "<fieldset>";

	      		echo "<tr> <td>Nom: <b><i>$_SESSION[nom]</b></i></td>  <td>Prénom: <b><i>$_SESSION[prenom]</b></i></td></tr>";
	      		echo "<tr> <td>Numéro de sécurité sociale:</td> <td><b><i>$_SESSION[num_secu]</b></i></td></tr>";
	      		echo "<tr> <td>Type de contrat: <b><i>$donne[type_contrat]</b></i></td> <td>Date d'embauche : <b><i>$donne[date_embauche]<b><i></td></tr>";
	      		echo "<tr> <td>Groupe: <b><i>$donne[groupe]</b></i></td><td>Classification : <b><i>$donne[classification]</b></i></td> <td>coefficient : <b><i>$donne[coefficient]</b></i></td><td>Fonction : <b><i>$donne[fonction]</b></i></td></tr>";
	      		if ($donne["type_contrat"]=="CDD") {

	      			echo "<tr> <td>Type CDD: <b><i>$donne[type_cdd]</b></i></td><td>Motif: <b><i>$donne[motif]</b></i></td></tr>";
	      		
		      		if ($donne["motif"]=="Remplacement"){

		      			echo "<tr><td>Peronne remplacée : <b><i>$donne[prenom] $donne[nom]</b></i></td></tr>";
		      		}
		      		echo "<tr> <td>Début du contrat: <b><i>$donne[date_debut]</b></i></td><td>Fin de contrat: <b><i>$donne[date_fin]</b></i></td></tr>";
		      	}
		      	elseif ($donne["type_contrat"]=="CDI") {
		      		echo "<tr> <td>Volume horaire Hebdomadaire: <b><i> $donne[volume_hebdo]</b></i></td></tr>";
		      		echo "<tr> <td>Volume horaire période scolaire: <b><i> $donne[Volume_horaire_vacances]</b></i></td></tr>";


		      	}
		      	elseif ($donne["type_contrat"]=="CDII") {
		      		//avoir plutard		
		      	}


	      		
	      		echo "</fieldset>"; 	
	         }
	        echo "</table>";


		}
		elseif ($onglet==2) {
			
			include 'calendrier_annuel.php';


		}
		elseif ($onglet==3) {
			include 'connexpdo.inc.php';
			echo "<h1>Salarié.e en attente de planning :</h1> <br />";
			$pdo = connexpdo("fol-49_postgres");
			$query = "SELECT C.nom,C.prenom,C.num_secu FROM SALARIE C WHERE (SELECT (S.salarie).num_secu FROM HORAIRE_SEMAINE S WHERE (S.salarie).num_secu= C.num_secu ) IS NULL";
        	$stt=$pdo->query($query);
   			$color=["#A9A9A9","#F8F8FF"];
   			$i=2;
   			echo "<table>";
	        while($donne=$stt->fetch(PDO::FETCH_ASSOC))
	        {
	        	$j=$i%2;
	            echo "<tr style=\"background-color: $color[$j]; width: 100%;\" ><td><h3 style=\"padding : 10px 10px 10px 10px;\" >$donne[prenom] $donne[nom] $donne[num_secu]</h3></td><td> <a href=\"./gestion_edt.php?nom=$donne[nom]&prenom=$donne[prenom]&secu=$donne[num_secu]\"> <button style=\"padding : 10px 10px 10px 10px;\" name=\"submit\" class=\"edt btn btn-success\" ><i class=\"far fa-edit\"></i></button></a> </td> </tr>";
	            ++$i;
	        }
	        echo "</table>";



		}
		elseif ($onglet==4) {
			echo "<table>";
			echo "<td><a href=\"./renseignement.php\"><button style=\"padding : 10px 10px 10px 10px;\" name=\"submit\" class=\"btn btn-success\" >nouveau salarié.e</button></a> </td>";
			echo "</table>";

		}
		elseif ($onglet==7){
			session_destroy();
			header("Location: ./index.php");
		}
		elseif ($onglet==6) {
			include 'connexpdo.inc.php';
			echo "<h1>Les contrats en attente :</h1> <br />";
			$pdo = connexpdo("fol-49_postgres");
			$query = "SELECT (C.salarie).nom,(C.salarie).prenom,(C.salarie).num_secu FROM CONTRAT_EN_ATTENTE C";
        	$stt=$pdo->query($query);
   			$color=["#A9A9A9","#F8F8FF"];
   			$i=2;
   			echo "<table>";
	        while($donne=$stt->fetch(PDO::FETCH_ASSOC))
	        {
	        	$j=$i%2;
	            echo "<tr style=\"background-color: $color[$j]; width: 100%;\" ><td><h3 style=\"padding : 10px 10px 10px 10px;\" >$donne[prenom] $donne[nom] $donne[num_secu]</h3></td><td> <a href=\"./gestioncontrat.php?nom=$donne[nom]&prenom=$donne[prenom]&secu=$donne[num_secu]\"> <button style=\"padding : 10px 10px 10px 10px;\" name=\"submit\" class=\"btn btn-success\" >validez le contrat</button></a> </td> </tr>";
	            ++$i;
	        }
	        echo "</table>";



		}

	?>


<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="./JS/fol49-3.js"></script>
</body>
</html>

