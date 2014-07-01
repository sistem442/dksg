<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Dom kulture Studentski grad</title>
<meta http-equiv="keywords" content=" dom ,kulture, studentski, grad, velika, sala, mala, studio, radionica, skola">
<meta http-equiv="description" content="Galerija fotografija sa programa Doma kulture Studentski grad">
<link rel="shortcut icon" href="http://dksg.rs/favicon.ico" type="image/x-icon" />
<link rel="icon" href="http://dksg.rs/favicon.ico" type="image/ico" />
<META name="abstract" content="Galerija fotografija sa programa Doma kulture Studentski grad">
<LINK href="http://dksg.rs/reset.css" rel="stylesheet" type="text/css">
<LINK href="http://dksg.rs/main.css" rel="stylesheet" type="text/css">
<SCRIPT src="http://dksg.rs/jquery-1.2.6.min.js" type="text/javascript" charset="utf-8"></SCRIPT>
<SCRIPT src="http://dksg.rs/ui_nav.js" type="text/javascript" charset="utf-8"></SCRIPT>
<SCRIPT src="http://dksg.rs/ga.js" type="text/javascript"></SCRIPT>
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
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
//********************************************************


//blok koji prikazuje galeriju slika za izabrane parametre


//********************************************************
if(isset($_GET["redakcija"])){
$redakcija = $_GET["redakcija"];}
else $redakcija = 'opsta';
//echo $redakcija;
switch($redakcija){
	case 'likovni': $redakcija4 = 'Likovni program';break;
	case 'filmski':  $redakcija4 = 'Filmski program';break;
    case 'muzicki': $redakcija4 = 'Muzički program';break;
    case 'pozorisni': $redakcija4 = 'Pozorišni program';break;
    case 'forum': $redakcija4 = 'program Forum';break;
    case 'knjizevni': $redakcija4 = 'Knjževni program';break;
    case 'afc': $redakcija4 = 'AFC program';break;
    case 'biblioteka': $redakcija4 = 'program Biblioteke';break;
}
if(isset($_GET["mesec"])){
$mesec = $_GET["mesec"];
}
else 
   $mesec = date('n');
if(isset($_GET["godina"])){
$godina = $_GET["godina"];
}
else 
   $godina = date('Y');
switch($mesec){
	case 1: $mesec4 = 'Januar';break;
	case 2: $mesec4 = 'Februar';break;
    case 3: $mesec4 = 'Mart';break;
    case 4: $mesec4 = 'April';break;
    case 5: $mesec4 = 'Maj';break;
    case 6: $mesec4 = 'Jun';break;
    case 7: $mesec4 = 'Jul';break;
    case 8: $mesec4 = 'August';break;
    case 9: $mesec4 = 'Septembar';break;
    case 10: $mesec4 = 'Oktobar';break;
    case 11: $mesec4 = 'Novembar';break;
    case 12: $mesec4 = 'Decembar';break;
}
//**************************************************************************

//Na vrhu strane prikazujem liste za izbor meseca i godine

//**************************************************************************

echo '<br /> 
		  <form action="galerija.php" method="get">
			<select name="redakcija" id="redakcija"  style="width:180px">
            	<option value="opsta" selected="selected">svi programi</option>
    	        <option value="likovni">likovni</option>
        	    <option value="filmski">filmski</option>
            	<option value="muzicki">muzički</option>
    	        <option value="pozorisni">pozorišni</option>
        	    <option value="forum">forum</option>
        	    <option value="knjizevni">književni</option>
        	    <option value="afc">afc</option>
        	    <option value="biblioteka">biblioteka</option>
            </select>
            <select name="godina" id="godina">
				<option value="2013" selected="selected">Izaberite</option>
             	<option value="2013">2013</option>
				<option value="2012">2012</option>
             	<option value="2011">2011</option>
			</select>
			<select name="mesec" id="mesec">
			  <option value="1" selected="selected">Izaberite</option>
              <option value="1">Januar</option>
              <option value="2">Februar</option>
              <option value="3">Mart</option>
              <option value="4">April</option>
              <option value="5">Maj</option>
              <option value="6">Jun</option>
              <option value="7">Jul</option>
              <option value="8">August</option>
              <option value="9">Septembar</option>
              <option value="10">Oktobar</option>
              <option value="11">Novembar</option>
              <option value="12">Decembar</option>
            </select> 
			<input type="submit" value="Prikaži">
	     </form><br />';
//********************************************************************

//Ako je su izabrani parametri pokazi slike

//********************************************************************
if(isset($redakcija)){	
//********************************************************************
	 
//Ako je opsta galerija

//********************************************************************
if(isset($_GET["redakcija"])){
$redakcija = $_GET["redakcija"];}
else $redakcija = 'opsta';
if($redakcija == 'opsta'){
	$prethodnaGodina = $godina -1;
	$redakcija = $_GET['redakcija'];
if(isset($_GET["mesec"])){
$mesec = $_GET["mesec"];
}
else 
   $mesec = date('n');
if(isset($_GET["godina"])){
$godina = $_GET["godina"];
}
else 
   $godina = date('Y');
// If current page number, use it  
// if not, set one!  

if(!isset($_GET['page'])){  
    $page = 1;  
} else {  
    $page = $_GET['page'];  
}  

// Define the number of results per page  
$max_results = 5;  

// Figure out the limit for the query based  
// on the current page number.  
$from = (($page * $max_results) - $max_results);  

 // Perform MySQL query on only the current page number's results  
//SQL izraz
	$query = ("
	SELECT * 
	FROM event  
	WHERE godina=$godina AND mesec=$mesec AND id IN( 
	   SELECT id FROM fajlovi 
	   WHERE klasaFajla = 'slika' AND galerija = 'da') ORDER BY `event`.`datum` ASC LIMIT $from, $max_results ;");
//echo $query;
$result = mysql_query($query);
//ako nema rezlutata pretrage javljamo da slike jos nisu unete
if(mysql_num_rows($result)==0){
	$poruka = "<span style='color:red; font-size:12px'>Trenutno nema unetih slika za izabrani program i vremenski opseg!</span>";
	}
	else{
		$poruka = '';
	}
$result = mysql_query($query);  
    // Build your formatted results here.  
echo "<div style='float:right; width:670px; color:black; font-size:18px; '> $mesec4 $godina. godine</DIV>			          <br />";
     echo $poruka;
	echo "</table>";
	// Figure out the total number of results in DB:  
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM event  
	WHERE godina=$godina AND mesec=$mesec AND id IN( 
	   SELECT id FROM fajlovi 
	   WHERE klasaFajla = 'slika' AND galerija = 'da')"),0);  

// Figure out the total number of pages. Always round up using ceil()  
$total_pages = ceil($total_results / $max_results);  
}//kraj uslova ako je u pitanju opsta galerija

//*******************************************************************

//ako je galerija odredjene redkacije	

//*******************************************************************
if($redakcija != 'opsta'){
	$redakcija = $_GET['redakcija'];
	if(isset($_GET["mesec"])){
		$mesec = $_GET["mesec"];
	}
	else 
   		$mesec = date('n');
	if(isset($_GET["godina"])){
		$godina = $_GET["godina"];
	}
	else 
   		$godina = date('Y');

	$prethodnaGodina = $godina -1;
// If current page number, use it  
// if not, set one!  

if(!isset($_GET['page'])){  
    $page = 1;  
} else {  
    $page = $_GET['page'];  
}  

// Define the number of results per page  
$max_results = 5;  

// Figure out the limit for the query based  
// on the current page number.  
$from = (($page * $max_results) - $max_results);  

 // Perform MySQL query on only the current page number's results  
//SQL izraz
	$query = ("
	SELECT * 
	FROM event  
	WHERE  program='$redakcija' AND godina=$godina AND mesec=$mesec AND id IN( 
	   SELECT id FROM fajlovi 
	   WHERE klasaFajla = 'slika' AND galerija = 'da') ORDER BY `event`.`datum` ASC LIMIT $from, $max_results ;");
//echo $query;
$result = mysql_query($query);
if(!$result){
	die ("Došlo je do greške 2.</br>
		 <a href='index.php'>Povratak</a>");
	}
//ako nema rezlutata pretrage javljamo da slike jos nisu unete
if(mysql_num_rows($result)==0){
	$poruka = "<span style='color:red; font-size:12px'>Trenutno nema unetih slika za izabrani program i vremenski opseg!</span>";
	}
	else{
		$poruka = '';
	}
	
    // Build your formatted results here.  
	echo "<div style='float:right; width:670px; color:black; font-size:18px; '> $mesec4 $godina. godine $redakcija4</DIV>			          <br />";
    echo $poruka;
	echo "</table>";
	// Figure out the total number of results in DB:
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM event  
WHERE  program='$redakcija' AND godina=$godina AND mesec=$mesec AND id IN( 
	   SELECT id FROM fajlovi 
	   WHERE klasaFajla = 'slika' AND galerija = 'da')"),0);  

// Figure out the total number of pages. Always round up using ceil()  
$total_pages = ceil($total_results / $max_results);    
}//Kraj uslova ko je galerija odredjene redkacije
//**********************************************************

//Navigacija kroz starnice

//**********************************************************
// Build Page Number Hyperlinks  
if ($poruka == '') echo "<center>Izaberite stranu<br />";  

// Build Previous Link  
if($page > 1){  
    $prev = ($page - 1);  
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev&redakcija=$redakcija&mesec=$mesec&godina=$godina\">&#60;&#60;Prethodna</a> ";  
}  

for($i = 1; $i <= $total_pages; $i++){  
    if(($page) == $i){  
        echo "<strong>$i</strong> ";  
        } else {  
            echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i&redakcija=$redakcija&mesec=$mesec&godina=$godina\">$i</a> ";  
    }  
}  

// Build Next Link  
if($page < $total_pages){  
    $next = ($page + 1);  
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next&redakcija=$redakcija&mesec=$mesec&godina=$godina\">Sledeća>></a>";  
}  
echo "</center>";
	 //******************************************************
		
	//prva petlja, lista događaje	

    //******************************************************	  
	while($row = mysql_fetch_array($result)){ 
	   $ime = $row['imePrograma'];
	   if($row['fotograf'] != 'nema') $fotograf = '| foto: '.$row['fotograf']; else $fotograf = '';
	   $link = 'javascript:showEvent('.$row['id'].')';
	   $datum = $row['dan'].'.'.$row['mesec'].'.'.$row['godina'];
	   $id = $row['id'];
	   $query2 = ("
	   SELECT fajlovi.path 
	   FROM fajlovi  
	   WHERE id = $id AND galerija='da'"); 
	   $result2 = mysql_query($query2);
	   $num_rows = mysql_num_rows($result2);
	   if($num_rows==0) die ("Trenutno nema slika.\n");
	   echo "<div style='float:right; width:670px;'>
	         <div style='padding:20px 20px 0px 0px; float:left;'><a href=http://dksg.rs/$link>$ime $datum $fotograf</a></div><br/><br/>";
       //*************************************************************	
       
	   //druga petlja, prikazuje slike
	   
	   //*************************************************************
	   while($row2 = mysql_fetch_array($result2)){
	      $path = $row2['path'];
	      echo "<div style='padding:10px 20px 10px 0px; float:left; width:140px;'>
		        <a href='http://dksg.rs/$path'>
				<img src=http://dksg.rs/$path width=140px/>
				</a>
				</div>";
	      }//kraj druge petlje
		  echo '</div>';
	}// kraj prve petlje	
// Build Page Number Hyperlinks  
//**********************************************************

//Navigacija kroz stranice

//**********************************************************
// Build Page Number Hyperlinks  
if ($poruka == '') echo "<div style='float:right'><div style='float:left; width:670px; text-align:center; height:40px'>Izaberite stranu<br />";  

// Build Previous Link  
if($page > 1){  
    $prev = ($page - 1);  
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev&redakcija=$redakcija&mesec=$mesec&godina=$godina\">&#60;&#60;Prethodna</a> ";  
}  

for($i = 1; $i <= $total_pages; $i++){  
    if(($page) == $i){  
        echo "<strong>$i</strong> ";  
        } else {  
            echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i&redakcija=$redakcija&mesec=$mesec&godina=$godina\">$i</a> ";  
    }  
}  

// Build Next Link  
if($page < $total_pages){  
    $next = ($page + 1);  
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next&redakcija=$redakcija&mesec=$mesec&godina=$godina\">Sledeća>></a>";  
}  
echo "</div></div>";
	}//kraj uslova ako je setovana redakcija
else die;

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
