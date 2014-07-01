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

//citanje parametara
$dan = mysql_real_escape_string(trim($_POST["dan"]));
if(isset($_POST['mesec'])) {
$mesec = mysql_real_escape_string(trim($_POST["mesec"]));
}
$godina = mysql_real_escape_string(trim($_POST["godina"]));
$dan1 = '0'.$dan;
$mesec1 = '0'.$mesec;

//SQL izraz
$query ="SELECT * FROM event WHERE (dan='$dan' AND mesec='$mesec' AND godina='$godina') OR (id IN(SELECT id FROM opseg WHERE prviDatum=$godina$mesec1$dan1));";
$result = mysql_query($query);
//echo $query;
//ako nepostoji trazeni unos korisniku javljamo gresku 
if(mysql_num_rows($result) == 0){
	die ("Nepostoji unos za zadati datum</br>
		 <a href='search.php'>Povratak</a>");
}
}
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional
//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Pretraga po datumu</title>
<script type="text/javascript">
function izmeni(id){
	window.location = "eventEdit.php?id="+id;
	}
function obrisi(id){
	if (confirm('Da li stvarno zelite brisanje?')){
      window.location = "eventDelete.php?id="+id; }
    else {
      window.location.href = 'search.php' }
	}
function prikazi(id){
	window.location = "oneEventDisplay.php?id="+id;
	}	
function unesi_kliping(id){
	window.location = "kliping_entry.php?id="+id;
	}	
function izmeni_kliping(id){
	window.location = "kliping_edit.php?id="+id;
	}		
</script>
<link href="backEnd.css" rel="stylesheet" type="text/css" />
</head>
<body>
<br />
<br />
<table cellpadding='10px', border='1px', cellspacing='10px'>
<tr style='background-color:#0C0'>
  <td>Ime programa</td>
  <td>redakcija</td>
  <td>datum</td>
  <td class="plavo">OPERACIJA</td>
  <td>id broj</td>
  <td>podnaslov</td>
  <td>nadnaslov</td>
  <td>vreme unosa</td>
  <td>vreme izmene</td>
</tr>
<?php while($row = mysql_fetch_array($result))
  {
  echo "<tr>
          <td>".$row['imePrograma']."</td>
		  <td>".$row['program']."</td>
		  <td>".$row['dan'].". ".$row['mesec'].". ".$row['godina']."</td>
		  <td>
            <input type='button' onclick='izmeni(".$row['id'].")' value='Izmeni'/><br />
            <input type='button' onclick='obrisi(".$row['id'].")' value='Brisanje'/><br />
            <input type='button' onclick='prikazi(".$row['id'].")' value='Prikaži'/><br />
			<input type='button' onclick='unesi_kliping(".$row['id'].")' value='Unesi kliping'/><br />
			<input type='button' onclick='izmeni_kliping(".$row['id'].")' value='Izmeni kliping'/><br />
          </td>
		  <td>".$row['id']."</td>
		  <td>".$row['podnaslov']."</td>
		  <td>".$row['nadnaslov']."</td>
		  <td>".$row['vremeUnosa']."</td>
		  <td>".$row['vremeIzmene']."</td>
          </tr>";
  }?>
</table>
<br />
</body>
</html>
