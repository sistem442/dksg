<?php session_start(); ?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional
//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Rezlutat pretrage dogadjaja</title>
<script type="text/javascript">
	function obradi(id){
		window.location = "eventEntryArchive.php?id="+id;
		}
</script>
<link href="http://dksg.rs/main.css" rel="stylesheet" type="text/css" />
<link href="backEnd.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
if (isset($_SESSION['user'])){}
else{
	echo "Niste prijavljeni!<br />
 <a href='login.php'>Prijava</a>
<br />";
}
//konekcija sa bazom
require_once("database_connect.php");
//citanje parametara
if(isset($_POST['rec'])) {$rec = mysql_real_escape_string(trim($_POST["rec"]));}
if(isset($_POST['kolona'])) {$kolona = mysql_real_escape_string(trim($_POST["kolona"]));}
if(isset($_POST['mesec2'])) {$mesec = mysql_real_escape_string(trim($_POST["mesec2"]));}
if(isset($_POST['godina'])) {$godina = mysql_real_escape_string(trim($_POST["godina"]));}
if(isset($_POST['izbor'])) {$izbor = mysql_real_escape_string(trim($_POST["izbor"]));}

if($izbor=="po_id_broju"){
$query ="SELECT * FROM event WHERE id = $rec";
//echo $query;
$result = mysql_query($query);
//echo $query;
//ako nepostoji trazeni unos korisniku javljamo gresku 
if(mysql_num_rows($result) == 0){
	die ("<br><br>Ne postoji unos za traženu reč!</br>
		 <a href='search.php'>Povratak</a>");
}
}

else if($izbor=="poReci"){
$query ="SELECT * FROM event WHERE $kolona LIKE '%$rec%'";
//echo $query;
$result = mysql_query($query);
//echo $query;
//ako nepostoji trazeni unos korisniku javljamo gresku 
if(mysql_num_rows($result) == 0){
	die ("<br><br>Ne postoji unos za traženu reč!</br>
		 <a href='search.php'>Povratak</a>");
}
}

else if($izbor=="poDatumu"){
$query ="SELECT * FROM event WHERE mesec=$mesec AND godina=$godina";
$result = mysql_query($query);
//echo $query;
//ako nepostoji trazeni unos korisniku javljamo gresku 
if(mysql_num_rows($result) == 0){
	die ("<br><br>Ne postoji unos za traženi datum!</br>
		 <a href='search.php'>Povratak</a>");
		 
}
}
else  if($izbor=="oba"){
$query ="SELECT * FROM event WHERE mesec=$mesec AND godina=$godina AND ($kolona LIKE  '%$rec%')";
$result = mysql_query($query);
//echo $query;
//ako nepostoji trazeni unos korisniku javljamo gresku 
if(mysql_num_rows($result) == 0){
	die ("Ne postoji unos za traženu kombinaciju datuma i treči!</br>
		 <a href='search.php'>Povratak</a>");
}
}
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional
//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <title>Pretraga po datumu</title>
    <script type="text/javascript">
        function izmeni(id){
            window.location = "eventEdit.php?id="+id;
            }
        function obrisi(id){
            if (confirm('Da li stvarno zelite brisanje?')){
              window.location = "eventDelete.php?id="+id; }
            else {
              window.location.href = 'search.php' }
            }
        function prikazi(id){
            window.location = "oneEventDisplay.php?id="+id;
            }	
        function unesi_kliping(id){
            window.location = "kliping_entry.php?id="+id;
            }	
        function izmeni_kliping(id){
            window.location = "kliping_edit.php?id="+id;
            }	
    
    </script>
</head>
<body>
    <br />
    <br />
    <table cellpadding='10px', border='1px', cellspacing='10px'>
        <tr style='background-color:#0C0'>
          <td>Ime programa</td>
          <td>redakcija</td>
          <td>datum</td>
          <td class="plavo">OPERACIJA</td>
          <td>id broj</td>
          <td>podnaslov</td>
          <td>nadnaslov</td>
          <td>vreme unosa</td>
          <td>vreme izmene</td>
        </tr>
        <?php while($row = mysql_fetch_array($result))
          {
          echo "
                <tr>
                  <td>".$row['imePrograma']."</td>
                  <td>".$row['program']."</td>
                  <td>".$row['dan'].". ".$row['mesec'].". ".$row['godina']."</td>
                  <td>
                    <input type='button' onclick='izmeni(".$row['id'].")' value='Izmeni'/><br />
                    <input type='button' onclick='obrisi(".$row['id'].")' value='Brisanje'/><br />
                    <input type='button' onclick='prikazi(".$row['id'].")' value='Prikaži'/><br />
                    <input type='button' onclick='unesi_kliping(".$row['id'].")' value='Unesi kliping'/><br />
                  </td>
                  <td>".$row['id']."</td>
                  <td>".$row['podnaslov']."</td>
                  <td>".$row['nadnaslov']."</td>
                  <td>".$row['vremeUnosa']."</td>
                  <td>".$row['vremeIzmene']."</td>
                </tr>";
          }?>
    </table>
    <br />
</body>
</html>