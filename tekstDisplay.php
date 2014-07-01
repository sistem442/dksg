<?php session_start(); 
//konekcija sa bazom
require_once("database_connect.php");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
//izbor baze
mysql_select_db("dksg_3120", $con);
$id = $_GET['id'];
$query = ("SELECT * FROM tekstovi WHERE (id = $id) AND dostupnost = 'da';");
				 //echo "$query<br />";
$result = mysql_query($query);
if(mysql_num_rows($result)==0){
	die ("Izabrana web stranica nije trenutno dostupna!");
	}
$row = mysql_fetch_array($result);	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Dom kulture Studentski grad</title>
<meta http-equiv="keywords" content=" dom ,kulture, studentski, grad">
<meta http-equiv="description" content="<?php echo $row['opis']?>">
<link rel="icon" href="http://www.dksg.rs/favicon.ico" type="image/ico" />
<link rel="shortcut icon" href="http://www.dksg.rs/favicon.ico" type="image/ico" />
<META name="abstract" content="<?php echo $row['naslov']?>">
<LINK href="http://www.dksg.rs/reset.css" rel="stylesheet" type="text/css">
<LINK href="http://www.dksg.rs/main.css" rel="stylesheet" type="text/css">
<SCRIPT src="http://www.dksg.rs/jquery-1.2.6.min.js" type="text/javascript" charset="utf-8"></SCRIPT>
<SCRIPT src="http://www.dksg.rs/ui_nav.js" type="text/javascript" charset="utf-8"></SCRIPT>
<STYLE id="tmpStyle" type="text/css" disabled="">
#pic {
	-moz-opacity: 0.00;
	filter: alpha(opacity=0);
	opacity: 0;
	-khtml-opacity: 0;
}
</STYLE>
<script src="http://www.dksg.rs/Scripts/swfobject_modified.js" type="text/javascript"></script>
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
    <?php include_once("menu.php"); ?>
  </div>
  <DIV id="mainBig">
    <?php


//**************************************************************************blok koji prikazuje sliku i sliku uz tekst
    echo "
     	<table width='100%'>
        	<tr>
			  <td>";
			  if($row['slika']!= '0'){
				  echo"<a href='http://www.dksg.rs/".$row['slika']."'><img style='float:right; padding:5px;' src='http://www.dksg.rs/".$row['slika']."' width='150px'></a>";}
				  echo $row['tekst']."<br/>
				  <br/>
			  </td>
			</tr>
		</table>";
//kraj bloka za tekkst
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
