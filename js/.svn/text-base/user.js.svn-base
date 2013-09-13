function actionUser(id, type, value) {
	switch( type ) {
		case 'del_user':
			new Ajax.Request('../configurations/user_action.php',
				{
					method:'get',
					parameters: {id : id, type : type, value : value},
					asynchronous:false,
					requestHeaders: {Accept: 'application/json'},
		  			onSuccess: function(transport, json){
		  				$('calendarSideBar').innerHTML = json.root.content + $('calendarSideBar').innerHTML;
		  				parent.window.location.href=parent.window.location.href;
		    	    },
				    onFailure:  function(){ alert("failure");} 
				});
			break;
		case 'login':
			if (value.length<6 || (htmlentities(value)!=value || value.indexOf("'", 0) > 0 )) {
				$('calendarSideBar').innerHTML = "<b>Entrez un login valide! (minimum six caractères, pas d'accent...)</b><br/><br/>" + $('calendarSideBar').innerHTML;
			} else {
				new Ajax.Request('../configurations/user_action.php',
					{
						method:'get',
						parameters: {id : id, type : type, value : value},
						asynchronous:false,
						requestHeaders: {Accept: 'application/json'},
			  			onSuccess: function(transport, json){
			  				$('calendarSideBar').innerHTML = json.root.content + $('calendarSideBar').innerHTML;
			    	    },
					    onFailure:  function(){ alert("failure");} 
					});
			}
			break; // End execution
		case 'password':
			if (value.length<6 || (htmlentities(value)!=value || value.indexOf("'", 0) > 0 )) {
				$('calendarSideBar').innerHTML = "<b>Entrez un mot de passe valide! (minimum six caractères, pas d'accent...)</b><br/><br/>" + $('calendarSideBar').innerHTML;
			} else {
				new Ajax.Request('../configurations/user_action.php',
					{
						method:'get',
						parameters: {id : id, type : type, value : value},
						asynchronous:false,
						requestHeaders: {Accept: 'application/json'},
			  			onSuccess: function(transport, json){
			  				$('calendarSideBar').innerHTML = json.root.content + $('calendarSideBar').innerHTML;
			    	    },
					    onFailure:  function(){ alert("failure");} 
					});
			}
			break; // End execution
		case 'nom':
		case 'prenom':
			new Ajax.Request('../configurations/user_action.php',
				{
					method:'get',
					parameters: {id : id, type : type, value : htmlentities(value)},
					asynchronous:false,
					requestHeaders: {Accept: 'application/json'},
		  			onSuccess: function(transport, json){
		  				$('calendarSideBar').innerHTML = json.root.content + $('calendarSideBar').innerHTML;
		    	    },
				    onFailure:  function(){ alert("failure");} 
				});
			break; // End execution
		default:
			new Ajax.Request('../configurations/user_action.php',
				{
					method:'get',
					parameters: {id : id, type : type, value : value},
					asynchronous:false,
					requestHeaders: {Accept: 'application/json'},
		  			onSuccess: function(transport, json){
		  				$('calendarSideBar').innerHTML = json.root.content + $('calendarSideBar').innerHTML;
		    	    },
				    onFailure:  function(){ alert("failure");} 
				});
	}
}
						
function disable_inami(idInami,idAgenda,application) {
	
	if (application.indexOf('agenda')>0) {
		document.getElementById('inami'+idInami).disabled = false;
		document.getElementById('agenda'+idAgenda).disabled = false;
	} else {
		document.getElementById('inami'+idInami).disabled = true;
		document.getElementById('inami'+idInami).value = '';
		document.getElementById('agenda'+idAgenda).disabled = true;
		document.getElementById('agenda'+idAgenda).value = '';
	}
						
}

