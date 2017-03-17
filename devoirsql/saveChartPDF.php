<?php
 
    require_once("dompdf/dompdf_config.inc.php");
 
    $file_name = 'EnergieGraph.pdf';
    //$html = $_POST['htmlContent'];
	 $html =  "<center>".$_POST['envoie']."</center>";
	 
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->render();
    $dompdf->stream($file_name);
 
 
 
 
/*
   require_once("dompdf/dompdf_config.inc.php");
 $test = "detailfacture.php";
 $dompdf = new DOMPDF();
 $html = file_get_contents($test);
$dompdf->load_html($html);

//    $filename = 'detailfacture.php?facture=5';
  //  
//$dompdf->load_html($filename);
$dompdf->set_paper("a4", "portrait"); 
    $dompdf->render();
    $dompdf->stream('commande.pdf', array('Attachement'=>true));


*/
?>


<?php
 
/*
if (isset($_POST['htmlContent']) && $_POST['htmlContent'] != '')
{
   require_once("dompdf/dompdf_config.inc.php");
 
    $file_name = 'EnergieGraph.pdf';
    //$html = $_POST['htmlContent'];
	 $html =  "<img src=http://entreprise-bato.fr/wp-content/plugins/plug_energie/style/images/logo.png />"."<center>".$_POST['htmlContent']."</center>";
	 
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->render();
    $dompdf->stream($file_name);
	
}*/

?>