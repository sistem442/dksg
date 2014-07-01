<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Potvrda o unosu teksta</title>
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
set_time_limit (600);
//konekcija sa bazom
include_once"database_connect.php";
//izbor baze
mysql_select_db("dksg_3120", $con);

// *****************************************************************nadji najveci id u tabeli event i uvecaj ga za jedan
$query =("select max(id) maxId from tekstovi;");
$result = mysql_query($query);
if(!$result){
	die("<br/><span style='color:red'>greska u izvrsavnju SQL izraza koji trazi najveci broj</span><br/>");
}
// na najveci ID broj dodajem 1 to je ID broj koji se koristi za upis sledeceg dogadjaja
$id = mysql_result($result,0);
$id++;


//*********************************************************************************citanje unetih podataka*************
$naslov = mysql_real_escape_string(trim($_POST["naslov"]));
$opis= mysql_real_escape_string(trim($_POST["opis"]));
$tekst = mysql_real_escape_string(trim($_POST["tekst"]));
$kategorija = mysql_real_escape_string(trim($_POST["kategorija"]));
$dostupnost = mysql_real_escape_string(trim($_POST["radio"]));
$vremeUnosa = date('r');
$kreator = $_SESSION['user'];
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
	echo "<span style='color:red'>Niste izabrali sliku uz tekst ili je slika veca od 1MB!</span>";//ako slika nije uplodovana nema linka
	} 	
//***********************************************************************************izraz za upis u novog dogadjaja u bazu 
$query2 = "INSERT into tekstovi (id,naslov,opis,tekst,kategorija,dostupnost,slika,vremeUnosa,kreator)
VALUES($id,'$naslov','$opis','$tekst','$kategorija','$dostupnost','$path','$vremeUnosa','$kreator');";
$result2 = mysql_query($query2);
//echo '<br>Izraz za upis u bazu:'.$query2;
if(!$result2){
	die("
	  <span style='color:red;'><br />
      <br />
      Greska u izvrsavnju SQL izraza za upis teksta u bazu! <br />
      Molim Vas da obavestite sistem inzenjera.
	  </span></a>");
}
//************************************************************************************ispis html stranice
$query = ("SELECT * FROM tekstovi WHERE (id = $id);");
				 //echo "$query<br />";
$result = mysql_query($query);
if(mysql_num_rows($result)==0){
	die ("Došlo do greške pokušajte kasnije");
	}
$row = mysql_fetch_array($result);	
?>

<body class="container">
<div class="container"> <br />
  <br />
  <span style='color:green'>
  Unos u bazu je uspešan. URL teksta je http://www.dksg.rs/tekstDisplay.php?id=<?php echo $id;?> </span></div>
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
<br />
<br />
<div class="result" align="center">PRIKAZ STRANICE:</div>
<br />
<br />
<br />
<DIV id="content">
  <DIV id="header">
    <?php include_once("heder.php") ?>
  </DIV>
  <div id="menu">
    <?php include_once("menu.php"); ?>
  </div>
  <DIV id="image"> <br />
    <br/>
  </DIV>
  <div id="vesti"> </div>
  <DIV id="main">
    <?php


//**************************************************************************blok koji prikazuje sliku i sliku uz tekst
    echo "
     	<table width='425px'>
        	<tr>
			  <td>";
			  if($row['slika']!= '0'){
				  echo"<a href='".$row['slika']."'><img style='float:right; padding:5px;' src='".$row['slika']."' width='150px'></a>";}
				  echo $row['tekst']."<br/>
				  <br/>
			    <td>
			</tr>
		</table>";
//kraj bloka za tekst


?>
  </DIV>
  <!--main-->
  
  <div id="footer"> 
    <!--footer-->
    <!--?php include_once("footer.php");?-->
</div>
<!--footer-->
</DIV>
<!--container-->

</body>
</html>
