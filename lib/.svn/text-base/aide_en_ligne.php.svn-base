<?php 

	// Inclus le fichier contenant les fonctions personalisées
	include_once '../lib/fonctions.php';

	// Fonction de connexion à la base de données
	connexion_DB('poly');
	
	//Recuperation des parametres passées par l'url
    $urlType = isset($_GET['type']) ? $_GET['type'] : '';

    //Recuperation des parametres passées par l'url
    $urlID = isset($_GET['id']) ? $_GET['id'] : '';
	
	switch ($urlType) {
		case 'medecin_comment':
			$sql = "SELECT textcomment from medecins WHERE id = '$urlID'";
			$result = requete_SQL ($sql);
			$data = mysql_fetch_assoc($result);
			echo $data['textcomment'];
		break;
		case 'medecin_horaire':
			$sql = "SELECT texthoraire from medecins WHERE id = '$urlID'";
			$result = requete_SQL ($sql);
			$data = mysql_fetch_assoc($result);
			echo $data['texthoraire'];
			break;
		case 'aide':
			$sql = "SELECT textarea from aides WHERE id = '$urlID'";
			$result = requete_SQL ($sql);
			$data = mysql_fetch_assoc($result);
			echo $data['textarea'];
			break;
		case 'notice':
			$sql = "SELECT textarea from notices WHERE id = '$urlID'";
			$result = requete_SQL ($sql);
			$data = mysql_fetch_assoc($result);
			echo $data['textarea'];
		break;
		case 'aide_modif':
			$sql = "SELECT textarea from aides WHERE id = '$urlID'";
			$result = requete_SQL ($sql);
			$data = mysql_fetch_assoc($result);
			echo htmlentities($data['textarea']);
		break;
		case 'notice_modif':
			$sql = "SELECT textarea from notices WHERE id = '$urlID'";
			$result = requete_SQL ($sql);
			$data = mysql_fetch_assoc($result);
			echo htmlentities($data['textarea']);
		break;
		default:
			$sql = "SELECT textarea from aides WHERE id = 'introduction.php'";
			$result = requete_SQL ($sql);
			$data = mysql_fetch_assoc($result);
			echo $data['textarea'];
		break;
	}
	
	deconnexion_DB();
	
?>

