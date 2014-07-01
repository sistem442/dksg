<?php
session_start(); 
set_time_limit (600);
//konekcija sa bazom
include_once"database_connect.php";
//izbor baze
mysql_select_db("dksg_3120", $con);

$dan1 = mysql_real_escape_string(trim($_POST["d1"]));
if (strlen($dan1) == 1){$dan1 = '0'.$dan1;}
$mesec1 = mysql_real_escape_string(trim($_POST["m1"]));
if (strlen($mesec1) == 1){$mesec1 = '0'.$mesec1;}
$godina1 = mysql_real_escape_string(trim($_POST["g1"]));
$dan2 = mysql_real_escape_string(trim($_POST["d2"]));
if (strlen($dan2) == 1){$dan2 = '0'.$dan2;}
$mesec2 = mysql_real_escape_string(trim($_POST["m2"]));
if (strlen($mesec2) == 1){$mesec2 = '0'.$mesec2;}
$godina2 = mysql_real_escape_string(trim($_POST["g2"]));
$id = mysql_real_escape_string(trim($_POST["id"]));

$query3 = "UPDATE opseg SET prviDatum=$godina1$mesec1$dan1,drugiDatum=$godina2$mesec2$dan2 WHERE id=$id;";
$result3 = mysql_query($query3);
if(!$result3){
	die("
	  <span style='color:red;'><br />
      <br />
      greska u izvrsavnju SQL izraza 3!</span></a>");
}
$query4 = "UPDATE event SET dan=$dan1, mesec=$mesec1, godina=$godina1 WHERE id=$id;";
$result4 = mysql_query($query4);
if(!$result4){
	die("
	  <span style='color:red;'><br />
      <br />
      greska u izvrsavnju SQL izraza 4!</span></a>");
}
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Potvrda o izmeni datuma</title>
<LINK href="ContentManagmentStylesheet.css" rel="stylesheet" type="text/css">
<script type='text/javascript'>
function prikazi(id){
	window.location = 'eventEdit.php?id='+id;
	}		
</script>
</head>
<body class="container">
<div class="container"> <br />
  <br />
  <span style='color:green'>Unos u bazu je uspešan.</span></div>
<br />
<br />
<br />
<div class="result"><a class="result2" href='javascript:prikazi(<?php echo $id;?>)'>Nazad na izmenu događaja</a></div>
<div class="result"><a class="result2" href='adminIndex.php'>Glavni meni</a></div>
<div class="result"><a class="result2" href='logout.php'>Izloguj se</a></div>
<br />
</div>
<!--container-->
</body>
</html>