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

	$medecinCurrent = isset($_SESSION['medecinCurrent']) ? $_SESSION['medecinCurrent'] : "";

	$day = isset($_GET['day']) ? $_GET['day'] : "";

	$ordre = isset($_GET['ordre']) ? $_GET['ordre'] : "";

	$style = isset($_GET['style']) ? $_GET['style'] : "";

	$midday = isset($_GET['midday']) ? $_GET['midday'] : "";
	
	if ( stripos($style, 'rgb(248') != 0 || (stristr($style, '#f8e9c6') === TRUE) ) {
	
		$db = "#c5f7c5";
		$style = "height: 36px; background-color: rgb(197, 247, 197);";
	
	} else {
	
		if ( stripos($style, 'rgb(197') != 0  || (stristr($style, '#c5f7c5') === TRUE)) {
	    
			$db = "#b5cbe7";
			$style = "height: 36px; background-color: rgb(181, 203, 231);";
			  	
		} else {
		
			$db = "#f8e9c6";
			$style = "height: 36px; background-color: rgb(248, 233, 198);";
		
		}
	}
	
	echo $style;
	
	if ($day != "" && $ordre !="" && $medecinCurrent !="") {
	
		connexion_DB('poly');
		
		$sql = "UPDATE horaire_presence_".$medecinCurrent." SET color = '$db' WHERE day = '$day' and midday='$midday' and ordre='$ordre'";
		
		$result = mysql_query($sql);
		
		deconnexion_DB();
	
	}
?>