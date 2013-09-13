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
	
	include_once '../lib/gestionErreurs.php';
	$test = new testTools("info");
	
	$nom_fichier = "modif_patient.php";

	$jsPatient = isset($_GET['patient']) ? $_GET['patient'] : '';
	$jsTitulaire = isset($_GET['titulaire']) ? $_GET['titulaire'] : '';
	
	if ($jsTitulaire != '') {

		$jsTitulaire = html_entity_decode(trim(strtolower($test->convert($jsTitulaire))));
		$sql = "SELECT p.id as patient_id, p.nom as patient_nom, p.prenom as patient_prenom, DATE_FORMAT(p.date_naissance, GET_FORMAT(DATE, 'EUR')) as patient_date_naissance, 	p.telephone as patient_telephone, p.gsm as patient_gsm, t.nom as titulaire_nom, t.prenom as titulaire_prenom FROM patients p, patients t WHERE (p.titulaire_id = t.id) AND ((lower(concat(t.nom, ' ' ,t.prenom))) regexp '$jsTitulaire' OR (lower(concat(t.prenom, ' ' ,t.nom))) regexp '$jsTitulaire') Limit 15";
		
	} else {

		$jsPatient = html_entity_decode(trim(strtolower($test->convert($jsPatient))));
		if ($jsPatient=="") $jsPatient="%";
		$sql = "SELECT p.id as patient_id, p.nom as patient_nom, p.prenom as patient_prenom, DATE_FORMAT(p.date_naissance, GET_FORMAT(DATE, 'EUR')) as patient_date_naissance,	p.telephone as patient_telephone, p.gsm as patient_gsm, t.nom as titulaire_nom, t.prenom as titulaire_prenom FROM patients p, patients t WHERE (p.titulaire_id = t.id) AND ((lower(concat(p.nom, ' ' ,p.prenom))) regexp '$jsPatient' OR (lower(concat(p.prenom, ' ' ,p.nom))) regexp '$jsPatient') Limit 15";
	}
  	
	// Fonction de connexion à la base de données
	connexion_DB('poly');
	
	$result = requete_SQL ($sql);
	
		if(mysql_num_rows($result)!=0) {
			
			echo "<table border='0' cellpadding='2' cellspacing='1'>";
	
			echo "<th class='td' colspan='3' align='center'>Actions";
			echo "</th>";
			echo "<th>";
			echo "Nom";
			echo "</th>";
			echo "<th>";
			echo "Pr&eacute;nom";
			echo "</th>";
			echo "<th>";
			echo "Naissance";
			echo "</th>";
			echo "<th>";
			echo "Titulaire";
			echo "</th>";
			echo "<th>";
			echo "T&eacute;l&eacute;phone";
			echo "</th>";
			echo "<th>";
			echo "GSM";
			echo "</th>";
			
			while($data = mysql_fetch_assoc($result)) 	{
		
				$formID = $data['patient_id'];
				$formDetail = "".$formID;
				
				// on affiche les informations de l'enregistrement en cours
		
				echo "<tr onMouseOver='setPointer(this, 0, 0 );' onMouseOut='setPointer(this, 0, 1 );'>";
				
				echo "<td width='16' align='center' valign=top' bgcolor='#D5D5D5'>";
				echo "<a href='".$nom_fichier."?id=".$data['patient_id']."'>";
				echo "<img width='16' height='16' src='../images/modif_small.gif' alt='Modifier' title='Modifier' border='0' />";
				echo "</a></td>";
				echo "<td width='16' align='center' valign=top' bgcolor='#D5D5D5'>";
				echo "<a href='#' onClick='javascript:openDialogConfirmDelPatient($formDetail)' >";
				echo "<img width='16' height='16' src='../images/delete_small.gif' alt='Effacer' title='Effacer' border='0' />";
				echo "</a></td>";
				echo "<td width='25' style='cursor: pointer' onMouseDown=javascript:openPatientInfo($formDetail) valign='top' bgcolor='#D5D5D5' align='center' nowrap='nowrap'>";
				echo "<img width='16' height='16' src='../images/icon_clipboard.gif' alt='Information' title='Information' border='0' /></a>";
				echo "</td>";
				
				echo "<td valign='top' bgcolor='#D5D5D5' nowrap='nowrap'>".htmlentities(stripcslashes($data['patient_nom']),ENT_QUOTES)."</td>";
				echo "<td valign='top' bgcolor='#D5D5D5' nowrap='nowrap'>".htmlentities(stripcslashes($data['patient_prenom']),ENT_QUOTES)."</td>";
				echo "<td valign='top' bgcolor='#D5D5D5' nowrap='nowrap'>".$data['patient_date_naissance']."</td>";
				echo "<td valign='top' bgcolor='#D5D5D5' nowrap='nowrap'>".htmlentities(stripcslashes($data['titulaire_nom']),ENT_QUOTES)." ".htmlentities(stripcslashes($data['titulaire_prenom']),ENT_QUOTES)."</td>";
				echo "<td valign='top' bgcolor='#D5D5D5' nowrap='nowrap'>".$data['patient_telephone']."</td>";
				echo "<td valign='top' bgcolor='#D5D5D5' nowrap='nowrap'>".$data['patient_gsm']."</td>";
				echo "</tr>";
		
				
			}
			
		echo "</table>";
			

	} else {
		
		echo "";
			
	}

	deconnexion_DB();
	
?>