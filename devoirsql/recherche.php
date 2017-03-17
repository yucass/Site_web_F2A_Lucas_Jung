<?php
session_start();

include('include/menu2.php');

//CONNEXION A LA BASE
try 
{
	$bdd = new PDO ('mysql:host=localhost;dbname=test','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); //array permet le debuggage
}
catch (Exception $e)
{die('erreur : '.$e->getMessage());
}

$reponse = $bdd->query('SELECT * FROM user');

while ($donnees = $reponse->fetch())
{
	echo "pseudo : ".$donnees['pseudo'].' '."Pass : ".$donnees['pass'].'<br/>';

$reponse->closeCursor(); // Termine le traitement de la requete
		
//Conexion Success
		if ($_SESSION['pseudo'] == $donnees['pseudo']) 
			{  			

   		}else{ header('Location: deconnexion.php');exit();}}


/*
//FONCTION DE RECHERCHE

$req = $bdd->prepare('SELECT * FROM facture, client, produits  WHERE NumFacture=? OR client.NumClient=? OR facture.NumClient=? OR client.NomClient=?');
$req->execute(array($_GET['recherche'],$_GET['recherche'],$_GET['recherche'],$_GET['recherche']));
echo 'resultat de la recherche<br/><br/>';
while ($donnees = $req->fetch())
{
	if ($_GET['recherche']==$donnees['NomClient'] || $_GET['recherche']==$donnees['NumClient'])
	{ echo 'Nom du client : '.$donnees['NomClient'].'<br/>'.'Numero du client : '.$donnees['NumClient'];}
	echo '<br/>';

	if ($_GET['recherche']==$donnees['NumFacture'])
	{ echo 'Num facture : '.$donnees['NumFacture'];}
	
	//echo 'Num Facture : '.$donnees['NumFacture'].' Date '.$donnees['DateFacture'].' Num Client : '.$donnees['NumClient'].'<br/>';
	
}

*/
 ?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Document sans titre</title>
</head>

<body>

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

while ($donnees = $reponse->fetch())
{

	echo '<a href="detailclient.php?client='.$donnees['NumClient'].'">Numero de client : '.$donnees['NumClient'].' '."NomClient : ".$donnees['NomClient']." Prenom client : ".$donnees['AdresseClient']." CP : ".$donnees['Cp']." VilleClient : ".$donnees['VilleClient']." PaysClient : ".$donnees['PaysClient'].'</a><br/>';
}

$reponse->closeCursor(); // Termine le traitement de la requete}
}

if (isset($_GET['choix2']) == 2)
{
  //AFFICHAGE DETAIL D'UNE FACTURE

$reponse = $bdd->query('SELECT * FROM facture');

while ($donnees = $reponse->fetch())
{
	echo '<a href="detailfacture.php?facture='.$donnees['NumFacture'].'">Numero la facture : '.$donnees['NumFacture'].'</a>'."<br/>Date de la facture : ".$donnees['DateFacture']."<br/> Numero de Client : ".$donnees['NumClient']."<br/>";
	
}

$reponse->closeCursor(); // Termine le traitement de la requete}
} else echo '';

if (isset($_GET['choix3']) == 3)
{
$reponse = $bdd->query('SELECT * FROM produits');

while ($donnees = $reponse->fetch())
{

	echo "Numero Produit : ".$donnees['NumProduit'].' '."Description : ".$donnees['Des']." PUHT : ".$donnees['PUHT']." HT".'<br/>';



}$reponse->closeCursor(); // Termine le traitement de la requete
}

?>

</body>
</html>