<?php
session_start();

$type = $_GET['type'];
include('..\include/connect.php');
	
include('..\include/check_session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="..\style.css" rel="stylesheet"/>
<title>Blog Test - Profil</title>
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
                        
                        
                         <h2>Clients</h2>
                         <hr class="hr3"><br/><br/>
                         <p>

<?php

//CONNEXION A LA BASE
try 
{
	$bdd = new PDO ('mysql:host=localhost;dbname=test','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); //array permet le debuggage
}
catch (Exception $e)
{die('erreur : '.$e->getMessage());
}
		 $test = $bdd->query('SELECT * FROM prod_categorie');
$cat = $test->fetch();

if ($type == 'product')
	{

		echo '<form method="post" action="addsystem.php?type=accept_product">
					<fieldset>
						<legend>Ajouter un produits :</legend>
						<p>
							<label for="Nom">Nom :</label><input name="Des" type="text" id="Des" /><br />
							<label for="PUHT">Prix Unitaire Hors Taxes :</label><input type="text" name="PUHT" id="PUHT" />
							<label for="PUHT">Description :</label><input type="textarea" name="detail" id="detail" />
							<label for="PUHT">Stock :</label><input type="number" name="stock" id="stock" />
							 <SELECT name="cat_number" id="cat_number">'; 
							 while ($cat = $test->fetch())
									{echo "<option>".$cat['cat_number'];} 
									echo '</SELECT>
						</p>
					</fieldset>
						<p><input type="submit" value="Créer" /></p></form>';
	}
			
if ($type == 'accept_product')
	{
		if($_POST['Des'] != NULL && $_POST['PUHT'] != NULL)
			{ echo $_POST['cat_number'];
				$req = $bdd->prepare ('INSERT INTO produits(Des, PUHT, detail, stock, cat_number) VALUES(:Des, :PUHT, :detail, :stock, :cat_number)');
				echo ("<br/>Produit ajouté avec succes");
				$req->execute(array(
				'Des'=>htmlspecialchars($_POST['Des']),
				'PUHT'=>htmlspecialchars($_POST['PUHT']),
				'detail'=>htmlspecialchars($_POST['detail']),
				'stock'=>htmlspecialchars($_POST['stock']),
				'cat_number'=>htmlspecialchars($_POST['cat_number'])));	
			} else echo("Verifiez les champs de saisi");
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

        
</body>
</html>