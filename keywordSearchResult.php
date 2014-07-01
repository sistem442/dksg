<?php 
//konekcija sa bazom
require_once("database_connect.php");
//izbor baze
mysql_select_db("dksg_3120", $con);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Dom kulture Studentski grad</title>
<meta http-equiv="keywords" content=" dom ,kulture, studentski, grad, velika, sala, mala, studio, radionica, skola, slikanja, deca, decu, predskolska, skolska">
<meta http-equiv="description" content="likovna  kreativna radionica za mlađi uzrast u domu kulture Studentski grad">
<link rel="shortcut icon" href="http://dksg.rs/favicon.ico" type="image/x-icon" />
<link rel="icon" href="http://dksg.rs/favicon.ico" type="image/ico" />
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
function showNews(str)
{	
    window.location = "displayNews.php?id="+str;
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
  <DIV id="image">

  </DIV>
  <div id="vesti">
  </div>
   <DIV id="mainBig">
<?php
//citanje parametara
if(!isset($_GET['rec'])){//ako se stranica poziva prvi put parametar dobijam sa strane oneDateResult ili menu  
     $rec = mysql_real_escape_string(trim($_POST["rec"]));
} else {  
     $rec = $_GET['rec']; //ako je vec bila izlistana pretraga parametar dobijam pomocu GET i linka za sledecu starnu
	
}
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
$query ="SELECT * FROM event WHERE (imePrograma LIKE '%$rec%') ||(skrTekst LIKE '%$rec%') || (tekst LIKE '%$rec%') || (ucesnici LIKE '%$rec%') ||(podnaslov LIKE '%$rec%') || (nadnaslov LIKE '%$rec%') ORDER BY godina DESC, mesec DESC, dan ASC LIMIT $from, $max_results ;";
//echo $query;
$result = mysql_query($query);
//ako nepostoji trazeni unos korisniku javljamo gresku 
if(mysql_num_rows($result)==0){
	die ("<span style='color:red'>Ne postoje rezlutati za traženu pretragu!.</span><br />");
}
$result = mysql_query($query);  
// Build your formatted results here.  
echo "<table>";
while($row = mysql_fetch_array($result)){
	$dan = $row['dan'];
							$mesec = $row['mesec'];
							if($dan < 10){$dan='0'.$dan;}
							if(strlen($mesec)==1){$mesec='0'.$mesec;}
							if( is_null($row['s_opis'])){
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
							$outup_row = $dan.'.'. $mesec.'.'.$row['godina'].' | '.$program2.' | '.$row['imePrograma'];
							}
							else{$outup_row = $dan.'.'. $mesec.'.'.$row['godina'].' | '.$row['s_opis'];}
	echo "<tr>
			  <td>
			  ";?>
			   <a  href='oneEventDisplay.php?id=<?php echo ($row['id']);?>'>
									<?php echo $outup_row;?> </a>  <br />
</td>
<tr><td><hr/></td><tr>
</tr>
<?php }
	echo "</table>";

	// Figure out the total number of results in DB:  
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM event WHERE (imePrograma LIKE '%$rec%') ||(skrTekst LIKE '%$rec%') || (tekst LIKE '%$rec%') || (ucesnici LIKE '%$rec%') ||(podnaslov LIKE '%$rec%') || (nadnaslov LIKE '%$rec%')"),0);  

// Figure out the total number of pages. Always round up using ceil()  
$total_pages = ceil($total_results / $max_results);  

// Build Page Number Hyperlinks  
echo "<center>Izaberite stranu<br />";  

// Build Previous Link  
if($page > 1){  
    $prev = ($page - 1);  
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev&rec=$rec\"><<Prethodna</a> ";  
}  

for($i = 1; $i <= $total_pages; $i++){  
    if(($page) == $i){  
        echo "$i ";  
        } else {  
            echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i&rec=$rec\">$i</a> ";  
    }  
}  

// Build Next Link  
if($page < $total_pages){  
    $next = ($page + 1);  
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next&rec=$rec\">Sledeća>></a>";  
}  
echo "</center>";  

?>
    <p><!--main--> 
      
    </p>
  </DIV>
  <div id="footer"> 
    <!--footer-->
    <!--?php include_once("footer.php");?-->
</div>
<!--footer-->
</DIV>
<!--container-->
</body>
</html>
