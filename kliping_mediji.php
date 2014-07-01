<?php session_start();
include_once"database_connect.php";
if (isset($_SESSION['user'])) {
	
	?>
<!-- 
Izmene 
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Unos medija za kliping</title>
<link href="backEnd.css" rel="stylesheet" type="text/css" />
<!-- Link na script za formatiranje teksta-->
<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/event.js"></script>
</head>
<body>
<div class="container2">
<p><br />
  <a href='adminIndex.php'>Glavni meni</a>
  <?php if(isset($_POST['submit'])) 
{ 
    $medij = $_POST['medij'];
	$query = ("INSERT INTO mediji (ime) VALUES ('$medij')");
	$result = mysql_query($query);
//echo '<br>greska:'.mysql_errno($con) . ": " . mysql_error($con) . "\n";
//echo '<br>Izraz za upis u bazu:'.$query;
if(!$result){
	die("
	  <span style='color:red;'><br />
      <br />
      Greska u izvrsavnju SQL izraza za upis klipinga, obavestite sistem inzenjera!</span></a>");
}
echo '<br />
<br />
<span style="color:green;">Medij je uspešno dodat u bazu</span><br />
<div class="result"><a class="result2" href="adminIndex.php">Glavni meni</a></div>';
}
if(isset($_POST['submit2'])) 
{ 
    $medij = $_POST['medij'];
	$id = $_POST['id'];
	$query = ("UPDATE mediji SET ime = '$medij' WHERE id = $id");
	$result = mysql_query($query);
//echo '<br>greska:'.mysql_errno($con) . ": " . mysql_error($con) . "\n";
//echo '<br>Izraz za upis u bazu:'.$query;
if(!$result){
	die("
	  <span style='color:red;'><br />
      <br />
      Greska u izvrsavnju SQL izraza za izmenu klipinga, obavestite sistem inzenjera!</span></a>");
}
echo '<br />
<br />
<span style="color:green;">Medij je uspešno izmenjen u bazi</span><br />
<div class="result"><a class="result2" href="adminIndex.php">Glavni meni</a></div>';
}
?>
  </p>
<p>&nbsp;</p>
<p>
  <!-- Za upis novog medija-->
</p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <span class="plavo">UNOS MEDIJA</span><br />
   <br />
   Ime medija (maksimalna duzina je 30 karaktera)
<input type="text" name="medij"/>
   <input type="submit" name="submit" value="Unesi medij u bazu"><br>
</form>
<br />
<hr />
<br />
<br />
<br />
<!-- ZA izmenu medija-->
<span class="plavo">IZMENA MEDIJA</span><br />
<br />
<br />
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  Unesite id medija <input type="number" style="width:45px" name="id" />
   Novo ime medija (maksimalna duzina je 30 karaktera) <input type="text" name="medij"/>
   <input type="submit" name="submit2" value="Izmeni medij u bazi"><br/>
</form>
<br />
<br />
<?php
$query2 = ("SELECT *FROM mediji");
	$result2 = mysql_query($query2);
	while($row2 = mysql_fetch_array($result2)) echo $row2['id'].' '.$row2['ime'].'<br/>';
	//echo '<br>greska:'.mysql_errno($con) . ": " . mysql_error($con) . "\n";
	//echo '<br>Izraz za upis u bazu:'.$query2;
?>

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