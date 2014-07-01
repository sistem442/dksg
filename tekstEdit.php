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
$query = ("SELECT * FROM tekstovi WHERE (id = $id);");
//				 echo "$query<br />";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Izmena teksta</title>
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
//************************************Validacija******************************
function funkcija31(){	
    var tekst = document.getElementById("tekst").value;
	var opis = document.getElementById("opis").value;
	var radio = document.getElementById("radio").value;
	var naslov = document.getElementById("naslov").value;
	var kategorija = document.getElementById("kategorija").value;
	var aaa = 'tekst: '+tekst+' opis: '+opis+' radio: '+radio+' naslov: '+naslov+' kategorija: '+kategorija;
	//alert (aaa);	
	if (radio == 'da'){
		document.getElementById("objava").innerHTML = "<span style='color:green'>Tekst će biti vidljiv na sajtu</span>";
		}
	else{
		document.getElementById("objava").innerHTML = "<span style='color:red'>Tekst neće biti vidljiv na sajtu</span>";        }
	
	if (kategorija == "Izaberite kategoriju"){
         document.getElementById("posalji").disabled = true;
		 document.getElementById("validnost").innerHTML = "<span style='color:red'>Molim Vas da izberete kategoriju teksta.</span>";
     }		
	
	 else if (naslov == ''){
	     document.getElementById("posalji").disabled = true;
		 document.getElementById("validnost").innerHTML = "<span style='color:red'>Molim Vas da unesete naslov.</span>";
     }
	 else if (tekst == ''){
         document.getElementById("posalji").disabled = true;
		 document.getElementById("validnost").innerHTML = "<span style='color:red'>Molim Vas da unesete tekst.</span>";
     }
	 else if (opis == ''){
         document.getElementById("posalji").disabled = true;
		 document.getElementById("validnost").innerHTML = "<span style='color:red'>Molim Vas da unesete opis.</span>";
     }
	 else {
		 document.getElementById("posalji").disabled = false;
		 
		 document.getElementById("validnost").innerHTML = "<span style='color:green'>Podaci su validni</span>";		
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




</script>
<link href="ContentManagmentStylesheet.css" rel="stylesheet" type="text/css" />
</head>
<body style="color:black; font-family:Arial, Helvetica, sans-serif;" onload="document.forms[0].posalji.disabled=true;">
<form action="tekstEditResult.php"  method="post" enctype="multipart/form-data" name="eventForm" >
  <input type="hidden" value="<?php echo $row['id']; //ovo sluzi za brisanje slike?>" id="id" name="id" />
  <input type="hidden" value="<?php echo $row['kreator']; ?>" id="kreator" name="kreator" />
  <input type="hidden" value="<?php echo $row['vremeUnosa'];?>" id="vremeUnosa" name="vremeUnosa" />
  <br />
  <br />
  <br />
  <div style="margin-right:400px; font-family:Arial; font-size:18px;">Izmena postojeceg teksta</div>
  <br>
  <table border="0" cellspacing="10px" >
    <tbody>
       <tr>
      <tr>
        <td width="100px" align="left">Naslov</td>
        <td width="100px" align="left"><input style="width:180px" type="text" id="naslov" name="naslov" value="<?php echo $row['naslov']; ?>"/> <br />
        </td>
      </tr>
      <tr>
        <td align="left">Tekst<br /></td>
        <td align="left"><textarea cols="30" rows="7"   id="tekst" name="tekst"><?php echo $row['tekst']; ?>
        </textarea></td>
      </tr>
      <tr>
        <td align="left">Opis</td>
        <td align="left"><input style="width:780px" type="text" id="opis" name="opis"  value="<?php echo $row['opis']; ?>"/></td>
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
        <td align="left">Kategorija</td>
        <td align="left">
          <select name="kategorija" id="kategorija"  style="width:180px">
            <option value="solo_tekst" <?php if($row['kategorija'] == 'solo_tekst') echo "selected='selected'" ?>>solo_tekst</option>
            <option value="biblioteka_preporuka" <?php if($row['kategorija'] == 'biblioteka_preporuka') echo "selected='selected'" ?>>biblioteka_preporuka</option>
          </select></td>
      </tr>
      <tr>
        <td align="left">Objavljeno na sajtu</td>
        <?php $dostupnost = $row['dostupnost'];
        if($dostupnost == 'da') 
		    {$temp='checked="checked"';$temp2 = ' ';}
		else { $temp2='checked="checked"';$temp =' ';} 
		?>
        <td align="left">
          <input type='radio' id="radio" name='radio' value='da' <?php echo $temp;?> />Da<br />
          <input type='radio' id="radio" name='radio' value='ne' <?php echo $temp2;?> />Ne<br /></td>
      </tr>      
    </tbody>
  </table>
  <table border="0" cellspacing="10px" >
    <tr>
      <td align="left"><br />
        <br>
        <input type="button" onclick="funkcija31()" value="Proveri validnost podataka"/>
        <div id="objava"></div>
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