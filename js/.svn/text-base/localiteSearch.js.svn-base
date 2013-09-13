//Gets the browser specific XmlHttpRequest Object
function getXmlHttpRequestObject() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		alert("Your Browser Sucks!\nIt's about time to upgrade don't you think?");
	}
}

//Our XmlHttpRequest object to get the auto suggest
var searchReq = getXmlHttpRequestObject();

//Called from keyup on the search textbox.
//Starts the AJAX request.
function searchSuggest(value) {
	if (value.length > 3) {
		if (searchReq.readyState == 4 || searchReq.readyState == 0) {
			var str = escape(value);
			searchReq.open("GET", '../lib/localiteSearch.php?search=' + str, true);
			searchReq.onreadystatechange = handleSearchSuggest; 
			searchReq.send(null);
		}		
	} else {
		document.getElementById('search_suggest').innerHTML = '';
	}
}

//Called when the AJAX response is returned.
function handleSearchSuggest() {
	if (searchReq.readyState == 4) {
		var ss = document.getElementById('search_suggest')
		ss.innerHTML = '';
		var str = searchReq.responseText.split("\n");
		for(i=0; i < str.length - 1; i++) {
			//Build our element string.  This is cleaner using the DOM, but
			//IE doesn't support dynamically added attributes.
			var suggest = '<div onmouseover="javascript:suggestOver(this);" ';
			suggest += 'onmouseout="javascript:suggestOut(this);" ';
			suggest += 'onclick="javascript:setSearch(this.innerHTML);" ';
			suggest += 'class="suggest_link">' + str[i] + '</div>';
			ss.innerHTML += suggest;
		}
	}
}

//Mouse over function
function suggestOver(div_value) {
	div_value.className = 'suggest_link_over';
}
//Mouse out function
function suggestOut(div_value) {
	div_value.className = 'suggest_link';
}
//Click function
function setSearch(value) {
	document.getElementById('localite').value = value;
	document.getElementById('search_suggest').innerHTML = '';
}


function html_entities_decode(pseudo) {
	
	out = pseudo;
	
	out = out.replace('&#039;','\'');
	out = out.replace('&#039;','\'');
		
	out = out.replace('&egrave;','è');
	out = out.replace('&egrave;','è');
	out = out.replace('&egrave;','è');
		
	out = out.replace('&Egrave;','è');
	out = out.replace('&Egrave;','è');
	out = out.replace('&Egrave;','è');
		
	out = out.replace('&eacute;','é');
	out = out.replace('&eacute;','é');
	out = out.replace('&eacute;','é');

	out = out.replace('&Eacute;','é');
	out = out.replace('&Eacute;','é');
	out = out.replace('&Eacute;','é');

	out = out.replace('&agrave;','à');
	out = out.replace('&agrave;','à');
	out = out.replace('&aacute;','á');
		
	out = out.replace('&Agrave;','à');
	out = out.replace('&Agrave;','à');
	out = out.replace('&Aacute;','á');
		
	out = out.replace('&aacute;','á');
	out = out.replace('&aacute;','á');
	out = out.replace('&aacute;','á');

	out = out.replace('&Aacute;','á');
	out = out.replace('&Aacute;','á');
	out = out.replace('&Aacute;','á');

	out = out.replace('&euml;','ë');
	out = out.replace('&euml;','ë');
	out = out.replace('&euml;','ë');

	return out;
}
