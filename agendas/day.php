<?php

	// Demarre une session
	session_start();
	
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
	$nom_fichier = "day.php";
	
	// variables
	$modifUrl ='../patients/modif_patient.php?id=';
	$lengthConsult ='10';
	$id = '';
	
	// from session and url
	$dateCurrent = isset($_SESSION['dateCurrent']) ? $_SESSION['dateCurrent'] : date("Y-m-d");
	$dateCurrent = isset($_GET['dateCurrent']) ? $_GET['dateCurrent'] : $dateCurrent;
	$_SESSION['dateCurrent'] = $dateCurrent;
	$datetools = new dateTools($dateCurrent,$dateCurrent);
	  							
	$medecinCurrent = isset($_SESSION['inami']) ? $_SESSION['inami'] : "----";
	$_SESSION['medecinCurrent'] = $medecinCurrent;
	
	// redirection
	$_SESSION['redirect'] = "day";
	
	// connexion a la base de donnée
	connexion_DB('poly');
	
	$sql = "SELECT * FROM medecins where inami='".$medecinCurrent."'";
	$sql2 = "SELECT * FROM `".$medecinCurrent."`";
	
	$result = requete_SQL ($sql);
	$result2 = mysql_query ($sql2);
	
	$informationDay = "";
	$informationDay2 = "";
	
	if (!$result2 || mysql_num_rows($result)==0){
		$validMedecin = false;
		if (!$result2 && mysql_num_rows($result)!=0) $nomPrenomMedecin = "Agendas - Journ&eacute;e : Demander &agrave; l'administrateur de cr&eacute;er cet agenda!"; 
		else $nomPrenomMedecin = "Agendas - Journ&eacute;e : Choisir un m&eacute;decin...";
	} else {
		$validMedecin = true;
		$data = mysql_fetch_assoc($result);
		$id = $data['id'];
		$lengthConsult = $data['length_consult'];
		$textComment = $data['textcomment'];
		$nomPrenomMedecin = "Agendas - Journ&eacute;e : ".$data['nom']." ".$data['prenom'];
		$sql = "SELECT * FROM `".$medecinCurrent."` where id = '".$dateCurrent."'";
		$result = requete_SQL ($sql);
		if (mysql_num_rows($result)==1){
			$data = mysql_fetch_assoc($result);
			$informationDay = $data['comment'];
			if ($informationDay!='') $informationDay2 .= "<br/><div class='sidebar labels-red'><h2>".html_entity_decode(htmlentities(stripcslashes($informationDay),ENT_QUOTES))."</h2></div>";
		}
		$informationDay = "<input class='dayInformation' type='text' name='information_day' id='information_day' size='50' maxlength='100' class='txtField' value='".html_entity_decode(htmlentities(stripcslashes($informationDay),ENT_QUOTES))."' autocomplete='off' onfocus='javascript:this.select()'/>";
	}
	deconnexion_DB();
	
	
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Poly - Agenda journalier</title>
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
		get_MENUBAR_END($nom_fichier);
	?>
	
    <div id="top">
		
		<h1>
  			<?=$nomPrenomMedecin?>
		</h1>

		<a class="impression" href="../factures/printagenda.php?mode=portrait"></a>
		<a class='impressionlarge' href="../factures/printagenda.php?mode=landscape"></a>
		
		<div id="etiquette">
		</div>
		
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
   
    					<span>Journ&eacute;e</span> 

    					<a href="./week.php">Semaine</a>

	  					<a href="./planning.php">Horaire</a>
						
				</div>
			
				<div class="ViewPane">

						<div class="navigation-calendar">

							<a class="previousMajor" href="./day.php?dateCurrent=<?=$datetools->changeDATE(-7)?>" onclick="" title="Semaine pr&eacute;c&eacute;dente"></a>
							<a class="previousMinor" href="./day.php?dateCurrent=<?=$datetools->changeDATE(-1)?>" onclick="" title="Jour pr&eacute;c&eacute;dent"></a>
							<a class="nextMajor" href="./day.php?dateCurrent=<?=$datetools->changeDATE(+7)?>" onclick="" title="Semaine suivante"></a>
							<a class="nextMinor" href="./day.php?dateCurrent=<?=$datetools->changeDATE(+1)?>" onclick="" title="Jour suivant"></a>
	  						<h2>
		  						<?=$datetools->transformDATE()?>
		  						<?=$informationDay?>
	  						</h2>

	  					</div>
						
						<table>
							
							<tr>

									
								<td width="4%" height="1000" onclick="javascript:Element.toggle('calendar_morning_bis');">
									<?php
										if ($validMedecin) {
											connexion_DB('poly');
											$sql = "SELECT id, color FROM horaire_presence_".$medecinCurrent." where day = '".get_DAY($dateCurrent)."' and midday='morning' order by ordre";
											$result = requete_SQL ($sql);
											while($data = mysql_fetch_assoc($result)) 	{
												echo "<div id='".$data['id']."' style='height:36px; background-color:".$data['color'].";'>".$data['id']."</div>";
											}
											deconnexion_DB();
										}
										?>
								</td>
								
								<td width="23%" id="calendar_morning">
								</td>

								<td width="23%" height="1000" id="calendar_morning_bis" style="display:none">
								</td>

								<td width="4%" height="1000" onclick="javascript:Element.toggle('calendar_afternoon_bis');">
									<?php
										if ($validMedecin) {
											connexion_DB('poly');
											$sql = "SELECT id, color FROM horaire_presence_".$medecinCurrent." where day = '".get_DAY($dateCurrent)."' and midday='afternoon' order by ordre";
											//echo $sql;
											$result = mysql_query($sql);
											while($data = mysql_fetch_assoc($result)) 	{
												echo "<div id='".$data['id']."' style='height:36px; background-color:".$data['color'].";'>".$data['id']."</div>";
											}
											deconnexion_DB();
										}
										?>
								</td>
									
								<td width="23%" id="calendar_afternoon">
								</td>
								
								<td width="23%" height="1000" id="calendar_afternoon_bis" style="display:none">
								</td>
								

							</tr>
							
						</table>
						<!-- FIN DU CALENDRIER -->

					</div>
					
				<div id="calendarSideBar">
  					<div id="cal1Container"></div>
  					<div id="textContainer"><?=$textComment?></div>
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
						<img src='../images/96x96/appointment.png'>
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
			ResultUrl = "./day.php?dateCurrent="+escape(dateselected);
			window.location.href = ResultUrl;
		};
		YAHOO.namespace("calendar");
		YAHOO.calendar.init = function() {
			YAHOO.calendar.cal1 = new YAHOO.widget.CalendarGroup("cal1","cal1Container", {PAGES:2});
			YAHOO.calendar.cal1.selectEvent.subscribe(mySelectHandler, YAHOO.calendar.cal1, true);
			YAHOO.calendar.cal1.render();
		}
		YAHOO.util.Event.onDOMReady(YAHOO.calendar.init);
	}
	function getconsult() {
		//gestion des events
		Event.observe("calendar_morning", 'click', addConsultationMorning);
		Event.observe("calendar_morning_bis", 'click', addConsultationMorningBis);
		Event.observe("calendar_afternoon", 'click', addConsultationAfternoon);
		Event.observe("calendar_afternoon_bis", 'click', addConsultationAfternoonBis);
	}
	</script>

	<!-- MODAL JS -->	
	<script type="text/javascript" src="../js/prototype/prototype.js"></script>
	<script type="text/javascript" src="../js/scriptaculous/scriptaculous.js"></script>
	<script type="text/javascript" src="../js/window/window.js"></script>
	
	<!-- ALL JS -->
	<script type="text/javascript" src="../js/common.js"></script>
	<script type="text/javascript" src="../js/agenda.js"></script>
	<script type="text/javascript">
		<?php if ($validMedecin) echo "refreshConsultation();";?>
		<?php if ($_SESSION['droit']=='ecriture') echo "getconsult()";?>
	</script>
	
	<script type="text/javascript">  
		var help = new Window('1', {className: "alphacube", title: "Aide en ligne", destroyOnClose:false, top:0, right:0, width:500, height:300});  
  		var notice = new Window('2', {className: "alphacube", title: "Notice", destroyOnClose:false, top:20, right:20, width:500, height:300 });  
		var medecin = new Window('3',{className: "alphacube", title: "Information sur le m&eacute;decin", destroyOnClose:false, top:40, right:40, width:500, height:300});
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
	  	function openDialogConfirm(id,comment) {
  			Dialog.confirm("Vouler vous supprimer ce rendez-vous ?<br> ["+comment+"]", {width:300, okLabel: "OUI", cancelLabel: "Annuler", className: "alphacube", buttonClass: "myButtonClass", id: "myDialogId", cancel:function(win) {return false;}, ok:function(win) {supprime(id); return true;} });
		}
	</script>

	</body>
</html>


