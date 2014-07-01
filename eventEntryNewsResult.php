<?php session_start();
if (isset($_SESSION['user'])) {?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Potvrda o unosu teksta</title>
<link href="backEnd.css" rel="stylesheet" type="text/css" />
<link href="http://dksg.rs/main.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
  javascript:window.history.forward(1);
</script>
<script type='text/javascript'>
function prikazi(id){
	window.location = 'oneEventDisplay.php?id='+id;
	}
function izmeni(id){
	window.location = 'eventEdit.php?id='+id;
	}
	
</script>
</head>
<body>
<?php

//konekcija sa bazom
include_once"database_connect.php";

//citanje unetih podatka
$naslov = mysql_real_escape_string(trim($_POST["naslov"]));
$d1 = mysql_real_escape_string(trim($_POST["d1"]));
$m1 = mysql_real_escape_string(trim($_POST["m1"]));
$g1 = mysql_real_escape_string(trim($_POST["g1"]));
$program= mysql_real_escape_string(trim($_POST["program"]));
$tekst= mysql_real_escape_string(trim($_POST["tekst"]));
$skr_tekst= mysql_real_escape_string(trim($_POST["skr_tekst"]));

$vremeUnosa = date('r');
$kreator = $_SESSION['user'];
// *****************************************************************nadji najveci id u tabeli event i uvecaj ga za jedan
$query =("select max(idTabele) maxId from vesti;");
$result = mysql_query($query);
if(!$result){
	die("<br/><span style='color:red'>greska u izvrsavnju SQL izraza koji trazi najveci broj</span><br/>");
}
// na najveci ID broj dodajem 1 to je ID broj koji se koristi za upis sledeceg dogadjaja
$idTabele = mysql_result($result,0);
$idTabele++;
//**********************************************************************************************blok za upis slike uz tekst

if($_FILES['slikaUzTekst']['size'] > 0){
$fileName = rand(1000000,9999999);
$fileType =  rtrim(substr( $_FILES['slikaUzTekst']['type'],6,6));
$uploadFolder = "files/";// upload folder
//ako se koristi tupavi IE za upload umesto jpeg bice pjpeg!?! Zato mora ovo
if($fileType == "pjpeg")$fileType = "jpeg";//tip fajla
$path = $uploadFolder.$fileName.".".$fileType; 
//copy file to where you want to store file
$copy = copy($_FILES['slikaUzTekst']['tmp_name'], $path);
 // prompt if successfully copied
 if($copy){
 echo "<span style='color:green'>Slika uz tekst je uspesno uploudovana</span><br/><br/>";
 }else{
 die ( "<span style='color:red'>Slika uz tekst nije uspesno uploudovana</span><br/><br/>");
 }
}
else{
	$path = 0;
	echo "<span style='color:red'>Niste izabrali sliku uz tekst ili je slika veca od 1MB!</span><br>";//ako slika nije uplodovana nema linka
	} 	
//***********************************************************************************izraz za upis u novog dogadjaja u bazu 

$query2 = "INSERT INTO vesti (skrTekst,idTabele,tekst, slika, program, d1, m1, g1, naslovVesti, kreator, vremeUnosa) VALUES ('$skr_tekst',$idTabele,'$tekst', '$path', '$program', $d1, $m1, $g1,  '$naslov', '$kreator', '$vremeUnosa');";
//echo $query2;
$result2 = mysql_query($query2);
if(!$result2){
	die("
	  <span style='color:red;'><br />
      <br />
      greska u izvrsavnju SQL izraza2</span></a>");
}

//************************************************************************************ispis html stranice
?>
<div class="container">
<br />
<br />
<div class="result" style='color:green'>Unos u bazu je uspešan.</span></div>
<br />
<br />
<br />
<div class="result"><a class="result2" href='eventEntryNews.php'>Novi unos</a></div>
<div class="result"><a class="result2" href='searchNews.php'>Pretraga, izmena i brisanje događaja</a></div>
<div class="result"><a class="result2" href='displayNews.php?id=(<?php echo $idTabele;?>)'>Prikaži unet događaj</a></div>
<div class="result"><a class="result2" href='adminIndex.php'>Glavni meni</a></div>
<div class="result"><a class="result2" href='logout.php'>Izloguj se</a></div>
<br />
</div><!--container-->
</body>
</html>
<?php }?>