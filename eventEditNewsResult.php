<?php
session_start(); 
//konekcija sa bazom
include_once"database_connect.php";
	
//citanje unetih podatka
$idTabele = mysql_real_escape_string(trim($_POST["idTabele"]));
$naslovVesti = mysql_real_escape_string(trim($_POST["naslovVesti"]));
$d1 = mysql_real_escape_string(trim($_POST["d1"]));
if (strlen($d1) == 1){$d1 = '0'.$d1;}
$m1 = mysql_real_escape_string(trim($_POST["m1"]));
if (strlen($m1) == 1){$m1 = '0'.$m1;}
$g1 = mysql_real_escape_string(trim($_POST["g1"]));
$program= mysql_real_escape_string(trim($_POST["program"]));
$tekst= mysql_real_escape_string(trim($_POST["tekst"]));
$skr_tekst= mysql_real_escape_string(trim($_POST["skr_tekst"]));
$slikaUzTekstPostojeca= mysql_real_escape_string(trim($_POST["slikaUzTekstPostojeca"]));
$vremeIzmene = date('r');
$editor = $_SESSION['user'];

//**********************************************************************************************blok za upis slike uz tekst
if($slikaUzTekstPostojeca == "nema"){//ako slika uz tekst nije postojala u bazi pre izmene dogadjaja upisi novu sliku u bazu
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
else{//ako slika nije izabrana ili je izabrana veca slika
	$path = 0;
	echo "<span style='color:red'>Niste izabrali sliku uz tekst ili je slika veca od 1MB!</span>";//ako slika nije uplodovana nema linka
	} 	
}
else{$path = $slikaUzTekstPostojeca;//ako slika jeste postojala upisi staru vrednost ili novu sliku
	}
//***********************************************************************************izraz za upis u novog dogadjaja u bazu 

$query2 = "UPDATE vesti SET naslovVesti='$naslovVesti', tekst='$tekst',skrTekst='$skr_tekst', slika='$path', program='$program', d1=$d1, m1=$m1, g1=$g1 WHERE idTabele=$idTabele;";
$result2 = mysql_query($query2);
if(!$result2){
	die("
	  <span style='color:red;'><br />
      <br />
      greska u izvrsavnju SQL izraza2</span></a>");
}
//************************************************************************************ispis html stranice
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Potvrda o unosu teksta </title>
<LINK href="ContentManagmentStylesheet.css" rel="stylesheet" type="text/css">
<script type='text/javascript'>
function prikazi(id){
	window.location = 'displayNews.php?id='+id;
	}
	
</script>
</head>
<body class="container">
<div class="container">
<br />
<br />
<span style='color:green'>Unos u bazu je uspešan.</span></div>
<br />
<br />
<br />
<div class="result"><a class="result2" href='eventEntryNews.php'>Novi unos</a></div>
<div class="result"><a class="result2" href='searchNews.php'>Pretraga, izmena i brisanje vesti</a></div>
<div class="result"><a class="result2" href='javascript:prikazi(<?php echo $idTabele;?>)'>Prikaži unet događaj</a></div>
<div class="result"><a class="result2" href='adminIndex.php'>Glavni meni</a></div>
<div class="result"><a class="result2" href='logout.php'>Izloguj se</a></div>
<br />
</div><!--container-->
</body>
</html>