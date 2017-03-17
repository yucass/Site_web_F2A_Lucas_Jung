<?php
 session_start();
 
include('include/connect.php');

$type = $_GET['type'];
$req = $bdd->prepare('SELECT * FROM produits');
$donnees = $req->fetch();



include_once("fonctions-panier.php");


$erreur = false;

$action = (isset($_POST['type'])? $_POST['type']:  (isset($_GET['type'])? $_GET['type']:null )) ;
if($action !== null)
{
   if(!in_array($action,array('ajout', 'suppression', 'refresh')))
   $erreur=true;

   //récuperation des variables en POST ou GET
   $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
   $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
   $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;

   //Suppression des espaces verticaux
   $l = preg_replace('#\v#', '',$l);
   //On verifie que $p soit un float
   $p = floatval($p);

   //On traite $q qui peut etre un entier simple ou un tableau d'entier
    
   if (is_array($q)){
      $QteArticle = array();
      $i=0;
      foreach ($q as $contenu){
         $QteArticle[$i++] = intval($contenu);
      }
   }
   else
   $q = intval($q);
    
}

if (!$erreur){
   switch($action){
      Case "ajout":
         ajouterArticle($l,$q,$p);
         break;

      Case "suppression":
         supprimerArticle($l); header('location:panier.php?type=basket');
         break;

      Case "refresh" :
         for ($i = 0 ; $i < count($QteArticle) ; $i++)
         {
            modifierQTeArticle($_SESSION['panier']['NumProduit'][$i],round($QteArticle[$i]));
         }
         break;

      Default:
         break;
   }
}

echo '<?xml version="1.0" encoding="utf-8"?>';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
<title>Votre panier</title>
</head>
<body>

<form method="post" action="panier.php?type=basket">
<table style="width: 400px">
	<tr>
		<td colspan="4">Votre panier</td>
	</tr>
	<tr>
		<td>Libellé</td>
		<td>Quantité</td>
		<td>Prix Unitaire</td>
		<td>Action</td>
	</tr>


	<?php
		    $test = $bdd->query('SELECT * FROM client');
$client = $test->fetch();
	if ($type == 'basket')
	{

	if (creationPanier())
	{
	   $nbArticles=count($_SESSION['panier']['NumProduit']);
	   if ($nbArticles <= 0)
	   echo "<tr><td>Votre panier est vide </ td></tr>";
	   else
	   { 


	      for ($i=0 ;$i < $nbArticles ; $i++)
	      {
	         echo "<tr>";
	         echo "<td>".htmlspecialchars($_SESSION['panier']['NumProduit'][$i])."</ td>";
	         echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"/></td>";
	         echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."</td>";
	         echo "<td><a href=\"".htmlspecialchars("panier.php?type=suppression&l=".rawurlencode($_SESSION['panier']['NumProduit'][$i]))."\">XX</a></td>";
	         echo "</tr>";
	      }

	      echo "<tr><td colspan=\"2\"> </td>";
	      echo "<td colspan=\"2\">";
	      echo "Total : ".MontantGlobal();
	      echo "</td></tr>";

	      echo "<tr><td colspan=\"4\">";
	      echo "<input type=\"submit\" value=\"Rafraichir\"/>";
	      echo "<input type=\"hidden\" name=\"type\" value=\"refresh\"/>";

	      echo "</td></tr>";
	   }

//echo 'Il y a ' . $nbligne['countnumbfact'] . ' entrée dans la table.';
	}
	}
		   $nbArticles=count($_SESSION['panier']['NumProduit']);
		  $requete = $bdd->query ('SELECT COUNT(NumFacture) as countnumbfact FROM facture');
      
$nbligne = $requete->fetch();
 
if ($type == 'validebasket')
	{ 

				$req = $bdd->prepare ('INSERT INTO facture (NumFacture, DateFacture, NumClient) VALUES(:NumFacture, :DateFacture, :NumClient)');
				$req->execute(array(
				'NumFacture'=>$nbligne['countnumbfact']+1,
				'DateFacture'=>date("Y-m-d"),
				'NumClient'=> $_SESSION['numcli']));
				
					
	 for ($i=0 ;$i < $nbArticles ; $i++)
	      {

				$req = $bdd->prepare ('INSERT INTO d_facture (Qte, NumFacture, NumProduit) VALUES(:Qte, :Numfacture, :NumProduit)');
				$req->execute(array(
				'Qte'=>$_SESSION['panier']['qteProduit'][$i],
				'Numfacture'=>$nbligne['countnumbfact']+1,
				'NumProduit'=>$_SESSION['panier']['NumProduit'][$i]));	
		
		  }
		  echo 'Revenir à l\'accueil : <br/><form method="post" action="index.php">
<a href="index.php">REVENIR A L\'ACCUEIL</a>'; supprimePanier();		  
		  }
		  
	?>
    
</table>
						
                        
</form>
<?php
if ($nbArticles > '0' && $type != 'validebasket')
{echo '
<form method="post" action="panier.php?type=validebasket">';
echo '
<input type="hidden" value="1" />
<input type="submit" value="Valider" />
</form>';}

 
?>
</body>
</html>
