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

	//recupération des valeurs en SESSION
	$formID = $_SESSION['tarification_id'];
	
	// On fait la requête
	$champscomplet = $_GET['id'];
	
	// suppression du record
	$sql = "DELETE FROM retarifications_detail WHERE ( id = '$champscomplet')";
	
	$result = requete_SQL ($sql);
	
	deconnexion_DB();
	
	header('Location: ../tarifications/modif_retarification.php');
	
?>























