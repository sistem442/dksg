 <?php 
	//konekcija sa bazom
require_once("database_connect.php");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
//izbor baze
mysql_select_db("dksg_3120", $con);
//Ako listas kontrolni program primas parametre, ako nije kontrolni listas program za trenutni mesec
if(isset($_POST['program'])){
    $program = $_POST['program'];
}
else $program = $_GET['program']; 

if(isset($_POST['mesec'])){
    $mesec = $_POST['mesec'];
}
else $mesec = date("m");
	$dan = date("d");
if(isset($_POST['godina'])){
    $godina = $_POST['godina'];
}
else $godina = date("Y");
	$datum2 = $godina.$mesec.$dan;
    $query = ("SELECT * FROM event WHERE (program = '$program' AND mesec = $mesec AND godina = $godina) ORDER BY mesec ASC, dan ASC; ");
//echo $query;
$result = mysql_query($query);
/* ako je program muzicki na vrhu prikazi youtube video
if($program == 'muzicki') echo '<iframe width="420" height="315" src="http://www.youtube.com/embed/40OZgPWyN8c?rel=0" frameborder="0" allowfullscreen></iframe><br />
<br />
';*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Dom kulture Studentski grad - <?php echo $program;?></title>
<link rel="shortcut icon" href="http://dksg.rs/favicon.ico" type="image/x-icon" />
<link rel="icon" href="http://dksg.rs/favicon.ico" type="image/ico" />
<meta name="keywords" content="afc, dom kulture, studentski grad, predstava, pozoriste, film, galerija, forum, knjizevnost, koncert, muzika, beograd">
<meta name="description" content="dom kulture u studentskom gradu u beogradu">
<meta name="abstract" content="dom kulture u studentskom gradu u beogradu">
<link href="http://dksg.rs/reset.css" rel="stylesheet" type="text/css">
<LINK href="http://dksg.rs/main.css" rel="stylesheet" type="text/css">
<script src="http://dksg.rs/jquery-1.2.6.min.js" type="text/javascript" charset="utf-8"></script>
<script src="http://dksg.rs/ui_nav.js" type="text/javascript" charset="utf-8"></script>
<script src="ga.js" type="text/javascript"></script>
<style id="tmpStyle" type="text/css" disabled="">
#pic {
	-moz-opacity: 0.00;
	filter: alpha(opacity=0);
	opacity: 0;
	-khtml-opacity: 0;
}
</STYLE>
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
    window.location = "http://dksg.rs/oneEventDisplay.php?id="+str;
} 
</script>
</head>
<body>
<div id="content">
  <div id="header">
    <?php include_once("heder.php") ?>
  </div>
  <div id="menu">
    <?php include_once("menu.php"); 
	    $event_time = new time_of_event();
		$remark = new remark();?>
  </div>
  <div id="vesti"> </div>
  <div id="mainBig">
   <?php

while($row = mysql_fetch_array($result)){?>
    <div class="content-item-640">
      <div class='content-item-photo'> <a href='<?php if($row['slika']!= '0'){ echo 'http://www.dksg.rs/'.$row['slika'];} else echo "#"?>'> <img  src='<?php if($row['slika']!= '0'){
		                       echo 'http://dksg.rs/'.$row['slika'];
		   					} 
		                    else 
		                       echo "http://dksg.rs/images/osnovne/belo.png"?>'> </a> </div>
      <div class="content-item-content-430"> 
	  <?php //ako je stariji dogadja prikazi samo skrTekst ako je noviji prikazi sva polja 
		if($row['id']<2249){
			$output = $row['skrTekst'];
		}
		else{
			if($row['izmena'] == '')$izmena = '';
				else $izmena = '<span style="color:red">'.$row['izmena'].'</span></br>';
			if($row['nadnaslov'] == '') $nadnaslov = '';else $nadnaslov = $row['nadnaslov'].'</br>';
			if($row['podnaslov'] == '')$podnaslov = '';else $podnaslov = $row['podnaslov'].'</br>';
 			$output = $izmena.$nadnaslov.'<strong>'.$row['imePrograma'].'</strong></br>'.
				$podnaslov.'<strong>'.$row['vreme_mesto'].'</strong></br></br>'.$row['skrTekst'].'...';
		}//kraj izbora prikazivanja na osnovu id broja
		echo $output;?>
        <div> <a  href='http://dksg.rs/event/<?php echo ($row['id']);?>'>opširnije...</a> </div>
      </div>
      <div class="clear"></div>
    </div>
    <?php }?>
  </div>
  <div id="footer"> 
    <!--footer-->
    <?php //include_once("footer.php");?>
</div>
<!--footer-->
</div>
<!--container-->
</body>
</html>
