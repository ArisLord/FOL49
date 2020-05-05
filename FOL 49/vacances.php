                               
<?php
/*---------------------------------------------------------------*/
/*
    Titre : Quel sont les jours fériés en France                                                                        
                                                                                                                          
    URL   : https://phpsources.net/code_s.php?id=641
    Auteur           : developpeurweb                                                                                     
    Website auteur   : http://rodic.fr                                                                                    
    Date édition     : 02 Mai 2011                                                                                        
    Date mise à jour : 13 Aout 2019                                                                                      
    Rapport de la maj:                                                                                                    
    - fonctionnement du code vérifié                                                                                    
    - amélioration du code                                                                                               
*/
/*---------------------------------------------------------------*/

      function dimanche_paques($annee)
    {
        return date("Y-m-d", easter_date($annee));
    }
    function vendredi_saint($annee)
    {
        $dimanche_paques = dimanche_paques($annee);
        return date("Y-m-d", strtotime("$dimanche_paques -2 day"));
    }
    function lundi_paques($annee)
    {
        $dimanche_paques = dimanche_paques($annee);
        return date("Y-m-d", strtotime("$dimanche_paques +1 day"));
    }
    function jeudi_ascension($annee)
    {
        $dimanche_paques = dimanche_paques($annee);
        return date("Y-m-d", strtotime("$dimanche_paques +39 day"));
    }
    function lundi_pentecote($annee)
    {
        $dimanche_paques = dimanche_paques($annee);
        return date("Y-m-d", strtotime("$dimanche_paques +50 day"));
    }
    
    
    function jours_feries($annee, $alsacemoselle=false)
    {
        $jours_feries[] = array
        ( 
             'Lundi de paques'  => lundi_paques($annee)
        ,    'Ascension'        =>jeudi_ascension($annee)
        ,    'lundi de pentecote'=>lundi_pentecote($annee)
        ,    'Saint Sylvestre'        =>"$annee-12-31"        //    Saint Sylvestre
        ,    'Nouvel an'        =>"$annee-01-01"        //    Nouvel an
        ,    'fete du travail'  =>"$annee-05-01"        //    Fête du travail
        ,    'Armistice 1945'   =>"$annee-05-08"        //    Armistice 1945
        ,    'Assomption'       =>"$annee-05-15"        //    Assomption
        ,    'fete nationale'   =>"$annee-07-14"        //    Fête nationale
        ,    'Armistice 1918'   =>"$annee-11-11"        //    Armistice 1918
        ,    'Toussaint'        =>"$annee-11-01"        //    Toussaint
        ,    'Noel'             =>"$annee-12-25"        //    Noël
        );
        if($alsacemoselle)
        {
            $jours_feries[] = "$annee-12-26";
            $jours_feries[] = vendredi_saint($annee);
        }
        sort($jours_feries);
        return $jours_feries;
    }
    function est_ferie($jour, $alsacemoselle=false)
    {
        $jour = date("Y-m-d", strtotime($jour));
        $annee = substr($jour, 0, 4);
        return in_array($jour, jours_feries($annee, $alsacemoselle));
    }

    $jours_feries  = jours_feries(date("Y"));

    $xml_vacances = simplexml_load_file("http://telechargement.index-education.com/vacances.xml");
    error_reporting (0); 
    //--------------------Recupération des libellés--------------------------------------//
        foreach ($xml_vacances->libelles->libelle as $value) {
        
            $libelle = explode(" ",$value["id"]);
            $intitule = explode("\n", $value[0]);
            $list_vacances[] = array('id' =>$libelle[0],'intitule'=>$intitule[0]);
            
        }
        
     function getIntitule($id,$tab){
        foreach ($tab as $value) {
            if($value["id"] == $id) return $value["intitule"];
        }

     }

     

    //-----------------------recupération des date de vacances---------------------------//
    foreach ($xml_vacances->calendrier->zone as $value) {
        if ($value["libelle"]=='A') {
            foreach ($value as $vacances) {
                $annee_debut = explode('/',$vacances["debut"]);
                $annee_fin = explode('/',$vacances["fin"]);
                $libelle = explode(" ", $vacances["libelle"]);
                if($annee_debut[0] == date("Y") or $annee_fin[0] == date("Y"))
                    $date_vacances[]=array('debut'=>$annee_debut[2]."-".$annee_debut[1]."-".$annee_debut[0], 'fin'=>$annee_fin[2]."-".$annee_fin[1]."-".$annee_fin[0] ,'intitule' =>getIntitule($libelle[0],$list_vacances));
            }
        }
        
    }
   
   

   
   
      
    foreach ($date_vacances as $value) {
        

        $explo_debut = explode("-", $value["debut"]);
        $explo_fin =  explode("-", $value["fin"]);
        $intitule = $value["intitule"];//htmlspecialchars($value["intitule"], ENT_QUOTES);

        $jour_debut = $explo_debut[0];
        $mois_debut = $explo_debut[1];
        $annee_debut= $explo_debut[2];

        $jour_fin = $explo_fin[0];
        $mois_fin = $explo_fin[1];
        $annee_fin= $explo_fin[2];

        $date_debut = mktime(0,0,0,$mois_debut,$jour_debut,$annee_debut); 
        $date_fin = mktime(0,0,0,$mois_fin,$jour_fin,$annee_fin); 

        
        for($i = $date_debut; $i < $date_fin; $i+=86400)
        {
            $date =date("Y-m-d",$i);
            $tous_les_jours_vacances[] = array('date' => $date ,'intitule' =>$intitule );
        }
}


?>

