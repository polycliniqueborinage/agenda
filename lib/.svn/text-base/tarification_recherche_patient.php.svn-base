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

	include_once '../lib/gestionErreurs.php';
	$test = new testTools("info");

	$jsPseudo = isset($_GET['pseudo']) ? $_GET['pseudo'] : '';

	$jsPseudo = html_entity_decode($jsPseudo);
	$jsPseudo = strtolower($test->convert($jsPseudo));
	$jsPseudo = trim($jsPseudo);
	
	$role = $_SESSION['role'];
	
	$dico = array('tiers_payant' => 'Non', 'tiers_payantchecked' => 'Oui');
	
	$content = "";
    $patientMenu = "";
    $titulaireMenu = "";
    
	// Fonction de connexion à la base de données
	connexion_DB('poly');

	$sql = "SELECT 
		p.id as patient_id,
		p.nom as patient_nom, 
		p.prenom as patient_prenom, 
		DATE_FORMAT(p.date_naissance, GET_FORMAT(DATE, 'EUR')) as patient_date_naissance,
		p.date_naissance as patient_date_naissance_standart,
		p.sexe as patient_sexe,
		p.rue as patient_rue,
		p.code_postal as patient_code_postal,
        p.commune as patient_commune,
		p.nationnalite as patient_nationnalite, 
		p.telephone as patient_telephone, 
		p.gsm as patient_gsm, 
		p.mail as patient_mail, 
		p.mutuelle_code as patient_mutuelle_code, 
		p.mutuelle_matricule as patient_mutuelle_matricule, 
		p.sis as patient_sis, 
		p.ct1 as patient_ct1, 
		p.ct2 as patient_ct2, 
		p.tiers_payant as patient_tiers_payant, 
		p.niss as patient_niss, 
		p.titulaire_id as patient_titulaire_id, 
		p.prescripteur as patient_prescripteur,
		p.tiers_payant_info as patient_tiers_payant_info, 
		p.vipo_info as patient_vipo_info, 
		p.mutuelle_info as patient_mutuelle_info, 
		p.interdit_info as patient_interdit_info, 
		(p.rating_rendez_vous_info + p.rating_frequentation_info + p.rating_preference_info) as patient_rating_somme_info,
		p.rating_rendez_vous_info as patient_rating_rendez_vous_info, 
		p.rating_frequentation_info  as patient_rating_frequentation_info, 
		p.rating_preference_info as patient_rating_preference_info, 
		p.commentaire as patient_commentaire,
		p.photo as patient_photo,
		t.mutuelle_matricule as titulaire_mutuelle_matricule, 
		t.nom as titulaire_nom, 
		t.prenom as titulaire_prenom,
		c.type as cts_type,
		c.label as cts_label,
		m.code as mutuelle_code,
		m.nom as mutuelle_nom
		FROM patients p, patients t, cts c, mutuelles m ";
	
	if(isset($_GET['id'])) {
	
		$id=$_GET['id'];
		
		$sql .= "WHERE (p.mutuelle_matricule!='') AND (p.titulaire_id = t.id) AND (p.mutuelle_code = m.code) AND (p.ct1 = c.ct1) AND (p.ct2 = c.ct2) AND p.id='".$id."'";
		
		
	} else {
		
		$sql .= "WHERE (p.mutuelle_code = m.code) AND (p.ct1 = c.ct1) AND (p.ct2 = c.ct2) AND (p.titulaire_id = t.id) AND ((lower(concat(p.nom, ' ' ,p.prenom))) regexp '$jsPseudo' OR (lower(concat(p.prenom, ' ' ,p.nom))) regexp '$jsPseudo') and p.mutuelle_code != 0 and p.ct1 != 0 and p.ct2 != 0 and (p.mutuelle_matricule!='')  limit 10";
	
	}
	
	$result = requete_SQL ($sql);
	
	// RESULTAT =0
	if(mysql_num_rows($result)==0) {
		
		$content .= "<br/>Pas de patient correspondant !<br/>";
    	$patientMenu .= "<a class='yuimenuitemlabel' href='../patients/recherche_patient.php'>Recherche et modification du patient</a>";
    	$titulaireMenu .= "<a class='yuimenuitemlabel' href='../patients/recherche_patient.php'>Recherche et modification du titulaire</a>";
		
	} else {
		
		// RESULTAT = 1
		if(mysql_num_rows($result)==1) {
			
			$data = mysql_fetch_assoc($result);
			
			// impression etiquette
			$_SESSION['impression_patient_last_name']=$data['patient_nom'];
			$_SESSION['impression_patient_first_prenom']=$data['patient_prenom'];
			$_SESSION['impression_patient_birthday']=$data['patient_date_naissance'];
			$_SESSION['impression_patient_addresse']=$data['patient_rue']." ".$data['patient_code_postal']."".$data['patient_commune'];			
			$_SESSION['impression_patient_sis']=$data['patient_sis'];
			$_SESSION['impression_patient_niss']=$data['patient_niss'];
			$_SESSION['impression_tarification_patient_sex']=$data['patient_sexe'];
			$_SESSION['impression_tarification_patient_tiers_payant']=$data['patient_tiers_payant'];
			$_SESSION['impression_tarification_mutuelle_code']=$data['patient_mutuelle_code'];
			$_SESSION['impression_tarification_patient_mutuelle_matricule']=$data['patient_mutuelle_matricule'];
			$_SESSION['impression_titulaire_mutuelle_matricule']=$data['titulaire_mutuelle_matricule'];
			$_SESSION['impression_tarification_ct1']=$data['patient_ct1'];
			$_SESSION['impression_tarification_ct2']=$data['patient_ct2'];
			
			$dataPatientId = $data ['patient_id'];
			$dataPatientNom = $data ['patient_nom']." ".$data ['patient_prenom'];
			$dataPatientTitulaireId = $data ['patient_titulaire_id'];
			$dataPatientTitulaireNom = $data ['titulaire_nom']." ".$data ['titulaire_prenom'];
			
			$patientMenu .= "<a class='yuimenuitemlabel' href='../patients/modif_patient.php?id=$dataPatientId'>Modification du patient $dataPatientNom</a>";
			$titulaireMenu .= "<a class='yuimenuitemlabel' href='../patients/modif_patient.php?id=$dataPatientTitulaireId'>Modification du titulaire $dataPatientTitulaireNom</a>";
			
			// is it a child ?
			$dateToday = date("Y-m-d");
			$datePatient = $data['patient_date_naissance'];
			$datePatientStandart = $data['patient_date_naissance_standart'];
			
			$datetools = new dateTools($datePatientStandart,$dateToday);
			
			// hidden fields
			if ($datetools->getAge()) {
				// ADULTE
				$content .=  "<input type='hidden' id='patient_children' name='children' value='0'>";
				$child = " - Adulte";
			} else {
				// ENFANT
				$content .=  "<input type='hidden' id='patient_children' name='children' value='1'>";
				$child = " - Enfant";
			}

			$content .=  "<input type='hidden' id='patient_id' name='patient_id' value='".$data['patient_id']."'>";
			$content .=  "<input type='hidden' id='patient_sexe' name='patient_sexe' value='".$data['patient_sexe']."'>";
			$content .=  "<input type='hidden' id='patient_age' name='patient_age' value='".$datetools->getAge()."'>";
			$content .=  "<input type='hidden' id='patient_mutuelle_code' name='patient_mutuelle_code' value='".$data['patient_mutuelle_code']."'>";			
			$content .=  "<input type='hidden' id='patient_ct1' name='patient_ct1' value='".$data['patient_ct1']."'>";			
			$content .=  "<input type='hidden' id='patient_ct2' name='patient_ct2' value='".$data['patient_ct2']."'>";			
			$content .=  "<input type='hidden' id='patient_tiers_payant' name='patient_tiers_payant' value='".$data['patient_tiers_payant']."'>";			
			$content .=  "<input type='hidden' id='patient_mutuelle_matricule' name='patient_mutuelle_matricule' value='".$data['patient_mutuelle_matricule']."'>";
			$content .=  "<input type='hidden' id='titulaire_mutuelle_matricule' name='titulaire_mutuelle_matricule' value='".$data['titulaire_mutuelle_matricule']."'>";
			
			// AFFICHAGE DES INFOS
    		$content .=  "<div class='abstract'>";

			$content .=  "<div id='avatar'><img width='70' height='100' alt='' src='../images/thumb.jpg'/></div>";
			
			$content .=  "<div class='auteur'>";
			
			$content .=  "<ul>";

			$content .=  "<li><strong>";
			$content .=  htmlentities(stripcslashes($data['patient_nom']),ENT_QUOTES)."&nbsp;";
			$content .=  htmlentities(stripcslashes($data['patient_prenom']),ENT_QUOTES);
			$content .=  "</strong></li>";

			$content .=  "<li><b>".$datePatient." ".$child." [".$datetools->getAge()." ans]</b></li>";
			// age
			$_SESSION['impression_tarification_patient_age']=$datetools->getAge();
			
			$content .=  "<li>".htmlentities(stripcslashes($data['patient_rue']." ".$data['patient_code_postal']." ".$data['patient_commune']),ENT_QUOTES)."</li>";
			
			$content .=  "<li>";
			$content .=  "T&eacute;l&eacute;phones : ";
			$content .=  $data['patient_telephone'];
			if ($data['patient_telephone']!='') $content .=  " (Fixe) ";
			$content .=  $data['patient_gsm'];
			if ($data['patient_gsm']!='') $content .=  " (GSM) ";
			$content .=  "</li>";
			
			$content .=  "<li><b>".$data['patient_mutuelle_code']."</b> ".htmlentities(stripcslashes($data['mutuelle_nom']),ENT_QUOTES)."</li>";
			
			$content .=  "<li>CT1 :<b>".$data['patient_ct1']."</b> CT2 :<b>".$data['patient_ct2']."</b> R&eacute;duction T.P. : ".$dico['tiers_payant'.$data['patient_tiers_payant']]."</li>";
			
			$content .=  "<li>Matricule patient : <b>".$data['patient_mutuelle_matricule']."</b></li>";

			if ($data['patient_titulaire_id'] != $data['patient_id']){$content .=  "<li>Matricule titulaire : <b>".$data['titulaire_mutuelle_matricule']."</b></li>";}
			
			$PayeurPatientID = $data['patient_id'];
			$PayeurSQL = "SELECT sum(a_payer) as total_a_payer, sum(paye) as total_paye FROM tarifications WHERE ( patient_id  = '$PayeurPatientID') AND a_payer < 0";
			$PayeurResult = requete_SQL ($PayeurSQL);
			$PayeurData = mysql_fetch_assoc($PayeurResult);
			if($PayeurData['total_a_payer'] < 0) { $content .=  "<li><strong><font color='red'>Le patient doit la somme de ".round((-1 * $PayeurData['total_a_payer']) - $PayeurData['total_paye'],2)."!</font></strong></li>";}

			if($data['patient_tiers_payant_info'] == 'checked') { $content .=  "<li><strong><b style='color:red'>Refus r&eacute;duction tiers payant</b></strong></li>"; }
			if($data['patient_vipo_info'] == 'checked') { $content .=  "<li><strong><b style='color:red'>Refus r&eacute;duction VIPO</b></strong></li>"; }
			if($data['patient_mutuelle_info'] == 'checked') { $content .=  "<li><strong><b style='color:red'>Refus prise en charge aux mutuelles</b></strong></li>"; }
			if($data['patient_interdit_info'] == 'checked') { $content .=  "<li><strong><b style='color:red'>INTERDIT D'ETABLISSEMENT</b></strong></li>"; }
			
			$content .=  "<br/>";
			
			$content .=  "<li>";
			$content .=  "Type : ";
			$content .=  "<select id='patient_type' name='patient_type' title='Type du patient' onchange='javascript:tarificationRechercheType(this.value);'>";
			$first_token_type  = strtok($data['cts_type'],"|");
			$second_token_type = strtok('|');
			$third_token_type = strtok('|');
			$first_token_label  = strtok($data['cts_label'],"|");
			$second_token_label = strtok('|');
			$third_token_label = strtok('|');
			//mise en session du type & label
			$_SESSION['impression_tarification_patient_type']= $first_token_type;
			if ($first_token_type !== false) {
				$content .=  "<option value='".$first_token_type."'>".$first_token_label."</option>";
   			}
			if ($second_token_type !== false) {
				$content .=  "<option value='".$second_token_type."'>".$second_token_label."</option>";
   			}
			if ($third_token_type !== false) {
				$content .=  "<option value='".$third_token_type."'>".$third_token_label."</option>";
   			}
			$content .=  "<option value='as'>Assurance</option>";
			
			$content .=  "<option value='sm'>Sans mutuelle</option>";
			
			$content .=  "</select>";
			$content .=  "</li>";
			
			/*if($role == 'Administrateur') {
				$content .=  "<br/>";
				$content .=  "<li>";
				$content .=  "<input type='checkbox' name='refact' id='refact' value='check' > Refacturation aux mutuelles";					
				$content .=  "</li>";
			}*/
			
			
			$content .=  "</ul>";
			$content .=  "<br/>";
			$content .=  "</div>";
			$content .=  "<hr>";
			$content .=  "</div>";
			
	
		// RESULTAT  > 1
		} else {
		
			$sql = "SELECT p.id as patient_id, p.nom as patient_nom, p.prenom as patient_prenom, DATE_FORMAT(p.date_naissance, GET_FORMAT(DATE, 'EUR')) as patient_date_naissance FROM patients p WHERE ((lower(concat(p.nom, ' ' ,p.prenom))) regexp '$jsPseudo' OR (lower(concat(p.prenom, ' ' ,p.nom))) regexp '$jsPseudo') limit 10";
			
			$result = requete_SQL ($sql);

	    	$patientMenu .= "<a class='yuimenuitemlabel' href='../patients/recherche_patient.php'>Recherche et modification du patient</a>";
    		$titulaireMenu .= "<a class='yuimenuitemlabel' href='../patients/recherche_patient.php'>Recherche et modification du titulaire</a>";
			
			$content .=  "<table border='0' cellpadding='2' cellspacing='1'>";
			
			while($data = mysql_fetch_assoc($result)) 	{
	
				$formPrenom = $data['patient_prenom'];
				$formNom = $data['patient_nom'];
				$formDateNaissance = $data['patient_date_naissance'];
				$formID = $data['patient_id'];
						
				$sqllight = "SELECT p.id as patient_id,	p.nom as patient_nom, p.prenom as patient_prenom, p.date_naissance as patient_date_naissance FROM patients p, cts c, mutuelles m WHERE (p.mutuelle_code = m.code) AND (p.ct1 = c.ct1) AND (p.ct2 = c.ct2) AND p.id='$formID' and p.mutuelle_code != 0 and p.ct1 != 0 and p.ct2 != 0 and (p.mutuelle_matricule!='')";	
				$resultlight = requete_SQL ($sqllight);
				
				if (mysql_num_rows($resultlight)==0) {
					$content .=  "<tr onMouseOver='setPointer(this, 0, 0 );' onMouseOut='setPointer(this, 0, 1 );' onMouseDown='javascript:tarificationModificationPatientList($formID)'>";
					$content .=  "<td valign='middle' align='center' bgcolor='#D5D5D5' nowrap='nowrap'>";
					$content .=  "<img src='../images/16x16/delete.png' /></td>";
					$content .=  "<td valign='middle' align='center' bgcolor='#D5D5D5' nowrap='nowrap'>";
					$content .=  htmlentities(stripcslashes($data['patient_nom']),ENT_QUOTES)." ";
					$content .=  htmlentities(stripcslashes($data['patient_prenom']),ENT_QUOTES)." ";
					$content .=  "(".$formDateNaissance.")";
					$content .=  "</td>";
					$content .=  "</tr>";
				} else {
					$content .=  "<tr height='30' onMouseOver='setPointer(this, 0, 0 );' onMouseOut='setPointer(this, 0, 1 );' onMouseDown='javascript:tarificationRecherchePatientList($formID)'>";
					$content .=  "<td valign='middle' align='center' bgcolor='#D5D5D5' nowrap='nowrap'>";
					$content .=  "<img src='../images/16x16/accept.png' /></td>";
					$content .=  "<td valign='middle' align='center' bgcolor='#D5D5D5' nowrap='nowrap'>";
					$content .=  htmlentities(stripcslashes($data['patient_nom']),ENT_QUOTES)." ";
					$content .=  htmlentities(stripcslashes($data['patient_prenom']),ENT_QUOTES)." ";
					$content .=  "(".$formDateNaissance.")";
					$content .=  "</td>";
					$content .=  "</tr>";
				}
						
			}
			
			$content .=  "</table>";

		}
	}


$datas = array(
    'root' => array(
        'content' => $content, 
        'patientMenu' => $patientMenu,
        'titulaireMenu' => $titulaireMenu
)
);
		
header("X-JSON: " . json_encode($datas));

?>		