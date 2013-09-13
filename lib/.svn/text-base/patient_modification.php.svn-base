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
	
	$dico = array('checkedtrue' => 'checked', 'checkedfalse' => '');
	$sql = "";
	
	$jsID = $_GET['id'];
	$jsChamps = $_GET['champs'];
	$jsValeur = $_GET['valeur'];

	$jsID = $test->convert($jsID);
	$jsChamps = $test->convert($jsChamps);
	$jsValeur = $test->convert($jsValeur);
	
	if ($jsID!='') {

		switch ($jsChamps) {
			case 'mutuelle_code':
				$test->mutuelletest($jsValeur,"mutuelle_code","mutuelle");
				if ($test->Count == 0) {
					$sql = "UPDATE patients SET mutuelle_code = '$jsValeur' WHERE titulaire_id = $jsID";
					$info = "Modification de la mutuelle avec le code ".$jsValeur;
				} else {
					$info = "Valeur erron&eacute;e";
				}
			break;
			case 'mutuelle_matricule':
				$sql = "UPDATE patients SET mutuelle_matricule = '$jsValeur' WHERE id = $jsID";
				$info = "Modification du matricule mutuelle avec la valeur ".$jsValeur;
			break;
			case 'sis':
				$test->sistest($jsValeur,"sis","num&eacute;ro de carte sis");
				if ($test->Count == 0) {
					$sql = "UPDATE patients SET sis = '$jsValeur' WHERE id = $jsID";
					$info = "Modification du num&eacute;ro de la carte sis la valeur ".$jsValeur;
				} else {
					$info = "Valeur erron&eacute;e";
				}
			break;
			case 'ct1ct2':
				$test->stringtest($jsValeur,"ct1ct2","num&eacute;ro de carte sis");
				if ($test->Count == 0) {
					$formCT1 = substr($jsValeur,0,3);
					$formCT2 = substr($jsValeur,4,3);
					$sql = "UPDATE patients SET ct1 = '$formCT1', ct2 = '$formCT2' WHERE titulaire_id = $jsID";
					$info = "Modification de l'assurabilit&eacute; (ct1-ct2) avec ".$jsValeur;
				} else {
					$info = "Valeur erron&eacutee";
				}
			break;
			case 'tiers_payant':
				$test->stringtest($jsValeur,"tiers_payant","num&eacute;ro de carte sis");
				if ($test->Count == 0) {
					$valeur = $dico['checked'.$jsValeur];
					$sql = "UPDATE patients SET tiers_payant = '$valeur' WHERE id = $jsID";
					$info = "Modification de la r&eacute;duction du tiers payant";
				} else {
					$info = "Valeur erron&eacutee";
				}
			break;
			case 'telephone':
				$sql = "UPDATE patients SET telephone = '$jsValeur' WHERE id = $jsID";
				$info = "Modification du num&eacute;ro de t&eacute;l&eacute;phone avec la valeur ".$jsValeur;
			break;
			case 'gsm':
				$sql = "UPDATE patients SET gsm = '$jsValeur' WHERE id = $jsID";
				$info = "Modification du num&eacute;ro de t&eacute;l&eacute;phone mobile (gsm) avec la valeur ".$jsValeur;
			break;
			default:
		}
	}
	
	if ($sql !='') {
		connexion_DB('poly');
		$result = requete_SQL($sql);
		if ($result != 1) {$info="Erreur lors de la mise &agrave; de la base de donn&eacute;e";}
		deconnexion_DB();
	}

	echo "<fieldset><legend>Modification de la base de donn&eacute;e</legend><legend_red>$info</legend_red></fieldset>";
	
	
?>