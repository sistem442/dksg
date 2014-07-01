<?php
//konekcija sa bazom
require_once("database_connect.php");
//citanje parametara
$category = $_GET['category'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Dom kulture Studentski grad <?php echo $category?></title>
<meta http-equiv="keywords" content=" dom ,kulture, studentski, grad">
<meta http-equiv="description" content="Dom kulture Studentski grad">
<link rel="shortcut icon" href="http://www.dksg.rs/favicon.ico" type="image/x-icon" />
<link rel="icon" href="http://www.dksg.rs/favicon.ico" type="image/ico" />
<META name="abstract" content="dom kulture u studentskom gradu u beogradu">
<LINK href="http://www.dksg.rs/reset.css" rel="stylesheet" type="text/css">
<LINK href="http://www.dksg.rs/main.css" rel="stylesheet" type="text/css">
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
<link href="http://www.dksg.rs/sidebarmenu.css" rel="stylesheet" type="text/css" />
<SCRIPT src="http://www.dksg.rs/ga.js" type="text/javascript"></SCRIPT>
<script type="text/javascript">

 var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-24345909-1']);
_gaq.push(['_trackPageview']);  
(function() {    var ga = document.createElement('script'); 
   ga.type = 'text/javascript'; ga.async = true;    
   ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';    
   var s = document.getElementsByTagName('script')[0]; 
   s.parentNode.insertBefore(ga, s);  }
   )();  


  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-16499062-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</HEAD>
<BODY>
<DIV id="content">
  <DIV id="header">
    <?php include_once("heder.php") ?>
  </DIV>
  <div id="menu"> 
  <?php include("menu.php"); ?>
  </div>
  <DIV id="mainBig">
    
	<!-- 
    
    POCETAK PAGINACIJE
    
    -->
	
	
	
	
	
<?php
// PAGINACIJA
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
	$query = ("SELECT * FROM tekstovi where kategorija='$category' ORDER BY id DESC LIMIT $from, $max_results ;");
//echo $query;
$result = mysql_query($query);
//ako nepostoji trazeni unos korisniku javljamo gresku 
if(!$result){
	die ("Došlo je do greške.</br>
		 <a href='index.php'>Povratak</a>");
}
$result = mysql_query($query);  
    // Build your formatted results here.  



$outputList="";
echo "<table>";
while($row2 = mysql_fetch_array($result)){ 
$aux = ' ';
//ako postoji slika uz tekst prikazi je u tekstu
if($row2['slika']!= '0'){
				  $aux ="<a href='".$row2['slika']."'><img style='float:right; padding:0px 5px 5px 15px;' src='http://www.dksg.rs/".$row2['slika']."' width='150px'></a>";}
    $id = $row2["id"];
	//echo ' id broj je'.$id;
    $outputList .= '<tr><td>'.$aux."<h1>".$row2['naslov']."</h1><br/><br/>".$row2['tekst']."</td>
<tr><td><hr/></td><tr>
</tr>
";}
echo $outputList;
	echo "</table>";

	// Figure out the total number of results in DB:  
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tekstovi where kategorija='$category'"),0);  

// Figure out the total number of pages. Always round up using ceil()  
$total_pages = ceil($total_results / $max_results);  

// Build Page Number Hyperlinks  
echo "<center>Izaberite stranu<br />";  

// Build Previous Link  
if($page > 1){  
    $prev = ($page - 1);  
    echo "<a href='http://dksg.rs/tekstCategoryDisplay.php?category=biblioteka_preporuka&page=$prev\'>&#60;&#60;Prethodna</a> ";  
}  

for($i = 1; $i <= $total_pages; $i++){  
    if(($page) == $i){  
        echo "<strong>$i</strong> ";  
        } else {  
            echo "<a href='http://dksg.rs/tekstCategoryDisplay.php?category=biblioteka_preporuka&page=$i\'>$i</a> ";  
    }  
}  

// Build Next Link  
if($page < $total_pages){  
    $next = ($page + 1);  
    echo "<a href='http://dksg.rs/tekstCategoryDisplay.php?category=biblioteka_preporuka&page=$next\'>Sledeća>></a>";  
}  
echo "</center>";  

?>
</DIV><!--main-->
</DIV><!--container-->
</body>
</html>
