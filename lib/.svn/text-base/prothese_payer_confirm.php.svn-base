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
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Confirmation du paiement d'une proth&egrave;se</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link rel="stylesheet" type="text/css" media="all" href="../style/css_base.css" />
	<style type="text/css" title="mainStyle">
	@import "../style/css_general.css";
	</style>
	<script src='../js/prothese.js'></script>
</head>

<body>
<CENTER><BR><BR>
<FONT SIZE="2" COLOR="navy" face=arial>

Faites votre choix dans cette liste : <BR>
<br />
<form id='liste' name='liste'>
	<SELECT id='paiement' name='paiement'>
		<OPTION value="">Votre choix ...</OPTION>
		<OPTION value="espece">Paiement en espèce</OPTION>
		<OPTION value="banksys">Paiement par bancontact</OPTION>
	</SELECT>
</FORM>
<br />
<a href='' onclick='javascript:prothese_cancel_payer();'>Annuler</a>
&nbsp;&nbsp;&nbsp;&nbsp;<a href='' onclick='javascript:prothese_payer();'>Confirmer</a>

</FONT>
</CENTER>
</BODY></HTML>