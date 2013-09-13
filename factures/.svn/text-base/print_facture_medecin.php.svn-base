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

	if (isset($_SESSION['medecin_inami'])) {
		$MedecinInami = $_SESSION['medecin_inami'];
	} else {
		$MedecinInami = 'all';
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

class PDF_AutoPrint extends PDF_Javascript
{
    function Sector($xc, $yc, $r, $a, $b, $style='FD', $cw=true, $o=90)
    {
        if($cw){
            $d = $b;
            $b = $o - $a;
            $a = $o - $d;
        }else{
            $b += $o;
            $a += $o;
        }
        $a = ($a%360)+360;
        $b = ($b%360)+360;
        if ($a > $b)
            $b +=360;
        $b = $b/360*2*M_PI;
        $a = $a/360*2*M_PI;
        $d = $b-$a;
        if ($d == 0 )
            $d =2*M_PI;
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
            $op='f';
        elseif($style=='FD' or $style=='DF')
            $op='b';
        else
            $op='s';
        if (sin($d/2))
            $MyArc = 4/3*(1-cos($d/2))/sin($d/2)*$r;
        //first put the center
        $this->_out(sprintf('%.2f %.2f m',($xc)*$k,($hp-$yc)*$k));
        //put the first point
        $this->_out(sprintf('%.2f %.2f l',($xc+$r*cos($a))*$k,(($hp-($yc-$r*sin($a)))*$k)));
        //draw the arc
        if ($d < M_PI/2){
            $this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
                        $yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
                        $xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
                        $yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
                        $xc+$r*cos($b),
                        $yc-$r*sin($b)
                        );
        }else{
            $b = $a + $d/4;
            $MyArc = 4/3*(1-cos($d/8))/sin($d/8)*$r;
            $this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
                        $yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
                        $xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
                        $yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
                        $xc+$r*cos($b),
                        $yc-$r*sin($b)
                        );
            $a = $b;
            $b = $a + $d/4;
            $this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
                        $yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
                        $xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
                        $yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
                        $xc+$r*cos($b),
                        $yc-$r*sin($b)
                        );
            $a = $b;
            $b = $a + $d/4;
            $this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
                        $yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
                        $xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
                        $yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
                        $xc+$r*cos($b),
                        $yc-$r*sin($b)
                        );
            $a = $b;
            $b = $a + $d/4;
            $this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
                        $yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
                        $xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
                        $yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
                        $xc+$r*cos($b),
                        $yc-$r*sin($b)
                        );
        }
        //terminate drawing
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3 )
    {
        $h = $this->h;
        $this->_out(sprintf('%.2f %.2f %.2f %.2f %.2f %.2f c',
            $x1*$this->k,
            ($h-$y1)*$this->k,
            $x2*$this->k,
            ($h-$y2)*$this->k,
            $x3*$this->k,
            ($h-$y3)*$this->k));
    }

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

    function SetLegends($data, $format)
    {
        $this->legends=array();
        $this->wLegend=0;
        $this->sum=array_sum($data);
        $this->NbVal=count($data);
        foreach($data as $l=>$val)
        {
            $p=sprintf('%.2f',$val/$this->sum*100).'%';
            $legend=str_replace(array('%l','%v','%p'),array($l,$val,$p),$format);
            $this->legends[]=$legend;
            $this->wLegend=max($this->GetStringWidth($legend),$this->wLegend);
        }
    }

    function DiagCirculaire($largeur, $hauteur, $data, $format, $couleurs=null)
    {
        $this->SetFont('Courier', '', 10);
        $this->SetLegends($data,$format);

        $XPage = $this->GetX();
        $YPage = $this->GetY();
        $marge = 2;
        $hLegende = 5;
        $rayon = min($largeur - $marge * 4 - $hLegende - $this->wLegend, $hauteur - $marge * 2);
        $rayon = floor($rayon / 2);
        $XDiag = $XPage + $marge + $rayon;
        $YDiag = $YPage + $marge + $rayon;
        if($couleurs == null) {
            for($i = 0;$i < $this->NbVal; $i++) {
                $gray = $i * intval(255 / $this->NbVal);
                $couleurs[$i] = array($gray,$gray,$gray);
            }
        }

        //Secteurs
        $this->SetLineWidth(0.2);
        $angleDebut = 0;
        $angleFin = 0;
        $i = 0;
        foreach($data as $val) {
            $angle = floor(($val * 360) / doubleval($this->sum));
            if ($angle != 0) {
                $angleFin = $angleDebut + $angle;
                $this->SetFillColor($couleurs[$i][0],$couleurs[$i][1],$couleurs[$i][2]);
                $this->Sector($XDiag, $YDiag, $rayon, $angleDebut, $angleFin);
                $angleDebut += $angle;
            }
            $i++;
        }
        if ($angleFin != 360) {
            $this->Sector($XDiag, $YDiag, $rayon, $angleDebut - $angle, 360);
        }

        //Légendes
        $this->SetFont('Courier', '', 10);
        $x1 = $XPage + 2 * $rayon + 4 * $marge;
        $x2 = $x1 + $hLegende + $marge;
        $y1 = $YDiag - $rayon + (2 * $rayon - $this->NbVal*($hLegende + $marge)) / 2;
        for($i=0; $i<$this->NbVal; $i++) {
            $this->SetFillColor($couleurs[$i][0],$couleurs[$i][1],$couleurs[$i][2]);
            $this->Rect($x1, $y1, $hLegende, $hLegende, 'DF');
            $this->SetXY($x2,$y1);
            $this->Cell(0,$hLegende,$this->legends[$i]);
            $y1+=$hLegende + $marge;
        }
    }

}

//Create new pdf file
$pdf=new PDF_AutoPrint();

//Open file
$pdf->Open();

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

if ($MedecinInami != 'all') {
	// pour le medecin en cours
	$sql = "select distinct me.nom as medecin_nom, me.prenom as medecin_prenom, me.inami as medecin_inami, ta.medecin_inami from medecins me, tarifications ta where ta.medecin_inami=me.inami ".$sqlperiode." and ta.medecin_inami='".$MedecinInami."'";
} else {
	// pour chaque medecin
	$sql = "select distinct me.nom as medecin_nom, me.prenom as medecin_prenom, me.inami as medecin_inami, ta.medecin_inami from medecins me, tarifications ta where ta.medecin_inami=me.inami ".$sqlperiode." order by me.nom";
}

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
	$pdf->AddPage();
	
	//initialize counter
	$i = 7;

	$y_axis = $y_axis_initial;
	$x_axis = $x_axis_initial;
	
	// Titre
	$pdf->SetFont('Arial','B',16);
	$pdf->SetY($y_axis);
	$pdf->SetX($x_axis);
	$pdf->Cell(18,10,$titleurl." pour ".$medecin_nom." ".$medecin_prenom);
	
	// Resume sans prendre la correction dans le cout_mutuelle qui aurait cout_poly et cout_medecin=0
	$sqlglobalresume= "select sum(round(td.cout_mutuelle,2)) as cout_mutuelle, sum(round(td.cout_poly,2)) as cout_poly, sum(round(td.cout_medecin,2)) as cout_medecin, sum(greatest(round(td.cout_mutuelle - (td.cout_medecin + td.cout_poly),2),0)) as cout_tm from tarifications ta, tarifications_detail td where ta.etat = 'close' and td.tarification_id = ta.id and (td.cout_poly != '0' or td.cout_medecin != '0') and ta.medecin_inami = '".$medecin_inami."' ";

	$sqlglobalresume .= $sqlperiode;
	$sqlglobalresume .= " order by ta.cloture, td.id";
	
	$resulttarifresume = mysql_query($sqlglobalresume);
	$data = mysql_fetch_assoc($resulttarifresume);
	
	$cout_mutuelle_resum = round($data['cout_mutuelle'],2);
	$cout_medecin_resum = round($data['cout_medecin'],2);
	$cout_poly_resum = round($data['cout_poly'],2);
	$cout_tm_resum = round($data['cout_tm'],2);
	
	$pdf->SetFillColor(220,220,232);
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

	$sqlglobal= "select ta.date as tarification_date, ta.mutuelle_code as tarification_mutuelle_code, ta.patient_matricule as tarification_patient_matricule, pa.nom as patient_nom, pa.prenom as patient_prenom, td.cecodi as cecodi, round(td.cout_mutuelle,2) as cout_mutuelle, round(td.cout_poly,2) as cout_poly, round(td.cout_medecin,2) as cout_medecin, greatest(round(td.cout_mutuelle - (td.cout_medecin + td.cout_poly),2),0) as cout_tm from tarifications ta, tarifications_detail td, patients pa where ta.etat = 'close' and td.tarification_id = ta.id and ta.patient_id = pa.id and td.cout_medecin != '0' and ta.medecin_inami = '".$medecin_inami."' ";

	$sqlglobal .= $sqlperiode;
	$sqlglobal .= " order by ta.cloture, td.id";
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
		
		// gestion des corrections
		//if ($cout_poly == 0 AND $cout_medecin == 0) {$cout_mutuelle=0;}
		
		$cout_tm = round($cout_mutuelle-($cout_medecin+$cout_poly),2);
		if ($cout_mutuelle != 0) {
			$pourcentage = round((100*($cout_medecin/$cout_mutuelle)),0);
		} else {
			$pourcentage = "";
		}
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