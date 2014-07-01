<?php
//konekcija sa bazom
include_once"database_connect.php";
//izbor baze
mysql_select_db("dksg_3120", $con);

$id = mysql_real_escape_string(trim($_POST["id"]));$pon = 0;
$uto = 0;
$sre = 0;
$cet = 0;
$pet = 0;
$sub = 0;
$ned = 0;
if(isset($_POST['pon'])){
    $pon = 1;
}
if(isset($_POST['uto'])) {
	$uto = 1;
}
if(isset($_POST['sre'])) {
    $sre = 1;
}
if(isset($_POST['cet'])) {
	$cet = 1;
}
if(isset($_POST['pet'])) {
    $pet = 1;
}
if(isset($_POST['sub'])) {
    $sub = 1;
}
if(isset($_POST['ned'])) {
    $ned = 1;
}
$query4 = "UPDATE periodicni SET pon=$pon, uto=$uto, sre=$sre, cet=$cet, pet=$pet, sub=$sub, ned=$ned WHERE id = $id;";
echo $query4;
$result4 = mysql_query($query4);
if(!$result4){
	die("
	  <span style='color:red;'><br />
      <br />
      greska u izvrsavnju SQL izraza2</span></a>");
}

?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Potvrda o izmeni dana </title>
<LINK href="ContentManagmentStylesheet.css" rel="stylesheet" type="text/css">
<script type='text/javascript'>
function prikazi(id){
	window.location = 'eventEdit.php?id='+id;
	}	
</script>
</head>
<body class="container">
<div class="container">
<br />
<br />
<span style='color:green'>Dani prikazivanja događaja je uspešno izmenjen.</span></div>
<br />
<br />
<br />
<div class="result"><a class="result2" href='javascript:prikazi(<?php echo $id;?>)'>Nazad na izmenu događaja</a></div>
<div class="result"><a class="result2" href='adminIndex.php'>Glavni meni</a></div>
<div class="result"><a class="result2" href='logout.php'>Izloguj se</a></div>
<br />
</div><!--container-->
</body>
</html>