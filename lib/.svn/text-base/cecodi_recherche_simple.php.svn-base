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
	
	// Fonction de connexion à la base de données
	connexion_DB('poly');

	$jsID = isset($_GET['id']) ? $_GET['id'] : '';
	$jsPseudo = isset($_GET['pseudo']) ? $_GET['pseudo'] : '';
	
	$modifUrl ='../cecodis/modif_cecodi.php?cecodi=';
	//$dico = array('tiers_payant' => 'Non', 'tiers_payantchecked' => 'Oui');
	
	$content="";
	$title="";
		
	$sql = "SELECT * FROM cecodis2 ";
	
	if ($jsID != '') {

		$sql .=" WHERE id ='$jsID'";

	} else {
		
		// verification if the value $champscomplet contain and ID
		$jsPseudo = strtolower($test->convert($jsPseudo));
		$jsPseudo = trim($jsPseudo);
		
		// protect empty conten in editor's field
		if ($jsPseudo=="") $jsPseudo="%";
		
		$sql .= " WHERE (lower(cecodi) like '$jsPseudo%' OR lower(description) regexp '$jsPseudo') order by cecodi, id LIMIT 7";
		
	}

	$result = requete_SQL($sql);
	
	if(mysql_num_rows($result)>1) {

		$style='bleu';
		$title = "";
		$content .= "<ul class='border-red border-greenred'>";

		while($data = mysql_fetch_assoc($result)) 	{
			
			$age = substr($data['age'], 1, (strlen($data['age'])-2));
			$tok = strtok($age,"||");
			$temp = "";
			$currentAge = "";
			$oldAge = "";
			while ($tok !== false) {
				$currentAge = $tok;
				if ($currentAge != ($oldAge+1)) {
					$temp .= "-".$oldAge.";".$currentAge;
				}
				$tok = strtok("||");
  				$oldAge = $currentAge;
			}
			$temp.= "-".$currentAge.";"; 
			$temp =  substr($temp, 2);
			$age = $temp;
		
			switch($style) {
			case 'green':
				$style='bleu';
				break;
			case 'bleu':
				$style='green';
			break;
			default:
			}
			
			$content .=  "<li onclick=\"cecodi_recherche_list('".$data['id']."')\"  class='$style'><a href=\"#\" title=\"".$data['cecodi']." ".$age."\">";
			$content .= ucfirst(htmlentities($data['propriete']))." - ".$data['cecodi'];
			$content .= "</a></li>";
		
		}
		
		$content .= "</ul>";
		
	} else {
		
		if(mysql_num_rows($result)==1) {

			$data = mysql_fetch_assoc($result);
			
			$title = $data['cecodi'];
			
			$age = substr($data['age'], 1, (strlen($data['age'])-2));
			$tok = strtok($age,"||");
			$temp = "";
			$currentAge = "";
			$oldAge = "";
			while ($tok !== false) {
				$currentAge = $tok;
				if ($currentAge != ($oldAge+1)) {
					$temp .= "-".$oldAge.";".$currentAge;
				}
				$tok = strtok("||");
  				$oldAge = $currentAge;
			}
			$temp.= "-".$currentAge.";"; 
			$temp =  substr($temp, 2);
			$age = $temp;
			
			
			$content .= "<div class='border-red color".$data['patient_rating_somme_info']."'>";
			$content .= "<h1>";
			$content .= "&nbsp;<a href='".$modifUrl.$data['cecodi']."' alt='Modification compl&egrave;te' title='Modification compl&egrave;te'><img src=\"../images/modif_small.gif\" /></a>";
			$content .= $data['cecodi']."</h1>";
			$content .= "<b>Age : </b>".$age."<br/>";
			if ($data['propriete'] == 'consultation') {
				$content .= "<b>hono_travailleur : </b>".$data['hono_travailleur']."<br/>";
				$content .= "<b>a_vipo : </b>".$data['a_vipo']."<br/>";
				$content .= "<b>b_tiers_payant : </b>".$data['b_tiers_payant']."<br/>";
			}
			if ($data['propriete'] == 'acte') {
				$content .= "<b>kdb : </b>".$data['kdb']."<br/>";
				$content .= "<b>bc : </b>".$data['bc']."<br/>";
			}
			
			$content .= "<b>Description : </b>".htmlentities($data['description'])."<br/>";
			$content .= "<b>Condition : </b>".htmlentities($data['cond'])."<br/>";
			$content .= "<b>Classe : </b>".htmlentities($data['classe'])."<br/>";
			
			if ($data['tpfortr'] == 'checked') {
			
				$content .= "<b>Accorder le tiers payant pour le travaileur</b><br/>";
			}

			$content .= "<b>Maison vp : </b>".htmlentities($data['prix_vp'])."<br/>";
			$content .= "<b>Maison tp : </b>".htmlentities($data['prix_tp'])."<br/>";
			$content .= "<b>Maison tr : </b>".htmlentities($data['prix_tr'])."<br/>";
			$content .= "</div>";
			

		} else {
			// no result at all!
			$title = "";
			$content .= "<div class='border-green'>";
			$content .= "Aucune prestation INAMI trouv&eacute;e !";
			$content .= "</div>";
		}
			
	}
	
	deconnexion_DB();

$datas = array(
    'root' => array(
        'content' => $content, 
        'title' => $title
	)
);
		
header("X-JSON: " . json_encode($datas));

?>