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
	
	if (isset($_GET['id'])) {
		// from url
		$formID = $_GET['id'];
		
		$sql = "SELECT id, tarification_id, cecodi, propriete, description, kdb, bc, hono_travailleur, a_vipo, b_tiers_payant, cout, caisse FROM tarifications_detail WHERE ( id = $formID)";
	
		$result = mysql_query($sql);
	
		if(mysql_num_rows($result)==1) {
			
			$data = mysql_fetch_assoc($result);
			$formCaisse = $data['caisse'];
			$formCout = $data['cout'];
			$formDescription = $data['description']; 
		
		} else {
			die();
			// fermeture de la page
		}
	
		
	}
	deconnexion_DB();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr" dir="ltr">

<head>
<title>Modification d'une prestation</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src='../js/tarification.js'></script>
</head>

<body>

<fieldset class=''>
<legend>Modification - <?=html_entity_decode(htmlentities(stripcslashes($formDescription),ENT_QUOTES))?></legend>
<form name='cecodiForm' id='cecodiForm' method='post' action=''>
<table class='formTable simple'  id='' border='0' cellpadding='2' cellspacing='1'>
<th>CECODI</th>
<th>KDB</th>
<th>BC</th>
<th>HONO</th>
<th>VIPO</th>
<th>TIERS</th>
<th>Co&ucirc;t</th>
<th>Caisse</th>

<tr>

<td align='center' bgcolor='#d5d5d5' valign='top' width='16'>
<input type='text' name='cecodi' id='cecodi' size='4' maxlength='6' class='txtField' autocomplete='off' value=''/ onKeyUp='javascript:tarification_check_cecodi_popup(this);'>
</td>
<td align='center' bgcolor='#d5d5d5' valign='top' width='16'>
<input type='text' name='kdb' id='kdb' size='4' maxlength='6' class='txtField' autocomplete='off' readonly='true' value=''/>
</td>
<td align='center' bgcolor='#d5d5d5' valign='top' width='16'>
<input type='text' name='bc' id='bc' size='4' maxlength='6' class='txtField' autocomplete='off' readonly='true' value=''/>
</td>
<td align='center' bgcolor='#d5d5d5' valign='top' width='16'>
<input type='text' name='hono_travailleur' id='hono_travailleur' size='4' maxlength='6' class='txtField' autocomplete='off' readonly='true' value=''/>
</td>
<td align='center' bgcolor='#d5d5d5' valign='top' width='16'>
<input type='text' name='a_vipo' id='a_vipo' size='4' maxlength='6' class='txtField' autocomplete='off' readonly='true' value=''/>
</td>
<td align='center' bgcolor='#d5d5d5' valign='top' width='16'>
<input type='text' name='b_tiers_payant' id='b_tiers_payant' size='4' maxlength='6' class='txtField' autocomplete='off' readonly='true' value=''/>
</td>
<td align='center' bgcolor='#d5d5d5' valign='top' width='16'>
<input type='text' name='cout' id='cout' size='4' maxlength='6' class='txtField' autocomplete='off' readonly='true' value='<?=$formCout?>'/>
</td>
<td align='center' bgcolor='#d5d5d5' valign='top' width='16'>
<input type='text' name='' id='' size='4' maxlength='6' class='txtField' autocomplete='off' readonly='true' value='<?=$formCaisse?>'/>
</td>

</tr>
		
<tr>
<td colspan='8'>
<input type='text' name='description' id='description' size='70' maxlength='70' class='txtField' autocomplete='off' readonly='true' value=''/>
</td>
</tr>

</table>
</form>
</fieldset>


<div class='buttonGroup clearfix'>
	<div class='center'>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type='submit' value='Ok' onclick='javascript:tarification_modif_cecodi_confirm(<?=$formID?>);'/>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type='submit' value='Annuler' onclick='javascript:self.close();'/>
	</div>
</div>
								
		
</body>
</html>
