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
	
	// Fonction de connexion à la base de données
	connexion_DB('poly');
	
	$nombreTarificationAffiche = 10;

	$champscomplet = $_GET['pseudo'];
	$champscomplet = strtolower($test->convert($champscomplet));
	
	$sql = "SELECT p.nom as patient_nom, p.prenom as patient_prenom, p.niss as patient_niss, p.date_naissance as patient_date, m.nom as medecin_nom, m.prenom as medecin_prenom, m.inami as medecin_inami, t.id as tarification_id, DATE_FORMAT(t.date, GET_FORMAT(DATE, 'EUR')) as tarification_date, t.caisse as tarification_caisse, t.paye as tarification_paye, t.a_payer as tarification_a_payer, t.mutuelle_code tarification_mutuelle_code, t.type as tarification_type, t.etat as tarification_etat, t.children as tarification_children FROM tarifications t, patients p, medecins m WHERE (( t.etat = 'close' AND t.paye < t.a_payer) OR  (t.etat != 'close')) AND (m.inami = t.medecin_inami) AND (t.patient_id = p.id) AND t.utilisation = 'prothese' AND ((lower(concat(p.nom, ' ' ,p.prenom))) regexp '$champscomplet' OR (lower(concat(p.prenom, ' ' ,p.nom))) regexp '$champscomplet' OR (lower(concat(m.nom, ' ' ,m.prenom))) regexp '$champscomplet' OR (lower(concat(m.nom, ' ' ,m.prenom))) regexp '$champscomplet')";
	
	// VERIFICATION
	$result = mysql_query($sql);
	
	
		if(mysql_num_rows($result)!=0) {
	
		echo "<table border='0' cellpadding='2' cellspacing='1'>";
		
		if ($_SESSION['role'] == 'Administrateur') {
			echo "<th class='td'  colspan='2' align='center'>";
			echo "</th>";
		} else {
			echo "<th class='td'  colspan='1' align='center'>";
			echo "</th>";
		}
		
		echo "<th>";
		echo "Date de tarification";
		echo "</th>";
		echo "<th>";
		echo "Patient";
		echo "</th>";
		echo "<th>";
		echo "M&eacute;decin";
		echo "</th>";
		echo "<th>";
		echo "Solde &agrave; payer";
		echo "</th>";
	
		$i = 0;
    			
		while(($data = mysql_fetch_assoc($result))&&($i<$nombreTarificationAffiche)) 	{
		
			$i++;
			// on affiche les informations de l'enregistrement en cours
		
			echo "<tr onMouseOver='setPointer(this, 0, 0 );' onMouseOut='setPointer(this, 0, 1 );'>";
			
			echo "<td width='16' align='center' valign=top' bgcolor='#D5D5D5'>";
			echo "<a href='../protheses/modif_prothese.php?id=";
			echo $data['tarification_id'];
			echo "'>";
			echo "<img width='16' height='16' src='../images/modif_small.gif' alt='Modifier' title='Modifier' border='0' /></a>";
			echo "</td>";

			if ($_SESSION['role'] == 'Administrateur') {
				echo "<td width='16' align='center' valign=top' bgcolor='#D5D5D5'>";
				echo "<a href='../protheses/delete_prothese.php?id=".$data['tarification_id']."'";
				echo " onClick='return confirmLink(this)' >";
				echo "<img width='16' height='16' src='../images/delete_small.gif' alt='Effacer' title='Effacer' border='0' /></a>";
				echo "</td>";
			} else {
			}
		
			echo "<td valign='top' bgcolor='#D5D5D5' nowrap='nowrap'>".$data['tarification_date']."</td>";
			echo "<td valign='top' bgcolor='#D5D5D5' nowrap='nowrap'>".htmlentities(stripcslashes($data['patient_nom']),ENT_QUOTES)." ".htmlentities(stripcslashes($data['patient_prenom']),ENT_QUOTES)."</td>";
			echo "<td valign='top' bgcolor='#D5D5D5' nowrap='nowrap'>".htmlentities(stripcslashes($data['medecin_nom']),ENT_QUOTES)." ".htmlentities(stripcslashes($data['medecin_prenom']),ENT_QUOTES)."</td>";
			$solde =  $data['tarification_a_payer'] - $data['tarification_paye'];
			echo "<td valign='top' bgcolor='#D5D5D5' nowrap='nowrap'>".$solde."</td>";

			echo "</tr>";

		}
	
		echo "</table>";

	} else {
		
		echo "";
			
	}

	deconnexion_DB();

?>