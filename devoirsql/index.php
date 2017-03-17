<?php

session_start();

include('include/connect.php');


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
		
						
							$reponse = $bdd->query('SELECT * FROM produits LIMIT 5');
							while ($donnees = $reponse->fetch())
									{
										echo '<a href="detailproduit.php?produit='.$donnees['NumProduit'].'"><div class="produit"> <img src="'.$donnees['image'].'" height="100px"><br> Produit : '.$donnees['Des'].'<br/>'."Prix : ".$donnees['PUHT'].'<br/></div></a>';
									}$reponse->closeCursor();
	
						?>
                         
                    </article>
                    		
                    <article>
                    	<img src="images/promobanner01.jpg" width="100%">
                    </article>
                    
                    
                </section>
                <!--fin section-->
				<aside>
                    <img src="images/promo01.jpg" width="200%">
                    <img src="images/promo02.jpg" width="200%">
                </aside>
                
            </div>
            <!--fin contenu-->
            
               
        
        </div>
<!--Fin contener-->

		 <?php include('include/footer.php'); ?>
        
</body>
</html>