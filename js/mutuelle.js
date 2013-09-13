var mutuellesList = "";

// rehcerche direct
function mutuelleRechercheDirect(mutuelle) {
	$('findMutuelleInput').value=mutuelle;
	mutuelle_recherche_simple(mutuelle);
	//TODO trim sur la droite
}


function mutuelleRechercheComplete(mutuelle){
  	if(trim(mutuelle)!='') {
		$('mutuelleBox').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
  		new Ajax.Updater(
			'mutuelleBox',
			'../lib/mutuelle_recherche_complete.php',
			{
				method: 'get',
				parameters: {mutuelle: htmlentities(mutuelle)}
			}
		);
	} else {
	    $('mutuelleBox').innerHTML = '';
	}
}

function controle_choix(value) {
	var choix = document.formulaire.cases;
	var mutuelleCode = choix[value].value;
	mutuelleCode = "|" + mutuelleCode + "|";
	if (choix[value].checked == true) {
		mutuellesList = mutuellesList + mutuelleCode;
	} else {
		mutuellesList = mutuellesList.replace(mutuelleCode,"")
	}
}


// impression etiquette
function etiquettePrint(nombre) {
	iframe = "<iframe name='' SRC='../etiquettes/print_etiquette_mutuelle.php?nombreEtiquette=" + escape(nombre) + "&mutuellesList=" + escape(mutuellesList) + "' scrolling='no' height='1' width='1' FRAMEBORDER='no'></iframe>";
	$('etiquette').innerHTML = iframe;
}


// action sur la table mutuelle
function mutuelleAction(type,id) {
	new Ajax.Request('../mutuelles/mutuelle_action.php',
		{
			method:'get',
			parameters: {type : type, id : id},
			asynchronous:false,
			requestHeaders: {Accept: 'application/json'},
	  		onSuccess: function(transport, json){
	  			$('Info').innerHTML=json.root.info;
  				mutuelleRechercheComplete($('pseudo').value);
    	    },
		    onFailure:  function(){ alert('failure');} 
		});
}
