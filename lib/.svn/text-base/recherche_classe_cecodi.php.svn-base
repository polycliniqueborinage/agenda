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

	// On fait la requête
	
	$champscomplet = $_GET['pseudo'];
	
	$sql = "SELECT nom FROM classe_cecodi WHERE min <=";
	$sql .=$champscomplet;
	$sql .=" and max >=";
	$sql .=$champscomplet;
	
	$result = mysql_query($sql);
	
	if(mysql_num_rows($result)==1) {
		// un résultat
		$data = mysql_fetch_assoc($result);
		echo "<b>Classe</b> ";
		echo $data['nom'];
	} else {
		echo "<b>Aucune classe reconnue</b>";
	}
	
	deconnexion_DB();
?>



										