<?php
//konekcija sa bazom
require_once("database_connect.php");
if (!$con)
  {
  die('Nije moguce povezivanje sa bazom, poruka o gresci: ' . mysql_error());
  }
  
$result0 = mysql_query("SELECT ime FROM mediji");//za listanje medija u selectu

//ako vec postoji $_SESSION[úpit znaci da je vec poslat upit u bazu preko pretrage pa ne treba ponovo graditi upit
if (isset($_SESSION['upit']))$upit = $_SESSION['upit'];
else{
	if(isset($_POST['submit'])){
		$flag2 = 'solo';  
		if(($_POST['medij']!= '') && ($_POST['rec']!='')) $flag2 = 'dual'; else $flag2='emty';
		if($_POST['medij']!= '') {$medij = $_POST['medij']; $flag2 = 'medij';}
		if($_POST['rec']!= ''){$rec = $_POST['rec']; $flag2 = 'rec';}
		if($flag2 == 'dual') $upit2 = " naslov_dogadjaja LIKE '%".$rec."%' AND medij = ".$medij;
		elseif( $flag2 == 'medij') $upit2 = " medij = '".$medij."'";
		elseif( $flag2 == 'rec') $upit2 = "naslov_dogadjaja LIKE '%".$rec."%'";
		//echo $flag2;
		$flag = 'ok';
		if(($_POST['prvi_dan'])!= 'D')$prvi_dan = $_POST['prvi_dan']; else $flag = 'nok';
		if(($_POST['drugi_dan'])!= 'D')$drugi_dan = $_POST['drugi_dan']; else $flag = 'nok';
		if(($_POST['prvi_mesec'])!= 'M')$prvi_mesec = $_POST['prvi_mesec']; else $flag = 'nok';
		if(($_POST['drugi_mesec'])!= 'M')$drugi_mesec = $_POST['drugi_mesec']; else $flag = 'nok';
		if(($_POST['godina'])!= 'G')$godina_unosa = $_POST['godina']; else $flag = 'nok';	
		
		//ako je samo pretraga po datumu
		if($flag == 'ok' && $flag2 == 'emty'){ 
			$prvi_datum = $godina_unosa.$prvi_mesec.$prvi_dan;
			$drugi_datum = $godina_unosa.$drugi_mesec.$drugi_dan;
			$upit = 'datum >= '.$prvi_datum.' AND datum <='.$drugi_datum;
		}
		//pretraga po datumu i recima								 
		elseif ($flag == 'ok'){
			$prvi_datum = $godina_unosa.$prvi_mesec.$prvi_dan;
			$drugi_datum = $godina_unosa.$drugi_mesec.$drugi_dan;
			$upit = $upit2.' AND datum >= '.$prvi_datum.' AND datum <='.$drugi_datum;;
		}
		//pretraga samo po recima
		else $upit = $upit2;
		//ubacijum upit u sesiju za listanje stranica
		$_SESSION['upit'] = $upit;								 
			/*$query = ("SELECT * FROM kliping 
						WHERE  ".$upit."  
						ORDER BY `kliping`.`godina_unosa` DESC, `kliping`.`mesec_unosa` 
						DESC,`kliping`.`dan_unosa` DESC LIMIT 0, 30 ;");*/
		
			//echo '<br>greska:'.mysql_errno($con) . ": " . mysql_error($con) . "\n";
			//echo '<br>Izraz za upis u bazu:'.$query;
	}
	//ako se prikazuje stranica po prvi put, bez upotrebe forme, izlistaj zadnjih 6 meseci
	else{  
		$godina = date('Y');
		$mesec = date('m');
		$dan = date('d');
		$danas = $godina.$mesec.$dan; 
		//echo "danas je: ".$danas;
		if($mesec > 6) $upit = " (datum < $danas AND datum > ($danas - 600))";
		else $upit = " (datum < $danas AND datum >($danas - 9400))";
	}
	
	//$query = ("SELECT * FROM kliping ORDER BY `kliping`.`godina_unosa` DESC, `kliping`.`mesec_unosa` DESC,`kliping`.`dan_unosa` DESC LIMIT 0, 30 ;");
}

	//echo '<br>greska:'.mysql_errno($con) . ": " . mysql_error($con) . "\n";
	//echo '<br>Izraz za upis u bazu:'.$query;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Arhiva press klipinga</title>
<link rel="shortcut icon" href="http://dksg.rs/favicon.ico" type="image/x-icon" />
<link rel="icon" href="http://dksg.rs/favicon.ico" type="image/ico" />
<meta name="keywords" content="afc,dom kulture, studentski grad, predstava, pozoriste, film, galerija, forum, knjizevnost, koncert, muzika, beograd">
<meta name="description" content="dom kulture u studentskom gradu u beogradu">
<meta name="abstract" content="dom kulture u studentskom gradu u beogradu">
<link href="http://dksg.rs/reset.css" rel="stylesheet" type="text/css">
<link href="http://dksg.rs/main.css" rel="stylesheet" type="text/css">

<script src="http://dksg.rs/jquery-1.2.6.min.js" type="text/javascript" charset="utf-8"></script>
<script src="http://dksg.rs/ui_nav.js" type="text/javascript" charset="utf-8"></script>
<style id="tmpStyle" type="text/css" disabled="">
#pic {
	-moz-opacity:0.00;
	filter:alpha(opacity=0);
	opacity:0;
	-khtml-opacity:0;
}
.nav2:hover {
	background: url('http://www.dksg.rs/images/osnovne/strelica_desno.jpg') no-repeat top 0 right 0;
	cursor: pointer;
}
.nav2 {
	background: url('http://www.dksg.rs/images/osnovne/strelica_desno.jpg') no-repeat top 0 right 0;
}
</style>

<script type="text/javascript" src="../script.js"></script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-16499062-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
function showEventVesti(str){	
    window.location = "displayNews.php?id="+str;
} 
function otvori_kliping(id) {
     var prozor, aw, ah;
     ah = screen.availHeight * .85;
     aw = screen.availWidth * .85;
     prozor = window.open('kliping_display_one.php?id=' + id, 'pregled', 'toolbar=0,location=0,status=0,scrollbars=1,width=' + aw + ',height=' + ah + ',left=' + aw * .025 + ',top=' + ah * .01)
}
function otvori_event(id) {
     var prozor, aw, ah;
     ah = screen.availHeight * .85;
     aw = screen.availWidth * .85;
     prozor = window.open( id, 'pregled', 'toolbar=0,location=0,status=0,scrollbars=1,width=' + aw + ',height=' + ah + ',left=' + aw * .025 + ',top=' + ah * .01)
}
function otv2(link) {
     window.open(link, 'prozor', "height=600;width=800");
}
function pretraga2(){
	alert('áaa');
	$("form#myform").submit();
	alert('áaa');
	}
function izmeni_kliping(id){
	window.location = "kliping_edit.php?id="+id;
	}
</script>
</head>
<body>
<div id="content">
  <div id="mainBig">
  <a href="adminindex.php">Glavni meni</a>
  <div style="width:270px; margin: 0 auto"> 
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="myform">
    <table border="0" cellspacing="0" cellpadding="2">
        <tr><td colspan="5" style="text-align:center; padding:10px; font-size:14px; font-weight:bold">
        Pretraga Press klipinga</td></tr>
        <tr>
            <td colspan="2">
                <div align="right">Medij:
                </div>
            </td>
            <td colspan="3">
                <select name="medij">
   <option value="" selected="selected"></option>
   <?php while($row0 = mysql_fetch_array($result0)) echo '<option>'.$row0['ime'].'</option>';?>
   </select>
            </td>
        </tr>
        <tr><td colspan="2">Naziv događaja:</td><td colspan="3"><input type="text" name="rec"/></td></tr>
        <tr>
            <td colspan="2" class="xtramali">
                <div align="right">Od:</div>
            </td>
            <td>
                <select  name="prvi_dan">
                <option selected>D</option>
                  <option>01</option>
                  <option>02</option>
                  <option>03</option>
                  <option>04</option>
                  <option>05</option>
                  <option>06</option>
                  <option>07</option>
                  <option>08</option>
                  <option>09</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                  <option>13</option>
                  <option>14</option>
                  <option>15</option>
                  <option>16</option>
                  <option>17</option>
                  <option>18</option>
                  <option>19</option>
                  <option>20</option>
                  <option>21</option>
                  <option>22</option>
                  <option>23</option>
                  <option>24</option>
                  <option>25</option>
                  <option>26</option>
                  <option>27</option>
                  <option>28</option>
                  <option>29</option>
                  <option>30</option>
                  <option>31</option>
        </select>
            </td>
            <td class="xtramali">
                <select id="p_odM" name="prvi_mesec" class="text_box">
                    <option selected>M</option>
                     <option>01</option>
                          <option>02</option>
                          <option>03</option>
                          <option>04</option>
                          <option>05</option>
                          <option>06</option>
                          <option>07</option>
                          <option>08</option>
                          <option>09</option>
                          <option>10</option>
                          <option>11</option>
                          <option>12</option>
                </select>
            </td>
            <td>&nbsp;
            </td>
        </tr>
        <tr>
            <td colspan="2" class="xtramali">
                <div align="right">Do:</div>
            </td>
            <td>
                
                 <select  name="drugi_dan"   >
                <option selected>D</option>
                  <option>01</option>
                  <option>02</option>
                  <option>03</option>
                  <option>04</option>
                  <option>05</option>
                  <option>06</option>
                  <option>07</option>
                  <option>08</option>
                  <option>09</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                  <option>13</option>
                  <option>14</option>
                  <option>15</option>
                  <option>16</option>
                  <option>17</option>
                  <option>18</option>
                  <option>19</option>
                  <option>20</option>
                  <option>21</option>
                  <option>22</option>
                  <option>23</option>
                  <option>24</option>
                  <option>25</option>
                  <option>26</option>
                  <option>27</option>
                  <option>28</option>
                  <option>29</option>
                  <option>30</option>
                  <option>31</option>
        </select>
            </td>
            <td class="xtramali">
                <select id="p_doM" name="drugi_mesec" class="text_box">
                      <option selected>M</option>
                      <option>01</option>
                      <option>02</option>
                      <option>03</option>
                      <option>04</option>
                      <option>05</option>
                      <option>06</option>
                      <option>07</option>
                      <option>08</option>
                      <option>09</option>
                      <option>10</option>
                      <option>11</option>
                      <option>12</option>
                </select>
            </td>
            <td>
                <select id="p_godina" name="godina" class="text_box">
                    <option value="" selected>G</option>
                     <option>2013</option>          
                </select>
            </td>
        </tr>
        <tr><td colspan="5"><input style="width:260px" type="submit" name="submit" value="Prikaži" /></td></tr>
    </table>

    </form>
</div>
<?php
//**********************************************************************************


//DODAT KOD 

//***********************************************************************************

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
$query = ("SELECT * FROM kliping 
					WHERE  ".$upit."  
					ORDER BY `kliping`.`godina_unosa` DESC, `kliping`.`mesec_unosa` 
					DESC,`kliping`.`dan_unosa` DESC LIMIT $from, $max_results ;");
//echo $query;
$result = mysql_query($query);
if(!$result){
	die ("Došlo je do greške broj 2.</br>
		 <a href='index.php'>Povratak</a>");
	}
//ako nema rezlutata pretrage javljamo da slike jos nisu unete
if(mysql_num_rows($result)==0){
	$poruka = "<span style='color:red; font-size:12px'>Ne postoje rezlutati za zadatu pretragu!</span>";
	}
	else{
		$poruka = '';
	}
	
// Build your formatted results here.  
echo "<div style='float:right; width:670px; color:black; font-size:18px; '> Press Kliping </div>			          <br />";
echo $poruka;
echo "</table>";
// Figure out the total number of results,
$query2 =   "SELECT COUNT(*) as Num FROM kliping WHERE  ".$upit;
$total_results = mysql_result(mysql_query($query2),0); 
//echo $query2;
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
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev\">&#60;&#60;Prethodna</a> ";  
}  

for($i = 1; $i <= $total_pages; $i++){  
    if(($page) == $i){  
        echo "<strong>$i</strong> ";  
        } else {  
            echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i\">$i</a> ";  
    }  
}  

// Build Next Link  
if($page < $total_pages){  
    $next = ($page + 1);  
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next&\">Sledeća>></a>";  
}  
echo "</center>";
	 //******************************************************
		
	//prva petlja, lista događaje	

    //******************************************************	
	echo "<table width='670px'>
<tr><td>Datum</td><td style='text-align:left'><div style='width:80px'>Medij</div></td><td>Naslov klipinga</td><td>Naslov dogadjaja</td></tr>
<tr><td colspan =4><hr/></td></tr>";  
	while($row = mysql_fetch_array($result)){
	echo "
		
	
		<tr>
			  <td width='70px'>
			  ";
			  echo "<span style='font-size:10px;'>".($row['godina_unosa'].". ".$row['mesec_unosa'].". ".$row['dan_unosa']."</span> </td>
			  	<td width='100px' style='text-align:left; font-size:10px;'> <div style='width:80px'>".$row['medij']."</div></td>
			  	<td width='200px'>
					<a href='#' OnClick = 'otvori_kliping(".$row['id'].")'><u>".$row['naslov_klipinga']."</u></a></td>
			  	<td width='200px'> 
					<a href='".$row['id_dogadjaja']."'><u>".$row['naslov_dogadjaja']."</u></a></td>
				<td><input type='button' onclick='izmeni_kliping(".$row['id'].")' value='Izmeni kliping'/></td>
		</tr>
		<tr><td colspan =4><hr/></td></tr>
");
    }
	echo "</table>";
// Build Page Number Hyperlinks  
//**********************************************************

//Navigacija kroz stranice

//**********************************************************
// Build Page Number Hyperlinks  
if ($poruka == '') echo "<div style='float:right'><div style='float:left; width:670px; text-align:center; height:40px'>Izaberite stranu<br />";  

// Build Previous Link  
if($page > 1){  
    $prev = ($page - 1);  
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev\">&#60;&#60;Prethodna</a> ";  
}  

for($i = 1; $i <= $total_pages; $i++){  
    if(($page) == $i){  
        echo "<strong>$i</strong> ";  
        } else {  
            echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i\">$i</a> ";  
    }  
}  

// Build Next Link  
if($page < $total_pages){  
    $next = ($page + 1);  
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next\">Sledeća>></a>";  
}  
echo "</div></div>";



//**********************************************************************************


//DODAT KOD 

//***********************************************************************************

?>  
</div><!--main-->
<div id="footer">
    <!--footer-->
    <!--?php include_once("footer.php");?-->
</div>
  <!--footer-->
</div>
<!--container-->
</body>
</html>
