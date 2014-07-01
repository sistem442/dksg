<?php
session_start();
if (!isset($_SESSION['user'])) {
	echo "Niste prijavljeni!<br />
 <a href='login.php'>Prijava</a>
<br />";
}
else{
$id = $_GET['id'];
//konekcija sa bazom
require_once("database_connect.php");
//izbor baze
mysql_select_db("dksg_3120", $con);
//SQL izraz
$query = ("SELECT * FROM tekstovi WHERE (id = $id)");
echo $query;
$result = mysql_query($query);
$row = mysql_fetch_array($result);
if(!$result){
	die ("Došlo je do greške prilikom pretrage!</br>
		 <a href='searchTekst.php'>Povratak</a>");
}
//brisanje fajlova iz foldera
$query0 = "SELECT * FROM fajlovi WHERE id=".$id.";";
$result0 = mysql_query($query0);
$returned_rows = mysql_num_rows($result0);
if($returned_rows != 0){
while($row0 = mysql_fetch_array($result0)){
$path0 = $row0["path"];
unlink($path0);
}}
//brisanje slike iz foldera
$query1 = "SELECT slika FROM tekstovi WHERE id=".$id.";";
$result1 = mysql_query($query1);
$row1 = mysql_fetch_array($result1);
$path1 = $row1["slika"];
//echo $path1;
if($path1 != '0'){
unlink($path1);
}
//brisanje iz tabele event
$query2 ="DELETE FROM `tekstovi` WHERE (id = $id);";
$result2 = mysql_query($query2);
if(!$result2){
	die ("Došlo je do greške prilikom brisanja iz glavne tabele!</br>
		 <a href='search.php'>Povratak</a>");
}
//brisanje iz tabele fajlovi
$query2 ="DELETE FROM `fajlovi` WHERE (id = $id);";
$result2 = mysql_query($query2);
if(!$result2){
	die ("Došlo je do greške prilikom brisanja iz tabele fajlovi!</br>
		 <a href='search.php'>Povratak</a>");
}
}//Kraj Sesije
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Brisanje!</title>
</head>
<body>
<p style="font:normal small-caps bold 14px Georgia, serif; color:green">Tekst <?php echo $row['naslov']; ?> je uspešno obrisan.</p>
<a href='logout.php'>Izloguj se</a><br />
<a href='tekstUnos.php'> Novi unos</a><br />
<a href='searchTekst.php'>Pretraga, izmena i brisanje tekstova</a><br />
<a href='adminIndex.php'>Glavni meni</a><br />
</body>
</html>