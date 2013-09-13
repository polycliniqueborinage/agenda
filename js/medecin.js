var medecinsList = "";

// choix entre interne et externe
function changeTypeMedecin(value) {
	var element = document.getElementById('int_ext');
	if (value != 'interne') {
		document.forms['editors_here'].agenda.checked = false;
		document.forms['editors_here'].agenda.disabled = true;
		document.forms['editors_here'].taux_acte.value = '';
		document.forms['editors_here'].taux_acte.disabled = true;
		document.forms['editors_here'].taux_consultation.value = '';
		document.forms['editors_here'].taux_consultation.disabled = true;
		document.forms['editors_here'].taux_prothese.value = '';
		document.forms['editors_here'].taux_prothese.disabled = true;
		document.forms['editors_here'].duree_consult.value = '';
		document.forms['editors_here'].duree_consult.disabled = true;
		element.setAttribute("class","");
	} else {
		document.forms['editors_here'].agenda.disabled = false;
		document.forms['editors_here'].taux_acte.disabled = false;
		document.forms['editors_here'].taux_consultation.disabled = false;
		document.forms['editors_here'].taux_prothese.disabled = false;
		document.forms['editors_here'].duree_consult.disabled = false;
		element.setAttribute("class","required");
	}
}


// recherche direct
function medecinRechercheDirect() {
	var nom = $('nom').value;
	var prenom = $('prenom').value;
	$('findMedecinInput').value=nom+" "+prenom;
 	medecin_recherche_simple(nom+" "+prenom);
}


// recherche medecin complete
function medecinRechercheComplete(medecin) {
  	if(trim(medecin)!='') {
		$('medecinBox').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
  		new Ajax.Updater(
			'medecinBox',
			'../lib/medecin_recherche_complete.php',
			{
				method: 'get',
				parameters: {medecin: htmlentities(medecin)}
			}
		);
	} else {
	    $('medecinBox').innerHTML = '';
	}
}


function controle_choix(value) {
	var choix = document.formulaire.cases;
	var medecinID = choix[value].value;
	medecinID = "|" + medecinID + "|";
	if (choix[value].checked == true) {
		medecinsList = medecinsList + medecinID;
	} else {
		medecinsList = medecinsList.replace(medecinID,"")
	}
}


// impression etiquette
function etiquettePrint(nombre) {
	iframe = "<iframe name='' SRC='../etiquettes/print_etiquette_medecin.php?nombreEtiquette=" + escape(nombre) + "&medecinsList=" + escape(medecinsList) + "' scrolling='no' height='1' width='1' FRAMEBORDER='no'></iframe>";
	$('etiquette').innerHTML = iframe;
}

function switchGeneral(id) {
	var all = 4;
	for(i=1;i<all;i++) {
		try{
			if (i == id) {
				$('sec_li_'+i).setAttribute("class","nodelete current");
				Element.show('table_'+i);
				Element.show('sec_li_'+(i+1));
			}
			else{
				$('sec_li_'+i).setAttribute("class","nodelete");
				Element.hide('table_'+i);
			}
		} catch(e){};
	}
}


// action sur la table medecin
function medecinAction(type,id) {
	new Ajax.Request('../medecins/medecin_action.php',
		{
			method:'get',
			parameters: {type : type, id : id},
			asynchronous:false,
			requestHeaders: {Accept: 'application/json'},
	  		onSuccess: function(transport, json){
	  			$('Info').innerHTML=json.root.info;
  				medecinRechercheComplete($('pseudo').value);
    	    },
		    onFailure:  function(){ alert('failure');} 
		});
}