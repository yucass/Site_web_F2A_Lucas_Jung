<?php
/* Démarre la session */
session_start();

include('include/connect.php');
	
include('include/check_session.php');


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet"/>
<title>Blog Test - Profil</title>



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
                        
                        
                         <h2>Mes factures</h2>
                         <hr class="hr3"><br/><br/>
                         
                        <?php echo 'FACTURES DU CLIENT<br/>';
						
		$req = $bdd->query('SELECT * FROM client WHERE client.email="'.$_SESSION['pseudo'].'"');
			$data = $req->fetch();
				$client = $data['NumClient'];
				
$req = $bdd->query('SELECT * FROM facture WHERE facture.NumClient="'.$client.'"');

				while ($donnees = $req->fetch())
					{  echo '<a href="detailfacture.php?facture='.$donnees['NumFacture'].'">Numero Facture : '.$donnees['NumFacture'].'</a><br/>';
					 }
		$req->closeCursor(); 
?>
                    </article>
                    		
                    <article>
  
                    </article>
                </section>
                <!--fin section-->

                
            </div>
            <!--fin contenu-->
            
                <?php include('include/footer.php'); ?>

        </div>
<!--Fin contener-->
</body>
</html>