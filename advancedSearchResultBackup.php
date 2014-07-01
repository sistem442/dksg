<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>Rezlutat Napredne Pretrage</TITLE>
<link rel="shortcut icon" href="http://dksg.rs/favicon.ico" type="image/x-icon" />
<link rel="icon" href="http://dksg.rs/favicon.ico" type="image/ico" />
<META name="keywords" content="dom kulture, studentski grad, predstava, pozoriste, film, galerija, forum, knjizevnost, koncert, muzika, beograd">
<META name="description" content="dom kulture u studentskom gradu u beogradu">
<META name="abstract" content="dom kulture u studentskom gradu u beogradu">
<LINK href="http://dksg.rs/reset.css" rel="stylesheet" type="text/css">
<LINK href="http://dksg.rs/main.css" rel="stylesheet" type="text/css">

<SCRIPT src="http://dksg.rs/jquery-1.2.6.min.js" type="text/javascript" charset="utf-8"></SCRIPT>
<SCRIPT src="http://dksg.rs/ui_nav.js" type="text/javascript" charset="utf-8"></SCRIPT>
<STYLE id="tmpStyle" type="text/css" disabled="">
#pic {
	-moz-opacity:0.00;
	filter:alpha(opacity=0);
	opacity:0;
	-khtml-opacity:0;
}
</STYLE>

<SCRIPT type="text/javascript" src="../script.js"></SCRIPT>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-16499062-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
function showEvent(str)
{	
    window.location = "oneEventDisplay.php?id="+str;
} 
</script>
</HEAD>
<SCRIPT src="http://dksg.rs/ga.js" type="text/javascript"></SCRIPT>
<?php
//konekcija sa bazom
require_once("database_connect.php");
//izbor baze
mysql_select_db("dksg_3120", $con);
//izbor da li je pretraga po jednom ili vise parametara
$izbor = mysql_real_escape_string(trim($_POST["izbor"]));
if($izbor != 'viseParametara'){
//pretraga baze po jednom parametru
$rec = mysql_real_escape_string(trim($_POST["rec"]));
$kolona = mysql_real_escape_string(trim($_POST["kolona"]));
$mesec = mysql_real_escape_string(trim($_POST["mesec"]));
$godina = mysql_real_escape_string(trim($_POST["godina"]));
$izbor = mysql_real_escape_string(trim($_POST["izbor"]));
if(isset($_POST['materijal'])) {
    $materijal = $_POST['materijal'];
}
//*********************************************************
if($izbor=="poReci"){
$query ="SELECT * FROM event WHERE $kolona LIKE '%$rec%' ORDER BY godina DESC, mesec DESC, dan ASC";
$result = mysql_query($query);
//echo $query;
//ako nepostoji trazeni unos korisniku javljamo gresku 
if(mysql_num_rows($result) == 0){
	die ("<br><br>Ne postoji unos za traženu reč!</br>
		 <a href='advancedSearch.php'>Povratak</a>");
}
}

else if($izbor=="poDatumu"){
$query ="SELECT * FROM event WHERE mesec=$mesec AND godina=$godina ORDER BY godina DESC, mesec DESC, dan ASC";
$result = mysql_query($query);
//echo $query;
//ako nepostoji trazeni unos korisniku javljamo gresku 
if(mysql_num_rows($result) == 0){
	die ("<br><br>Ne postoji unos za traženi datum!</br>
		 <a href='advancedSearch.php'>Povratak</a>");
		 
}
}
else  if($izbor=="oba"){
$query ="SELECT * FROM event WHERE mesec=$mesec AND godina=$godina AND ($kolona LIKE  '%$rec%') ORDER BY godina DESC, mesec DESC, dan ASC";
$result = mysql_query($query);
//echo $query;
//ako nepostoji trazeni unos korisniku javljamo gresku 
if(mysql_num_rows($result) == 0){
	die ("Ne postoji unos za traženu kombinaciju datuma i treči!</br>
		 <a href='advancedSearch.php'>Povratak</a>");
}
}
else  if($izbor=="sveTri"){
$query ="SELECT * FROM event WHERE mesec=$mesec AND godina=$godina AND ($kolona LIKE  '%$rec%') AND $materijal='da' ORDER BY godina DESC, mesec DESC, dan ASC ";
$result = mysql_query($query);
//echo $query;
//ako nepostoji trazeni unos korisniku javljamo gresku 
if(mysql_num_rows($result) == 0){
	die ("Ne postoji unos za traženu kombinaciju datuma,reči i vrste arhiviranog materijala!</br>
		 <a href='advancedSearch.php'>Povratak</a>");
}
}
}//kraj if ako je pretraga po jednom parametru
//*****************************************************************************************************************
else if($izbor == 'viseParametara'){
//citanje zadatih parametara ako se koristi pretraga po vise parametara
$d1 = mysql_real_escape_string(trim($_POST["d1"]));
$m1 = mysql_real_escape_string(trim($_POST["m1"]));
$g1 = mysql_real_escape_string(trim($_POST["g1"]));
$d2 = mysql_real_escape_string(trim($_POST["d2"]));
$m2 = mysql_real_escape_string(trim($_POST["m2"]));
$g2 = mysql_real_escape_string(trim($_POST["g2"]));
$adv1 = $_POST["parametar1"];
$advTxt1 = $_POST["parametar1i"];
$adv11 = $_POST["parametar11"];
if($adv11=='!='){
	$adv1a='and';
	$adv1b=' NOT LIKE';
}
	else{
		$adv1a=$adv11;
		$adv1b=' LIKE';
	}
$adv2 = $_POST["parametar2"];
$advTxt2 = $_POST["parametar2i"];
$adv22 = $_POST["parametar22"];
if($adv22=='!='){
	$adv2a='and';
	$adv2b=' NOT LIKE';
}
	else{
		$adv2a=$adv22;
		$adv2b=' LIKE';
	}
$adv3 = $_POST["parametar3"];
$advTxt3 = $_POST["parametar3i"];
$adv33 = $_POST["parametar33"];
if($adv33=='!='){
	$adv3a='and';
	$adv3b=' NOT LIKE';
}
	else{
		$adv3a=$adv33;
		$adv3b=' LIKE';
	}$adv4 = $_POST["parametar4"];
$advTxt4 = $_POST["parametar4i"];


//SQL izraz 
$query = "SELECT * from event where 
				 ".$adv1." LIKE '%".$advTxt1."%' ".$adv1a." ".$adv2.$adv1b." '%".$advTxt2."%'
				 ".$adv2a." ".$adv3.$adv2b." '%".$advTxt3."%' ".$adv3a." ".$adv4.$adv3b."'%".$advTxt4."%' AND ($d1 <= dan && $m1 <= mesec && $g1 <= godina) AND ($d2 >= dan && $m2 >= mesec && $g2 >= godina) ORDER BY godina DESC, mesec DESC, dan ASC";				
//echo "Generisan SQL zahtev:<br />".$query;
$result = mysql_query($query);
//ako nepostoji trazeni unos korisniku javljamo gresku 
if(mysql_num_rows($result) == 0){
	die ("Nepostoji rezlutat sa zadatim kljucnom recima</br>
		 <a href='advancedSearch.php'>Povratak</a><br />
          <br />
           Generisan SQL zahtev:<br />
           ".$query);
}
}//kraj else if ako se koristi pretraga po vise parametara
?>

<BODY>
<DIV id="content">
  <DIV id="header">
    <?php include_once("heder.php") ?>
  </DIV>
   
  <div id="menu">
    <?php include_once("menu.php"); ?>          
  </div>
   <DIV id="image"></DIV>
  

  

  <div id="vesti">
    </div>
  
  
  <DIV id="mainBig">
<?php
echo "<table>";
while($row = mysql_fetch_array($result)){
	echo "<tr>
			  <td>
			  ";
			  echo ("<a href='javascript:showEvent(".$row['id'].")'>".$row['godina'].".".$row['mesec'].".".$row['dan'].' | '.$row['program']." | ".$row['nadnaslov']." | ".$row['imePrograma']." | učesnici i autori:".$row['ucesnici']."
</a> <br />
</td>
<tr><td><hr/></td><tr>
</tr>
");
    }
	echo "</table>";
?>
</DIV>
  <!--main-->
  
  
  
  
  
  
  
  <div id="footer">
    <!--footer-->
    <?php include_once("footer.php");?>
</div>
  <!--footer-->
</DIV>
<!--container-->
</body>
</html>
