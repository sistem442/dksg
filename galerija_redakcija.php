<?php
//konekcija sa bazom
require_once("database_connect.php");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

$redakcija = $_GET["redakcija"];
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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>DKSG Foto Galerija <?php echo $redakcija4;?></title>
<meta http-equiv="keywords" content=" dom ,kulture, studentski, grad, velika, sala, mala, studio, radionica, skola">
<meta http-equiv="description" content="Galerija fotografija sa programa Doma kulture Studentski grad">
<link rel="shortcut icon" href="http://dksg.rs/favicon.ico" type="image/x-icon" />
<link rel="icon" href="http://dksg.rs/favicon.ico" type="image/ico" />
<META name="abstract" content="Galerija fotografija sa programa Doma kulture Studentski grad">
<LINK href="http://dksg.rs/reset.css" rel="stylesheet" type="text/css">
<LINK href="http://dksg.rs/main.css" rel="stylesheet" type="text/css">
<SCRIPT src="http://dksg.rs/jquery-1.10.1.min.js" type="text/javascript" charset="utf-8"></SCRIPT>
<SCRIPT src="http://dksg.rs/ui_nav.js" type="text/javascript" charset="utf-8"></SCRIPT>
<SCRIPT src="http://dksg.rs/ga.js" type="text/javascript"></SCRIPT>
<!-- Fancybox -->
	<link rel="stylesheet" type="text/css" href="http://dksg.rs/css/jquery.fancybox.css?v=2.1.5" media="screen" />
    <link rel="stylesheet" type="text/css" href="http://dksg.rs/css/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="http://dksg.rs/jquery.fancybox.js?v=2.1.5"></script>
	<script type="text/javascript" src="http://dksg.rs/jquery.fancybox-buttons.js?v=1.0.5"></script>
		

<script type="text/javascript">

$(document).ready(function() {
			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Slika ' + (this.index + 1) + ' od ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});
});
//End of Fancybox
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
	WHERE  program='$redakcija' AND id IN( 
	   SELECT id FROM fajlovi 
	   WHERE klasaFajla = 'slika' AND galerija = 'da') ORDER BY `event`.`datum` DESC LIMIT $from, $max_results ;");
//echo $query;
$result = mysql_query($query);
if(!$result){
	die ("Došlo je do greške broj 2.</br>
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
	echo "<div style='float:right; width:670px; color:black; font-size:18px; '> Foto galerija $redakcija4</DIV>			          <br />";
    echo $poruka;
	echo "</table>";
	// Figure out the total number of results 
$total_results = 20;

// Figure out the total number of pages. Always round up using ceil()  
$total_pages = ceil($total_results / $max_results);    
//**********************************************************

//Navigacija kroz starnice

//**********************************************************
// Build Page Number Hyperlinks  
if ($poruka == '') echo "<center>Izaberite stranu<br />";  

// Build Previous Link  
if($page > 1){  
    $prev = ($page - 1);  
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev&redakcija=$redakcija\">&#60;&#60;Prethodna</a> ";  
}  

for($i = 1; $i <= $total_pages; $i++){  
    if(($page) == $i){  
        echo "<strong>$i</strong> ";  
        } else {  
            echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i&redakcija=$redakcija\">$i</a> ";  
    }  
}  

// Build Next Link  
if($page < $total_pages){  
    $next = ($page + 1);  
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next&redakcija=$redakcija\">Sledeća>></a>";  
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
	         <div style='padding:20px 20px 0px 0px; float:left;'><a href='http://dksg.rs/oneEventDisplay.php?id=".$row['id']."'>$ime $datum $fotograf</a></div><br/><br/>";
       //*************************************************************	
       
	   //druga petlja, prikazuje slike
	   
	   //*************************************************************
	   while($row2 = mysql_fetch_array($result2)){
	      $path = $row2['path'];
	     echo '<div style="padding:10px 20px 10px 0px; float:left; width:140px;">
		        <a class="fancybox-buttons" data-fancybox-group="button" title="'.$ime.' '.$datum.' '.$fotograf.'" href="http://dksg.rs/'.$path.'">
				<img src=http://dksg.rs/'.$path.' width=140px/> 
				</a>
				</div>';
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
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev&redakcija=$redakcija\">&#60;&#60;Prethodna</a> ";  
}  

for($i = 1; $i <= $total_pages; $i++){  
    if(($page) == $i){  
        echo "<strong>$i</strong> ";  
        } else {  
            echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i&redakcija=$redakcija\">$i</a> ";  
    }  
}  

// Build Next Link  
if($page < $total_pages){  
    $next = ($page + 1);  
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next&redakcija=$redakcija\">Sledeća>></a>";  
}  
echo "</div></div>";


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
