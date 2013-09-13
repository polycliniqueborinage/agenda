// add or remove a new prestation
function submitForm(del_caisse,date,caisse_input) {
	var transaction_id = $('transaction_id').value;
	var transaction_valeur = $('transaction_valeur').value;
	var comment = $('comment').value;
	var mode = $('mode').value;
	var compte = $('compte').value;
	new Ajax.Request('../caisses/caisse_submit_form.php',
		{
			method:'get',
			parameters: {del_caisse : del_caisse, comment : comment, transaction_valeur : transaction_valeur, transaction_id : transaction_id, mode : mode, compte : compte, caisse_input : caisse_input, date : date},
			asynchronous:false,
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
  				$('calendarSideBar').innerHTML = json.root.content + $('calendarSideBar').innerHTML;
  				$('transaction_id').value = '';
  				$('transaction_valeur').value = '';
  				$('comment').value = '';
  				$('mode').value = '';
  				$('compte').value = '';
  				Element.hide('compte_label');
  				CaisseUpdateForm();
    	    },
		    onFailure:  function(){ alert("failure");} 
		});
	return false;
}

// update Tarification Form
function CaisseUpdateForm() {
	new Ajax.Request('../caisses/caisse_update_form.php',
		{
			method:'get',
			parameters: {},
			asynchronous:false,
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
  				$('BoxListCecodi').innerHTML = transport.responseText;
  			},
		    onFailure:  function(){ $('BoxListCecodi').innerHTML = "failure";} 
		});
		new Ajax.Request('../caisses/caisse_update_form2.php',
		{
			method:'get',
			parameters: {},
			asynchronous:false,
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
    			$('montant_ouverture').innerHTML = json.root.montant_ouverture;
    			$('montant_fermeture').innerHTML = json.root.montant_fermeture;
    			$('banksys_fermeture').innerHTML = json.root.banksys_fermeture;
    			$('BoxTitlePatient').innerHTML = json.root.caisse;
    			$('BoxTitleMedecin').innerHTML = json.root.date;
    			$('BoxAddCecodi').setAttribute("class","cecodi");
    	    },
		    onFailure:  function(){ $('BoxListCecodi').innerHTML = "failure";} 
		});
}

// update Tarification Form
function caisseAction(action, id) {
	new Ajax.Request('../caisses/caisse_action.php',
		{
			method:'get',
			parameters: {action:action, id:id},
			asynchronous:false,
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
  				if(json.root.mode != '') {
	  				$('mode').innerHTML = json.root.mode;
	  				$('BoxAddCecodi').setAttribute("class",json.root.class);
  				}
  				//CaisseUpdateForm();
    	    },
		    onFailure:  function(){ $('BoxListCecodi').innerHTML = "failure";} 
		});
}







function recherche_transaction(texte) {
	var splittexte = texte.split('#');
	var id = splittexte[0];
	var type = splittexte[1];
	if (id !='choisir') {
		// payement
		if (type  == '1') {
			document.getElementById('submitbox').innerHTML = "<input type='submit' value='Espece' onclick='javascript:caisse_payer_espece_confirm("+id+");'/><input type='submit' value='Bancontact' onclick='javascript:caisse_payer_bancontact_confirm("+id+");'/>";
		} else {
			// retrait
			if (type  == '-1') {
				document.getElementById('submitbox').innerHTML = "<input type='text' value='Modif du retrait' autocomplete='off' name='motif' id='motif' size='32' maxlength='32' onFocus='this.select()'/><input type='submit' value='Espece' onclick='javascript:caisse_payer_espece_confirm_motif("+id+");'/>";
			} else {
				document.getElementById('submitbox').innerHTML = "<input type='submit' value='Initialisation' onclick='javascript:caisse_initialise_confirm();'/>";
			}
		}
	} else {
		document.getElementById('submitbox').innerHTML = '';
	}
}

function caisse_initialise_confirm() {
	var is_confirmed = confirm("Voulez vous confirmer l'initialisation de la caisse ?");
		if (is_confirmed) {
			var montant = window.document.forms['insertForm'].transaction_valeur.value;
			none = file('../lib/caisse_initialise_confirm.php?montant='+escape(montant));
			ResultUrl = "../caisses/detail_transactions.php";
			window.location.href = ResultUrl;
		}

}

