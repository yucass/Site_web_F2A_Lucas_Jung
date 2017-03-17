 <?php
/* Démarre la session */
session_start();

include('..\include/connect.php');
	
include('..\include/check_session.php');

 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="..\style.css" rel="stylesheet"/>
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
                
                <a class="filariane" href="/" title="Accueil">Accueil</a><hr class="ariane"><a class="filariane" href="profil.php" title="Profil">Profil</a><br/>
              
                	<article>
                        
                        
                         <h2>Factures</h2>
                         <hr class="hr3"><br/><br/>
                         <p>
                      <?php 
$reponse = $bdd->query('SELECT * FROM facture, client WHERE facture.NumClient=client.NumClient');

echo '<table>
			<tr>
				<th>N° facture</th>
				<th>Date</th>
				<th>N° Client </th>
				<th>Nom Client</th>
				<th>Prenom Client</th>
				<th>Ville</th>
				<th>Pays</th>
			</tr>';
while ($donnees = $reponse->fetch())
{
	echo 	'<tr>
				<td><a href="detailfacture.php?facture='.$donnees['NumFacture'].'">'.$donnees['NumFacture'].'</a></td>
				<td>'.$donnees['DateFacture'].'</td>
				<td><a href="detailclient.php?client='.$donnees['NumClient'].'">'.$donnees['NumClient'].'</a></td>
				<td>'.$donnees['NomClient'].'</td>
				<td>'.$donnees['PrenomClient'].'</td>
				<td>'.$donnees['VilleClient'].'</td>
				<td>'.$donnees['PaysClient'].'</td>
			<tr/>';
			
	
}

$reponse->closeCursor(); // Termine le traitement de la requete} ?>



                         </p>
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