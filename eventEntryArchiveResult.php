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
	window.location = 'eventEdit.php?id='+id;
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
$query =("select max(id) maxId from event;");
$result = mysql_query($query);
if(!$result){
	die("<br/><span style='color:red'>greska u izvrsavnju SQL izraza koji trazi najveci broj</span><br/>");
}
// na najveci ID broj dodajem 1 to je ID broj koji se koristi za upis sledeceg dogadjaja
$id = mysql_result($result,0);
$id++;


//**************************************************************************************citanje unetih podataka*************
$imePrograma = mysql_real_escape_string(trim($_POST["imePrograma"]));
$program= mysql_real_escape_string(trim($_POST["program"]));
$skrTekst = mysql_real_escape_string(trim($_POST["skrTekst"]));
$tekst= mysql_real_escape_string(trim($_POST["tekst"]));
$mesto  = mysql_real_escape_string(trim($_POST["mesto"]));
$ucesnici = mysql_real_escape_string(trim($_POST["ucesnici"]));
$prioritet= mysql_real_escape_string(trim($_POST["prioritet"]));
$podnaslov = mysql_real_escape_string(trim($_POST["podnaslov"]));
$nadnaslov = mysql_real_escape_string(trim($_POST["nadnaslov"]));
$napomene = mysql_real_escape_string(trim($_POST["napomene"]));
$signature= mysql_real_escape_string(trim($_POST["signature"]));
$procesirano= mysql_real_escape_string(trim($_POST["procesirano"]));
$stariID = mysql_real_escape_string(trim($_POST["stariID"]));
$vremeUnosa = date('r');
$kreator = $_SESSION['user'];

$dan = mysql_real_escape_string(trim($_POST["dan"]));
$mesec = mysql_real_escape_string(trim($_POST["mesec"]));
$godina = mysql_real_escape_string(trim($_POST["godina"]));
	
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
	echo $komentar;
    $fileType =  substr(strrchr($_FILES[$i]['name'],'.'), 1);
	echo $fileType;
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
	echo $fileClass;
	$path = $uploadFolder.$fileName.".".$fileType;
    $query3 = "INSERT INTO fajlovi ( klasaFajla, tipFajla, vreme, komentar, path, ime, korisnik,id) VALUES ('$fileClass','$fileType','$vremeUnosa','$komentar','$path','".$_FILES[$i]['name']."','$kreator',$id);";
	//echo "<br>izraz za upis u bazu".$query3;
	$result3 = mysql_query($query3);
    if(!$result3){
	   die("
	      <br />
          <span style='color:red'>greska u izvrsavnju SQL izraza 0</span>");
    }	
	//sacuvaj fajl
	$copy = move_uploaded_file($_FILES[$i]['tmp_name'], $path);
	//$copy = copy($_FILES[$i]['tmp_name'], $path);
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
//****************************************************************************deo za upis u tabelu vrste materijala
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

//*********************************************************************************izraz za upis u novog dogadjaja u bazu 
$query2 = "INSERT into event (slika,id,imePrograma,dan,mesec,godina,program,mesto,skrTekst,tekst,ucesnici,prioritet,podnaslov,nadnaslov,napomene,signature,vremeUnosa,kreator,plakat,pozivnica,katalog,fotografija, video, zvuk, publikacija, materijalProgram) VALUES (0,$id,'$imePrograma',$dan,$mesec,$godina,'$program','$mesto','$skrTekst','$tekst','$ucesnici',$prioritet,'$podnaslov','$nadnaslov','$napomene','$signature','$vremeUnosa','$kreator','$plakat','$pozivnica','$katalog','$fotografija','$video','$zvuk','$publikacija','$materijalProgram');";
$result2 = mysql_query($query2);
//echo '<br>Izraz za upis u bazu:<br /><br />'.$query2;
if(!$result2){
	die("
	  <span style='color:red;'><br />
      <br />
      Greska u izvrsavnju SQL izraza za upis u tabelu event!</span></a>");
}
//************************************************************************************izraz za upis u tabelu arhiv
$query = "UPDATE arhiv SET procesirano='$procesirano' where id=$stariID;";
//echo $stariID;
$result = mysql_query($query);
if(!$result){
	die("
	  <span style='color:red;'><br />
      <br />
      Greska u izvrsavnju SQL izraza za upis u tabelu arhiv!</span></a>");
}
//************************************************************************************ispis html stranice
$query = ("SELECT * FROM event WHERE (id = $id);");
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
  <span style='color:green'>Unos u bazu je uspešan.</span></div>
<br />
<br />
<br />
<div class="result"><a class="result2" href='javascript:izmeni(<?php echo $id;?>)'>Izmeni unet događaj</a></div>
<div class="result"><a class="result2" href='searchArchive.php'>Pretraga stare arhive</a></div>
<div class="result"><a class="result2" href='search.php'>Pretraga, izmena i brisanje događaja koji su već uneti na sajt</a></div>
<div class="result"><a class="result2" href='javascript:prikazi(<?php echo $id;?>)'>Prikaži unet događaj</a></div>
<div class="result"><a class="result2" href='adminIndex.php'>Glavni meni</a></div>
<div class="result"><a class="result2" href='logout.php'>Izloguj se</a></div>
<br />
</div>
<div class="result" align="center">PRIKAZ STRANICE:</div><br />
<br />
<br />

<DIV id="content">
  <DIV id="header">
    <?php include_once("heder.php") ?>
  </DIV>
  <div id="menu">
    <?php include_once("menu.php"); ?>
  </div>
  <DIV id="image">
    <?php if($row['mesec'] == date('n') && $row['godina'] == date('Y')){ include_once("slajd.php");} ?>
    <br />
    <br/>
  </DIV>
  <div id="vesti">
   
  </div>
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
				  ";echo $row['signature'].
			  "</td>
			</tr>
		</table>";
//kraj bloka za tekkst
//*****************************************************************blok koji prikazuje sve fajlove vezane za dogadjaj
$query = ("SELECT * FROM fajlovi WHERE (id = $id);");
$result = mysql_query($query);
while($row = mysql_fetch_array($result)){
    echo "
     	<table width='425px'>
        	<tr>
			  <td>";
			  if($row['id']!= '0'){//ako ima fajlova
				  /*ako je fajl slika*/
				  switch($row['klasaFajla']){
					  case('slika'):echo"<a href='".$row['path']."'>
					                     <img style='float:right; padding:5px;' src='".$row['path']."' width='150px'/><br />
                                         ".$row['komentar']."</a><br/>";
					  break;
			  //ako nije slika prikazi link na fajl, ako nije unet komentar ispisi "link na + 'tip fajla' + fajl" 
					  case('ostali'):
					  if(empty($row['komentar'])){
						  echo"<a href='".$row['path']."'>Link na dument tipa:".$row['tipFajla']."</a><br/>";
						  }
					  else{
					  echo"<a href='".$row['path']."'>".$row['komentar']."</a><br/>";
					  }
					  
					  break;
					  case('zvuk'):echo'<embed type="application/x-shockwave-flash" flashvars="audioUrl='.$row['path'].'" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="27" quality="best"></embed>'.$row['komentar'];
					  break;
					  case('video'):echo'
					  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="390" >
  <param name="movie" value="FLVPlayer_Progressive.swf" />
  <param name="quality" value="high" />
  <param name="wmode" value="opaque" />
  <param name="scale" value="noscale" />
  <param name="salign" value="lt" />
  <param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Halo_Skin_3&amp;streamName='.$row['path'].';autoPlay=false&amp;autoRewind=false" />
  <param name="swfversion" value="8,0,0,0" />
  <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you dont want users to see the prompt. -->
  <param name="expressinstall" value="Scripts/expressInstall.swf" />
  <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
  <!--[if !IE]>-->
  <object type="application/x-shockwave-flash" data="FLVPlayer_Progressive.swf" width="390" height="259">
    <!--<![endif]-->
    <param name="quality" value="high" />
    <param name="wmode" value="opaque" />
    <param name="scale" value="noscale" />
    <param name="salign" value="lt" />
    <param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Halo_Skin_3&amp;streamName=video/OtkucajiTempiranogVremena&amp;autoPlay=false&amp;autoRewind=false" />
    <param name="swfversion" value="8,0,0,0" />
    <param name="expressinstall" value="Scripts/expressInstall.swf" />
    <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
    <div>
      <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
      <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
    </div>
    <!--[if !IE]>-->
  </object>
  <!--<![endif]-->
</object>
<br />
'.$row['komentar'].'
<br />


					  ';
					  default:              
					  }
				 }
				  echo"
			  
			  </td>
			</tr>
			<tr><td><hr/></td></tr>
		</table>";
    }

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
