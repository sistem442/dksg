<?php
//get the q parameter from URL
$id= $_GET["id"];
//konekcija sa bazom
require_once("../database_connect.php");

//brisanje slike iz foldera
$query = "SELECT path FROM slajd WHERE id=".$id.";";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$path = "../".$row["path"];
unlink($path);

//izraz za brisanje slike iz baze
$query = "UPDATE slajd SET path='0'  WHERE id=".$id.";";
$result = mysql_query($query);
if(!$result){
	die("Greška pri brisanju slike iz baze!");
}

?>