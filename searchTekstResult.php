<?php
session_start();
if (!isset($_SESSION['user'])) {
	echo "Niste prijavljeni!<br />
 <a href='login.php'>Prijava</a>
<br />";
}
else{
//konekcija sa bazom
require_once("database_connect.php");
//izbor baze
mysql_select_db("dksg_3120", $con);
$rec = mysql_real_escape_string(trim($_POST["rec"]));
$kolona = mysql_real_escape_string(trim($_POST["kolona"]));
$query ="SELECT * FROM tekstovi WHERE $kolona LIKE '%$rec%'";
$result = mysql_query($query);
echo $query;
//ako nepostoji trazeni unos korisniku javljamo gresku 
if(mysql_num_rows($result) == 0){
	die ("<br><br>Ne postoji unos za traženu reč!</br>
		 <a href='searchTekst.php'>Povratak</a>");
}
}?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional
//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Pretraga po datumu</title>
<script type="text/javascript">
function izmeni(id){
	window.location = "tekstEdit.php?id="+id;
	}
function obrisi(id){
	alert("Da li stvarno zelite brisanje?");
	window.location = "tekstDelete.php?id="+id;
	}
function prikazi(id){
	window.location = "tekstDisplay.php?id="+id;
	}	
</script>
</head>
<body>
<br />
<br />
<table cellpadding='10px', border='1px', cellspacing='10px'>
<tr style='background-color:#0C0'>
  <td>Naslov</td>
  <td>Opis</td>
  <td>ID broj</td>
  <td>Dostupan na sajtu</td>
</tr>
<?php while($row = mysql_fetch_array($result))
  {
  echo "<tr>
          <td>".$row['naslov']."</td><td>".$row['opis']."</td><td>".$row['id']."</td><td>".$row['dostupnost']."</td>
          <td>
            <input type='button' onclick='izmeni(".$row['id'].")' value='Izmeni'/><br />
            <input type='button' onclick='obrisi(".$row['id'].")' value='Brisanje'/><br />
            <input type='button' onclick='prikazi(".$row['id'].")' value='Prikaži'/><br />
          </td>
		 </tr>";
  }?>
</table>
<br />
</body>
</html>
