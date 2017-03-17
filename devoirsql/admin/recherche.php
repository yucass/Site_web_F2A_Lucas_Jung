<?php
session_start();

include('..\include/connect.php');
	
include('..\include/check_session.php');



//FONCTION DE RECHERCHE - Ne fonctionne pas
if (isset($_GET['recherche']))
{
$req = $bdd->prepare('SELECT distinct * FROM facture, client, produits  WHERE client.NumClient=?');
$req->execute(array($_GET['recherche']));
echo 'resultats de la recherche';
while ($donnees = $req->fetch())
{}
	if ($_GET['recherche']==$donnees['NumClient'])
	{ echo 'Nom du client : '.$donnees['NomClient'].'<br/>'.'Numero du client : '.$donnees['NumClient'];}
	

	if ($_GET['recherche']==$donnees['NumFacture'])
	{ echo 'Num facture : '.$donnees['NumFacture'];}
	
	echo 'Num Facture : '.$donnees['NumFacture'].' Date '.$donnees['DateFacture'].' Num Client : '.$donnees['NumClient'].'<br/>';
	


}
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
             
                	<article>
                        <form action="recherche.php" method="get" name="formcontact">
                        	<input type="search" placeholder="recherche" id="recherche" name="recherche"> <br/>
                            <input type="submit" value="Envoyer"> <br/>
                        </form>
                        
                         <h2>Factures</h2>
                         <hr class="hr3"><br/><br/>
                      
<?php

echo '
    <FORM method="get" action="#">
    <INPUT type="checkbox" name="choix1" value="1" > clients
    <INPUT type="checkbox" name="choix2" value="2"> factures
    <INPUT type="checkbox" name="choix3" value="3"> produits
    <input type="submit" value="executer" />
    </FORM>';




 if (isset($_GET['choix1']) == 1)
{
//AFFICHAGE LISTE DES CLIENTS

$reponse = $bdd->query('SELECT * FROM client');
	echo '<table>
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
	echo '<tr><td><a href="detailclient.php?client='.$donnees['NumClient'].'">'.$donnees['NumClient'].'</a></td><td>'.'<a href="detailclient.php?client='.$donnees['NumClient'].'">'.$donnees['NomClient'].'</a></td><td>'.$donnees['PrenomClient']."</td><td>".$donnees['AdresseClient'].'</td><td>'.$donnees['Cp'].'</td><td>'.$donnees['VilleClient'].'</td><td>'.$donnees['PaysClient'].'</td><tr/>';
}

$reponse->closeCursor(); // Termine le traitement de la requete}
}

if (isset($_GET['choix2']) == 2)
{
  //AFFICHAGE DETAIL D'UNE FACTURE

$reponse = $bdd->query('SELECT * FROM facture, client WHERE facture.NumClient=client.NumClient');

echo '<br/><table>
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

$reponse->closeCursor(); // Termine le traitement de la requete}
}

if (isset($_GET['choix3']) == 3)
{
	// AFFICHAGE PRODUITS
	
	
	$reponse = $bdd->query('SELECT * FROM produits');
	echo '<table>
			<tr>
				<th>N° produit</th>
				<th>Libellé</th>
				<th>PUHT</th>
				<th>Détail</th>
				<th>Stock</th>
				<th>Adresse image</th>
			</tr>';
while ($donnees = $reponse->fetch())
{		
	echo '<tr>
			<td><a href="detailproduit.php?produit='.$donnees['NumProduit'].'">'.$donnees['NumProduit'].'</a></td>
			<td>'.'<a href="detailproduit.php?produit='.$donnees['NumProduit'].'">'.$donnees['Des'].'</a></td>
			<td>'.$donnees['PUHT'].'</td>
			<td>'; if (strlen($donnees['detail'])>25) {$donnees['detail']=substr($donnees['detail'], 0, 25);}echo $donnees['detail'].'...</td>
			<td>'.$donnees['stock'].'</td>
			<td>'.$donnees['image'].'</td>
		<tr/>';
}

$reponse->closeCursor(); // Termine le traitement de la requete}
}




?>
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