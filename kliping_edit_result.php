<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Potvrda o izmeni klipinga </title>
<link href="backEnd.css" rel="stylesheet" type="text/css" />
<LINK href="http://dksg.rs/main.css" rel="stylesheet" type="text/css">
<script type='text/javascript'>
</script>
</head>
<?php
include ('Scripts/funkcije.php');
session_start(); 
//konekcija sa bazom
include_once"database_connect.php";

//citanje unetih podatka
$id = $_POST["id"];
$kategorija =  mysql_real_escape_string(trim($_POST["kategorija"]));
$id_dogadjaja = mysql_real_escape_string(trim($_POST["id_dogadjaja"]));
$id_dogadjaja_2 = mysql_real_escape_string(trim($_POST["id_dogadjaja_2"]));
$naslov_klipinga = mysql_real_escape_string(trim($_POST["naslov_klipinga"]));
$naslov_dogadjaja = mysql_real_escape_string(trim($_POST["naslov_dogadjaja"]));
$strana = mysql_real_escape_string(trim($_POST["strana"]));
$medij  = mysql_real_escape_string(trim($_POST["medij"]));
if(isset($_POST["kod"])){ 
	$sadrzaj = mysql_real_escape_string(trim($_POST["kod"]));
	$flag = 'kod';
}
else $sadrzaj = NULL;
$flag = 'slika';
$dan_unosa = mysql_real_escape_string(trim($_POST["dan_unosa"]));
$mesec_unosa = mysql_real_escape_string(trim($_POST["mesec_unosa"]));
if(strlen($dan_unosa)==1){$dan_unosa='0'.$dan_unosa;}
if(strlen($mesec_unosa)==1){$mesec_unosa='0'.$mesec_unosa;}
$godina_unosa = mysql_real_escape_string(trim($_POST["godina_unosa"]));
$slikaUzTekstPostojeca = $_POST["slikaUzTekstPostojeca"];
$datum = $godina_unosa.$mesec_unosa.$dan_unosa;
//*****************************************************************************Ovo se koristi za ispis preview stranice
$query = ("SELECT * FROM kliping WHERE (id = $id);");
				 //echo "$query<br />";
$result = mysql_query($query);
if(mysql_num_rows($result)==0){
	die ("Došlo do greške pri upisu u bazu, obavestite sistem inženjera");
	}
$row = mysql_fetch_array($result);	

//******************************************************************************************blok za upis slike uz tekst
if($slikaUzTekstPostojeca == "nema"){//ako slika uz tekst nije postojala u bazi pre izmene dogadjaja upisi novu sliku u bazu
if($_FILES['slika']['size'] > 0){
$fileName = rand(1000000,9999999);
$fileType =  rtrim(substr( $_FILES['slika']['type'],6,6));
$uploadFolder = "files/";// upload folder
//ako se koristi tupavi IE za upload umesto jpeg bice pjpeg!?! Zato mora ovo
if($fileType == "pjpeg")$fileType = "jpeg";//tip fajla
$path = $uploadFolder.$fileName.".".$fileType; 
//copy file to where you want to store file
$copy = copy($_FILES['slika']['tmp_name'], $path);
 // prompt if successfully copied
 if($copy){
	$flag = 'slika';
 	echo "<span style='color:green'>Slika uz tekst je uspesno uploudovana</span><br/><br/>";
 }else{
 	echo ( "<span style='color:red'>Slika uz tekst nije uspesno uploudovana</span><br/><br/>");
 }
}
}
else{$path = $slikaUzTekstPostojeca;//ako slika jeste postojala upisi staru vrednost ili novu sliku
	}
//********************************************************************************izraz za upis u novog klipinga u bazu 
$query2 = "UPDATE kliping 
			SET kategorija = '$kategorija', id_dogadjaja='$id_dogadjaja',id_dogadjaja_2='$id_dogadjaja_2',naslov_klipinga='$naslov_klipinga',naslov_dogadjaja='$naslov_dogadjaja',
			sadrzaj='$sadrzaj',slika='$path',strana=$strana,medij='$medij',
			dan_unosa=$dan_unosa,mesec_unosa=$mesec_unosa,godina_unosa=$godina_unosa,flag='$flag', datum = $datum WHERE id = $id";
$result2 = mysql_query($query2);
//echo '<br>Izraz za upis u bazu:'.$query2.'<br/>';
//echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
if(!$result2){
	die("
	  <span style='color:red;'><br />
      <br />
      greska u izvrsavnju SQL za upis izmenjenog dogadjaja u tabelu kliping</span></a>");
}
//************************************************************************************ispis html stranice
?>

<body>
<div class="container">
<div class="result" style='color:green'>Unos u bazu je uspešan. ID broj klipinga je <?php echo $id;?></div>
<br />
<br />
<br />
<div class="result"><a class="result2" href='kliping_edit.php?id=<?php echo $id;?>'>Izmeni unet klipinga</a></div>
<div class="result"><a class="result2" href='kliping_entry.php'>Unos novog klipinga</a></div>
<div class="result"><a class="result2" href='kliping_search.php'>Izmena klipinga</a></div>
<div class="result"><a class="result2" href='adminIndex.php'>Glavni meni</a></div>
<div class="result"><a class="result2" href='logout.php'>Izloguj se</a></div>
<br />
<br />
<br />
<br />

</DIV>
<!--container-->

</body>
</html>