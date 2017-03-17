 <?php
 session_start();


include('include/connect.php');
 

$test = $bdd->query('SELECT * FROM prod_categorie');
$cat = $test->fetch();


$type = isset($_GET['type']);


 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="style.css" rel="stylesheet"/>
<title>LOGIN_SQL</title>
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

  //AFFICHAGE DETAIL D'UNE FACTURE

$req = $bdd->prepare('SELECT * FROM produits, prod_categorie WHERE NumProduit=?');
	$req->execute(array($_GET['produit']));
		$donnees = $req->fetch();


$test = $bdd->query('SELECT * FROM prod_categorie');
	$cat = $test->fetch();
	 
	 echo '<br/>Reference produits : '.$donnees['NumProduit'].' '."<br/>Description : ".$donnees['Des']."<br/> Prix unitaire HT : ".$donnees['PUHT']."<br/>";
	$req->closeCursor();
	$test->closeCursor();

		$NumProduit = $donnees['NumProduit'];
		$prixProduit = $donnees['PUHT'];
		
		
//AJOUT DANS LE PANIER
   //Si le panier existe 
	if ($type == 'd')
		{$qteProduit = $_POST['qteProduit'];  
   if (creationPanier())
   	{  
      //Si le produit existe déjà on ajoute seulement la quantité
      $positionProduit = array_search($NumProduit,  $_SESSION['panier']['NumProduit']);

     	 if ($positionProduit !== false)
    	  {		
      	   $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit ;
     	 }
     	 else
      		{
         //Sinon on ajoute le produit
         array_push( $_SESSION['panier']['NumProduit'],$NumProduit);
         array_push( $_SESSION['panier']['qteProduit'],$qteProduit);
         array_push( $_SESSION['panier']['prixProduit'],$prixProduit);
     		 }
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
		}
						?>
                         
                    </article>
                    		
                    <article>

                        
                        <form method="post" action="detailproduit.php?produit=<?php echo $donnees['NumProduit']?>&type=d">
                        <input type="hidden" name="addprod" id="addprd" value="<?php echo $donnees['NumProduit']?>"/>
                        <input type="text" name="qteProduit" id="qteProduit" value="1"/>
                        <p><input type="submit" value="ajouter" /></p></form>
                        
                        <a href="panier.php?type=basket">panier</a>
                        



                    </article>
                </section>
                <!--fin section-->

                
            </div>
            <!--fin contenu-->
            
               
        
        </div>
<!--Fin contener-->

        
</body>
</html>