var DATE_SEPARATOR = '/';
n=navigator;
nua=n.userAgent;

var table = new Array();
table["morning0"] = "7H00";
table["morning18"] = "7H05";
table["morning36"] = "7H10";
table["morning54"] = "7H15";
table["morning72"] = "7H20";
table["morning90"] = "7H25";
table["morning108"] = "7H30";
table["morning126"] = "7H35";
table["morning144"] = "7H40";
table["morning162"] = "7H45";
table["morning180"] = "7H50";
table["morning198"] = "7H55";

table["morning216"] = "8H00";
table["morning234"] = "8H05";
table["morning252"] = "8H10";
table["morning270"] = "8H15";
table["morning288"] = "8H20";
table["morning306"] = "8H25";
table["morning324"] = "8H30";
table["morning342"] = "8H35";
table["morning360"] = "8H40";
table["morning378"] = "8H45";
table["morning396"] = "8H50";
table["morning414"] = "8H55";

table["morning432"] = "9H00";
table["morning450"] = "9H05";
table["morning468"] = "9H10";
table["morning486"] = "9H15";
table["morning504"] = "9H20";
table["morning522"] = "9H25";
table["morning540"] = "9H30";
table["morning558"] = "9H35";
table["morning576"] = "9H40";
table["morning594"] = "9H45";
table["morning612"] = "9H50";
table["morning630"] = "9H55";

table["morning648"] = "10H00";
table["morning666"] = "10H05";
table["morning684"] = "10H10";
table["morning702"] = "10H15";
table["morning720"] = "10H20";
table["morning738"] = "10H25";
table["morning756"] = "10H30";
table["morning774"] = "10H35";
table["morning792"] = "10H40";
table["morning810"] = "10H45";
table["morning828"] = "10H50";
table["morning846"] = "10H55";

table["morning864"] = "11H00";
table["morning882"] = "11H05";
table["morning900"] = "11H10";
table["morning918"] = "11H15";
table["morning936"] = "11H20";
table["morning954"] = "11H25";
table["morning972"] = "11H30";
table["morning990"] = "11H35";
table["morning1008"] = "11H40";
table["morning1026"] = "11H45";
table["morning1044"] = "11H50";
table["morning1062"] = "11H55";

table["morning1080"] = "12H00";
table["morning1098"] = "12H05";
table["morning1116"] = "12H10";
table["morning1134"] = "12H15";
table["morning1152"] = "12H20";
table["morning1170"] = "12H25";
table["morning1188"] = "12H30";
table["morning1206"] = "12H35";
table["morning1224"] = "12H40";
table["morning1242"] = "12H45";
table["morning1260"] = "12H50";
table["morning1278"] = "12H55";
table["morning1296"] = "13H00";

table["afternoon0"] = "13H00";
table["afternoon18"] = "13H05";
table["afternoon36"] = "13H10";
table["afternoon54"] = "13H15";
table["afternoon72"] = "13H20";
table["afternoon90"] = "13H25";
table["afternoon108"] = "13H30";
table["afternoon126"] = "13H35";
table["afternoon144"] = "13H40";
table["afternoon162"] = "13H45";
table["afternoon180"] = "13H50";
table["afternoon198"] = "13H55";

table["afternoon216"] = "14H00";
table["afternoon234"] = "14H05";
table["afternoon252"] = "14H10";
table["afternoon270"] = "14H15";
table["afternoon288"] = "14H20";
table["afternoon306"] = "14H25";
table["afternoon324"] = "14H30";
table["afternoon342"] = "14H35";
table["afternoon360"] = "14H40";
table["afternoon378"] = "14H45";
table["afternoon396"] = "14H50";
table["afternoon414"] = "14H55";

table["afternoon432"] = "15H00";
table["afternoon450"] = "15H05";
table["afternoon468"] = "15H10";
table["afternoon486"] = "15H15";
table["afternoon504"] = "15H20";
table["afternoon522"] = "15H25";
table["afternoon540"] = "15H30";
table["afternoon558"] = "15H35";
table["afternoon576"] = "15H40";
table["afternoon594"] = "15H45";
table["afternoon612"] = "15H50";
table["afternoon630"] = "15H55";

table["afternoon648"] = "16H00";
table["afternoon666"] = "16H05";
table["afternoon684"] = "16H10";
table["afternoon702"] = "16H15";
table["afternoon720"] = "16H20";
table["afternoon738"] = "16H25";
table["afternoon756"] = "16H30";
table["afternoon774"] = "16H35";
table["afternoon792"] = "16H40";
table["afternoon810"] = "16H45";
table["afternoon828"] = "16H50";
table["afternoon846"] = "16H55";

table["afternoon864"] = "17H00";
table["afternoon882"] = "17H05";
table["afternoon900"] = "17H10";
table["afternoon918"] = "17H15";
table["afternoon936"] = "17H20";
table["afternoon954"] = "17H25";
table["afternoon972"] = "17H30";
table["afternoon990"] = "17H35";
table["afternoon1008"] = "17H40";
table["afternoon1026"] = "17H45";
table["afternoon1044"] = "17H50";
table["afternoon1062"] = "17H55";

table["afternoon1080"] = "18H00";
table["afternoon1098"] = "18H05";
table["afternoon1116"] = "18H10";
table["afternoon1134"] = "18H15";
table["afternoon1152"] = "18H20";
table["afternoon1170"] = "18H25";
table["afternoon1188"] = "18H30";
table["afternoon1206"] = "18H35";
table["afternoon1224"] = "18H40";
table["afternoon1242"] = "18H45";
table["afternoon1260"] = "18H50";
table["afternoon1278"] = "18H55";
table["afternoon1296"] = "18H00";

var editorconsult;
var consultLength = 0;
var consultLengthTotal = 0;

var idConsultCurrent= "";
var idConsultMorningCurrent = "";
var idConsultAfternoonCurrent = "";

var startConsultCurrent = "";
var endConsultCurrent = "";
var topConsultCurrent = ""; // position du css relative aux autres élements du tableau
var positionConsultCurrent = ""; // position absolue

var medecinConsultCurrent = "";

var container_calendar_afternoon="";
var container_calendar_morning="";

var completedmorning =  function(t){
	idConsultCurrent = document.getElementById(idConsultMorningCurrent);
	contentdiv = idConsultCurrent.innerHTML;
	//alert(contentdiv);
	if (contentdiv.indexOf("patient inconnu")!=-1) {
   		texte = file('../libphp/add_consult_newpatient.php');
	} 
	if (contentdiv.indexOf("trop de patients")!=-1) {
 		texte = file('../libphp/add_consult_newpatient.php');
	}
	Element.hide('addLabelFormPatient');
	document.forms['createLabelFormPatient'].findPatientInput.value = "";
    document.getElementById('information_patient').innerHTML = '';
	refreshConsultation();

}

var completedafternoon =  function(t){
	idConsultCurrent = document.getElementById(idConsultAfternoonCurrent);
	contentdiv = idConsultCurrent.innerHTML;
	if (contentdiv.indexOf("patient inconnu")!=-1) {
   		texte = file('../libphp/add_consult_newpatient.php');
	} 
	if (contentdiv.indexOf("trop de patients")!=-1) {
   		texte = file('../libphp/add_consult_newpatient.php');
	}
	Element.hide('addLabelFormPatient');
	document.forms['createLabelFormPatient'].findPatientInput.value = "";
    document.getElementById('information_patient').innerHTML = '';
	refreshConsultation();
}

function addConsultationMorningQuick(Yposition) {
	
	consultLength = parseFloat(document.getElementById('duree').value); // length of consult
	medecinConsultCurrent = document.getElementById('medecin').value; // medecin
	positionConsultCurrent = (Math.floor((Yposition - 133)/18))*18; // position absolue
	startConsultCurrent = table["morning"+positionConsultCurrent]; // heure initiale
	endConsultCurrent = table["morning"+(positionConsultCurrent+consultLength)]; // heure finale
	consultLengthTotal = parseFloat(file('../libphp/lengthconsult.php?midday=morning')); // Duree de toute les consultations
	topConsultCurrent = (positionConsultCurrent - consultLengthTotal); // Position relative

	container_calendar_morning = document.getElementById('calendar_morning');
	container_calendar_afternoon = document.getElementById('calendar_afternoon');
		
	// remove the current element if exist
	if(idConsultMorningCurrent != "") {
		olddiv = document.getElementById(idConsultMorningCurrent);
		container_calendar_morning.removeChild(olddiv);
		idConsultMorningCurrent = "";
	}

	if(idConsultAfternoonCurrent != "") {
		olddiv = document.getElementById(idConsultAfternoonCurrent);
		container_calendar_afternoon.removeChild(olddiv);
		idConsultAfternoonCurrent = "";
	}
	
	var available = (file('../libphp/availableconsult.php?midday=morning&position='+positionConsultCurrent+'&length='+consultLength));
	if(available != "") {
		alert("Emplacement déjà réservé!");
		refreshConsultation();
	} else {
		refreshConsultation();
		// !!!!!!!!! construction du div
		idConsultMorningCurrent = "morning_"+positionConsultCurrent;
		newdiv = document.createElement('div');
		newdiv.setAttribute("id",idConsultMorningCurrent);
		newdiv.setAttribute("class","cellSelection");
		newdiv.setAttribute("style","position: absolue; top: " + topConsultCurrent + "px; height: "+consultLength+"px;");
		newdiv.innerHTML = "<div id=\"selection-start-time\">"+ startConsultCurrent +"</div><div id=\"selection-end-time\">"+ endConsultCurrent +"</div><div id=\"textesubmit\" class=\"quick-create\" type=\"text\" name=\"quick\" size=\"10\">Ajout d'une consultation...</div>";
		container_calendar_morning.appendChild(newdiv);
	
		// ajout du gestionnaire edit in place
		editorconsult  = new Ajax.InPlaceEditor('textesubmit', '../libphp/add_consult.php?id='+idConsultMorningCurrent+'&start='+startConsultCurrent+'&end='+endConsultCurrent+'&length='+consultLength+'&top='+topConsultCurrent+'&position='+positionConsultCurrent+'&midday=morning', {onComplete:completedmorning , clickToEditText:"Choisir un patient..", cancelLink:false			  		});
	}
}

function addConsultationAfternoonQuick(Yposition) {

	consultLength = parseFloat(document.getElementById('duree').value);
	medecinConsultCurrent = document.getElementById('medecin').value;
	positionConsultCurrent = (Math.floor((Yposition - 133)/18))*18;
	startConsultCurrent = table["afternoon"+positionConsultCurrent];
	endConsultCurrent = table["afternoon"+(positionConsultCurrent+consultLength)];
	consultLengthTotal = parseFloat(file('../libphp/lengthconsult.php?midday=afternoon'));
	topConsultCurrent = (positionConsultCurrent - consultLengthTotal);
	
	container_calendar_morning = document.getElementById('calendar_morning');
	container_calendar_afternoon = document.getElementById('calendar_afternoon');
		
	// remove the current element if exist
	if(idConsultMorningCurrent != "") {
		olddiv = document.getElementById(idConsultMorningCurrent);
		container_calendar_morning.removeChild(olddiv);
		idConsultMorningCurrent = "";
	}

	if(idConsultAfternoonCurrent != "") {
		olddiv = document.getElementById(idConsultAfternoonCurrent);
		container_calendar_afternoon.removeChild(olddiv);
		idConsultAfternoonCurrent = "";
	}

	var available = (file('../libphp/availableconsult.php?midday=afternoon&position='+positionConsultCurrent+'&length='+consultLength));
	if(available != "") {
		alert("Emplacement déjà réservé!");
		refreshConsultation();
	} else {
		refreshConsultation();
		// !!!!!!!!! construction du div
		idConsultAfternoonCurrent = "afternoon_"+positionConsultCurrent;
		newdiv = document.createElement('div');
		newdiv.setAttribute("id",idConsultAfternoonCurrent);
		newdiv.setAttribute("class","cellSelection");
		newdiv.setAttribute("style","position: absolue; top: " + topConsultCurrent + "px; height: "+consultLength+"px;");
		newdiv.innerHTML = "<div id=\"selection-start-time\">"+ startConsultCurrent +"</div><div id=\"selection-end-time\">"+ endConsultCurrent +"</div><div id=\"textesubmit\" class=\"quick-create\" type=\"text\" name=\"quick\" size=\"10\">Ajout d'une consultation...</div>";
		container_calendar_afternoon.appendChild(newdiv);
		// ajout du gestionnaire edit in place
		editorconsult  = new Ajax.InPlaceEditor('textesubmit', '../libphp/add_consult.php?id='+idConsultAfternoonCurrent+'&start='+startConsultCurrent+'&end='+endConsultCurrent+'&length='+consultLength+'&top='+topConsultCurrent+'&position='+positionConsultCurrent+'&midday=afternoon', {onComplete:completedafternoon , clickToEditText:"Choisir un patient..", cancelLink:false  });
	}
}

function addConsultationMorning(event) {
	elementCliquer = Event.element(event);
	Yposition = Event.pointerY(event);
	if (elementCliquer.tagName=='TD') {
		addConsultationMorningQuick(Yposition);
	}
}
		
function addConsultationAfternoon(event) {
	elementCliquer = Event.element(event);
	Yposition = Event.pointerY(event);
	if (elementCliquer.tagName=='TD') {
		addConsultationAfternoonQuick(Yposition);
	}
}

function refreshConsultation() {
	texte = file('../libphp/refresh_calendar.php?midday=morning');
	document.getElementById('calendar_morning').innerHTML = texte;
	texte = file('../libphp/refresh_calendar.php?midday=afternoon');
	document.getElementById('calendar_afternoon').innerHTML = texte;
	idConsultMorningCurrent = "";
	idConsultAfternoonCurrent = "";
	idConsultCurrent= "";
}

function change_medecin_planning(pseudo){
	ResultUrl = "./planning.php?medecinCurrent="+pseudo;
	parent.window.location.href = ResultUrl;
}


function change_medecin_day(pseudo){
	ResultUrl = "./day.php?medecinCurrent="+pseudo;
	parent.window.location.href = ResultUrl;
}

function change_medecin_week(pseudo){
	
	ResultUrl = "./week.php?medecinCurrent="+pseudo;
	parent.window.location.href = ResultUrl;

}

function change_specialite(pseudo){
	texte = file('../libphp/dropdownmedecin.php?pseudo='+escape(pseudo))
    document.getElementById('listmedecinoption').innerHTML = texte;
}

function supprime(id) {
	var is_confirmed = confirm("Voulez vous supprimer cette consultation ?");
	if (is_confirmed && id != '') {
    	texte = file('../libphp/supprime_consultation.php?id='+escape(id));
		refreshConsultation();
	 }
}


//function print_rendez(id) {
//	alert("lkj");
	//w = window.open(('../etiquettes/print_rendez.php?id='+escape(id)), "popup", "height=400,width=400,top=400,left=600,menubar='no',directories'no',toolbar='no',status='no',location='no',scrollbars='no'");
	//timerID = self.setTimeout("StartTheTimer()", delay)
//}
function impression(id) {
	var is_confirmed = confirm("Voulez vous supprimer cette consultation ?");
	if (is_confirmed && id != '') {
    	texte = file('../libphp/supprime_consultation.php?id='+escape(id));
		refreshConsultation();
	 }
}


function infoPatient(id, comment) {
	texte = file('../libphp/info_patient.php?id='+escape(id)+'&comment='+escape(comment));
	return texte;
}

function setInput(input,value) {
	var inputtext = replaceChar(input.value, ' ', '');
	if (inputtext==""){
		input.value=value;
	}
}

// AJOUT D UN PATIENT A PARTIR DE L INTERFACE AGENDA
function save_patient() {
	var nomPatient = window.document.forms["createPatientForm"].nomPatientInput.value;
	var prenomPatient = window.document.forms["createPatientForm"].prenomPatientInput.value;
	var dateNaissance = window.document.forms["createPatientForm"].datenaissPatientInput.value;
	if (nomPatient != 'Nom du patient' && nomPatient != '' && prenomPatient != '' && prenomPatient != 'Prenom du patient' && dateNaissance != 'Date de naissance' && dateNaissance.length >= 8) {
		texte = file('../libphp/quick_add_patient.php?nom='+escape(nomPatient)+'&prenom='+escape(prenomPatient)+'&date_naissance='+escape(dateNaissance));
		texte = html_entities_decode(texte);
		alert(texte);
		window.document.forms["createPatientForm"].nomPatientInput.value='Nom du patient';
		window.document.forms["createPatientForm"].prenomPatientInput.value='Prenom du patient';
		window.document.forms["createPatientForm"].datenaissPatientInput.value='Date de naissance';
		Element.toggle('addPatientForm');
	} else {
		alert('Complétez correctement les champs nom, prénom et âge du patient.')
	}
}

// detect browser that not supports inserting of karakter in input-fields
function isInsertSupported() {
	return !((isSafari() && (parseFloat(versionNumber) >= 312,5)) || isKonquerer());
}

function isSafari() {
	return (nua.indexOf('Safari')!=-1);
}

function isKonquerer() {
	return (!isSafari() && (nua.indexOf('Konqueror')!=-1) )
}

function replaceChar(s, o, n) {
	var newString = "";
	for(i=0; i<s.length; i++) {
		if(s.charAt(i) == o)
			newString += n;
		else
			newString += s.charAt(i);
	}
	return newString;
}

function checkDate(o, oldValue, errorId) {
	var inDate = o.value;

	inDate = replaceChar(inDate, '.', DATE_SEPARATOR);
	inDate = replaceChar(inDate, '-', DATE_SEPARATOR);
	
	var aDate = inDate.split(DATE_SEPARATOR);
	
	// check max length (units & decimals)
	if(aDate[0].length > 3 || (aDate[0].length > 2 && !isInsertSupported())){
		o.value = oldValue;
		return oldValue;
	}
	
	for(i=0; i<inDate.length; i++) {
		var c = inDate.charAt(i);
		if (((c < '0' || c > '9') && c != DATE_SEPARATOR)){
			o.value = oldValue;
			return oldValue;
		}
	}

	var aDateTemp;
	for(i=0; i<aDate.length; i++) {
		if(i == 0) {
			if(parseInt(aDate[i],10) > 31 || aDate[i].length == 3) {
				if (isInsertSupported()){
					aDateTemp = aDate[i].charAt(aDate[i].length-1);
					aDate[i] = aDate[i].substring(0,aDate[i].length-1).concat(DATE_SEPARATOR);
					inDate = aDate[i].concat(aDateTemp);
				}else
					inDate = oldValue;
				break;
			}
		}
		if(i == 1) {
			if((aDate[i].length > 2) && !isInsertSupported()) {
				o.value = oldValue;
				return oldValue;
			}
			if(parseInt(aDate[i],10) > 12 && parseInt(aDate[i].substring(0,aDate[i].length-1),10) > 12){
				inDate = oldValue;
				break;
			}else if((parseInt(aDate[i],10) > 12 || aDate[i].length == 3) && isInsertSupported()) {
				aDateTemp = aDate[i].charAt(aDate[i].length-1);
				aDate[i] = aDate[i].substring(0,aDate[i].length-1).concat(DATE_SEPARATOR);
				inDate = aDate[0].concat(DATE_SEPARATOR.concat(aDate[i].concat(aDateTemp)));
				break;
			}
		}
		if(i == 2) {
			if(parseInt(aDate[i],10) > 2100) {
				inDate = oldValue;
				break;
			}
		}
	}
	
	if (!isInsertSupported()) {
		if (aDate.length >= 1 && parseInt(aDate[1],10) > 12) {
			inDate = oldValue;		
		} 
		if (aDate.length >= 2 && parseInt(aDate[2],10) > 2100) {
			inDate = oldValue;
		} 
	}
	
	if(inDate != o.value) {
		o.value = inDate;
		if(errorId != "" && inDate != "") showError(errorId, true);
	}
	return inDate;
}

function changecolormorning(day,ordre) {
	var id = "morning-"+day+"-"+ordre;
	var changeme = document.getElementById(id);
	var style = changeme.getAttribute("style");
	none = file('../libphp/changecolor.php?day='+escape(day)+'&ordre='+escape(ordre)+'&style='+escape(style)+'&midday='+escape("morning"));
	var style = changeme.setAttribute("style",none);
}

function changecolorafternoon(day,ordre) {
	var id = "afternoon-"+day+"-"+ordre;
	var changeme = document.getElementById(id);
	var style = changeme.getAttribute("style");
	none = file('../libphp/changecolor.php?day='+escape(day)+'&ordre='+escape(ordre)+'&style='+escape(style)+'&midday='+escape("afternoon"));
	var style = changeme.setAttribute("style",none);
}