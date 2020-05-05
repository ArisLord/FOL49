<?php

include 'connexpdo.inc.php';

$pdo = connexpdo("fol-49_postgres");

$num_secu = $_GET["secu"];

//---------------------------------------------------------------periode scolaire-------------------------------------------------------------------------//

$arrive_matin =$_POST["matin_arrivee"];
$depart_matin =$_POST["matin_depart"];
$structure_matin =$_POST["structure_matin"];

$arrive_midi =$_POST["midi_arrivee"];
$depart_midi =$_POST["midi_depart"];
$structure_midi =$_POST["structure_midi"];

$arrive_soir =$_POST["soir_arrivee"];
$depart_soir =$_POST["soir_depart"];
$structure_soir =$_POST["structure_soir"];

$lundi="(('$arrive_matin[0]','$depart_matin[0]','$structure_matin[0]'),('$arrive_midi[0]','$depart_midi[0]','$structure_midi[0]'),('$arrive_soir[0]','$depart_soir[0]','$structure_soir[0]')),";
$mardi="(('$arrive_matin[1]','$depart_matin[1]','$structure_matin[1]'),('$arrive_midi[1]','$depart_midi[1]','$structure_midi[1]'),('$arrive_soir[1]','$depart_soir[1]','$structure_soir[1]')),";
$mercredi="(('$arrive_matin[2]','$depart_matin[2]','$structure_matin[2]'),('$arrive_midi[2]','$depart_midi[2]','$structure_midi[2]'),('$arrive_soir[2]','$depart_soir[2]','$structure_soir[2]')),";
$jeudi="(('$arrive_matin[3]','$depart_matin[3]','$structure_matin[3]'),('$arrive_midi[3]','$depart_midi[3]','$structure_midi[3]'),('$arrive_soir[3]','$depart_soir[3]','$structure_soir[3]')),";
$vendredi="(('$arrive_matin[4]','$depart_matin[4]','$structure_matin[4]'),('$arrive_midi[4]','$depart_midi[4]','$structure_midi[4]'),('$arrive_soir[4]','$depart_soir[4]','$structure_soir[4]')),";
$samedi="(('$arrive_matin[5]','$depart_matin[5]','$structure_matin[5]'),('$arrive_midi[5]','$depart_midi[5]','$structure_midi[5]'),('$arrive_soir[5]','$depart_soir[5]','$structure_soir[5]')))";

$query ="INSERT INTO horaire_semaine values ((SELECT S FROM SALARIE S WHERE S.num_secu='$num_secu'),".$lundi.$mardi.$mercredi.$jeudi.$vendredi.$samedi;

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
//----------------------------------------------------vacances scolaires----------------------------------------------------------------------------//
$arrive_matin =$_POST["matin_arrivee_vac"];
$depart_matin =$_POST["matin_depart_vac"];
$structure_matin =$_POST["structure_matin_vac"];

$arrive_midi =$_POST["midi_arrivee_vac"];
$depart_midi =$_POST["midi_depart_vac"];
$structure_midi =$_POST["structure_midi_vac"];

$arrive_soir =$_POST["soir_arrivee_vac"];
$depart_soir =$_POST["soir_depart_vac"];
$structure_soir =$_POST["structure_soir_vac"];



$lundi="(('$arrive_matin[0]','$depart_matin[0]','$structure_matin[0]'),('$arrive_midi[0]','$depart_midi[0]','$structure_midi[0]'),('$arrive_soir[0]','$depart_soir[0]','$structure_soir[0]')),";
$mardi="(('$arrive_matin[1]','$depart_matin[1]','$structure_matin[1]'),('$arrive_midi[1]','$depart_midi[1]','$structure_midi[1]'),('$arrive_soir[1]','$depart_soir[1]','$structure_soir[1]')),";
$mercredi="(('$arrive_matin[2]','$depart_matin[2]','$structure_matin[2]'),('$arrive_midi[2]','$depart_midi[2]','$structure_midi[2]'),('$arrive_soir[2]','$depart_soir[2]','$structure_soir[2]')),";
$jeudi="(('$arrive_matin[3]','$depart_matin[3]','$structure_matin[3]'),('$arrive_midi[3]','$depart_midi[3]','$structure_midi[3]'),('$arrive_soir[3]','$depart_soir[3]','$structure_soir[3]')),";
$vendredi="(('$arrive_matin[4]','$depart_matin[4]','$structure_matin[4]'),('$arrive_midi[4]','$depart_midi[4]','$structure_midi[4]'),('$arrive_soir[4]','$depart_soir[4]','$structure_soir[4]')),";
$samedi="(('$arrive_matin[5]','$depart_matin[5]','$structure_matin[5]'),('$arrive_midi[5]','$depart_midi[5]','$structure_midi[5]'),('$arrive_soir[5]','$depart_soir[5]','$structure_soir[5]')))";

$query ="INSERT INTO horaire_vacances values ((SELECT S FROM SALARIE S WHERE S.num_secu='$num_secu'),".$lundi.$mardi.$mercredi.$jeudi.$vendredi.$samedi;

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

$supprime = "DELETE FROM EMPLOI_DU_TEMPS_A_FINALISER C WHERE C.salarie in(SELECT S.salarie FROM CONTRAT S)";
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

header("Location: ./espace_prive.php?onglet=3");

?>