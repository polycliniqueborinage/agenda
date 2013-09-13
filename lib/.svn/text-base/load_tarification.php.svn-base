<?
	// Demarre une session
	session_start();

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

	connexion_DB('poly');
	
	//Recuperation des parametres passées par l'url
    $type = isset($_GET['type']) ? $_GET['type'] : '';
    $value = isset($_GET['value']) ? $_GET['value'] : '';
    $value = ucfirst(strtolower($value));
	
    switch ($type) {
		case 'new_tarification':
			$urlModif = '../tarifications/modif_tarification.php';
			$sql = "SELECT t.date as tarif_date, t.etat as tarif_etat,t.id as tarif_id, t.a_payer - t.paye as tarif_reste_payer, p.nom as patient_nom, p.prenom as patient_prenom, m.nom as medecin_nom, m.prenom as medecin_prenom FROM tarifications t, patients p, medecins m WHERE t.patient_id = p.id AND t.utilisation = 'tarification' AND p.nom like '$value%' AND  t.medecin_inami = m.inami AND ((t.etat = 'close' AND round(t.paye,2) < round(t.a_payer,2)) OR  (t.etat != 'close')) AND t.date = '".date("Y-m-d")."' order by patient_nom";
		break;
		case 'old_tarification':
			$urlModif = '../tarifications/modif_tarification.php';
			$sql = "SELECT t.date as tarif_date, t.etat as tarif_etat,t.id as tarif_id, t.a_payer - t.paye as tarif_reste_payer, p.nom as patient_nom, p.prenom as patient_prenom, m.nom as medecin_nom, m.prenom as medecin_prenom FROM tarifications t, patients p, medecins m WHERE t.patient_id = p.id AND t.utilisation = 'tarification' AND p.nom like '$value%' AND t.medecin_inami = m.inami AND ((t.etat = 'close' AND round(t.paye,2) < round(t.a_payer,2)) OR  (t.etat != 'close')) AND t.date < '".date("Y-m-d")."' order by patient_nom";
		break;
		case 'new_prothese':
			$urlModif = '../protheses/modif_prothese.php';
			$sql = "SELECT t.date as tarif_date, t.etat as tarif_etat,t.id as tarif_id, t.a_payer - t.paye as tarif_reste_payer, p.nom as patient_nom, p.prenom as patient_prenom, m.nom as medecin_nom, m.prenom as medecin_prenom FROM tarifications t, patients p, medecins m WHERE t.patient_id = p.id AND t.utilisation = 'prothese' AND p.nom like '$value%' AND  t.medecin_inami = m.inami AND ((t.etat = 'close' AND round(t.paye,2) < round(t.a_payer,2)) OR  (t.etat != 'close')) AND t.date = '".date("Y-m-d")."' order by patient_nom";
		break;
		case 'old_prothese':
			$urlModif = '../protheses/modif_prothese.php';
			$sql = "SELECT t.date as tarif_date, t.etat as tarif_etat,t.id as tarif_id, t.a_payer - t.paye as tarif_reste_payer, p.nom as patient_nom, p.prenom as patient_prenom, m.nom as medecin_nom, m.prenom as medecin_prenom FROM tarifications t, patients p, medecins m WHERE t.patient_id = p.id AND t.utilisation = 'prothese' AND p.nom like '$value%' AND t.medecin_inami = m.inami AND ((t.etat = 'close' AND round(t.paye,2) < round(t.a_payer,2)) OR  (t.etat != 'close')) AND t.date < '".date("Y-m-d")."' order by patient_nom";
		break;
		default:
		break;
	}

	connexion_DB('poly');

	$result = requete_SQL ($sql);
	
	if(mysql_num_rows($result)>0) {
	
		echo "<ul class='border-greenred'>";
		
		while($data = mysql_fetch_assoc($result)) 	{

			switch($data['tarif_etat']) {
			case 'close':
				$info='Clotur&eacute; mais non pay&eacute;';
				//$style='../images/tarif_close.gif';
				$style='close';
				break;
			case 'start':
				$info='Aucunes prestations encod&eacute;es';
				//$style='../images/tarif_start.gif';
				$style='start';
			break;
			default:
				$info='Tarification en attente';
				//$style='../images/tarif_wait.gif';
				$style='wait';
			}
				
			echo "<li class='$style'><a title='$info' alt='$info' href='$urlModif?id=".$data['tarif_id']."'> ".$data['patient_nom']." ".$data['patient_prenom']{0}.". - ".$data['medecin_nom']." ".$data['medecin_prenom']{0}.". </a></li>";
		}
		echo "</ul>";
	} else {
		echo "<div class='border-green'>";
		echo "aucune tarification";
		echo "</div>";
	}
	
	deconnexion_DB();
?>
