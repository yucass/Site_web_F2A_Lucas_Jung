<?php
session_start();

include('..\include/connect.php');
	
include('..\include/check_session.php');


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
                        <a href="addsystem.php?type=product">AJOUTER UN ARTICLE</a>
                        <?php
		
						
							$reponse = $bdd->query('SELECT * FROM produits');
							while ($donnees = $reponse->fetch())
									{
										echo '<a href="detailproduit.php?produit='.$donnees['NumProduit'].'"><div class="produit"> <img src="'.$donnees['image'].'" width="200px"><br> Produit : '.$donnees['Des'].'<br/>'."Prix : ".$donnees['PUHT'].' Euros HT<br/></div></a>';
									}
	
	$reponse->closeCursor();
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