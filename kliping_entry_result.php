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
	window.history.forward();
    function noBack() { window.history.forward(); }	
</script>
</head>
<body onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">
<?php
//konekcija sa bazom
include_once"database_connect.php";

// *****************************************************************nadji najveci id u tabeli event i uvecaj ga za jedan
$query =("select max(id) maxId from kliping;");
$result = mysql_query($query);
if(!$result){
	die("<br/><span style='color:red'>greska u izvrsavnju SQL izraza koji trazi najveci broj</span><br/>");
}
// na najveci ID broj dodajem 1 to je ID broj koji se koristi za upis sledeceg dogadjaja
$id = mysql_result($result,0);
$id++;


//*********************************************************************************citanje unetih podataka*************
$kategorija = mysql_real_escape_string(trim($_POST["kategorija"]));
$flag = mysql_real_escape_string(trim($_POST["flag"]));
$id_dogadjaja_2 = mysql_real_escape_string(trim($_POST["id_dogadjaja_2"]));
$id_dogadjaja = mysql_real_escape_string(trim($_POST["id_dogadjaja"]));
$naslov_klipinga = mysql_real_escape_string(trim($_POST["naslov_klipinga"]));
$naslov_dogadjaja = mysql_real_escape_string(trim($_POST["naslov_dogadjaja"]));
$strana = mysql_real_escape_string(trim($_POST["strana"]));
$medij  = mysql_real_escape_string(trim($_POST["medij"]));
if(isset($_POST["kod"])) $sadrzaj = mysql_real_escape_string(trim($_POST["kod"]));else $sadrzaj = NULL;
$dan_unosa = mysql_real_escape_string(trim($_POST["dan_unosa"]));
$mesec_unosa = mysql_real_escape_string(trim($_POST["mesec_unosa"]));
$godina_unosa = mysql_real_escape_string(trim($_POST["godina_unosa"]));
$kreator = $_SESSION['user'];
$datum = $godina_unosa.$mesec_unosa.$dan_unosa;
//******************************************************************************************blok za upis slike 
if ($flag == 'slika'){
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
			 $slika = $path;
			 echo "<span style='color:green'>Slika uz tekst je uspešno uploudovana</span><br/><br/>";
		 }
		 else{
			 echo ( "<span style='color:red'>Slika uz tekst nije uspešno uploudovana! 
			 Proverite da li je manja od 1MB i da je jpeg, gif ili png format.</span><br/><br/>");
		 }
	}
	else{
		$path = 0;
		echo "<div class='result'><span style='color:red'>Niste izabrali sliku uz tekst ili 
		je slika veca od 1MB!</span></div>";//ako slika nije uplodovana nema linka
	} 	
}
else $slika = 0;
//***********************************************************************************izraz za upis u novog klipinga 
$query2 = "INSERT into kliping (kategorija,id_dogadjaja,id_dogadjaja_2,naslov_klipinga,naslov_dogadjaja,sadrzaj,slika,strana,medij,
	dan_unosa,mesec_unosa,godina_unosa,kreator,flag,datum)
	VALUES('$kategorija','$id_dogadjaja','$id_dogadjaja_2','$naslov_klipinga','$naslov_dogadjaja','$sadrzaj','$slika','$strana','$medij', $dan_unosa, $mesec_unosa, $godina_unosa,  '$kreator','$flag',$datum);";
$result2 = mysql_query($query2);
echo '<br>greska:'.mysql_errno($con) . ": " . mysql_error($con) . "\n";
echo '<br>Izraz za upis u bazu:'.$query2;
if(!$result2){
	die("
	  <span style='color:red;'><br />
      <br />
      Greska u izvrsavnju SQL izraza za upis klipinga, obavestite sistem inzenjera!</span></a>");
}
//************************************************************************************ispis html stranice
$query = ("SELECT * FROM kliping WHERE (id = $id);");
echo "$query<br />";
$result = mysql_query($query);
echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
if(mysql_num_rows($result)==0){
	die ("Došlo do greške, obavestite sistem inženjera!");
	}
$row = mysql_fetch_array($result);	
?>

<body onload="noBack();"
    onpageshow="if (event.persisted) noBack();" onunload="">
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

</div>
<!--container-->

</body>
</html>
<?php }?>