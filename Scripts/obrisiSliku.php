<?php
//get the q parameter from URL
$id= $_GET["id"];
//konekcija sa bazom
require_once("../database_connect.php");

//brisanje slike iz foldera
$query = "SELECT slika FROM event WHERE id=".$id.";";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$path = "../".$row["slika"];
unlink($path);

//izraz za brisanje slike iz baze
$query = "UPDATE event SET slika='0'  WHERE id=".$id.";";
$result = mysql_query($query);
if(!$result){
	die("Greška pri brisanju slike iz baze!");
}

?>