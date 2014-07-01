<?php
//konekcija sa bazom
require_once("database_connect.php");
//izbor baze
mysql_select_db("dksg_3120", $con);
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<html xmlns:fb="http://ogp.me/ns/fb#">
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Dom kulture Studentski grad</title>
<meta http-equiv="keywords" content="  dom ,kulture, studentski, grad, velika, sala, mala, studio, radionica, skola, ">
<meta http-equiv="description" content="Dom kulture Studentski grad (DKSG) svojim sadržajem pokriva sve oblasti umetnosti, a većina programa je besplatna.">
<link rel="shortcut icon" href="http://dksg.rs/favicon.ico" type="image/x-icon" />
<link rel="icon" href="http://dksg.rs/favicon.ico" type="image/ico" />
<META name="abstract" content="Dom kulture Studentski grad">
<LINK href="http://dksg.rs/reset.css" rel="stylesheet" type="text/css">
<LINK href="http://dksg.rs/main.css" rel="stylesheet" type="text/css">
<SCRIPT src="http://dksg.rs/jquery-1.2.6.min.js" type="text/javascript" charset="utf-8"></SCRIPT>
<SCRIPT src="http://dksg.rs/ui_nav.js" type="text/javascript" charset="utf-8"></SCRIPT>
<STYLE id="tmpStyle" type="text/css" disabled="">
#pic {
	-moz-opacity: 0.00;
	filter: alpha(opacity=0);
	opacity: 0;
	-khtml-opacity: 0;
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
function showEvent(str)
{	
    window.location = "oneEventDisplay.php?id="+str;
}  
function showNews(str)
{	
    window.location = "displayNews.php?id="+str;
} 
</script>
</head>
<SCRIPT src="http://dksg.rs/ga.js" type="text/javascript"></SCRIPT>
<!-- Place this tag after the last +1 button tag. -->
<BODY>
<DIV id="content">
  <DIV id="header">
    <?php include_once("heder.php") ?>
  </DIV>
  <div id="menu"> 
    <!--poziva stranicu menu.php i prosleđuje parametre za prikazivanje odgovarajućeg kalendara-->
    <?php include("menu.php"); ?>
  </div>
  <DIV id="image">
    <?php include_once("slider.php"); ?>
    <!--<img src="images/osnovne/novagod.jpg" width="670" height="296" /> <br />--> 
    <br/>
  </DIV>
  <div id="vesti"> 
    <?php
        $query = ("SELECT * FROM vesti ORDER BY `vesti`.`g1` DESC, `vesti`.`m1` DESC,`vesti`.`d1` DESC LIMIT 0,7 ;"); 
		$result = mysql_query($query);
		if($result == 'false'){echo "<table width='180px'><tr><td></td></tr></table>";}
			else{
		echo "<table width=175px>";
		while($row = mysql_fetch_array($result)){
			echo "<tr>
			<td>
			";
			echo ("<a href='javascript:showNews(".$row['idTabele'].")'><strong>".
					$row['naslovVesti']."<strong></a><hr />
			</td>
			</tr>
			");
    	}
	echo "</table>";
	}?>
  </div>
  <DIV id="main">
    <?php 
		if(strlen($dan)==1){$dan='0'.$dan;}
	    if(strlen($mesec)==1){$mesec='0'.$mesec;}
		$datum = $godina.$mesec.$dan;
		$query = ("SELECT * FROM event 
		WHERE(dan = $dan && mesec = $mesec && godina = $godina) 
		OR (id IN (SELECT id FROM opseg WHERE ($datum BETWEEN prviDatum AND drugiDatum) AND periodicni = 'ne')) 
		OR ((id IN (SELECT id FROM periodicni WHERE ($danNedelje = 1)) 
		AND id IN (SELECT id FROM opseg WHERE ($datum BETWEEN prviDatum AND drugiDatum)))) 
		ORDER BY `event`.`prioritet` ASC;");
		$result = mysql_query($query);
		if(($result == 'false'))
			{echo "Nema nijednog događaja za prikazivanje.";}
		else
			{
			while($row = mysql_fetch_array($result)){
	?>
    <div class="content-item">
      <div class='content-item-photo'> 
      	<a href='<?php if($row['slika']!= '0'){ echo $row['slika'];} else echo "#"?>'> 
        	<img  src='<?php if($row['slika']!= '0'){echo $row['slika'];} else echo "images/osnovne/belo.png"?>'> </a> 
      </div>
      <div class="content-item-content"> 
	  	<?php echo ($row['skrTekst']);?>
        <div> <a  href='oneEventDisplay.php?id=<?php echo ($row['id']);?>'>opširnije...</a> </div>
      </div>
      <div class="clear"></div>
    </div>
    <?php }//kraj petlje koja lista dogadjaje?>
    <?php }//kraj uslova ako ima dogadjaja?>
    <p></p>
    <!--main--> 
  </DIV>
  <div id="footer"> 
    <!--footer-->
    <?php include_once("footer.php");?>
</div>
<!--footer-->
</DIV>
<!--container-->
</body>
</html>
