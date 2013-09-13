<?php 

	// Demarre une session
	session_start();

	// Validation du Login
	// SECURISE
	if(isset($_SESSION['application'])) {
		if ($_SESSION['application']=="|poly|") {
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
		
	if (isset($_GET['letter'])) {
		$formLetter =  $_GET['letter'];
	} else {
		$formLetter =  "A";
	}
			
	// Inclus le fichier contenant les fonctions personalisées
	include_once '../lib/fonctions.php';
	
	// Fonction de connexion à la base de données
	connexion_DB('poly');

	define('FPDF_FONTPATH','font/');
	require('fpdf_js.php');
	require('formmail.php');

	class PDF_AutoPrint extends PDF_Javascript
	{
		function AutoPrint($dialog=false)
		{
    	//Lance la boîte d'impression ou imprime immediatement sur l'imprimante par défaut
    	$param=($dialog ? 'true' : 'false');
    	$script="print($param);";
    	$this->IncludeJS($script);
		}

		function AutoPrintToPrinter($server, $printer, $dialog=false)
		{
   		//Imprime sur une imprimante partagée (requiert Acrobat 6 ou supérieur)
    	$script = "var pp = getPrintParams();";
    	if($dialog)
    	    $script .= "pp.interactive = pp.constants.interactionLevel.full;";
    	else
    	    $script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
    	$script .= "pp.printerName = '\\\\\\\\".$server."\\\\".$printer."';";
    	$script .= "print(pp);";
    	$this->IncludeJS($script);
		}
	}

	//Create new pdf file
	$pdf=new PDF_AutoPrint('P','mm','A4');

	//Open file
	$pdf->Open();

	//Disable automatic page break
	$pdf->SetAutoPageBreak(false);

	//set initial y axis position per page
	$y_axis_initial = 15;

	//set initial x axis position per page
	$x_axis_initial = 7;

	//Hauteur de la cellule
	$row_height=6;

	//Set maximum rows per page
	$max = 42;

	//Add first page
	$pdf->AddPage();
	
	//initialize counter
	$i = 4;

	$y_axis = $y_axis_initial;
	$x_axis = $x_axis_initial;
	
	// Titre
	$pdf->SetFont('Arial','B',16);
	$pdf->SetY($y_axis);
	$pdf->SetX($x_axis);
	$pdf->Cell(18,10,"Listing des patients pour la lettre ".$formLetter);
	
	$y_axis = $y_axis + 18;
	
	//print column titles for the actual page
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','',12);
	$pdf->SetY($y_axis);
	$pdf->SetX($x_axis);

	$pdf->Cell(60,6,'Patient',1,0,'L',1);
	$pdf->Cell(25,6,'Naissance',1,0,'L',1);
	$pdf->Cell(20,6,'Mutuelle',1,0,'L',1);
	$pdf->Cell(12,6,'CT1',1,0,'L',1);
	$pdf->Cell(12,6,'CT2',1,0,'L',1);
	$pdf->Cell(60,6,'Titulaire',1,0,'L',1);

	$sqlglobal = "SELECT p.nom as patient_nom, p.prenom as patient_prenom, DATE_FORMAT(p.date_naissance, GET_FORMAT(DATE, 'EUR')) as 	patient_date_naissance, p.id as patient_id, p.ct1 as patient_ct1, p.ct2 as patient_ct2, p.mutuelle_code as patient_mutuelle_code, p.titulaire_id as patient_titulaire_id, t.nom as titulaire_nom, t.prenom as titulaire_prenom, t.id as titulaire_id FROM patients p , patients t WHERE p.titulaire_id = t.id AND p.nom like '$formLetter%' ORDER BY 1,2";

	$result = mysql_query($sqlglobal);

	while($data = mysql_fetch_assoc($result)) 	{
		
		if ($i == $max) {
		
			// saut de page
			$pdf->AddPage();
			$y_axis = $y_axis_initial;
			$x_axis = $x_axis_initial;
			//initialize counter
			$i = 0;
			$pdf->SetY($y_axis);
			$pdf->SetX($x_axis);

			$pdf->SetFillColor(232,232,232);
			$pdf->Cell(60,6,'Patient',1,0,'L',1);
			$pdf->Cell(25,6,'Naissance',1,0,'L',1);
			$pdf->Cell(20,6,'Mutuelle',1,0,'L',1);
			$pdf->Cell(12,6,'CT1',1,0,'L',1);
			$pdf->Cell(12,6,'CT2',1,0,'L',1);
			$pdf->Cell(60,6,'Titulaire',1,0,'L',1);

		}
		
		$y_axis = $y_axis + $row_height;
		$pdf->SetY($y_axis);
		$pdf->SetX($x_axis);

	    $patient = $data['patient_nom']." ".$data['patient_prenom'];
	    $patient_date_naissance = $data['patient_date_naissance'];
	    $patient_mutuelle_code = $data['patient_mutuelle_code'];
	    $patient_ct1 = $data['patient_ct1'];
	    $patient_ct2 = $data['patient_ct2'];
	    $titulaire = $data['titulaire_nom']." ".$data['titulaire_prenom'];
	    
		$pdf->SetFillColor(255,255,255);
		$pdf->Cell(60,6,$patient,0,0,'L',1);
		$pdf->Cell(25,6,$patient_date_naissance,0,0,'L',1);
		$pdf->Cell(20,6,$patient_mutuelle_code,0,0,'L',1);
		$pdf->Cell(12,6,$patient_ct1,0,0,'L',1);
		$pdf->Cell(12,6,$patient_ct2,0,0,'L',1);
		$pdf->Cell(60,6,$titulaire,0,0,'L',1);
				
	    $i = $i + 1;

	}

	$pdf->AutoPrint(true);

	//Create file
	$pdf->Output();
?>