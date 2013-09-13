<?php 

	// Demarre une session
	session_start();
	
	// Validation du Login
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
	
	$sessTarificationID = $_SESSION['tarification_id'];
	
	connexion_DB('poly');
	
	// Affichage de la liste
	$sql = "SELECT id, tarification_id, cecodi, propriete, description, kdb, bc, hono_travailleur, a_vipo, b_tiers_payant, cout, cout_poly, cout_medecin, caisse FROM tarifications_detail WHERE ( tarification_id = $sessTarificationID) order by 1";
	$result = requete_SQL ($sql);
	
	if(mysql_num_rows($result)!=0) {
										
		echo "<table class='formTable simple'  id='' border='0' cellpadding='2' cellspacing='1'>";
		echo "<th class='td'  colspan='2' align='center'>";
		echo "</th>";
		echo "<th>CECODI</th>";
		echo "<th>KDB</th>";
		echo "<th>BC</th>";
		echo "<th>HONO</th>";
		echo "<th>VIPO</th>";
		echo "<th>TIERS</th>";
		echo "<th>Co&ucirc;t</th>";
		echo "<th>Caisse</th>";
		
		$i = 0;
    	
		while($data = mysql_fetch_assoc($result)) 	{
		
			$i++;
			// on affiche les informations de l'enregistrement en cours
			echo "<tr>";
			// modification
			echo "<td width='16' align='center' valign=top' bgcolor='#D5D5D5'>";
			if ($data['propriete'] == 'prepay') {
				echo "<a class='thickbox' href='../lib/tarification_modif_cecodi.php?id=".$data['id']."&page=badge&height=200&width=500' title='Modification'>";
				echo "<img width='16' height='16' src='../images/modif_small.gif' alt='Modifier' title='Modifier' border='0' /></a>";
			}
												
			if ($data['propriete'] == 'interne') {
					echo "<a href='#' onClick='javascript:tarification_modif_interne(".$data['id'].");return false;'>";
													echo "<img width='16' height='16' src='../images/modif_small.gif' alt='Modifier' title='Modifier' border='0' /></a>";
												}
												echo "</td>";
				
			echo "<td width='16' align='center' valign=top' bgcolor='#D5D5D5'>";
			if (strpos($formTarificationEtat, "close")===false) {
				echo "<a href='#' onClick='javascript:submitForm(".$data['id'].");return false;' >";
				echo "<img width='16' height='16' src='../images/delete_small.gif' alt='Effacer' title='Effacer' border='0' /></a>";
			}
			echo "</td>";

												echo "<td align='center' bgcolor='#d5d5d5' valign='top' width='16'>";
												if ($data['cecodi'] != '0') {
													echo "<a target='_blank' href='".$url.$data['cecodi']."' title='".strtoupper($data['propriete'])." ".$data['description']."'>".$data['cecodi']."</a>";
												} else {
													echo "<a href='#' title='".strtoupper($data['propriete'])." ".$data['description']."'>".$data['description']."</a>";
												}
												echo "</td>";
		
												echo "<td align='center' bgcolor='#d5d5d5' valign='top' width='16'>";
												echo $data['kdb']."</td>";
	
												echo "<td align='center' bgcolor='#d5d5d5' valign='top' width='16'>";
												echo $data['bc']."</td>";

												echo "<td align='center' bgcolor='#d5d5d5' valign='top' width='16'>";
												echo $data['hono_travailleur']."</td>";
	
												echo "<td align='center' bgcolor='#d5d5d5' valign='top' width='16'>";
												echo $data['a_vipo']."</td>";
		
												echo "<td align='center' bgcolor='#d5d5d5' valign='top' width='16'>";
												echo $data['b_tiers_payant']."</td>";
		
												echo "<td align='center' bgcolor='#d5d5d5' valign='top' width='16'>";
												echo $data['cout']."</td>";
		
												echo "<td align='center' bgcolor='#d5d5d5' valign='top' width='16'>";
												echo $data['caisse']."</td>";
			
												echo "</tr>";
			
											}
	
										echo "</table>";

									} 


									
									
									
									/*
											
										?>
							</form>
								<!-- CAISSBOX -->
								
								
							<!-- BOUTONBOX -->
							<div id="buttonbox">
									<br/>
									<br/>
									<a class="thickbox" href="../lib/tarification_payer_confirm.php?TB_iframe=true&amp;amp;height=160&amp;amp;width=400" title="Paiement d'une tarification"><input type='submit' class='button' value='Payer'/></a>
									<?php
										
											if ($formEtat =="start") {
												echo "<input type='submit'  class='button' value='Cl&ocirc;turer' onclick='javascript:tarification_cloturer($formTarificationID);' title='Permet la facturation aux m&eacute;decins et mutuelles'/>";
											} else {
												if ($formEtat =="close") {
												} else {
													if (strpos($formEtat, "prepay") === false) {
														echo "<input type='submit' class='button' value='Cl&ocirc;turer' onclick='javascript:tarification_cloturer($formTarificationID);' title='Permet la facturation aux m&eacute;decins et mutuelles'/>";
													} 
												}
											}
											
											
											echo "&nbsp;<input type='submit' class='button' value='Sortir' onclick='javascript:tarification_sortir()'/>";
							*/