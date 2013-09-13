<?
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
	
	include_once '../lib/fonctions.php';
	
	include_once '../lib/gestionErreurs.php';
	$test = new testTools("info");

	$content = "";
	
	connexion_DB('poly');
		
	if(isset($_GET['inami'])) {  
	
		$inami =$_GET['inami'];
		$sql = "SELECT id, nom, prenom, inami, specialite, taux_acte, taux_consultation, protocole FROM medecins WHERE inami = '$inami' and type='interne'";

	} else {

		$champscomplet = $_GET['pseudo'];
		$champscomplet = html_entity_decode(strtolower($test->convert($champscomplet)));
		$sql = "SELECT id, nom, prenom, inami, specialite, taux_acte, taux_consultation, protocole FROM medecins WHERE type='interne' and ((lower(concat(nom, ' ' ,prenom))) regexp '$champscomplet' or (lower(concat(prenom, ' ' ,nom))) regexp '$champscomplet') limit 10";
	
	}
		
	// VERIFICATION
	$result = requete_SQL ($sql);
		
	// RESULTAT =0
	if(mysql_num_rows($result)==0) {

		$content .= "<br/>Pas de m&eacute;decin correspondant<br/>";
	
	} else {
		
		// RESULTAT = 1
		if(mysql_num_rows($result)==1) {
		
			$data = mysql_fetch_assoc($result);
			$patientPhoto = $data['inami'].".jpg";

			// impression etiquette
			$_SESSION['impression_medecin_last_name']=$data['nom'];
			$_SESSION['impression_medecin_first_prenom']=$data['prenom'];
			$_SESSION['impression_medecin_inami']=$data['inami'];
			
			// hidden fields
			$content .= "<input type='hidden' id='medecin_id' name='medecin_id' value='".$data['id']."'>";
			$content .= "<input type='hidden' id='medecin_inami' name='medecin_inami' value='".$data['inami']."'>";
			
			// AFFICHAGE DES INFOS
			$content .=  "<div id='texte'>";
			
			$content .= "<div class='abstract'>";

			$content .= "<div id='avatar'><img width='70' height='100' alt='' src='../images/thumb.jpg'/></div>";
			$content .= "<div id='avatar'><img width='70' height='100' alt='' src='../patients/photos/$patientPhoto'/></div>";
			
			$content .= "<div class='auteur'>";
			$content .= "<ul>";

			$content .= "<li>";
			$content .= "<strong>";
			$content .= htmlentities(stripcslashes($data['nom']),ENT_QUOTES)." ";
			$content .= htmlentities(stripcslashes($data['prenom']),ENT_QUOTES)." ";
			$content .= "</strong>";
			$content .= "</li>";

			$content .= "<li>";
			$content .= htmlentities($data['specialite']);
			$content .= "</li>";

			$content .= "<li>";
			$content .= "Inami :<b>";
			$content .= htmlentities($data['inami']);
			$content .= "</b></li>";
			
			/*if($data['protocole'] == "T") {
				$content .= "<br/>";
				$content .= "<li>";
				$content .= "<input type='checkbox' name='medecin_protocole' id='medecin_protocole' value='check' checked='true' > Cr&eacute;ation d'un protocole";					
				$content .= "</li>";
			}*/
			
			$content .= "</ul>";
			$content .= "<br/>";
			$content .= "<br/>";
			$content .= "<br/>";
			$content .= "<br/>";
			$content .= "<br/>";
			$content .= "<br/>";
			$content .= "<br/>";
			$content .= "<br/>";
			$content .= "<br/>";
			$content .= "<br/>";
			$content .= "<hr>";
			$content .= "</div>";
			$content .= "</div>";
			
						
		} else {
			
			$content .= "<table border='0' cellpadding='2' cellspacing='1'>";
			while($data = mysql_fetch_assoc($result)) 	{
				$formInami = $data['inami'];
				$content .= "<tr onMouseOver='setPointer(this, 0, 0 );' onMouseOut='setPointer(this, 0, 1 );' onMouseDown='javascript:tarificationRechercheMedecinList($formInami)'>";
				$content .= "<td valign='top' align='center' bgcolor='#D5D5D5' nowrap='nowrap'>";
				$content .= "<img src='../images/16x16/accept.png' /></td>";
				$content .= "<td valign='top' align='center' bgcolor='#D5D5D5' nowrap='nowrap'>";
				$content .= htmlentities(stripcslashes($data['nom']),ENT_QUOTES)." ";
				$content .= htmlentities(stripcslashes($data['prenom']),ENT_QUOTES)." ";
				$content .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INAMI = ".$formInami;
				$content .= "</td>";
				$content .= "</tr>";
			}	 
		}
	}


$datas = array(
    'root' => array(
        'content' => $content
)
);
		
header("X-JSON: " . json_encode($datas));

?>		