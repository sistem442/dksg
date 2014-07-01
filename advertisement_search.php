<?php 
session_start();
require_once("database_connect.php");
if (!isset($_SESSION['user'])) 
	echo "Niste prijavljeni!<br /><a href='login.php'>Prijava</a><br />";
$mesec = $_POST['mesec'];
$godina = $_POST['godina'];
$query = "SELECT * FROM advertisement  WHERE mesec = $mesec AND godina = $godina";
$result = mysql_query($query); 
//echo '<br>Izraz za upis u bazu: '.$query;
	if (mysql_errno()) { 
 		echo "MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing:<br>\n$query2\n<br>";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Slider pretraga</title>
<link href="backEnd.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function izmeni(id){
	window.location = "advertisement_edit.php?id="+id;
	}
function obrisi(id){
	if (confirm('Da li stvarno zelite brisanje?')){
 		 window.location = "advertisement_delete.php?id="+id; }
	else {
  		window.location.href = 'advertisement_search.php' }
}	
</script>
</head>

<body>
<table cellpadding='10px', border='1px', cellspacing='10px'>
    <tr style='background-color:#0C0'>
      <td>Tekst</td>
      <td>Datum</td>
      <td>ID</td>
      <td class="plavo">OPERACIJA</td>
    </tr>
    <?php 
	while($row = mysql_fetch_array($result)){
      echo "<tr>
              <td>".$row['title']."</td>
              <td>".$row['dan'].". ".$row['mesec'].".
			  	 ".$row['godina']."</td>
              <td>".$row['id']."</td>
			  <td>
                <input type='button' onclick='izmeni(".$row['id'].")'
					 value='Izmeni'/><br />
                <input type='button' onclick='obrisi(".$row['id'].")'
					 value='Brisanje'/><br />
              </td>
              
           </tr>";
      }?>
  </table>
</body>
</html>