// detail d'un medecin 
function changeAide(id) {
	$('globalText').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
	new Ajax.Request('../lib/aide_en_ligne.php',
		{
			method:'get',
			parameters: {id: id, type : 'aide_modif'},
  			onSuccess: function(transport){
  				var all = "<textarea id='TextArea1' name='TextArea1' rows='10' cols='160' style='width:100%'>";
				all += transport.responseText;
				all += "</textarea>";
  				$('globalText').innerHTML = all;
				areaedit_init();
 		    },
		    onFailure:  function(){ alert("failure");} //Dialog.alert(comment, {width:300, okLabel: "OUI", cancelLabel: "Annuler", className: "alphacube", buttonClass: "myButtonClass", id: "myDialogId", ok:function(win) {return true;} });
		});
}

