<?php session_start(); 
$id = $_GET['id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Dom kulture Studentski grad</title>
<meta http-equiv="keywords" content=" dom ,kulture, studentski, grad">
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
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>

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
  
  <div id="vesti">
    
  </div>
  <DIV id="mainBIG">
    <?php

//konekcija sa bazom
require_once("database_connect.php");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
//izbor baze
mysql_select_db("dksg_3120", $con);
//********************************************************************************blok koji prikazuje  tekst i sliku uz tekst
$query = ("SELECT * FROM vesti WHERE (idTabele = $id);");
				 //echo "$query<br />";
$result = mysql_query($query);
if(!$result){
	die ("Došlo do greške pokušajte kasnije");
	}
while($row = mysql_fetch_array($result)){
    echo "
     	<table width='640px'>
        	<tr>
			  <td>";
			  if($row['slika']!= '0'){
				  echo"<a href='".$row['slika']."'><img style='float:right; padding:5px;' src='".$row['slika']."' width='150px'></a>";}
				  echo $row['tekst']."
			  
			  </td>
			</tr>
		</table>";
    }
//kraj bloka za tekkst
/*
//*****************************************************************blok koji prikazuje sve fajlove vezane za dogadjaj
$query = ("SELECT * FROM fajlovi WHERE (id = $id);");
$result = mysql_query($query);
if(!$result){
	die ("Došlo do greške pokušajte kasnije");
	}
while($row = mysql_fetch_array($result)){
    echo "
     	<table width='640px'>
        	<tr>
			  <td>";
			  if($row['id']!= '0'){//ako ima fajlova
				  /*ako je fajl slika*
				  switch($row['klasaFajla']){
					  case('slika'):echo"<a href='".$row['path']."'>
					                     <img style='float:right; padding:5px;' src='".$row['path']."' width='150px'><br />
                                         ".$row['komentar']."</a>";
					  break;		 
					  case('ostali'):echo"<a href='".$row['path']."'>
					                     ".$row['ime']."<br />
                                         ".$row['komentar']."</a>";
					  break;
					  case('zvuk'):echo'
					  <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
    width="40"
    height="40"
    id="audio1"
    align="middle">
    <embed src="../files/wavplayer.swf?gui=mini&h=20&w=300&sound=success.wav&"
        bgcolor="#ffffff"
        width="40"
        height="40"
        allowScriptAccess="always"
        type="application/x-shockwave-flash"
        pluginspage="http://www.macromedia.com/go/getflashplayer"
    />
</object>';
					                
					  }
				 }
				  echo"
			  
			  </td>
			</tr>
		</table>";
    }
*/
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
