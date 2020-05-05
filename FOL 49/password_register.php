
<?php
        include 'connexpdo.inc.php';

        try {
                $pdo = connexpdo("fol-49_postgres");
                    } 
                catch (PDOException $e) {
                    echo 'Connexion échouée : ' . $e->getMessage();
                    }
        $mail = $_POST["email"];
        $password_1 =   isset($_POST["password-1"]) ? password_hash ($_POST["password-1"],PASSWORD_BCRYPT) : ""; 
        $password_2 =   isset($_POST["password"]) ? $_POST["password"] : "";
        $recup = "SELECT (C.SALARIE).mail FROM CONTRAT C WHERE (C.SALARIE).mail = '$mail' and (C.SALARIE).mot_de_passe is NULL";
        $stt=$pdo->query($recup);
        while($donne=$stt->fetch(PDO::FETCH_ASSOC))
        {
            $mail_bis[]=$donne["mail"];
        }
        
        if($mail_bis[0] != $mail){
            
            header("Location: ./creation_mot_de_passe.php?err=101");

        } 
        
        if (password_verify ($password_2,$password_1)){
            
            $query = "UPDATE SALARIE S SET mot_de_passe = '$password_1' WHERE S.mail = '$mail'";
            try{
                    $pdo->beginTransaction();
                    if($pdo->exec($query) === FALSE){
                        $pdo->rollback();

                    }
                    $pdo->commit();
            header("Location: ./index.php");
            
            }
            catch(PDOException $e) {
                    echo $e->getMessage();     
                
                } 
         }
        else {
           header("Location: ./creation_mot_de_passe.php?err=102");
        }

            



?>