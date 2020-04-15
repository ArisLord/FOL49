<?php
 print_r($_POST);

 include 'connexpdo.inc.php';
  try {
        $pdo = connexpdo("fol-49_test");
       } 
   catch (PDOException $e) {
     echo 'Connexion échouée : ' . $e->getMessage();
    }

 $num_secu=isset($_GET["secu"])? $_GET["secu"] : 12121212;
 $prenom=$_POST["Prenom"];
 $date_embauche = $_POST["date_embauche"];
 $fonction =$_POST["fonction"];
 $classif =$_POST["classification"];
 $groupe = $_POST["groupe"];
 $coefficient = $_POST["coefficient"];
 $type = $_POST["contrat"];
 $lieu_travail = $_POST["lieu_de_travail"];
 $rens_sup=$_POST["info_sup"];
 $type = isset($_POST["CDII"])? "CDII" : $type;

 $query = "INSERT INTO Contrat(num_securite,type_contrat,date_embauche,classification,groupe,coefficient,fonction,lieu_travail,rens_sup) values('$num_secu','$type','$date_embauche','$classif','$groupe','$coefficient','$fonction','$lieu_travail','$rens_sup')";

 try{
            $pdo->beginTransaction();
            if($pdo->exec($query) === FALSE){
                $pdo->rollback();
            }
            $pdo->commit();
    }
    catch(PDOException $e) {
            echo $e->getMessage();     
        } 

 	if($_POST["contrat"]=="CDI"){
	 	
	 	if ($type=="CDII") {
	 		$volume_h = $_POST["Volume_horaire_cdii"];
	 		$volume_h_scol =$_POST["Volume_horaire_cdii_scolaire"];
	 		$volume_h_vac = $_POST["Volume_horaire_vacance"];
	 		$nbr_sem_NT =$_POST["Nombre_de_semaines_non_travaillées_:"];
	 		$num_sem_NT=$_POST["N°_semaines_non_travaillées_:"];
	 		$cdii = "INSERT INTO CDII(num_secu,duree_min,periode_scolaire,vacances,nbr_semaine_NT,num_semaine_NT) values('$num_secu','$volume_h','$volume_h_scol','$volume_h_vac','$nbr_sem_NT','$num_sem_NT')";

 			try{
            	$pdo->beginTransaction();
            	if($pdo->exec($cdii) === FALSE){
                	$pdo->rollback();
           		 }
            		$pdo->commit();
   				 }
    		catch(PDOException $e) {
            	echo $e->getMessage();     
       		 } 
	 	}
	 	else {
	 		$volume_h = $_POST["Volume_horaire"];
	 		$cdi = "INSERT INTO CDI(num_secu,volume_hebdo) values('$num_secu','$volume_h')";

 			try{
            	$pdo->beginTransaction();
            	if($pdo->exec($cdi) === FALSE){
                	$pdo->rollback();
           		 }
            		$pdo->commit();
   				 }
    		catch(PDOException $e) {
            	echo $e->getMessage();     
       		 } 
	 	}

	//-------------horaire par semaine-------------------------//
	 $lundi = $_POST["Lundi"];
	 $mardi = $_POST["Mardi"];
	 $mercredi = $_POST["Mercredi"];
	 $jeudi = $_POST["Jeudi"];
	 $vendredi = $_POST["Vendredi"];

	 $semaine = "INSERT INTO Heure_semaine(num_secu,lundi,mardi,mercredi,jeudi,vendredi) values('$num_secu','$lundi','$mardi','$mercredi','$jeudi','$vendredi')";

 			try{
            	$pdo->beginTransaction();
            	if($pdo->exec($semaine) === FALSE){
                	$pdo->rollback();
           		 }
            		$pdo->commit();
   				 }
    		catch(PDOException $e) {
            	echo $e->getMessage();     
       		 } 
     $lundi = $_POST["Lundi_vac"];
	 $mardi = $_POST["Mardi_vac"];
	 $mercredi = $_POST["Mercredi_vac"];
	 $jeudi = $_POST["Jeudi_vac"];
	 $vendredi = $_POST["Vendredi_vac"];
 	
 	 $semaine = "INSERT INTO Heure_semaine_vac(num_secu,lundi,mardi,mercredi,jeudi,vendredi) values('$num_secu','$lundi','$mardi','$mercredi','$jeudi','$vendredi')";

 			try{
            	$pdo->beginTransaction();
            	if($pdo->exec($semaine) === FALSE){
                	$pdo->rollback();
           		 }
            		$pdo->commit();
   				 }
    		catch(PDOException $e) {
            	echo $e->getMessage();     
       		 }
 }
 else if ($_POST["contrat"]=="CDD") {
 	$type_cdd = isset($_POST["cdd_genre"]) ? $_POST["cdd_genre"] : $type;
 	$motif = isset($_POST["motif_cdd"])? $_POST["motif_cdd"] : "";
 	$pers = isset($_POST["pers_remp"])? $_POST["pers_remp"] : "";
 	$debut = $_POST["debut"];
 	$fin = $_POST["fin"];
 	$heure = $_POST["heure"];
 	
 	$cdd = "INSERT INTO CDD(num_secu,type_cdd,motif,personne_remplace,date_debut,date_fin,heure_travaille) values('$num_secu','$type_cdd','$motif','$pers','$debut','$fin','$heure')";

 try{
            $pdo->beginTransaction();
            if($pdo->exec($cdd) === FALSE){
                $pdo->rollback();
            }
            $pdo->commit();
    }
    catch(PDOException $e) {
            echo $e->getMessage();     
        } 

 }

?>


