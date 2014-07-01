<?php include 'include/class_select_year.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>Arhiva vesti</TITLE>
<link rel="shortcut icon" href="http://dksg.rs/favicon.ico" type="image/x-icon" />
<link rel="icon" href="http://dksg.rs/favicon.ico" type="image/ico" />
<META name="keywords" content="afc,dom kulture, studentski grad, predstava, pozoriste, film, galerija, forum, knjizevnost, koncert, muzika, beograd">
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
  <DIV id="main">
	<form  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="myform">
		<table width="400" border="0" cellpadding="10">
        <tr>
            <td>Naslov</td>
            <td><input type="text" name="naslov"/></td>
        </tr>
        <tr>
            <td>Tekst</td>
            <td><input type="text" name="tekst"/></td>
        </tr>
        <tr>
        <td width="200" align="left">Dan </td>
        <td align="left"><select name="d1" id="d1">
			<option selected="selected"></option>
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
          </select></td>
      </tr>
      <tr>
        <td width="200" align="left">Mesec </td>
        <td align="left"><select name="m1" id="m1">
			<option selected="selected"></option>
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
            <option>12</option></select></td>
      </tr>
      <tr>
        <td width="200" align="left">Godina </td>
        <td align="left"><select id="g1" name="g1">
			<option selected="selected"></option>
			<?php 
                $year = new select_year;
                echo $year->get_select_year_from(2012);
            ?>
        </select></td>
      </tr>
      <tr>
        <td width="200" align="left">Program</td>
        <td align="left">
          <select name="program" id="program" style="width:180px">
            <option value="likovni">likovni</option>
            <option value="filmski">filmski</option>
            <option value="muzicki">muzicki</option>
            <option value="pozorisni">pozorišni</option>
            <option value="forum">forum</option>
            <option value="knjizevni">književni</option>
            <option value="afc">afc</option>
            <option value="biblioteka">biblioteka</option>
            <option value="ostali">ostali</option>
            <option selected="selected" value="Izaberite program">Izaberite program</option>
          </select></td>
      </tr>
        <tr>
            <td colspan="2" style="padding:10px">
				<input style="width:350px; height:30px;" name="submit" type="submit" value="Tra&#382;i"   />
			</td>
        </tr>
        </table>
</form>
<br />
<br />
<a href="arhiva_vesti_sve.php"> Pogledajte sve vesti</a>
<?php
require_once("database_connect.php");
if(isset($_POST['submit'])){
	$naslov = $_POST["naslov"];
	$d1 = $_POST["d1"];
	$m1 = $_POST["m1"];
	$g1 = $_POST["g1"];
	$program = $_POST["program"];
	$tekst= $_POST["tekst"];
	$query = array('','','','','','');
	if($naslov !='') $query_array[0] = 'naslovVesti LIKE "%'.$naslov.'%" AND ';
	else $query_array[0] = '';
	if($tekst !='') $query_array[1] = 'tekst LIKE "%'.$tekst.'%" AND ';
	else $query_array[1] = '';	
	if($program != 'Izaberite program') $query_array[2] = 'program = "'.$program.'" AND '; 
	else $query_array[2] = '';
	if($d1 !='') $query_array[3] = 'd1 = '.$d1.' AND ';
	else $query_array[3] = '';
	if($m1 !='') $query_array[4] = 'm1 = '.$m1.' AND ';
	else $query_array[4] = '';
	if($g1 !='') $query_array[5] = 'g1 = '.$g1.' AND ';
	else $query_array[5] = '';
	$query_substring = '';
	for($i=0;$i<6;$i++)
	{
		$query_substring .= $query_array[$i]; 
	}
	$query_substring = substr($query_substring, 0, -4);
	$query = ("SELECT * 
				FROM vesti
				WHERE ".$query_substring." 
				ORDER BY `vesti`.`g1` DESC, `vesti`.`m1` DESC,`vesti`.`d1` DESC ;");
	//echo $query;
	$result = $mysqli->query($query);
	if (!$mysqli->query($query)) 
	{
    	printf("Errormessage: %s\n", $mysqli->error);
	}
	//else echo 'query is OK';
	
	echo "<table width='425px'>";
	while ($obj=mysqli_fetch_object($result)){
			echo "<tr><td>";
			    echo ($obj->g1.". ".$obj->m1.". ".$obj->d1." <br />
				".$obj->naslovVesti."
				<a href='displayNews.php?id=(".$obj->idTabele.")'>opširnije...</a> <br />
				<hr />
				</td>
			</tr>
			");	
	}
}
?>
    <p><!--main--> 
      
    </p>
</DIV><div id="footer">
    <!--footer-->
    <!--?php include_once("footer.php");?-->
</div>
  <!--footer-->
</DIV>
<!--container-->
</body>
</html>
