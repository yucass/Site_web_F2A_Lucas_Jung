<?php
session_start();

include('include/connect.php');

$reponse = $bdd->query('SELECT * FROM client');

$type = $_GET['type'];

$nom = isset($_POST['nom']);
$prenom = isset($_POST['prenom']);
$pass = isset($_POST['password']);
$pass2 = isset($_POST['password2']);
$email = isset($_POST['email']);
$mess = 0;



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
               
                	<article>
                        <?php

if ($type == 'register')
{
echo '<form action="inscription.php?type=accept_client" method="post" name="formcontact">
                        	Nom :<br/><input type="text" placeholder="Nom" id="nom" name="nom"> <br/>
                        	Prénom : <br/><input type="text" placeholder="Prénom" id="prenom" name="prenom"> <br/>
                           Email :  <br/><input type="text" placeholder="Email" id="email" name="email"><br/>
						   Adresse :  <br/><input type="text" placeholder="Adresse" id="adresse" name="adresse"><br/>
						   Code Postal :  <br/><input type="text" placeholder="Code Postal" id="cp" name="cp"><br/>
						   Ville :  <br/><input type="text" placeholder="Ville" id="ville" name="ville"><br/>
                           Mot de passe : <br/><input type="password" placeholder="*****" id="password" name="password"><br/>
                           Retaper Mot de passe : <br/><input type="password" placeholder="*****" id="password2" name="password2"><br/>
                            
                        	<input type="submit" value="Envoyer"> <br/>
                        </form>';
				
							
}

if ($type == 'accept_client')
	{$mess = 0;
		
		if($_POST['password'] != $_POST['password2'])
			{echo "Le password ne correspond pas<br/>"; 
			$mess = 1;}
			
		if ($_POST['prenom'] == NULL)
			{echo "Veuillez saisir votre prenom<br/>"; 
			$mess = 1;}

		if($_POST['nom'] == NULL)
			{echo "Veuillez saisir votre nom<br/>"; 
			$mess = 1;}

		if ($_POST['adresse'] == NULL)
			{echo "Veuillez saisir votre adresse<br/>"; 
			$mess = 1;}

		if($_POST['cp'] == NULL)
			{echo "Veuillez saisir votre code postal<br/>"; 
			$mess = 1;}
		if ($_POST['ville'] == NULL)
			{echo "Veuillez saisir votre ville<br/>"; 
			$mess = 1;}
			
		if($_POST['password'] == NULL)
			{echo "Veuillez saisir votre mot de passe<br/>"; 
			$mess = 1;}
			

 
// Vérifie si la chaine ressemble à un email
if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo 'Cet email est correct.';
} else {
    echo 'Cet Email a un format non adapté.<br/>'; $mess=1;}
	
			
		if ($mess == 0)
		{
				$req = $bdd->prepare ('INSERT INTO client(NomClient, PrenomClient, pass, email, salt) VALUES(:NomClient, :PrenomClient, :pass, :email, :salt, :AdresseClient, :VilleClient, :Cp)');
						
				$salt = 'Ak8g!F3bV';

				$cryptpass = crypt($_POST['password'], $salt);
				$passwordToBeStored = password_hash($cryptpass, CRYPT_BLOWFISH);

				$req->execute(array(
				'PrenomClient'=>htmlspecialchars($_POST['prenom']),
				'NomClient'=>htmlspecialchars($_POST['nom']),
				'email'=>htmlspecialchars($_POST['email']),
				'pass'=>$passwordToBeStored,
				'AdresseClient'=>htmlspecialchars($_POST['adresse']),
				'VilleClient'=>htmlspecialchars($_POST['ville']),
				'Cp'=>htmlspecialchars($_POST['cp']),
				'salt'=>$cryptpass));	

		} else echo '<a href="inscription.php?type=register">Revenir au formulaire</a>';
	}
$reponse->closeCursor(); // Termine le traitement de la requete 

						?>
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
