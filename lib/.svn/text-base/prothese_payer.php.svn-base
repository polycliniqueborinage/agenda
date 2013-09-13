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
	include_once '../lib/fonctions.php';

	
	// Fonction de connexion à la base de données
	connexion_DB('poly');
	
	//recupération des valeurs en SESSION
	$formID = $_SESSION['prothese_id'];
	$formCaisse = $_SESSION['login'];
	$formMedecinPrenom = $_SESSION['impression_medecin_nom'];
	$formMedecinNom = $_SESSION['impression_medecin_prenom'];
	$formPatientNom = $_SESSION['impression_patient_nom'];
	$formPatientPrenom = $_SESSION['impression_patient_prenom'];
	
	//recuperation des parametres passées par l'url
	$formValeur = $_GET['montant'];
	$formType =  $_GET['type'];
	
	if ($formType == 'banksys') {
		$formCode = '580103'; 
	} else {
		$formCode = '570100'; 
	}
	
	$formDate = date("Y-m-d");
		
	// INSERT INTO PROTHESE DETAIL
	$sql = "INSERT into protheses_detail (prothese_id,date,type,montant) VALUES ( '$formID', '$formDate', 'paiement', '$formValeur')";
	$result = requete_SQL ($sql);

	// Ouverture de la caisse
	$sql = "SELECT * FROM caisses_transaction where date = '$formDate'  AND caisse='$formCaisse' AND code = '5000'";
	$result = requete_SQL ($sql);
		
	if (mysql_num_rows($result)==0) {
		$sql = "SELECT sum(montant) as montant FROM caisses_transaction where caisse='$formCaisse' AND mode='espece' AND date = (select max(date) from caisses_transaction where date!='$formDate' and code ='5000' and caisse='$formCaisse')";
		$result = requete_SQL ($sql);
		$data = mysql_fetch_assoc($result);
		$montant = round($data['montant'],2);
		$sql = "INSERT INTO caisses_transaction ( caisse, date, code, description, montant, mode, heure )
			VALUES ( '$formCaisse', '$formDate' , '5000','Ouverture de la caisse', '$montant', 'espece', now() )";
		$result = requete_SQL ($sql);
	}	
	// FIN Ouverture de la caisse
		
	// INSERT INTO CAISSE TRANSACTION
	$formMedecinPrenom = $_SESSION['impression_medecin_nom'];
	$formMedecinNom = $_SESSION['impression_medecin_prenom'];
	$formPatientNom = $_SESSION['impression_patient_nom'];
	$formPatientPrenom = $_SESSION['impression_patient_prenom'];

	$description = "Prothese de ".$formPatientNom." ".$formPatientPrenom." pour ".$formMedecinNom." ".substr($formMedecinPrenom,0,1).".";
	$sql = "INSERT INTO caisses_transaction ( caisse, date, code, description, montant, mode, heure )
				VALUES ( '$formCaisse', '$formDate', '$formCode','$description', '$formValeur', '$formType', now() )";
	$result = requete_SQL ($sql);

	deconnexion_DB();
	
	
?>