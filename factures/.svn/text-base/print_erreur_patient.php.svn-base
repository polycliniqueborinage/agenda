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
	
	// DATE
	if (isset($_SESSION['jour'])) {
		$jour = $_SESSION['jour'];
	} else {
		$_SESSION['jour'] = date("d");
	}
	
	if (isset($_SESSION['mois'])) {
		$mois = $_SESSION['mois'];
	} else {
		$_SESSION['mois'] = date("m");
	}
	
	if (isset($_SESSION['annee'])) {
		$annee = $_SESSION['annee'];
	} else {
		$_SESSION['annee'] = date("Y");
		$annee = $_SESSION['annee'];
	}
	
	// get periode
	if (isset($_SESSION['periode'])) {
		$periode =  $_SESSION['periode'];
	} else {
		$periode =  "day";
	}

	$sqlglobal= "select ta.id as id, DATE_FORMAT(ta.date, GET_FORMAT(DATE, 'EUR')) as tarification_date, pa.nom as patient_nom, pa.prenom as patient_prenom, me.nom as medecin_nom, me.prenom as medecin_prenom, ROUND( -1 * ( ta.a_payer - ta.paye ) , 2 ) as a_payer  FROM patients pa, medecins me, tarifications ta WHERE a_payer <0 AND ta.medecin_inami = me.inami and ta.patient_id = pa.id";
	$sqlglobalresume= "select sum(ROUND( -1 * ( ta.a_payer - ta.paye ) , 2 )) as a_payer  FROM patients pa, medecins me, tarifications ta WHERE a_payer <0 AND ta.medecin_inami = me.inami and ta.patient_id = pa.id";
	
	switch($periode) {
		case 'day':
			$sqlglobal .= " and ta.date like '".$annee."-".$mois."-".$jour."%'";
			$sqlglobal .= " order by ta.date";
			$sqlglobalresume .= " and ta.date like '".$annee."-".$mois."-".$jour."%'";
			$listingTitle .= " Listing erreurs patients pour la journee";
		break;
		case 'first':
			$sqlglobal .= " and ta.date < '".$annee."-".$mois."-16'";
			$sqlglobal .= " and ta.date >= '".$annee."-".$mois."-01'";
			$sqlglobal .= " order by ta.date";
			$sqlglobalresume .= " and ta.date < '".$annee."-".$mois."-16'";
			$sqlglobalresume .= " and ta.date >= '".$annee."-".$mois."-01'";
			$listingTitle .= " Listing erreurs patients pour la premiere quinzaine";
		break;
		case 'second':
			$sqlglobal .= " and ta.date < '".$annee."-".$mois."-32'";
			$sqlglobal .= " and ta.date >= '".$annee."-".$mois."-16'";
			$sqlglobal .= " order by ta.date";
			$sqlglobalresume .= " and ta.date < '".$annee."-".$mois."-32'";
			$sqlglobalresume .= " and ta.date >= '".$annee."-".$mois."-16'";
			$listingTitle .= " Listing erreurs patients pour la deuxieme quinzaine";
		break;
		case 'month':
			$sqlglobal .= " and ta.date < '".$annee."-".$mois."-32'";
			$sqlglobal .= " and ta.date >= '".$annee."-".$mois."-01'";
			$sqlglobal .= " order by ta.date";
			$sqlglobalresume .= " and ta.date < '".$annee."-".$mois."-32'";
			$sqlglobalresume .= " and ta.date >= '".$annee."-".$mois."-01'";
			$listingTitle .= " Listing erreurs patients pour le mois";
		break;
		case 'all':
			$sqlglobal .= " order by ta.date";
			$impression_url = "../factures/print_erreur_medecin.php?id=all";
			$listingTitle .= " Listing complet des erreurs patients";
		break;
		default:
	}
		
	// Inclus le fichier contenant les fonctions personalisées
	include_once '../lib/fonctions.php';
	
	// Fonction de connexion à la base de données
	connexion_DB('poly');

	define('FPDF_FONTPATH','font/');
	//require('fpdf.php');
	require('fpdf_js.php');
	require('formmail.php');

	class PDF_AutoPrint extends PDF_Javascript{
		
		function AutoPrint($dialog=false){
    		//Lance la boîte d'impression ou imprime immediatement sur l'imprimante par défaut
	    	$param=($dialog ? 'true' : 'false');
	    	$script="print($param);";
	    	$this->IncludeJS($script);
		}

		function AutoPrintToPrinter($server, $printer, $dialog=false){
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
	$pdf=new PDF_AutoPrint('L','mm','A4');

	//Open file
	$pdf->Open();

	//Disable automatic page break
	$pdf->SetAutoPageBreak(false);

	$result = mysql_query($sql);

	//set initial y axis position per page
	$y_axis_initial = 15;

	//set initial x axis position per page
	$x_axis_initial = 7;

	//Hauteur de la cellule
	$row_height=6;

	//Set maximum rows per page
	$max = 30;

	$pdf->AddPage();
	
	//initialize counter
	$i = 7;

	$y_axis = $y_axis_initial;
	$x_axis = $x_axis_initial;
	
	// Titre
	$pdf->SetFont('Arial','B',16);
	$pdf->SetY($y_axis);
	$pdf->SetX($x_axis);
	$pdf->Cell(18,10,$listingTitle);

	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','',12);
	$y_axis = $y_axis + 12;
	$pdf->SetY($y_axis);
	$pdf->SetX($x_axis);
	
	$resulttarif = mysql_query($sqlglobal);
	
	while($data = mysql_fetch_assoc($resulttarif)) 	{
		
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
			$pdf->Cell(30,6,'ID',1,0,'L',1);
			$pdf->Cell(30,6,'Date',1,0,'L',1);
			$pdf->Cell(60,6,'Patient',1,0,'L',1);
			$pdf->Cell(60,6,'MŽdecin',1,0,'L',1);
			$pdf->Cell(30,6,'Montant',1,0,'L',1);

			}
		
		$y_axis = $y_axis + $row_height;
		$pdf->SetY($y_axis);
		$pdf->SetX($x_axis);

		$id = $data['id'];
		$date = $data['tarification_date'];
		$patient = $data['patient_nom']." ".$data['patient_prenom'];
		$medecin = $data['medecin_nom']." ".$data['medecin_prenom'];
		$montant = $data['a_payer'];
		
		$pdf->SetFillColor(255,255,255);
		$pdf->Cell(30,6,$id,0,0,'L',1);
		$pdf->Cell(30,6,$date,0,0,'L',1);
		$pdf->Cell(60,6,$patient,0,0,'L',1);
		$pdf->Cell(60,6,$medecin,0,0,'L',1);
		$pdf->Cell(30,6,$montant,0,0,'R',1);
	
		 $i = $i + 1;

	}


	$pdf->AutoPrint(true);

	//Create file
	$pdf->Output();
?>