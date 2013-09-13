function recherche_code_mutu(code)
     {
		if(code != '') {
        	texte = file('../lib/recherche_code_mutu.php?pseudo='+escape(code))
			var splittexte = texte.split('-');
			//document.getElementById('mutuellebox').innerHTML = splittexte[0];
    		document.forms['patientForm'].mutuelle_code.value = splittexte[1];
	 	} else {
			//document.getElementById('mutuellebox').innerHTML = '';
    		document.forms['patientForm'].mutuelle_code.value = '';
		}
     }

function file(fichier)
     {
     if(window.XMLHttpRequest) // FIREFOX
          xhr_object = new XMLHttpRequest();
     else if(window.ActiveXObject) // IE
          xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
     else
          return(false);
     xhr_object.open("GET", fichier, false);
     xhr_object.send(null);
     if(xhr_object.readyState == 4) return(xhr_object.responseText);
     else return(false);
     }
