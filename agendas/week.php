<?php

	// Demarre une session
	session_start();

	// Validation du Login
	// SECURISE
	if(isset($_SESSION['application'])) {
		if ($_SESSION['application']=="|agenda|") {
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

	// Nom du fichier en cours 
	$nom_fichier = "week.php";
	
	// variables
	$modifUrl ='../patients/modif_patient.php?id=';
	$lengthConsult ='10';
	$id = '';

	$dateCurrent = isset($_SESSION['dateCurrent']) ? $_SESSION['dateCurrent'] : date("Y-m-d");
	$dateCurrent = isset($_GET['dateCurrent']) ? $_GET['dateCurrent'] : $dateCurrent;
	$_SESSION['dateCurrent'] = $dateCurrent;
	$datetools = new dateTools($dateCurrent,$dateCurrent);
	
	$weekCurrent = $datetools->weekDATE();
	$day[0] = $weekCurrent['sunday'];
	$day[1] = $weekCurrent['monday'];
	$day[2] = $weekCurrent['tuesday'];
	$day[3] = $weekCurrent['wednesday'];
	$day[4] = $weekCurrent['thursday'];
	$day[5] = $weekCurrent['friday'];
	$day[6] = $weekCurrent['saturday'];
	
	$medecinCurrent = isset($_SESSION['medecinCurrent']) ? $_SESSION['medecinCurrent'] : "all";
	$medecinCurrent = isset($_GET['medecinCurrent']) ? $_GET['medecinCurrent'] : $medecinCurrent;
	$_SESSION['medecinCurrent'] = $medecinCurrent;
	
	// connexion a la base de donnée
	connexion_DB('poly');
	$sql = "SELECT * FROM medecins where inami='".$medecinCurrent."'";
	$sql2 = "SELECT * FROM `".$medecinCurrent."`";
	
	$result = requete_SQL ($sql);
	$result2 = mysql_query($sql2);
	
	if (!$result2 || mysql_num_rows($result)==0){
		$validMedecin = false;
		if (!$result2 && mysql_num_rows($result)!=0) $nomPrenomMedecin = "Agendas - Semaine : Demander &agrave; l'administrateur de cr&eacute;er cet agenda!"; 
		else $nomPrenomMedecin = "Agendas - Semaine : Choisir un m&eacute;decin...";
	} else {
		$validMedecin = true;
		$data = mysql_fetch_assoc($result);
		$id = $data['id'];
		$lengthConsult = $data['length_consult'];
		$nomPrenomMedecin = "Agendas - Semaine : ".$data['nom']." ".$data['prenom'];
	}
	deconnexion_DB();

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<title>Poly - Agenda hebdomadaire</title>
	<link href="../style/poly.css" media="all" rel="Stylesheet" type="text/css">
</head>
<body id='body' onLoad="init();">
	
	<?php
		get_MENUBAR_START();
		if ($validMedecin) {
			echo "<li class='yuimenubaritem'>M&eacute;decin";
			echo "	<div id='medecinsupp' class='yuimenu'>";
			echo "		<div class='bd'>       ";             
			echo "		  	<ul>";
			echo "				<li class='yuimenuitem'>";
			echo "					<a href='#' onclick='openMedecin(\"medecin_comment\");' title='Information sur le m&eacute;decin en cours' >Information</a>";
			echo "				</li>";
			echo "				<li class='yuimenuitem'>";
			echo "					<a href='#' onclick='openMedecin(\"medecin_horaire\");' title='Information sur le m&eacute;decin en cours' >Horaire</a>";
			echo "				</li>";
			echo "			</ul>";
			echo "		</div>";
			echo "	</div>";
			echo "</li>";
		}
		get_MENUBAR_END();
	?>
	
    <div id="top">
		
		<h1>
  			<?=$nomPrenomMedecin?>
		</h1>

	</div>
	
	<div id="middle">
    	
		<div id="header">
        	<ul id="primary_tabs">
				<?php get_MENU('agendas')?>
        	</ul>
		</div>        
      
	  	<div id="main">
        
			<div id="tab_panel">
			
				<div class="secondary_tabs">
   
					<a href="./day.php">Journ&eacute;e</a>
   					<span>Semaine</span> 
  					<a href="./planning.php">Horaire</a>
						
				</div>
	
				<div class="ViewPane">

					<div class="navigation-calendar">

						<a class="previousMajor" href="./week.php?dateCurrent=<?=$datetools->changeDATE(-7)?>" onclick="" title="Semaine pr&eacute;c&eacute;dente"></a>
						<a class="previousMinor" href="./week.php?dateCurrent=<?=$datetools->changeDATE(-1)?>" onclick="" title="Jour pr&eacute;c&eacute;dent"></a>
						<a class="nextMajor" href="./week.php?dateCurrent=<?=$datetools->changeDATE(+7)?>" onclick="" title="Semaine suivante"></a>
						<a class="nextMinor" href="./week.php?dateCurrent=<?=$datetools->changeDATE(+1)?>" onclick="" title="Jour suivant"></a>
  						<h2>
  						<?=$datetools->transformDATE()?>
	  					</h2>
  					</div>
						
					<!-- DEBUT DU CALENDRIER -->
					<table>
		
						<tr class="n-day-calendar-allday-view">
			    			<th class="<?=$weekCurrent['sundayclass'];?>" colspan="4" style="width: 12%;"><a href="./day.php?dateCurrent=<?=$weekCurrent['sunday'];?>">Dimanche</a></th>
			
							<th class="<?=$weekCurrent['mondayclass'];?>" colspan="4" style="width: 12%;"><a href="./day.php?dateCurrent=<?=$weekCurrent['monday'];?>">Lundi</a></th>
			
							<th class="<?=$weekCurrent['tuesdayclass'];?>" colspan="4" style="width: 12%;"><a href="./day.php?dateCurrent=<?=$weekCurrent['tuesday'];?>">Mardi</a></th>
				
							<th class="<?=$weekCurrent['wednesdayclass'];?>" colspan="4" style="width: 12%;"><a href="./day.php?dateCurrent=<?=$weekCurrent['wednesday'];?>">Mercredi</a></th>
				
			 				<th class="<?=$weekCurrent['thursdayclass'];?>" colspan="4" style="width: 12%;"><a href="./day.php?dateCurrent=<?=$weekCurrent['thursday'];?>">Jeudi</a></th>
				
			 				<th class="<?=$weekCurrent['fridayclass'];?>" colspan="4" style="width: 12%;"><a href="./day.php?dateCurrent=<?=$weekCurrent['friday'];?>">Vendredi</a></th>
				
							<th class="<?=$weekCurrent['saturdayclass'];?>" colspan="4" style="width: 12%;"><a href="./day.php?dateCurrent=<?=$weekCurrent['saturday'];?>">Samedi</a></th>
  						</tr>

						<tr>
							<?php
								if ($validMedecin) {
									connexion_DB('poly');
									for ($j=0; $j <= 6; $j++) {
										
										echo "<td style=\"width: 3%;\">";
										$sql = "SELECT id, color FROM horaire_presence_".$medecinCurrent." where day = '$j' and midday='morning' order by ordre";
										$result = mysql_query($sql);
										while($data = mysql_fetch_assoc($result)) 	{
											echo "<div id='".$data['id']."' style='height:36px; z-index:-1;
background-color:".$data['color'].";'>".$data['id']."</div>";
										}
										$sql = "SELECT * FROM `".$medecinCurrent."` where date = '".$day[$j]."' and midday='morning' order by tri";
										$result = mysql_query($sql);
										while($data = mysql_fetch_assoc($result)) 	{
											echo "<div style=\"top:".($data['top']-1296)."px; height: ".$data['length']."px;\" class='cellSelection week ".$data['new']."'\" id=\"".$data['id']."\">";
											echo "<div><a onClick=\"javascript:Element.show('findPatientForm');patient_recherche_list(".$data['patient_id'].");\" href='#'><img src=\"../images/16x16/comment.png\" /></a></div>";
											echo "<div id=\"selection-start-time\">".$data['start']."</div>";
											echo "<div id=\"selection-end-time\">".$data['end']."</div>";
											echo "</div>";
										}
										echo "</td>";
										
										echo "<td style=\"width: 3%;\">";
										$sql = "SELECT id, color FROM horaire_presence_".$medecinCurrent." where day = '$j' and midday='morning' order by ordre";
										$result = mysql_query($sql);
										while($data = mysql_fetch_assoc($result)) 	{
											echo "<div id='".$data['id']."' style='height:36px; z-index:-1;
background-color:".$data['color'].";'></div>";
										}
										$sql = "SELECT * FROM `".$medecinCurrent."` where date = '".$day[$j]."' and midday='morning_bis' order by tri";
										$result = mysql_query($sql);
										while($data = mysql_fetch_assoc($result)) 	{
											echo "<div style=\"top:".($data['top']-1296)."px; height: ".$data['length']."px;\" class='cellSelection week ".$data['new']."'\" id=\"".$data['id']."\">";
											echo "<div><a onClick=\"javascript:Element.show('findPatientForm');patient_recherche_list(".$data['patient_id'].");\" href='#'><img src=\"../images/16x16/comment.png\" /></a></div>";
											echo "<div id=\"selection-start-time\">".$data['start']."</div>";
											echo "<div id=\"selection-end-time\">".$data['end']."</div>";
											echo "</div>";
										}
										echo "</td>";
										
										echo "<td style=\"width: 3%;\">";
										$sql = "SELECT id, color FROM horaire_presence_".$medecinCurrent." where day = '$j' and midday='afternoon' order by ordre";
										$result = mysql_query($sql);
										while($data = mysql_fetch_assoc($result)) 	{
											echo "<div id='".$data['id']."' style='height:36px; z-index:-1;
background-color:".$data['color'].";'>".$data['id']."</div>";
										}
										$sql = "SELECT * FROM `".$medecinCurrent."` where date = '".$day[$j]."' and midday='afternoon' order by tri";
										$result = mysql_query($sql);
										while($data = mysql_fetch_assoc($result)) 	{
											echo "<div style=\"top:".($data['top']-1296)."px; height: ".$data['length']."px;\" class='cellSelection week ".$data['new']."'\" id=\"".$data['id']."\">";
											echo "<div><a onClick=\"javascript:Element.show('findPatientForm');patient_recherche_list(".$data['patient_id'].");\" href='#'><img src=\"../images/16x16/comment.png\" /></a></div>";
											echo "<div id=\"selection-start-time\">".$data['start']."</div>";
											echo "<div id=\"selection-end-time\">".$data['end']."</div>";
											echo "</div>";
										}
										echo "</td>";
										
										echo "<td style=\"width: 3%;\">";
										$sql = "SELECT id, color FROM horaire_presence_".$medecinCurrent." where day = '$j' and midday='afternoon' order by ordre";
										$result = mysql_query($sql);
										while($data = mysql_fetch_assoc($result)) 	{
											echo "<div id='".$data['id']."' style='height:36px; z-index:-1;
background-color:".$data['color'].";'></div>";
										}
										$sql = "SELECT * FROM `".$medecinCurrent."` where date = '".$day[$j]."' and midday='afternoon_bis' order by tri";
										$result = mysql_query($sql);
										while($data = mysql_fetch_assoc($result)) 	{
											echo "<div style=\"top:".($data['top']-1296)."px; height: ".$data['length']."px;\" class='cellSelection week ".$data['new']."'\" id=\"".$data['id']."\">";
											echo "<div><a onClick=\"javascript:Element.show('findPatientForm');patient_recherche_list(".$data['patient_id'].");\" href='#'><img src=\"../images/16x16/comment.png\" /></a></div>";
											echo "<div id=\"selection-start-time\">".$data['start']."</div>";
											echo "<div id=\"selection-end-time\">".$data['end']."</div>";
											echo "</div>";
										}
										echo "</td>";
									}
									deconnexion_DB();
								}
							?>
						</tr>
						
					</table>
					<!-- FIN DU CALENDRIER -->
									
				</div>
					
				<div id="calendarSideBar">
			  		<div id="calContainer"></div>
				</div>
					
					
			</div>
				
		</div>

	</div>
	
	<div id="left" style="position: fixed">
	
		<table id="left-drawer" cellpadding="0" cellspacing="0">
	    	<tr>
				<!-- CONTENT -->
    	    	<td class="drawer-content">
    	    	
    	    		<?=$informationDay2?>
								
					<a class="taskControl" href="../patients/recherche_patient.php">Recherche patient</a>

					<div id="labels" class="sidebar labels-red">

						<a onclick="Element.toggle('findPatientForm');try{$('findPatientInput').focus()} catch(e){}; return false;" href="#" class="controls" style="display: block;">Recherche...</a>
                	
						<div id="findPatientForm" class="inlineForm" style="display: none;">
							<form onsubmit="">
	                  			<input autocomplete="off" class="text-input" id="findPatientInput" type="text" onFocus="this.select()" onKeyUp="javascript:patient_recherche_simple(this.value)">
    	              			<input class="button" name="commit" value="" type="submit">
        	          		</form>        
                			<div id="informationPatient">
							</div>
						</div>

					</div>
			
            		<!-- a class="taskControl" href="#">Nouveau patient</a>

					<div id="labels" class="sidebar labels-green">
                	
						<a onclick="Element.toggle('createPatientForm');Element.hide('findPatientForm');Element.hide('findMedecinForm');" href="#" class="controls" style="display: block;">Ajout d'un patient...</a>
                	
						<div id="createPatientForm" class="inlineForm" style="display: none;">
							<input autocomplete="off" class="text-input" id="createLastNamePatientInput" type="text" onBlur="setInput(this,'Nom du patient')" value="Nom du patient" title="Nom du patient" onfocus="javascript:this.value=''">
							<input autocomplete="off" class="text-input" id="createFirstNamePatientInput" type="text" onBlur="setInput(this,'Pr&eacute;nom du patient')" value="Pr&eacute;nom du patient" title="Pr&eacute;nom du patient" onfocus="javascript:this.value=''">
							<input autocomplete="off" class="text-input" id="createBirthdayPatientInput" type="text" onBlur="setInput(this,'Date de naissance')" value="Date de naissance" title="Date de naissance" onfocus="javascript:this.value=''" onkeyup="javascript:dateFirstExecutionresult = checkDate(this, '', '');">
							<input autocomplete="off" class="text-input" id="createPhoneNumberInput" type="text" onBlur="setInput(this,'T&eacute;l&eacute;phone')" value="T&eacute;l&eacute;phone" title="T&eacute;l&eacute;phone" onfocus="javascript:this.value=''">
							<input class="button" name="commit" value="Sauver..." onClick="savePatient();">                			
                		</div>
					</div-->
					
					<br/>
			
					<br/>
					
					<div id="labels" class="sidebar labels-red">

						<h2>Dur&eacute;e :</h2>

						<select id='duree' name='duree' width="179" style="width: 179px" onClick="document.getElementById('duree').style.pixelWidth = 179" >
							<?php
								connexion_DB('poly');
								$sql = "SELECT id, pixel FROM length_consult";
								$result = requete_SQL($sql);
								while($data = mysql_fetch_assoc($result)) 	{
									echo "<option value='".$data['pixel']."' ";
									if ($lengthConsult == $data['id']) echo "selected";
									echo " >".$data['id']."</option>";
								}
								deconnexion_DB();
							?>
						</select>

					</div>
					
					<div id="footer">
						<p>targoo@gmail.com bmangel@gmail.com</p>
						<br/>
						<img src='../images/96x96/clock.png'>
 					</div>
				</td>
  			    	
				<td class="drawer-handle" onclick="toggleSidebars(); return false;">
           			<div class="top-corner"></div>
           			<div class="bottom-corner"></div>
       	   	 	</td>
				
      		</tr>
		</table>
	</div>
	
	
	<!-- MENU JS -->
	<script type="text/javascript" src="../yui/build/menu.js"></script>
    <script type="text/javascript">
    	YAHOO.util.Event.onContentReady("productsandservices", function () {
        	var oMenuBar = new YAHOO.widget.MenuBar("productsandservices", { 
                                                            autosubmenudisplay: true, 
                                                            hidedelay: 1000, 
                                                            lazyload: false });

			oMenuBar.render();
		});
	</script>

	<!-- CALENDAR JS -->
	<script type="text/javascript" src="../yui/build/calendar/calendar-min.js"></script>	
	<script>
	function init() {
		var mySelectHandler = function(type,args,obj) {
			var selected = args[0];
			var dateselected = "" + selected[0];
			dateselected = dateselected.replace(",","-");
			dateselected = dateselected.replace(",","-");
			ResultUrl = "./week.php?dateCurrent="+escape(dateselected);
			window.location.href = ResultUrl;
		};
		YAHOO.namespace("calendar");
		YAHOO.calendar.init = function() {
			YAHOO.calendar.cal1 = new YAHOO.widget.CalendarGroup("cal1","calContainer", {PAGES:2});
			YAHOO.calendar.cal1.selectEvent.subscribe(mySelectHandler, YAHOO.calendar.cal1, true);
			YAHOO.calendar.cal1.render();
		}
		YAHOO.util.Event.onDOMReady(YAHOO.calendar.init);
	}
	</script>

	<!-- ALL JS -->
	<script type="text/javascript" src="../js/common.js"></script>
	<script type="text/javascript" src="../js/agenda.js"></script>

	<!-- MODAL JS -->	
	<script type="text/javascript" src="../js/prototype/prototype.js"></script>
	<script type="text/javascript" src="../js/scriptaculous/scriptaculous.js"></script>
	<script type="text/javascript" src="../js/window/window.js"> </script>
	
	<script type="text/javascript">  
		var help = new Window('1', {className: "alphacube", title: "Aide en ligne", top:0, right:0, width:500, height:300});  
  		var notice = new Window('2', {className: "alphacube", title: "Notice", top:20, right:20, width:500, height:300 });  
		var medecin = new Window('3',{className: "alphacube", title: "Information sur le m&eacute;decin", top:40, right:40, width:500, height:300});
		function openHelp() {
	  		help.setURL("../lib/aide_en_ligne.php?type=aide&id=<?=$nom_fichier?>");
	  		help.show();
		}
		function openNotice(id) {
	  		notice.setURL("../lib/aide_en_ligne.php?type=notice&id="+id);
	  		notice.show();
		}
		function openMedecin(type) {
	  		medecin.setURL("../lib/aide_en_ligne.php?type="+type+"&id=<?=$id?>");
	  		medecin.show();
		}
	  	function openModifAssurabilite(html,id) {
	  		Dialog.alert({url: "../patients/modif_patient_mutuelle.php?id="+id, options: {method: 'get'}}, {className: "alphacube", width: 600, height:350, okLabel: "Fermer", ok:function(win) {patient_recherche_list(id);return true;}});
  		}
	  	function openDialogConfirm(id,comment) {
  			Dialog.confirm("Vouler vous supprimer ce rendez-vous ?<br> ["+comment+"]", {width:300, okLabel: "OUI", cancelLabel: "Annuler", className: "alphacube", buttonClass: "myButtonClass", id: "myDialogId", cancel:function(win) {return false;}, ok:function(win) {supprime(id); return true;} });
		}
	  	function openAlert(comment) {
  			Dialog.alert(comment, {width:300, okLabel: "OUI", cancelLabel: "Annuler", className: "alphacube", buttonClass: "myButtonClass", id: "myDialogId", ok:function(win) {return true;} });
		}
	</script>
    
</body>
</html>
