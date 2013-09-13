function writedivpatient(texte)
     {
     document.getElementById('patientsbox').innerHTML = texte;
     }

function recherche_patients(pseudo)
     {
     	if(pseudo != '') {
        	texte = file('../lib/recherche_patients.php?pseudo='+escape(pseudo))
          	writedivpatient(texte);
	 	} else {
          	writedivpatient("");
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
