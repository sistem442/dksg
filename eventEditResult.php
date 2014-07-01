<?php
include ('Scripts/funkcije.php');
session_start(); 
//konekcija sa bazom
include_once"database_connect.php";
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Potvrda o izmeni teksta </title>
<link href="backEnd.css" rel="stylesheet" type="text/css" />
<LINK href="http://dksg.rs/main.css" rel="stylesheet" type="text/css">
<script type='text/javascript'>
function prikazi(id){
	window.location = 'oneEventDisplay.php?id='+id;
	}
function izmeni(id){
	window.location = 'eventEdit.php?id='+id;
	}	
</script>
</head>
<?php

//citanje unetih podatka
$s_opis = mysql_real_escape_string(trim($_POST["s_opis"]));
$vreme_mesto = mysql_real_escape_string(trim($_POST["vreme_mesto"]));
$id = mysql_real_escape_string(trim($_POST["id"]));
$imePrograma = mysql_real_escape_string(trim($_POST["imePrograma"]));
$dan = mysql_real_escape_string(trim($_POST["dan"]));
$mesec = mysql_real_escape_string(trim($_POST["mesec"]));
if(strlen($dan)==1){$dan='0'.$dan;}
if(strlen($mesec)==1){$mesec='0'.$mesec;}
$godina = mysql_real_escape_string(trim($_POST["godina"]));
$datum = $godina.$mesec.$dan;
$program= mysql_real_escape_string(trim($_POST["program"]));
$skrTekst = mysql_real_escape_string(trim($_POST["skrTekst2"]));
$tekst= mysql_real_escape_string(trim($_POST["tekst"]));
$mesto  = mysql_real_escape_string(trim($_POST["mesto"]));
$ucesnici = mysql_real_escape_string(trim($_POST["ucesnici"]));
$prioritet= mysql_real_escape_string(trim($_POST["prioritet"]));
if(isset($_POST["izmena"])) $izmena = mysql_real_escape_string(trim($_POST["izmena"]));else $izmena = NULL;
if(isset($_POST["k_reci"])) $k_reci = mysql_real_escape_string(trim($_POST["k_reci"]));else $k_reci = NULL;
if(isset($_POST["podnaslov"]))$podnaslov = mysql_real_escape_string(trim($_POST["podnaslov"]));else $podnaslov = NULL;
if(isset($_POST["nadnaslov"])) $nadnaslov = mysql_real_escape_string(trim($_POST["nadnaslov"]));else $nadnaslov = NULL;
if(isset($_POST["napomene"]))$napomene = mysql_real_escape_string(trim($_POST["napomene"]));else $napomene = NULL;
if(isset($_POST["signature"])) $signature = mysql_real_escape_string(trim($_POST["signature"]));else $signature = NULL;
$kreator = mysql_real_escape_string(trim($_POST["kreator"]));
$vremeUnosa= mysql_real_escape_string(trim($_POST["vremeUnosa"]));
$fotograf = mysql_real_escape_string(trim($_POST["fotograf"]));
$slikaUzTekstPostojeca= mysql_real_escape_string(trim($_POST["slikaUzTekstPostojeca"]));
$vremeIzmene = date('r');
$editor = $_SESSION['user'];

//*****************************************************************************Ovo se koristi za ispis preview stranice
$query = ("SELECT * FROM event WHERE (id = $id);");
				 //echo "$query<br />";
$result = mysql_query($query);
if(mysql_num_rows($result)==0){
	die ("Došlo do greške pokušajte kasnije");
	}
$row = mysql_fetch_array($result);	

//***************************************************************************************blok za upis dodatnih fajlova

$i = 0;
//koliko ima fajlova
$brojFajlova= mysql_real_escape_string(trim($_POST["brojFajlova"]));
//echo "broj fajlova:".$brojFajlova."<br/>";
if($brojFajlova > 0){//ako ima dodatnih fajlova za upis u bazu
//echo "broj fajlova:".$brojFajlova."<br/>";
//Ime prvog fajla za jedan event 
$fileName = time();
$fileName = $fileName + rand(10000,99999); 
$uploadFolder = "files/";// upload folder
//Petlja za unos u tabelu fajlovi
while($i<$brojFajlova){	
	$komentar = mysql_real_escape_string(trim($_POST[$i.'komentar']));
	//echo $komentar;
    $fileType =  substr(strrchr($_FILES[$i]['name'],'.'), 1);
	//echo $fileType;
	switch($fileType){
	case('png'): $fileClass = 'slika';$galerija = $_POST[$i.'galerija'];
	break;
	case('jpg'): $fileClass = 'slika';$galerija = $_POST[$i.'galerija'];
	break;
	case('jpeg'): $fileClass = 'slika';$galerija = $_POST[$i.'galerija'];
	break;
	case('gif'): $fileClass = 'slika';$galerija = $_POST[$i.'galerija'];
	break;
	case('flv'): $fileClass = 'video';$galerija = 200;
	break;
	case('mp3'): $fileClass = 'zvuk';$galerija = 200;
	break;
	case('wav'): $fileClass = 'zvuk';$galerija = 200;
	break;
	default : $fileClass = 'ostali';$galerija = 200;
	}
	//echo $fileClass;
	//Ako je fajl slika upisi i izbor da li se prikazuje u galeriji
	if ($galerija != 200){
	$path = $uploadFolder.$fileName.".".$fileType;
    $query3 = "INSERT INTO fajlovi ( klasaFajla, tipFajla, vreme, komentar, path, ime, korisnik,id,galerija) VALUES ('$fileClass','$fileType','$vremeUnosa','$komentar','$path','".$_FILES[$i]['name']."','$kreator',$id,'$galerija');";
	//echo $query3;
	$result3 = mysql_query($query3);
    if(!$result3){
	   echo("
	      <br />
          <span style='color:red'>Greska u izvrsavnju pri upisu dodatnih fajlova u bazu! Ako ste pokušali da na sajt postavite sliku proverite da li je manja od 1MB i da je jpeg, gif ili png format.</span>");
    }	
	}
	//kraj if ako se ubacuje slika u bazu
	//ako nije slika nemoj upisivati da li slika ide u galeriju
	else{
		$path = $uploadFolder.$fileName.".".$fileType;
    $query3 = "INSERT INTO fajlovi ( klasaFajla, tipFajla, vreme, komentar, path, ime, korisnik,id) VALUES ('$fileClass','$fileType','$vremeUnosa','$komentar','$path','".$_FILES[$i]['name']."','$kreator',$id);";
	$result3 = mysql_query($query3);
    if(!$result3){
	   echo("
	      <br />
          <span style='color:red'>Greska u izvrsavnju pri upisu dodatnih fajlova u bazu!</span>");
    }
		}
	//sacuvaj fajl
	//echo '<br>temp ime je:'.$_FILES[$i]['tmp_name'].$i.'<br>';
	//$copy = move_uploaded_file($_FILES[$i]['tmp_name'], $path);
	$copy = copy($_FILES[$i]['tmp_name'], $path);
    /* prompt if successfully copied*/
    if($copy){
    echo "<span style='color:green'>Fajl ".$_FILES[$i]['name']." je uspesno uploudovan</span><br/><br/>";
    }else{
    die ( "<span style='color:red'>Fajl ".$_FILES[$i]['name']." nije uspesno uploudovan</span><br/><br/>");
    }
    $i++;
	//echo "<br>i posle ++ je ".$i;
	$fileName++;
};//kraj while
}//dovde se izvrsava 'if' ako ima dodatnih fajlova za upis u bazu 
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
//******************************************************************************izmena vrsta arhiviranog materijala ako je materijal setovan na da upisuje se id broj dogadjaja u odgobvarajucu tabelu 	
$plakat = 'ne';
$pozivnica = 'ne';
$katalog = 'ne';
$fotografija = 'ne';
$video = 'ne';
$zvuk = 'ne';
$publikacija = 'ne';
$materijalProgram = 'ne';
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
if(isset($_POST['zvuk'])) {
    $zvuk = 'da';
}
if(isset($_POST['publikacija'])) {
    $publikacija = 'da';
}	
if(isset($_POST['materijalProgram'])) {
    $materijalProgram = 'da';
}	

//***********************************************************************************izraz za upis u novog dogadjaja u bazu 

$query2 = "UPDATE event SET imePrograma='$imePrograma' ,dan=$dan,mesec=$mesec, godina=$godina, datum=$datum,program='$program',mesto='$mesto',skrTekst='$skrTekst',tekst='$tekst',ucesnici='$ucesnici',prioritet='$prioritet',slika='$path',podnaslov='$podnaslov',nadnaslov='$nadnaslov',napomene='$napomene',signature='$signature',vremeIzmene='$vremeIzmene',editor='$editor',k_reci='$k_reci',s_opis='$s_opis',izmena='$izmena',vreme_mesto='$vreme_mesto',fotograf='$fotograf' WHERE id='$id'";
upisiMaterijal($id,$plakat,$pozivnica,$katalog,$fotografija,$video,$zvuk,$publikacija,$materijalProgram);
$result2 = mysql_query($query2);
//echo '<br>Izraz za upis u bazu:'.$query2.'<br/>';
//echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
if(!$result2){
	die("
	  <span style='color:red;'><br />
      <br />
      greska u izvrsavnju SQL za upis izmenjeog dogadjaja u tabelu event</span></a>");
}
//************************************************************************************ispis html stranice
?>

<body>
<div class="container">
<div class="result" style='color:green'>Unos u bazu je uspešan. ID broj događaja je <?php echo $id;?></div>
<br />
<br />
<br />
<div class="result"><a class="result2" href='javascript:izmeni(<?php echo $id;?>)'>Izmeni unet događaj</a></div>
<div class="result"><a class="result2" href='eventEntry.php'>Novi unos</a></div>
<div class="result"><a class="result2" href='search.php'>Pretraga, izmena i brisanje događaja</a></div>
<div class="result"><a class="result2" href='oneEventDisplay.php?id=(<?php echo $id;?>)' target="_blank">Prikaži unet događaj</a></div>
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