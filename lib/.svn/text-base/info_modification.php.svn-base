<?php 

	// Demarre une session
	session_start();
	
	// Validation du Login
	// SECURISE
	if(isset($_SESSION['application'])) {
		if ($_SESSION['application']=="|poly|" && $_SESSION['role']=="Administrateur") {
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

	include_once '../lib/gestionErreurs.php';
	$test = new testTools("info");
	
	$dico = array('titre' => 'titre');
	
	// Fonction de connexion à la base de données
	connexion_DB('poly');
	
	$jsID = $_GET['id'];
	$jsChamps = $_GET['champs'];
	$jsValeur = $_GET['valeur'];
	
	$jsID = $test->convert($jsID);
	$jsChamps = $test->convert($jsChamps);
	$jsValeur = $test->convert($jsValeur);
	
	$sql = "UPDATE infos SET $jsChamps = '$jsValeur' WHERE id = $jsID";
	$result = requete_SQL($sql);
	
	//$jsValeur=stripcslashes($jsValeur,ENT_QUOTES);
	$jsValeur = htmlentities($jsValeur);
	
	if ($result == 1) echo "<fieldset><legend>Modification de la base de donn&eacute;e</legend><legend_red>Modification du $dico[$jsChamps] avec $jsValeur</legend_red></fieldset>"; else echo "Erreur";
	
	deconnexion_DB();
?>