<?php

	session_start();

	include_once '../lib/fonctions.php';

	$available="";
	$consultLenght="-1";
	
	$medecinCurrent = isset($_SESSION['medecinCurrent']) ? $_SESSION['medecinCurrent'] : "";
	$dateCurrent = isset($_SESSION['dateCurrent']) ? $_SESSION['dateCurrent'] : "";

	$midday = isset($_GET['midday']) ? $_GET['midday'] : "";
	$length = isset($_GET['length']) ? $_GET['length'] : "";
	$length = intval($length);
	$position = isset($_GET['position']) ? $_GET['position'] : "";

	connexion_DB('poly');
	
	if ($medecinCurrent != "" && $dateCurrent !="" && $midday !="" && $length !="" && $position !="" ) {

		$sql ="select * from `".$medecinCurrent."` where date= '".$dateCurrent."' and midday = '".$midday."' and position <=".$position." and position + length >".$position;
		$result = mysql_query($sql);
		if(mysql_num_rows($result)!=0) {
			$available = "find1";
		}

		$sql ="select * from `";
		$sql .= $medecinCurrent;
		$sql .= "` where date= '".$dateCurrent."' and midday='$midday' and position <";
		$sql .=$position+$length;
		$sql .=" and position + length >=";
		$sql .=$position+$length;
		$result = mysql_query($sql);
		if(mysql_num_rows($result)!=0) {
			$available = "find2";
		}
		
		$sql ="select * from `";
		$sql .= $medecinCurrent;
		$sql .= "` where date= '".$dateCurrent."' and midday='$midday' and position >=";
		$sql .=$position;
		$sql .=" and position + length <=";
		$sql .=$position+$length;
		$result = mysql_query($sql);
		if(mysql_num_rows($result)!=0) {
			$available = "find3";
		}
		
		$sql = "SELECT sum(length) as length FROM `".$medecinCurrent."` where date = '".$dateCurrent."' and midday='".$midday."'";
		$result = mysql_query($sql);
		$data = mysql_fetch_assoc($result);
		$length = $data['length'];
		if ($length != '') {$consultLenght = $length;} else {$consultLenght = "0";}
	
	}

	deconnexion_DB();
	
	
$datas = array(
    'root' => array(
        'available' => $available, 
        'consultLenght' => $consultLenght
    )
);
		
header("X-JSON: " . json_encode($datas));
?>