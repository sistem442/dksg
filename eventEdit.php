<?php session_start();
if (isset($_SESSION['user'])) {
	$id = $_GET['id'];	
	//konekcija sa bazom
require_once("database_connect.php");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
//SQL izraz 
$query = ("SELECT * FROM event WHERE (id = $id);");
//				 echo "$query<br />";
$result = mysql_query($query);
$query2 = ("SELECT * FROM opseg WHERE (id = $id);");
	//			 echo "$query2<br />";
$result2 = mysql_query($query2);
if(!$result){
	die ("Došlo je do greške pokušajte kasnije");
	}
$row = mysql_fetch_array($result);
$row2 = mysql_fetch_array($result2)	
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Izmena događaja</title>
<link href="http://dksg.rs/main.css" rel="stylesheet" type="text/css" />
<link href="backEnd.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.warning {
	color:#F00;
}
</style>
<!-- Link na script za formatiranje teksta-->
<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/event.js"></script>
<script type="text/javascript">

function ckeckIfEmty(str)
{
//********************************ako je polje prazno upozori*************************************************
if (str=="")
  {
  document.getElementById("txtHint1").innerHTML="You must fill all required fields .";
  document.getElementById("txtHint2").innerHTML="You must fill all required fields .";
  document.getElementById("txtHint3").innerHTML="You must fill all required fields .";
  return;
  }
  document.getElementById("txtHint1").innerHTML="";
  document.getElementById("txtHint2").innerHTML="";
  document.getElementById("txtHint3").innerHTML="";
}
//***********************************funkcija za upload vise fajlova****************************
var sledeci = 0; //cuva redni broj/ime sledeceg inputa fajla
function display() {
	//alert ('a');
	var id = sledeci;
	document.getElementById('brojFajlova').value = sledeci + 1;//upisujem koliko ima fajlova da bih znao kolinko puta treba da vrtim petlju za upis u bazu
	document.getElementById('newInput'+id).innerHTML+=createInput(id);// ovo upisuje novi input na html stranicu
	var newInput = "fajl" + id;
	document.getElementById('fajl'+id).click();// automatski trazi da izaberes fajl kada pritisnes link za novi fajl
}
function createInput(id) {
	sledeci = id + 1;
	var a = "<input type='hidden' name='MAX_FILE_SIZE' value='100000000'><p>Fajl "+ id +": <input type='file' id='fajl"+ id +"' name='"+id+"'></p><br />Komentar:<input type='text' name='"+id+"komentar'><br/><input type='radio' name='"+id+"galerija' value='da'>Prikaži sliku na stranici galerija<br /><input type='radio' name='"+id+"galerija' value='ne'>Ne prikazuj sliku na stranici galerija<br /><br/><p id='newInput"+sledeci+"'>&nbsp;</p>";
	
	return "<input type='hidden' name='MAX_FILE_SIZE' value='100000000'><p>Fajl "+ id +": <input type='file' id='fajl"+ id +"' name='"+id+"'></p><br />Komentar:<input type='text' name='"+id+"komentar'><br/><input type='radio' name='"+id+"galerija' value='da'>Prikaži sliku na stranici galerija<br /><input type='radio' name='"+id+"galerija' value='ne'>Ne prikazuj sliku na stranici galerija<br /><br/><p id='newInput"+sledeci+"'>&nbsp;</p>";
}
//************************************Dodeljuje proritet na osnovu programa******************************
function funkcija31(){
    var x=document.getElementById("program").selectedIndex;
    var y=document.getElementById("program").options;
	var program = y[x].text;
	if(program == "likovni"){
	    VrednostPrioriteta = 7;
	    }
	else if(program == 'obavestenje'){
		VrednostPrioriteta = 1;
		}	
	else if(program == 'radionica'){
		VrednostPrioriteta = 9;
		}	
	else if(program == 'muzicki'){
		VrednostPrioriteta = 2;
		}
	else if(program == 'pozorisni'){
		VrednostPrioriteta = 2;
		}
	else if(program == 'filmski'){
		VrednostPrioriteta = 4;
		}	
	else if(program == 'forum'){
		VrednostPrioriteta = 3;
		}
	else if(program == 'knjizevni'){
		VrednostPrioriteta = 5;
		}
	else if(program == 'film'){
		VrednostPrioriteta = 6;
		}
	else if(program == 'afc'){
		VrednostPrioriteta = 6;
		}
	else if(program == 'biblioteka'){
		VrednostPrioriteta = 8;
		}
	else if(program == 'ostali'){
		VrednostPrioriteta = 9;
		}
	else{
		VrednostPrioriteta=0;
		}
	document.getElementById("prioritet").value = VrednostPrioriteta;

//**************************************proverava da li je unet datum i naslov*********************************	
	
	var dan = document.getElementById("dan").value;
	var mesec = document.getElementById("mesec").value;
	var naslov = document.getElementById("imePrograma").value;
	if(dan != 0 && mesec != 0 && naslov != ''){	         
		 document.getElementById("posalji").disabled = false;
		 document.getElementById("validnost").innerHTML = "<span style='color:green'>Podaci su validni</span>";		
     }
	 else if (dan == 0){
	     document.getElementById("posalji").disabled = true;
		 document.getElementById("validnost").innerHTML = "<span style='color:red'>Unesite dan dogadjaja!</span>";
     }
	 else if (mesec == 0){
         document.getElementById("posalji").disabled = true;
		 document.getElementById("validnost").innerHTML = "<span style='color:red'>Unesite mesec dogadjaja!</span>";
     }
	 else{		 
		 document.getElementById("posalji").disabled = true;
		 document.getElementById("validnost").innerHTML = "<span style='color:red'>Unesite ime programa!</span>";
     }
	
}
//*************************************brisanje slike**********************************


function brisanjeSlike(){
var id = document.getElementById("id").value;//dobija vrednost iz hidden inputa 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("slika").innerHTML='<span style="color:green">Slika je obrisana!</span><br /><input style="width:180px" type="hidden" name="MAX_FILE_SIZE" value="1048576"><input type="file" name="slikaUzTekst" id="slikaUzTekst" value="Izaberite sliku" />Unesite sliku koja će se pojaviti sa desne strane teksta na naslovnoj strani maksimalna veličina je 1MB<br /><input type="hidden" value="nema" name="slikaUzTekstPostojeca" id="slikaUzTekstPostojeca" />';
    }
  }
xmlhttp.open("GET","Scripts/obrisiSliku.php?id="+id,true);
xmlhttp.send();
}
//*************************************brisanje JEDNOG FAJLA**********************************


function brisanjeFajla(id2){
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("potvrdaBrisanjeFajla"+id2).innerHTML='<span style="color:green">Fajl je obrisan!</span><br />';
    }
  }
xmlhttp.open("GET","Scripts/obrisiFajl.php?id2="+id2,true);
xmlhttp.send();
}
//**********************************************IZMENA vrednosti da li je fotografija za galeriju
function izmeniGaleriju(id2){
if(document.getElementById('ne').checked) {
  var izbor = 'ne';
}
else if(document.getElementById('da').checked) {
  var izbor = 'da'; 
}
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("potvrdaIzmenaGalerije"+id2).innerHTML='<span style="color:green">Izmenjeno je prikazivanje u galeriji!</span><br />';
    }
  }
xmlhttp.open("GET","Scripts/izmeniGaleriju.php?id2="+id2+'&izbor='+izbor+'&id='+id,true);
xmlhttp.send();
}

//**********************************************IZMENA KOMENTARA UZ FAJL****************************
function izmeniKomentar(id2){
	//uzimam novi komentar sa input polja
	var komentar = document.getElementById("noviKomentarFajla"+id2).value;
	var a = "Scripts/izmeniFajl.php?id2="+id2+"&komentar="+komentar;
	if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	//upisujem novi komentar umesto starog	
    document.getElementById("komentarFajla"+id2).innerHTML=xmlhttp.responseText;
	document.getElementById("noviKomentarFajla"+id2).value="";
    }
  }
xmlhttp.open("GET","Scripts/izmeniFajl.php?id2="+id2+"&komentar="+komentar,true);
xmlhttp.send();
	}

/**************************************izmena Opsega****************************************/
function izmeniOpseg(){
	window.location = 'editRange.php?id='+<?php echo $id ?>;
	}
/**************************************izmena dana****************************************/
function izmeniDane(){
	window.location = 'editPeriodic.php?id='+<?php echo $id ?>;
	}		
</script>
</head>
<body style="color:black; font-family:Arial, Helvetica, sans-serif;" onload="document.forms[0].posalji.disabled=true;">
<form action="eventEditResult.php"  method="post" enctype="multipart/form-data" name="eventForm" >
  <input type="hidden" value="<?php echo $row['id']; //ovo sluzi za brisanje slike?>" id="id" name="id" />
  <input type="hidden" value="<?php echo $row['kreator']; ?>" id="kreator" name="kreator" />
  <input type="hidden" value="<?php echo $row['vremeUnosa'];?>" id="vremeUnosa" name="vremeUnosa" />
  <br />
  <br />
  <br />
  <div style="margin-right:400px; font-family:Arial; font-size:18px;">Unos teksta i fajlova za novi događaj</div>
  <br>
  <table border="0" cellspacing="10px" >
    <tbody>
       <tr>
        <td align="left">Ako događaj ima opseg ili dane prikazivanja, za izmenu pritisnite odgovarajuce dugme</td>
        <td align="left"><input type="button" value="Izmena opsega ( vazi za dogadjaje koji traju vise dana)" onclick="izmeniOpseg()" /> <input type="button" value="Izmeni dane prikazivanja ( vazi za radionice)" onclick="izmeniDane()"/></td>
      </tr>
      <tr>
        <td width="100px" align="left" style="color:red">Izmena na programu</td>
        <td width="100px" align="left"><input style="width:680px; color:red" type="text" id="izmena" name="izmena" value="<?php echo $row['izmena']; ?>" />
          <br />
      </tr>
       <tr>
        <td align="left">Dan</td>
        <td align="left"><input style="width:180px" type="number" max="31" min="1" id="dan" name="dan"  value="<?php echo $row['dan']; ?>" /></td>
      </tr>
      <tr>
        <td align="left">Mesec</td>
        <td align="left"><input style="width:180px" type="number" max="12" min="1" id="mesec" name="mesec"  onblur="ckeckIfEmty(this.value)" value="<?php echo $row['mesec']; ?>"/></td>
      </tr>
      <tr>
        <td align="left">Godina</td>
        <td align="left"><input style="width:180px" type="text" id="godina" name="godina" onblur="ckeckIfEmty(this.value)" value="<?php echo $row['godina']; ?>" /></td>
      </tr>
      <tr>
        <td align="left">Mesto</td>
        <td align="left"><select style="width:180px" name="mesto" id="mesto">
            <option value="mala sala" <?php if($row['mesto'] == 'mala sala') echo "selected='selected'" ?>>mala sala</option>
            <option value="velika sala" <?php if($row['mesto'] == 'velika sala') echo "selected='selected'" ?>>velika sala</option>
            <option value="galerija" <?php if($row['mesto'] == 'galerija') echo "selected='selected'" ?>>galerija</option>
			  <option value="klub magistrala" <?php if($row['mesto'] == 'klub magistrala') echo "selected='selected'" ?>>klub magistrala</option>
			  <option value="studio 26" <?php if($row['mesto'] == 'studio 26') echo "selected='selected'" ?>>studio 26</option>
            <option value="studio 27" <?php if($row['mesto'] == 'studio 27') echo "selected='selected'" ?>>studio 27</option>
            <option value="studio 28" <?php if($row['mesto'] == 'studio 28') echo "selected='selected'" ?>>studio 28</option>
            <option value="velika galerija" <?php if($row['mesto'] == 'velika galerija') echo "selected='selected'" ?>>velika galerija</option>
            <option value="amfiteatar" <?php if($row['mesto'] == 'amfiteatar') echo "selected='selected'" ?>>amfiteatar</option>
            <option value="letnja pozornica" <?php if($row['mesto'] == 'letnja pozornica') echo "selected='selected'" ?>>letnja pozornica</option>
            <option value="biblioteka" <?php if($row['mesto'] == 'biblioteka') echo "selected='selected'" ?>>biblioteka</option>
            <option value="e čitaonica" <?php if($row['mesto'] == 'e čitaonica') echo "selected='selected'" ?>>e čitaonica</option>
            <option value="donji hol v.g." <?php if($row['mesto'] == 'donji hol v.g.') echo "selected='selected'" ?>>donji hol v.g.</option>
            <option value="sala na spratu" <?php if($row['mesto'] == 'sala na spratu') echo "selected='selected'" ?>>sala na spratu</option>
            <option value="van doma" <?php if($row['mesto'] == 'van doma') echo "selected='selected'" ?>>van doma</option>
            <option value="van doma" <?php if($row['mesto'] == 'tekst') echo "selected='selected'" ?>>TEKST</option>
          </select></td>
      </tr>
      
      <tr>
        <td width="100px" align="left">Sažeti opis</td>
        <td width="100px" align="left"><input style="width:680px" type="text" id="s_opis" name="s_opis" value="<?php echo $row['s_opis']; ?>" />
          <br />
      </tr>      
		<tr>
        <td align="left"> Nadnaslov</td>
        <td align="left"><input style="width:680px" type="text" id="nadnaslov" name="nadnaslov"  value="<?php echo $row['nadnaslov']; ?>"/></td>
      </tr>
      <tr>
        <td width="100px" align="left">Naslov</td>
        <td width="100px" align="left"><input style="width:680px" type="text" id="imePrograma" name="imePrograma" onblur="ckeckIfEmty(this.value)" value="<?php echo $row['imePrograma']; ?>" />
          <br />
          <div id="txtHint1" class="warning"></div></td>
      </tr>
      
      <tr>
        <td align="left"> Podnaslov</td>
        <td align="left"><input style="width:680px" type="text" id="podnaslov" name="podnaslov" value="<?php echo $row['podnaslov']; ?>"/></td>
      </tr>
      <tr>
        <td width="100px" align="left">Vreme i Mesto</td>
        <td width="100px" align="left"><input style="width:680px" type="text" id="vreme_mesto" name="vreme_mesto" value="<?php echo $row['vreme_mesto']; ?>" />
          <br />
      </tr>
      <tr>
        <td align="left">Skraćeni tekst<br />
          Unesite skraćenu verziju teksta koja će se pojaviti na naslovnoj strani </td>
        <td align="left"><textarea  cols="83" rows="3"   id="skrTekst2" name="skrTekst2"><?php echo $row['skrTekst']; ?></textarea>
        <br />
    <div id='text_chars_needed'></div>
    <br />
    Preostali broj karaktera:
    <div style="display:inline" id="text_chars_left"></div>
        </td>
      </tr>
      <tr>
        <td width="100px" align="left">Ključne reči</td>
        <td width="100px" align="left"><input style="width:680px" type="text" id="k_reci" name="k_reci" value="<?php echo $row['k_reci']; ?>" />
          <br />
      </tr>
      <tr>
        <td align="left">Tekst<br />
          Unesite ceo tekst koji će se pojaviti na posebnoj stranici</td>
        <td align="left"><textarea cols="30" rows="7"   id="elm1" name="tekst"><?php echo $row['tekst']; ?>
        </textarea></td>
      </tr>
      <tr>
        <td align="left">Program</td>
        <td align="left"><input type="hidden" value="0" name="prioritet" id="prioritet" />
          <select name="program" id="program"  onblur="displayResult()" style="width:180px">
            <option value="obavestenje" <?php if($row['program'] == 'obavestenje') echo "selected='selected'" ?>>obavestenje</option>
            <option value="radionica" <?php if($row['program'] == 'radionica') echo "selected='selected'" ?>>radionica</option>
            <option value="ostali" <?php if($row['program'] == 'ostali') echo "selected='selected'" ?>>ostalo</option>
            <option value="politicki" <?php if($row['program'] == 'politicki') echo "selected='selected'" ?>>DRUŠTVENO POLITIČKI PROGRAM</option>
            <option value="naucni" <?php if($row['program'] == 'naucni') echo "selected='selected'" ?>>NAUČNO OBRAZOVNI PROGRAM</option>
            <option value="kontakt" <?php if($row['program'] == 'kontakt') echo "selected='selected'" ?>>KONTAKT PROGRAM</option>
            
            <option value="likovni" <?php if($row['program'] == 'likovni') echo "selected='selected'" ?>>likovni</option>
            <option value="filmski" <?php if($row['program'] == 'filmski') echo "selected='selected'" ?>>filmski</option>
            <option value="muzicki" <?php if($row['program'] == 'muzicki') echo "selected='selected'" ?>>muzicki</option>
            <option value="pozorisni" <?php if($row['program'] == 'pozorisni') echo "selected='selected'" ?>>pozorisni</option>
            <option value="forum" <?php if($row['program'] == 'forum') echo "selected='selected'" ?>>forum</option>
            <option value="knjizevni" <?php if($row['program'] == 'knjizevni') echo "selected='selected'" ?>>književni</option>
            <option value="afc" <?php if($row['program'] == 'afc') echo "selected='selected'" ?>>afc</option>
            <option value="biblioteka" <?php if($row['program'] == 'biblioteka') echo "selected='selected'" ?>>biblioteka</option>
            
          </select></td>
      </tr>
      <tr>
        <td align="left">Učesnici</td>
        <td align="left"><input style="width:680px" type="text" id="ucesnici" name="ucesnici"  value="<?php echo $row['ucesnici']; ?>"/></td>
      </tr>
      <tr>
        <td> Trenutna slika uz tekst: </td>
        <td id="slika">
		      <?php 
 		        if($row['slika']== '0') {//ako slika nije uneta
			     echo('<span style="color:red">Trenutno nije uneta slika</span><br />
				 <input style="width:180px" type="hidden" name="MAX_FILE_SIZE" value="1048576">
          <input type="file" name="slikaUzTekst" id="slikaUzTekst" value="Izaberite sliku" />
          Unesite sliku koja će se pojaviti sa desne strane teksta na naslovnoj strani maksimalna veličina je 1MB
		   <input type="hidden" value="nema" name="slikaUzTekstPostojeca" id="slikaUzTekstPostojeca" />');//ako nema slike primi fajl 
				 }
                 else{// ako je uneta ponudi brisanje
				 echo ('<img src="'.$row['slika'].'" width="180px"/>');//prikazi sliku
                    //prosledi bazi path do stare slike
					echo '<input type="hidden" value="'.$row['slika'].'" name="slikaUzTekstPostojeca" />';
				    //ponudi brisanje
				   echo "<input type="; if($row['slika']!= '0') {echo 'button';} else echo('hidden');echo" id='obrisiSliku' value='Obriši sliku' onclick='brisanjeSlike()' /></td>";}?>
    
          </td>
      </tr>
      <tr>
        <td align="left"> Napomene</td>
        <td align="left"><input style="width:680px" type="text" id="napomene" name="napomene"  value="<?php echo $row['napomene']; ?>"/>
          Napomene se ne pojavljuju na sajtu, već samo prilikom pretrage arhive. </td>
      </tr>
      <tr>
        <td align="left">Signature</td>
        <td align="left"><input style="width:680px" type="text" id="signature" name="signature" value="<?php echo $row['signature']; ?>"/>
          <div id="txtHint2" class="warning"></div></td>
      </tr>
       <tr>
        <td align="left">Izmena vrsta arhiviranog materijal</td>
<?php 
//procitaj vrednosti arhiviranog materijal iz odgovarajucih tabela i prikazi ih u check boxovima
$q30 = 'Select * from mat_plakat where id='.$row['id'];
//echo $q30.'<br/>';
$result30 = mysql_query($q30);
if (mysql_num_rows($result30) > 0){
$plakat = 'checked="checked"';
//echo $plakat.'<br/>';
}
else {$plakat='';}

$q31 = 'Select * from mat_pozivnica where id='.$row['id'];
//echo $q31.'<br/>';
$result31 = mysql_query($q31);
if (mysql_num_rows($result31) > 0){
$pozivnica = 'checked="checked"';
//echo $pozivnica.'<br/>';
}
else {$pozivnica='';}

$q32 = 'Select * from mat_katalog where id='.$row['id'];
//echo $q32.'<br/>';
$result32 = mysql_query($q32);
if (mysql_num_rows($result32) > 0){
$katalog = 'checked="checked"';
//echo $katalog.'<br/>';
}
else $katalog='';

$q33 = 'Select * from mat_fotografija where id='.$row['id'];
//echo $q33.'<br/>';
$result33 = mysql_query($q33);
if (mysql_num_rows($result33) > 0){
$fotografija = 'checked="checked"';
//echo $fotografija.'<br/>';
}
else $fotografija='';

$q34 = 'Select * from mat_video where id='.$row['id'];
//echo $q34.'<br/>';
$result34 = mysql_query($q34);
if (mysql_num_rows($result34) > 0){
$video = 'checked="checked"';
//echo $video.'<br/>';
}
else $video='';

$q35 = 'Select * from mat_zvuk where id='.$row['id'];
$result35 = mysql_query($q35);
if (mysql_num_rows($result35) > 0){
$zvuk = 'checked="checked"';
}
else $zvuk='';

$q36 = 'Select * from mat_publikacija where id='.$row['id'];
$result36 = mysql_query($q36);
if (mysql_num_rows($result36) > 0){
$publikacija = 'checked="checked"';
}
else $publikacija = ' ';

$q37 = 'Select * from mat_program where id='.$row['id'];
$result37 = mysql_query($q37);
if (mysql_num_rows($result37) > 0){
$materijalProgram = 'checked="checked"';
}
else $materijalProgram ='';

$q38= 'Select * from mat_fotografija where id='.$row['id'];
$result38 = mysql_query($q38);
if (mysql_num_rows($result38) > 0){
$fotografija = 'checked="checked"';
}
else $fotografija='';


?>
<td align="left">
                <input name="plakat" type="checkbox" <?php echo $plakat;?>/>
                Plakat<br />
                <input name="pozivnica" type="checkbox" <?php echo $pozivnica;?>/>
                Pozivnica<br />
                <input name="katalog" type="checkbox" <?php echo $katalog;?>/>
                Katalog<br />
                <input name="fotografija" type="checkbox" <?php echo $fotografija;?>/>
                Fotografija<br />
                <input name="zvuk" type="checkbox" <?php echo $zvuk;?>/>
                Audio zapis<br />
                <input name="video" type="checkbox" <?php echo $video;?>/>
                Video zapis<br />
                <input name="publikacija" type="checkbox" <?php echo $publikacija;?>/>
                Publikacije<br />
                <input name="materijalProgram" type="checkbox" <?php echo $materijalProgram;?>/>
                Program<br /></td>
      </tr>
      <tr>
        <td align="left">Fotograf</td>
        <td align="left"><input style="width:680px" type="text" name="fotograf" value="<?php echo $row['fotograf']; ?>"/>
          </td>
      </tr>
      <tr>
      <td>Izmena komentara ili brisanje fajlova</td>
      <td>
      <?php
         $query = ("SELECT * FROM fajlovi WHERE (id = $id);");
         $result = mysql_query($query);
	     echo '<table>';
		 while($row = mysql_fetch_array($result)){
				  /*ako je fajl slika prikazi sliku i komentar  i ponudi brisanje slike i izmenu komentara i izmenu da li se prikazuje u galeriji*/
				  switch($row['klasaFajla']){
					  case('slika'):echo"
					    <tr>   
						   <td>
						     <a href='".$row['path']."'>
   					         <img style='float:right; padding:5px;' src='".$row['path']."' width='150px'></a></td>
						   <td valign='top'>
						     <span class='blueBold'>Komentar:</span><div id='komentarFajla".$row['id2']."'>".$row['komentar']."</div><br />
							 Galerija: <br />
                             NE <input type='radio' name='galerija".$row['id2']."' id='ne' value='ne' ";
							 if($row['galerija']=='ne'){
								 echo 'checked="checked"';
								 }
								 echo 'onchange="izmeniGaleriju('.$row['id2'].')"'; echo "/><br />
                             DA <input type='radio' name='galerija".$row['id2']."' id='da' value='da' "; 
							 if($row['galerija']=='da'){
								 echo 'checked="checked"';
							 }
							 echo 'onchange="izmeniGaleriju('.$row['id2'].')"'; echo "<br />
							 <div id='komentarFajla'></div>
							 <input type='text' id='noviKomentarFajla".$row['id2']."'><br/>
							 <input type='button' onclick='izmeniKomentar(".$row['id2'].")' value='Izmeni komentar'/>
                             <input type=button id='obrisiFajl' value='Obriši fajl' 
						       onclick='brisanjeFajla(".$row['id2'].")'/>
							   <div id='potvrdaIzmenaGalerije".$row['id2']."'>
						     <div id='potvrdaBrisanjeFajla".$row['id2']."'></div></td>
					     </tr>
						 <tr>
						   <td colspan='2'><hr/></td>
					     </tr>";
					  break;
					        //ako nije slika samo prikazi komentar i link i ponudi brisanje fajla i izmenu komentara		 
					  default:echo"
					      <tr>    
							<td>
							  <a href='".$row['path']."'>link</a></td>
						    <td valign='top'>  
					         <span class='blueBold'>Komentar:</span><div id='komentarFajla".$row['id2']."'>".$row['komentar']."</div><br />
							 <input type='text' id='noviKomentarFajla".$row['id2']."'><br/>
							 <input type='button' onclick='izmeniKomentar(".$row['id2'].")' value='Izmeni komentar'/>
                             <input type=button id='obrisiFajl' value='Obriši fajl' 
						       onclick='brisanjeFajla(".$row['id2'].")'/>
						     <div id='potvrdaBrisanjeFajla".$row['id2']."'></div></td>
					     </tr>
						 <tr>
						   <td colspan='2'><hr/></td>
					     </tr>";
			 }
		 }
		 ?>
	  
      </td>
      </tr>
      <tr>
        <td align="left">Upload fajlova:</td>
        <td align="left"><input  type="hidden" name="brojFajlova" id="brojFajlova" value="0"/>
          <br />
          <p id="newInput0">&nbsp;</p>
          <p><a href="javascript:display()">Dodaj još fajlova</a> &nbsp;&nbsp;&nbsp;Dodajte fajlove (slike, pdf, doc...) </p>
          <br />
          <br /></td>
      </tr>
    </tbody>
  </table>
  <table border="0" cellspacing="10px" >
    <tr>
      <td align="left"><br />
        <br>
        <input type="button" onclick="funkcija31()" value="Proveri validnost podataka"/>
        <div id="validnost"><span style="color:red">Da biste postavili sadržaj na sajt prvo proverite podatke!</span></div>
        <br />
        <input type="submit" name="posalji" value="Pošalji" id="posalji"  onclick="funkcija32()" />
        <br />
        <br />
        <a href='adminIndex.php'>Glavni meni</a>
        </div>
        <br />
        <br />
        <br /></td>
        </td>
  </table>
</form>
</body>
</html>
<?php }
else { // Ako korisnik nije prijavljen na sistem
 echo "Niste prijavljeni!<br />
 <a href='login.php'>Prijava</a>
<br />";
}
?>