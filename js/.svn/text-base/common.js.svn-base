// AJOUT D UN PATIENT A PARTIR DE L INTERFACE AGENDA
function setInput(input,value) {
	var inputtext = replaceChar(input.value, ' ', '');
	if (inputtext==""){
		input.value=value;
	}
}


function savePatient() {
	var lastNamePatient = htmlentities($('createLastNamePatientInput').value);
	var firstNamePatient = htmlentities($('createFirstNamePatientInput').value);
	var birthdayPatient = $('createBirthdayPatientInput').value;
	var phoneNumberPatient = htmlentities($('createPhoneNumberInput').value);
	if (phoneNumberPatient == 'T&eacute;l&eacute;phone') phoneNumberPatient = "";
	if (lastNamePatient != '' && lastNamePatient != 'Nom du patient' && firstNamePatient != '' && firstNamePatient != 'Pr&eacute;nom du patient' && birthdayPatient.length >= 8 && birthdayPatient.length !='Date de naissance') {
		new Ajax.Request('../agendas/quick_add_patient.php',
		{
			method:'post',
			parameters: {lastNamePatient: lastNamePatient, firstNamePatient: firstNamePatient, birthdayPatient: birthdayPatient, phoneNumberPatient : phoneNumberPatient},
			requestHeaders: {Accept: 'application/json'},
			asynchronous:false,
  			onSuccess: function(transport, json){
				info = json.root.info;
				info = info.replace(/\\/g,'');
    			Dialog.alert("<table><tr><td><img src='../images/96x96/info.png'></td><td>"+info+"</td></tr></table>", {width:400, height:200, okLabel: "OK", className: "alphacube", buttonClass: "myButtonClass", id: "myDialogId", ok:function(win) {return true;} });
 		    },
		    onFailure:  function(){ alert("failure");} //Dialog.alert(comment, {width:300, okLabel: "OUI", cancelLabel: "Annuler", className: "alphacube", buttonClass: "myButtonClass", id: "myDialogId", ok:function(win) {return true;} });
		});
		$('createLastNamePatientInput').value='Nom du patient';
		$('createFirstNamePatientInput').value='PrÈnom du patient';
		$('createBirthdayPatientInput').value='Date de naissance';
		$('createPhoneNumberInput').value='TÈlÈphone';
		Element.toggle('createPatientForm');
		$('findPatientInput').value = html_entity_decode(lastNamePatient+' '+firstNamePatient);
		patient_recherche_simple(html_entity_decode((lastNamePatient+' '+firstNamePatient)));
		Element.toggle('findPatientForm');
	} else {
   		Dialog.alert("<table><tr><td><img src='../images/96x96/warning.png'></td><td>ComplÈtez correctement les champs nom, prÈnom et ‚ge du patient.</td></tr></table>", {width:400, okLabel: "OK", className: "alphacube", buttonClass: "myButtonClass", id: "myDialogId", ok:function(win) {return true;} });
	}
}

// recherche d'un medecin 
function medecin_recherche_simple(pseudo) {
	if(trim(pseudo) != '') {
		$('informationMedecin').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
		new Ajax.Request('../lib/medecin_recherche_simple.php',
		{
			method:'get',
			parameters: {pseudo: htmlentities(pseudo)},
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
    			content = json.root.content;
				$('informationMedecin').innerHTML = content;
		    },
		    onFailure: function(){ $('informationMedecin').innerHTML = ('Erreur... contact targoo@gmail.com') }
		});
	} else {
	    $('informationMedecin').innerHTML = '';
	}
}

function medecin_recherche_list(id) {
	if(id != '') {
		$('informationMedecin').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
		new Ajax.Request('../lib/medecin_recherche_simple.php',
		{
			method:'get',
			parameters: {id: id},
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
    			content = json.root.content;
    			title = json.root.title;
				$('informationMedecin').innerHTML = content;
				$('findMedecinInput').value = html_entity_decode(title);
		    },
		    onFailure: function(){ $('informationMedecin').innerHTML = ('Erreur... contact targoo@gmail.com') }
		});
	} else {
		$('informationMedecin').innerHTML = '';
		$('findMedecinInput').value = '';
	}
}

// recherche d'un patient
function patient_recherche_simple(pseudo) {
	if(trim(pseudo) != '') {
		new Ajax.Request('../lib/patient_recherche_simple.php',
		{
			method:'get',
			parameters: {pseudo: htmlentities(pseudo)},
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
    			content = json.root.content;
    			number = json.root.number;
		   		if (number > 1) {
					try{
						document.getElementById('contentuserbox').value='';
					} catch(e){};
				}
				$('informationPatient').innerHTML = content;
		    },
		    onFailure: function(){ $('informationPatient').innerHTML = ('Erreur... contact targoo@gmail.com') }
		});
	} else {
	    $('informationPatient').innerHTML = '';
	}
}

function patient_recherche_list(id) {
	if(id != '') {
		new Ajax.Request('../lib/patient_recherche_simple.php',
		{
			method:'get',
			parameters: {id: id},
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
    			content = json.root.content;
    			number = json.root.number;
    			title = json.root.title;
    			$('findPatientInput').value = html_entity_decode(title);
				$('informationPatient').innerHTML = content;
				if (number == 1) {
					try{
						$('contentuserbox').value=id;
						$('usernamebox').value=title;
						$('contenteditbox').value=html_entity_decode(title);
						$('contenteditbox').focus();
					} catch(e){};
				}
		    },
		    onFailure: function(){ $('informationPatient').innerHTML = ('Erreur... contact targoo@gmail.com') }
		});
	} else {
	    $('informationPatient').innerHTML = '';
	}
}

// recherche d'une mutuelle 
function mutuelle_recherche_simple(pseudo) {
	if(trim(pseudo) != '') {
		$('informationMutuelle').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
		new Ajax.Request('../lib/mutuelle_recherche_simple.php',
		{
			method:'get',
			parameters: {pseudo: htmlentities(pseudo)},
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
    			content = json.root.content;
				$('informationMutuelle').innerHTML = content;
		    },
		    onFailure: function(){ $('informationMutuelle').innerHTML = ('Erreur... contact targoo@gmail.com') }
		});
	 } else {
	    $('informationMutuelle').innerHTML = '';
	}
}
function mutuelle_recherche_list(id) {
	if(id != '') {
		$('informationMutuelle').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
		new Ajax.Request('../lib/mutuelle_recherche_simple.php',
		{
			method:'get',
			parameters: {id: id},
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
    			title = json.root.title;
    			content = json.root.content;
				$('informationMutuelle').innerHTML = content;
				$('findMutuelleInput').value = title;
		    },
		    onFailure: function(){ $('informationMutuelle').innerHTML = ('Erreur... contact targoo@gmail.com') }
		});
	 } else {
	    $('informationMutuelle').innerHTML = '';
		$('findMutuelleInput').value = '';
	}
}

// recherche d'un cecodi 
function cecodi_recherche_simple(pseudo) {
	if(trim(pseudo) != '') {
		$('informationCecodi').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
		new Ajax.Request('../lib/cecodi_recherche_simple.php',
		{
			method:'get',
			parameters: {pseudo: htmlentities(pseudo)},
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
    			content = json.root.content;
				$('informationCecodi').innerHTML = content;
		    },
		    onFailure: function(){ $('informationCecodi').innerHTML = ('Erreur... contact targoo@gmail.com') }
		});
	 } else {
	    $('informationCecodi').innerHTML = '';
	}
}
function cecodi_recherche_list(id) {
	if(id != '') {
		$('informationCecodi').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
		new Ajax.Request('../lib/cecodi_recherche_simple.php',
		{
			method:'get',
			parameters: {id: id},
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
    			title = json.root.title;
    			content = json.root.content;
				$('informationCecodi').innerHTML = content;
				$('findCecodiInput').value = title;
		    },
		    onFailure: function(){ $('informationCecodi').innerHTML = ('Erreur... contact targoo@gmail.com') }
		});
	 } else {
	    $('informationCecodi').innerHTML = '';
		$('findCecodiInput').value = '';
	}
}


// recherche d'un acte 
function acte_recherche_simple(pseudo) {
	if(trim(pseudo) != '') {
		$('informationActe').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
		new Ajax.Request('../lib/acte_recherche_simple.php',
		{
			method:'get',
			parameters: {pseudo: htmlentities(pseudo)},
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
    			content = json.root.content;
				$('informationActe').innerHTML = content;
		    },
		    onFailure: function(){ $('informationActe').innerHTML = ('Erreur... contact targoo@gmail.com') }
		});
	 } else {
	    $('informationActe').innerHTML = '';
	}
}
function acte_recherche_list(id) {
	if(id != '') {
		$('informationActe').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
		new Ajax.Request('../lib/acte_recherche_simple.php',
		{
			method:'get',
			parameters: {id: id},
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
    			title = json.root.title;
    			content = json.root.content;
				$('informationActe').innerHTML = content;
				$('findActeInput').value = title;
		    },
		    onFailure: function(){ $('informationActe').innerHTML = ('Erreur... contact targoo@gmail.com') }
		});
	 } else {
	    $('informationActe').innerHTML = '';
		$('findActeInput').value = '';
	}
}


// modif champs modal pour le patient
function modif_champ_modal(id, champs, valeur) {
	//$('informationActe').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
	new Ajax.Request('../lib/patient_modification.php',
		{
			method:'get',
			parameters: {id: id , champs : champs, valeur : valeur},
  			onSuccess: function(transport){
				$('modificationmodal').innerHTML = transport.responseText;
		    },
		    onFailure: function(){ $('modificationmodal').innerHTML = ('Erreur... contact targoo@gmail.com') }
		});
}


/*hide and show*/
function hideSidebars(){
  Element.addClassName(document.body, 'hide-sidebars');
  Element.addClassName('calendar-owner-display', 'hide-sidebars');
  window.setTimeout(function(){
    //if IE
    if(document.all) {
      var cal = $('tab_panel');
      Element.hide(cal);
      Element.show(cal);
    }
  },10);
}

function showSidebars(){
  Element.removeClassName(document.body, 'hide-sidebars');
  Element.removeClassName('calendar-owner-display', 'hide-sidebars');
  window.setTimeout(function(){
    //if IE
    if(document.all) {
      var cal = $('tab_panel');
      Element.hide(cal);
      Element.show(cal);
    }
  }, 10);
}

function toggleSidebars(){
	var newdiv = document.getElementById('body');
	if (newdiv.getAttribute("class")=='hide-sidebars' ) {
		newdiv.setAttribute("class",'');
	} else {
		newdiv.setAttribute("class",'hide-sidebars');
	}
}

function switchGeneralInfo(id) {
	// clic sur general
	if (id == 'general') {
		var	currentdiv = document.getElementById('sec_tab_general');
		currentdiv.setAttribute("class","nodelete current");
		var	currentdiv = document.getElementById('sec_tab_info');
		currentdiv.setAttribute("class","nodelete");
		Element.hide('information');
		Element.show('general');
	} else {
		var	currentdiv = document.getElementById('sec_tab_general');
		currentdiv.setAttribute("class","nodelete");
		var	currentdiv = document.getElementById('sec_tab_info');
		currentdiv.setAttribute("class","nodelete current");
		Element.hide('general');
		Element.show('information');
	}
}

function changeClassBox(id,before,after) {
	var newdiv = document.getElementById(id);
	if (newdiv.getAttribute("class")==before ) {
		newdiv.setAttribute("class",after);
	} else {
		newdiv.setAttribute("class",before);
	}

}


/*CONVERTION*/

function trim(str) {
	return str.replace(/ /g, "");
}


//Encode une chaÓne
function htmlentities(texte) {
	texte = texte.replace(/"/g,'&quot;'); // 34 22
	texte = texte.replace(/&/g,'&amp;'); // 38 26
	//texte = texte.replace(/\'/g,'&#39;'); // 39 27
	texte = texte.replace(/</g,'&lt;'); // 60 3C
	texte = texte.replace(/>/g,'&gt;'); // 62 3E
	texte = texte.replace(/\^/g,'&circ;'); // 94 5E
	texte = texte.replace(/ù/g,'&#357;'); // 157 9D
	texte = texte.replace(/°/g,'&iexcl;'); // 161 A1
	texte = texte.replace(/¢/g,'&cent;'); // 162 A2
	texte = texte.replace(/£/g,'&pound;'); // 163 A3
	//texte = texte.replace(/ /g,'&curren;'); // 164 A4
	texte = texte.replace(/•/g,'&yen;'); // 165 A5
	texte = texte.replace(/¶/g,'&brvbar;'); // 166 A6
	texte = texte.replace(/ß/g,'&sect;'); // 167 A7
	texte = texte.replace(/®/g,'&uml;'); // 168 A8
	texte = texte.replace(/©/g,'&copy;'); // 169 A9
	texte = texte.replace(/™/g,'&ordf;'); // 170 AA
	texte = texte.replace(/´/g,'&laquo;'); // 171 AB
	texte = texte.replace(/¨/g,'&not;'); // 172 AC
	texte = texte.replace(/≠/g,'&shy;'); // 173 AD
	texte = texte.replace(/Æ/g,'&reg;'); // 174 AE
	texte = texte.replace(/Ø/g,'&macr;'); // 175 AF
	texte = texte.replace(/∞/g,'&deg;'); // 176 B0
	texte = texte.replace(/±/g,'&plusmn;'); // 177 B1
	texte = texte.replace(/≤/g,'&sup2;'); // 178 B2
	texte = texte.replace(/≥/g,'&sup3;'); // 179 B3
	texte = texte.replace(/¥/g,'&acute;'); // 180 B4
	texte = texte.replace(/µ/g,'&micro;'); // 181 B5
	texte = texte.replace(/∂/g,'&para'); // 182 B6
	texte = texte.replace(/∑/g,'&middot;'); // 183 B7
	texte = texte.replace(/∏/g,'&cedil;'); // 184 B8
	texte = texte.replace(/π/g,'&sup1;'); // 185 B9
	texte = texte.replace(/∫/g,'&ordm;'); // 186 BA
	texte = texte.replace(/ª/g,'&raquo;'); // 187 BB
	texte = texte.replace(/º/g,'&frac14;'); // 188 BC
	texte = texte.replace(/Ω/g,'&frac12;'); // 189 BD
	texte = texte.replace(/æ/g,'&frac34;'); // 190 BE
	texte = texte.replace(/ø/g,'&iquest;'); // 191 BF
	texte = texte.replace(/¿/g,'&Agrave;'); // 192 C0
	texte = texte.replace(/¡/g,'&Aacute;'); // 193 C1
	texte = texte.replace(/¬/g,'&Acirc;'); // 194 C2
	texte = texte.replace(/√/g,'&Atilde;'); // 195 C3
	texte = texte.replace(/ƒ/g,'&Auml;'); // 196 C4
	texte = texte.replace(/≈/g,'&Aring;'); // 197 C5
	texte = texte.replace(/∆/g,'&AElig;'); // 198 C6
	texte = texte.replace(/«/g,'&Ccedil;'); // 199 C7
	texte = texte.replace(/»/g,'&Egrave;'); // 200 C8
	texte = texte.replace(/…/g,'&Eacute;'); // 201 C9
	texte = texte.replace(/ /g,'&Ecirc;'); // 202 CA
	texte = texte.replace(/À/g,'&Euml;'); // 203 CB
	texte = texte.replace(/Ã/g,'&Igrave;'); // 204 CC
	texte = texte.replace(/Õ/g,'&Iacute;'); // 205 CD
	texte = texte.replace(/Œ/g,'&Icirc;'); // 206 CE
	texte = texte.replace(/œ/g,'&Iuml;'); // 207 CF
	texte = texte.replace(/–/g,'&ETH;'); // 208 D0
	texte = texte.replace(/—/g,'&Ntilde;'); // 209 D1
	texte = texte.replace(/“/g,'&Ograve;'); // 210 D2
	texte = texte.replace(/”/g,'&Oacute;'); // 211 D3
	texte = texte.replace(/‘/g,'&Ocirc;'); // 212 D4
	texte = texte.replace(/’/g,'&Otilde;'); // 213 D5
	texte = texte.replace(/÷/g,'&Ouml;'); // 214 D6
	texte = texte.replace(/◊/g,'&times;'); // 215 D7
	texte = texte.replace(/ÿ/g,'&Oslash;'); // 216 D8
	texte = texte.replace(/Ÿ/g,'&Ugrave;'); // 217 D9
	texte = texte.replace(/⁄/g,'&Uacute;'); // 218 DA
	texte = texte.replace(/€/g,'&Ucirc;'); // 219 DB
	texte = texte.replace(/‹/g,'&Uuml;'); // 220 DC
	texte = texte.replace(/›/g,'&Yacute;'); // 221 DD
	texte = texte.replace(/ﬁ/g,'&THORN;'); // 222 DE
	texte = texte.replace(/ﬂ/g,'&szlig;'); // 223 DF
	texte = texte.replace(/‡/g,'&agrave;'); // 224 E0
	texte = texte.replace(/·/g,'&aacute;'); // 225 E1
	texte = texte.replace(/‚/g,'&acirc;'); // 226 E2
	texte = texte.replace(/„/g,'&atilde;'); // 227 E3
	texte = texte.replace(/‰/g,'&auml;'); // 228 E4
	texte = texte.replace(/Â/g,'&aring;'); // 229 E5
	texte = texte.replace(/Ê/g,'&aelig;'); // 230 E6
	texte = texte.replace(/Á/g,'&ccedil;'); // 231 E7
	texte = texte.replace(/Ë/g,'&egrave;'); // 232 E8
	texte = texte.replace(/È/g,'&eacute;'); // 233 E9
	texte = texte.replace(/Í/g,'&ecirc;'); // 234 EA
	texte = texte.replace(/Î/g,'&euml;'); // 235 EB
	texte = texte.replace(/Ï/g,'&igrave;'); // 236 EC
	texte = texte.replace(/Ì/g,'&iacute;'); // 237 ED
	texte = texte.replace(/Ó/g,'&icirc;'); // 238 EE
	texte = texte.replace(/Ô/g,'&iuml;'); // 239 EF
	texte = texte.replace(//g,'&eth;'); // 240 F0
	texte = texte.replace(/Ò/g,'&ntilde;'); // 241 F1
	texte = texte.replace(/Ú/g,'&ograve;'); // 242 F2
	texte = texte.replace(/Û/g,'&oacute;'); // 243 F3
	texte = texte.replace(/Ù/g,'&ocirc;'); // 244 F4
	texte = texte.replace(/ı/g,'&otilde;'); // 245 F5
	texte = texte.replace(/ˆ/g,'&ouml;'); // 246 F6
	texte = texte.replace(/˜/g,'&divide;'); // 247 F7
	texte = texte.replace(/¯/g,'&oslash;'); // 248 F8
	texte = texte.replace(/˘/g,'&ugrave;'); // 249 F9
	texte = texte.replace(/˙/g,'&uacute;'); // 250 FA
	texte = texte.replace(/˚/g,'&ucirc;'); // 251 FB
	texte = texte.replace(/¸/g,'&uuml;'); // 252 FC
	texte = texte.replace(/˝/g,'&yacute;'); // 253 FD
	texte = texte.replace(/˛/g,'&thorn;'); // 254 FE
	texte = texte.replace(/ˇ/g,'&yuml;'); // 255 FF
	return texte;
}
//DÈcode une chaÓne
function html_entity_decode(texte) {
	texte = texte.replace(/&quot;/g,'"'); // 34 22
	texte = texte.replace(/&amp;/g,'&'); // 38 26	
	texte = texte.replace(/&#39;/g,"'"); // 39 27
	texte = texte.replace(/&lt;/g,'<'); // 60 3C
	texte = texte.replace(/&gt;/g,'>'); // 62 3E
	texte = texte.replace(/&circ;/g,'^'); // 94 5E
	texte = texte.replace(/&nbsp;/g,' '); // 160 A0
	texte = texte.replace(/&iexcl;/g,'°'); // 161 A1
	texte = texte.replace(/&cent;/g,'¢'); // 162 A2
	texte = texte.replace(/&pound;/g,'£'); // 163 A3
	texte = texte.replace(/&curren;/g,' '); // 164 A4
	texte = texte.replace(/&yen;/g,'•'); // 165 A5
	texte = texte.replace(/&brvbar;/g,'¶'); // 166 A6
	texte = texte.replace(/&sect;/g,'ß'); // 167 A7
	texte = texte.replace(/&uml;/g,'®'); // 168 A8
	texte = texte.replace(/&copy;/g,'©'); // 169 A9
	texte = texte.replace(/&ordf;/g,'™'); // 170 AA
	texte = texte.replace(/&laquo;/g,'´'); // 171 AB
	texte = texte.replace(/&not;/g,'¨'); // 172 AC
	texte = texte.replace(/&shy;/g,'≠'); // 173 AD
	texte = texte.replace(/&reg;/g,'Æ'); // 174 AE
	texte = texte.replace(/&macr;/g,'Ø'); // 175 AF
	texte = texte.replace(/&deg;/g,'∞'); // 176 B0
	texte = texte.replace(/&plusmn;/g,'±'); // 177 B1
	texte = texte.replace(/&sup2;/g,'≤'); // 178 B2
	texte = texte.replace(/&sup3;/g,'≥'); // 179 B3
	texte = texte.replace(/&acute;/g,'¥'); // 180 B4
	texte = texte.replace(/&micro;/g,'µ'); // 181 B5
	texte = texte.replace(/&para/g,'∂'); // 182 B6
	texte = texte.replace(/&middot;/g,'∑'); // 183 B7
	texte = texte.replace(/&cedil;/g,'∏'); // 184 B8
	texte = texte.replace(/&sup1;/g,'π'); // 185 B9
	texte = texte.replace(/&ordm;/g,'∫'); // 186 BA
	texte = texte.replace(/&raquo;/g,'ª'); // 187 BB
	texte = texte.replace(/&frac14;/g,'º'); // 188 BC
	texte = texte.replace(/&frac12;/g,'Ω'); // 189 BD
	texte = texte.replace(/&frac34;/g,'æ'); // 190 BE
	texte = texte.replace(/&iquest;/g,'ø'); // 191 BF
	texte = texte.replace(/&Agrave;/g,'¿'); // 192 C0
	texte = texte.replace(/&Aacute;/g,'¡'); // 193 C1
	texte = texte.replace(/&Acirc;/g,'¬'); // 194 C2
	texte = texte.replace(/&Atilde;/g,'√'); // 195 C3
	texte = texte.replace(/&Auml;/g,'ƒ'); // 196 C4
	texte = texte.replace(/&Aring;/g,'≈'); // 197 C5
	texte = texte.replace(/&AElig;/g,'∆'); // 198 C6
	texte = texte.replace(/&Ccedil;/g,'«'); // 199 C7
	texte = texte.replace(/&Egrave;/g,'»'); // 200 C8
	texte = texte.replace(/&Eacute;/g,'…'); // 201 C9
	texte = texte.replace(/&Ecirc;/g,' '); // 202 CA
	texte = texte.replace(/&Euml;/g,'À'); // 203 CB
	texte = texte.replace(/&Igrave;/g,'Ã'); // 204 CC
	texte = texte.replace(/&Iacute;/g,'Õ'); // 205 CD
	texte = texte.replace(/&Icirc;/g,'Œ'); // 206 CE
	texte = texte.replace(/&Iuml;/g,'œ'); // 207 CF
	texte = texte.replace(/&ETH;/g,'–'); // 208 D0
	texte = texte.replace(/&Ntilde;/g,'—'); // 209 D1
	texte = texte.replace(/&Ograve;/g,'“'); // 210 D2
	texte = texte.replace(/&Oacute;/g,'”'); // 211 D3
	texte = texte.replace(/&Ocirc;/g,'‘'); // 212 D4
	texte = texte.replace(/&Otilde;/g,'’'); // 213 D5
	texte = texte.replace(/&Ouml;/g,'÷'); // 214 D6
	texte = texte.replace(/&times;/g,'◊'); // 215 D7
	texte = texte.replace(/&Oslash;/g,'ÿ'); // 216 D8
	texte = texte.replace(/&Ugrave;/g,'Ÿ'); // 217 D9
	texte = texte.replace(/&Uacute;/g,'⁄'); // 218 DA
	texte = texte.replace(/&Ucirc;/g,'€'); // 219 DB
	texte = texte.replace(/&Uuml;/g,'‹'); // 220 DC
	texte = texte.replace(/&Yacute;/g,'›'); // 221 DD
	texte = texte.replace(/&THORN;/g,'ﬁ'); // 222 DE
	texte = texte.replace(/&szlig;/g,'ﬂ'); // 223 DF
	texte = texte.replace(/&agrave;/g,'‡'); // 224 E0
	texte = texte.replace(/&aacute;/g,'·'); // 225 E1
	texte = texte.replace(/&acirc;/g,'‚'); // 226 E2
	texte = texte.replace(/&atilde;/g,'„'); // 227 E3
	texte = texte.replace(/&auml;/g,'‰'); // 228 E4
	texte = texte.replace(/&aring;/g,'Â'); // 229 E5
	texte = texte.replace(/&aelig;/g,'Ê'); // 230 E6
	texte = texte.replace(/&ccedil;/g,'Á'); // 231 E7
	texte = texte.replace(/&egrave;/g,'Ë'); // 232 E8
	texte = texte.replace(/&eacute;/g,'È'); // 233 E9
	texte = texte.replace(/&ecirc;/g,'Í'); // 234 EA
	texte = texte.replace(/&euml;/g,'Î'); // 235 EB
	texte = texte.replace(/&igrave;/g,'Ï'); // 236 EC
	texte = texte.replace(/&iacute;/g,'Ì'); // 237 ED
	texte = texte.replace(/&icirc;/g,'Ó'); // 238 EE
	texte = texte.replace(/&iuml;/g,'Ô'); // 239 EF
	texte = texte.replace(/&eth;/g,''); // 240 F0
	texte = texte.replace(/&ntilde;/g,'Ò'); // 241 F1
	texte = texte.replace(/&ograve;/g,'Ú'); // 242 F2
	texte = texte.replace(/&oacute;/g,'Û'); // 243 F3
	texte = texte.replace(/&ocirc;/g,'Ù'); // 244 F4
	texte = texte.replace(/&otilde;/g,'ı'); // 245 F5
	texte = texte.replace(/&ouml;/g,'ˆ'); // 246 F6
	texte = texte.replace(/&divide;/g,'˜'); // 247 F7
	texte = texte.replace(/&oslash;/g,'¯'); // 248 F8
	texte = texte.replace(/&ugrave;/g,'˘'); // 249 F9
	texte = texte.replace(/&uacute;/g,'˙'); // 250 FA
	texte = texte.replace(/&ucirc;/g,'˚'); // 251 FB
	texte = texte.replace(/&uuml;/g,'¸'); // 252 FC
	texte = texte.replace(/&yacute;/g,'˝'); // 253 FD
	texte = texte.replace(/&thorn;/g,'˛'); // 254 FE
	texte = texte.replace(/&yuml;/g,'ˇ'); // 255 FF
	return texte;
}

/*CHECK Global Input*/
// detect browser that not supports inserting of karakter in input-fields
var DATE_SEPARATOR = '/';
n=navigator;
nua=n.userAgent;

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

function checkNumber(o, oldValue, minDigits, finished) {
	var number = o.value;
	o.className = "inputBox";
	for(i=0; i<number.length; i++) {
		if(number.charAt(i) < '0' || number.charAt(i) > '9') {
			number = oldValue;
		}
	}
	if(finished && (minDigits != 0) && (number.length < minDigits)) {
		o.className = "inputBoxError";
	}
	if(o.value != number) o.value = number;
	return number;
}

function checkAgeFormat(o, oldValue) {

	var inAge = o.value;
	inAge = inAge.replace(/:/g,";");
	inAge = inAge.replace(/;;/g,";");
	inAge = inAge.replace(/ /g,"-");
	inAge = inAge.replace(/--/g,"-");
	inAge = inAge.replace(/;-/g,";");
	inAge = inAge.replace(/-;/g,"-");
	
	var aAge = inAge.split(';');

	var aAgeLast = aAge[aAge.length-1];

	if (aAgeLast.substr(0, aAgeLast.length-1).indexOf('-', 0) > 0 && (aAgeLast.charAt(aAgeLast.length-1) == '-' )) {
		o.value = oldValue;
		return oldValue;
	}
	
	try {
		var aAgePreLast = aAge[aAge.length-2];
		if (aAgePreLast.indexOf('-', 0) == -1 ) {
			o.value = oldValue;
			return oldValue;
		}
	} catch (e) {}

	for(i=0; i<aAgeLast.length; i++) {
		var c = aAgeLast.charAt(i);
		if (((c < '0' || c > '9') && c != '-')){
				o.value = oldValue;
				return oldValue;
		}
	}
	
	if(o.value != inAge) o.value = inAge;
	return inAge;
}


//check amout
function checkAmount(o,oldValue, lenUnits, lenDecimals, signAllowed) {
	var maxLenUnits = lenUnits;
	// remove leading and trailing spaces
	if (o.value.charAt(0) == " " || o.value.charAt(o.value.length-1) == " "){
		 o.value = trim(o.value);
	}
	var number = o.value;

	// check sign
	if (signAllowed){
		if (number.lastIndexOf("-") >0){
			o.value = oldValue;
			return oldValue;
		}
		if (number.charAt(0) == "-"){
			maxLenUnits ++;
		}
	}
	else{
		if (number.indexOf("-") != -1){
			o.value = oldValue;
			return oldValue;
		}
	}

	// check separator
	number = number.replace(',', '.');
	
	if (lenDecimals == 0 && number.indexOf(".") != -1){
		o.value = oldValue;
		return oldValue;
	}
	if (number.indexOf(".") != number.lastIndexOf(".")){ 	// check if exist more than one ','
		o.value = oldValue;
		return oldValue;
	}
	
	// check max length (units & decimals)
	a = number.split(".");  // split units and decimals
	if(a[0].length > maxLenUnits || ((a.length > 1) && (a[1].length > lenDecimals))){
		o.value = oldValue;
		return oldValue;
	}

	// Validate inserted character
	for(i=0; i<number.length; i++) {
		var c = number.charAt(i);
		if ((c<'0' || c >'9') && c != '.' && c != '-'){
			o.value = oldValue;
			return oldValue;
		}
	}
	//return new result
	if (o.value.charAt(number.length-1) == ','){ 
		o.value = number;
	}
	
	return number;
}



function checkAccountNumber(o, oldValue, finished) {
	var number = o.value;
	o.className = "inputBox";

	number = number.replace(" ","");
	number = number.replace("/","-");
	
	posFirstSep = 3;
	posSecondSep = 11; 
	
	var i = 0;
	while (i < number.length) {
		var c = number.charAt(i);
	
		/* check if it's a valid character) */
		if ( (c >= '0' && c <= '9') || c == '-') {
			
			if (c == '-' && (i !=posFirstSep && i != posSecondSep)) {
				/* '-' not at right spot */
				number = number.substring(0,i) + number.substring(i+1,number.length);	
			}
			else if (c != '-' && (i==posFirstSep || i==posSecondSep) && isInsertSupported()) {
				/* we found a spot to insert '-' */
				firstPart = number.substring(0,i);
				secondPart = number.substring(i,number.length);
				number = firstPart + "-" + secondPart; 
				i++;
			} else {
				i++;
			}		

		} else {			
			/* not a number or '-' */
			number = number.substring(0,i) + number.substring(i+1,number.length);			
		}
	}
	if (((number.length >= posFirstSep+1 && number.charAt(posFirstSep) != '-') || 
	     (number.length >= posSecondSep+1 && number.charAt(posSecondSep) != '-')) && !isInsertSupported()) {
		number = oldValue;
	}

	if((finished || number.length == 14) && !checkAccountDigit(number)) o.className = "inputBoxError";
	if(number != o.value) o.value = number;
	//if(!checkAccountFormat2(number)) o.className = "inputBoxError"; 
	return number;
}


function checkPourcent(o,oldValue, lenUnits, lenDecimals) {
	var maxLenUnits = lenUnits;

	// remove leading and trailing spaces
	if (o.value.charAt(0) == " " || o.value.charAt(o.value.length-1) == " "){
		 o.value = trim(o.value);
	}
	var number = o.value;

	if (number.charAt(0) == "1"){
		maxLenUnits ++;
	}

	if (number > 100){
		maxLenUnits --;
	}

	// check separator
	number = number.replace(',', '.');
	
	if (lenDecimals == 0 && number.indexOf(".") != -1){
		o.value = oldValue;
		return oldValue;
	}
	if (number.indexOf(".") != number.lastIndexOf(".")){ 	// check if exist more than one ','
		o.value = oldValue;
		return oldValue;
	}
	
	// check max length (units & decimals)
	a = number.split(".");  // split units and decimals
	
	if(a[0] > 99 && (a.length > 1)){
		o.value = oldValue;
		return oldValue;
	}

	if(a[0].length > maxLenUnits || ((a.length > 1) && (a[1].length > lenDecimals))){
		o.value = oldValue;
		return oldValue;
	}

	// Validate inserted character
	for(i=0; i<number.length; i++) {
		var c = number.charAt(i);
		if ((c<'0' || c >'9') && c != '.' && c != '-'){
			o.value = oldValue;
			return oldValue;
		}
	}
	//return new result
	if (o.value.charAt(number.length-1) == ','){ 
		o.value = number;
	}
	return number;
}