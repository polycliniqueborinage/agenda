<?
	session_start();

	include_once '../lib/fonctions.php';
	
	include_once '../lib/gestionErreurs.php';
	$test = new testTools("info");
	
	$sessCaisse = $_SESSION['login'];
	$dateCurrent = isset($_SESSION['dateCurrent']) ? $_SESSION['dateCurrent'] : "";
	$medecinCurrent = isset($_SESSION['medecinCurrent']) ? $_SESSION['medecinCurrent'] : "";
	
	//$dico = array('tiers_payant' => 'Non', 'tiers_payantchecked' => 'Oui');
	
	// get information from url (static when you create the component)
	$midday = isset($_GET['midday']) ? $_GET['midday'] : "";
	$_SESSION['midday'] = $midday;
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$_SESSION['id'] = $id;
	$start = isset($_GET['start']) ? $_GET['start'] : "";
	$_SESSION['start'] = $start;
	$end = isset($_GET['end']) ? $_GET['end'] : "";
	$_SESSION['end'] = $end;
	$length = isset($_GET['length']) ? $_GET['length'] : "";
	$_SESSION['length'] = $length;
	$top = isset($_GET['top']) ? $_GET['top'] : "";
	$_SESSION['top'] = $top;
	$position = isset($_GET['position']) ? $_GET['position'] : "";
	$_SESSION['position'] = $position;

	// get two values from form (id and complete search)
	$jsUserID = $_POST['userid'];
	$jsUserName = $_POST['username'];
	
	$jsActeID = $_POST['acteid'];
	$jsActeName = $_POST['actename'];
	
	$jsUserName = html_entity_decode($jsUserName);
	$jsUserName = trim(strtolower($test->convert($jsUserName)));

	$jsActeName = html_entity_decode($jsActeName);
	$jsActeName = trim(strtolower($test->convert($jsActeName)));
	
	if ($jsUserName !== null  && $medecinCurrent != "" && $midday !="" && $dateCurrent !="") {
	
		connexion_DB('poly');
		
		$new = "std";
		
		// create a medical file
		if (substr_count($jsUserName,"-")!=0){
			$new = "new";
		}
		
		// emergency
		if (substr_count($jsUserName,"!")!=0){
			$new.= " urgt"; 
		}

		// tentative reservation
		if (substr_count($jsUserName,"?")!=0){
			$new.= " tent";
		}
		
		$jsUserName = str_replace("+","",$jsUserName);
		$jsUserName = str_replace("-","",$jsUserName);
		$jsUserName = str_replace("!","",$jsUserName);
		$jsUserName = str_replace("?","",$jsUserName);
						
		// get inforamtion on patient
		if ($jsUserID==""){
			$sqlUser = "SELECT nom , prenom, DATE_FORMAT(date_naissance, GET_FORMAT(DATE, 'EUR')) as date_naissance, rue, code_postal, commune, id, telephone, gsm FROM patients WHERE ((lower(concat(nom, ' ' ,prenom))) regexp '$jsUserName' OR (lower(concat(prenom, ' ' ,nom))) regexp '$jsUserName')";
		} else {
			$sqlUser = "SELECT nom , prenom, DATE_FORMAT(date_naissance, GET_FORMAT(DATE, 'EUR')) as date_naissance, rue, code_postal, commune, id, telephone, gsm FROM patients WHERE id='$jsUserID'";
		}

		// VERIFICATION
		$resultUser = requete_SQL($sqlUser);

		if(mysql_num_rows($resultUser)==1) {
			
			// un seul resultat
			$data = mysql_fetch_assoc($resultUser);
			$valUserName = $data['nom']." ".$data['prenom']." - ".$data['date_naissance']." - Tel: ".$data['gsm']." ".$data['telephone'];
			$valUserName = ($test->convert($valUserName));
			$valUserID = $data['id'];
			
		} else {

			// pas de patient correspondant zero ou trop
			$valUserName = ucfirst($jsUserName)." - Patient inconnu";
			$valUserID = "";
			
		}	
		
		// if comment on acte or other
		if ($jsActeID !="" || $jsActeName!="") {

			// get inforamtion on internal acte
			if ($jsActeID == ""){
				$sqlActe = "SELECT * FROM actes WHERE ((lower(concat(code, ' ' ,description))) regexp '$jsActeName' OR (lower(concat(description, ' ' ,code))) regexp '$jsActeName')";
			} else {
				$sqlActe = "SELECT * FROM actes WHERE id='$jsActeID'";
			}
			
			// VERIFICATION
			$resultActe = requete_SQL($sqlActe);

			if(mysql_num_rows($resultActe)==1) {
			
				// un seul resultat
				$data = mysql_fetch_assoc($resultActe);
				$valActeId = $data['id'];
				$valActeName = $data['code']." - ".$data['description']." ".$data['cecodis'];
				$valActeName = $test->convert($valActeName);
	
			} else {
	
				// pas de acte correspondant zero ou trop
				$valActeId = 0;
				$valActeName = $jsActeName;
				$valActeName = $test->convert($valActeName);
									
			}	
			
		} else {
			
			$valActeId = 0;
			$valActeName = "";
		}
		
		// ajout 
		$sql = "INSERT INTO `".$medecinCurrent."` ( `caisse` , `date` , `midday` , `id` , `start` , `end` , `top` , `position` , `length` , `patient_id` , `acte_id`, `user_comment`, `acte_comment`, `new`) VALUES ('".$sessCaisse."', '".$dateCurrent."', '".$midday."', '".$id."', '".$start."', '".$end."', '".$top."', '".$position."', '".$length."', '".$valUserID."', '".$valActeId."', '".$valUserName."', '".$valActeName."', '".$new."')";
		//$sql = "INSERT INTO `".$medecinCurrent."` ( `caisse` , `date` , `midday` , `id` , `start` , `end` , `top` , `position` , `length` , `patient_id` , `comment`, `new`) VALUES ('".$sessCaisse."', '".$dateCurrent."', '".$midday."', '".$id."', '".$start."', '".$end."', '".$top."', '".$position."', '".$length."', ' ', '".$val."', '".$new."')";
		$result = requete_SQL($sql);
	
		deconnexion_DB();

	}	
?>