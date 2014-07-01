<?php 
session_start();
if (!isset($_SESSION['user'])) {   
die("Niste prijavljeni!<br />
 <a href='login.php'>Prijava</a>
<br />");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pretraga vesti</title>
<script type="text/javascript">
function izmeni(id){
	window.location = "eventNewsEdit.php?id="+id;
	}
function obrisi(id){
	alert("Da li stvarno zelite brisanje?");
	window.location = "eventNewsDelete.php?idTabele="+id;
	}
function prikazi(id){
	/*window.open = ("newsDisplay.php?id="+id,"_blank");*/
	var newtab = window.open();
	newtab.location = "newsDisplay.php?id="+id;
	}	
</script>
<link href="back_end.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container">
  <div class="title_backend">Pretraga vesti</div>
  <form action="searchNewsResult.php" method="post">
    <div style="display:table">
      <div style="display:table-row">
        <div style="display:table-cell"> Izaberite parametar: </div>
        <div style="display:table-cell">
          <select name="parameter" id="parameter">
            <option value="naslovVesti"  selected="selected">naslov</option>
            <option value="program">program</option>
            <option value="m1">mesec unosa</option>
            <option value="kreator">korisničko ime</option>
            <option value="idTabele">id broj</option>
          </select>
          *id broj možete videti ako držite miša iznad naslova vesti na početnoj strani. </div>
      </div>
      <div style="display:table-row">
        <div style="display:table-cell"> Unesite vrednost parametra: </div>
        <div style="display:table-cell">
          <input type="text" name="value" id="value"/>
        </div>
      </div>
      <div style="display:table-row">
        <div style="display:table-cell"></div>
        <div style="display:table-cell">
          <input type='submit' value='Pretraži'/>
        </div>
    </div>
    
  </form>
</div>
</body>
</html>
