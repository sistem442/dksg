<?php
//konekcija sa bazom
include_once"database_connect.php";
//izbor baze
mysql_select_db("dksg_3120", $con);

$id = mysql_real_escape_string(trim($_POST["id"]));$pon = 0;
$plakat = 'ne';
$pozivnica = 'ne';
$katalog = 'ne';
$fotografija = 'ne';
$video = 'ne';
$zvuk = 'ne';
$publikacija = 'ne';
if(isset($_POST['plakat'])){
    $plakat = 'da';
}
if(isset($_POST['pozivnica'])) {
	$pozivnica = 'da';
}
if(isset($_POST['katalog'])) {
    $katalog = 'da';
}
if(isset($_POST['fotografija'])) {
	$fotografija = 'da';
}
if(isset($_POST['video'])) {
    $video = 'da';
}
if(isset($_POST['audio'])) {
    $zvuk = 'da';
}
if(isset($_POST['publikacija'])) {
    $publikacija = 'da';
}	
$query4="UPDATE vrstamaterijala SET plakat='$plakat',pozivnica='$pozivnica',katalog='$katalog',fotografija='$fotografija',video='$video',zvuk='$zvuk',publikacija='$publikacija' WHERE id=$id;";
$result4= mysql_query($query4);
echo '<br>Izraz za upis u bazu:'.$query4;
if(!$result4){
	die("
	  <span style='color:red;'><br />
      <br />
      Greska u izvrsavnju SQL izraza za upis u tabelu vrstematerijala!</span></a>");
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
<span style='color:green'>Vrtsta arhiviranog materijala je uspešno izmenjena.</span></div>
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