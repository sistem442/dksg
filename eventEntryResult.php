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
include ('Scripts/funkcije.php');
//konekcija sa bazom
include_once"database_connect.php";

// *****************************************************************nadji najveci id u tabeli event i uvecaj ga za jedan
$query =("select max(id) maxId from event;");
$result = mysql_query($query);
if(!$result){
	die("<br/><span style='color:red'>greska u izvrsavnju SQL izraza koji trazi najveci broj</span><br/>");
}
// na najveci ID broj dodajem 1 to je ID broj koji se koristi za upis sledeceg dogadjaja
$id = mysql_result($result,0);
$id++;


//*********************************************************************************citanje unetih podataka*************
$s_opis = mysql_real_escape_string(trim($_POST["s_opis"]));
$imePrograma = mysql_real_escape_string(trim($_POST["imePrograma"]));
$program = mysql_real_escape_string(trim($_POST["program"]));
$skrTekst = mysql_real_escape_string(trim($_POST["skrTekst"]));
$tekst = mysql_real_escape_string(trim($_POST["tekst"]));
$mesto  = mysql_real_escape_string(trim($_POST["mesto"]));
$vreme_mesto = mysql_real_escape_string(trim($_POST["vreme_mesto"]));
$fotograf = mysql_real_escape_string(trim($_POST["fotograf"])); if ($fotograf == '')$fotograf = 'nema'; 
if(isset($_POST["k_reci"])) $k_reci = mysql_real_escape_string(trim($_POST["k_reci"]));else $k_reci = NULL;
$ucesnici = mysql_real_escape_string(trim($_POST["ucesnici"]));
$prioritet= mysql_real_escape_string(trim($_POST["prioritet"]));
if(isset($_POST["podnaslov"]))$podnaslov = mysql_real_escape_string(trim($_POST["podnaslov"]));else $podnaslov = 'NULL';
if(isset($_POST["nadnaslov"])) $nadnaslov = mysql_real_escape_string(trim($_POST["nadnaslov"]));else $nadnaslov = NULL;
if(isset($_POST["napomene"]))$napomene = mysql_real_escape_string(trim($_POST["napomene"]));else $napomene = NULL;
if(isset($_POST["signature"])) $signature = mysql_real_escape_string(trim($_POST["signature"]));else $signature = NULL;
$vremeUnosa = date('r');
$mesecUnosa = date('m');
$godinaUnosa = date('Y');
$kreator = $_SESSION['user'];
//***************************************************************************************blok za upis datuma***********
$jedanDan =	mysql_real_escape_string(trim($_POST["jedanDan"]));
$viseDana = mysql_real_escape_string(trim($_POST["viseDana"]));
$ponavljaSe = mysql_real_escape_string(trim($_POST["ponavljaSe"]));
if($jedanDan == 'on'){
	$periodicni = 'ne';	
	$dan = mysql_real_escape_string(trim($_POST["dan"]));
	$mesec = mysql_real_escape_string(trim($_POST["mesec"]));
	$godina = mysql_real_escape_string(trim($_POST["godina"]));
	if(strlen($dan)==1){$dan='0'.$dan;}
	if(strlen($mesec)==1){$mesec='0'.$mesec;}
	$datum = $godina.$mesec.$dan;
}
if($viseDana == 'on'){
	$periodicni = 'ne';
	$dan1 = mysql_real_escape_string(trim($_POST["dan1"]));
	if (strlen($dan1) == 1){$dan1 = '0'.$dan1;}
	$mesec1 = mysql_real_escape_string(trim($_POST["mesec1"]));
	if (strlen($mesec1) == 1){$mesec1 = '0'.$mesec1;}
	$godina1 = mysql_real_escape_string(trim($_POST["godina1"]));
	$dan2 = mysql_real_escape_string(trim($_POST["dan2"]));
	if (strlen($dan2) == 1){$dan2 = '0'.$dan2;}
	$mesec2 = mysql_real_escape_string(trim($_POST["mesec2"]));
	if (strlen($mesec2) == 1){$mesec2 = '0'.$mesec2;}
	$godina2 = mysql_real_escape_string(trim($_POST["godina2"]));
	if(strlen($dan1)==1){$dan1='0'.$dan1;}
		if(strlen($mesec1)==1){$mesec1='0'.$mesec1;}
		$datum = $godina1.$mesec1.$dan1;
}
if($ponavljaSe == 'on'){
	$periodicni = 'da';
	$dan1 = mysql_real_escape_string(trim($_POST["dan1"]));
	if (strlen($dan1) == 1){$dan1 = '0'.$dan1;}
	$mesec1 = mysql_real_escape_string(trim($_POST["mesec1"]));
	if (strlen($mesec1) == 1){$mesec1 = '0'.$mesec1;}
	$godina1 = mysql_real_escape_string(trim($_POST["godina1"]));
	$dan2 = mysql_real_escape_string(trim($_POST["dan2"]));
	if (strlen($dan2) == 1){$dan2 = '0'.$dan2;}
	$mesec2 = mysql_real_escape_string(trim($_POST["mesec2"]));
	if (strlen($mesec2) == 1){$mesec2 = '0'.$mesec2;}
	$godina2 = mysql_real_escape_string(trim($_POST["godina2"]));
	if(strlen($dan1)==1){$dan1='0'.$dan1;}
	if(strlen($mesec1)==1){$mesec1='0'.$mesec1;}
	$datum = $godina1.$mesec1.$dan1;
	$pon = 0;
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
}	
//**********************************************************************deo za upis u tabelu vrste materijala
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
if(isset($_POST['audio'])) {
    $zvuk = 'da';
}
if(isset($_POST['publikacija'])) {
    $publikacija = 'da';
}
if(isset($_POST['materijalProgram'])) {
    $materijalProgram = 'da';
}	
	
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
	if(isset($_POST[$i.'galerija'])) $galerija =$_POST[$i.'galerija'];
	else $galerija = 'ne';
	$komentar = mysql_real_escape_string(trim($_POST[$i.'komentar']));
	//echo $komentar;
    $fileType =  substr(strrchr($_FILES[$i]['name'],'.'), 1);
	//echo $fileType;
	switch($fileType){
	case('png'): $fileClass = 'slika';
	break;
	case('jpg'): $fileClass = 'slika';
	break;
	case('jpeg'): $fileClass = 'slika';
	break;
	case('gif'): $fileClass = 'slika';
	break;
	case('flv'): $fileClass = 'video';
	break;
	case('mp3'): $fileClass = 'zvuk';
	break;
	case('wav'): $fileClass = 'zvuk';
	break;
	default : $fileClass = 'ostali';
	}
	$path = $uploadFolder.$fileName.".".$fileType;
    $query3 = "INSERT INTO fajlovi ( klasaFajla, tipFajla, vreme, komentar, path, ime, korisnik,id,galerija) VALUES ('$fileClass','$fileType','$vremeUnosa','$komentar','$path','".$_FILES[$i]['name']."','$kreator',$id,'$galerija');";
	//echo "<br>izraz za upis u bazu".$query3;
	$result3 = mysql_query($query3);
    if(!$result3){
	   echo("
	      <br />
          <span style='color:red'>Greška prilikom rada sa fajlom '".$_FILES[$i]['name']."', ako ste pokušali da na sajt postavite sliku proverite da li je manja od 1MB i da je jpeg, gif ili png format.</span>");
    }	
	//sacuvaj fajl
	$copy = move_uploaded_file($_FILES[$i]['tmp_name'], $path);
    if($copy){
    echo "<span style='color:green'>Fajl ".$_FILES[$i]['name']." je uspesno uploudovan</span><br/><br/>";
    }else{
    echo ("<span style='color:red'>Fajl ".$_FILES[$i]['name']." nije uspešno uploudovan! Ako ste pokušali da na sajt postavite sliku proverite da li je manja od 1MB i da je jpeg, gif ili png format.</span><br/><br/>");
    }
    $i++;
	$fileName++;
};//kraj while
}//dovde se izvrsava 'if' ako ima dodatnih fajlova za upis u bazu 
//******************************************************************************************blok za upis slike uz tekst

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
 echo "<span style='color:green'>Slika uz tekst je uspešno uploudovana</span><br/><br/>";
 }else{
 echo ( "<span style='color:red'>Slika uz tekst nije uspešno uploudovana! Proverite da li je manja od 1MB i da je jpeg, gif ili png format.</span><br/><br/>");
 }
}
else{
	$path = 0;
	echo "<div class='result'><span style='color:red'>Niste izabrali sliku uz tekst ili je slika veca od 1MB!</span></div>";//ako slika nije uplodovana nema linka
	} 	
//***********************************************************************************izraz za upis u novog dogadjaja u bazu 
if($viseDana == 'on'){//ako je unet dogadjaj koji traje vise dana neupisuj datum u bazu
$query2 = "INSERT into event (id,imePrograma,dan,mesec,godina,datum,program,mesto,skrTekst,tekst,ucesnici,prioritet,slika,podnaslov,nadnaslov,napomene,signature,vremeUnosa,kreator,mesecUnosa,godinaUnosa,vreme_mesto,s_opis,k_reci,fotograf)
VALUES($id,'$imePrograma',$dan1,$mesec1,$godina1,$datum,'$program','$mesto','$skrTekst','$tekst','$ucesnici',$prioritet,'$path','$podnaslov','$nadnaslov','$napomene','$signature','$vremeUnosa','$kreator',$mesecUnosa,$godinaUnosa,'$vreme_mesto','$s_opis','$k_reci','$fotograf');";
$result2 = mysql_query($query2);
upisiMaterijal($id,$plakat,$pozivnica,$katalog,$fotografija,$video,$zvuk,$publikacija,$materijalProgram);
//echo '<br>greska:'.mysql_errno($con) . ": " . mysql_error($con) . "\n";
//echo '<br>Izraz za upis u bazu:'.$query2;
if(!$result2){
	die("
	  <span style='color:red;'><br />
      <br />
      Greska u izvrsavnju SQL izraza za upis događaja koji traje vise dana!</span></a>");
}
}
else if($jedanDan == 'on'){
$query2 = "INSERT into event (id,imePrograma,dan,mesec,godina,datum,program,mesto,skrTekst,tekst,ucesnici,prioritet,slika,podnaslov,nadnaslov,napomene,signature,vremeUnosa,kreator,mesecUnosa,godinaUnosa,vreme_mesto,s_opis,k_reci,fotograf) VALUES ($id,'$imePrograma',$dan,$mesec,$godina,$datum,'$program','$mesto','$skrTekst','$tekst','$ucesnici',$prioritet,'$path','$podnaslov','$nadnaslov','$napomene','$signature','$vremeUnosa','$kreator',$mesecUnosa,$godinaUnosa,'$vreme_mesto','$s_opis','$k_reci','$fotograf');";
upisiMaterijal($id,$plakat,$pozivnica,$katalog,$fotografija,$video,$zvuk,$publikacija,$materijalProgram);
$result2 = mysql_query($query2);
//echo '<br>Izraz za upis u bazu:'.$query2;
//echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
if(!$result2){
	die("
	  <span style='color:red;'><br />
      <br />
      Greska u izvrsavnju SQL izraza koji upisuje dogadjaj koji traje jedan dan!</span></a>");
}
}
else if($ponavljaSe == 'on'){
$query2 = "INSERT into event (id,imePrograma,dan,mesec,godina,datum,program,mesto,skrTekst,tekst,ucesnici,prioritet,slika,podnaslov,nadnaslov,napomene,signature,vremeUnosa,kreator,mesecUnosa,godinaUnosa,vreme_mesto,s_opis,k_reci,fotograf) VALUES ($id,'$imePrograma',$dan1,$mesec1,$godina1,$datum,'$program','$mesto','$skrTekst','$tekst','$ucesnici',$prioritet,'$path','$podnaslov','$nadnaslov','$napomene','$signature','$vremeUnosa','$kreator',$mesecUnosa,$godinaUnosa,'$vreme_mesto','$s_opis','$k_reci','$fotograf');";
upisiMaterijal($id,$plakat,$pozivnica,$katalog,$fotografija,$video,$zvuk,$publikacija,$materijalProgram);
$result2 = mysql_query($query2);
//echo '<br>Izraz za upis u bazu:'.$query2;
//echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
if(!$result2){
	die("
	  <span style='color:red;'><br />
      <br />
      Greska u izvrsavnju SQL izraza koji upisuje dogadjaj koji se ponavlja!</span></a>");
}
}
//***********************************************************************izraz za upis u novog dogadjaja u tabelu opseg
if(($viseDana == 'on') ||($ponavljaSe=='on')){
$query3 = "INSERT into opseg (id,prviDatum,drugiDatum,periodicni) VALUES ($id,$godina1$mesec1$dan1,$godina2$mesec2$dan2,'$periodicni');";
//echo $query3;
$result3 = mysql_query($query3);
//echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
if(!$result3){
	die("
	  <span style='color:red;'><br />
      <br />
      greska u izvrsavnju SQL izraza !3</span></a>");
}
}
//**************************************************************************Upis u tabelu periodicni********************
if($ponavljaSe == 'on'){
$query4 = "INSERT INTO periodicni (id, pon, uto, sre, cet, pet, sub, ned) VALUES ($id, $pon, $uto, $sre, $cet, $pet, $sub, $ned);";
$result4 = mysql_query($query4);
//echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
if(!$result4){
	die("
	  <span style='color:red;'><br />
      <br />
      Greska u izvrsavnju SQL izraza 4!</span></a>");
}
}
//************************************************************************************ispis html stranice
$query = ("SELECT * FROM event WHERE (id = $id);");
				 //echo "$query<br />";
$result = mysql_query($query);
//echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
if(mysql_num_rows($result)==0){
	die ("Došlo do greške, obavestite sistem inženjera!");
	}
$row = mysql_fetch_array($result);	
?>

<body onload="noBack();"
    onpageshow="if (event.persisted) noBack();" onunload="">
<div class="container">
<div class="result" style='color:green'>Unos u bazu je uspešan. ID broj događaja je <?php echo $id;?></div>
<br />
<br />
<br />
<div class="result"><a class="result2" href='eventEdit.php?id=(<?php echo $id;?>)'>Izmeni unet događaj</a></div>
<div class="result"><a class="result2" href='eventEntry.php?arhiva="false"'>Unos novog dogadjaja</a></div>
<div class="result"><a class="result2" href='eventEntry.php?arhiva="true"'>Unos starog dogadjaja</a></div>
<div class="result"><a class="result2" href='search.php'>Pretraga, izmena i brisanje događaja</a></div>
<div class="result"><a class="result2" href='oneEventDisplay.php?id=(<?php echo $id;?>)' target="_blank">Prikaži unet događaj</a></div>
<div class="result"><a class="result2" href='adminIndex.php'>Glavni meni</a></div>
<div class="result"><a class="result2" href='logout.php'>Izloguj se</a></div>
<br />
<br />
<br />
<form action="Dom_kulture_program.php" method="post">
<div style="background:#090; padding:10px">
	PRIKAZ STRANICE ZA PROGRAM 
    	<select name="program" id="program">
            <option value="likovni">likovni</option>
            <option value="filmski">filmski</option>
            <option value="muzicki">muzicki</option>
            <option value="pozorisni">pozorisni</option>
            <option value="forum">forum</option>
            <option value="knjizevni">knjizevni</option>
            <option value="afc">afc</option>
            <option value="biblioteka">biblioteka</option>
            <option selected="selected" value="program">Izaberite program</option>
        </select>
 mesec:
 		<select name="mesec"id="mesec" >
              <option selected="selected" value="program">Izaberite mesec</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>
              <option>7</option>
              <option>8</option>
              <option>9</option>
              <option>10</option>
              <option>11</option>
              <option>12</option>
        </select>
godinu:
		<select name="godina" id="godina" >
 			<option selected="selected" value="program">Izaberite godinu</option>
			<option>2015</option>
            <option>2014</option>
            <option>2013</option>
            <option>2012</option>
        </select> 
<input type="submit" value="Prikaži"/>
</div>
</form>

</div>
<!--container-->

</body>
</html>
<?php }?>