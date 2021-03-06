<?php 

	// Demarre une session
	session_start();

	// Validation du Login
	// SECURISE
	if(isset($_SESSION['application'])) {
		if ($_SESSION['application']=="|agenda|") {
			// login ok
		}else {
			// redirection
			header('Location: ../../login/index.php');
			die();
		}
	} else {
		// redirection
		header('Location: ../../login/index.php');
		die();
	}
	// SECURITE
	
	// Inclus le fichier contenant les fonctions personalis�es
	include_once '../lib/fonctions.php';
	
	$jsID = $_GET['id'];
		
	$sessionDateCurrent = isset($_SESSION['dateCurrent']) ? $_SESSION['dateCurrent'] : date("Y-m-d");
	$datetools = new dateTools($sessionDateCurrent,$sessionDateCurrent);
	
	$sessionMedecinCurrent = isset($_SESSION['medecinCurrent']) ? $_SESSION['medecinCurrent'] : '';
	
	define('FPDF_FONTPATH','font/');

	require('../factures/fpdf_js.php');


	class RPDF extends PDF_Javascript {
	function AutoPrint($dialog=false)	{
	    //Lance la bo�te d'impression ou imprime immediatement sur l'imprimante par d�faut
	    $param=($dialog ? 'true' : 'false');
	    $script="print($param);";
	    $this->IncludeJS($script);
	}
	function TextWithDirection($x,$y,$txt,$direction='R'){
	    $txt=str_replace(')','\\)',str_replace('(','\\(',str_replace('\\','\\\\',$txt)));
	    if ($direction=='R')
	        $s=sprintf('BT %.2f %.2f %.2f %.2f %.2f %.2f Tm (%s) Tj ET',1,0,0,1,$x*$this->k,($this->h-$y)*$this->k,$txt);
	    elseif ($direction=='L')
	        $s=sprintf('BT %.2f %.2f %.2f %.2f %.2f %.2f Tm (%s) Tj ET',-1,0,0,-1,$x*$this->k,($this->h-$y)*$this->k,$txt);
	    elseif ($direction=='U')
	        $s=sprintf('BT %.2f %.2f %.2f %.2f %.2f %.2f Tm (%s) Tj ET',0,1,-1,0,$x*$this->k,($this->h-$y)*$this->k,$txt);
	    elseif ($direction=='D')
	        $s=sprintf('BT %.2f %.2f %.2f %.2f %.2f %.2f Tm (%s) Tj ET',0,-1,1,0,$x*$this->k,($this->h-$y)*$this->k,$txt);
	    else
	        $s=sprintf('BT %.2f %.2f Td (%s) Tj ET',$x*$this->k,($this->h-$y)*$this->k,$txt);
	    if ($this->ColorFlag)
	        $s='q '.$this->TextColor.' '.$s.' Q';
	    $this->_out($s);
	}

	function TextWithRotation($x,$y,$txt,$txt_angle,$font_angle=0){
	    $txt=str_replace(')','\\)',str_replace('(','\\(',str_replace('\\','\\\\',$txt)));
	
	    $font_angle+=90+$txt_angle;
	    $txt_angle*=M_PI/180;
	    $font_angle*=M_PI/180;
	
	    $txt_dx=cos($txt_angle);
	    $txt_dy=sin($txt_angle);
	    $font_dx=cos($font_angle);
	    $font_dy=sin($font_angle);

	    $s=sprintf('BT %.2f %.2f %.2f %.2f %.2f %.2f Tm (%s) Tj ET',
             $txt_dx,$txt_dy,$font_dx,$font_dy,
             $x*$this->k,($this->h-$y)*$this->k,$txt);
	    if ($this->ColorFlag)
	        $s='q '.$this->TextColor.' '.$s.' Q';
	    $this->_out($s);
	}
	}

	

	$pdf=new RPDF();

	$pdf->Open();

	$pdf->SetFont('Arial','',15);
	$pdf->SetFontSize(16);

	$pdf->AddPage();
	
	// Fonction de connexion � la base de donn�es
	connexion_DB('poly');
	
	$sql = "SELECT p.nom as patient_nom, p.prenom as patient_prenom, m.nom as medecin_nom, m.prenom as medecin_prenom, s.specialite as medecin_specialite, r.start as hour_start, r.end as hour_end, r.id patient_id, new FROM `".$sessionMedecinCurrent."` r, patients p, medecins m, specialites s where m.specialite=s.id AND  m.inami='$sessionMedecinCurrent' and r.patient_id=p.id and r.date = '$sessionDateCurrent' and r.id='$jsID'";
	
	$result = requete_SQL ($sql);
	
	
	if(mysql_num_rows($result)!=0) {
		
		$data = mysql_fetch_assoc($result);

		$patientNom = $data['patient_nom'];
		$patientPrenom = $data['patient_prenom'];
		$medecinNom = $data['medecin_nom'];
		$medecinPrenom = $data['medecin_prenom'];
		$medecinSpecialite = $data['medecin_specialite'];
		$date = $datetools->transformDATE();
		$start = $data['hour_start'];
		$end = $data['hour_end'];
		
		$pdf->TextWithDirection(96,187,$patientNom." ".$patientPrenom,'U');
		$pdf->SetFontSize(12);
		$pdf->TextWithDirection(101,187,"Le ".$date,'U');
		$pdf->TextWithDirection(105,187,"A ".$start,'U');
		$pdf->SetFontSize(16);
		$pdf->TextWithDirection(110,187,"avec ".$medecinNom." ".substr($medecinPrenom,0,1).".",'U');
		$pdf->SetFontSize(12);
		$pdf->TextWithDirection(114,187,$medecinSpecialite,'U');
		
		
	} else {
		
		$sql = "SELECT m.nom as medecin_nom, m.prenom as medecin_prenom, s.specialite as medecin_specialite, r.start as hour_start, r.end as hour_end, r.comment comment, new FROM `".$sessionMedecinCurrent."` r, medecins m, specialites s where m.specialite=s.id AND m.inami='$sessionMedecinCurrent' and r.date = '$sessionDateCurrent' and r.id='$jsID'";

		$result = requete_SQL ($sql);

		$data = mysql_fetch_assoc($result);
		
		$patientComment = strtok($data['comment'],'-');
		$medecinNom = $data['medecin_nom'];
		$medecinPrenom = $data['medecin_prenom'];
		
		$medecinSpecialite = $data['medecin_specialite'];
		$date = $datetools->transformDATE();
		$start = $data['hour_start'];
		$end = $data['hour_end'];
		
		$pdf->TextWithDirection(96,187,$patientComment,'U');
		$pdf->SetFontSize(12);
		$pdf->TextWithDirection(101,187,"Le ".$date,'U');
		$pdf->TextWithDirection(105,187,"A ".$start,'U');
		$pdf->SetFontSize(16);
		$pdf->TextWithDirection(110,187,"avec ".$medecinNom." ".substr($medecinPrenom,0,1).".",'U');
		$pdf->SetFontSize(12);
		$pdf->TextWithDirection(114,187,$medecinSpecialite,'U');
		
	}
	
	
	//$pdf->TextWithDirection(118,187,"065/66 39 39 - 065/67 10 14",'U');
		
		
	$pdf->AutoPrint(false);
	$pdf->Output();

?>