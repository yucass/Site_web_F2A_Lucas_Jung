<?php
session_start();
isset($_SESSION['pseudo']);
isset($_SESSION['pass']);
isset($_SESSION['level']);


include('include/connect.php');

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="style.css" rel="stylesheet"/>
<title>TEST - Produits</title>
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


						
							$reponse = $bdd->query('SELECT * FROM produits');
							while ($donnees = $reponse->fetch())
									{
										echo '<a href="detailproduit.php?produit='.$donnees['NumProduit'].'"><div class="produit"> <img src="'.$donnees['image'].'" width="200px"><br> Produit : '.$donnees['Des'].'<br/>'."Prix : ".$donnees['PUHT'].'<br/></div></a>';
									}

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

		 <?php include('include/footer.php'); ?>
        
</body>
</html>