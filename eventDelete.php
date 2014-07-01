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
$query = ("SELECT * FROM event WHERE (id = $id)");
$result = mysql_query($query);
$row = mysql_fetch_array($result);
if(!$result){
	die ("Došlo je do greške prilikom pretrage!</br>
		 <a href='search.php'>Povratak</a>");
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
$query1 = "SELECT slika FROM event WHERE id=".$id.";";
$result1 = mysql_query($query1);
$row1 = mysql_fetch_array($result1);
$path1 = $row1["slika"];
if($path1 != '0'){
unlink($path1);
}
//brisanje iz tabele event
$query2 ="DELETE FROM `event` WHERE (id = $id);";
$result2 = mysql_query($query2);
if(!$result2){
	die ("Došlo je do greške prilikom brisanja iz glavne tabele!</br>
		 <a href='search.php'>Povratak</a>");
}
//brisanje iz remark
$query2 ="DELETE FROM remark WHERE (id = $id);";
$result2 = mysql_query($query2);

//brisanje iz tabela sa materijalom
$query2 ="DELETE FROM mat_fotografija WHERE (id = $id);";

$result2 = mysql_query($query2);
$query2 ="DELETE FROM mat_katalog WHERE (id = $id);";

$result2 = mysql_query($query2);
$query2 ="DELETE FROM mat_plakat WHERE (id = $id);";

$result2 = mysql_query($query2);
$query2 ="DELETE FROM mat_plakat WHERE (id = $id);";

$result2 = mysql_query($query2);
$query2 ="DELETE FROM mat_pozivnica WHERE (id = $id);";

$result2 = mysql_query($query2);
$query2 ="DELETE FROM mat_program WHERE (id = $id);";

$result2 = mysql_query($query2);
$query2 ="DELETE FROM mat_publikacija WHERE (id = $id);";

$result2 = mysql_query($query2);
$query2 ="DELETE FROM mat_video WHERE (id = $id);";

$result2 = mysql_query($query2);
$query2 ="DELETE FROM mat_zvuk WHERE (id = $id);";

$result2 = mysql_query($query2);

//brisanje iz tabele fajlovi
$query2 ="DELETE FROM `fajlovi` WHERE (id = $id);";
$result2 = mysql_query($query2);
if(!$result2){
	die ("Došlo je do greške prilikom brisanja iz tabele fajlovi!</br>
		 <a href='search.php'>Povratak</a>");
}
//brisanje iz tabele periodicni
$query2 ="DELETE FROM `periodicni` WHERE (id = $id);";
$result2 = mysql_query($query2);
//brisanje iz tabele opseg
$query2 ="DELETE FROM `opseg` WHERE (id = $id);";
$result2 = mysql_query($query2);

}//Kraj Sesije
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Brisanje!</title>
</head>
<body>
<p style="font:normal small-caps bold 14px Georgia, serif; color:green">Program <?php echo $row['imePrograma']; ?> je uspešno obrisan.</p>
<a href='logout.php'>Izloguj se</a><br />
<a href='eventEntry.php'> Novi unos</a><br />
<a href='search.php'>Pretraga, izmena i brisanje događaja</a><br />
<a href='adminIndex.php'>Glavni meni</a><br />
</body>
</html>