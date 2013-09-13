<?php
class rateTool {

	//var $rateClass; //Tableau contenant les erreurs détectées
  	var $rateSelected; //Variable contenant le nombre d'erreurs détectées
  	
  	//Constructeur de la classe ici on passe en paramêtre le nom du style d'erreur par defaut.
  	function rateTool()	{
  	
	}
	
	function init(){
		//$this->rateClass = array('1' => 'rating_off', '2' => 'rating_off', '3' => 'rating_off', '4' => 'rating_off', '5' => 'rating_off');
		$this->rateSelected = array('1' => '', '2' => '', '3' => '', '4' => '', '5' => '');
	}
	
	function transform($value){
		//for ($i=1; $i<=$value; $i++) {
		//	$this->rateClass[$i] = 'rating_on';
		//}
		$this->rateSelected[$value]='selected';
	}
	
	function getclass($value){
		return $this->rateClass[$value];
	}
	
	function getselected($value){
		return $this->rateSelected[$value];
	}
	
}

// gestion des dates
class dateTools {

  	var $Date1; 
  	var $Day1; 
  	var $Month1; 
  	var $Year1; 
  	
  	var $Date2; 
  	var $Day2; 
  	var $Month2; 
  	var $Year2;
  	
  	// format year-mons-day
  	function dateTools($date1,$date2)	{
  		$this->Date1 = $date1;
   		$this->Date2 = $date2;

   		$tok = strtok($date1,"-");
		$this->Year1 = $tok;
		$tok = strtok("-");
		$this->Month1 = $tok;
		$tok = strtok("-");
		$this->Day1 = $tok;
		
   		$tok = strtok($date2,"-");
		$this->Year2 = $tok;
		$tok = strtok("-");
		$this->Month2 = $tok;
		$tok = strtok("-");
		$this->Day2 = $tok;
  	}
  	
	function changeDATE($nbr) {
		return date("Y-m-d", mktime(0, 0, 0, $this->Month1, $this->Day1 + $nbr, $this->Year1)); 
	}

	function transformDATE() {
		//setlocale(LC_TIME, 'fr');
		setlocale(LC_TIME, fr_FR);
		$date = $this->Month1."/".$this->Day1."/".$this->Year1;
		return ucfirst(strftime('%A, %d %B %Y',strtotime($date)));
	}

	function transformDATE2() {
		return $this->Day1."/".$this->Month1."/".$this->Year1;
	}
	
	function get2DATES() {
		return $this->Day1.".".$this->Month1.".".$this->Year1."-".$this->Day2.".".$this->Month2.".".$this->Year2;
	}
	
	function weekDATE() {
		$w = date('w',mktime(0, 0, 0, $this->Month1 , $this->Day1 , $this->Year1));
		$m = date('m',mktime(0, 0, 0, $this->Month1 , $this->Day1 , $this->Year1));
		$d = date('d',mktime(0, 0, 0, $this->Month1 , $this->Day1 , $this->Year1));
		$Y = date('Y',mktime(0, 0, 0, $this->Month1 , $this->Day1 , $this->Year1));
		
		$nbr = (0 - $w);
		
		$sunday = date ("Y-m-d",mktime(0, 0, 0, $m , $d + $nbr, $Y));
		$week['sunday'] = $sunday; 
		$week['sundayclass'] = ($w == '0') ? "today" : "";
		$nbr++;
		
		$monday = date ("Y-m-d",mktime(0, 0, 0, $m , $d + $nbr, $Y));
		$week['monday'] = $monday; 
		$week['mondayclass'] = ($w == '1') ? "today" : "";
		$nbr++;
		
		$tuesday = date ("Y-m-d",mktime(0, 0, 0, $m , $d + $nbr, $Y));
		$week['tuesday'] = $tuesday;
		$week['tuesdayclass'] = ($w == '2') ? "today" : "";
		$nbr++;
	
		$wednesday = date ("Y-m-d",mktime(0, 0, 0, $m , $d + $nbr, $Y));
		$week['wednesday'] = $wednesday;
		$week['wednesdayclass'] = ($w == '3') ? "today" : "";
		$nbr++;
	
		$thursday = date ("Y-m-d",mktime(0, 0, 0, $m , $d + $nbr, $Y));
		$week['thursday'] = $thursday;
		$week['thursdayclass'] = ($w == '4') ? "today" : "";
		$nbr++;
	
		$friday = date ("Y-m-d",mktime(0, 0, 0, $m , $d + $nbr, $Y));
		$week['friday'] = $friday;
		$week['fridayclass'] = ($w == '5') ? "today" : "";
		$nbr++;
	
		$saturday = date ("Y-m-d",mktime(0, 0, 0, $m , $d + $nbr, $Y));
		$week['saturday'] = $saturday;
		$week['saturdayclass'] = ($w == '6') ? "today" : "";
		
		return $week;
	}
	
	  	
	//Constructeur de 
  	function getAge()	{
	
		$age = $this->Year2 - $this->Year1;
		
		if ($this->Month2<$this->Month1) {
			$age --;
		} else {
			if ($this->Month2==$this->Month1 && $this->Day2<$this->Day1) {
				$age --;
			}
		}
		
 		return $age;
	}
	
	function distributDATE($granularity) {
		
		$daystart = mktime(0, 0, 0, $this->Month1 , $this->Day1 , $this->Year1);
		$dayend = mktime(0, 0, 0, $this->Month2 , $this->Day2 , $this->Year2);
		$intervale = array();
		
		for($i = 0 ; $i <= $granularity ; $i++) 	{
			$intervale[$i] = $daystart + ((($dayend-$daystart)/$granularity)*$i);
		}
		
		return $intervale;
		
	}
	
	function compare($compare) {
		
		$daystart = mktime(0, 0, 0, $this->Month1 , $this->Day1 , $this->Year1);
		$dayend = mktime(0, 0, 0, $this->Month2 , $this->Day2 , $this->Year2);
		
		$intervale = array();
		
		$intervale[0] = $daystart + (($dayend-$daystart)*$compare);
		$intervale[1] = $dayend + (($dayend-$daystart)*$compare);
		
		return $intervale;
		
	}
	
}

// Se connecte à la DB
function connexion_DB($name_DB) {
	$host = "localhost";  
	$user = "poly";
	$bdd = $name_DB;
	$passwd  = "halifax";
	mysql_connect($host, $user,$passwd) or die("erreur de connexion au serveur");
	mysql_select_db($bdd) or die("erreur de connexion a la base de donnees");
}

// --------------------------------------------------------------------------------------------------------------------------
// Deconnection de la DB
function deconnexion_DB() {
	mysql_close();
}

function convertIntoEntity($var) {
	$specificCaractere = array("é", "è", "à");
	$htmlEntity = array("&eacute;", "&eagrave;", "&agrave;");
	$var = str_replace($specificCaractere, $htmlEntity, $var);
	return $var;
}

function requete_SQL($strSQL) {
	$result = mysql_query($strSQL);
	if (!$result) {
		$message  = 'Erreur SQL : ' . mysql_error() . "<br>\n";
		$message .= 'SQL string : ' . $strSQL . "<br>\n";
		$message .= "Merci d'envoyer ce message au webmaster - targoo@gmail.com";
		die($message);
	}
	return $result;
}

function get_MENUBAR_START() {

	echo "<div id='productsandservices' class='yuimenubar yuimenubarnav' style='display: none'>";
	echo "		<div class='bd'>";
	echo "			<ul class='first-of-type'>";
	echo "				<li class='yuimenubaritem first-of-type'><a href='../../login/index.php'>Logout</a></li>";
	echo "				<li class='yuimenubaritem'>Navigation";
	echo "					<div id='communication' class='yuimenu'>";
	echo "					<div class='bd'>";
	echo "						<ul>";
	echo "							<li class='yuimenuitem'>Agendas";
	echo "		                        <div id='agenda' class='yuimenu'>";
	echo "                             		<div class='bd'>";
	echo "                                    	<ul class='first-of-type'>";
	echo "                                        	<li class='yuimenuitem'><a class='yuimenuitemlabel' href='../agendas/day.php'>Agenda journalier</a></li>";
	echo "                                        	<li class='yuimenuitem'><a class='yuimenuitemlabel' href='../agendas/week.php'>Agenda hebdomadaire</a></li>";
	echo "                                      	<li class='yuimenuitem'><a class='yuimenuitemlabel' href='../agendas/planning.php'>Gestion des horaires hebdomadaires</a></li>";
	echo "                                  	</ul>";
	echo "                              	</div>";
	echo "                          	</div>  ";
	echo "                          </li>";
	echo "                        </ul>";
	echo "                     </div>";
	echo "                	</div>";  
	echo "             	</li>";
	
}

function get_MENUBAR_END() {

	connexion_DB('poly');
	$result = requete_SQL ("SELECT id, titre, textarea FROM notices");
	$n = mysql_num_rows($result);
	if ($n != 0) {
		echo "              <li class='yuimenubaritem'>Notices";
		echo "              	<div id='notice' class='yuimenu'>";
		echo "                		<div class='bd'>";             
		echo "                      	<ul>";
		while($data = mysql_fetch_assoc($result)) 	{
			echo "                        	<li class='yuimenuitem'>";
			echo "								<a onclick='openNotice(".$data['id'].");' title='' >".$data['titre']."</a>";
			echo "							</li>";
		}
		echo "                        	</ul>";
		echo "                		</div>";
		echo "              	</div>";
		echo "              </li>";
	}
	deconnexion_DB();
	
	echo "              <li class='yuimenubaritem'>Aides";
	echo "              	<div id='help' class='yuimenu'>";
	echo "                		<div class='bd'>";             
	echo "                      	<ul>";
	echo "                            	<li class='yuimenuitem'>";
	echo "									<a onclick='openHelp()' title='Aide sur la page en cours' >Aide</a>";
	echo "								</li>";
	echo "                            	<li class='yuimenuitem'>Version 2.0</a></li>";
	echo "                        	</ul>                    ";
	echo "                		</div>";
	echo "              	</div>";
	echo "              </li>";
	echo "           	</ul>";
	echo "              <div class='date'>";
	echo $_SESSION['nom']." ".$_SESSION['prenom']." - ".$_SESSION['role']." - Application Polyclinique - ".date("d/m/Y");
	echo "             	</div>";
	echo "    		</div>";
	echo "    </div>";
	
}

function get_MENUBAR_PATIENT(){

	echo "<li class='yuimenuitem'>Patients";
	echo "	<div id='patient2' class='yuimenu'>";
	echo "		<div class='bd'>";
	echo "			<ul class='first-of-type'>";
	echo "				<li class='yuimenuitem' id='patientmenu'><a class='yuimenuitemlabel' href='../patients/recherche_patient.php'>Recherche et modification du patient&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>";
	echo "				<li class='yuimenuitem' id='titulairemenu'><a class='yuimenuitemlabel' href='../patients/recherche_patient.php'>Recherche et modification du titulaire&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>";
	echo "			</ul>";
	echo "		</div>";
	echo "	</div>  ";
	echo "</li>";

}

function get_MENU($current) {

	$menu = array('agendas' => '');
	$menu[$current]='current';
	echo "<li class='nodelete ".$menu['agendas']."'>";
	echo "<a class='nodelete' href='../agendas/day.php'>Agendas</a>";
	echo "</li>";

}

function get_DAY($date) {

	$tok = strtok($date,"-");
	$year = $tok;
	$tok = strtok("-");
	$month = $tok;
	$tok = strtok("-");
	$day = $tok;
	
	return date('w',mktime(0, 0, 0, $month , $day , $year));

}


?>
