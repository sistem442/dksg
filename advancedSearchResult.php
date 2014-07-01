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

<BODY>
<DIV id="content">
  <DIV id="header">
    <?php include_once("heder.php") ?>
  </DIV>
  <div id="menu">
    <?php include_once("menu.php"); ?>
  </div>
  <DIV id="mainBIG">
<?php
//konekcija sa bazom
require_once("database_connect.php");



$var1 = $_GET["var1"];
$var11 = mysql_real_escape_string(trim($_GET["var11"])); 
$var2 = $_GET["var2"];
$var22 = mysql_real_escape_string(trim($_GET["var22"]));
$var3 = $_GET["var3"];
$var33 = mysql_real_escape_string(trim($_GET["var33"]));
$var4 = $_GET["var4"];
$var44 = mysql_real_escape_string(trim($_GET["var44"]));
$var5 = $_GET["var5"];

$array = array(
    0 => $var1,
	1 => $var11,
	2 => $var2,
	3 => $var22,
	4 => $var3,
	5 => $var33,
	6 => $var4,
	7 => $var44,
	8 => $var5,
);

$query="SELECT * FROM event WHERE";

for($i = 1; $i <= 7; $i = ($i+2)){
		if(!empty($array[$i])){
			if(is_numeric($array[$i])){					
				$query = $query." ".$array[$i-1]." = ".$array[$i]." AND";
			}
			else{
				$reci = explode(" ", $array[$i]);
				// ako je u polje uneto vise reci iseci ih u pojedinacne reci i napravi od njih niz
				for($j=0; $j<sizeof($reci);$j++){
					//za svaku pojedinacnu rec u nizu
					/*if($j==sizeof($reci)-1){
						//ako postoji samo jedna rec u nizu dodaj je u query i izadji iz petlje
						$query = $query." ".$array[$i-1]." LIKE '%".$reci[$j]."%' AND";
						break;
					}*/
					$query = $query." ".$array[$i-1]." LIKE '%".$reci[$j]."%' AND";
					//dodaj parametar i vrednost u query za svaku rec
				}
			}
		}
}
	if($array[8] == "Sve")$query = substr($query, 0, -4); else $query = $query." id IN (SELECT id FROM ".$var5.")";
//	echo $query;
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//                              PAGINATION

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
// If current page number, use it  
// if not, set one!  

if(!isset($_GET['page'])){  
    $page = 1;  
} else {  
    $page = $_GET['page'];  
}  

// Define the number of results per page  
$max_results = 10;  

// Figure out the limit for the query based  
// on the current page number.  
$from = (($page * $max_results) - $max_results);  

 // Perform MySQL query on only the current page number's results  
//SQL izraz
	
	$query2 = ($query." ORDER BY `event`.`godina` DESC, `event`.`mesec` DESC,`event`.`dan` DESC LIMIT $from, $max_results ;");

$result = mysql_query($query2);
//ako nepostoji trazeni unos korisniku javljamo gresku 
if(!$result){
	die ("<span style='color:red'>Ne postoje rezlutati za traženu pretragu!</span><br />
			<a href='javascript:history.go(-1)'>Povratak</a>");
}
if(mysql_num_rows($result)==0){
	die ("<span style='color:red'>Ne postoje rezlutati za traženu pretragu!.</span><br />
			<a href='javascript:history.go(-1)'>Povratak</a>");
}
// Build your formatted results here.  

while($row = mysql_fetch_array($result)){
	$program = $row['program'];
			  switch($program)
			  {
				  case 'likovni':
				  $program2 = 'Likovni program';
				  break;
				  case 'filmski':
				  $program2 = 'Filmski program';
				  break;
				  case 'pozorisni':
				  $program2 = 'Pozorišni program';
				  break;
				  case 'muzicki':
				  $program2 = 'Muzički program';
				  break;
				  case 'biblioteka':
				  $program2 = 'Biblioteka';
				  break;
				  case 'afc':
				  $program2 = 'Akademski filmski centar';
				  break;
				  case 'forum':
				  $program2 = 'Forum';
				  break;
				  case 'ostali':
				  $program2 = 'Ostali programi';
				  break;
				  case 'radionica':
				  $program2 = 'Radionica';
				  break;
				  case 'obavestenje':
				  $program2 = 'Obaveštenje';
				  break;
				  case 'knjizevni':
				  $program2 = 'Književni program';
				  break;
				  case 'politicki':
				  $program2 = 'Društveno politički program';
				  break;
				  case 'naucni':
				  $program2 = 'Naučno obrazovni program';
				  break;
				  case 'kontakt':
				  $program2 = 'Kontakt program';
				  break;
				  default:
				   echo' ';  				 
			  }
	echo "<div style='border-bottom:1px; border-bottom-style:solid; border-bottom-color:#333; width:670px; padding:5px; margin-left:250px;'>
			  ";
			  $dan = $row['dan'];
						$mesec = $row['mesec'];
						if($dan < 10){$dan='0'.$dan;}
						if(strlen($mesec)==1){$mesec='0'.$mesec;}
			  if( is_null($row['s_opis'])){
							$outup_row = $dan.'.'. $mesec.'.'.$row['godina'].' | '.$program2.' | '.$row['imePrograma'];
							}
							else{
								$outup_row = $dan.'.'. $mesec.'.'.$row['godina'].' | '.$row['s_opis'];
								}
								
			  echo ("<a  href='event/".$row['id']."'>".$outup_row."</a></div>");
    }
//Fix query string for next step
$query3 = substr($query, 8);
$query3 = "SELECT COUNT(*) as Num".$query3; 

// Figure out the total number of results in DB:  
$total_results = mysql_result(mysql_query($query3),0);  

// Figure out the total number of pages. Always round up using ceil()  
$total_pages = ceil($total_results / $max_results);  

// Build Page Number Hyperlinks  
echo "<center>Izaberite stranu<br />";  

// Build Previous Link  
if($page > 1){  
    $prev = ($page - 1);  
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev&var1=$var1&var11=$var11&var2=$var2&var22=$var22&
			var3=$var3&var33=$var33&var4=$var4&var44=$var44&var5=$var5\">&#60;&#60;Prethodna</a> ";  
}  
// Show pages
for($i = 1; $i <= $total_pages; $i++){  
    if(($page) == $i){  
        echo "<strong>$i</strong> ";  
        } else {  
            echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i&var1=$var1&var11=$var11&var2=$var2&var22=$var22&
			var3=$var3&var33=$var33&var4=$var4&var44=$var44&var5=$var5\">$i</a> ";  
    }  
}  
// Build Next Link  
if($page < $total_pages){  
    $next = ($page + 1);  
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next&var1=$var1&var11=$var11&var2=$var2&var22=$var22&
			var3=$var3&var33=$var33&var4=$var4&var44=$var44&var5=$var5\">Sledeća>></a>";  
}  
echo "</center>";  

?>
 </DIV>
  <!--main-->
<div id="footer"> 
    <!--footer-->
    <!--?php include_once("footer.php");?-->
</div>
<!--footer-->  
</DIV>
<!--container-->

</body>
</html>