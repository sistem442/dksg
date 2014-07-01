<?php session_start();
if (isset($_SESSION['user'])) {?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Unos događaja</title>
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
//**************************************proverava da li je unet datum, naslov i izabran program ******** *********** ****** ******************************	******************************** ********** ********** ********** ********** *********** ** 
function funkcija31(){		
	var dan = document.getElementById("d1").value;
	var mesec = document.getElementById("m1").value;
	var naslov = document.getElementById("naslov").value;
	var program = document.getElementById("program").value;
	
		
	if(dan != 0 && mesec != 0 && naslov != '' && program != 'Izaberite program'){	         
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
	 else if (program == "Izaberite program"){
         document.getElementById("posalji").disabled = true;
		 document.getElementById("validnost").innerHTML = "<span style='color:red'>Izaberite program!</span>";
     }	
	 else{		 
		 document.getElementById("posalji").disabled = true;
		 document.getElementById("validnost").innerHTML = "<span style='color:red'>Unesite ime dogadjaja!</span>";
     }
}
</script>
</head>
<body style="color:black; font-family:Arial, Helvetica, sans-serif;" onload="document.forms[0].posalji.disabled=true;">
<form action="eventEntryNewsResult.php"  method="post" enctype="multipart/form-data" name="eventForm"  >
  <br />
  <br />
  <br />
  <div style="margin-right:400px; font-family:Arial; font-size:18px; color:#009">Unos teksta i fajlova za novu vest</div>
  <br>
  <table border="0" cellspacing="10px" >
    <tbody>
      <tr>
        <td width="200" align="left">Naslov vesti</td>
        <td align="left"><input type="text" id="naslov" name="naslov" style="width:800px" ></td>
      </tr>
      <tr>
        <td width="200" align="left">Skraceni tekst<br />
          Unesite deo teksta koji će se pojaviti na naslovnoj stranici</td>
        <td align="left"><textarea cols="30" rows="7"   id="skr_tekst" name="skr_tekst"></textarea>
        <br />
    <div id='text_chars_needed'></div>
    <br />
    Preostali broj karaktera:
    <div style="display:inline" id="text_chars_left"></div>
        </td>
      </tr>
      <tr>
        <td width="200" align="left">Unesite ceo tekst koji će se pojaviti na posebnoj stranici</td>
        <td align="left"><textarea cols="30" rows="7"   id="tekst" name="tekst" class="editme"></textarea></td>
      </tr>
      <tr>
        <td width="200" align="left">Unesite sliku (maksimalna veličina je 1MB)</td>
        <td align="left"><input style="width:180px" type="hidden" name="MAX_FILE_SIZE" value="1048576">
          
        <input type="file" name="slikaUzTekst" id="slikaUzTekst" /></td>
      </tr>
      <tr>
        <td colspan="2"><br />
          <br />
          <strong> <span style="color:#009"> Donji deo se upisuje u bazu i služi za pretragu, 
          neće biti prikazan na sajtu(osim slika i fajlova). </span></strong><br />
          <br />
          Unesite početni datum prikazivanja vesti, najnovije dve vesti biće prikazane sa slikama, za sledećih pet vesti biće prikazan samo naslov</td>
      </tr>
      <tr>
        <td width="200" align="left">Dan </td>
        <td align="left"><select name="d1" id="d1">
            <option>01</option>
            <option>02</option>
            <option>03</option>
            <option>04</option>
            <option>05</option>
            <option>06</option>
            <option>07</option>
            <option>08</option>
            <option>09</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
            <option>19</option>
            <option>20</option>
            <option>21</option>
            <option>22</option>
            <option>23</option>
            <option>24</option>
            <option>25</option>
            <option>26</option>
            <option>27</option>
            <option>28</option>
            <option>29</option>
            <option>30</option>
            <option>31</option>
          </select></td>
      </tr>
      <tr>
        <td width="200" align="left">Mesec </td>
        <td align="left"><select name="m1" id="m1">
            <option>01</option>
            <option>02</option>
            <option>03</option>
            <option>04</option>
            <option>05</option>
            <option>06</option>
            <option>07</option>
            <option>08</option>
            <option>09</option>
            <option>10</option>
            <option>11</option>
            <option>12</option></select></td>
      </tr>
      <tr>
        <td width="200" align="left">Godina </td>
        <td align="left"><select id="g1" name="g1">
        <option>2018</option><option>2017</option><option>2016</option><option>2015</option><option>2014</option><option selected="selected">2013</option><option>2012</option>
        </select></td>
      </tr>
      <tr>
        <td width="200" align="left">Program</td>
        <td align="left">
          <select name="program" id="program"  onblur="displayResult()" style="width:180px">
            <option value="likovni">likovni</option>
            <option value="filmski">filmski</option>
            <option value="muzicki">muzicki</option>
            <option value="pozorisni">pozorišni</option>
            <option value="forum">forum</option>
            <option value="knjizevni">književni</option>
            <option value="afc">afc</option>
            <option value="biblioteka">biblioteka</option>
            <option value="ostali">ostali</option>
            <option selected="selected" value="Izaberite program">Izaberite program</option>
          </select></td>
      </tr>
    </tbody>
  </table>
  <table border="0" cellspacing="10px" >
    <tr>
      <td align="left"><br />
        <br>
        <input type="button" onclick="funkcija31()" value="Proveri validnost podataka"/>
        <input type="submit" name="posalji" value="Pošalji" id="posalji"  />
        <div id="validnost"><span style="color:red">Da biste postavili sadržaj na sajt prvo proverite podatke!</span></div>
        <br />
        <br />
        <a href='adminIndex.php'>Glavni meni</a>
        </div>
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