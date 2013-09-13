var valeurcecodi1 = '';
var valeurprixvipo1 = '';var valeurprixvipo2 = '';var valeurprixvipo3 = '';var valeurprixvipo4 = '';var valeurprixvipo5 = '';
var valeurprixtr1 = '';var valeurprixtr2 = '';var valeurprixtr3 = '';var valeurprixtr4 = '';var valeurprixtr5 = '';
var valeurprixtp1 = '';var valeurprixtp2 = '';var valeurprixtp3 = '';var valeurprixtp4 = '';var valeurprixtp5 = '';
var valeurkdb1 = '';var valeurkdb2 = '';var valeurkdb3 = '';var valeurkdb4 = '';var valeurkdb4 = '';var valeurkdb5 = '';
var valeurbc1 = '';var valeurbc2 = '';var valeurbc3 = '';var valeurbc4 = '';var valeurbc5 = '';
var valeurhono_travailleur1 = '';var valeurhono_travailleur2 = '';var valeurhono_travailleur3 = '';var valeurhono_travailleur4 = '';var valeurhono_travailleur5 = '';
var valeura_vipo1 = '';var valeura_vipo2 = '';var valeura_vipo3 = '';var valeura_vipo4 = '';var valeura_vipo5 = '';
var valeurb_tiers_payant1 = '';var valeurb_tiers_payant2 = '';var valeurb_tiers_payant3 = '';var valeurb_tiers_payant4 = '';var valeurb_tiers_payant5 = '';
var valeurage1='';var valeurage2='';var valeurage3='';var valeurage4='';var valeurage5='';


function switchGeneral(id) {
	var all = 6;
	for(i=1;i<all;i++) {
		try{
			if (i == id) {
				$('sec_li_'+i).setAttribute("class","nodelete current");
				loadCecodi(i,'variant','');
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

// load cecodi dans la modification ou l'ajout
function loadCecodi(id,type,cecodi_id){
	if ($('table_'+id).innerHTML=='') {
		$('table_'+id).innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
		new Ajax.Request('../cecodis/load_cecodi.php',
			{
				method:'get',
				parameters: {id: id, type: type, cecodi_id: cecodi_id},
	  			onSuccess: function(transport){
					$('table_'+id).innerHTML = transport.responseText;
					cecodiChangeType();
					extendCecodi();
		    },
		    onFailure: function(){ $('table_'+id).innerHTML = ('Erreur... contact targoo@gmail.com') }
		});
	} else {
		//cecodiChangeType();
		//extendCecodi();
	}
}

// extend code cecodi sur variant
function extendCecodi() {
	var cecodi = $('cecodi1').value;
	for(i=1;i<6;i++) {
		try{
			$('cecodi'+i).value=cecodi;
		} catch(e){};
	}
}


function cecodiChangeType() {
	var propriete = $('propriete1').value;
	for(i=1;i<6;i++) {
		try{
			$('propriete'+i).value = propriete;
			if(propriete == 'autre') {
				Element.hide('formHonoTravailleur'+i);
				Element.hide('formAVipo'+i);
				Element.hide('formBTiersPayant'+i);
				Element.hide('formKDB'+i);
				Element.hide('formBC'+i);
				Element.hide('hono_travailleur'+i+'alert');
				Element.hide('a_vipo'+i+'alert');
				Element.hide('b_tiers_payant'+i+'alert');
				Element.hide('kdb'+i+'alert');
				Element.hide('bc'+i+'alert');
			}
			if(propriete == 'acte') {
				Element.hide('formHonoTravailleur'+i);
				Element.hide('formAVipo'+i);
				Element.hide('formBTiersPayant'+i);
				Element.show('formKDB'+i);
				Element.show('formBC'+i);
				Element.hide('hono_travailleur'+i+'alert');
				Element.hide('a_vipo'+i+'alert');
				Element.hide('b_tiers_payant'+i+'alert');
				Element.hide('kdb'+i+'alert');
				Element.hide('bc'+i+'alert');
			}
			if(propriete == 'consultation') {
				Element.show('formHonoTravailleur'+i);
				Element.show('formAVipo'+i);
				Element.show('formBTiersPayant'+i);
				Element.hide('formKDB'+i);
				Element.hide('formBC'+i);
				Element.hide('hono_travailleur'+i+'alert');
				Element.hide('a_vipo'+i+'alert');
				Element.hide('b_tiers_payant'+i+'alert');
				Element.hide('kdb'+i+'alert');
				Element.hide('bc'+i+'alert');
			}

		} catch(e){ };
	}
}


function cecodiRechercheDirect() {
	$('findCecodiInput').value=$('cecodi1').value;
	cecodi_recherche_simple($('findCecodiInput').value);
}

function cecodiSuppresion(id) {
   	if(id != '') {
		new Ajax.Request('../cecodis/cecodi_action.php',
		{
			method:'get',
			parameters: {type : 'del_cecodi', id :id},
			asynchronous:false,
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
    			$('Info').innerHTML = json.root.content;
    			cecodiRechercheComplete($('cecodi1').value);
    	    },
		    onFailure:  function(){ $('Info').innerHTML = "failure";} 
		}); 	
	}
}

function cecodiChangeValeur(id,champs,valeur) {
   	if(id != '' && valeur != '') {
		new Ajax.Request('../cecodis/cecodi_action.php',
		{
			method:'get',
			parameters: {type : 'change_cecodi', id :id, champs : champs, valeur : valeur},
			asynchronous:false,
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
    			$('Info').innerHTML = json.root.content;
    	    },
		    onFailure:  function(){ $('Info').innerHTML = "failure";} 
		}); 	
 	}
}

// recherche complete d'une prestation inami
function cecodiRechercheComplete(pseudo){
	if(pseudo !='') {
		cecodiRechercheDirect();
		$('cecodiBox').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
		new Ajax.Request('../cecodis/cecodi_recherche_complete.php',
			{
				method:'get',
				parameters: {pseudo: pseudo},
				requestHeaders: {Accept: 'application/json'},
	  			onSuccess: function(transport, json){
	  				$('cecodiBox').innerHTML = transport.responseText;
	 		    },
			    onFailure:  function(){ alert("failure");} 
			});
	} else {
		$('cecodiBox').innerHTML = "";
	}
}

// ouvrir un ceocdi existant
function submitForm()  {
	
	var verif = true;

	for(i=1;i<6;i++) {

		try{
		
			// verif cecodi
			if ($('cecodi'+i).value.length!=6) {
				Element.show('cecodi'+i+'alert');
				verif = false;
			} else {
				Element.hide('cecodi'+i+'alert');
			}
			
			// verif propriete
			switch ( $('propriete'+i).value ) {
				case 'consultation':
					Element.hide('propriete'+i+'alert');
					if ($('hono_travailleur'+i).value=='' && $('a_vipo'+i).value=='' && $('b_tiers_payant'+i).value=='') {
						Element.show('hono_travailleur'+i+'alert');
						Element.show('a_vipo'+i+'alert');
						Element.show('b_tiers_payant'+i+'alert');
						if (i==1) { verif = false };
					} else {
						if ($('hono_travailleur'+i).value=='') {
							Element.show('hono_travailleur'+i+'alert');
							verif = false
						} else {
							Element.hide('hono_travailleur'+i+'alert');
						}
						if ($('a_vipo'+i).value=='') {
							Element.show('a_vipo'+i+'alert');
							verif = false
						} else {
							Element.hide('a_vipo'+i+'alert');
						}
						if ($('b_tiers_payant'+i).value=='') {
							Element.show('b_tiers_payant'+i+'alert');
							verif = false
						} else {
							Element.hide('b_tiers_payant'+i+'alert');
						}
					}
					break;

				case 'acte':
					Element.hide('propriete'+i+'alert');
					if ($('kdb'+i).value=='' && $('bc'+i).value=='' ) {
						Element.show('kdb'+i+'alert');
						Element.show('bc'+i+'alert');
						//verif = false;
					} else {
						if ($('kdb'+i).value=='') {
							Element.show('kdb'+i+'alert');
							verif = false
						} else {
							Element.hide('kdb'+i+'alert');
						}
						if ($('bc'+i).value=='') {
							Element.show('bc'+i+'alert');
							verif = false
						} else {
							Element.hide('bc'+i+'alert');
						}
					}
					break;
			
				default:
					Element.show('propriete'+i+'alert');
					verif = false;
					break;
			}
				
		
		} catch(e){};
	}
	 	
 return verif;
 //return true;
}

