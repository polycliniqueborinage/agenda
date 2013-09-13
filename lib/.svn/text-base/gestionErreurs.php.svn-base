<?php

class testTools {
  	var $errTab; //Tableau contenant les erreurs détectées
  	var $Count; //Variable contenant le nombre d'erreurs détectées
  	var $ListeErreur; //Variable contenant la liste des erreurs détectées
  	var $fstyle; //Nom du style CSS par défaut quand il y a une erreur.

  	//Constructeur de la classe ici on passe en paramêtre le nom du style d'erreur par defaut.
  	function testTools($fstyle)	{
   		$this->Count=0;
   		$this->ListeErreur='';
   		$this->fstyle=$fstyle;
	}

	//Fonction qui permet de securiser un champ texte de manière à pouvoir être stocké dans une base de données.
  	//Si vous voulez autoriser les tag HTML alors il faut mettre la ligne du strip_tags en commentaire.
  	function secure($var){
   		$vars=$var;
   		if (!is_numeric($var))   		{
     		//$vars=htmlentities($vars);
     		$vars=strip_tags($vars);
   		}
   	return $vars;
	}

		
	//Fonction qui permet de securiser un champ texte de manière à pouvoir être stocké dans une base de données.
 	function convert($var){
   		$vars=$var;
   		$vars=addslashes($vars);
   		$vars=strip_tags($vars);
		$vars=trim($vars);
		return $vars;
	}

 	function unconvert($var){
		$vars=html_entity_decode(htmlentities(stripcslashes($var),ENT_QUOTES));
   		return $vars;
 	}

	function deconvert($var){
  		$vars=$var;
   		$vars=stripcslashes($vars,ENT_QUOTES);
   		$vars=html_entity_decode($vars);
   		return $vars;
 	}

	function inamconvert($vars)	{
    		$vars=$vars;
			$compt=0;
			echo $vars;
				
    		while (!is_numeric($vars)) {
				
				$var = $vars[$compt];
				echo " ".$var;
					if (($var!='1')&&($var!='2')&&($var!='3')&&($var!='4')&&($var!='5')&&($var!='6')&&($var!='7')&&($var!='8')&&($var!='9')) {
						$vars = str_replace($var,"",$vars);
						echo "test".$vars;
						$compt = -1;
					}
				$compt++;
			}

    		return $vars;
  		}


  	//Fonction principale de la classe qui ajoute un nom de style CSS à un nom de champ de formulaire.
	function add($title,$style,$comment)	{
    	$this->errTab[0][$this->Count]=$title;
    	$this->errTab[1][$this->Count++]=$style;
    	if ($this->ListeErreur ==""){
    		$this->ListeErreur = $comment;
    	} else {
	    	$this->ListeErreur = $this->ListeErreur.", ".$comment;
    	}
  	}

  	//Fonction qui permet d'effectuer un test sur un champ de type EMAIL.
  	function mailtest($var,$name,$comment) {
    	if (strlen(trim($var))!=0) 	{
			if (!eregi("^[_a-z0-9-]+(\\.[_a-z0-9-]+)*@([0-9a-z](-?[0-9a-z])*\\.)+[a-z]{2}([zmuvtg]|fo|me)?$",$var))
      		$this->add($name,$this->fstyle,$comment);    
		}
	}

  	//Fonction qui permet d'effectuer un test sur un champ de type INT.
  	function inttest($var,$name,$comment){
	   	if (($var==0)||(!is_numeric($var)))
    	$this->add($name,$this->fstyle,$comment);
  	}

	//Fonction qui permet d'effectuer un test sur un champ de type INT POS.
  	function intpostest($var,$name,$comment){
	   	if (($var==0)||($var<0)||(!is_numeric($var)))
    	$this->add($name,$this->fstyle,$comment);
  	}

	//Fonction qui permet d'effectuer un test sur un champ de type INT POS.
  	function intpostestzero($var,$name,$comment){
	   	if (($var<0)||(!is_numeric($var)))
    	$this->add($name,$this->fstyle,$comment);
  	}

  	//Fonction qui permet d'effectuer un test sur un champ de type TIME.
  	function timetest($varh,$varm,$vars,$name,$comment){
	   	if ((($varh>24)||($varm>59)||($vars>59))||(($varh<0)||($varm<0)||($vars<0)))
      	$this->add($name,$this->fstyle,$comment);
  	}

  	//Fonction qui permet d'effectuer un test sur un champ de type URL.
  	function urltest($var,$name,$comment) {
		if ((substr($var,0,4)!="www.")&&(substr($var,0,7)!="http://"))
      	$this->add($name,$this->fstyle,$comment);    
  	}

  	//Fonction qui permet d'effectuer un test sur un champ de type STRING.
  	function stringtest($var,$name,$comment){
    	if (strlen(trim($var))==0)
      	$this->add($name,$this->fstyle,$comment);    
  	}

  	  //Fonction qui permet d'effectuer un test sur un champ de type CT1CT2.
  	function ctstest($var,$name,$comment){
    	if (trim($var)=='')
      	$this->add($name,$this->fstyle,$comment);    
  	}
  	
  	//Fonction qui permet d'effectuer un test sur un champ de type Password / todo securite minimal.
  	function passwordtest($var,$name,$comment,$comment2){
    	if (strlen(trim($var))<6) {
      		$this->add($name,$this->fstyle,$comment);
    	} else {
    		// autre test  
    	}
  	}
  	
  	
	//Fonction qui permet d'effectuer un test sur un code mutuelle.
	function stringcodemutuelle($var,$name,$comment){
   	if ((strlen(trim($var))==0)||($var!=0))
      	$this->add($name,$this->fstyle,$comment);    
   	}

	//Fonction qui permet d'effectuer un test sur un champ qui contient un numeor de cecodi
	function cecoditest($var,$name,$comment){
    	if (strlen(trim($var))!=6||(!is_numeric($var)))
      	$this->add($name,$this->fstyle,$comment);    
	}

	//Fonction qui permet d'effectuer un test sur un champ qui contient un nummeor INAMI
	function codemututest($var,$name,$comment)	{
	   	if (strlen(trim($var))!=3||(!is_numeric($var)))
	   	$this->add($name,$this->fstyle,$comment);    
  	}
  		
  		
		//Fonction qui permet d'effectuer un test sur un champ qui contient un nummeor INAMI
  		function inamitest($var,$name,$comment)	{
	    	if (strlen(trim($var))!=11||(!is_numeric($var)))
	      	$this->add($name,$this->fstyle,$comment);    
  		}

		//Fonction qui permet d'effectuer un test sur une liste qui contient le type du cecodi
  		function propriete_cecoditest($var,$name,$comment)	{
	    	if ($var=='autre')
	      	$this->add($name,$this->fstyle,$comment);    
  		}

  		//Fonction qui permet d'effectuer un test sur un numero de securité sociale
  		function sistest($var,$name,$comment)
  		{
			if (strlen(trim($var))!=0) 	{
			    	if (strlen(trim($var))!=10||(!is_numeric($var)))
      				$this->add($name,$this->fstyle,$comment);  
			}  
  		}

  		//Fonction qui permet d'effectuer un test sur le numero de registre nationale
  		function nisstest($var,$name,$comment)
  		{
    		if (strlen(trim($var))!=0) 	{
				if (strlen(trim($var))!=11||(!is_numeric($var)))
      				$this->add($name,$this->fstyle,$comment);
			}    
 	 	}
    
		//Fonction qui permet d'effectuer un test sur le code CT1 CT2
  		function cttest($var,$name,$comment){
	    	if ($var=='000')
	      	$this->add($name,$this->fstyle,$comment);    
  		}
    
		//Fonction qui permet d'effectuer un test sur le type
  		function typetest($var,$name,$comment){
	    	if (($var!='tr')&&($var!='vp')&&($var!='prpe')&&($var!='pe')&&($var!='in'))
	      	$this->add($name,$this->fstyle,$comment);    
  		}
		
		//Fonction qui permet d'effectuer un test sur la mutuelle
  		function mutuelletest($var,$name,$comment){
	    	if ($var=='choisir')
	      	$this->add($name,$this->fstyle,$comment);    
  		}
    
  		//Fonction qui permet d'effectuer un test sur un champ de type DATE.
  		function datetest($var1,$var2,$var3,$name,$comment)	{
			if (strlen(trim($var1))==0||(!is_numeric($var1))||strlen(trim($var2))==0||(!is_numeric($var2))||strlen(trim($var3))==0||(!is_numeric($var3))) {
	      		$this->add($name,$this->fstyle,$comment);
			}
			else {  
	  			if (!checkdate($var2,$var1,$var3))
	      		$this->add($name,$this->fstyle,$comment);    
	  		}
		}

  		//Fonction qui recherche un style CSS associé à un champ donné.
  		function fieldError($name,$default) {
	    	if (is_array($this->errTab[0]))
	      	foreach($this->errTab[0] as $key => $value)	{
	        	if ($value==$name)
		          	return $this->errTab[1][$key];
      		}
	    	return $default;
  			}
}	

	

?>
