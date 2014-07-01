<?php
//konekcija sa bazom
require_once("database_connect.php");
//citanje parametara
if(isset($_GET['dan'])){
   $dan = $_GET['dan'];
}
else 
   $dan = date('j');
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
if(isset($_GET["danNedelje"])){
$danNedelje = $_GET["danNedelje"];
}
else 
   $danNedelje = date('N');
   $array = array('pon','uto','sre','cet','pet','sub','ned');
   $danNedelje2 = $array[$danNedelje - 1];
   //echo $danNedelje2;
    //if ((($dan >3 and $mesec == 7)|| $mesec == 8) and $godina == 2013)header("Location: http://dksg.rs/letnja-pauza");//preusmerava na letnja_pauza.php
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<html xmlns:fb="http://ogp.me/ns/fb#">
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Dom kulture Studentski grad</title>
<meta http-equiv="keywords" content="  dom ,kulture, studentski, grad, velika, sala, mala, studio, radionica, skola, ">
<meta http-equiv="description" content="Dom kulture Studentski grad (DKSG) svojim sadržajem pokriva sve oblasti umetnosti, a većina programa je besplatna.">
<link rel="shortcut icon" href="http://www.dksg.rs/favicon.ico" type="image/x-icon" />
<META name="abstract" content="Dom kulture Studentski grad">
<LINK href="http://www.dksg.rs/reset.css" rel="stylesheet" type="text/css">
<LINK href="http://www.dksg.rs/main.css" rel="stylesheet" type="text/css">
<SCRIPT src="http://www.dksg.rs/jquery-1.2.6.min.js" type="text/javascript" charset="utf-8"></SCRIPT>
<SCRIPT src="http://www.dksg.rs/ui_nav.js" type="text/javascript" charset="utf-8"></SCRIPT>
<SCRIPT src="http://www.dksg.rs/ga.js" type="text/javascript"></SCRIPT>
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
    window.location = "http://www.dksg.rs/oneEventDisplay.php?id="+str;
}  
function showNews(str)
{	
    window.location = "http://www.dksg.rs/displayNews.php?id="+str;
} 
</script>
</HEAD>

<BODY>
<DIV id="content">
  <DIV id="header">
    <?php include_once("heder.php");?>
  </DIV>
  <div id="menu">
    <?php include("menu.php"); ?>
  </div>
  <DIV id="mainBig">
    <div style="padding:50px; font-size:24px; margin:0 auto; text-align:center">Prijatelji Doma kulture Studentski grad</div>
    <div style="display:table; width:670px">
      <div style="display:table-row; width:185px; padding-bottom:5px; height:120px;">
        <div style="display:table-cell; vertical-align:middle; height:120px ;"> <a href="http://www.seecult.org/" target="popup" 
            onClick="wopen('http://www.seecult.org/', 'popup', 300, 200); return false;"> <img src="images/sponsors/seecul120.gif"   /></a> </div>
        <div style="display:table-cell; vertical-align:middle; height:120px "> <a href="http://www.belgradian.com/sr/" target="popup" 
            onClick="wopen('http://www.belgradian.com/sr/', 'popup', 300, 200); return false;"> <img src="http://www.dksg.rs/images/sponsors/belgradianEn.jpg"   /></a> </div>
        <div style="display:table-cell; vertical-align:middle; height:120px "> <a href="http://www.betonradio.rs/" target="popup" 
            onClick="wopen('http://www.betonradio.rs/‎', 'popup', 300, 200); return false;"> <img src="http://www.dksg.rs/images/sponsors/bton.jpg"  /></a> </div>
      </div>
      <div style="height:5px"></div>
      <div style="display:table-row; width:185px; padding-bottom:5px; height:120px;">
        <div style="display:table-cell; vertical-align:middle; height:120px ;"> <a href="http://www.naxi.rs/" target="popup" 
            onClick="wopen('http://www.naxi.rs/', 'popup', 300, 200); return false;"> <img src="http://dksg.rs/images/sponsors/naxi.jpg"   /></a> </div>
        <div style="display:table-cell; vertical-align:middle; height:120px "> <a href="http://www.puskice.org/" target="popup" 
            onClick="wopen('http://www.puskice.org/', 'popup', 300, 200); return false;"> <img src="http://www.dksg.rs/images/sponsors/puskice.jpg"   /></a> </div>
        <div style="display:table-cell; vertical-align:middle; height:120px "> <a href="http://izlazak.com/" target="popup" 
            onClick="wopen('http://izlazak.com/', 'popup', 300, 200); return false;"> <img src="http://www.dksg.rs/images/sponsors/izlazak120.gif"  /></a> </div>
      </div>
    </div>
    <div style="height:5px"></div>
    <div style="display:table-row; width:185px; padding-bottom:5px; height:120px;">
      <div style="display:table-cell; vertical-align:middle; width:220px "> 
      <a href="http://www.filmovanje.com/" target="popup" 
            onClick="wopen('http://www.filmovanje.com/', 'popup', 300, 200); return false;"> 
            <img src="http://www.dksg.rs/images/sponsors/Filmovanje.jpg" width="150px"  /></a> </div>
      <div style="display:table-cell; vertical-align:middle; width:200px ">
      <a href="http://www.filmske-radosti.com/" target="popup" 
            onClick="wopen('http://www.filmske-radosti.com/', 'popup', 300, 200); return false;"> 
            <img src="images/sponsors/filmske-radosti.jpg"  /></a> </div>
    </div>
  </div>
  <!--main--> 
</DIV>
<div id="footer"> 
  <!--footer-->
  <?php //include_once("footer.php");?>
</div>
<!--footer-->
</DIV>
<!--container-->
</body>
</html>
