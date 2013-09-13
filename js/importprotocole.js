function importprotocole(){

	var medecin_id = '';
	var patient_id = '';
	var protocole = '';
	
	try {
		protocole = document.getElementById('medecin_protocole').value;

		
		medecin_id = document.getElementById('medecin_id').value;
		if (medecin_id!=''){
			var medecin_inami = document.getElementById('medecin_inami').value;
			var medecin_prenom = document.getElementById('medecin_prenom').value;
			var medecin_nom = document.getElementById('medecin_nom').value;
			var medecin_specialite = document.getElementById('medecin_specialite').value;
		}
	
		patient_id = document.getElementById('patient_id').value;


		if (patient_id!=''){
			var patient_niss = document.getElementById('patient_niss').value;
			var patient_nom = document.getElementById('patient_nom').value;
			var patient_prenom = document.getElementById('patient_prenom').value;
			var patient_date_naissance = document.getElementById('patient_date_naissance').value;
			var patient_mutuelle_code = document.getElementById('patient_mutuelle_code').value;
			var patient_ct1 = document.getElementById('patient_ct1').value;
			var patient_ct2 = document.getElementById('patient_ct2').value;
			var patient_mutuelle_matricule = document.getElementById('patient_mutuelle_matricule').value;
			var titulaire_mutuelle_matricule = document.getElementById('titulaire_mutuelle_matricule').value;
		}

	} catch (e) {
	}
	
	if (medecin_id!='' && patient_id!='' && protocole=='check') {
		
		// date
		date = new Date()
		jour = date.getDate();
		mois = date.getMonth() + 1;
		annee = date.getFullYear();
		
		var url = "http://localhost:50000/extensions/project-specific/importer/importprotocole/outputpath";
		
		// emplacement de base
		url += "/content/protocoles/";

		// nom du medecin
		url += medecin_nom;
		url += "_";
		url += medecin_prenom;
		
		url += "/";
		url += annee;		
		url += "/";

		// mois en cours
		url += mois;		
		url += "/";

		// Nom du fichier
		url += "nameFile/";
		url += patient_nom;
		url += "_";
		url += patient_prenom;
		
		// Paramatre
		url +="?consult_date="+ annee + "-" + mois +"-"+ jour;
		url +="&medecin_inami="+medecin_inami;  
		url +="&medecin_prenom="+medecin_prenom;  
		url +="&medecin_nom="+medecin_nom;  
		url +="&medecin_specialite="+medecin_specialite;  

		url +="&patient_id="+patient_id;  
		url +="&patient_niss="+patient_niss;  
		url +="&patient_nom="+patient_nom; 
		url +="&patient_prenom="+patient_prenom;  
		url +="&patient_date_naissance="+patient_date_naissance;  
		url +="&patient_mutuelle_code="+patient_mutuelle_code; 
		url +="&patient_ct1="+patient_ct1;
		url +="&patient_ct2="+patient_ct2;  
		url +="&patient_mutuelle_matricule="+patient_mutuelle_matricule;  
		url +="&titulaire_mutuelle_matricule="+titulaire_mutuelle_matricule;  
		//http://localhost:50000/extensions/project-specific/importer/importprotocole/outputpath/content/protocoles/Calcus_David/2007/12/nameFile/Catherine_David?medecin_inami=99999999999&medecin_prenom=David&medecin_nom=Calcus&medecin_specialite=Physioth%EF%BF%BDrapie&patient_niss=00000000204&patient_nom=Catherine&patient_prenom=David&patient_date_naissance=04.02.1987&patient_mutuelle_code=315&patient_ct1=101&patient_ct2=101&patient_mutuelle_matricule=8222745%2004287&titulaire_mutuelle_matricule=8222745%2004287

		document.getElementById('protocole_url').value = url;
		//window.open(url);
	}
}

function file(fichier) {
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