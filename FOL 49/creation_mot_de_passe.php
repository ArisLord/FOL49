<!DOCTYPE html>
<html>
<head>
	<meta dir="ltr" lang="fr-FR" charset="utf-8">
	<meta name="viewport" content="width=device=width, initial-scale=1">
	<link rel="icon" href="http://www.fol49.org/laligue49/wp-content/uploads/2016/05/icone-ligue.png" sizes="32x32" />
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	<link rel="stylesheet" type="text/css" href="./CSS/fol49.css">
	<title>mot de passe</title>
	
</head>
<body>

<div class="container">
    <div class="card card-login mx-auto text-center bg-dark">
        <div class="card-header mx-auto bg-dark">
            <span> <img src="http://www.fol49.org/laligue49/wp-content/uploads/2016/09/logo-fol49.png" class="w-75" alt="Logo"> </span><br/>
                        <span class="logo_title mt-5"> Créez votre mot de passe! </span>

        </div>

        <?php

            if (isset($_GET["err"]) and $_GET["err"]==101){

               echo " <div class=\"alert alert-danger \">";
               echo "<strong>Oups !</strong> vous n'êtes pas autorisé.e à créer un mot de passe  ";
               echo "</div>";
           }
           elseif (isset($_GET["err"]) and $_GET["err"]==102){

               echo " <div class=\"alert alert-danger \">";
               echo "<strong>Oups !</strong> les mots de passe ne correspondent pas";
               echo "</div>";
           }
        ?>

        <div>
            
            
        </div>
        <div class="card-body">
            <form action="./password_register.php" method="post">
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" name="email" class="form-control" placeholder="e-mail" required="required">
                </div>
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" name="password-1" class="form-control" placeholder="nouveau mot de passe" required="required">
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder=" confirmez  votre mot de passe" required="required">
                </div>

                <div class="form-group">
                    <input type="submit" name="btn" value="Enregistrez" class="btn btn-outline-danger float-right login_btn">
                </div>

            </form>
        </div>
    </div>
</div>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>
</html>
