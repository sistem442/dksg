<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>AFC arhiva vesti</TITLE>
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
function showEventVesti(str)
{	
    window.location = "http://dksg.rs/displayNews.php?id="+str;
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
  
  
  <DIV id="main">
    <?php 
	//konekcija sa bazom
require_once("database_connect.php");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
//izbor baze
mysql_select_db("dksg_3120", $con);
	$mesec = date("n");
	$query = ("SELECT * FROM vesti WHERE program = 'afc'  ORDER BY `vesti`.`g1` DESC, `vesti`.`m1` DESC,`vesti`.`d1` DESC ;");
    $result = mysql_query($query);
echo "<table width='425px'>";
while($row = mysql_fetch_array($result)){
	echo "<tr>
			  <td>
			  ";
			  
			  echo ($row['naslovVesti']."
<a href='javascript:showEventVesti(".$row['idTabele'].")'>opširnije...</a> <br />
<hr />
</td>
</tr>
");
    }
	echo "</table>";
?>
</DIV><div id="footer">
    <!--footer-->
    <!--?php include_once("footer.php");?-->
</div>
  <!--footer-->
</DIV>
<!--container-->
</body>
</html>
