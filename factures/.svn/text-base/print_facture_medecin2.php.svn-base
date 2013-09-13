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
	
	$listingTitle = "";
	$titleurl = "";
	
	// DATE
	$jour = (isset($_SESSION['jour']) && $_SESSION['jour']!='') ? $_SESSION['jour'] : date("d");
	$mois = (isset($_SESSION['mois']) && $_SESSION['mois']!='') ? $_SESSION['mois'] : date("m");
	$annee = (isset($_SESSION['annee']) && $_SESSION['annee']!='') ? $_SESSION['annee'] : date("Y");
	
	// get mutuelle code
	$mutuelleCode = isset($_SESSION['mutuelle_code']) ? $_SESSION['mutuelle_code'] : "all";
	
	// get medecin_inami
	$medecinInami = isset($_SESSION['medecin_inami']) ? $_SESSION['medecin_inami'] : "all";
	
	// get periode
	$periode = isset($_SESSION['periode']) ? $_SESSION['periode'] : "day";
	
	if ($mutuelleCode !='all') {
		$sql= "select nom FROM mutuelles WHERE code = '$mutuelleCode'";
		$result = requete_SQL ($sql);
		$data = mysql_fetch_assoc($result);
		$sqlselect .= " and ta.mutuelle_code = ".$mutuelleCode;
		$listingTitle .= " ".$data['nom']." -";
	} else {
		$listingTitle .= " Toutes les mutuelles -";
	}

	if ($medecinInami !='all') {
		$sql= "select nom, prenom FROM medecins WHERE inami = '$medecinInami'";
		$result = requete_SQL ($sql);
		$data = mysql_fetch_assoc($result);
		$sqlselect .= " and ta.medecin_inami = ".$medecinInami;
		$listingTitle .= " ".$data['nom']." ".$data['prenom']." -";
	} else {
		$listingTitle .= " Tous les m&eacute;decins -";
	}

	switch($periode) {
		case 'day':
			$sqlselect .= " and ta.cloture like '".$annee."-".$mois."-".$jour."%'";
			//$sqlselect .= " order by ta.cloture, td.id";
			$impression_url = "../factures/print_facture_medecin.php?id=day";
			$listingTitle .= " Journ&eacute;e";
			$titleurl .= " Journ&eacute;e";
		break;
		case 'first':
			$sqlselect .= " and ta.cloture < '".$annee."-".$mois."-16'";
			$sqlselect .= " and ta.cloture >= '".$annee."-".$mois."-01'";
			//$sqlselect .= " order by ta.cloture, td.id";
			$impression_url = "../factures/print_facture_medecin.php?id=first";
			$listingTitle .= " Premi&egrave;re quinzaine";
			$titleurl .= " Premi&egrave;re quinzaine";
		break;
		case 'second':
			$sqlselect .= " and ta.cloture < '".$annee."-".$mois."-32'";
			$sqlselect .= " and ta.cloture >= '".$annee."-".$mois."-16'";
			$sqlselect .= " order by ta.cloture, td.id";
			$impression_url = "../factures/print_facture_medecin.php?id=second";
			$listingTitle .= " Deuxi&egrave;me quinzaine";
			$titleurl .= " Deuxi&egrave;me quinzaine";
		break;
		case 'month':
			$sqlselect .= " and ta.cloture < '".$annee."-".$mois."-32'";
			$sqlselect .= " and ta.cloture >= '".$annee."-".$mois."-01'";
			//$sqlselect .= " order by ta.cloture, td.id";
			$impression_url = "../factures/print_facture_medecin.php?id=month";
			$listingTitle .= " Mois";
			$titleurl .= " Journ&eacute;e";
		break;
		case 'all':
			//$sqlselect .= " order by ta.cloture, td.id";
			$impression_url = "../factures/print_facture_medecin.php?id=all";
			$listingTitle .= " Complet";
			$titleurl .= " Complet";
		break;
		default:
	}
	
	// Inclus le fichier contenant les fonctions personalisées
	include_once '../lib/fonctions.php';
	
	// Fonction de connexion à la base de données
	connexion_DB('poly');
	
	//define('FPDF_FONTPATH','font/');

	//require('fpdf_js.php');
	
	//class
	
	//Create new pdf file
	//$pdf=new PDF_AutoPrint();

	//Open file
	//$pdf->Open();

	//Disable automatic page break
	//$pdf->SetAutoPageBreak(false);

	$sql = "select distinct me.nom as medecin_nom, me.prenom as medecin_prenom, me.inami as medecin_inami, ta.medecin_inami from medecins me, tarifications ta where ta.medecin_inami=me.inami ".$sqlselect." order by me.nom";

	echo $sql;

	$result = mysql_query($sql);

	//set initial y axis position per page
	$y_axis_initial = 15;

	//set initial x axis position per page
	$x_axis_initial = 15;

	//Hauteur de la cellule
	$row_height=6;

	//Set maximum rows per page
	$max = 43;

	while($data = mysql_fetch_assoc($result)) 	{

		// pour chaque medecin
		$medecin_nom = $data['medecin_nom'];
		$medecin_prenom = $data['medecin_prenom'];
		$medecin_inami = $data['medecin_inami'];
	
		//Add first page
		//$pdf->AddPage();
		
		//initialize counter
		$i = 7;
	
		$y_axis = $y_axis_initial;
		$x_axis = $x_axis_initial;
		
		// Titre
		//$pdf->SetFont('Arial','B',16);
		//$pdf->SetY($y_axis);
		//$pdf->SetX($x_axis);
		//$pdf->Cell(18,10,$titleurl." pour ".$medecin_nom." ".$medecin_prenom);

		echo "<br>".$titleurl.$medecin_nom;
		
		// Resume sans prendre la correction dans le cout_mutuelle qui aurait cout_poly et cout_medecin=0
		$sqlglobalresume= "select sum(round(td.cout_mutuelle,2)) as cout_mutuelle, sum(round(td.cout_poly,2)) as cout_poly, sum(round(td.cout_medecin,2)) as cout_medecin, sum(greatest(round(td.cout_mutuelle - (td.cout_medecin + td.cout_poly),2),0)) as cout_tm from tarifications ta, tarifications_detail td where ta.etat = 'close' and td.tarification_id = ta.id and (td.cout_poly != '0' or td.cout_medecin != '0') and ta.medecin_inami = '".$medecin_inami."' ";
		$sqlglobalresume .= $sqlselect;
		
		echo "<br>".$sqlglobalresume;
		
		$resulttarifresume = mysql_query($sqlglobalresume);
		$data = mysql_fetch_assoc($resulttarifresume);
		
		$cout_mutuelle_resum = round($data['cout_mutuelle'],2);
		$cout_medecin_resum = round($data['cout_medecin'],2);
		$cout_poly_resum = round($data['cout_poly'],2);
		$cout_tm_resum = round($data['cout_tm'],2);
		
		/*$pdf->SetFillColor(220,220,232);
		$y_axis = $y_axis + 12;
		$pdf->SetY($y_axis);
		$pdf->SetX($x_axis);
		$pdf->Cell(45,12,'Total',1,0,'L',1);
		$pdf->Cell(45,12,'Médecin',1,0,'L',1);
		$pdf->Cell(45,12,'Polyclinique',1,0,'L',1);
		$pdf->Cell(53,12,'Ticket modérateur',1,0,'L',1);
		
		$y_axis = $y_axis + 12;
		$pdf->SetY($y_axis);
		$pdf->SetX($x_axis);
		$pdf->Cell(45,12,$cout_mutuelle_resum,1,0,'R',1);
		$pdf->Cell(45,12,$cout_medecin_resum,1,0,'R',1);
		$pdf->Cell(45,12,$cout_poly_resum,1,0,'R',1);
		$pdf->Cell(53,12,$cout_tm_resum,1,0,'R',1);
			
		$y_axis = $y_axis + 18;
		
		//print column titles for the actual page
		$pdf->SetFillColor(232,232,232);
		$pdf->SetFont('Arial','',12);
		$pdf->SetY($y_axis);
		$pdf->SetX($x_axis);
	
		// print header								
		$pdf->Cell(19,6,'Date',1,0,'L',1);
		$pdf->Cell(9,6,'Mut',1,0,'L',1);
		$pdf->Cell(42,6,'Patient',1,0,'L',1);
		$pdf->Cell(35,6,'Matricule',1,0,'L',1);
		$pdf->Cell(16,6,'% Méd.',1,0,'L',1);
		$pdf->Cell(18,6,'Cecodi',1,0,'L',1);	
		$pdf->Cell(16,6,'Méd.',1,0,'L',1);
		$pdf->Cell(16,6,'Poly',1,0,'L',1);
		$pdf->Cell(16,6,'T.M.',1,0,'L',1);

		*/
	
		$sqlglobal= "select ta.date as tarification_date, ta.mutuelle_code as tarification_mutuelle_code, ta.patient_matricule as tarification_patient_matricule, pa.nom as patient_nom, pa.prenom as patient_prenom, td.cecodi as cecodi, round(td.cout_mutuelle,2) as cout_mutuelle, round(td.cout_poly,2) as cout_poly, round(td.cout_medecin,2) as cout_medecin, greatest(round(td.cout_mutuelle - (td.cout_medecin + td.cout_poly),2),0) as cout_tm from tarifications ta, tarifications_detail td, patients pa where ta.etat = 'close' and td.tarification_id = ta.id and ta.patient_id = pa.id and td.cout_medecin != '0' and ta.medecin_inami = '".$medecin_inami."' ";
		$sqlglobal .= $sqlselect;
		$sqlglobal .= " order by ta.cloture, td.id";
		
		echo "<br>".$sqlglobal;
		
		$resulttarif = mysql_query($sqlglobal);
	
		while($data = mysql_fetch_assoc($resulttarif)) 	{
			
			/*
				
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
				$pdf->Cell(19,6,'Date',1,0,'L',1);
				$pdf->Cell(9,6,'Mut',1,0,'L',1);
				$pdf->Cell(42,6,'Patient',1,0,'L',1);
				$pdf->Cell(35,6,'Matricule',1,0,'L',1);	
				$pdf->Cell(16,6,'% Méd.',1,0,'L',1);
				$pdf->Cell(18,6,'Cecodi',1,0,'L',1);	
				$pdf->Cell(16,6,'Méd.',1,0,'L',1);
				$pdf->Cell(16,6,'Poly',1,0,'L',1);
				$pdf->Cell(16,6,'T.M.',1,0,'L',1);
	
			}
			
			$y_axis = $y_axis + $row_height;
			$pdf->SetY($y_axis);
			$pdf->SetX($x_axis);
	
		    $date = substr($data['tarification_date'],2);
		    $mut = $data['tarification_mutuelle_code'];
			$patient = $data['patient_nom']." ".$patient_prenom = $data['patient_prenom'];
			$patient_matricule = $data['tarification_patient_matricule'];
			$cecodi = $data['cecodi'];
			$cout_mutuelle = $data['cout_mutuelle'];
			$cout_medecin = $data['cout_medecin'];
			$cout_poly = $data['cout_poly'];

			*/
			
			// gestion des corrections
			//if ($cout_poly == 0 AND $cout_medecin == 0) {$cout_mutuelle=0;}
			
			$cout_tm = round($cout_mutuelle-($cout_medecin+$cout_poly),2);
			if ($cout_mutuelle != 0) {
				$pourcentage = round((100*($cout_medecin/$cout_mutuelle)),0);
			} else {
				$pourcentage = "";
			}
			
			/*
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(19,6,$date,1,0,'L',1);
			$pdf->Cell(9,6,$mut,1,0,'L',1);
			$pdf->Cell(42,6,$patient,1,0,'L',1);
			$pdf->Cell(35,6,$patient_matricule,1,0,'L',1);
			$pdf->Cell(16,6,$pourcentage."%",1,0,'L',1);
			$pdf->Cell(18,6,$cecodi,1,0,'L',1);
			$pdf->Cell(16,6,$cout_medecin,1,0,'R',1);
			$pdf->Cell(16,6,$cout_poly ,1,0,'R',1);
			$pdf->Cell(16,6,$cout_tm,1,0,'R',1);
			
		    $i = $i + 1;

			*/
		
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
	$pdf->Cell(60,6,'Médecin',1,0,'L',1);
	$pdf->Cell(30,6,'Total',1,0,'L',1);
	$pdf->Cell(30,6,'Méd.',1,0,'L',1);
	$pdf->Cell(30,6,'Poly',1,0,'L',1);
	$pdf->Cell(30,6,'T.M.',1,0,'L',1);

	$y_axis = $y_axis + $row_height;
	$pdf->SetY($y_axis);
	$pdf->SetX($x_axis);
	
	$result = mysql_query($sql);

	while($data = mysql_fetch_assoc($result)) 	{

		// pour chaque medecin
		$medecin_nom = $data['medecin_nom'];
		$medecin_prenom = $data['medecin_prenom'];
		$medecin_inami = $data['medecin_inami'];

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
			$pdf->Cell(60,6,'Médecin',1,0,'L',1);
			$pdf->Cell(30,6,'Total',1,0,'L',1);
			$pdf->Cell(30,6,'Méd.',1,0,'L',1);
			$pdf->Cell(30,6,'Poly',1,0,'L',1);
			$pdf->Cell(30,6,'T.M.',1,0,'L',1);

		}

		// Resume sans prendre la correction dans le cout_mutuelle qui aurait cout_poly et cout_medecin=0
		$sqlglobalresume= "select sum(round(td.cout_mutuelle,2)) as cout_mutuelle, sum(round(td.cout_poly,2)) as cout_poly, sum(round(td.cout_medecin,2)) as cout_medecin, sum(greatest(round(td.cout_mutuelle - (td.cout_medecin + td.cout_poly),2),0)) as cout_tm from tarifications ta, tarifications_detail td where ta.etat = 'close' and td.tarification_id = ta.id and (td.cout_poly != '0' or td.cout_medecin != '0') and ta.medecin_inami = '".$medecin_inami."' ";

		$sqlglobalresume .= $sqlperiode;

		$resulttarifresume = mysql_query($sqlglobalresume);

		$dataresume = mysql_fetch_assoc($resulttarifresume);
	
		$cout_mutuelle_resum = round($dataresume['cout_mutuelle'],2);
		$cout_medecin_resum = round($dataresume['cout_medecin'],2);
		$cout_poly_resum = round($dataresume['cout_poly'],2);
		$cout_tm_resum = round($dataresume['cout_tm'],2);
	
		$pdf->Cell(60,6,$medecin_nom." ".$medecin_prenom,1,0,'L',1);
		$pdf->Cell(30,6,$cout_mutuelle_resum,1,0,'R',1);
		$pdf->Cell(30,6,$cout_medecin_resum,1,0,'R',1);
		$pdf->Cell(30,6,$cout_poly_resum ,1,0,'R',1);
		$pdf->Cell(30,6,$cout_tm_resum,1,0,'R',1);

		$y_axis = $y_axis + $row_height;
		$pdf->SetY($y_axis);
		$pdf->SetX($x_axis);
		
	    $i = $i + 1;

	
	}

	// GRAND TOTALE
	$sqlglobalresumetotal= "select sum(round(td.cout_mutuelle,2)) as cout_mutuelle, sum(round(td.cout_poly,2)) as cout_poly, sum(round(td.cout_medecin,2)) as cout_medecin, sum(greatest(round(td.cout_mutuelle - (td.cout_medecin + td.cout_poly),2),0)) as cout_tm from tarifications ta, tarifications_detail td where ta.etat = 'close' and td.tarification_id = ta.id and (td.cout_poly != '0' or td.cout_medecin != '0')";

	$sqlglobalresumetotal .= $sqlperiode;

	$resulttarifresumetotal = mysql_query($sqlglobalresumetotal);

	$dataresumetotal = mysql_fetch_assoc($resulttarifresumetotal);
	
	$cout_mutuelle_resum_total = round($dataresumetotal['cout_mutuelle'],2);
	$cout_medecin_resum_total = round($dataresumetotal['cout_medecin'],2);
	$cout_poly_resum_total = round($dataresumetotal['cout_poly'],2);
	$cout_tm_resum_total = round($dataresumetotal['cout_tm'],2);

	$pdf->SetFont('Arial','B',16);

	$pdf->Cell(60,6,"TOTAL",1,0,'L',1);
	$pdf->Cell(30,6,$cout_mutuelle_resum_total,1,0,'R',1);
	$pdf->Cell(30,6,$cout_medecin_resum_total,1,0,'R',1);
	$pdf->Cell(30,6,$cout_poly_resum_total,1,0,'R',1);
	$pdf->Cell(30,6,$cout_tm_resum_total,1,0,'R',1);

	

$pdf->AutoPrint(true);

//Create file
$pdf->Output();
?>