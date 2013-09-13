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
	include_once 'fonctions.php';
	
	// Fonction de connexion à la base de données
	connexion_DB('poly');

	// On fait la requête
	
	// Nom du fichier d'ajout 
	$nom_fichier = "modif_patient.php";

	$champscomplet = $_GET['pseudo'];
	
	$champscomplet = str_replace("-"," ",$champscomplet);
	$champscomplet = str_replace("  "," ",$champscomplet);
	
	$tok = strtok($champscomplet," ");


	$sql = "SELECT t.date as tarif_date, t.id as tarif_id, p.nom as patient_nom, 
			p.prenom as patient_prenom, m.nom as medecin_nom, 
			m.prenom as medecin_prenom 
			FROM tarifications t, patients p, medecins m 
			WHERE t.patient_niss = p.niss 
			AND t.medecin_inami = m.inami 
			AND t.etat='start' 
			AND (m.nom LIKE '%' or m.prenom LIKE '%' ) 
			AND (p.nom LIKE '%' or p.prenom LIKE '%' )";
	while ($tok !== false) {
   		$sql.=" AND ( p.nom LIKE '";
		$sql.= ucfirst(strtolower($tok));
		$sql.="%' or p.prenom LIKE '";
		$sql.= ucfirst(strtolower($tok));
		$sql.="%' or m.nom LIKE '";
		$sql.= ucfirst(strtolower($tok));
		$sql.="%' or m.prenom LIKE '";
		$sql.= ucfirst(strtolower($tok));
		$sql.="%' )";
		$tok = strtok(" ");
	}
		
	// VERIFICATION
	$result = mysql_query($sql);
	if(mysql_num_rows($result)==0) {
	
	// pas de résultat
	echo "";
	
	} else {
	
		echo "<fieldset class=''>";
		echo "<legend>R&eacute;sultats</legend>";
		echo "<table class='formTable simple' border='1' cellspacing='0' cellpadding='0'>";
		echo "<tr>";
		
								
								
								
		$nombrePatientAffiche = 5;
		$compteur = 0;
		// on fait une boucle qui va faire un tour pour chaque enregistrement
		while(($data = mysql_fetch_assoc($result)) && ($compteur!=$nombrePatientAffiche)) 	{
			// on affiche les informations de l'enregistrement en cours
    		echo "<li><a href='./modif_tarification.php?id=".$data['tarif_id']."'>";
			echo $data['patient_prenom']." ";
			echo $data['patient_nom']." - ";
			echo $data['tarif_id']." - ";
			echo "</a>";
			echo "</li>";
			$compteur++;
		}	 
		
		
		echo "</tr>";
		echo "</table>";
		echo "</fieldset>";
	}


	deconnexion_DB();
	
?>