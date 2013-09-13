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
	
	$champscomplet = $_GET['pseudo'];
	
	$champscomplet = str_replace("-"," ",$champscomplet);
	$champscomplet = str_replace("  "," ",$champscomplet);
	
	$tok = strtok($champscomplet," ");

	$sql = "SELECT nom, prenom, inami FROM medecins WHERE ( nom LIKE '%' or prenom LIKE '%')";
	while ($tok !== false) {
   		$sql.=" AND ( nom LIKE '%";
		$sql.= $tok;
		$sql.="%' or prenom LIKE '%";
		$sql.=$tok;
		$sql.="%' )";
		$tok = strtok(" ");
	}
	
	
	// VERIFICATION
	$result = mysql_query($sql);
	
	if(mysql_num_rows($result)==0) {
	// pas de résultat
	echo "<fieldset class=''>";
	echo "<legend>Pas de m&eacute;decin correspondant</legend>";
	echo "</fieldset>";
	
	} else {
		// un seul résultat
		if(mysql_num_rows($result)==1) {
		
			$data = mysql_fetch_assoc($result);
			
			echo "<input type='hidden' id='medecin_inami' name='medecin_inami' value='".$data['inami']."'>";
			echo "<fieldset class=''>";
			echo "<legend>".$data['nom']." ".$data['prenom']."</legend>";
			echo "<table class='formTable simple' border='1' cellspacing='0' cellpadding='0'>";
			// affichage liste de cedoci
			$sql = "SELECT inami FROM medecins WHERE ( nom = '".$data['nom']."' and prenom = '".$data['prenom']."')";
			
			
			$result = mysql_query($sql);
			
			if(mysql_num_rows($result)==1) {
			
				$data = mysql_fetch_assoc($result);
				
				$sql = "SELECT cecodi FROM medecin_cecodi WHERE ( medecin_inami = '".$data['inami']."')";
				
				$result = mysql_query($sql);
			
				if(mysql_num_rows($result)!=0) {

					echo "<th class='formLabel'><label for='cecodi'>CECODI <br /></label></th>";
					echo "<td class='formInput'>";
					
					echo "<select id='cecodi' name='cecodi' title='CECODI du medecin'>";
					echo "<option value='choisir'>Choisir...</option>";
														
						while($data = mysql_fetch_assoc($result)) {
							echo "<option value='";
							echo $data['cecodi'];
							echo "'>";
							echo $data['cecodi'];
							echo "</option>";
						}
					echo "</select>";
					echo "</td>";
				}
			}
				
			echo "</table></fieldset>";
			
		}
		else {
			echo "<fieldset class=''>";
			echo "<legend>Trop de m&eacute;decin correspondants</legend>";
			echo "</fieldset>";
		}
	}


?>


	




