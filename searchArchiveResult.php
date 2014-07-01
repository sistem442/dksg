<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional
//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Rezlutat pretrage stare arhive</title>
<script type="text/javascript">
function obradi(id){
	window.location = "eventEntryArchive.php?id="+id;
	}
</script>
<link href="http://dksg.rs/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
session_start();
if (isset($_SESSION['user'])){}
else{
	echo "Niste prijavljeni!<br />
 <a href='login.php'>Prijava</a>
<br />";
}
//konekcija sa bazom
require_once("database_connect.php");
//izbor baze
mysql_select_db("dksg_3120", $con);
//citanje parametara
$rec = mysql_real_escape_string(trim($_POST["rec"]));
$kolona = mysql_real_escape_string(trim($_POST["kolona"]));
$mesec = mysql_real_escape_string(trim($_POST["mesec"]));
$godina = mysql_real_escape_string(trim($_POST["godina"]));
$izbor = mysql_real_escape_string(trim($_POST["izbor"]));

if($izbor=="poReci"){
$query ="SELECT * FROM arhiv WHERE $kolona LIKE '%$rec%'";
$result = mysql_query($query);
echo $query;
//ako nepostoji trazeni unos korisniku javljamo gresku 
if(!$result){
	die ("<br><br>Ne postoji unos za traženu reč!</br>
		 <a href='search.php'>Povratak</a>");
}
}

else if($izbor=="poDatumu"){
$query ="SELECT * FROM arhiv WHERE mesec=$mesec AND godina=$godina";
$result = mysql_query($query);
echo $query;
//ako nepostoji trazeni unos korisniku javljamo gresku 
if(!$result){
	die ("<br><br>Ne postoji unos za traženi datum!</br>
		 <a href='search.php'>Povratak</a>");
}
}
else  if($izbor=="oba"){
$query ="SELECT * FROM arhiv WHERE mesec=$mesec AND godina=$godina AND ($kolona LIKE  '%$rec%')";
$result = mysql_query($query);
echo $query;
//ako nepostoji trazeni unos korisniku javljamo gresku 
if(!$result){
	die ("Ne postoji unos za traženu kombinaciju datuma i treči!</br>
		 <a href='searchArchive.php'>Povratak</a>");
}
}
echo "

<br />
<br />
<table cellpadding='10px', border='1px', cellspacing='10px'>
<tr style='background-color:#0C0'>
  <td>Ime programa</td>
  <td>Naslov</td>
  <td>Autor</td>
  <td>Procesirano</td>
  <td>Datum</td>
</tr>";
 while($row = mysql_fetch_array($result))
  {echo
  "<tr>
          <td>".$row['program']."</td><td>".$row['naslov']."</td><td>".$row['autor']."</td><td>".$row['procesirano']."</td><td>".$row['mesec'].'.'.$row['godina']."</td>
          <td>
            <input type='button' onclick='obradi(".$row['id'].")' value='OBRADI'/><br />
          </td>
		 </tr>";
  }
  echo "</table>
<br />
</body>
</html>";
?>
