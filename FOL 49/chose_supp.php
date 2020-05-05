<?php

//enregistrement volume horaire
  $lundi = $_POST["Lundi"];
   $mardi = $_POST["Mardi"];
   $mercredi = $_POST["Mercredi"];
   $jeudi = $_POST["Jeudi"];
   $vendredi = $_POST["Vendredi"];
   $samedi = $_POST["Samedi"];

   $semaine = "INSERT INTO volume_horaire values((SELECT S FROM SALARIE S WHERE S.num_secu ='$num_secu' ),'$lundi','$mardi','$mercredi','$jeudi','$vendredi','$samedi')";

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
    $semaine = "INSERT INTO Volume_horaire_vacances values((SELECT S FROM SALARIE S WHERE S.num_secu ='$num_secu' ),'$lundi','$mardi','$mercredi','$jeudi','$vendredi','$samedi')";

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

?>