<?php
session_start();

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
                <?php 
				include('..\include/menu2.php');
					
					
				 ?>	
                <section>
               
                	<article>
                        
                        
                         <h2>Accueil Admin</h2>
                         <hr class="hr3"><br/><br/>
                         <p>
                      <?php echo "Bienvenue, vous êtes sur l'outil de gestion PaladinCMS"; ?>

                         </p>
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