function create_champ(i) {

var i2 = i + 1;

document.getElementById('cecodi'+i).innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cecodi "+i;
document.getElementById('cecodi'+i).innerHTML += "&nbsp;&nbsp;&nbsp;&nbsp";
document.getElementById('cecodi'+i).innerHTML += "<input type='text' name='cecodi_"+i+"' id='cecodi_"+i+"' onKeyUp='javascript:checkCecodi(this);'/>";
document.getElementById('cecodi'+i).innerHTML += "</span>";
document.getElementById('cecodi'+i).innerHTML += (i <= 400) ? '<br /><span id="cecodi'+i2+'"><input type="hidden" name="nombreCecodi" value="'+i+'" /><a href="javascript:create_champ('+i2+')">Ajouter un champs</a></span>' : '';

}
						
