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
		<?php include "header.php"; ?>
		<div class="panel-body2" style="padding-top: 5px;">
		<div class="part1">
			 <b>SALARIE</b>
		</div>


		
		   <form action="./traitement_contrat.php" method="POST">
			        <div class="row">
			            <div class="col-xs-12 col-sm-2 col-md-2">
			                <div class="form-group">
			                    <input type="text" name="Nom" id="Nom" class="form-control" placeholder="Nom" tabindex="1" required="required">
			                    </div>
			                </div>
			                <div class="col-xs-12 col-sm-2 col-md-2">
			                    <div class="form-group">
			                        <input type="text" name="Prenom" id="Prenom" class="form-control" placeholder="Prenom" tabindex="1" required="required">
			                    </div>
			                </div>
			        </div>
			        <div class="row">
			                <div class="col-xs-12 col-sm-2 col-md-2">
			                    <div class="form-group">
			                        <input type="date" name="date_embauche" id="date_embauche" class="form-control" tabindex="2">                   
			                    </div>
			                </div>
			                <div class="col-xs-12 col-sm-2 col-md-2">
			                    <div class="form-group">
			                    	<label>Fonction:</label>
			                        <select name="fonction">
			                        	<option> Administrateur </option>
			                        	<option> Directeur de structure </option>
			                        	<option> Salarié.e </option>
			                        </select>                   
			                    </div>
			                </div>
			            </div>
			            <div class="row">
			                
			                 <div class="col-xs-12 col-sm-2 col-md-2">
			                    <div class="form-group">
			                    	 <input type="text" name="classification" id="classification" class="form-control" tabindex="2" placeholder="Classification">                      
			                    </div>
			                </div>
			                <div class="col-xs-12 col-sm-2 col-md-2">
			                    <div class="form-group">
			                    	<input type="text" name="groupe" id="groupe" class="form-control" tabindex="2" placeholder="Groupe">
			                    </div>
			                </div>
			            </div>
			            <div class="row">
			                <div class="col-xs-12 col-sm-2 col-md-2">
			                    <div class="form-group">
			                    	 <input type="text" name="coefficient" id="coefficient" class="form-control" tabindex="2" placeholder="coefficient">                      
			                    </div>
			                </div>

			                <div class="col-xs-12 col-sm-2 col-md-2">
			                    <div class="form-group">
			                    	 <input type="text" name="lieu_de_travail" id="lieu_de_travail" class="form-control" tabindex="2" placeholder="Lieu de travail">                      
			                    </div>
			                </div>
			            </div>
			   

				
					<div  class="part1">
						 <b>CONTRAT</b>
					</div>

					<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" name="contrat" id="CDI" value="CDI">
						  <label class="form-check-label" for="CDI">CDI</label>
					</div>
					<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" name="contrat" id="CDD" value="CDD">
						  <label class="form-check-label" for="CDD">CDD</label>
					</div>
					<div id="div-CDI">

					</div>
					<div id="tab-horaire-CDI">
						
					</div>
					<div id="vacance-scolaire">
						
					</div>
					<div id="intermittence">
					</div>
					
					<div id="div-CDD">
					</div>
					<div class="part1">
						 <b>RENSEIGNEMENTS COMPLEMENTAIRES</b>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4">
					    <div class="form-group">
					        <textarea id="info_sup" name="info_sup" placeholder="Renseignements supplementaires" class="form-control"></textarea>
		                      
					    </div>
					</div>
					<input type="submit" name="submit" value="Validez" class="btn btn-success" />
		  
		             <hr style="margin-top:10px;margin-bottom:10px;" >
		</form>
	</div>

		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript" src="./JS/fol49-2.js"></script>
</body>
</html>

