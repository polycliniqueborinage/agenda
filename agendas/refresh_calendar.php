<?php 

	// Demarre une session
	session_start();

	// Validation du Login
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
	
	$content="";
	
	$modifUrl ='../patients/modif_patient.php?id=';

	include_once '../lib/fonctions.php';

	$dateCurrent = isset($_SESSION['dateCurrent']) ? $_SESSION['dateCurrent'] : "";

	$medecinCurrent = isset($_SESSION['medecinCurrent']) ? $_SESSION['medecinCurrent'] : "";

	$midday = isset($_GET['midday']) ? $_GET['midday'] : "";
	
	if ($medecinCurrent!="") {
		
		connexion_DB('poly');
		
		$sql = "SELECT * FROM `".$medecinCurrent."` where date = '".$dateCurrent."' and midday='".$midday."' order by tri";
		
		$result = mysql_query($sql);
		
		while($data = mysql_fetch_assoc($result)) 	{
			
			$userComment = strtok($data['user_comment'],'-');
			$acteComment = strtok($data['acte_comment'],'-');
													
			$content.= "<div style=\"top:".$data['top']."px; height: ".$data['length']."px;\" class=\"cellSelection ".$data['new']."\" id=\"".$data['id']."\">";
			$content.= "<div id=\"selection-start-time\">".$data['start']."</div>";
			$content.= "<div id=\"selection-end-time\">".$data['end']."</div>";
			$content.= "<div id=\"selection-new\">&nbsp;&nbsp;</div>";
			
			if ($_SESSION['droit']=='ecriture')
			$content.= "<div id=\"selection-remove\"><a onClick=\"openDialogConfirm('".$data['id']."','".htmlentities(addslashes($userComment))."');\" href=\"#\"><img src=\"../images/16x16/date_delete.png\" /></a></div>";
			
			if ($data['patient_id']!='0') 
				$content.= "<div id=\"selection-info\"><a title='Information' alt='Information' onClick=\"javascript:Element.show('findPatientForm');patient_recherche_list(".$data['patient_id'].");\" href='#'><img src=\"../images/16x16/user_comment.png\" /></a></div>";
			
			$content.= "<div id=\"selection-print\"><a title='Impression' alt='Impression' onClick=\"etiquettePrint('".$data['id']."');\" href=\"#\"><img src=\"../images/16x16/printer.png\" /></a></div>";
			
			if($data['length']!=18) {
				$content.= "<span class=\"inplaceeditor-empty-big\">";
			} else {
				$content.= "<span class=\"inplaceeditor-empty-small\">";
			}
			
			$content.= htmlentities($userComment);
			
			$content.= "</span>";
			$content.= "</div>";
											
		}
										
		deconnexion_DB();
		
	}
	
echo $content;

?>
									