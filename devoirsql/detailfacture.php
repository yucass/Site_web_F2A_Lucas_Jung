 <?php
  session_start();
// Chargement des données
include('include/connect.php');
include('include/check_session.php');


 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="style.css" rel="stylesheet"/>
<title>TEST - DETAIL FACTURE</title>
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
$req = $bdd->prepare('SELECT * FROM facture WHERE NumFacture=?');
	$req->execute(array($_GET['facture']));
	$donnees = $req->fetch();

		// VERIFICATION QUE L'UTILISATEUR CONSULTE BIEN SES FACTURES 
		 if ($_SESSION['numcli'] == $donnees['NumClient']){
			 echo '<br/>Numero la facture : '.$donnees['NumFacture'].' '."<br/>Date de la facture : ".$donnees['DateFacture']."<br/> Numero de Client : ".$donnees['NumClient']."<br/>";
			}$req->closeCursor();
	
//AFFICHE LES PRODUITS DE LA FACTURE
$req = $bdd->prepare('SELECT * FROM d_facture, produits WHERE d_facture.NumFacture=? AND d_facture.NumProduit=produits.NumProduit');
	$req->execute(array($donnees['NumFacture']));

		while ($donnees = $req->fetch())
			{ echo '<br/><a href="detailproduit.php?produit='.$donnees['NumProduit'].'">Ref article : '.$donnees['NumProduit'].'</a><br/>quantite article : '.$donnees['Qte'].'<br/>';
			echo 'description : '.$donnees['Des'].'<br/>';

			}$req->closeCursor();
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
