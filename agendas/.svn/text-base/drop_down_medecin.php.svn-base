<?php
	// BUG change specialite table

	session_start();

	include_once '../lib/fonctions.php';
	
	$pseudo = $_GET['pseudo'];
	
	connexion_DB('poly');
	
	$sql = "SELECT distinct nom, prenom, inami FROM medecins where type='interne' and agenda='checked'";
	if ($pseudo != "all") $sql.= " and specialite ='".$pseudo."'";
	$sql.= " order by nom, prenom";
	
	$result = requete_SQL($sql);
	
	echo "<option value='all'>Toutes les m&eacute;decins</option>";
	while($data = mysql_fetch_assoc($result)) 	{
		echo "<option value='".$data['inami']."'>".htmlentities($data['nom'])." ".htmlentities($data['prenom'])."</option>";
	}
	
	deconnexion_DB();
?>

