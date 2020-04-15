<!DOCTYPE html>
<html>
<head>
	<meta dir="ltr" lang="fr-FR" charset="utf-8">
	<meta name="viewport" content="width=device=width, initial-scale=1">
	<link rel="icon" href="http://www.fol49.org/laligue49/wp-content/uploads/2016/05/icone-ligue.png" sizes="32x32" />
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	<link rel="stylesheet" type="text/css" href="./CSS/fol49.css">
	<title>Renseignement Salarié</title>
	
</head>
<body>
<?php include 'header.php'; ?>
<div class="container container1" style="margin-top:30px">
    <div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
  <div class="panel-heading"><h3 class="panel-title"><strong>Renseignement Salarié.e </strong></h3>
  </div>
  
  <div class="panel-body">
   <form action="./traitement.php" method="POST">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="form-group">
                    <input type="text" name="Nom" id="Nom" class="form-control" placeholder="Nom" tabindex="1" required="required">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                        <input type="text" name="Prenom" id="Prenom" class="form-control" placeholder="Prenom" tabindex="1" required="required">
                    </div>
                </div>
        </div>
        <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                        <input type="text" name="Nom_de_jeune_fille" id="Nom_de_jeune_fille" class="form-control " placeholder="Nom de jeune fille" tabindex="2">                   
                    </div>
                </div>
            </div>
        <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                   <div class="form-group">
                        <input type="date" name="date_naiss" id="date_naiss" class="form-control " placeholder="Date de Naissance " tabindex="4" required="required">
                     </div>  
                </div>
                
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                        <input type="text" name="lieu_naiss" id="lieu_naiss" class="form-control " placeholder="Lieu de Naissance " tabindex="4" required="required">
                     </div>
                </div>
            </div>   
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                        <input type="text" name="telephone" id="telephone" class="form-control " placeholder="Téléphone" tabindex="4" required="required" maxlength="10">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                        <div class="form-group">
                            <input type="text" name="email" id="email" class="form-control " placeholder="Adresse Mail" tabindex="4" required="required">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="form-group">
                <input type="text" name="adresse" id="adresse" class="form-control " placeholder="Adresse" tabindex="3" required="required">
            </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                        <div class="form-group">
                            <input type="text" name="ville" id="ville" class="form-control " placeholder="Ville" tabindex="3" required="required">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                        <input type="text" name="num_secu" id="num_secu" class="form-control " placeholder="N° Sécurité sociale " tabindex="4" required="required" maxlength="14">                    
                    </div>
                </div>
            </div>
             <div class="row">
                    <div class="form-group">
                        <label>Situation familiale :</label><br/>
                        <table>
                            <tr>
                                <td><label>Célibaitre</label></td><td><input type="radio" value="Célibaitre" name="Situation_familiale"></td>
                            </tr>
                            <tr>
                                <td><label>Marié.e</label></td><td><input type="radio" value="Marié" name="Situation_familiale"></td>
                            </tr>
                            <tr>
                                <td><label>Vie Maritale</label></td><td><input type="radio" value="
                                    Vie Maritale" name="Situation_familiale"></td>
                            </tr>
                            <tr>
                                <td><label>Autre</label></td><td><input id="autre" type="radio" value="Autre"  name="Situation_familiale">
                                <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-4">
                                    <div id="precise" class="form-group">
                                        
                                    </div>
                                </div>
                            </div>
                                </td>
                            </tr>
                            <tr>
                              <div class="input-group">
                                    <div class="checkbox" style="margin-top: 0px;">
                                        <td><label>Enfant</label></td><td><input id="check_kid" type="checkbox" name="check_kid"></td>
                                     </div>
                              </div>  


                            </tr>
                        </table>
                         
                         
                        
                                   
                    </div>

            </div>

                              
            
             <div id="enfant" class="row">
              
            </div>                       
            <input type="submit" name="submit" value="Suivant" class="btn btn-success" />
  
             <hr style="margin-top:10px;margin-bottom:10px;" >
  
  
</form>
</div>
</div>
</div>
</div>        


</div>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="./JS/fol49.js"></script>


</body>
</html>

