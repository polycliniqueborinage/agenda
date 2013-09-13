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
	
	$modifUrl ='../mutuelles/modif_mutuelle.php?code=';
	$nombreMutuelleAffiche = 7;

	$jsID = isset($_GET['id']) ? $_GET['id'] : '';
	$jsPseudo = isset($_GET['pseudo']) ? $_GET['pseudo'] : '';
	
	$number=null;
	$content=null;
	$title=null;
	
	// Fonction de connexion à la base de données
	connexion_DB('poly');
	
	if ($jsID != '') {

		$sql = "SELECT nom , code, rue, code_postal, commune, telephone, fax, contact, mail FROM mutuelles WHERE code ='$jsID'";

	} else {

		$jsPseudo = html_entity_decode($jsPseudo);
		$jsPseudo = strtolower($test->convert($jsPseudo));
		$jsPseudo = trim($jsPseudo);
		
		// protect empty conten in editor's field
		if ($jsPseudo=="") $jsPseudo="%";
		
		$sql = "SELECT nom , code, rue, code_postal, commune, telephone, fax, contact, mail FROM mutuelles WHERE ((lower(nom) regexp '$jsPseudo') or (lower(code) regexp '$jsPseudo'))";

	}
	
	// VERIFICATION
	$result = mysql_query($sql);
	
	if(mysql_num_rows($result)>1) {
	
		$i = 0;
		$style='bleu';
				
		$title = "";
		
		$content = "<ul class='border-red border-greenred'>";
		while(($data = mysql_fetch_assoc($result))&&($i<$nombreMutuelleAffiche)) 	{
		
			switch($style) {
			case 'red':
				$style='bleu';
				break;
			case 'bleu':
				$style='red';
			break;
			default:
			}
				
			$content .= "<li onclick=\"mutuelle_recherche_list('".$data['code']."')\"  class='$style'><a href=\"#\" title=\"".$data['code']." - ".htmlentities($data['nom'])."\">";
			$content .= $data['code']." - ".htmlentities($data['nom']);
			$content .= "</a></li>";
		
			$i++;
		}
		$content .= "</ul>";
		
				
	
	} else {
		
		if(mysql_num_rows($result)==1) {

			$data = mysql_fetch_assoc($result);
			
			$title = $data['code'];
			
			$content = "<div class='border-red color".$data['patient_rating_somme_info']."'>";
			$content .= "<h1><a href='".$modifUrl.$data['code']."'><img src=\"../images/modif_small.gif\" /></a>".htmlentities($data['code'])." ".htmlentities($data['nom'])."</h1><br/>";
			$content .= "<b>Adresse : </b>".htmlentities($data['rue'])." ".$data['code_postal']." ".htmlentities($data['commune'])."<br/>";
			$content .= "<b>Contact : </b>".htmlentities($data['contact'])."<br/>";
			$content .= "<b>T&eacute;l&eacute;phone : </b>".htmlentities($data['telephone'])."<br/>";
			$content .= "<b>Fax : </b>".htmlentities($data['fax'])."<br/>";
			$content .= "</div>";
			
		} else {

			$title = "";
			$content = "<div class='border-red'>";
			$content .= "Aucune mutuelle trouv&eacute;e !";
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