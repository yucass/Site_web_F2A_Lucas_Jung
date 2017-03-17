<?php

//Check session pour evité les injection par method post, compare toujours le pseudo et le mdp
	if (isset($_SESSION['pseudo']) && isset($_SESSION['pass'])){
	$query = $bdd->query('SELECT * FROM client');
	while ($donnees = $query->fetch())
	{if ($donnees['email'] == $_SESSION['pseudo'] && isset($_SESSION['pass']))
		{
			if (password_verify($_SESSION['pass'], $donnees['salt']))
				{
					if (password_verify($donnees['salt'], $donnees['pass']))
						{} // pas très propre mais evite de mettre tout le code HTML dans le if.
						}
				}
		
	}$query->closeCursor();

	}else {header('Location:..\deconnexion.php');exit();}


?>