function writedivclassececodi(texte)
     {
     document.getElementById('classececodibox').innerHTML = texte;
     }

function recherche_classe_cecodi(pseudo)
     {
     	if(pseudo != '') {
        	texte = file('../lib/recherche_classe_cecodi.php?pseudo='+escape(pseudo))
          	writedivclassececodi(texte);
	 	} else {
          	writedivclassececodi("");
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
