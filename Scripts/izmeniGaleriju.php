<?php
//get the q parameter from URL
$id2 = $_GET["id2"];
$izbor = $_GET["izbor"];
$id = $_GET["id"];
//konekcija sa bazom
require_once("../database_connect.php");

//izbor baze
mysql_select_db("dksg_3120", $con);

//izmeni komentar u bazi
$query = "UPDATE fajlovi SET galerija = '$izbor' WHERE id2=".$id2.";";
echo $query;
$result = mysql_query($query) or die('greska pri izmeni da li je slika za galeriju');
echo "izmenjen je:".mysql_affected_rows()."red<br />
povratak: <a href='../eventEdit.php?id='".$id;
?>