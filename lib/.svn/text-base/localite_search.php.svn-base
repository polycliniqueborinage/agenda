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
	include_once '../lib/fonctions.php';

	include_once '../lib/gestionErreurs.php';
	$test = new testTools("info");

	// TODO depend du login
	connexion_DB('poly');

	$search = isset($_GET['search']) ? $_GET['search'] : '';
	$search = trim($search);
	$search = $test->convert($search);

	$code_postal = substr($search,0,4);

	if (strlen($search)>4) {
		$ville=ucfirst(trim(substr($search,4)));
	} else {
		$ville="";
	}
		
	if ($code_postal != '' && is_numeric($code_postal)) {
	
		$sql = "SELECT code_postal, ville FROM localite where code_postal = '$code_postal' and ville like '$ville%' ORDER BY ville";
		$result = mysql_query($sql);
		
		if(mysql_num_rows($result)!=0) {
			while($data = mysql_fetch_assoc($result)) 	{
				echo htmlentities($data['code_postal'])." ";
				echo htmlentities($data['ville']);
				// BUG : - is a possible value in the field 'localite'
				echo "#";
			}
		} else {
			echo htmlentities($search);
		}
										
	} else {
		echo htmlentities($search);
	}

?>