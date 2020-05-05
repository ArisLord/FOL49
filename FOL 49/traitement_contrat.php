<?php
 include 'connexpdo.inc.php';
  try {
        $pdo = connexpdo("fol-49_postgres");
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


if($type == "CDI"){
    $volume_h = $_POST["Volume_horaire"];
    $volume_h_vac =$_POST["Volume_horaire_vacance"]; 
    
    $query = "INSERT INTO contrat values(
    (SELECT S FROM SALARIE S WHERE S.num_secu ='$num_secu' ),
    '$type','$date_embauche','$classif','$groupe','$coefficient','$fonction','$lieu_travail','$rens_sup',('$volume_h','$volume_h_vac'),NULL,NULL)";
                                          
                                          
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
   
}
elseif ($type == "CDII") {
    $volume_h = $_POST["Volume_horaire"];
    $volume_h_vac =$_POST["Volume_horaire_vacance"];
    $volume_h_cdii = $_POST["Volume_horaire_cdii"];
    $volume_h_scol =$_POST["Volume_horaire_cdii_scolaire"];
    $nbr_semaine_NT = $_POST["Nombre_de_semaines_non_travaillées_:"];
    $list_semaine_NT = $_POST["N°_semaines_non_travaillées_:"]; 
    
    $query = "INSERT INTO contrat values((SELECT S FROM SALARIE S WHERE S.num_secu ='$num_secu' ),
    '$type','$date_embauche','$classif','$groupe','$coefficient','$fonction','$lieu_travail','$rens_sup',('$volume_h','$volume_h_vac'),('$volume_h_cdii','$volume_h_scol','$nbr_semaine_NT','$list_semaine_NT'),NULL)";
                                          
                                          
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

   
  

}
elseif ($type == "CDD") {
    
    echo "CDD";
    if (isset($_POST["motif_cdd"]) && $_POST["motif_cdd"]=="Accroissement temporaire d activite"){
      $cdd_genre = $_POST["cdd_genre"]=="CDD CAE" ? "CDD CAE" : "CDD Emploi d Avenir";
      $motif_cdd = $_POST["motif_cdd"];
      $debut = $_POST["debut"];
      $fin = $_POST["fin"];
      $heure = $_POST["heure"];
        $query = "INSERT INTO contrat values((SELECT S FROM SALARIE S WHERE S.num_secu ='$num_secu' ),'$type','$date_embauche','$classif','$groupe','$coefficient','$fonction','$lieu_travail','$rens_sup',NULL,NULL,('$cdd_genre','$motif_cdd',NULL,'$debut','$fin','$heure'))";
                                              
                                              
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
       
    }
    else{
        
      $cdd_genre = $_POST["cdd_genre"]=="CDD CAE" ? "CDD CAE" : "CDD Emploi d Avenir";
      $motif_cdd = $_POST["motif_cdd"];
      $debut = $_POST["debut"];
      $fin = $_POST["fin"];
      $heure = $_POST["heure"];
      $personne_remplace = $_POST["pers_remp"];
        $query = "INSERT INTO contrat values((SELECT S FROM SALARIE S WHERE S.num_secu ='$num_secu' ),'$type','$date_embauche','$classif','$groupe','$coefficient','$fonction','$lieu_travail','$rens_sup',NULL,NULL,('$cdd_genre','$motif_cdd',(SELECT S FROM SALARIE S WHERE S.num_secu='$personne_remplace'),'$debut','$fin','$heure'))";
                                              
                                              
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
    }


}

        $supprime = "DELETE FROM CONTRAT_EN_ATTENTE C WHERE C.salarie in(SELECT S.salarie FROM CONTRAT S)";
        try{
                $pdo->beginTransaction();
                if($pdo->exec($supprime) === FALSE){
                    $pdo->rollback();
                }
                $pdo->commit();
        }
        catch(PDOException $e) {
                echo $e->getMessage();     
          } 
 
header("Location: ./espace_prive.php?onglet=6");

?>


