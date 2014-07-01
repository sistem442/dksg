<?php
//get the q parameter from URL
$id= $_GET["id"];
//konekcija sa bazom
require_once("../database_connect.php");

//brisanje slike iz foldera
$query = "SELECT slika FROM kliping WHERE id=".$id.";";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$path = "../".$row["slika"];
unlink($path);

//izraz za brisanje slike iz baze
$query = "UPDATE kliping SET slika='0', flag = 'kod'  WHERE id=".$id.";";
echo $query;
$result = mysql_query($query);
if(!$result){
	die("Greška pri brisanju slike iz baze!");
}

?>