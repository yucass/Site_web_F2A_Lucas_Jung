<?php
session_start();

include('..\include/connect.php');
	
include('..\include/check_session.php');


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="..\style_admin.css" rel="stylesheet"/>
<title>Blog Test - Profil</title>
</head>

<body>

<!--Debut contener-->
		<div id="contener">
        	
            
            <!--debut contenu-->
            <div id="contenu">
            	<!--debut section-->
				<?php include('../include/menu2.php'); ?>
                <section>
                
                	<article>
                        
                        
                         <h2>Clients</h2>
                         <hr class="hr3">
                         <p>
                         <br/>Pour ajouter un client, rendez-vous sur la page d'inscription <a href="../inscription.php?type=register">En CLIQUANT ICI</a>
<?php


//AFFICHAGE LISTE DES CLIENTS

$reponse = $bdd->query('SELECT * FROM client');
	echo '<table cellspacing="0" cellpadding="2">
			<tr>
				<th>N° client</th>
				<th>Nom</th>
				<th>Prenom </th>
				<th>Adresse</th>
				<th>CP</th>
				<th>Ville</th>
				<th>Pays </th>
			</tr>';
	while ($donnees = $reponse->fetch())
		{		
			echo '<tr><td><a href="detailclient.php?client='.$donnees['NumClient'].'">'.$donnees['NumClient'].'</a></td><td>'.'<a href="detailclient.php?client='.$donnees['NumClient'].'">'.$donnees['NomClient'].'</a></td><td>'.$donnees['PrenomClient']."</td><td>".$donnees['AdresseClient'].'</td><td>'.$donnees['Cp'].'</td><td>'.$donnees['VilleClient'].'</td><td>'.$donnees['PaysClient'].'</td><tr/><br/>';
		}

$reponse->closeCursor(); // Termine le traitement de la requete}

?>
</article>
                    		
                    <article>
                    	
                    </article>
                </section>
                <!--fin section-->

                
            </div>
            <!--fin contenu-->
            
               
        
        </div>
<!--Fin contener-->

        
</body>
</html>