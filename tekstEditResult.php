<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Potvrda o izmeni teksta </title>
<LINK href="ContentManagmentStylesheet.css" rel="stylesheet" type="text/css">
<LINK href="http://dksg.rs/main.css" rel="stylesheet" type="text/css">
<script type='text/javascript'>
function prikazi(id){
	window.location = 'oneEventDisplay.php?id='+id;
	}
function izmeni(id){
	window.location = 'tekstEdit.php?id='+id;
	}	
</script>
</head>
<?php
session_start(); 
//konekcija sa bazom
include_once"database_connect.php";
//izbor baze
mysql_select_db("dksg_3120", $con);
	
//citanje unetih podatka
$id = mysql_real_escape_string(trim($_POST["id"]));
$naslov = mysql_real_escape_string(trim($_POST["naslov"]));
$tekst= mysql_real_escape_string(trim($_POST["tekst"]));
$kategorija  = mysql_real_escape_string(trim($_POST["kategorija"]));
$dostupnost = mysql_real_escape_string(trim($_POST["radio"]));
$opis = mysql_real_escape_string(trim($_POST["opis"]));
$kreator = mysql_real_escape_string(trim($_POST["kreator"]));
$vremeUnosa= mysql_real_escape_string(trim($_POST["vremeUnosa"]));
$slikaUzTekstPostojeca= mysql_real_escape_string(trim($_POST["slikaUzTekstPostojeca"]));
$vremeIzmene = date('r');
$editor = $_SESSION['user'];

//*****************************************************************************Ovo se koristi za ispis preview stranice
$query = ("SELECT * FROM tekstovi WHERE (id = $id);");
				 //echo "$query<br />";
$result = mysql_query($query);
if(mysql_num_rows($result)==0){
	die ("Došlo do greške pokušajte kasnije");
	}
$row = mysql_fetch_array($result);	
//******************************************************************************************blok za upis slike uz tekst
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
 echo ( "<span style='color:red'>Slika uz tekst nije uspesno uploudovana</span><br/><br/>");
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

$query2 = "UPDATE tekstovi SET naslov ='$naslov' ,opis='$opis',tekst='$tekst', kategorija='$kategorija', dostupnost='$dostupnost',id=$id,slika='$path',vremeIzmene='$vremeIzmene',editor='$editor' WHERE id='$id'";
$result2 = mysql_query($query2);
//echo '<br>Izraz za upis u bazu:'.$query2;
if(!$result2){
	die("
	  <span style='color:red;'><br />
      <br />
      Greška u izvršavanju SQL upita za upis izmenjeg događaja u tabelu event<br/>Kontaktirajte sistem inženjera</span></a>");
}
//************************************************************************************ispis html stranice
?>

<body class="container">
<div class="container">
<br />
<br />
<span style='color:green'>Unos u bazu je uspešan.</span></div>
<br />
<br />
<br />
<div class="result"><a class="result2" href='javascript:izmeni(<?php echo $id;?>)'>Izmeni unet događaj</a></div>
<div class="result"><a class="result2" href='tekstUnos.php'>Novi unos</a></div>
<div class="result"><a class="result2" href='searchTekst.php'>Pretraga, izmena i brisanje događaja</a></div>
<div class="result"><a class="result2" href='javascript:prikazi(<?php echo $id;?>)'>Prikaži unet događaj</a></div>
<div class="result"><a class="result2" href='adminIndex.php'>Glavni meni</a></div>
<div class="result"><a class="result2" href='logout.php'>Izloguj se</a></div>
<br />

</body>
</html>