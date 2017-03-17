<?php
session_start();

include('..\include/connect.php');
	
include('..\include/check_session.php');





//MISE A JOUR DU CLIENT DANS LA BDD

 if( isset($_POST['NomClient']) != NULL && isset($_POST['PrenomClient']) != NULL && isset($_POST['email']) != NULL)
			{
				 $req = $bdd->prepare('
				 UPDATE client 
				 SET email = ?,
				  NomClient = ?,
				  PrenomClient = ?,
				  AdresseClient = ?,
				  Cp = ?,
				  VilleClient = ?,
				  PaysClient = ?,
				  level = ? 
				  WHERE NumClient = ?');
				  
				$req->execute(array(
				htmlspecialchars($_POST['email']),
				htmlspecialchars($_POST['NomClient']),
				htmlspecialchars($_POST['PrenomClient']),
				htmlspecialchars($_POST['AdresseClient']),
				htmlspecialchars($_POST['Cp']),
				htmlspecialchars($_POST['VilleClient']),
				htmlspecialchars($_POST['PaysClient']),
				htmlspecialchars($_POST['niveau']),
				$_GET['client']));	
				
				echo ("<br/>Utilisateur modifié avec succes");
	
			}
 //Ouverture base Client
$req = $bdd->prepare('SELECT * FROM client WHERE client.NumClient=?');
	$req->execute(array($_GET['client']));
		$donnees = $req->fetch();
		$client = $donnees['NumClient'];

//Ouverture base Niveau
$test = $bdd->query('SELECT * FROM niveau');
	$niveau = $test->fetch();

$req->closeCursor();
 
 ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../style_admin.css" rel="stylesheet"/>
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
                        
                        
                         <h2>Client <?php echo $donnees['NomClient'].' '.$donnees['PrenomClient'] ?></h2>
                         <hr class="hr3"><br/><br/>
                         <p>
	<table>
			<tr>
				<th>N° client</th>
				<th>Nom</th>
				<th>Prenom </th>
                <th>Email</th>
				<th>Adresse</th>
				<th>CP</th>
				<th>Ville</th>
				<th>Pays </th>
			</tr>
	<?php
	// AFFICHAGE DU TABLEAU DU CLIENT
	echo '<tr><td><a href="detailclient.php?client='.$donnees['NumClient'].'">'.$donnees['NumClient'].'</a></td>
	<td>'.'<a href="detailclient.php?client='.$donnees['NumClient'].'">'.$donnees['NomClient'].'</a></td>
	<td>'.$donnees['PrenomClient']."</td>
	<td>".$donnees['email']."</td>
	<td>".$donnees['AdresseClient'].'</td>
	<td>'.$donnees['Cp'].'</td>
	<td>'.$donnees['VilleClient'].'</td>
	<td>'.$donnees['PaysClient'].'</td><tr/><br/></table>';
?>
</p></article>
 <article>
                    	<br> <h1> Effectuer un changement</h2>
                        <form method="post" action="#">
					<fieldset>
						<legend>Modifier le client : <?php echo $donnees['NomClient'].' '.$donnees['PrenomClient'] ?></legend>
						<p>
							<label for="email">E-Mail :</label><input name="email" type="text" id="email" value="<?php echo $donnees['email'];?>"/><br />
							<label for="NomClient">Nom Client :</label><input type="text" name="NomClient" id="NomClient" value="<?php echo $donnees['NomClient']?>" /><br />
                            <label for="PrenomClient">Prenom Client :</label><input type="text" name="PrenomClient" id="PrenomClient" value="<?php echo $donnees['PrenomClient']?>" /><br />
                            <label for="AdresseClient">Adresse Client :</label><input type="text" name="AdresseClient" id="AdresseClient" value="<?php echo $donnees['AdresseClient']?>" /><br />
                            <label for="Cp">Code Postal :</label><input type="text" name="Cp" id="Cp" value="<?php echo $donnees['Cp']?>" /><br />
                            <label for="VilleClient">Ville :</label><input type="text" name="VilleClient" id="VilleClient" value="<?php echo $donnees['VilleClient']?>" /><br />
                            <label for="PaysClient">Pays Client :</label><input type="text" name="PaysClient" id="PaysClient" value="<?php echo $donnees['PaysClient']?>" /><br />
                            <label for="niveau">Niveau :</label> <SELECT name="niveau" size="1"><?php while ($niveau = $test->fetch())
									{echo "<option>".$niveau['level'];}?></SELECT>
                                    niveau actuel : <?php echo $donnees['level'];?>
						</p>
					</fieldset>
						<p><input type="submit" value="modifier" /></p></form>
                    </article>
                    <article>
<h1>FACTURE DU CLIENT</h1>
<?php






while ($donnees = $req->fetch())
	{  
		echo '<a href="detailfacture.php?facture='.$donnees['NumFacture'].'">Numero Facture : '.$donnees['NumFacture'].'</a><br/>';
 	}

 $query->closeCursor();

?>
<h1>SUPPRIMER LE CLIENT</h1>
   <form  method="post" action="#">
   <label for="delete">cocher la case pour supprimer le client :<br/></label>
   <input type="checkbox" name="delete" id="delete" value="1"/>
   <input type="submit" value="Supprimer" />
   </form>


<?php 
if (isset($_POST['delete']) == "1")
{
 $req = $bdd->exec("DELETE FROM client WHERE NumClient=".$_GET['client']);

header('location:clients.php');
}
?>

                    		
                   </article>
                </section>
                <!--fin section-->

                <?php $req->closeCursor(); ?>
            </div>
            <!--fin contenu-->
            
               
        
        </div>
<!--Fin contener-->

        
</body>
</html>