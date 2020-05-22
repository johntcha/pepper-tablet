<?php


header("Access-Control-Allow-Origin: *");
$hostname = "localhost:/var/run/mysql/mysql_tp.sock";
$username = "username";
$password = "password";
$database_name = "database_name";

$conn = mysql_pconnect($hostname, $username, $password) or die("Impossible de se connecter : ". mysql_error());    
mysql_select_db($database_name, $conn)or die("Impossible de sélectionner la base: ". mysql_error()); 
mysql_query("SET NAMES UTF8");

$sql = "SELECT * FROM `Personnels` WHERE `type`='Administratif' ORDER BY `nom`";
$result = mysql_query($sql) or die("Requête invalide: ". mysql_error()."\n".$sql);

$first = true;
$json = "[";
while ($row = mysql_fetch_assoc($result)){
	if(!$first){
		$json .= ",";
	}else{
		$first = false;
	}
	$json .= "{\"id\":";
	$json .= $row["id"];
	$json .= ", \"civilite\":\"";
	$json .= $row["civilite"];
	$json .= "\", \"nom\":\"";
	$json .= $row["nom"];
	$json .= "\", \"prenom\":\"";
	$json .= $row["prenom"];
	$json .= "\", \"type\":\"";
	$json .= $row["type"];
	$json .= "\", \"description\":\"";
	$json .= $row["description"];
	$json .= "\", \"localisation\":\"";
	$json .= $row["localisation"];
	$json .= "\"}";
}
$json .= "]";
echo $json;