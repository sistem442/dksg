<?php
session_start();
if (!isset($_SESSION['user'])) {
	echo "Niste prijavljeni!<br />
 <a href='login.php'>Prijava</a>
<br />";
}
require_once("database_connect.php");
$parameter = mysql_real_escape_string(trim($_POST["parameter"]));
$value = mysql_real_escape_string(trim($_POST["value"]));
include ("class_lib.php");
$search_result = new search_result($parameter,$value);
$result=$search_result->get_search_result();
if(!is_resource($result)) $message = "Ne postoji rezlutat za zadate parametre!";
else $message = 0;
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional
//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Pretraga po datumu</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">
</script>

<script type="text/javascript">
function izmeni(id){
	window.location = "eventNewsEdit.php?id="+id;
	}
function obrisi(id){    
	var r = confirm("Da li stvarno zelite brisanje vesti");
	var divID = id;
	if (r==true){
  		$.ajax({ url:"eventNewsDelete.php?idTabele="+id});
		alert("Program  je obrisan!"); 
		$("#"+id).hide(600);
  	}
  	else alert("Program nije obrisan!");
	}
function prikazi(id){
	var newtab = window.open();
	newtab.location = "displayNews.php?id="+id;
	}	
</script>
<link href="back_end.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
if(!$message == 0) {echo $message; die;}?>
<div class="container">
  <div class="title_backend">Rezlutat pretrage vesti</div>
  <div class="table_container">
  <?php
while($row = mysql_fetch_array($result))
  { ?>
  <div id='<?php echo $row['idTabele'];?>'>
<div class="column_left"> 
<div class="tr_color_1">
	<div class="col_left">Naslov</div>
	<div class="col_mid"><?php echo $row['naslovVesti'];?></div>
</div>
<div style="clear:both"></div>
<div class="tr_color_2">
	<div class="col_left">Redakcija</div>
	<div class="col_mid"><?php echo $row['program'];?></div>
</div>
<div style="clear:both"></div>
<div class="tr_color_1">
	<div class="col_left">Vreme Unosa</div>
    <div class="col_mid"><?php echo $row['vremeUnosa'];?></div>
</div>
<div style="clear:both"></div>
<div class="tr_color_2">
	<div class="col_left">Uneo/la</div>
    <div class="col_mid"><?php echo $row['kreator'];?></div>
</div>
</div>
<div class="column_right">
    <input type='button' onclick="izmeni('<?php echo $row['idTabele'];?>')" value='Izmeni' style="width:80px"/>
    <input type='button' onclick="obrisi('<?php echo $row['idTabele'];?>')" value='Brisanje' style="width:80px"/>   
    <input type='button' onclick="prikazi('<?php echo $row['idTabele'];?>')" value='Prikaži' style="width:80px"/>
    </div>
<div style="clear:both"></div>
<div class="line"></div>
</div>
<?php }?>
</div>
<div class="title_backend"><a href="adminIndex.php">Povratak na glavni meni</a></div>
</div>
</body>
</html>