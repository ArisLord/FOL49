<?php
    
    $Nom = $_POST["Nom"] != "" ? $_POST["Nom"] : "undefined";
    $Prenom = $_POST["Prenom"] != "" ? $_POST["Prenom"] : "undefined";
    $Nom_de_jeune_fille = $_POST["Nom_de_jeune_fille"];
    $date_naiss = $_POST["date_naiss"];
    $lieu_naiss = $_POST["lieu_naiss"];
    $telephone=$_POST["telephone"];
    $mail=$_POST["email"];
    $adresse =$_POST["adresse"];
    $ville = $_POST["ville"];
    $num_secu = $_POST["num_secu"];
    $situation=isset($_POST["Situation_familiale"]) ? $_POST["Situation_familiale"] : "undefined";

    //--------------INFO ENFANT--------------//
    
    $nom_enfant= isset($_POST["nom_enfant"])? $_POST["nom_enfant"] : [];
    $Prenom_enfant = isset($_POST["prenom_enfant"])? $_POST["prenom_enfant"]:[];
    $date_naiss_enfant= isset($_POST["date_naiss_enfant"])? $_POST["date_naiss_enfant"]:[];
    $sexe = isset($_POST["sexe_enfant"]) ? $_POST["sexe_enfant"] : [] ;
    $a_charge = isset($_POST["a_charge"])? $_POST["a_charge"] : [];

    
    //--------------------------------connexion BDD--------------------------------//
    include 'connexpdo.inc.php';

    try {
        $pdo = connexpdo("fol-49_test");
            } 
        catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
            }

    $query = "INSERT INTO SALARIE(num_secu,nom,prenom,dat_naiss,lieu_naiss,situation_familiale,adresse,ville,telephone,mail) values('$num_secu','$Nom','$Prenom','$date_naiss','$lieu_naiss','$situation','$adresse','$ville','$telephone','$mail')";
    try{
            $pdo->beginTransaction();
            if($pdo->exec($query) === FALSE){
                $pdo->rollback();
            }
            $pdo->commit();

            if ($prenom_enfant==[]) {
                header("Location: ./creation_mot_de_passe.php?secu=$num_secu");
            }
    }
    catch(PDOException $e) {
            echo $e->getMessage();     
        
        } 

    for ($i=0; $i <count($nom_enfant) ; $i++) { 
        $pren = $Prenom_enfant[$i];
        $nom = $nom_enfant[$i];
        $char = $a_charge[$i] == "OUI" ? true : false ;
        $dat = $date_naiss_enfant[$i];
        $sx = $sexe[$i];
        $qry = "INSERT INTO ENFANT(parent,nom,prenom,dat_naiss,sexe,a_charge) values('$num_secu','$nom','$pren','$dat','$sx','$char')";
        try{
            $pdo->beginTransaction();
            if($pdo->exec($qry) === FALSE){
                $pdo->rollback();
            }
            $pdo->commit();
            header("Location: ./creation_mot_de_passe.php?secu=$num_secu");
        }
        catch(PDOException $e) {
            echo $e->getMessage();     
        
        } 
    }

      
?>