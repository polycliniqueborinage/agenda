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
	
	if (isset($_SESSION['caisse_date'])) {
		$formDate= $_SESSION['caisse_date'];
	} else {
		$formDate = date("Y-m-d");
	}
	
		// Date
	$tok = strtok($formDate,"-");
	$formDate_annee = $tok;
	$tok = strtok("-");
	$formDate_mois = $tok;
	$tok = strtok("-");
	$formDate_jour = $tok;

	if (isset($_SESSION['caisse_nom'])) {
		$formCaisseNom = $_SESSION['caisse_nom'];
		$formCaissePrenom = $_SESSION['caisse_prenom'];
		$formCaisseRole = $_SESSION['caisse_role'];
		$formCaisseLogin = $_SESSION['caisse_login'];
	} else {
		$formCaisseNom = $_SESSION['nom'];
		$formCaissePrenom = $_SESSION['prenom'];
		$formCaisseRole = $_SESSION['role'];
		$formCaisseLogin = $_SESSION['login'];
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

$sql_espece_ouverture = "SELECT sum(montant) as montant FROM caisses_transaction WHERE date ='$formDate' AND caisse='$formCaisseLogin' AND mode='espece' AND code='5000'";
$result = mysql_query($sql_espece_ouverture);
$data = mysql_fetch_assoc($result);
$resumeEspeceOuverture = round($data['montant'],2);

$sql_espece_fermeture = "SELECT sum(montant) as montant FROM caisses_transaction WHERE ( date = '$formDate' AND mode = 'espece' AND caisse='$formCaisseLogin')";
$result = mysql_query($sql_espece_fermeture);
$data = mysql_fetch_assoc($result);
$resumeEspeceFermeture = round($data['montant'],2);

$sql_banksys_fermeture = "SELECT sum(montant) as montant FROM caisses_transaction WHERE ( date = '$formDate' AND mode = 'banksys' AND caisse='$formCaisseLogin')";
$result = mysql_query($sql_banksys_fermeture);
$data = mysql_fetch_assoc($result);
$resumeBanksysFermeture = round($data['montant'],2);

$sql_entree = "SELECT id, caisse, date, code, description, montant, mode, heure FROM caisses_transaction WHERE ( date = '$formDate' AND caisse='$formCaisseLogin' AND code != '5000') order by heure";

//set initial y axis position per page
$y_axis_initial = 15;

//set initial x axis position per page
$x_axis_initial = 15;

//Hauteur de la cellule
$row_height=6;

//Set maximum rows per page
$max = 43;

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
$pdf->Cell(18,10,"Caisse pour de ".$formCaisseNom." ".$formCaissePrenom." [".$formDate_jour."-".$formDate_mois."-".$formDate_annee."]");
$y_axis = $y_axis + 12;
$pdf->SetY($y_axis);
$pdf->SetX($x_axis);
$pdf->Cell(18,10,"Ouverture espèce :".$resumeEspeceOuverture);
$y_axis = $y_axis + 12;
$pdf->SetY($y_axis);
$pdf->SetX($x_axis);
$pdf->Cell(18,10,"Fermeture espèce :".$resumeEspeceFermeture);
$y_axis = $y_axis + 12;
$pdf->SetY($y_axis);
$pdf->SetX($x_axis);
$pdf->Cell(18,10,"Fermeture banksys :".$resumeBanksysFermeture);
$y_axis = $y_axis + 12;
	
//print column titles for the actual page
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','',12);
$pdf->SetY($y_axis);
$pdf->SetX($x_axis);

// print header	
	
$pdf->Cell(28,6,'Date',1,0,'L',1);
$pdf->Cell(28,6,'Heure',1,0,'L',1);
$pdf->Cell(19,6,'Code',1,0,'L',1);
$pdf->Cell(19,6,'Mode',1,0,'L',1);
$pdf->Cell(19,6,'Montant',1,0,'L',1);
$pdf->Cell(80,6,'Description',1,0,'L',1);	
	
	
$result = mysql_query($sql_entree);

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

			$pdf->Cell(28,6,'Date',1,0,'L',1);
			$pdf->Cell(28,6,'Heure',1,0,'L',1);
			$pdf->Cell(19,6,'Code',1,0,'L',1);
			$pdf->Cell(19,6,'Mode',1,0,'L',1);
			$pdf->Cell(19,6,'Montant',1,0,'L',1);
			$pdf->Cell(80,6,'Description',1,0,'L',1);	

		}
		
		$y_axis = $y_axis + $row_height;
		$pdf->SetY($y_axis);
		$pdf->SetX($x_axis);

	    $date = $data['date'];
	    $heure = $data['heure'];
		$code = $data['code'];
		$mode = $data['mode'];
		$montant = $data['montant'];
		$description = substr($data['description'],0,100);
		
		$pdf->SetFillColor(255,255,255);
		$pdf->Cell(28,6,$date,1,0,'L',1);
		$pdf->Cell(28,6,$heure,1,0,'L',1);
		$pdf->Cell(19,6,$code,1,0,'L',1);
		$pdf->Cell(19,6,$mode,1,0,'L',1);
		$pdf->Cell(19,6,$montant,1,0,'L',1);
		$pdf->Cell(80,6,$description,1,0,'L',1);	
		
	    $i = $i + 1;

	
	}



$pdf->AutoPrint(true);

//Create file
$pdf->Output();
?>