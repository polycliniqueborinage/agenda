<?php 

	// Demarre une session
	session_start();

	// Validation du Login
	// SECURISE
	if(isset($_SESSION['application'])) {
		if ($_SESSION['application']=="|poly|") {
			// login ok
		}else {
			// redirection
			header('Location: ../../login/index.php');
			die();
		}
	} else {
		// redirection
		header('Location: ../../login/index.php');
		die();
	}
	// SECURITE

	// Inclus le fichier contenant les fonctions personalisées
	include_once 'fonctions.php';
	
	// Fonction de connexion à la base de données
	connexion_DB('poly');

	$ct1ct2 = $_GET['ct1ct2'];
	$dataCT1 = strtok($ct1ct2,"-");
	$dataCT2 = strtok("-");
	
	$type = "";
	$label = "";
	
	$sql = "SELECT type, label FROM cts WHERE ct1 =$dataCT1 AND ct2=$dataCT2";
	
	$result = mysql_query($sql);
	
	if(mysql_num_rows($result)==1) {
		$data = mysql_fetch_assoc($result);
		$type = $data['type'];
		$label = $data['label'];
	}
	
	deconnexion_DB();
	
	
$datas = array(
    'root' => array(
        'type' => $type, 
        'label' => $label
    )
);
		
header("X-JSON: " . json_encode($datas));
?>


										