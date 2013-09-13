// recherche complete d'une prestation inami
function acteRechercheComplete(acte){
  	if(trim(acte)!='') {
		$('acteBox').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
		new Ajax.Request('../lib/acte_recherche_complete.php',
			{
				method:'get',
				parameters: {acte: htmlentities(acte)},
				requestHeaders: {Accept: 'application/json'},
	  			onSuccess: function(transport, json){
	    			var content = json.root.content;
	    			$('acteBox').innerHTML = content;
	 		    },
			    onFailure:  function(){ alert("failure");} 
			});
	} else {
		$('acteBox').innerHTML = "";
	}
}


// recherche direct
function acteRechercheDirect() {
	var acte = $('description').value;
	$('findActeInput').value=acte;
 	acte_recherche_simple(acte);
}


// action au niveau de la recherche
function acteAction(type,id) {
	new Ajax.Request('../actes/acte_action.php',
		{
			method:'get',
			parameters: {type: type, id: id},
			asynchronous:true,
			requestHeaders: {Accept: 'application/json'},
	  		onSuccess: function(transport, json){
	  			$('Info').innerHTML=json.root.info;
  				acteRechercheComplete($('pseudo').value);
    	    },
		    onFailure:  function(){ $('tarificationBox').innerHTML = "failure";} 
		});
}