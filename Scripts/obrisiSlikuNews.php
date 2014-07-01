<?php
//get the q parameter from URL
$id= $_GET["id"];
//konekcija sa bazom
require_once("../database_connect.php");

//izbor baze
mysql_select_db("dksg_3120", $con);

//brisanje slike iz foldera
$query = "SELECT slika FROM vesti WHERE id=".$id.";";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$path = "../".$row["slika"];
unlink($path);

//izraz za brisanje slike iz baze
$query = "UPDATE vesti SET slika='0'  WHERE idTabele=".$id.";";
$result = mysql_query($query);
if(!$result){
	die("Greška pri brisanju slike iz baze!");
}

?>