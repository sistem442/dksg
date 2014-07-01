<?php session_start();
set_time_limit ( 600 );
if (!isset($_SESSION['user'])) {
// Ako korisnik nije prijavljen na sistem
 	echo "Niste prijavljeni!<br />
 <a href='login.php'>Prijava</a>
<br />";}
	
	//konekcija sa bazom
require_once("database_connect.php");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
//izbor baze
mysql_select_db("dksg_3120", $con);

//uzimzm id sa stranice
$id = $_GET['id'];	
//citam iz tabele arhiv
$q ="SELECT * FROM arhiv where id=".$id;
$result = mysql_query($q) or die(mysql_error());
$row = mysql_fetch_array($result) or die(mysql_error());
    $imePrograma = $row['naslov'];
	$mesec = $row['mesec'];
	$godina = $row['godina'];
	$program = $row['program'];
	$imePrograma = $row['naslov'];
	$podnaslov = $row['podnaslov'];
	$ucesnici = $row['autor'];
	$siganture = 'Signature:'.$row['signature'];
	if (!empty($row['produkcija'])) $produkcija = 'Produkcija:'.$row['produkcija'].':<br/>'; 
    else $produkcija='';
	if (!empty($row['pozoriste.reditelj'])) $pozReditelj = 'Pozorišni reditelj:'.$row['pozoriste.reditelj'].';<br/>'; 
    else $pozReditelj='';
	if (!empty($row['pisac'])) $pisac = 'Pisac:'.$row['pisac'].';<br/>'; 
    else $pisac='';
	if (!empty($row['film.reditelj'])) $filmReditelj= 'Filmski reditelj:'.$row['film.reditelj'].';<br/>'; 
    else $filmReditelj='';
	$tekst = "<strong>$imePrograma</strong><br />
               $podnaslov<br />
               Učesnici:$ucesnici<br />
                
			    $produkcija.$pozReditelj.$pisac.$filmReditelj<br>
				";
	$napomene = $row['napomene']; 
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Izmena arhiviranog događaja</title>
<link href="http://dksg.rs/main.css" rel="stylesheet" type="text/css" />
<link href="Scripts/Stickman.MultiUpload.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.warning {
	color:#F00;
}
</style>
<!-- Link na script za formatiranje teksta-->
<script type="text/javascript" src="editor/tiny_mce.js"></script>
<script type="text/javascript">

//*********************Funkcije koje omogucavaju formatiranje teksta**********************************
tinyMCE.init({
       	// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "main.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});


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
	var id = sledeci;
	document.getElementById('brojFajlova').value = sledeci + 1;//upisujem koliko ima fajlova da bih znao kolinko puta treba da vrtim petlju za upis u bazu
	document.getElementById('newInput'+id).innerHTML+=createInput(id);// ovo upisuje novi input na html stranicu
	var newInput = "fajl" + id;
	document.getElementById('fajl'+id).click();// automatski trazi da izaberes fajl kada pritisnes link za novi fajl
}
function createInput(id) {
	sledeci = id + 1;
	return "<input type='hidden' name='MAX_FILE_SIZE' value='100000000'><p>Fajl "+ id +": <input type='file' id='fajl"+ id +"' name='"+id+"'></p><br />Komentar:<input type='text' name='"+id+"komentar'><br/><p id='newInput"+sledeci+"'>&nbsp;</p>";
}
//************************************Dodeljuje proritet na osnovu programa******************************
function funkcija31(){
    var x=document.getElementById("program").selectedIndex;
    var y=document.getElementById("program").options;
	var program = y[x].text;
	if(program == "likovni"){
	    VrednostPrioriteta = 8;
	    }
	else if(program == 'muzicki'){
		VrednostPrioriteta = 2;
		}
	else if(program == 'pozorisni'){
		VrednostPrioriteta = 1;
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
		VrednostPrioriteta = 7;
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
var id = document.getElementById("id").value;//dobija vrednost iz hidden inputa na liniji 206
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
</script>
<link href="ContentManagmentStylesheet.css" rel="stylesheet" type="text/css" />
</head>
<body style="color:black; font-family:Arial, Helvetica, sans-serif;" onload="document.forms[0].posalji.disabled=true;">
<form action="eventEntryArchiveResult.php"  method="post" enctype="multipart/form-data" name="eventForm" >
  <br />
  <br />
  <br />
  <div style="margin-right:400px; font-family:Arial; font-size:18px;">Unos teksta i fajlova za novi događaj</div>
  <br>
  <table border="0" cellspacing="10px" >
    <tbody>
       <tr>
        <td align="left">Dan</td>
        <td align="left"><input style="width:180px" type="number" max="31" min="1" id="dan" name="dan"   /></td>
      </tr>
      <tr>
        <td align="left">Mesec</td>
        <td align="left"><input style="width:180px" type="number" max="12" min="1" id="mesec" name="mesec"  onblur="ckeckIfEmty(this.value)" value="<?php echo $mesec; ?>"/></td>
      </tr>
      <tr>
        <td align="left">Godina</td>
        <td align="left"><input style="width:180px" type="text" id="godina" name="godina" onblur="ckeckIfEmty(this.value)" value="<?php echo $godina; ?>" /></td>
      </tr>
      <tr>
        <td align="left">Mesto</td>
        <td align="left"><select style="width:180px" name="mesto" id="mesto">
            <option value="mala sala" selected="selected">mala sala</option>
            <option value="velika sala">velika sala</option>
            <option value="galerija">galerija</option>
            <option value="studio 26">studio 26</option>
            <option value="studio 27">studio 27</option>
            <option value="studio 28">studio 28</option>
            <option value="velika galerija">velika galerija</option>
            <option value="amfiteatar">amfiteatar</option>
            <option value="letnja pozornica">letnja pozornica</option>
            <option value="biblioteka">biblioteka</option>
            <option value="e čitaonica">e čitaonica</option>
            <option value="donji hol v.g.">donji hol v.g.</option>
            <option value="sala na spratu">sala na spratu</option>
            <option value="van doma">van doma</option>
          </select></td>
      </tr>
      <tr>
        <td width="100" align="left">Naziv događaja</td>
        <td width="100" align="left"><input style="width:400px" type="text" id="imePrograma" name="imePrograma" onblur="ckeckIfEmty(this.value)" value="<?php echo $imePrograma; ?>" />
          <br />
          <div id="txtHint1" class="warning"></div></td>
      </tr>
      <tr>
        <td align="left"> Nadnaslov</td>
        <td align="left"><input style="width:400px" type="text" id="nadnaslov" name="nadnaslov"/></td>
      </tr>
      <tr>
        <td align="left">Program</td>
        <td align="left"><input type="hidden" value="0" name="prioritet" id="prioritet" />
          <select name="program" id="program"  onblur="displayResult()" style="width:180px">
            <option value="likovni" <?php if($row['program'] == 'likovni') echo "selected='selected'" ?>>likovni</option>
            <option value="filmski" <?php if($row['program'] == 'filmski') echo "selected='selected'" ?>>filmski</option>
            <option value="muzicki" <?php if($row['program'] == 'muzicki') echo "selected='selected'" ?>>muzicki</option>
            <option value="pozorisni" <?php if($row['program'] == 'pozorisni') echo "selected='selected'" ?>>pozorisni</option>
            <option value="forum" <?php if($row['program'] == 'forum') echo "selected='selected'" ?>>forum</option>
            <option value="knjizevni" <?php if($row['program'] == 'knjizevni') echo "selected='selected'" ?>>književni</option>
            <option value="afc" <?php if($row['program'] == 'afc') echo "selected='selected'" ?>>afc</option>
            <option value="biblioteka" <?php if($row['program'] == 'biblioteka') echo "selected='selected'" ?>>biblioteka</option>
            <option value="ostali" <?php if($row['program'] == 'ostali') echo "selected='selected'" ?>>ostali</option>
          </select></td>
      </tr>
      <tr>
        <td align="left"> Podnaslov</td>
        <td align="left"><input style="width:400px" type="text" id="podnaslov" name="podnaslov" value="<?php echo $row['podnaslov']; ?>"/></td>
      </tr>
      <tr>
        <td align="left">Skraćeni tekst<br />
          Unesite skraćenu verziju teksta koja će se pojaviti na naslovnoj strani </td>
        <td align="left"><textarea  cols="30" rows="7"   id="skrTekst" name="skrTekst">
        <?php echo $row['naslov']; ?></textarea></td>
      </tr>
      <tr>
        <td align="left">Tekst<br />
          Unesite ceo tekst koji će se pojaviti na posebnoj stranici</td>
        <td align="left"><textarea cols="30" rows="7"   id="tekst" name="tekst"><?php echo $tekst; ?>
        </textarea></td>
      </tr>
      <tr>
        <td align="left">Učesnici</td>
        <td align="left"><input style="width:400px;" type="text" id="ucesnici" name="ucesnici"  value="<?php echo $ucesnici; ?>"/></td>
      </tr>
      <tr>
        <td align="left"> Napomene</td>
        <td align="left"><input style="width:400px" type="text" id="napomene" name="napomene"  value="<?php echo $row['napomene']; ?>"/>
          Napomene se ne pojavljuju na sajtu, već samo prilikom pretrage arhive. </td>
      </tr>
      <tr>
        <td align="left">Signature <input type="hidden" value=" <?php echo $id; ?> " name="stariID"  /></td>
        <td align="left"><input style="width:400px" type="text" id="signature" name="signature" value="<?php echo $siganture; ?>"/>
          <div id="txtHint2" class="warning"></div></td>
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
      <tr>
         <td align="left">Oznaka da je prebačeno na sajt:</td>
         <td align="left"><select name="procesirano" style="width:180px">
            <option value="da" <?php if($row['procesirano'] == 'da') echo "selected='selected'" ?>>Prebačeno je na sajt</option>
            <option value="ne" <?php if($row['procesirano'] == 'ne') echo "selected='selected'" ?>>Nije prebačeno na sajt</option></select>
      </tr>
      <tr>
      <td align="left"> Vrsta materijala koji postoji u arhivi</td><td align="left">
                <input name="plakat" type="checkbox"  />
                Plakat<br />
                <input name="pozivnica" type="checkbox"/>
                Pozivnica<br />
                <input name="katalog" type="checkbox" />
                Katalog<br />
                <input name="fotografija" type="checkbox"/>
                Fotografija<br />
                <input name="audio" type="checkbox" />
                Audio zapis<br />
                <input name="video" type="checkbox" />
                Video zapis<br />
                <input name="publikacija" type="checkbox" />
                Publikacije<br />
                <input name="materijalProgram" type="checkbox" />
                Program<br />
            </td>
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
