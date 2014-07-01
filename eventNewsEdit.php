<?php session_start();
if (isset($_SESSION['user'])) {
	$id = $_GET['id'];	
	//konekcija sa bazom
require_once("database_connect.php");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
//izbor baze
mysql_select_db("dksg_3120", $con);
//SQL izraz 
$query = ("SELECT * FROM vesti WHERE (idTabele = $id);");
$result = mysql_query($query);
if(!$result){
	die ("Došlo je do greške pokušajte kasnije");
	}
$row = mysql_fetch_array($result);
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Izmena Vesti</title>
<link href="backEnd.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.warning {
	color:#F00;
}
</style>
<!-- Link na script za formatiranje teksta-->
<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/event.js"></script>
<script type="text/javascript">

//*********************Funkcije koje omogucavaju formatiranje teksta**********************************
tinymce.init({
    selector: "textarea.editme",
    theme: "modern",
    width: 680,
    height: 300,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ],
   content_css: "main.css",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons | textcolor| fullscreen ", 
   style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
 }); 
 
 
function funkcija1(){
	
//****************************************************************************************
//**********************provera da li je unos ispravan i javljanje greske korisnicima
//*****************************************************************************************
    var d1 = document.getElementById('d1').value;
	var m1 = document.getElementById('m1').value;
	var g1 = document.getElementById('g1').value;
	if (d1 < 1 || d1 >31 ){
		document.getElementById("potvrda").innerHTML = "<span style='color:red'>Proverite prvi dan</span> ";
		}
		else if (m1 < 1 || m1 >12){
		document.getElementById("potvrda").innerHTML = "<span style='color:red'>Proverite prvi mesec</span> ";
		}
		else if (g1 < 1957 || g1 >2020){
		document.getElementById("potvrda").innerHTML = "<span style='color:red'>Proverite prvu godinu</span> ";
		}
	 else {
	 document.getElementById("potvrda").innerHTML = "<span style='color:green'>Unete vrednosti su ispravne pritisnite dugme za unos</span> ";
		document.getElementById("posalji").disabled = false;
		
	 }
}

//*************************************brisanje slike**********************************


function brisanjeSlike(){
	alert (id);
var id = document.getElementById("id").value;//dobija vrednost iz hidden inputa na liniji 146

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
xmlhttp.open("GET","Scripts/obrisiSlikuNews.php?id="+id,true);
xmlhttp.send();
}
</script>
</head>
<body style="color:black; font-family:Arial, Helvetica, sans-serif;" onload="document.forms[0].posalji.disabled=true;">
<form action="eventEditNewsResult.php"  method="post" enctype="multipart/form-data" name="eventForm" >
  <input type="hidden" value="<?php echo $row['idTabele']; //ovo sluzi za brisanje slike?>" id="id" name="idTabele" />
  <br />
  <br />
  <br />
  <div style="margin-right:400px; font-family:Arial; font-size:18px;">Unos teksta i fajlova za novi događaj</div>
  <br>
  <table border="0" cellspacing="10px" >
    <tbody>
      <tr>
        <td align="left">Dan 1</td>
        <td align="left"><input value="<?php echo $row['d1'];?>" style="width:180px" type="text" id="d1" name="d1"  /></td>
      </tr>
      <tr>
        <td align="left">Mesec 1</td>
        <td align="left"><input value="<?php echo $row['m1'];?>" style="width:180px" type="text" id="m1" name="m1"  /></td>
      </tr>
      <tr>
        <td align="left">Godina 1</td>
        <td align="left"><input value="<?php echo $row['g1'];?>"  style="width:180px" type="text" id="g1" name="g1" /></td>
      </tr>
      <tr>
        <td width="100px" align="left">Naslov vesti</td>
        <td width="100px" align="left"><input style="width:800px" type="text" id="naslov" name="naslovVesti" onblur="ckeckIfEmty(this.value)" value="<?php echo $row['naslovVesti']; ?>" />
          <br />
          <div id="txtHint1" class="warning"></div></td>
      </tr>
      <tr>
        <td align="left">Program</td>
        <td align="left"><input type="hidden" value="0" name="prioritet" id="prioritet" />
          <select name="program" id="program" style="width:180px">
            <option value="likovni" <?php if($row['program'] == 'likovni') echo "selected='selected'" ?>>likovni</option>
            <option value="filmski" <?php if($row['program'] == 'filmski') echo "selected='selected'" ?>>filmski</option>
            <option value="muzicki" <?php if($row['program'] == 'muzicki') echo "selected='selected'" ?>>muzicki</option>
            <option value="pozorisni" <?php if($row['program'] == 'pozorisni') echo "selected='selected'" ?>>pozorisni</option>
            <option value="forum" <?php if($row['program'] == 'forum') echo "selected='selected'" ?>>forum</option>
            <option value="knjizevni" <?php if($row['program'] == 'knjizevni') echo "selected='selected'" ?>>književni</option>
            <option value="afc" <?php if($row['program'] == 'afc') echo "selected='selected'" ?>>afc</option>
            <option value="biblioteka" <?php if($row['program'] == 'biblioteka') echo "selected='selected'" ?>>biblioteka</option>
            <option value="ostali" <?php if($row['program'] == 'ostali') echo "selected='selected'" ?>>ostali</option>
          </select>
          </select>
          
          </td>
      </tr>
      <tr>
        <td align="left">Skraćeni tekst<br /></td>
        <td align="left"><textarea cols="30" rows="7"   id="skr_tekst" name="skr_tekst"><?php echo $row['skrTekst']; ?></textarea>
        <br />
    <div id='text_chars_needed'></div>
    <br />
    Preostali broj karaktera:
    <div style="display:inline" id="text_chars_left"></div></td>
      </tr>
      <tr>
        <td align="left">Tekst<br />
          Unesite ceo tekst koji će se pojaviti na posebnoj stranici</td>
        <td align="left"><textarea cols="30" rows="7"   id="tekst" name="tekst"  class="editme"><?php echo $row['tekst']; ?>
        </textarea></td>
      </tr>
      
      <tr>
        <td> Trenutna slika uz tekst: </td>
        <td id="slika"><?php 
 		        if($row['slika']== '0') {//ako slika nije uneta
			     echo('<span style="color:red">Trenutno nije uneta slika</span><br />
				 <input style="width:180px" type="hidden" name="MAX_FILE_SIZE" value="1048576">
          <input type="file" name="slikaUzTekst" id="slikaUzTekst" value="Izaberite sliku" />
          Unesite sliku koja će se pojaviti sa desne strane teksta na naslovnoj strani maksimalna veličina je 1MB
		   <input type="hidden" value="nema" name="slikaUzTekstPostojeca" id="slikaUzTekstPostojeca" />');//ako nema slike primi fajl 
				 }
                 else{// ako je uneta ponudi brisanje
				 echo ('<img width="200px" src="'.$row['slika'].'"/>');//prikazi sliku
                    //prosledi bazi path do stare slike
					echo '<input type="hidden" value="'.$row['slika'].'" name="slikaUzTekstPostojeca" />';
				    //ponudi brisanje
				   echo "<input type="; if($row['slika']!= '0') {echo 'button';} else echo('hidden');echo" id='obrisiSliku' value='Obriši sliku' onclick='brisanjeSlike()' /></td>";}?></td>
      </tr>
    </tbody>
  </table>
  <table border="0" cellspacing="10px" >
    <tr>
      <td align="left"><br />
        <br>
        <input type="button" onclick="funkcija1()" value="Proveri validnost podataka"/>
        <div id="potvrda"><span style="color:red">Da biste postavili sadržaj na sajt prvo proverite podatke!</span></div>
        <br />
        <input type="submit" name="posalji" value="Pošalji" id="posalji"  />
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