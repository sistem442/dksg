<?php
//konekcija sa bazom
require_once("database_connect.php");
//izbor baze
mysql_select_db("dksg_3120", $con);
if(!isset($_GET['rec'])){   
$rec = mysql_real_escape_string(trim($_POST["rec"]));
}
else{
	$rec = $_GET['rec'];
}
if(!isset($_GET['kolona'])){   
$kolona = mysql_real_escape_string(trim($_POST["kolona"]));
}
else{
	$kolona = $_GET['kolona'];
}
//*******************************************
 
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
$query ="SELECT * FROM event WHERE $kolona LIKE '%$rec%' LIMIT $from, $max_results";
$result = mysql_query($query);
//echo $query;
?>
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
<style type="text/css">
#bob {
	text-decoration:none
}

</style>
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
function sledecaStrana(str){
	window.location = "advancedSearchResultEXPERIMENT.php?id="+str;
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
  <DIV id="mainBig">
<?php
//ako nepostoji trazeni unos korisniku javljamo gresku 
if(mysql_num_rows($result) == 0){
	die ("<br><br>Ne postoji unos za traženu reč!</br>
		 <a href='advancedSearch.php'>Povratak</a>");
}
echo'<table cellpadding="10px" cellspacing="0px" width="425px">';
while($row = mysql_fetch_array($result)){  
    // Build your formatted results here.  
while($row = mysql_fetch_array($result)){
	echo "<tr>
			  <td>
			  ";
			  echo ("<a id='bob' href='javascript:showEvent(".$row['id'].")'>".$row['godina'].".".$row['mesec'].".".$row['dan'].' | '.$row['program']." | ".$row['nadnaslov']." | ".$row['imePrograma']." | učesnici i autori:".$row['ucesnici']."
</a> <br />
</td>
<tr><td>&nbsp;</td><tr>
</tr>
");
    }
	echo "</table>";
}  

// Figure out the total number of results in DB:  
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM event WHERE $kolona LIKE '%$rec%'"),0);  

// Figure out the total number of pages. Always round up using ceil()  
$total_pages = ceil($total_results / $max_results);  

// Build Page Number Hyperlinks  
echo "<center>Izaberite stranu<br />
Trenutno ste na strani: $page<br />
";  

// Build Previous Link  
if($page > 1){  
    $prev = ($page - 1);  
    echo "<a class='bob' href=\"".$_SERVER['PHP_SELF']."?page=$prev&rec=$rec&kolona=$kolona\"><<Previous</a> ";  
}  

for($i = 1; $i <= $total_pages; $i++){  
    if(($page) == $i){  
        echo "$i ";  
        } else {  
            echo "<a class='bob' href=\"".$_SERVER['PHP_SELF']."?page=$i&rec=$rec&kolona=$kolona\">$i</a> ";  
    }  
}
// Build Next Link  
if($page < $total_pages){  
    $next = ($page + 1);  
    echo "<a  class='bob' href=\"".$_SERVER['PHP_SELF']."?page=$next&rec=$rec&kolona=$kolona\">Next>></a>";  
}  
echo "</center></form>";  


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
