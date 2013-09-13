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
	
	// Inclus le fichier contenant les fonctions personalisées
	include_once '../lib/fonctions.php';

	include_once '../lib/gestionErreurs.php';
	$test = new testTools("info");
	$infoErreurs = "";
	$info;
	
	$formLastNamePatient = isset($_POST['lastNamePatient']) ? $_POST['lastNamePatient'] : "";
	$formLastNamePatient = ucfirst(strtolower($formLastNamePatient));
	$formLastNamePatient = $test->convert($formLastNamePatient);
	$formLastNamePatient = html_entity_decode($formLastNamePatient);

	$formFirstNamePatient = isset($_POST['firstNamePatient']) ? $_POST['firstNamePatient'] : "";
	$formFirstNamePatient = ucfirst(strtolower($formFirstNamePatient));
	$formFirstNamePatient = $test->convert($formFirstNamePatient);
	$formFirstNamePatient = html_entity_decode($formFirstNamePatient);
	
	$formBirthdayPatient = isset($_POST['birthdayPatient']) ? $_POST['birthdayPatient'] : "";
	$formBirthdayPatient = $test->convert($formBirthdayPatient);
	$tok = strtok($formBirthdayPatient,"/");
	$formBirthdayPatientDay = $tok;
	$tok = strtok("/");
	$formBirthdayPatientMonth = $tok;
	$tok = strtok("/");
	$formBirthdayPatientYear = $tok;
	$test->datetest($formBirthdayPatientDay,$formBirthdayPatientMonth,$formBirthdayPatientYear,"date_naissance","date de naissance");
	$formBirthdayPatient = $formBirthdayPatientYear."-".$formBirthdayPatientMonth."-".$formBirthdayPatientDay;
	
	$formPhoneNumberPatient = isset($_POST['phoneNumberPatient']) ? $_POST['phoneNumberPatient'] : "";
	$formPhoneNumberPatient = $test->convert($formPhoneNumberPatient);
	
	if ($test->Count == 0) {
	
		connexion_DB('poly');
	
		$sql = "SELECT id FROM patients WHERE nom='$formLastNamePatient' AND prenom='$formFirstNamePatient' AND date_naissance = '$formBirthdayPatient'";
		$q = requete_SQL ($sql);
		
		$n = mysql_num_rows($q);
		
	    if ($n == 0) {
		
			// Ajout DB
			$sql = "INSERT INTO `patients` ( `nom` , `prenom` , `date_naissance`, `telephone`, `gsm`, `titulaire_id` ) VALUES ('$formLastNamePatient', '$formFirstNamePatient', '$formBirthdayPatient', '$formPhoneNumberPatient', '$formPhoneNumberPatient', 0)";

			$q = requete_SQL ($sql);

			$sql = "UPDATE `patients` set titulaire_id=id where titulaire_id = 0";
				
			$q = requete_SQL ($sql);

			$info = htmlentities($formLastNamePatient)." ".htmlentities($formFirstNamePatient)." a &eacute;t&eacute; correctement ajout&eacute;";
		
		} else {
	
			$info = "Ce patient existe d&eacute;j&agrave; dans la base de donn&eacute;e!";
		}

		deconnexion_DB();	

	} else {

		$info = "Impossible d'encoder le patient suite &agrave; une erreur d'encodage ($test->ListeErreur)";
	}	
	
	
$datas = array(
    'root' => array(
        'info' => $info
    )
);
		
header("X-JSON: " . json_encode($datas));
?>