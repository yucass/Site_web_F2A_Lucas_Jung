 <?php
 session_start();

include('..\include/connect.php');
	
include('..\include/check_session.php');

$type = isset($_GET['type']);

$test = $bdd->query('SELECT * FROM prod_categorie');
$cat = $test->fetch();

if(isset($_POST['Des']) != NULL && isset($_POST['PUHT']) != NULL)
			{
				//$req = $bdd->prepare ('INSERT INTO produits(Des, PUHT) VALUES(:Des, :PUHT) ');
			if($_POST['Des'] != NULL && $_POST['PUHT'] != NULL)
			{
				$req = $bdd->prepare ('UPDATE produits
				SET Des = ?,
				PUHT=?,
				detail=?,
				cat_number=?,
				stock=?
				WHERE NumProduit = ?');
				$req->execute(array(
				htmlspecialchars($_POST['Des']),
				htmlspecialchars($_POST['PUHT']),
				htmlspecialchars($_POST['detail']),
				htmlspecialchars($_POST['cat_number']),
				htmlspecialchars($_POST['stock']),
				$_GET['produit']));	
			} else echo("Verifiez les champs de saisi");


				//$req->execute(array(
				//'Des'=>,
				//'PUHT'=>isset($_POST['PUHT'])));	
			}
  


 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="../style.css" rel="stylesheet"/>
<title>LOGIN_SQL</title>
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


	if ($type == 'd')
		{$qteProduit = $_POST['qteProduit'];  
   //Si le panier existe
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
                    
                    
                
                        
                    	<br> <h1> Effectuer un changement</h1>
                        <form method="post" action="#">
					<fieldset>
						<legend>Modifier le produit : <?php echo $donnees['Des'] ?></legend>
						<p>
							<label for="Description">Description :<br/></label><input name="Des" type="text" id="Des" value="<?php echo $donnees['Des']?>"/><br />
                            <label for="Détail">Détail :<br/></label><textarea name="detail" id="detail"rows="5" maxlength="255" cols="50"><?php echo $donnees['detail']?></textarea><br />
							<label for="PUHT">Prix Unitaire Hors Taxes :<br/></label><input type="text" name="PUHT" id="PUHT" value="<?php echo $donnees['PUHT']?>" />
                            <label for="stock">Stock :</label><input type="number" name="stock" id="stock" value="<?php echo $donnees['stock']?>" />
                            <SELECT name="cat_number" size="1"> <?php while ($cat = $test->fetch())
									{echo "<option>".$cat['cat_number'];}?> </SELECT>
                            
						</p>
					</fieldset>

						<p><input type="submit" value="modifier" /></p></form>
                        
                        
                        <h1>AJOUTER AU PANIER</h1>
                        <form method="post" action="detailproduit.php?produit=<?php echo $donnees['NumProduit']?>&type=d">
                        <input type="hidden" name="addprod" id="addprd" value="<?php echo $donnees['NumProduit']?>"/>
                        <input type="text" name="qteProduit" id="qteProduit" value="1"/>
                        <p><input type="submit" value="ajouter" /></p></form>
                        
                        <a href="panier.php?type=basket">panier</a>
                        
<h1>SUPPRIMER LE PRODUIT</h1>
   <form  method="post" action="#">
   <label for="delete">cocher la case pour supprimer le produit :<br/></label>
   <input type="checkbox" name="delete" id="delete" value="1"/>
   <input type="submit" value="Supprimer" />
   </form>


<?php 

if (isset($_POST['delete']) == "1")
	{
 		$req = $bdd->exec("DELETE FROM produits WHERE NumProduit=".$_GET['produit']);
		header('location:produits.php');
	}
?>

                    </article>
                </section>
                <!--fin section-->

                
            </div>
            <!--fin contenu-->
            
               
        
        </div>
<!--Fin contener-->

        
</body>
</html>