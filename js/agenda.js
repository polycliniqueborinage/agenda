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
var available = null;

var idConsultCurrent= "";

var startConsultCurrent = "";
var endConsultCurrent = "";
var topConsultCurrent = ""; // position du css relative aux autres �lements du tableau
var positionConsultCurrent = ""; // position absolue
var medecinConsultCurrent = "";

var completed =  function(t){

	Element.hide('findPatientForm');
	$('findPatientInput').value = "";
    $('informationPatient').innerHTML = '';
	refreshConsultation();

}

function addConsultationQuick(Yposition,midday) {

	refreshConsultation();
	
	if (midday.indexOf('_') !=-1) temp = midday.substring(0,midday.indexOf('_')); else temp = midday;

	consultLength = parseFloat(document.getElementById('duree').value); // length of consult
	//medecinConsultCurrent = document.getElementById('medecin').value; // medecin
	positionConsultCurrent = (Math.floor((Yposition - 128)/18))*18; // position absolue
	startConsultCurrent = table[temp+positionConsultCurrent]; // heure initiale
	endConsultCurrent = table[temp+(positionConsultCurrent+consultLength)]; // heure finale
	
	new Ajax.Request('../agendas/info_consult.php', {
		method:'get',
		asynchronous:false,
		parameters: {midday: midday, position: positionConsultCurrent, length: consultLength},
		requestHeaders: {Accept: 'application/json'},
  		onSuccess: function(transport, json){
    		available = json.root.available;
    		consultLengthTotal = json.root.consultLenght;
  		}
	});

	topConsultCurrent = (positionConsultCurrent - consultLengthTotal); // Position relative
	
	if(available != "") {
		alert("Emplacement d�j� r�serv�!");
		refreshConsultation();
	} else {
		refreshConsultation();
		// !!!!!!!!! construction du div
		idConsultCurrent = midday+positionConsultCurrent;
		newdiv = document.createElement('div');
		newdiv.setAttribute("id",idConsultCurrent);
		newdiv.setAttribute("class","cellSelection");
		newdiv.setAttribute("style","position: absolue; top: " + topConsultCurrent + "px; height: "+consultLength+"px;");
		newdiv.innerHTML = "<div id=\"selection-start-time\">"+ startConsultCurrent +"</div><div id=\"selection-end-time\">"+ endConsultCurrent +"</div><div id=\"textesubmit\" class=\"quick-create\" type=\"text\" name=\"quick\" size=\"10\">Clic pour encoder la consultation...</div>";
		$('calendar_'+midday).appendChild(newdiv);
	
		// ajout du gestionnaire edit in place
		editorconsult  = new Ajax.InPlaceEditor('textesubmit', '../agendas/add_consult.php?id='+idConsultCurrent+'&start='+startConsultCurrent+'&end='+endConsultCurrent+'&length='+consultLength+'&top='+topConsultCurrent+'&position='+positionConsultCurrent+'&midday='+midday, {onComplete:completed , clickToEditText:"Choisir un patient..", cancelLink:false		  		});
	}
	
}


function addConsultationMorning(event) {
	elementCliquer = Event.element(event);
	Yposition = Event.pointerY(event);
	if (elementCliquer.tagName=='TD') {
		addConsultationQuick(Yposition,'morning');
	}
}


function addConsultationMorningBis(event) {
	elementCliquer = Event.element(event);
	Yposition = Event.pointerY(event);
	if (elementCliquer.tagName=='TD') {
		addConsultationQuick(Yposition,'morning_bis');
	}
}
	
		
function addConsultationAfternoon(event) {
	elementCliquer = Event.element(event);
	Yposition = Event.pointerY(event);
	if (elementCliquer.tagName=='TD') {
		addConsultationQuick(Yposition,'afternoon');
	}
}
	
		
function addConsultationAfternoonBis(event) {
	elementCliquer = Event.element(event);
	Yposition = Event.pointerY(event);
	if (elementCliquer.tagName=='TD') {
		addConsultationQuick(Yposition,'afternoon_bis');
	}
}


function refreshConsultation() {
	new Ajax.Request('../agendas/refresh_calendar.php',
		{
			method:'get',
			parameters: {midday: 'morning'},
			asynchronous:false,
  			onSuccess: function(transport){
		      	$('calendar_morning').innerHTML = transport.responseText;
		    },
		    onFailure: function(){ $('calendar_morning').innerHTML = ('Something went wrong...') }
		});
	new Ajax.Request('../agendas/refresh_calendar.php',
		{
			method:'get',
			parameters: {midday: 'morning_bis'},
			asynchronous:false,
  			onSuccess: function(transport, json){
		      	$('calendar_morning_bis').innerHTML = transport.responseText;
		      	if (transport.responseText.length >20) Element.show('calendar_morning_bis');
		    },
		    onFailure: function(){ $('calendar_morning_bis').innerHTML = ('Something went wrong...') }
		});
	new Ajax.Request('../agendas/refresh_calendar.php',
		{
			method:'get',
			parameters: {midday: 'afternoon'},
			asynchronous:false,
  			onSuccess: function(transport, json){
  				//alert(transport.responseXML);
		      	$('calendar_afternoon').innerHTML = transport.responseText;
		    },
		    onFailure: function(){ $('calendar_afternoon').innerHTML = ('Something went wrong...') }
		});
	new Ajax.Request('../agendas/refresh_calendar.php',
		{
			method:'get',
			parameters: {midday: 'afternoon_bis'},
			asynchronous:false,
  			onSuccess: function(transport, json){
		      	$('calendar_afternoon_bis').innerHTML = transport.responseText;
		      	if (transport.responseText.length >20) Element.show('calendar_afternoon_bis');
		    },
		    onFailure: function(){ $('calendar_afternoon_bis').innerHTML = ('Something went wrong...') }
		});
	idConsultCurrent= "";
}


function changeDropdownMedecin(page, pseudo){
	ResultUrl = "./"+page+".php?medecinCurrent="+pseudo;
	parent.window.location.href = ResultUrl;
}


function changeSpecialite(page, pseudo){
	new Ajax.Updater(
		'listmedecinoption',
		'../agendas/drop_down_medecin.php',
		{
			method: 'get',
			parameters: {pseudo: pseudo, page:page}
		}
	);
}


function supprime(id) {
	//var is_confirmed = confirm("Voulez vous supprimer cette consultation ?");
	if (id != '') {
		new Ajax.Request('../agendas/supprime_consultation.php',
		{
			method:'get',
			parameters: {id: escape(id)},
			asynchronous:false,
			onSuccess: function(transport){
				refreshConsultation();
	    	},
		    onFailure: function(){ alert('Something went wrong...'); }
		});
	 }
}


function etiquettePrint(id) {
  	if(id != '') {
		var iframe = "<iframe name='' SRC='../etiquettes/print_rendez.php?id="+ id +"' scrolling='no' height='1' width='1' FRAMEBORDER='no'></iframe>";
		$('etiquette').innerHTML = iframe;
	}
}


function changeColor(midday,day,ordre) {
	var id = midday + "-"+day+"-"+ordre;
	var changeme = document.getElementById(id);
	var style = changeme.getAttribute("style");
	new Ajax.Request('../agendas/change_color.php',
	{
			method:'get',
			parameters: {day: day, ordre: ordre, style: style, midday: midday }, 
			asynchronous:false,
			onSuccess: function(transport){ color=transport.responseText ; changeme.setAttribute("style",color);},
		    onFailure: function(){ alert('Something went wrong...'); }
	});
}


function informationChangeValue(information) {
	new Ajax.Request('../agendas/information_day_change_valeur.php',
	{
			method:'get',
			parameters: {information: htmlentities(information)}, 
			asynchronous:false,
			onSuccess: function(transport, json){
	    		content = json.root.content;
			},
		    onFailure: function(){ alert('Something went wrong...'); }
	});
}