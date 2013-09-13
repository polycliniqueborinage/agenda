// update Tarification Form
function CodeTarificationUpdateForm() {
	$('general').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
	new Ajax.Request('../configurations/code_tarification_update_form.php',
		{
			method:'get',
			parameters: {},
			asynchronous:false,
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
  				$('general').innerHTML = transport.responseText;
  			},
		    onFailure:  function(){ $('general').innerHTML = "failure";} 
		});
}

function modifChamp(id, champs, valeur) {
	new Ajax.Request('../configurations/code_tarification_action.php',
		{
			method:'get',
			parameters: {type: 'modif_code', id :id , champs : champs, valeur : htmlentities(valeur)},
			asynchronous:false,
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
    			$('calendarSideBar').innerHTML = json.root.content + $('calendarSideBar').innerHTML;
    	    },
		    onFailure:  function(){ alert("failure");} 
		});
}

function supprimeCodeTarification(id) {
	new Ajax.Request('../configurations/code_tarification_action.php',
		{
			method:'get',
			parameters: {type: 'del_code', id :id },
			asynchronous:false,
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
    			$('calendarSideBar').innerHTML = json.root.content + $('calendarSideBar').innerHTML;
    			CodeTarificationUpdateForm();
    	    },
		    onFailure:  function(){ alert("failure");} 
		});
}
						
function change_color(id,valeur) {
	var hex = valeur.toUpperCase();
	var	currentdiv = document.getElementById('show'+id);
	for(i=0; i<hex.length; i++) {
		if(hex.charAt(i) < '0' || hex.charAt(i) > 'F') {
			currentdiv.value='';
		} else {
			currentdiv.setAttribute("style","font-weight: bold; color: #" + hex );
		}
	}
}