	<?php
session_start();

include('include/connect.php');


if (!isset($_POST['pseudo']))
{$_POST['pseudo'] = 'touriste';}

$logpass = 0;
if (isset($_POST['password']))
{$logpass = $_POST['password'];}

$query = $bdd->query('SELECT * FROM client');

while ($donnees = $query->fetch())
	{if ($donnees['email'] == htmlspecialchars($_POST['pseudo']))
		{		

			if (password_verify($logpass, $donnees['salt']))
				{
				
					if (password_verify($donnees['salt'], $donnees['pass']))
						{ 
							$_SESSION['pseudo'] = $_POST['pseudo'];
							$_SESSION['level'] = $donnees['level'];
							$_SESSION['pass'] = $_POST['password'];
							$_SESSION['numcli'] = $donnees['NumClient'];
	    					header('Location: profil.php');exit();  			

						} else echo '<br>le mot de passe est faux'; //header('Location: deconnexion.php');exit();}
				}
		}
	}$query->closeCursor();
			

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet"/>
<title>Connexion</title>
</head>

<body>
<!--Debut contener-->
		<div id="contener">
        	
            
            <!--debut contenu-->
            <div id="contenu">
            	<!--debut section-->
                <?php include('include/menu1.php'); ?>
                <section>
                
                <a class="filariane" href="/blog/" title="Accueil">Accueil</a><hr class="ariane"><a class="filariane" href="login.php" title="Connexion">Connexion</a><br/>
              
                	<article>
                        
                        
                         <h2>CONNEXION</h2>
                         <hr class="hr3"><br/><br/>
                         <p>

<form method="post" action="login.php">
	<fieldset>
	<legend>Connexion à l'espace membre :</legend>
	<p>
	<label for="pseudo">Adresse Email :</label><input name="pseudo" type="text" id="pseudo" /><br />
	<label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
	</p>
	</fieldset>
	<p><input type="submit" value="Connexion" /></p></form>
	<a href="inscription.php?type=register">Pas encore inscrit ?</a>
	 
	<br />
                         </p>
                    </article>
                    		
                    <article>
                    	
                    </article>
                </section>
                <!--fin section-->

                
            </div>
            <!--fin contenu-->
            
                <?php include('include/footer.php'); ?>
        
        </div>
<!--Fin contener-->

		
        
</body>
</html>
