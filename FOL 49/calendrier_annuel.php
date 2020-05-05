<?php 
	echo "$_SESSION[nom]";
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
 	 <?php
 	 require_once 'vacances.php';
 	 $jours_feries=jours_feries(date("Y"));

 	 function jourferie($date,$tab_date_ferie){
 	 	foreach ($tab_date_ferie as $value) {
 	 		foreach ($value as $key => $jour) {
 	 			if ($jour == $date)	return $key;
 	 		}
 	 	}
 	 	

 	 }

 	 function date_feriee($date,$tab_date_ferie){
 	 	foreach ($tab_date_ferie as $value) {
 	 		foreach ($value as $key => $jour) {
 	 			if ($jour == $date)	return true;
 	 		}
 	 	}
 	 	return false;
 	  }

 	function jourVacances($date,$tab_vacances)
 	{
 		foreach ($tab_vacances as $value) {
 			if ($date==$value["date"]) {
 				return true;
 			}
 		}
 		return false;
 	}
 	function quellesVacances($date,$tab_vacances)
 	{
 		foreach ($tab_vacances as $value) {
 			if ($date==$value["date"]) {
 				return $value["intitule"];
 			}
 		}
 		
 	}

 	  echo date_feriee(date("Y-m-d",mktime(0,0,0,1,1,date("Y"))), $jours_feries);
 	  echo jourferie(date("Y-m-d",mktime(0,0,0,1,1,date("Y"))), $jours_feries);
 	  echo jourVacances(date("Y-m-d",mktime(0,0,0,1,1,date("Y"))),$tous_les_jours_vacances);
 	  echo quellesVacances(date("Y-m-d",mktime(0,0,0,1,1,date("Y"))),$tous_les_jours_vacances);

 	 function afficher_ligne($i,$tous_les_jours_vacances,$jours_feries){
 	 		$date_debut = mktime(0,0,0,1,1,date("Y"));
 	 		$mois="";
        	$jour =date("d",$i);

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
        	if (jourferie($jour_j,$jours_feries) && jourVacances($jour_j,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_j,$jours_feries)."-".quellesVacances($jour_j,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$jan</td><td class=\"case\">vol</td>";
        	}
        	elseif (jourferie($jour_j,$jours_feries)) {
        		$intitule = jourferie($jour_j,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$jan</td><td class=\"case\">vol</td>";	
        	}
        	elseif (jourVacances($jour_j,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_j,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$jan</td><td class=\"case\">vol</td>";	
        	}
        	elseif($jan==""){
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
        	else echo "<td class=\"jour jour_normal\">$jan</td><td class=\"case\">vol</td>"; 

        	//------------------------------Fevrier---------------------------//
			if($fev==""){
        		
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
			elseif (jourferie($jour_f,$jours_feries) && jourVacances($jour_f,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_f,$jours_feries)."-".quellesVacances($jour_f,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$fev</td><td class=\"case\">vol</td>";
        	}
        	elseif (jourferie($jour_f,$jours_feries)) {
        		$intitule = jourferie($jour_f,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$fev</td><td class=\"case\">vol</td>";	
        	}
        	elseif (jourVacances($jour_f,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_f,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$fev</td><td class=\"case\">vol</td>";	
        	}
        	
        	else echo "<td class=\"jour jour_normal\">$fev</td><td class=\"case\">vol</td>";         	
        	
        	//------------------------------Mars---------------------------//
			if (jourferie($jour_m,$jours_feries) && jourVacances($jour_m,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_m,$jours_feries)."-".quellesVacances($jour_m,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$mar</td><td class=\"case\">vol</td>";
        	}
        	elseif (jourferie($jour_m,$jours_feries)) {
        		$intitule = jourferie($jour_m,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$mar</td><td class=\"case\">vol</td>";	
        	}
        	elseif (jourVacances($jour_m,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_m,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$mar</td><td class=\"case\">vol</td>";	
        	}
        	elseif($mar==""){
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
        	else echo "<td class=\"jour jour_normal\">$mar</td><td class=\"case\">vol</td>";         	
        	

        	//------------------------------Avril---------------------------//
			if($avr==""){
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
			elseif (jourferie($jour_a,$jours_feries) && jourVacances($jour_a,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_a,$jours_feries)."-".quellesVacances($jour_a,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$avr</td><td class=\"case\">vol</td>";
        	}
        	elseif (jourferie($jour_a,$jours_feries)) {
        		$intitule = jourferie($jour_a,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$avr</td><td class=\"case\">vol</td>";	
        	}
        	elseif (jourVacances($jour_a,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_a,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$avr</td><td class=\"case\">vol</td>";	
        	}
        	else echo "<td class=\"jour jour_normal\">$avr</td><td class=\"case\">vol</td>";         	
        	
        	

        	//------------------------------Mai---------------------------//
			if (jourferie($jour_ma,$jours_feries) && jourVacances($jour_ma,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_ma,$jours_feries)."-".quellesVacances($jour_ma,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$mai</td><td class=\"case\">vol</td>";
        	}
        	elseif (jourferie($jour_ma,$jours_feries)) {
        		$intitule = jourferie($jour_ma,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$mai</td><td class=\"case\">vol</td>";	
        	}
        	elseif (jourVacances($jour_ma,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_ma,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$mai</td><td class=\"case\">vol</td>";	
        	}
        	elseif($mai==""){
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
        	else echo "<td class=\"jour jour_normal\">$mai</td><td class=\"case\">vol</td>";   

			
			//------------------------------Juin---------------------------//
			if (jourferie($jour_jui,$jours_feries) && jourVacances($jour_jui,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_jui,$jours_feries)."-".quellesVacances($jour_jui,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$jui</td><td class=\"case\">vol</td>";
        	}
        	elseif (jourferie($jour_jui,$jours_feries)) {
        		$intitule = jourferie($jour_jui,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$jui</td><td class=\"case\">vol</td>";	
        	}
        	elseif (jourVacances($jour_jui,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_jui,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$jui</td><td class=\"case\">vol</td>";	
        	}
        	elseif($jui==""){
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
        	else echo "<td class=\"jour jour_normal\">$jui</td><td class=\"case\">vol</td>";   

        	//------------------------------Juillet---------------------------//
			if (jourferie($jour_juil,$jours_feries) && jourVacances($jour_juil,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_juil,$jours_feries)."-".quellesVacances($jour_juil,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$juil</td><td class=\"case\">vol</td>";
        	}
        	elseif (jourferie($jour_juil,$jours_feries)) {
        		$intitule = jourferie($jour_juil,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\aou$juil</td><td class=\"case\">vol</td>";	
        	}
        	elseif (jourVacances($jour_juil,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_juil,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$juil</td><td class=\"case\">vol</td>";	
        	}

        	elseif($juil==""){
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
        	else echo "<td class=\"jour jour_normal\">$juil</td><td class=\"case\">vol</td>";   

			
			//------------------------------Aout---------------------------//
			if (jourferie($jour_ao,$jours_feries) && jourVacances($jour_ao,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_ao,$jours_feries)."-".quellesVacances($jour_ao,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$aou</td><td class=\"case\">vol</td>";
        	}
        	elseif (jourferie($jour_ao,$jours_feries)) {
        		$intitule = jourferie($jour_ao,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$aou</td><td class=\"case\">vol</td>";	
        	}
        	elseif (jourVacances($jour_ao,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_ao,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$aou</td><td class=\"case\">vol</td>";	
        	}

        	elseif($aou==""){
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
        	else echo "<td class=\"jour jour_normal\">$aou</td><td class=\"case\">vol</td>";   
        	

			//------------------------------Septembre---------------------------//
			if (jourferie($jour_s,$jours_feries) && jourVacances($jour_s,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_s,$jours_feries)."-".quellesVacances($jour_s,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$sep</td><td class=\"case\">vol</td>";
        	}
        	elseif (jourferie($jour_s,$jours_feries)) {
        		$intitule = jourferie($jour_s,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$sep</td><td class=\"case\">vol</td>";	
        	}
        	elseif (jourVacances($jour_s,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_s,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$sep</td><td class=\"case\">vol</td>";	
        	}

        	elseif($sep==""){
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
        	else echo "<td class=\"jour jour_normal\">$sep</td><td class=\"case\">vol</td>";   
        	
        	//------------------------------Octobre---------------------------//
			if (jourferie($jour_o,$jours_feries) && jourVacances($jour_o,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_o,$jours_feries)."-".quellesVacances($jour_o,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$oct</td><td class=\"case\">vol</td>";
        	}
        	elseif (jourferie($jour_o,$jours_feries)) {
        		$intitule = jourferie($jour_o,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$oct</td><td class=\"case\">vol</td>";	
        	}
        	elseif (jourVacances($jour_o,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_o,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$oct</td><td class=\"case\">vol</td>";	
        	}

        	elseif($oct==""){
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
        	else echo "<td class=\"jour jour_normal\">$oct</td><td class=\"case\">vol</td>";

        	//------------------------------Novembre---------------------------//
			if (jourferie($jour_no,$jours_feries) && jourVacances($jour_no,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_no,$jours_feries)."-".quellesVacances($jour_no,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$nov</td><td class=\"case\">vol</td>";
        	}
        	elseif (jourferie($jour_no,$jours_feries)) {
        		$intitule = jourferie($jour_no,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$nov</td><td class=\"case\">vol</td>";	
        	}
        	elseif (jourVacances($jour_no,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_no,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$nov</td><td class=\"case\">vol</td>";	
        	}

        	elseif($nov==""){
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
        	else echo "<td class=\"jour jour_normal\">$nov</td><td class=\"case\">vol</td>";

        	//------------------------------Decembre---------------------------//
			if (jourferie($jour_de,$jours_feries) && jourVacances($jour_de,$tous_les_jours_vacances)) {
        		$intitule = jourferie($jour_de,$jours_feries)."-".quellesVacances($jour_de,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$dec</td><td class=\"case\">vol</td>";
        	}
        	elseif (jourferie($jour_de,$jours_feries)) {
        		$intitule = jourferie($jour_de,$jours_feries);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$dec</td><td class=\"case\">vol</td>";	
        	}
        	elseif (jourVacances($jour_de,$tous_les_jours_vacances)) {
        		$intitule = quellesVacances($jour_de,$tous_les_jours_vacances);
        		echo "<td class=\"jour conge\" title=\"$intitule\" >$dec</td><td class=\"case\">vol</td>";	
        	}

        	elseif($dec==""){
        		echo "<td colspan=\"2\" class=\"notADay\"></td>";	
        	}
        	else echo "<td class=\"jour jour_normal\">$dec</td><td class=\"case\">vol</td>";
        	echo "</tr>";

 	 } 
 	  
     $date_fin = mktime(0,0,0,1,31,date("Y")); 
     setlocale(LC_ALL, 'fr_FR.utf8','fra');
        
        for($i = 1; $i <= 31; $i+=1)
        {
        	echo afficher_ligne($i,$tous_les_jours_vacances,$jours_feries);
 			
        }
 	 
        
 	 ?>


</table>
