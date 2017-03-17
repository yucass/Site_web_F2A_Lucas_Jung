<?php

session_start();

session_destroy();
unset ($_SESSION['date'], $_SESSION['pseudo'], $_SESSION['level'], $_SESSION['name'] );
unset($_SESSION['panier']);


header('Location: index.php');exit();
?>