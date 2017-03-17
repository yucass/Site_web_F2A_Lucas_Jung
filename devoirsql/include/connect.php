<?php
isset($_SESSION['pseudo']);
isset($_SESSION['pass']);
isset($_SESSION['level']);
isset($_SESSION['numcli']);

function creationPanier(){
   if (!isset($_SESSION['panier'])){
      $_SESSION['panier']=array();
      $_SESSION['panier']['NumProduit'] = array();
      $_SESSION['panier']['qteProduit'] = array();
      $_SESSION['panier']['prixProduit'] = array();
      $_SESSION['panier']['verrou'] = false;
   }
   return true;
}

//CONNEXION A LA BASE
try 
{
	$bdd = new PDO ('mysql:host=localhost;dbname=test','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); //array permet le debuggage
}
catch (Exception $e)
{die('erreur : '.$e->getMessage());
}

?>