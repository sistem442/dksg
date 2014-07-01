<?php
//get the q parameter from URL
$id2 = $_GET["id2"];
$komentar = $_GET["komentar"];
//konekcija sa bazom
require_once("../database_connect.php");

//izbor baze
mysql_select_db("dksg_3120", $con);

//izmeni komentar u bazi
$query = "UPDATE fajlovi SET komentar='$komentar' WHERE id2=".$id2.";";
$result = mysql_query($query) or die('greska pri izmeni komentara');
echo $komentar;
?>