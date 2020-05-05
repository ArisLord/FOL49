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
	<title>Mon espace</title>
	
</head>
<body>
	<?php include 'header.php'; ?>
<form action="<?php echo "./traitement_edt.php?secu=".$_GET["secu"]?>" method="POST" class="form_edt">
	<table class="planning" border=" 1px solid black" >
		<tr>
			<td colspan="11">Période Scolaire Janvier à decembre</td>
		<tr> 
		<tr>
			<td rowspan="2">JOUR</td><td colspan="3" >MATIN</td><td colspan="3" >MIDI</td><td colspan="3" >SOIR</td><td rowspan="2">Totaux</td>
		</tr>
		<tr>
			<td >Arrivee</td><td>depart</td><td>structure</td><td >Arrivee</td><td>depart</td><td>structure</td><td >Arrivee</td><td>depart</td><td>structure</td>
		</tr>
		<?php

			include "connexpdo.inc.php";

			$pdo = connexpdo("fol-49_postgres");

			
			
			$tab_jour=["Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche"];
			foreach ($tab_jour as $value) {
				echo "<tr>";

				echo "<td>$value</td><td><input class=\"$value\" type=\"time\" name=\"matin_arrivee[]\""."></td>"."<td><input type=\"time\" class=\"$value\" name=\"matin_depart[]\""."></td>";
				echo "<td><select "."name=\""."structure_matin[]\">";
				echo "<option>---------</option>";
				$query= "SELECT * FROM structure";

				$stt = $pdo->query($query);
				while ($donne=$stt->fetch(PDO::FETCH_ASSOC)) {
					echo "<option>$donne[nom_structure]</option>";
				}
				echo "</select></td>";

				echo "<td><input class=\"$value\" type=\"time\" name=\"midi_arrivee[]\""."></td>"."<td><input class=\"$value\" type=\"time\" name=\"midi_depart[]\""."></td>";
				echo "<td><select "."name=\"structure_midi[]\">";
				echo "<option>---------</option>";
				$query= "SELECT * FROM structure";

				$stt = $pdo->query($query);
				while ($donne=$stt->fetch(PDO::FETCH_ASSOC)) {
					echo "<option>$donne[nom_structure]</option>";
				}
				echo "</select></td>";

				echo "<td><input type=\"time\" class=\"$value\" name=\"soir_arrivee[]\""."></td>"."<td><input class=\"$value\" type=\"time\" name=\"soir_depart[]\""."></td>";
				echo "<td><select "."name=\"structure_soir[]\">";
				echo "<option>---------</option>";
				$query= "SELECT * FROM structure";

				$stt = $pdo->query($query);
				while ($donne=$stt->fetch(PDO::FETCH_ASSOC)) {
					echo "<option>$donne[nom_structure]</option>";
				}
				echo "</select></td>";


				echo "<td><input type=\"text\" name=\"$value"."_totaux\""."></td>";
				

				echo "</tr>";
			}

		?>
		<tr>
			<td colspan="10">Total semaine</td><td><input type="text" name="total_semaine"></td>
		</tr>
	</table>
	<table class="planning" border=" 1px solid black">
		<tr>
			<td colspan="11">Période Scolaire Janvier à decembre</td>
		<tr> 
		<tr>
			<td rowspan="2">JOUR</td><td colspan="3" >MATIN</td><td colspan="3" >MIDI</td><td colspan="3" >SOIR</td><td rowspan="2">Totaux</td>
		</tr>
		<tr>
			<td >Arrivee</td><td>depart</td><td>structure</td><td >Arrivee</td><td>depart</td><td>structure</td><td >Arrivee</td><td>depart</td><td>structure</td>
		</tr>
		<?php
		
			
			$tab_jour=["Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche"];
			foreach ($tab_jour as $value) {
				echo "<tr>";

				echo "<td>$value</td><td><input type=\"time\" name=\"matin_arrivee_vac[]\""."></td>"."<td><input type=\"time\" name=\"matin_depart_vac[]\""."></td>";
				echo "<td><select "."name=\""."structure_matin_vac[]\">";
				echo "<option>---------</option>";
				$query= "SELECT * FROM structure";

				$stt = $pdo->query($query);
				while ($donne=$stt->fetch(PDO::FETCH_ASSOC)) {
					echo "<option>$donne[nom_structure]</option>";
				}
				echo "</select></td>";

				echo "<td><input type=\"time\" name=\"midi_arrivee_vac[]\""."></td>"."<td><input type=\"time\" name=\"midi_depart_vac[]\""."></td>";
				echo "<td><select "."name=\""."structure_midi__vac[]\">";
				echo "<option>---------</option>";
				$query= "SELECT * FROM structure";

				$stt = $pdo->query($query);
				while ($donne=$stt->fetch(PDO::FETCH_ASSOC)) {
					echo "<option>$donne[nom_structure]</option>";
				}
				echo "</select></td>";

				echo "<td><input type=\"time\" name=\"soir_arrivee_vac[]\""."></td>"."<td><input type=\"time\" name=\"soir_depart_vac[]\""."></td>";
				echo "<td><select "."name=\""."structure_soir_vac[]\">";
				echo "<option>---------</option>";
				$query= "SELECT * FROM structure";

				$stt = $pdo->query($query);
				while ($donne=$stt->fetch(PDO::FETCH_ASSOC)) {
					echo "<option>$donne[nom_structure]</option>";
				}
				echo "</select></td>";


				echo "<td><input type=\"text\" name=\"$value"."_totaux_vac\""."></td>";
				

				echo "</tr>";
			}

		?>
		<tr>
			<td colspan="10">Total semaine</td><td><input type="text" name="total_semaine"></td>
		</tr>
	</table>
	<input type="submit" name="submit" value="Validez" class="btn btn-success" />
	<hr style="margin-top:10px;margin-bottom:10px;" >
</form>





<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="./JS/fol49-3.js"></script>
</body>
</html>