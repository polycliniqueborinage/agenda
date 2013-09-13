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
		$Jour = $_SESSION['jour'];
	} else {
		$_SESSION['jour'] = date("d");
		$Jour = $_SESSION['jour'];
	}
	
	if (isset($_SESSION['mois'])) {
		$Mois = $_SESSION['mois'];
	} else {
		$_SESSION['mois'] = date("m");
		$Mois = $_SESSION['mois'];
	}
	
	if (isset($_SESSION['annee'])) {
		$Annee = $_SESSION['annee'];
	} else {
		$_SESSION['annee'] = date("Y");
		$Annee = $_SESSION['annee'];
	}
	
	if (isset($_SESSION['mutuelle_code'])) {
		$MutuelleCode = $_SESSION['mutuelle_code'];
	} else {
		$MutuelleCode = 'all';
	}

	// get periode
	if (isset($_GET['periode'])) {
		$Periode = $_GET['periode'];
		$_SESSION['periode'] = $Periode;
	} else {
		if (isset($_SESSION['periode'])) {
			$Periode =  $_SESSION['periode'];
		} else {
			$Periode =  "day";
			$_SESSION['periode'] =  $Periode;
		}
	}

	if ($Periode =='day') {
		$sqlperiode = " and ta.cloture like '".$Annee."-".$Mois."-".$Jour."%'";
		$titleurl = " Listing du ".$Jour."/".$Mois."/".$Annee;
	}

	if ($Periode =='first') {
		$sqlperiode = " and ta.cloture < '".$Annee."-".$Mois."-16'";
		$sqlperiode .= " and ta.cloture >= '".$Annee."-".$Mois."-01'";
		$titleurl = " Listing du 01/".$Mois."/".$Annee." au 15/".$Mois."/".$Annee;
	}

	if ($Periode =='second') {
		$sqlperiode = " and ta.cloture < '".$Annee."-".$Mois."-32'";
		$sqlperiode .= " and ta.cloture >= '".$Annee."-".$Mois."-16'";
		$titleurl = " Listing du 16/".$Mois."/".$Annee." au 31/".$Mois."/".$Annee;
	}

	if ($Periode =='month') {
		$sqlperiode = " and ta.cloture < '".$Annee."-".$Mois."-32'";
		$sqlperiode .= " and ta.cloture >= '".$Annee."-".$Mois."-01'";
		$titleurl = " Listing du 01/".$Mois."/".$Annee." au 31/".$Mois."/".$Annee;
	}

	if ($Periode =='all') {
		$sqlperiode = "";
		$titleurl = " Listing complet";
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

	if ($MutuelleCode != 'all') {
		// pour la mutuelle en cours
		$sql= "select distinct ta.mutuelle_code as mutuelle_code, mu.nom as mutuelle_nom from tarifications ta, mutuelles mu where ta.utilisation = 'retarification' AND ta.mutuelle_code = mu.code".$sqlperiode." and ta.mutuelle_code='".$MutuelleCode."'";
	} else {
		// pour chaque mutuelle
		$sql= "select distinct ta.mutuelle_code as mutuelle_code, mu.nom as mutuelle_nom from tarifications ta, mutuelles mu where ta.utilisation = 'retarification' AND ta.mutuelle_code = mu.code".$sqlperiode." order by mu.code";
	}

	$result = mysql_query($sql);

	//set initial y axis position per page
	$y_axis_initial = 15;

	//set initial x axis position per page
	$x_axis_initial = 7;

	//Hauteur de la cellule
	$row_height=6;

	//Set maximum rows per page
	$max = 30;

	while($data = mysql_fetch_assoc($result)) 	{

		// pour chaque medecin
		$mutuelle_code = $data['mutuelle_code'];
		$mutuelle_nom = $data['mutuelle_nom'];
	
		//Add first page
		$pdf->AddPage();
	
		//initialize counter
		$i = 7;

		$y_axis = $y_axis_initial;
		$x_axis = $x_axis_initial;
	
		// Titre
		$pdf->SetFont('Arial','B',16);
		$pdf->SetY($y_axis);
		$pdf->SetX($x_axis);
		$pdf->Cell(18,10,$titleurl." - ".$mutuelle_code." - ".$mutuelle_nom);

		//resume a corriger
		$sqlresume= "select sum(round((td.cout_mutuelle - td.cout),2)) as cout from tarifications ta, tarifications_detail td where ta.etat = 'close' AND td.tarification_id = ta.id AND td.cout < td.cout_mutuelle AND ta.mutuelle_code = '".$mutuelle_code."'";
		$sqlresume = $sqlresume.$sqlperiode;
	
		$resulttarifresume = mysql_query($sqlresume);
		$data = mysql_fetch_assoc($resulttarifresume);
		$cout = round($data['cout'],2);
	
		$pdf->SetFillColor(220,220,232);
		$y_axis = $y_axis + 12;
		$pdf->SetY($y_axis);
		$pdf->SetX($x_axis);
		$pdf->Cell(55,12,'Solde Mutuelle',1,0,'L',1);
		
		$y_axis = $y_axis + 12;
		$pdf->SetY($y_axis);
		$pdf->SetX($x_axis);
		$pdf->Cell(55,12,$cout,1,0,'R',1);
	
		$y_axis = $y_axis + 18;
	
		//print column titles for the actual page
		$pdf->SetFillColor(232,232,232);
		$pdf->SetFont('Arial','',12);
		$pdf->SetY($y_axis);
		$pdf->SetX($x_axis);

		// print header								
		$pdf->Cell(23,6,'Date',1,0,'L',1);
		$pdf->Cell(9,6,'Mut',1,0,'L',1);
		$pdf->Cell(60,6,'Patient',1,0,'L',1);
		$pdf->Cell(40,6,'Matricule',1,0,'L',1);
		$pdf->Cell(50,6,'Titulaire',1,0,'L',1);
		$pdf->Cell(22,6,'CT1/CT2',1,0,'L',1);
		$pdf->Cell(40,6,'Médecin',1,0,'L',1);
		$pdf->Cell(22,6,'Cecodi',1,0,'L',1);	
		$pdf->Cell(18,6,'Coût',1,0,'L',1);

		$sqlglobal= "select ta.cloture as tarification_date_cloture, DATE_FORMAT(ta.date, GET_FORMAT(DATE, 'EUR')) as tarification_date, ta.mutuelle_code as tarification_mutuelle_code, ta.patient_matricule as tarification_patient_matricule, concat(ta.ct1, '/' ,ta.ct2) as tarification_patient_cts, ta.titulaire_matricule as tarification_titulaire_matricule, ta.medecin_inami as tarification_medecin_inami, pa.nom as patient_nom, pa.prenom as patient_prenom, ti.nom as titulaire_nom, ti.prenom as titulaire_prenom, me.nom as medecin_nom, me.prenom as medecin_prenom, td.cecodi as cecodi, round((td.cout_mutuelle - td.cout),2) as cout from tarifications ta, tarifications_detail td, medecins me, patients pa, patients ti where ta.etat = 'close' and ta.medecin_inami = me.inami and ta.patient_id = pa.id and td.tarification_id = ta.id and pa.titulaire_id = ti.id AND td.cout < td.cout_mutuelle AND ta.mutuelle_code = '".$mutuelle_code."'";
	
		$sqlglobal = $sqlglobal.$sqlperiode." order by ta.cloture, td.id";
		//echo $sqlglobal;
	
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
				$pdf->Cell(23,6,'Date',1,0,'L',1);
				$pdf->Cell(9,6,'Mut',1,0,'L',1);
				$pdf->Cell(60,6,'Patient',1,0,'L',1);
				$pdf->Cell(40,6,'Matricule',1,0,'L',1);
				$pdf->Cell(50,6,'Titulaire',1,0,'L',1);
				$pdf->Cell(22,6,'CT1/CT2',1,0,'L',1);
				$pdf->Cell(40,6,'Médecin',1,0,'L',1);
				$pdf->Cell(22,6,'Cecodi',1,0,'L',1);	
				$pdf->Cell(18,6,'Coût',1,0,'L',1);

			}
		
			$y_axis = $y_axis + $row_height;
			$pdf->SetY($y_axis);
			$pdf->SetX($x_axis);

		    $date = substr($data['tarification_date_cloture'],0,10);
		    $mut = $data['tarification_mutuelle_code'];
			$patient = $data['patient_nom']." ".$data['patient_prenom'];
			$patient_matricule = $data['tarification_patient_matricule'];
			$titulaire = $data['titulaire_nom']." ".$data['titulaire_prenom'];
			$patient_cts = $data['tarification_patient_cts'];
			$medecin = $data['medecin_nom']." ".$data['medecin_prenom'];
			$medecin_inami = $data['tarification_medecin_inami'];
			$cecodi = $data['cecodi'];
			$cout = $data['cout'];
		
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(23,6,$date,0,0,'L',1);
			$pdf->Cell(9,6,$mut,0,0,'L',1);
			$pdf->Cell(60,6,$patient,0,0,'L',1);
			$pdf->Cell(40,6,$patient_matricule,0,0,'L',1);
			$pdf->Cell(50,6,$titulaire,0,0,'L',1);
			$pdf->Cell(22,6,$patient_cts,0,0,'L',1);
			$pdf->Cell(40,6,$medecin,0,0,'L',1);
			$pdf->Cell(22,6,$cecodi,0,0,'L',1);
			$pdf->Cell(18,6,$cout,0,0,'R',1);
	
		    $i = $i + 1;

		}
	}




	// RESUME
	
	//Add first page
	$pdf->AddPage();
	
	//initialize counter
	$i = 3;

	$y_axis = $y_axis_initial;
	$x_axis = $x_axis_initial;
	
	// Titre
	$pdf->SetFont('Arial','B',16);
	$pdf->SetY($y_axis);
	$pdf->SetX($x_axis);
	$pdf->Cell(18,10,"Récapitulatif");

	$pdf->SetFont('Arial','',12);

	$y_axis = $y_axis + 12;
	$pdf->SetY($y_axis);
	$pdf->SetX($x_axis);

	$pdf->SetFillColor(232,232,232);
	// print header								
	$pdf->Cell(60,6,'Mutuelle',1,0,'L',1);
	$pdf->Cell(40,6,'Total',1,0,'L',1);

	$y_axis = $y_axis + $row_height;
	$pdf->SetY($y_axis);
	$pdf->SetX($x_axis);
	
	$result = mysql_query($sql);

	while($data = mysql_fetch_assoc($result)) 	{

		// pour chaque medecin
		$mutuelle_code = $data['mutuelle_code'];

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
			// print header								
			$pdf->Cell(60,6,'Mutuelle',1,0,'L',1);
			$pdf->Cell(40,6,'Total',1,0,'L',1);

		}

		// Resume sans prendre la correction dans le cout_mutuelle qui aurait cout_poly et cout_medecin=0
		$sqlglobalresume= "select sum(round((td.cout_mutuelle - td.cout),2)) as cout from tarifications ta, tarifications_detail td where ta.etat = 'close' AND td.tarification_id = ta.id AND td.cout < td.cout_mutuelle AND ta.mutuelle_code = '".$mutuelle_code."'";
		$sqlglobalresume = $sqlglobalresume.$sqlperiode;
		
		$resulttarifresume = mysql_query($sqlglobalresume);

		$dataresume = mysql_fetch_assoc($resulttarifresume);
	
		$cout_resum = round($dataresume['cout'],2);
	
		$pdf->Cell(60,6,$mutuelle_code,1,0,'L',1);
		$pdf->Cell(40,6,$cout_resum,1,0,'R',1);

		$y_axis = $y_axis + $row_height;
		$pdf->SetY($y_axis);
		$pdf->SetX($x_axis);
		
	    $i = $i + 1;

	
	}

	// GRAND TOTALE
	$sqlglobalresumetotal= "select sum(round((td.cout_mutuelle - td.cout),2)) as cout from tarifications ta, tarifications_detail td where ta.etat = 'close' AND td.tarification_id = ta.id AND td.cout < td.cout_mutuelle";
		
	$sqlglobalresumetotal .= $sqlperiode;

	$resulttarifresumetotal = mysql_query($sqlglobalresumetotal);

	$dataresumetotal = mysql_fetch_assoc($resulttarifresumetotal);
	
	$cout_resum_total = round($dataresumetotal['cout'],2);

	$pdf->SetFont('Arial','B',16);

	$pdf->Cell(60,6,"TOTAL",1,0,'L',1);
	$pdf->Cell(40,6,$cout_resum_total,1,0,'R',1);

	$pdf->AutoPrint(true);

	//Create file
	$pdf->Output();
?>