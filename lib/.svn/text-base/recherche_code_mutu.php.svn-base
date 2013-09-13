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
	
	$sql = "SELECT code, nom FROM mutuelles WHERE code ='";
	$sql .=$champscomplet;
	$sql .="'";
	
	$result = mysql_query($sql);
	
	if(mysql_num_rows($result)==1) {
		// un résultat
		$data = mysql_fetch_assoc($result);
		echo "<input type='hidden' name='mutuelle_code' value='".$data['code']."'>";
		echo "-";
		echo $data['code'];
	}
	else {
		echo "<input type='hidden' name='mutuelle_code' value=''>";
		echo "-";
		echo " ";
	}
	deconnexion_DB();
?>



										