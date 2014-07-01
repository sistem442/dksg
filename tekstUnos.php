<?php session_start();
set_time_limit (600 );
if (isset($_SESSION['user'])) {?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Unos teksta</title>
<link href="backEnd.css" rel="stylesheet" type="text/css" />
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
		theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
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
//************************************proverava da li su uneti podaci******************************
function funkcija31(){	
    var tekst = document.getElementById("tekst").value;
	var opis = document.getElementById("opis").value;
	var radio = document.getElementById("radio").value;
	var naslov = document.getElementById("naslov").value;
	var kategorija = document.getElementById("kategorija").value;
	
	if (radio == 'da'){
		document.getElementById("objava").innerHTML = "<span style='color:green'>Tekst će biti vidljiv na sajtu</span>";
		}
	else{
		document.getElementById("objava").innerHTML = "<span style='color:red'>Tekst neće biti vidljiv na sajtu</span>";}
	
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

</script>
</head>
<body style="color:black; font-family:Arial, Helvetica, sans-serif;" onload="document.forms[0].posalji.disabled=true;">
<div class="container2">
<a href='adminIndex.php'>Glavni meni</a><br />
<br />
<form action="tekstUnosResult.php"  method="post" enctype="multipart/form-data" name="tekstForma" >
  <br />
  <br />
  <br />
  <br />
  <table border="0" cellspacing="10px" >
    <tbody>
          <tr ><td colspan="2" align="center" class="blueBold">Unos teksta</td></tr>
      <tr>
        <td width="101" align="left"> Tekst<br />
          Unesite ceo tekst koji će se pojaviti na posebnoj stranici</td>
        <td align="left"><textarea cols="30" rows="7"   id="tekst" name="tekst">
        </textarea></td>
      </tr>
      <tr>
        <td align="left">Unesite sliku koja će se pojaviti sa desne strane teksta na naslovnoj strani maksimalna veličina je 1MB</td>
        <td align="left"><!--input style="width:180px" type="hidden" name="MAX_FILE_SIZE" value="1048576"-->
          
          <input type="file" name="slikaUzTekst" id="slikaUzTekst" width="300px" /></td>
      </tr>
      <tr>
        <td colspan="2"><br />
          <br />
          <strong> <span style="color:#009"> Donji deo se upisuje u bazu i služi za pretragu, 
          neće biti prikazan na sajtu (osim fajlova). </span></strong><br />
          <br /></td>
      </tr>
      <tr>
        <td align="left">Naslov teksta</td>
        <td width="1066" align="left"><input style="width:180px" type="text" id="naslov" name="naslov"  />
          <br />
          <div id="txtHint1" class="warning"></div></td>
      </tr>
      <tr>
        <td align="left">Opis teksta.<br />
          Opis teksta će se prikazivati pri pretrazi tekstova.</td>
        <td align="left"><input style="width:780px" type="text" id="opis" name="opis" /></td>
      </tr>
      <tr>
        <td align="left"> Kategorija</td>
        <td align="left"><select style="width:180px" id="kategorija" name="kategorija">
            <option value="Izaberite kategoriju">Izaberite kategoriju</option>
            <option value="solo_tekst">solo_tekst</option>
            <option value="biblioteka_preporuka">biblioteka_preporuka</option>
          </select></td>
      </tr>
      <tr>
        <td align="left">Objavljeno na sajtu</td>
        <td align="left"><input id="radio" type='radio' name='radio' value='da' checked="checked">
          Da<br />
          <input type='radio' id="radio" name='radio' value='ne'>
          Ne<br /></td>
      </tr>
    </tbody>
  </table>
  <table border="0" cellspacing="10px" >
    <tr>
      <td align="left"><br />
        <br>
        <input type="button" onclick="funkcija31()" value="Proveri validnost podataka"/>
        <input type="submit" name="posalji" value="Pošalji" id="posalji"  />
        <div id="objava"></div>
        <div id="validnost"><span style="color:red">Da biste postavili sadržaj na sajt prvo proverite podatke!</span></div>
        <br />
        <br />
        <a href='adminIndex.php'>Glavni meni</a>
        </div>
        <br /></td>
        </td>
  </table>
</form>
</div>
</body>
</html>
<?php }
else { // Ako korisnik nije prijavljen na sistem
 echo "Niste prijavljeni!<br />
 <a href='login.php'>Prijava</a>
<br />";
}
?>