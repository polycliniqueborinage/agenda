// add or remove a new prestation
var oldid ="";

function submitForm(del_notice) {
	var new_titre = $('new_titre').value;
	new Ajax.Request('../configurations/notice_submit_form.php',
		{
			method:'get',
			parameters: {new_titre : htmlentities(new_titre), del_notice : del_notice},
			asynchronous:false,
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
  				$('calendarSideBar').innerHTML = json.root.content + $('calendarSideBar').innerHTML;
  				$('new_titre').value = "";
  				noticeUpdateForm();
  				switchGeneralInfo('general');
    	    },
		    onFailure:  function(){ alert("failure");} 
		});
	return false;
}


// update Tarification Form
function noticeUpdateForm() {
	new Ajax.Request('../configurations/notice_update_form.php',
		{
			method:'get',
			parameters: {},
			asynchronous:true,
			requestHeaders: {Accept: 'application/json'},
  			onSuccess: function(transport, json){
    			$('general').innerHTML = json.root.notice;
    	    },
		    onFailure:  function(){ $('BoxListCecodi').innerHTML = "failure";} 
		});
}

function changeNotice(id) {
	
	if(id != '') {
	
		$('globalText').innerHTML = "<img class='centerimage' src='../images/attente.gif'/>";
		
		new Ajax.Request('../lib/aide_en_ligne.php',
		{
			method:'get',
			parameters: {id: id, type : 'notice_modif'},
  			onSuccess: function(transport){
  				var all = "<textarea id='TextArea1' name='TextArea1' rows='10' cols='160' style='width:100%'>";
				all += transport.responseText;;
				all += "</textarea>";
  				$('globalText').innerHTML = all;
				areaedit_init();
 		    },
		    onFailure:  function(){ alert("failure");} //Dialog.alert(comment, {width:300, okLabel: "OUI", cancelLabel: "Annuler", className: "alphacube", buttonClass: "myButtonClass", id: "myDialogId", ok:function(win) {return true;} });
		});
		
		var element = document.getElementById(id);
		element.setAttribute("class","required");
		
		if (oldid!='') {
			var element = document.getElementById(oldid);
			element.setAttribute("class","");
		}
		
		oldid = document.getElementById('id').value=id;
		
	}
}