var DATE_SEPARATOR = '/';
var TIME_SEPARATOR = ':';
var ILLEGAL_CHARS = "€,<,>";
var formCount = 0; /* to generate unique form id's */
var ddnForms = new Array();
var formFocus = "";

function getHostName() {
	url = '' + document.location;
	i = url.substring(8, url.length).indexOf('/');
	return url.substring(0, i+8);
}						

function setLabel(id, caption) {
	var o = document.getElementById(id);
	o.innerHTML = caption;
}

function executeFunction(f) {
	if(f != "") {
		result = "" + eval(f + "()");
		return result;
	}
	return "none";
}

function openwindow(url) {
	var hwnd = window.open(url, "HelpWindow","width=800,height=600,resizable=Yes,scrollbars=Yes,menubar=No,location=No,toolbar=Yes,status=Yes");
}

function openwindowWithMachineID(url) {
	var hwnd = window.open(url + machineIdentifier, "PB", "width=640,height=400,top=10,left=10,screenX=10,screenY=10,toolbar=no,menubar=no,location=no,scrollbars=yes,resizable=yes,status=yes");
}

function loadPage() {
	if(formFocus != "") {		
		eval(formFocus);
	}
}

/* for tag errorWindow */
function showErrorMessage(message, uid, icon) {
	var _uid='';
	if(showErrorMessage.arguments.length > 1) _uid = uid;
	document.getElementById(_uid + "_error_window").style.display = "block";
	document.getElementById(_uid + "_errorMessage").innerHTML = message;
	if(showErrorMessage.arguments.length > 2)
		document.getElementById(_uid + "_error_icon").innerHTML = "<image src='"+icon+machineIdentifier+"' />";
}

function hideErrorMessage(uid) {
	document.getElementById(uid + "_error_window").style.display = "none";
}

function setFocus(id) {
	for(i=0; i<document.forms.length; i++) {
		for(j=0; j<document.forms[i].elements.length; j++) {
			if(document.forms[i].elements[j].name == id) {
				formFocus = "document." + document.forms[i].name + "." + document.forms[i].elements[j].name + ".focus()";
				break;
			}
		}
	}
}

function removeLeadingZeros(s) {
	var t = "";
	for(i=0, leadingZeros=0; i<s.length; i++) {
		if(s.charAt(i) == "0") leadingZeros++;
		else break;
		t = s.substr(leadingZeros);
	}
	return t;
}

function setSelect(id) {
	for(i=0; i<document.forms.length; i++) {
		for(j=0; j<document.forms[i].elements.length; j++) {
			if(document.forms[i].elements[j].name == id) {
				formFocus = "document." + document.forms[i].name + "." + document.forms[i].elements[j].name + ".select()";
				break;
			}
		}
	}
}

/* Replace the page to goto upon a submit for a form */
function replaceAction(oldAction, newAction) {
	i = oldAction.indexOf(";");
	return newAction + oldAction.substr(i);
}

function addToLegend(caption, aCaptions, index) {
	fCreate = true;
	
	for (i=0; i<index; i++) {
		if (aCaptions[i] == caption) {
			fCreate = false;
			break;
		}
	}
	
	return fCreate;
}

function createLinkForms() {
	for(var i=0; i<formCount; i++) {
		if(ddnForms[i] != "") {
			document.writeln("<form name='link" + i + "' id='link" + i + "' method='post' action='" + ddnForms[i] + "' >");
			document.writeln("<input type='hidden' value='dummy' />");
			document.writeln("</form>");		
		}
	}
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

function clearField(o, test) {
	if(o.value == test) o.value = "";
}

function checkText(o) {
	var text = o.value;
	var ic = ILLEGAL_CHARS.split(",");
	for(i=0; i<ic.length; i++) {
		if(text.indexOf(ic[i]) != -1) text = replaceChar(text, ic[i], '');
	}
	
	if(text != o.value) o.value = text;
	return true;
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

function trim(str) {
	return str.replace(/ /g, "");
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

function trim(str) {
	return str.replace(/ /g, "");
}

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

function showError(id, show) 
{ 
	if (show) { 
		(document.getElementById(id)).style.visibility = "visible";; //show element 
	} 
	else { 
		(document.getElementById(id)).style.visibility = "hidden";; //hide element 
	} 
} 

function isDigit( str, len )
{
	if ( len > 0 ) {
		if ( str.length != len ) {
  			return ( false );
  		}
  	}
	for ( var i=0; i < str.length; i++ ) {
  		var c = str.charAt(i);
  		if ( c < "0" || c > "9" ) {
  			return ( false );
  		}
  	}
	return ( true );
} 

function clearForm(form) {
	/* text input */
	elements = form.getElementsByTagName('input');
	for (i=0; i < elements.length; i++) {		
		if (elements[i].type == "text") {									
			elements[i].value = "";
		} else if (elements[i].type == "checkbox" || elements[i].type =="radio")  {
			elements[i].checked = false;
		} 
	}	
											
	/* dropdown boxes */
	elements = form.getElementsByTagName('select'); 
	for (i=0; i < elements.length; i++) {
		elements[i].value = "";
		options = elements[i].options;
		for (j=0; j < options.length; j++) {
			options[j].value = "";												
		}
	}									
}

function checkPhoneNumberField(o, nextField, maxlength) {
	var numberField = o.value;
	var c = numberField.charAt(numberField.length - 1);
	var isValidChar = (c >= '0' && c <= '9');
	o.className = "inputBox";

	if(!isValidChar) {
		o.value = ((numberField.length > 1) ? numberField.substr(0, numberField.length - 1) : "");
		return false;
	}
	
	if(numberField.length == maxlength) {
		for(i=0; i<o.form.elements.length; i++) {
			if(o.form.elements[i].name == nextField) {
				o.form.elements[i].focus();
				o.form.elements[i].select();
			}
		}
	}	
	return true;
}


function checkTextArea(o, maxlength) {
	if (o.value.length > maxlength)
		o.value =o.value.substring(0,maxlength);
}

function checkCecodi(o) {
		var number = o.value;
		var test = true;
		
		for(i=0; i<number.length; i++) {
			if(number.charAt(i) < '0' || number.charAt(i) > '9') {
			test=false;
			}
		}
		
		if(o.value != '' && test) {
        	texte = file('../lib/check_cecodi.php?cecodi='+escape(o.value));
		  	o.value = texte;
	 	} 
		else {
			o.value = '';
		}
}

function checkCecodiTarification(o,oldValue) {
		
		var number = document.forms['cecodi_input'].value;
		var test = true;
		
		for(i=0; i<number.length; i++) {
			if(number.charAt(i) < '0' || number.charAt(i) > '9') {
			test=false;
			}
		}
		
		if(o.value != '' && test) {
        	texte = file('../lib/check_cecodi.php?cecodi='+escape(o.value));
		  	o.value = texte;
			document.
			o.select();
	 	} 
		else {
			o.value = oldValue;
		}
		
}


function checkAccountFormat(o) {
	var number = o.value;
	
	var nrOfDigits = 0;
	var newNumber = "";
	pos = 11;
	
	for(i=0; i<number.length; i++) {
		c = number.charAt(i);

		if(i==3 || i==pos) {
			newNumber += "-";
		}
		if(c >= '0' && c <= '9') {
			nrOfDigits++;
			newNumber += c;
		}
	}
	if(o.value != newNumber) o.value = newNumber;
	o.value=o.value.substr(0,14);
	if(nrOfDigits == 12) return true;
	
	return false;
	
}

function checkAccountDigit(account) {
  var number = "";
	for(i=0; i<account.length; i++) {
		if(account.charAt(i) != '-' && account.charAt(i) != '/') {
			number += account.charAt(i);
		}
	}
	base = number.substr(0, number.length-2);
	checkdigit = number.substr(number.length-2, 2);
	result = base % 97;
	if(result == 0) result = 97;
	if(result != checkdigit) {
		/*alert("Foutief rekeningnummer!");*/
		return false;
	}
	
	return true;
}

function calculateCheckdigit(account) {
  var number = "";
	for(i=0; i<account.length; i++) {
		if(account.charAt(i) != '-' && account.charAt(i) != '/') {
			number += account.charAt(i);
		}
	}
	base = number.substr(0, number.length);

	result = base % 97;
	if(result == 0) result = 97;
	return result;
}

