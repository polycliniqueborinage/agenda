<?
	// Demarre une session
	session_start();
	
	// SECURISE
	if(isset($_SESSION['application'])) {
		if ($_SESSION['application']=="|agenda|") {
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

	include_once '../lib/gestionErreurs.php';
	$test = new testTools("info");
	
	// Fonction de connexion à la base de données
	connexion_DB('poly');

	$jsID = isset($_GET['id']) ? $_GET['id'] : '';
	$jsPseudo = isset($_GET['pseudo']) ? $_GET['pseudo'] : '';
	
	$modifUrl ='../patients/modif_patient.php?id=';
	$dico = array('tiers_payant' => 'Non', 'tiers_payantchecked' => 'Oui');
	
	$number="";
	$content="";
	$title="";
	
	$sql = "SELECT 
		id as patient_id,
		nom as patient_nom, 
		prenom as patient_prenom, 
		DATE_FORMAT(date_naissance, GET_FORMAT(DATE, 'EUR')) as patient_date_naissance,
		sexe as patient_sexe,
		rue as patient_rue,
		code_postal as patient_code_postal,
        commune as patient_commune,
		nationnalite as patient_nationnalite, 
		telephone as patient_telephone, 
		gsm as patient_gsm, 
		mail as patient_mail, 
		mutuelle_code as patient_mutuelle_code, 
		mutuelle_matricule as patient_mutuelle_matricule, 
		sis as patient_sis, 
		ct1 as patient_ct1, 
		ct2 as patient_ct2, 
		tiers_payant as patient_tiers_payant, 
		niss as patient_niss, 
		titulaire_id as patient_titulaire_id, 
		prescripteur as patient_prescripteur,
		tiers_payant_info as patient_tiers_payant_info, 
		vipo_info as patient_vipo_info, 
		mutuelle_info as patient_mutuelle_info, 
		interdit_info as patient_interdit_info, 
		(rating_rendez_vous_info + rating_frequentation_info + rating_preference_info) as patient_rating_somme_info,
		rating_rendez_vous_info as patient_rating_rendez_vous_info, 
		rating_frequentation_info  as patient_rating_frequentation_info, 
		rating_preference_info as patient_rating_preference_info, 
		commentaire as patient_commentaire,
		photo as patient_photo
		FROM patients";
	
	if ($jsID != '') {

		$sql .=" WHERE id ='$jsID'";

	} else {
		
		$jsPseudo = html_entity_decode($jsPseudo);
		$jsPseudo = strtolower($test->convert($jsPseudo));
		$jsPseudo = str_replace("+","",$jsPseudo);
		$jsPseudo = str_replace("-","",$jsPseudo);
		$jsPseudo = str_replace("!","",$jsPseudo);
		$jsPseudo = str_replace("?","",$jsPseudo);
		$jsPseudo = trim($jsPseudo);
		
		// protect empty conten in editor's field
		if ($jsPseudo=="") $jsPseudo="%";
		
		$sql .= " WHERE ((lower(concat(nom, ' ' ,prenom))) regexp '$jsPseudo' OR (lower(concat(prenom, ' ' ,nom))) regexp '$jsPseudo') Limit 7";
		
	}

	// VERIFICATION
	//$content .= $sql;
	
	$result = requete_SQL($sql);
	 
	if(mysql_num_rows($result)>1) {

		$i = 0;
		$style='bleu';

		// more than one result
		$number = "2";
		
		$title = "";
		
		$content .= "<ul class='border-red border-greenred'>";

		while($data = mysql_fetch_assoc($result)) 	{
		
			switch($style) {
			case 'red':
				$style='bleu';
				break;
			case 'bleu':
				$style='red';
			break;
			default:
			}
				
			$content .=  "<li onclick=\"patient_recherche_list('".$data['patient_id']."')\"  class='$style'><a href=\"#\" title=\"".$data['patient_id']." - ".$data['patient_date_naissance']."\">";
			$content .= htmlentities($data['patient_nom'])." ".htmlentities($data['patient_prenom']);
			$content .= "</a></li>";
		
			$i++;
	
		}
		
		$content .= "</ul>";
		
	} else {
		
		if(mysql_num_rows($result)==1) {

			// exaclty one result
			$number = "1";
			
			$data = mysql_fetch_assoc($result);
			
			$title = htmlentities($data['patient_nom'])." ".htmlentities($data['patient_prenom']);
			
			$content .= "<div class='border-red color".$data['patient_rating_somme_info']."'>";
			$content .= "<h1>";
			$content .= htmlentities($data['patient_nom'])." ".htmlentities($data['patient_prenom'])."</h1>";
			
			$PayeurPatientID = $data['patient_id'];
			$PayeurSQL = "SELECT sum(a_payer) as total_a_payer, sum(paye) as total_paye FROM tarifications WHERE ( patient_id  = '$PayeurPatientID') AND a_payer < 0";
			$PayeurResult = requete_SQL ($PayeurSQL);
			$PayeurData = mysql_fetch_assoc($PayeurResult);

			if($PayeurData['total_a_payer'] < 0) { $content .= "<b style='color:red'>Le patient doit la somme de ".round((-1 * $PayeurData['total_a_payer']) - $PayeurData['total_paye'],2)." ! </b><br/>"; }
			if($data['patient_tiers_payant_info'] == 'checked') { $content .= "<b style='color:red'>Refus r&eacute;duction tiers payant</b><br/>"; }
			if($data['patient_vipo_info'] == 'checked') { $content .= "<b style='color:red'>Refus r&eacute;duction VIPO</b><br/>"; }
			if($data['patient_mutuelle_info'] == 'checked') { $content .= "<b style='color:red'>Refus prise en charge aux mutuelles</b><br/>"; }
			if($data['patient_interdit_info'] == 'checked') { $content .= "<b style='color:red'>INTERDIT D'ETABLISSEMENT</b><br/>"; }
			if($data['patient_commentaire'] != '') { $content .= "<b style='color:red'>Commentaire : ".htmlentities($data['patient_commentaire'])."</b><br/>"; }
			
			$content .= "<br/><b>Date naissance : </b>".$data['patient_date_naissance']."<br/>";
			$content .= "<b>Adresse : </b>".htmlentities($data['patient_rue'])." ".$data['patient_code_postal']." ".htmlentities($data['patient_commune'])."<br/>";
			$content .= "<b>Code Mutuelle : </b>".$data['patient_mutuelle_code']."<br/>";
			$content .= "<b>CT1/CT2 : </b>".$data['patient_ct1']."/".$data['patient_ct2']."<br/>";
			$content .= "<b>R&eacute;duction T.P. : </b>".$dico['tiers_payant'.$data['patient_tiers_payant']]."<br/>";
			
			$content .= "<b>GSM : </b>".$data['patient_gsm']."<br/>";
			$content .= "<b>Tel : </b>".$data['patient_telephone']."<br/>";
			//echo "<b>E-mail : </b>".$data['patient_mail']."<br/>";
			$content .= "<b>Prescripteur : </b>".htmlentities($data['patient_prescripteur'])."<br/><br/>";
			
			$content .= "<b style='color:green'>Rendez-vous : ".$data['patient_rating_rendez_vous_info']." / 5</b><br/>";
			$content .= "<b style='color:green'>Fr&eacute;quentation : ".$data['patient_rating_frequentation_info']." / 5</b><br/>";
			$content .= "<b style='color:green'>Pr&eacute;f&eacute;rence : ".$data['patient_rating_preference_info']." / 5</b><br/>";
			
			$content .= "</div>";
			

		} else {
			// no result at all!
			$number = "0";
			$title = "";
			$content .= "<div class='border-red'>";
			$content .= "Aucun patient trouv&eacute; !";
			$content .= "</div>";
		}
			
	}

	deconnexion_DB();
	

$datas = array(
    'root' => array(
        'content' => $content, 
        'title' => $title,
        'number' => $number
)
);
		
header("X-JSON: " . json_encode($datas));

?>