function submitForm(del_cecodi, del_entrie) {

	$('BoxListCecodi').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
	
	var devis_input = $('devis_input').value;
	var prothesiste_input = $('prothesiste_input').value;

	try {
		var cecodi_input = $('cecodi_input').value;
	} catch ( e ) {
		var cecodi_input = "";
	}
	
	new Ajax.Request('../protheses/prothese_submit_form.php',
		{
			method:'get',
			parameters: {cecodi_input : cecodi_input, devis_input : devis_input, prothesiste_input : prothesiste_input, del_cecodi: del_cecodi, del_entrie : del_entrie},
			asynchronous:false,
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
    			$('calendarSideBar').innerHTML = json.root.content + $('calendarSideBar').innerHTML;
    			$('devis_input').value = '';
				$('prothesiste_input').value = '';
				try {
					$('cecodi_input').value = '';
					$('cecodi_desc').innerHTML = '';
				} catch ( e ) {
				}
				protheseUpdateForm();
    	    },
		    onFailure:  function(){ alert("failure");} 
		});
		
	return false;
}


// update cecodi list
function protheseUpdateForm() {
	$('BoxListCecodi').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
	$('BoxTitleDevis').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
	$('BoxContentDevis').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
	$('BoxTitleProthesiste').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
    $('BoxContentProthesiste').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
	$('BoxTitleAcompte').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
    $('BoxContentAcompte').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
    $('BoxContentRemboursement').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
	new Ajax.Request('../protheses/prothese_update_form.php',
		{
			method:'get',
			parameters: {},
			asynchronous:true,
			requestHeaders: {Accept: 'application/json'},
			onSuccess: function(transport, json){
    			$('BoxListCecodi').innerHTML = json.root.cecodi;
    			$('BoxTitleDevis').innerHTML = json.root.devis;
    			$('BoxContentDevis').innerHTML = json.root.devis_detail;
    			$('BoxTitleProthesiste').innerHTML = json.root.prothesiste;
    			$('BoxContentProthesiste').innerHTML = json.root.prothesiste_detail;
    			$('BoxTitleAcompte').innerHTML = json.root.acompte;
    			$('BoxContentAcompte').innerHTML = json.root.acompte_detail;
    			$('BoxTitleRemboursement').innerHTML = json.root.remboursement;
    			$('BoxContentRemboursement').innerHTML = json.root.remboursement_detail;
    			$('a_payer').innerHTML = json.root.a_payer;
    			$('deja_paye').innerHTML = json.root.deja_paye;
    			$('reste_paye').value = json.root.reste_paye;
    			$('buttonBox').innerHTML = json.root.button;
    	    },
		    onFailure:  function(){ $('BoxListCecodi').innerHTML = "failure";} 
		});
}



// cloture d'une tarification
function protheseCloturer(id) {
	new Ajax.Request('../protheses/prothese_cloturer.php',
		{
			method:'get',
			parameters: {id :id},
			asynchronous:false,
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
    			$('calendarSideBar').innerHTML = json.root.content + $('calendarSideBar').innerHTML;
    			Element.hide('BoxAddCecodi');
  				protheseUpdateForm();
    	    },
		    onFailure:  function(){ $('BoxListCecodi').innerHTML = "failure";} 
		});
}

// Paiement d une tarification
function prothesePayerConfirm(id) {
	var valeur = $('reste_paye').value;
	var paiement_type = $('paiement_type').value;
	var compte = $('compte').value;
	if (valeur > 0 && paiement_type!='') {
		new Ajax.Request('../protheses/prothese_payer.php',
			{
				method:'get',
				parameters: {id : id, valeur :valeur, paiement_type : paiement_type, compte : compte},
				asynchronous:false,
				requestHeaders: {Accept: 'application/json'},
	  			onSuccess: function(transport, json){
	  				$('calendarSideBar').innerHTML = json.root.content + $('calendarSideBar').innerHTML;
	  				submitForm('','');
	    	    },
			    onFailure:  function(){ alert("failure");} 
			});
	}
}

// recherche d'un tarification (non cloturée -  cloturée) ou d'un prothèse
function protheseRechercheComplete(utilisation,limit) {
	$('tarificationBox').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
	var patient = $('patient_input').value;
	var medecin = $('medecin_input').value;
	var start_date = $('start_date_input').value;
	var end_date = $('end_date_input').value;
	var tarification = $('tarification_input').value;
	var prestation = $('prestation_input').value;
	var etat = $('etat_input').value;
	new Ajax.Request('../protheses/prothese_recherche_complete.php',
		{
			method:'get',
			parameters: {patient: patient, medecin: medecin, start_date: start_date, end_date: end_date, utilisation: utilisation, tarification: tarification, prestation: prestation, etat: etat, limit:limit},
			asynchronous:true,
  			onSuccess: function(transport){
  				$('tarificationBox').innerHTML = transport.responseText;
    	    },
		    onFailure:  function(){ $('tarificationBox').innerHTML = "failure";} 
		});
}


// recherche sur base du id apres clic
function protheseRechercheCompleteList(id,utilisation,limit) {
	if ($('tarification_input').value != '') {
		$('tarification_input').value='';
	} else {
		$('tarification_input').value=id;
	}
	protheseRechercheComplete(utilisation,limit);
}


// action au niveau de la recherche
function protheseAction(utilisation,type,id) {
	new Ajax.Request('../protheses/prothese_action.php',
		{
			method:'get',
			parameters: {type: type, id: id},
			asynchronous:true,
			requestHeaders: {Accept: 'application/json'},
	  		onSuccess: function(transport, json){
  				$('Info').innerHTML=json.root.info;
  				protheseRechercheComplete(utilisation);
    	    },
		    onFailure:  function(){ $('tarificationBox').innerHTML = "failure";} 
		});
}
