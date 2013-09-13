<?

	session_start();

	include_once '../lib/fonctions.php';

	$dateCurrent = isset($_SESSION['dateCurrent']) ? $_SESSION['dateCurrent'] : "";

	$medecinCurrent = isset($_SESSION['medecinCurrent']) ? $_SESSION['medecinCurrent'] : "";

	$id = isset($_GET['id']) ? $_GET['id'] : "";
	
	connexion_DB('poly');
	//morning
	$sql = "select length, tri, midday  FROM`".$medecinCurrent."` WHERE `date` = '".$dateCurrent."' AND `id` = '".$id."'";
	
	$result = mysql_query($sql);
	
	if(mysql_num_rows($result)!=0) {
		// un seul resultat
		$data = mysql_fetch_assoc($result);
		$tri = $data['tri'];
		$length = $data['length'];
		$midday = $data['midday'];
		echo "tri".$tri." ";
		echo "midday".$midday." ";
		echo "length".$length." ";
	}
		
	$sql = "DELETE FROM `".$medecinCurrent."` WHERE `date` = '".$dateCurrent."' AND `id` = '".$id."' LIMIT 1";
	echo $sql." ";
	$result = mysql_query($sql);
		
	$sql = "UPDATE `".$medecinCurrent."` SET top  = top + ".$length." WHERE `date` = '".$dateCurrent."' AND midday ='".$midday."' AND tri > ".$tri;
	$result = mysql_query($sql);
	echo "  --> ".$sql." ";
		
	
	deconnexion_DB();
	
	
?>