<?php
function calcul_cout_prothese($inFormType,$inDataPropriete,$inDataKdb,$inDataBc,$inDataHono,$inDataA,$inDataB) 
{

	$result = 0 ;

	if ($inFormType == 'tr' && $inDataPropriete == 'consultation') {
		$result = $inDataHono - $inDataB ;
	}

	if ($inFormType == 'tp' && $inDataPropriete == 'consultation') {
		$result = $inDataHono - $inDataB;
	}

	if ($inFormType == 'vp' && $inDataPropriete == 'consultation') {
		$result = $inDataHono - $inDataA;
	}
	
	return round($result,2);

}

function calcul_cout($inFormType,$inDataPropriete,$inDataKdb,$inDataBc,$inDataHono,$inDataA,$inDataB) {
	if ($inFormType == 'tr' && $inDataPropriete == 'consultation') {
		$result = $inDataHono;
	}
	if ($inFormType == 'tr' && $inDataPropriete == 'acte') {
		$result = $inDataKdb - $inDataBc ;
	}
		
	if ($inFormType == 'tp' && $inDataPropriete == 'consultation') {
		$result = $inDataHono - $inDataB;
	}
	if ($inFormType == 'tp' && $inDataPropriete == 'acte') {
		$result = $inDataKdb - $inDataBc ;
	}
	
	if ($inFormType == 'vp' && $inDataPropriete == 'consultation') {
		$result = $inDataHono - $inDataA;
	}
	if ($inFormType == 'vp' && $inDataPropriete == 'acte') {
		$result = 0 ;
	}
	
	if ($inFormType == 'sm' && $inDataPropriete == 'consultation') {
		$result = $inDataHono;
	}
	if ($inFormType == 'sm' && $inDataPropriete == 'acte') {
		$result = $inDataKdb ;
	}
	
	if ($inFormType == 'vpia' && $inDataPropriete == 'consultation') {
		$result = $inDataHono - $inDataA;
	}
	if ($inFormType == 'vpia' && $inDataPropriete == 'acte') {
		$result = 0 ;
	}

	if ($inFormType == 'vpisa' && $inDataPropriete == 'consultation') {
		$result = $inDataHono;
	}
	if ($inFormType == 'vpisa' && $inDataPropriete == 'acte') {
		$result = $inDataKdb ;
	}

	if ($inFormType == 'as' && $inDataPropriete == 'consultation') {
		$result = 0;
	}
	if ($inFormType == 'as' && $inDataPropriete == 'acte') {
		$result = 0 ;
	}

	return round($result,2);
}

function calcul_mutuelle($inFormType,$inDataPropriete,$inDataKdb,$inDataBc,$inDataHono,$inDataA,$inDataB) {

	if ($inFormType == 'as') {
		$result = 0;
	} else {
		if ($inDataPropriete == 'consultation') {
			$result = $inDataHono;
		}
		if ($inDataPropriete == 'acte') {
			$result = $inDataKdb;
		}
	}

	return round($result,2);

}

function calcul_caisse($inFormType,$inDataCout,$inDataPrixVP,$inDataPrixTP,$inDataPrixTR) {

	// cout par defaut;
	$result = $inDataCout;
	
	switch($inFormType) {
		case 'tr':
			if ($inDataPrixTR <= $inDataCout) { $result = $inDataCout; } else { $result = $inDataPrixTR;}
		break;
		case 'tp':
			if ($inDataPrixTP <= $inDataCout) { $result = $inDataCout; } else { $result = $inDataPrixTP; }
		break;
		case 'vp':
			if ($inDataPrixVP <= $inDataCout) { $result = $inDataCout; } else { $result = $inDataPrixVP; }
		break;
		default:
			if ($inDataPrixVP <= $inDataCout) { $result = $inDataCout; } else { $result = $inDataPrixVP; }
	}
	
	return $result;
	
	
}

function calcul_cout_medecin($inDataPropriete,$dataKdb,$dataHono,$inFormMedecinTauxActe,$inFormMedecinTauxConsul) {
	
	if ($inDataPropriete == 'consultation') {
		$result = $inFormMedecinTauxConsul * $dataHono /100;
	}
	if ($inDataPropriete == 'acte') {
		$result = $inFormMedecinTauxActe * $dataKdb /100;
	}
	
	// arrondir le resultat
	return round($result,2);
}

				
function calcul_cout_poly($inDataPropriete,$inFormType,$inDataKdb,$inDataHono,$inDataCout,$inDataCoutMedecin) {


//inDataCOUT = paiement du patient
// inDataCoutMedecin = paiement au medecin
// Si consultation inDataHono = Cout Plein mutuelle
// inDataHono - inDataCOUT  (ce que la mutuelle rembourse)
// 

	if ($inDataPropriete == 'consultation') {
		
		if ($inDataCout == $inDataHono) {
			$result = $inDataHono - $inDataCoutMedecin;
		} else{
			$result = $inDataHono - ($inDataCoutMedecin + $inDataCout);
		}

	}
	
	if ($inDataPropriete == 'acte') {
		
		if($inFormType == 'sm') {
			$result = $inDataKdb - $inDataCoutMedecin;
		} else {
			$result = $inDataKdb - ($inDataCoutMedecin + $inDataCout);
		}
	}

	return round($result,2);

}

?>
