<?php
	


	session_start();
	if ($_SESSION['connected'] != true){
		header("Location: ./index.php");
	}


if(isset($_GET["date"])){
				require_once 'vacances.php';
				

				setlocale(LC_ALL, 'fr_FR.utf8','fra');
				
				$date=$_GET["date"];
				$num_secu = $_GET["secu"]; 

				$tab_date = explode("-", $date);


				$jours_feries=jours_feries(date("Y"));
				$intitule_jour = ucfirst(strftime("%A",mktime(0,0,0,intval($tab_date[1]),intval($tab_date[2]),intval($tab_date[0]))));
				
				if($intitule_jour != "Dimanche"){	
					$pdo = connexpdo("fol-49_postgres");
					$num_secu = $_GET["secu"];
	 				$date_modifiee = "SELECT H.date_modifie  FROM HEURE_REALISEE H where (H.salarie).num_secu ='$num_secu'";
	 				 $stt=$pdo->query($date_modifiee);
            
		            while($donne=$stt->fetch(PDO::FETCH_ASSOC))
		            {
		                foreach ($donne as $key => $value) {
		                    $les_dates_modifiees[]=$value; 
		                }
		                
		                

		            }



					 $JOUR_NT = "SELECT H.date_modifie  FROM JOUR_NT H where (H.salarie).num_secu ='$num_secu'";
	  					 $stt=$pdo->query($JOUR_NT);
            
			            while($donne=$stt->fetch(PDO::FETCH_ASSOC))
			            {
			                
			                    $les_jour_NT[]=$donne["date_modifie"]; 
			                
			                
			            }


					if(JOUR_NT($date,$les_jour_NT)){
						
						echo "<div class=\"info_jour\">";
						echo "<div class=\"milieu\">Planning du $intitule_jour $tab_date[2]/$tab_date[1]/$tab_date[0]"."</div>";
						echo "<div class=\"gauche\"><img src=\"https://img.icons8.com/color/48/000000/close-window.png\"/></div>";
						echo "<div class=\"milieu\">".getMotif($date,$num_secu,$pdo)."</div>";
						echo "</div>";
					}
					elseif(date_modifie($date,$les_dates_modifiees)){


						$query="SELECT H.volume_modifie FROM HEURE_REALISEE H where (H.salarie).num_secu ='$num_secu' and H.date_modifie ='$date'";

					 	$stt=$pdo->query($query);
		   			
			        	while($donne=$stt->fetch(PDO::FETCH_ASSOC))
			        	{

			        		foreach ($donne as $key => $value) {
			        			$planning[]=$value;
			        		}
			        

			       		 }
			       		

					 	$tranche=["Matin","Midi","Soir"];
						$j=0;
						$count =0;

						echo "<div class=\"info_jour\">";
						echo "<div class=\"gauche\"><i class=\"fas fa-times-circle\"></i></div>";
						echo "<div class=\"milieu\">Planning du $intitule_jour $tab_date[2]/$tab_date[1]/$tab_date[0]"."</div>";
						echo "<div class=\"$tranche[$j]\">";
	
						echo "<p>total d'heure travaillé :<b>".addition($planning[0],"00:00")."</b></p>";
						echo "</div>";
						
						if($count >= 3){
							echo "<div class=\"milieu\">";
							 echo "<h1>Rien de prévu aujourd'hui !</h1>";
							echo "</div>";
						}
						if(($_SESSION["fonction"] != "Animateur.trice" and $_SESSION["fonction"] != "Agent technique" ) and (($_SESSION["fonction"] != "Conseillère vacances") and($_SESSION["fonction"] != "Charge:é de missions")) )
						echo"<div><button id=\"modifier\" style=\"padding : 10px 10px 10px 10px;\" name=\"submit\" class=\"btn btn-success\" >Absent.e</i></button></div>";


					}
					elseif(date_feriee($date,$jours_feries)){
						echo "<div class=\"info_jour\">";
						echo "<div class=\"gauche\"><i class=\"fas fa-times-circle\"></i></div>";
						echo "<div class=\"milieu\">Planning du $intitule_jour $tab_date[2]/$tab_date[1]/$tab_date[0]</div>";

						echo "<div class=\"ferie\">";
							 echo "<h1>".jourferie($date,$jours_feries)."</h1>";
						echo "</div>";
						if(($_SESSION["fonction"] != "Animateur.trice" and $_SESSION["fonction"] != "Agent technique" ) and (($_SESSION["fonction"] != "Conseillère vacances") and($_SESSION["fonction"] != "Charge:é de missions")) )
						echo"<div><button id=\"modifier\" style=\"padding : 10px 10px 10px 10px;\" name=\"submit\" class=\"btn btn-success\" >Absent.e</i></button></div>";
					}
					elseif(jourVacances($date,$tous_les_jours_vacances)) {

						$query="SELECT " ;
						$query = $query."((H.".$intitule_jour.").matin).arrivee as matin_arr,"."((H.".$intitule_jour.").matin).depart as matin_dep,"."((H.".$intitule_jour.").matin).nom_structure as matin_struct,";
						$query = $query."((H.".$intitule_jour.").midi).arrivee as midi_arr,"."((H.".$intitule_jour.").midi).depart as midi_dep,"."((H.".$intitule_jour.").midi).nom_structure as midi_struct,";

						$query = $query."((H.".$intitule_jour.").soir).arrivee as soir_arr,"."((H.".$intitule_jour.").soir).depart as soir_dep,"."((H.".$intitule_jour.").soir).nom_structure as soir_struct";

						$query=$query." FROM HORAIRE_VACANCES H where (H.salarie).num_secu ='$num_secu'";

					 	$stt=$pdo->query($query);
		   			
			        	while($donne=$stt->fetch(PDO::FETCH_ASSOC))
			        	{

			        		foreach ($donne as $key => $value) {
			        			$planning[]=$value;
			        		}
			        

			       		 }

					 	$tranche=["Matin","Midi","Soir"];
						$j=0;

						echo "<div class=\"info_jour\">";
						echo "<div class=\"gauche\"><i class=\"fas fa-times-circle\"></i></div>";
						echo "<div class=\"milieu\">Planning du $intitule_jour $tab_date[2]/$tab_date[1]/$tab_date[0]-".quellesVacances($date,$tous_les_jours_vacances)."</div>";
						for ($i=0; $i <count($planning) ; $i+=3) {
							$Structure = $planning[$i+2] !="---------"? $planning[$i+2] : ""; 
							if($Structure != ""){
								echo "<div class=\"$tranche[$j]\">";
								 echo "<h2>$tranche[$j]:</h2><br/>";
								 echo "<p>Arrivée : <b>".$planning[$i+0]."</b><p>";
								 echo "<p>Départ : <b>".$planning[$i+1]."</b><p>";
								 echo "<p>Structure : <b>".$Structure."</b><p>";
								echo "</div>";
							}else ++$count;
							++$j;	
						}
						if($count >= 3){
							echo "<div class=\"milieu\">";
							 echo "<h1>Rien de prévu aujourd'hui !</h1>";
							echo "</div>";
						}
						if(($_SESSION["fonction"] != "Animateur.trice" and $_SESSION["fonction"] != "Agent technique" ) and (($_SESSION["fonction"] != "Conseillère vacances") and($_SESSION["fonction"] != "Charge:é de missions")) )
						echo"<div><button id=\"modifier\" style=\"padding : 10px 10px 10px 10px;\" name=\"submit\" class=\"btn btn-success\" >Absent.e</i></button></div>";
					}
					else{
						$query="SELECT " ;
						$query = $query."((H.".$intitule_jour.").matin).arrivee as matin_arr,"."((H.".$intitule_jour.").matin).depart as matin_dep,"."((H.".$intitule_jour.").matin).nom_structure as matin_struct,";
						$query = $query."((H.".$intitule_jour.").midi).arrivee as midi_arr,"."((H.".$intitule_jour.").midi).depart as midi_dep,"."((H.".$intitule_jour.").midi).nom_structure as midi_struct,";

						$query = $query."((H.".$intitule_jour.").soir).arrivee as soir_arr,"."((H.".$intitule_jour.").soir).depart as soir_dep,"."((H.".$intitule_jour.").soir).nom_structure as soir_struct";

						$query=$query." FROM HORAIRE_SEMAINE H where (H.salarie).num_secu ='$num_secu'";

					 	$stt=$pdo->query($query);
		   			
			        	while($donne=$stt->fetch(PDO::FETCH_ASSOC))
			        	{

			        		foreach ($donne as $key => $value) {
			        			$planning[]=$value;
			        		}
			        

			       		 }

					 	$tranche=["Matin","Midi","Soir"];
						$j=0;

						echo "<div class=\"info_jour\">";
						echo "<div class=\"gauche\"><i class=\"fas fa-times-circle\"></i></div>";
						echo "<div class=\"milieu\">Planning du $intitule_jour $tab_date[2]/$tab_date[1]/$tab_date[0]</div>";
						for ($i=0; $i <count($planning) ; $i+=3) {
							$Structure = $planning[$i+2] !="---------"? $planning[$i+2] : "";
							if($Structure != ""){ 
								echo "<div class=\"$tranche[$j]\">";
								 echo "<h2>$tranche[$j]:</h2><br/>";
								 echo "<p>Arrivée : <b>".$planning[$i+0]."</b><p>";
								 echo "<p>Départ : <b>".$planning[$i+1]."</b><p>";
								 echo "<p>Structure : <b>".$Structure."</b><p>";
								echo "</div>";
									
							}else ++$count;
							++$j;	
						}
						if($count >= 3){
							echo "<div class=\"milieu\">";
							 echo "<h1>Rien de prévu aujourd'hui !</h1>";
							echo "</div>";
						}
						if(($_SESSION["fonction"] != "Animateur.trice" and $_SESSION["fonction"] != "Agent technique" ) and (($_SESSION["fonction"] != "Conseillère vacances") and($_SESSION["fonction"] != "Charge:é de missions")) )
						echo"<div><button id=\"modifier\" style=\"padding : 10px 10px 10px 10px;\" name=\"submit\" class=\"btn btn-success\" >Absent.e</i></button></div>";
						
					}
				}
				else {
					$pdo = connexpdo("fol-49_postgres");
					$num_secu = $_SESSION["num_secu"];
	 				$date_modifiee = "SELECT H.date_modifie  FROM HEURE_REALISEE H where (H.salarie).num_secu ='$num_secu'";
	 				 $stt=$pdo->query($date_modifiee);
            
		            while($donne=$stt->fetch(PDO::FETCH_ASSOC))
		            {
		                foreach ($donne as $key => $value) {
		                    $les_dates_modifiees[]=$value; 
		                }
		                
		                

		            }

		            	 $JOUR_NT = "SELECT H.date_modifie  FROM JOUR_NT H where (H.salarie).num_secu ='$num_secu'";
	  					 $stt=$pdo->query($JOUR_NT);
            
			            while($donne=$stt->fetch(PDO::FETCH_ASSOC))
			            {
			                
			                    $les_jour_NT[]=$donne["date_modifie"]; 
			                
			                
			            }


					if(JOUR_NT($date,$les_jour_NT)){
						
						echo "<div class=\"info_jour\">";
						echo "<div class=\"milieu\">Planning du $intitule_jour $tab_date[2]/$tab_date[1]/$tab_date[0]"."</div>";
						echo "<div class=\"gauche\"><img src=\"https://img.icons8.com/color/48/000000/close-window.png\"/></div>";
						echo "<div class=\"milieu\">".getMotif($date,$num_secu,$pdo)."</div>";
						echo "</div>";
					}
					elseif(date_modifie($date,$les_dates_modifiees)){


						$query="SELECT H.volume_modifie FROM HEURE_REALISEE H where (H.salarie).num_secu ='$num_secu' and H.date_modifie ='$date'";

					 	$stt=$pdo->query($query);
		   			
			        	while($donne=$stt->fetch(PDO::FETCH_ASSOC))
			        	{

			        		foreach ($donne as $key => $value) {
			        			$planning[]=$value;
			        		}
			        

			       		 }
			       		

					 	$tranche=["Matin","Midi","Soir"];
						$j=0;
						$count =0;

						echo "<div class=\"info_jour\">";
						echo "<div class=\"gauche\"><img src=\"https://img.icons8.com/color/48/000000/close-window.png\"/></div>";
						echo "<div class=\"milieu\">Planning du $intitule_jour $tab_date[2]/$tab_date[1]/$tab_date[0]"."</div>";
						echo "<div class=\"$tranche[$j]\">";
	
						echo "<p>total d'heure travaillé :<b>".addition($planning[0],"00:00")."</b></p>";
						echo "</div>";
						
						if($count >= 3){
							echo "<div class=\"milieu\">";
							 echo "<h1>Rien de prévu aujourd'hui !</h1>";
							echo "</div>";
						}
						


					}
					elseif(date_feriee($date,$jours_feries)){
						echo "<div class=\"info_jour\">";
						echo "<div class=\"gauche\"><img src=\"https://img.icons8.com/color/48/000000/close-window.png\"/></div>";
						echo "<div class=\"milieu\">Planning du $intitule_jour $tab_date[2]/$tab_date[1]/$tab_date[0]</div>";

						echo "<div class=\"ferie\">";
							 echo "<h1>".jourferie($date,$jours_feries)."</h1>";
						echo "</div>";
						
					}
					else {
						echo "<div class=\"info_jour\">";
						echo "<div class=\"gauche\"><img src=\"https://img.icons8.com/color/48/000000/close-window.png\"/></div>";
						echo "<div class=\"milieu\">Planning du $intitule_jour $tab_date[2]/$tab_date[1]/$tab_date[0]</div>";
						echo "<div class=\"milieu\">";
						echo "<h1>Rien de prévu aujourd'hui !</h1>";
						echo "</div>";

						
							
					}
					if(($_SESSION["fonction"] != "Animateur.trice" and $_SESSION["fonction"] != "Agent technique" ) and (($_SESSION["fonction"] != "Conseillère vacances") and($_SESSION["fonction"] != "Charge:é de missions")) )
					echo"<div><button id=\"modifier\" style=\"padding : 10px 10px 10px 10px;\" name=\"submit\" class=\"btn btn-success\" >Absent.e</i></button></div>";
				}
					echo "</div>";
				
		}




echo "<!DOCTYPE html>
<html>
<head>
	<meta dir=\"ltr\" lang=\"fr-FR\" charset=\"utf-8\">
	<meta name=\"viewport\" content=\"width=device=width, initial-scale=1\">
	<link rel=\"icon\" href=\"http://www.fol49.org/laligue49/wp-content/uploads/2016/05/icone-ligue.png\" sizes=\"32x32\" />
	<link href=\"//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css\" rel=\"stylesheet\" id=\"bootstrap-css\">
	<link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.5.0/css/all.css\">
	<link rel=\"stylesheet\" type=\"text/css\" href=\"./CSS/espace_prive.css\">
	<link rel=\"stylesheet\" type=\"text/css\" href=\"./CSS/calendrier.css\">
	<title>Mon espace</title>
	
</head>
<body>";
include 'header.php';
require_once 'fonction.inc.php';

?>
<button id="calcul" style="padding : 10px 10px 10px 10px;" name="submit" class="calcul btn btn-success" >Calculer le cumul d'heures</button><a href="./espace_prive.php?onglet=3"><button id="calcul" style="padding : 10px 10px 10px 10px;" name="submit" class="btn btn-success" >Retour</button></a><button id="calcul" style="padding : 10px 10px 10px 10px;" name="submit" class="btn-modif btn btn-success" >modifier</button>
<!-- <div class="pop-up cumul">

</div> -->
<?php
	if(date("d") >= 10){
		setlocale(LC_ALL, 'fr_FR.utf8','fra');
        $mois_2=strftime("%B",mktime(0,0,0,date("m"),date("d"),date("Y")));
        if(decisionHeureSupp($_GET["secu"],$mois_2,$pdo) != "" ){
            echo "<div class=\"warning alert alert-warning\">";
            echo "<span><img src=\"https://img.icons8.com/emoji/30/000000/warning-emoji.png\"/>Vous avez décidé de ".decisionHeureSupp($_GET["secu"],$mois_2,$pdo)." les heures supplementaires du mois de $mois_2 <img src=\"https://img.icons8.com/emoji/30/000000/warning-emoji.png\"/></span>";
            echo "</div>";
        }
    }    
?>
<table class="calendar">
 	<tr class="entete-tab">
 	<?php 

 		for($m=1; $m<=12; ++$m){
 			setlocale(LC_ALL, 'fr_FR.utf8','fra');
 			$mois=strftime("%B", mktime(0, 0, 0, $m,1));
			
			echo "<td colspan=\"2\" class =\"mois\" >";
			echo "<b><i>$mois</i></b>";
			echo "</td>";
		}	

 	 ?>
 	 </tr>
 	 <tr class="entete-tab">
 	 <?php
 	 	for ($i=0; $i <12 ; $i++) { 
 	 		echo "<td  class =\"mois\">Date</td><td  class =\"mois\">Nombre d'heures</td>";
 	 	}
 	 	
 	 	
 	 ?>
 	 </tr>	
 	 <?php
 	 require_once 'vacances.php';
 	 $jours_feries=jours_feries(date("Y"));

	 //----------------------------------------------------------------Operation sur les horaires-------------------------------------------------------------//
	

	

	 $num_secu = $_GET["secu"];
	 $date_modifiee = "SELECT H.date_modifie  FROM HEURE_REALISEE H where (H.salarie).num_secu ='$num_secu'";
	  $stt=$pdo->query($date_modifiee);
            
            while($donne=$stt->fetch(PDO::FETCH_ASSOC))
            {
                foreach ($donne as $key => $value) {
                    $les_date_modifie[]=$value; 
                }
                
                

            }

      $JOUR_NT = "SELECT H.date_modifie  FROM JOUR_NT H where (H.salarie).num_secu ='$num_secu'";
	  $stt=$pdo->query($JOUR_NT);
            
            while($donne=$stt->fetch(PDO::FETCH_ASSOC))
            {
                
                    $les_jour_NT[]=$donne["date_modifie"]; 
                
                
            }


 	 function afficher_ligne($i,$tous_les_jours_vacances,$jours_feries,$tab_horaire,$vac,$date_modi,$jour_NT){
 	 		
        	$pdo = connexpdo("fol-49_postgres");
        	$num_secu =$_GET["secu"];
        	$jan = $i <= cal_days_in_month(CAL_GREGORIAN, 1, date("Y")) ? strftime("%A %d",mktime(0,0,0,1,$i,date("Y"))) : ""; 
        	$fev = $i <= cal_days_in_month(CAL_GREGORIAN, 2, date("Y")) ? strftime("%A %d",mktime(0,0,0,2,$i,date("Y"))) : "";
        	$mar = $i <= cal_days_in_month(CAL_GREGORIAN, 3, date("Y")) ? strftime("%A %d",mktime(0,0,0,3,$i,date("Y"))) : "";
        	$avr = $i <= cal_days_in_month(CAL_GREGORIAN, 4, date("Y")) ? strftime("%A %d",mktime(0,0,0,4,$i,date("Y"))) : "";
        	$mai = $i <= cal_days_in_month(CAL_GREGORIAN, 5, date("Y")) ? strftime("%A %d",mktime(0,0,0,5,$i,date("Y"))) : "";
        	$jui = $i <= cal_days_in_month(CAL_GREGORIAN, 6, date("Y")) ? strftime("%A %d",mktime(0,0,0,6,$i,date("Y"))) : "";
        	$juil= $i <= cal_days_in_month(CAL_GREGORIAN, 7, date("Y")) ? strftime("%A %d",mktime(0,0,0,7,$i,date("Y"))) : "";
        	$aou = $i <= cal_days_in_month(CAL_GREGORIAN, 8, date("Y")) ? strftime("%A %d",mktime(0,0,0,8,$i,date("Y"))) : "";
        	$sep = $i <= cal_days_in_month(CAL_GREGORIAN, 9, date("Y")) ? strftime("%A %d",mktime(0,0,0,9,$i,date("Y"))) : "";
        	$oct = $i <= cal_days_in_month(CAL_GREGORIAN, 10, date("Y")) ? strftime("%A %d",mktime(0,0,0,10,$i,date("Y"))) : "";
        	$nov = $i <= cal_days_in_month(CAL_GREGORIAN, 11, date("Y")) ? strftime("%A %d",mktime(0,0,0,11,$i,date("Y"))) : "";
        	$dec = $i <= cal_days_in_month(CAL_GREGORIAN, 12, date("Y")) ? strftime("%A %d",mktime(0,0,0,12,$i,date("Y"))) : "";

        	$jour_1 = $i <= cal_days_in_month(CAL_GREGORIAN, 1, date("Y")) ? strftime("%A",mktime(0,0,0,1,$i,date("Y"))) : ""; 
        	$jour_2 = $i <= cal_days_in_month(CAL_GREGORIAN, 2, date("Y")) ? strftime("%A",mktime(0,0,0,2,$i,date("Y"))) : "";
        	$jour_3 = $i <= cal_days_in_month(CAL_GREGORIAN, 3, date("Y")) ? strftime("%A",mktime(0,0,0,3,$i,date("Y"))) : "";
        	$jour_4 = $i <= cal_days_in_month(CAL_GREGORIAN, 4, date("Y")) ? strftime("%A",mktime(0,0,0,4,$i,date("Y"))) : "";
        	$jour_5 = $i <= cal_days_in_month(CAL_GREGORIAN, 5, date("Y")) ? strftime("%A",mktime(0,0,0,5,$i,date("Y"))) : "";
        	$jour_6 = $i <= cal_days_in_month(CAL_GREGORIAN, 6, date("Y")) ? strftime("%A",mktime(0,0,0,6,$i,date("Y"))) : "";
        	$jour_7 = $i <= cal_days_in_month(CAL_GREGORIAN, 7, date("Y")) ? strftime("%A",mktime(0,0,0,7,$i,date("Y"))) : "";
        	$jour_8 = $i <= cal_days_in_month(CAL_GREGORIAN, 8, date("Y")) ? strftime("%A",mktime(0,0,0,8,$i,date("Y"))) : "";
        	$jour_9 = $i <= cal_days_in_month(CAL_GREGORIAN, 9, date("Y")) ? strftime("%A",mktime(0,0,0,9,$i,date("Y"))) : "";
        	$jour_10 = $i <= cal_days_in_month(CAL_GREGORIAN, 10, date("Y")) ? strftime("%A",mktime(0,0,0,10,$i,date("Y"))) : "";
        	$jour_11 = $i <= cal_days_in_month(CAL_GREGORIAN, 11, date("Y")) ? strftime("%A",mktime(0,0,0,11,$i,date("Y"))) : "";
        	$jour_12 = $i <= cal_days_in_month(CAL_GREGORIAN, 12, date("Y")) ? strftime("%A",mktime(0,0,0,12,$i,date("Y"))) : "";

 

        	$jour_j=date("Y-m-d",mktime(0,0,0,1,$i,date("Y")));
        	$jour_f=date("Y-m-d",mktime(0,0,0,2,$i,date("Y")));
        	$jour_m=date("Y-m-d",mktime(0,0,0,3,$i,date("Y")));
        	$jour_a=date("Y-m-d",mktime(0,0,0,4,$i,date("Y")));
        	$jour_ma=date("Y-m-d",mktime(0,0,0,5,$i,date("Y")));
        	$jour_jui=date("Y-m-d",mktime(0,0,0,6,$i,date("Y")));
        	$jour_juil=date("Y-m-d",mktime(0,0,0,7,$i,date("Y")));
        	$jour_ao=date("Y-m-d",mktime(0,0,0,8,$i,date("Y")));
        	$jour_s=date("Y-m-d",mktime(0,0,0,9,$i,date("Y")));
        	$jour_o =date("Y-m-d",mktime(0,0,0,10,$i,date("Y")));
        	$jour_no=date("Y-m-d",mktime(0,0,0,11,$i,date("Y")));
        	$jour_de=date("Y-m-d",mktime(0,0,0,12,$i,date("Y")));

        	echo "<tr>";


        	//-------------------------Janvier-------------------------//
        	if (JOUR_NT($jour_j,$jour_NT)) {
				echo "<td class=\"jour NT\" ><a  style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_j\">$jan</a></td><td class=\"volume\">".getMotif($jour_j,$num_secu,$pdo)."</td>";
			}
        	elseif(date_modifie($jour_j,$date_modi)){
        		 $horaire = "SELECT H.volume_modifie	FROM HEURE_REALISEE H WHERE (H.salarie).num_secu ='$num_secu' and H.date_modifie = '$jour_j'";
        				$stt=$pdo->query($horaire);
            
		            while($donne=$stt->fetch(PDO::FETCH_ASSOC))
		            {
		                foreach ($donne as $key => $value) {
		                     $horaire_mod["modif"][]=$value; 
		                 }
		            }
		            echo "<td class=\"jour modif\" ><a style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_j\">$jan</a></td><td class=\"volume volume_jan\">".addition("00:00",$horaire_mod["modif"][0])."</td>";  
      


        	}
        	elseif (date_feriee($jour_j,$jours_feries) && jourVacances($jour_j,$tous_les_jours_vacances)) {
        			$intitule = jourferie($jour_j,$jours_feries)."-".quellesVacances($jour_j,$tous_les_jours_vacances);
        			echo "<td class=\"jour conge\" title=\"$intitule\" ><a  style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_j\">$jan</a></td><td class=\"volume volume_jan\"></td>";
        	}
        	elseif (date_feriee($jour_j,$jours_feries)) {
        		$intitule = jourferie($jour_j,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_j\">$jan</a></td><td class=\"volume volume_jan\"></td>";	
        	}
        	elseif (jourVacances($jour_j,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_j,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_j\">$jan</a></td><td class=\"volume volume_jan\">".totalHeure($jour_1,$vac)."</td>";	
        	}
        	elseif($jan==""){
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
        	else echo "<td class=\"jour jour_normal\"><a style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_j\">$jan</a></td><td class=\"volume volume_jan\">".totalHeure($jour_1,$tab_horaire)."</td>"; 

        	//------------------------------Fevrier---------------------------//
			
        	if (JOUR_NT($jour_f,$jour_NT)) {
				echo "<td class=\"jour NT\" ><a  style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_f\">$fev</a></td><td class=\"volume\">".getMotif($jour_f,$num_secu,$pdo)."</td>";
			}
        	elseif(date_modifie($jour_f,$date_modi)){
        		 $horaire = "SELECT H.volume_modifie FROM HEURE_REALISEE H WHERE (H.salarie).num_secu ='$num_secu' and H.date_modifie = '$jour_f'";
        				$stt=$pdo->query($horaire);
            
		            while($donne=$stt->fetch(PDO::FETCH_ASSOC))
		            {
		                foreach ($donne as $key => $value) {
		                     $horaire_mod["modif"][]=$value; 
		                 }
		            }
		            echo "<td class=\"jour modif\" ><a style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_f\">$fev</a></td><td class=\"volume volume_fev\">".addition("00:00",$horaire_mod["modif"][0])."</td>";  
      


        	}
			elseif($fev==""){
        		
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
			elseif (date_feriee($jour_f,$jours_feries) && jourVacances($jour_f,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_f,$jours_feries)."-".quellesVacances($jour_f,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_f\">$fev</a></td><td class=\"volume volume_fev\"></td>";
        	}
        	elseif (date_feriee($jour_f,$jours_feries)) {
        		$intitule = jourferie($jour_f,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_f\">$fev</a></td><td class=\"volume volume_fev\"></td>";	
        	}
        	elseif (jourVacances($jour_f,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_f,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_f\">$fev</a></td><td class=\"volume volume_fev\">".totalHeure($jour_2,$vac)."</td>";	
        	}
        	
        	else echo "<td class=\"jour jour_normal\"><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_f\">$fev</a></td><td class=\"volume volume_fev\">".totalHeure($jour_2,$tab_horaire)."</td>";         	
        	
        	//------------------------------Mars---------------------------//
			if (JOUR_NT($jour_m,$jour_NT)) {
				echo "<td class=\"jour NT\" ><a  style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_m\">$mar</a></td><td class=\"volume\">".getMotif($jour_m,$num_secu,$pdo)."</td>";
			}
			elseif(date_modifie($jour_m,$date_modi)){
        		 $horaire = "SELECT H.volume_modifie FROM HEURE_REALISEE H WHERE (H.salarie).num_secu ='$num_secu' and H.date_modifie = '$jour_m'";
        				$stt=$pdo->query($horaire);
            
		            while($donne=$stt->fetch(PDO::FETCH_ASSOC))
		            {
		                foreach ($donne as $key => $value) {
		                     $horaire_mod["modif"][]=$value; 
		                 }
		            }
		            echo "<td class=\"jour modif\" ><a style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_m\">$mar</a></td><td class=\"volume volume_mar\">".addition("00:00",$horaire_mod["modif"][0])."</td>";  
      


        	}
			elseif (date_feriee($jour_m,$jours_feries) && jourVacances($jour_m,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_m,$jours_feries)."-".quellesVacances($jour_m,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_m\">$mar</a></td><td class=\"volume volume_mar\"></td>";
        	}
        	elseif (date_feriee($jour_m,$jours_feries)) {
        		$intitule = jourferie($jour_m,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_m\">$mar</a></td><td class=\"volume volume_mar\"></td>";	
        	}
        	elseif (jourVacances($jour_m,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_m,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_m\">$mar</a></td><td class=\"volume volume_mar\">".totalHeure($jour_3,$vac)."</td>";	
        	}
        	elseif($mar==""){
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
        	else echo "<td class=\"jour jour_normal\"><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_m\">$mar</a></td><td class=\"volume volume_mar\">".totalHeure($jour_3,$tab_horaire)."</td>";         	
        	

        	//------------------------------Avril---------------------------//
			if (JOUR_NT($jour_a,$jour_NT)) {
				echo "<td class=\"jour NT\" ><a  style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_a\">$avr</a></td><td class=\"volume\">".getMotif($jour_a,$num_secu,$pdo)."</td>";
			}
			elseif(date_modifie($jour_a,$date_modi)){
        		 $horaire = "SELECT H.volume_modifie FROM HEURE_REALISEE H WHERE (H.salarie).num_secu ='$num_secu' and H.date_modifie = '$jour_a'";
        				$stt=$pdo->query($horaire);
            
		            while($donne=$stt->fetch(PDO::FETCH_ASSOC))
		            {
		                foreach ($donne as $key => $value) {
		                     $horaire_mod["modif"][]=$value; 
		                 }
		            }
		            echo "<td class=\"jour modif\" ><a style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_a\">$avr</a></td><td class=\"volume volume_avr\">".addition("00:00",$horaire_mod["modif"][0])."</td>";  
      


        	}
			elseif($avr==""){
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
			elseif (date_feriee($jour_a,$jours_feries) && jourVacances($jour_a,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_a,$jours_feries)."-".quellesVacances($jour_a,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_a\">$avr</a></td><td class=\"volume volume_avr\"></td>";
        	}
        	elseif (date_feriee($jour_a,$jours_feries)) {
        		$intitule = jourferie($jour_a,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_a\">$avr</a></td><td class=\"volume volume_avr\"></td>";	
        	}
        	elseif (jourVacances($jour_a,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_a,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_a\">$avr</a></td><td class=\"volume volume_avr\">".totalHeure($jour_4,$vac)."</td>";	
        	}
        	else echo "<td class=\"jour jour_normal\"><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_a\">$avr</a></td><td class=\"volume volume_avr\">".totalHeure($jour_4,$tab_horaire)."</td>";         	
        	
        	

        	//------------------------------Mai---------------------------//

			if (JOUR_NT($jour_ma,$jour_NT)) {
				echo "<td class=\"jour NT\" ><a  style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_ma\">$mai</a></td><td class=\"volume\">".getMotif($jour_ma,$num_secu,$pdo)."</td>";
			}
			elseif(date_modifie($jour_ma,$date_modi)){
        		 $horaire = "SELECT H.volume_modifie FROM HEURE_REALISEE H WHERE (H.salarie).num_secu ='$num_secu' and H.date_modifie = '$jour_ma'";
        				$stt=$pdo->query($horaire);
            
		            while($donne=$stt->fetch(PDO::FETCH_ASSOC))
		            {
		                foreach ($donne as $key => $value) {
		                     $horaire_mod["modif"][]=$value; 
		                 }
		            }
		            echo "<td class=\"jour modif\" ><a style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_ma\">$mai</a></td><td class=\"volume volume_mai\">".addition("00:00",$horaire_mod["modif"][0])."</td>";  
      


        	}
			elseif (date_feriee($jour_ma,$jours_feries) && jourVacances($jour_ma,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_ma,$jours_feries)."-".quellesVacances($jour_ma,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_ma\">$mai</a></td><td class=\"volume volume_mai\"></td>";
        	}
        	elseif (date_feriee($jour_ma,$jours_feries)) {
        		$intitule = jourferie($jour_ma,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_ma\">$mai</a></td><td class=\"volume volume_mai\"></td>";	
        	}
        	elseif (jourVacances($jour_ma,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_ma,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_ma\">$mai</a></td><td class=\"volume volume_mai\">".totalHeure($jour_5,$vac)."</td>";	
        	}
        	elseif($mai==""){
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
        	else echo "<td class=\"jour jour_normal\"><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_ma\">$mai</a></td><td class=\"volume volume_mai\">".totalHeure($jour_5,$tab_horaire)."</td>";   

			
			//------------------------------Juin---------------------------//
			if (JOUR_NT($jour_jui,$jour_NT)) {
				echo "<td class=\"jour NT\" ><a  style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_jui\">$mar</a></td><td class=\"volume\">".getMotif($jour_jui,$num_secu,$pdo)."</td>";
			}
			elseif(date_modifie($jour_jui,$date_modi)){
        		 $horaire = "SELECT H.volume_modifie FROM HEURE_REALISEE H WHERE (H.salarie).num_secu ='$num_secu' and H.date_modifie = '$jour_jui'";
        				$stt=$pdo->query($horaire);
            
		            while($donne=$stt->fetch(PDO::FETCH_ASSOC))
		            {
		                foreach ($donne as $key => $value) {
		                     $horaire_mod["modif"][]=$value; 
		                 }
		            }
		            echo "<td class=\"jour modif\" ><a style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_jui\">$jui</a></td><td class=\"volume volume_juin\">".addition("00:00",$horaire_mod["modif"][0])."</td>";  
      


        	}
			elseif (date_feriee($jour_jui,$jours_feries) && jourVacances($jour_jui,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_jui,$jours_feries)."-".quellesVacances($jour_jui,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_jui\">$jui</a></td><td class=\"volume volume_juin\"></td>";
        	}
        	elseif (date_feriee($jour_jui,$jours_feries)) {
        		$intitule = jourferie($jour_jui,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_jui\">$jui</a></td><td class=\"volume volume_juin\"></td>";	
        	}
        	elseif (jourVacances($jour_jui,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_jui,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_jui\">$jui</a></td><td class=\"volume volume_juin\">".totalHeure($jour_6,$vac)."</td>";	
        	}
        	elseif($jui==""){
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
        	else echo "<td class=\"jour jour_normal\"><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_jui\">$jui</a></td><td class=\"volume volume_juin\">".totalHeure($jour_6,$tab_horaire)."</td>";   

        	//------------------------------Juillet---------------------------//
			if (JOUR_NT($jour_juil,$jour_NT)) {
				echo "<td class=\"jour NT\" ><a  style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_m\">$jui</a></td><td class=\"volume\">".getMotif($jour_juil,$num_secu,$pdo)."</td>";
			}
			elseif(date_modifie($jour_juil,$date_modi)){
        		 $horaire = "SELECT H.volume_modifie FROM HEURE_REALISEE H WHERE (H.salarie).num_secu ='$num_secu' and H.date_modifie = '$jour_juil'";
        				$stt=$pdo->query($horaire);
            
		            while($donne=$stt->fetch(PDO::FETCH_ASSOC))
		            {
		                foreach ($donne as $key => $value) {
		                     $horaire_mod["modif"][]=$value; 
		                 }
		            }
		            echo "<td class=\"jour modif\" ><a style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_juil\">$juil</a></td><td class=\"volume volume_juil\">".addition("00:00",$horaire_mod["modif"][0])."</td>";  
      


        	}
			elseif (date_feriee($jour_juil,$jours_feries) && jourVacances($jour_juil,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_juil,$jours_feries)."-".quellesVacances($jour_juil,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_juil\">$juil</a></td><td class=\"volume volume_juil\"></td>";
        	}
        	elseif (date_feriee($jour_juil,$jours_feries)) {
        		$intitule = jourferie($jour_juil,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\"><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_juil\">$juil</a></td><td class=\"volume volume_juil\"></td>";	
        	}
        	elseif (jourVacances($jour_juil,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_juil,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_juil\">$juil</a></td><td class=\"volume volume_juil\">".totalHeure($jour_7,$vac)."</td>";	
        	}

        	elseif($juil==""){
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
        	else echo "<td class=\"jour jour_normal\"><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_juil\">$juil</a></td><td class=\"volume volume_juil\">".totalHeure($jour_7,$tab_horaire)."</td>";   

			
			//------------------------------Aout---------------------------//
			if (JOUR_NT($jour_ao,$jour_NT)) {
				echo "<td class=\"jour NT\" ><a  style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_ao\">$aou</a></td><td class=\"volume\">".getMotif($jour_ao,$num_secu,$pdo)."</td>";
			}
			elseif(date_modifie($jour_ao,$date_modi)){
        		 $horaire = "SELECT H.volume_modifie FROM HEURE_REALISEE H WHERE (H.salarie).num_secu ='$num_secu' and H.date_modifie = '$jour_ao'";
        				$stt=$pdo->query($horaire);
            
		            while($donne=$stt->fetch(PDO::FETCH_ASSOC))
		            {
		                foreach ($donne as $key => $value) {
		                     $horaire_mod["modif"][]=$value; 
		                 }
		            }
		            echo "<td class=\"jour modif\" ><a style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_ao\">$aou</a></td><td class=\"volume volume_aout\">".addition("00:00",$horaire_mod["modif"][0])."</td>";  
      


        	}
			elseif (date_feriee($jour_ao,$jours_feries) && jourVacances($jour_ao,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_ao,$jours_feries)."-".quellesVacances($jour_ao,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_ao\">$aou</a></td><td class=\"volume volume_aout\"></td>";
        	}
        	elseif (date_feriee($jour_ao,$jours_feries)) {
        		$intitule = jourferie($jour_ao,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_ao\">$aou</a></td><td class=\"volum_aoute\"></td>";	
        	}
        	elseif (jourVacances($jour_ao,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_ao,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_ao\">$aou</a></td><td class=\"volume volume_aout\">".totalHeure($jour_8,$vac)."</td>";	
        	}

        	elseif($aou==""){
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
        	else echo "<td class=\"jour jour_normal\"><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_ao\">$aou</a></td><td class=\"volume volume_aout\">".totalHeure($jour_8,$tab_horaire)."</td>";   
        	

			//------------------------------Septembre---------------------------//
			if (JOUR_NT($jour_s,$jour_NT)) {
				echo "<td class=\"jour NT\" ><a  style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_ao\">$sep</a></td><td class=\"volume\">".getMotif($jour_s,$num_secu,$pdo)."</td>";
			}
			elseif(date_modifie($jour_s,$date_modi)){
        		 $horaire = "SELECT H.volume_modifie FROM HEURE_REALISEE H WHERE (H.salarie).num_secu ='$num_secu' and H.date_modifie = '$jour_s'";
        				$stt=$pdo->query($horaire);
            
		            while($donne=$stt->fetch(PDO::FETCH_ASSOC))
		            {
		                foreach ($donne as $key => $value) {
		                     $horaire_mod["modif"][]=$value; 
		                 }
		            }
		            echo "<td class=\"jour modif\" ><a style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_s\">$sep</a></td><td class=\"volume volume_sept\">".addition("00:00",$horaire_mod["modif"][0])."</td>";  
      


        	}
			elseif (date_feriee($jour_s,$jours_feries) && jourVacances($jour_s,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_s,$jours_feries)."-".quellesVacances($jour_s,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_s\">$sep</a></td><td class=\"volume volume_sept\"></td>";
        	}
        	elseif (date_feriee($jour_s,$jours_feries)) {
        		$intitule = jourferie($jour_s,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_s\">$sep</a></td><td class=\"volume volume_sept\"></td>";	
        	}
        	elseif (jourVacances($jour_s,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_s,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_s\">$sep</a></td><td class=\"volume volume_sept\">".totalHeure($jour_9,$vac)."</td>";	
        	}

        	elseif($sep==""){
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
        	else echo "<td class=\"jour jour_normal\"><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_s\">$sep</a></td><td class=\"volume volume_sept\">".totalHeure($jour_9,$tab_horaire)."</td>";   
        	
        	//------------------------------Octobre---------------------------//
			if (JOUR_NT($jour_o,$jour_NT)) {
				echo "<td class=\"jour NT\" ><a  style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_o\">$oct</a></td><td class=\"volume\">".getMotif($jour_o,$num_secu,$pdo)."</td>";
			}
			elseif(date_modifie($jour_o,$date_modi)){
        		 $horaire = "SELECT H.volume_modifie FROM HEURE_REALISEE H WHERE (H.salarie).num_secu ='$num_secu' and H.date_modifie = '$jour_o'";
        				$stt=$pdo->query($horaire);
            
		            while($donne=$stt->fetch(PDO::FETCH_ASSOC))
		            {
		                foreach ($donne as $key => $value) {
		                     $horaire_mod["modif"][]=$value; 
		                 }
		            }
		            echo "<td class=\"jour modif\" ><a style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_o\">$oct</a></td><td class=\"volume volume_oct\">".addition("00:00",$horaire_mod["modif"][0])."</td>";  
      


        	}
			elseif (date_feriee($jour_o,$jours_feries) && jourVacances($jour_o,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_o,$jours_feries)."-".quellesVacances($jour_o,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_o\">$oct</a></td><td class=\"volume volume_oct\"></td>";
        	}
        	elseif (date_feriee($jour_o,$jours_feries)) {
        		$intitule = jourferie($jour_o,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_o\">$oct</a></td><td class=\"volume volume_oct\"></td>";	
        	}
        	elseif (jourVacances($jour_o,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_o,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_o\">$oct</a></td><td class=\"volume volume_oct\">".totalHeure($jour_10,$vac)."</td>";	
        	}

        	elseif($oct==""){
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
        	else echo "<td class=\"jour jour_normal\"><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_o\">$oct</a></td><td class=\"volume volume_oct\">".totalHeure($jour_10,$tab_horaire)."</td>";

        	//------------------------------Novembre---------------------------//
			if (JOUR_NT($jour_no,$jour_NT)) {
				echo "<td class=\"jour NT\" ><a  style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_no\">$nov</a></td><td class=\"volume\">".getMotif($jour_no,$num_secu,$pdo)."</td>";
			}
			elseif(date_modifie($jour_no,$date_modi)){
        		 $horaire = "SELECT H.volume_modifie FROM HEURE_REALISEE H WHERE (H.salarie).num_secu ='$num_secu' and H.date_modifie = '$jour_no'";
        				$stt=$pdo->query($horaire);
            
		            while($donne=$stt->fetch(PDO::FETCH_ASSOC))
		            {
		                foreach ($donne as $key => $value) {
		                     $horaire_mod["modif"][]=$value; 
		                 }
		            }
		            echo "<td class=\"jour modif\" ><a style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_no\">$nov</a></td><td class=\"volume volume_nov\">".addition("00:00",$horaire_mod["modif"][0])."</td>";  
      


        	}
			elseif (date_feriee($jour_no,$jours_feries) && jourVacances($jour_no,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_no,$jours_feries)."-".quellesVacances($jour_no,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_no\">$nov</a></td><td class=\"volume volume_nov\"></td>";
        	}
        	elseif (date_feriee($jour_no,$jours_feries)) {
        		$intitule = jourferie($jour_no,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_no\">$nov</a></td><td class=\"volume volume_nov\"></td>";	
        	}
        	elseif (jourVacances($jour_no,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_no,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_no\">$nov</a></td><td class=\"volume volume_nov\">".totalHeure($jour_11,$vac)."</td>";	
        	}

        	elseif($nov==""){
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
        	else echo "<td class=\"jour jour_normal\"><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_no\">$nov</a></td><td class=\"volume volume_nov\">".totalHeure($jour_11,$tab_horaire)."</td>";

        	//------------------------------Decembre---------------------------//
			if (JOUR_NT($jour_de,$jour_NT)) {
				echo "<td class=\"jour NT\" ><a  style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_de\">$dec</a></td><td class=\"volume\">".getMotif($jour_de,$num_secu,$pdo)."</td>";
			}
			elseif(date_modifie($jour_de,$date_modi)){
        		 $horaire = "SELECT H.volume_modifie FROM HEURE_REALISEE H WHERE (H.salarie).num_secu ='$num_secu' and H.date_modifie = '$jour_de'";
        				$stt=$pdo->query($horaire);
            
		            while($donne=$stt->fetch(PDO::FETCH_ASSOC))
		            {
		                foreach ($donne as $key => $value) {
		                     $horaire_mod["modif"][]=$value; 
		                 }
		            }
		            echo "<td class=\"jour modif\" ><a style=\"color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_de\">$dec</a></td><td class=\"volume volume_dec\">".addition("00:00",$horaire_mod["modif"][0])."</td>";  
      


        	}
			elseif (date_feriee($jour_de,$jours_feries) && jourVacances($jour_de,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_de,$jours_feries)."-".quellesVacances($jour_de,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_de\">$dec</a></td><td class=\"volume volume_dec\"></td>";
        	}
        	elseif (date_feriee($jour_de,$jours_feries)) {
        		$intitule = jourferie($jour_de,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_de\">$dec</a></td><td class=\"volume volume_dec\"></td>";	
        	}
        	elseif (jourVacances($jour_de,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_de,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" ><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_de\">$dec</a></td><td class=\"volume volume_dec\">".totalHeure($jour_12,$vac)."</td>";	
        	}

        	elseif($dec==""){
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
        	else echo "<td class=\"jour jour_normal\"><a style=\" color:black; text-decoration: none;\" href=\"./calendrier_annuel_bis.php?secu=$_GET[secu]&date=$jour_de\">$dec</a></td><td class=\"volume volume_dec\">".totalHeure($jour_12,$tab_horaire)."</td>";
        	echo "</tr>";

 	 } 
 	  
     $date_fin = mktime(0,0,0,1,31,date("Y")); 
     setlocale(LC_ALL, 'fr_FR.utf8','fra');
        
        for($i = 1; $i <= 31; $i+=1)
        {
        	echo afficher_ligne($i,$tous_les_jours_vacances,$jours_feries,$horaire_semaine,$horaire_semaine_vac,$les_date_modifie,$les_jour_NT);
        	
 			
        }
 	 

        
 	 ?>

</table>

<button id="calcul" style="padding : 10px 10px 10px 10px;" name="submit" class="calcul btn btn-success" >Calculer le cumul d'heures</button><a href="./espace_prive.php?onglet=3"><button id="calcul" style="padding : 10px 10px 10px 10px;" name="submit" class="btn btn-success" >Retour</button></a>
<button id="calcul" style="padding : 10px 10px 10px 10px;" name="submit" class="btn-modif btn btn-success" >modifier</button>



<?php

	echo "<script src=\"//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js\"></script>
	<script src=\"//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>
	<script type=\"text/javascript\" src=\"./JS/fol49-3.js\"></script>
	<script type=\"text/javascript\" src=\"./JS/fol49-4.js\"></script>
	<script type=\"text/javascript\" src=\"./JS/fol49-5.js\"></script>
	<script type=\"text/javascript\" src=\"./JS/fol49-7.js\"></script>
	</body>
	</html>";

?>