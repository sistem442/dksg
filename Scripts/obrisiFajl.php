<?php
//get the q parameter from URL
$id2= $_GET["id2"];
//konekcija sa bazom
require_once("../database_connect.php");

//izbor baze
mysql_select_db("dksg_3120", $con);

//brisanje slike iz foldera
$query = "SELECT * FROM fajlovi WHERE id2=".$id2.";";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$path = "../".$row["path"];
unlink($path);
//izraz za brisanje slike iz baze
$query = "DELETE FROM `dksg_3120`.`fajlovi` WHERE `fajlovi`.`id2` = ".$id2.";";
echo $query;
$result = mysql_query($query);
if(!$result){
	die("Greška pri brisanju fajla iz baze!");
}

?>