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

	// Validation du Login
	if(isset($_SESSION['nom'])) {
	}
	else {
		// redirection
		header('Location: ../index.php');
		die();
	}
	// Inclus le fichier contenant les fonctions personalisées
	include_once '../lib/fonctions.php';
	
	// Fonction de connexion à la base de données
	connexion_DB('poly');
	
	$formID = $_GET['id'];
	
	$formDate = date("Y-m-d");
	
	if ($formID !='') {
		
		// Mise a jour de la date de la prothese et cloture
		$sql = "UPDATE tarifications SET etat = 'close', cloture=now() WHERE ( id  = '$formID' )";
	
		$result = requete_SQL($sql);
		
		// ajout tarification medecin/poly
		$CoutTotale = $_SESSION['cout_total'];
		$CoutMutuelle = $_SESSION['cout_mutuelle']; 	
		$CoutProthese = -1 * ($_SESSION['cout_prothese']);
		$formMedecinTauxProthese = $_SESSION['taux_prothese'];
														 
		$CoutTotaleSansMutuelle = $CoutTotale - $CoutMutuelle;
		
		$GainMedecin = round($CoutTotaleSansMutuelle * $formMedecinTauxProthese / 100,2);
		$GainPoly = round ($CoutTotaleSansMutuelle - $GainMedecin,2);
		
		$CoutProtheseMedecin = round($CoutProthese * $formMedecinTauxProthese / 100,2);
		$CoutProthesePoly = round ($CoutProthese - $CoutProtheseMedecin,2);
		
		echo " Devis =".$CoutTotale;
		echo " Intervention de la mutuelle =".$CoutMutuelle."\n";
		echo " Gain hors mutuelle =".$CoutTotaleSansMutuelle;
		echo " Gain medecin =".$GainMedecin;
		echo " Gain poly =".$GainPoly."\n";
		
		echo " Cout prothese medecin =".$CoutProtheseMedecin;
		echo " Cout prothese poly =".$CoutProthesePoly;
		
		$sql = "INSERT INTO tarifications_detail ( tarification_id , cecodi , propriete, description, kdb , bc , hono_travailleur , a_vipo , b_tiers_payant, cout, cout_medecin, cout_poly, cout_mutuelle, caisse) VALUES ('$formID', '', 'prothese', 'Gain sur le TM de la prothese', '', '', '', '' , '', '$CoutTotaleSansMutuelle', '$GainMedecin', '$GainPoly', '$CoutTotaleSansMutuelle', '0')";
		
		$q = requete_SQL ($sql);
				
		$sql = "INSERT INTO tarifications_detail ( tarification_id , cecodi , propriete, description, kdb , bc , hono_travailleur , a_vipo , b_tiers_payant, cout, cout_medecin, cout_poly, cout_mutuelle, caisse) VALUES ('$formID', '', 'prothese', 'Cout du prothésiste', '', '', '', '' , '', '$CoutProthese', '$CoutProtheseMedecin', '$CoutProthesePoly', '$CoutProthese', '0')";
		
		$q = requete_SQL ($sql);

	}
	
	deconnexion_DB();
	
	unset($_SESSION['prothese_id']);
	unset($_SESSION['information']);

		
?>

