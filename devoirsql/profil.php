<?php
/* Démarre la session */
session_start();

include('include/connect.php');
	
include('include/check_session.php');

if(isset($_POST['email']) != NULL && isset($_POST['NomClient']) != NULL && isset($_POST['PrenomClient']) != NULL)
			{
				 $req = $bdd->prepare('
				 UPDATE client 
				 SET email = ?,
				 NomClient = ?,
				 PrenomClient = ?,
				 AdresseClient = ?,
				 Cp = ?, 
				 VilleClient = ?,
				 PaysClient = ?
				 WHERE email =?');
				$req->execute(array(
				htmlspecialchars($_POST['email']),
				htmlspecialchars($_POST['NomClient']),
				htmlspecialchars($_POST['PrenomClient']),
				htmlspecialchars($_POST['AdresseClient']),
				htmlspecialchars($_POST['Cp']),
				htmlspecialchars($_POST['VilleClient']),
				htmlspecialchars($_POST['PaysClient']),
				$_SESSION['pseudo']));	
				
				}//}
				
$req = $bdd->prepare('SELECT * FROM client WHERE client.email=?');
	$req->execute(array($_SESSION['pseudo']));
		$donnees = $req->fetch();
		$client = $donnees['email'];
 ?>


    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet"/>
<title>Blog Test - Profil</title>



</head>

<body>

<!--Debut contener-->
		<div id="contener">
        	
            
            <!--debut contenu-->
            <div id="contenu">
            	<!--debut section-->
                <?php include('include/menu1.php'); ?>

                <section>

                	<article>
                        
                        
                         <h2>PROFIL</h2>
                         <hr class="hr3"><br/><br/>
                         <p>
                      <?php echo "Bienvenue ".$donnees['NomClient'].", vous êtes sur votre profil"; ?>
                         </p>
                    </article>
                    		
                    <article>
                    	<br> <p><h1>Effectuer un changement</h1></p>
                        <form method="post" action="#">
					<fieldset>
						<legend>Modifier vos informations</legend>
						<p>
							<label for="email">E-Mail :<br/></label><input name="email" type="text" id="email" value="<?php echo $donnees['email'];?>"/><br />
							<label for="NomClient">Nom Client :<br/></label><input type="text" name="NomClient" id="NomClient" value="<?php echo $donnees['NomClient']?>" /><br />
                            <label for="PrenomClient">Prenom Client :<br/></label><input type="text" name="PrenomClient" id="PrenomClient" value="<?php echo $donnees['PrenomClient']?>" /><br />
                            <label for="AdresseClient">Adresse Client :<br/></label><input type="text" name="AdresseClient" id="AdresseClient" value="<?php echo $donnees['AdresseClient']?>" /><br />
                            <label for="Cp">Code Postal :<br/></label><input type="text" name="Cp" id="Cp" value="<?php echo $donnees['Cp']?>" /><br />
                            <label for="VilleClient">Ville :<br/></label><input type="text" name="VilleClient" id="VilleClient" value="<?php echo $donnees['VilleClient']?>" /><br />
                            <label for="PaysClient">Pays Client :<br/></label><input type="text" name="PaysClient" id="PaysClient" value="<?php echo $donnees['PaysClient']?>" />
						</p>
					</fieldset>
						<p><input type="submit" value="modifier"/></p></form>
                    </article>
                </section>
                <!--fin section-->

                
            </div>
            <!--fin contenu-->
            
                <?php include('include/footer.php'); ?>
        <?php $req->closeCursor(); ?>
        </div>
<!--Fin contener-->
</body>
</html>