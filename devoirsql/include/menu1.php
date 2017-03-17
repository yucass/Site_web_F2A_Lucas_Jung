<?php
$level = isset($_SESSION['level']);
$pseudo = isset($_SESSION['pseudo']);

//if ($pseudo == '0')
//{$_SESSION['pseudo'] = 'touriste';}


if (isset($_SESSION['pseudo'])){
$query = $bdd->prepare('SELECT * FROM client WHERE email= :pseudo ');
						$query->bindValue(':pseudo',$_SESSION['pseudo'], PDO::PARAM_STR);
        				$query->execute();
        				$info=$query->fetch();
				
				if ($level == '1')
{$_SESSION['level'] = $info['level'];}

$_SESSION['level'] = $info['level'];}

?>


<header>
	<menu>
    	<ul>  	 
			<li><a href="index.php">Accueil</a></li>
   			 <li><a href="produits.php">Produits</a></li>
             <?php 

										//if ($_SESSION['pseudo'] == 'touriste')
										if (!isset($_SESSION['pseudo'])){
											echo '<li><a href="inscription.php?type=register">Inscription</a></li>
												<li><a href="login.php">Connexion</a></li>';
										}
									
									if (isset($_SESSION['pseudo'])){ echo '<li><a href="profil.php">Profil</a></li>
									<li><a href="factures.php">Mes facutres</a></li>
   			 										<li><a href="deconnexion.php">deconnexion</a></li>';
									//echo $_SESSION['level'];
											if ($_SESSION['level'] == '9')
										{echo '<li><a href="admin/profil.php">Acces ADMIN PANEL</a></li>';
										}
										
										 $query->closeCursor();} ?>
   		
		</ul>
     </menu>
</header>


