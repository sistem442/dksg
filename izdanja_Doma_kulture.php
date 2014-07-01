<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>Izdanja Dom kulture Studentski grad</TITLE>
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
function showEvent(str)
{	
    window.location = "oneEventDisplay.php?id="+str;
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
  <div id="vesti"> </div>
  <DIV id="main">
  <p><strong>SOPSTVENA PRODUKCIJA</strong></p>
  <p>Dom kulture Studentski grad, u okvirima različitih  programskih oblika, neguje sopstvenu produkciju: izdavaštvo - knjige, zbornici,  brošure…, pozorišne predstave, muzička dela, likovna dela, filmski i video  projekti, istraživački projekti. U okviru produkcije DKSG izdaju <br />
    se mesečni vodiči, katalozi za izložbe, programi za  pozorišne predstave i koncerte, plakati, informatori, filmovi i DVD-jevi.</p>
    <br />
<br />
<br />

    <?php 
	//konekcija sa bazom
require_once("database_connect.php");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
	//-----------------------------------------
	//
	//Prikazivanje izdanja u glavnom delu
	//
	//------------------------------------------
$query = ("SELECT * FROM event WHERE nadnaslov = 'Izdanja Doma Kulture' ORDER BY godina DESC, mesec DESC, dan DESC;;");
//echo $query;
$result = mysql_query($query);
if($result == 'false'){echo "";}
else{
	while($row = mysql_fetch_array($result)){
		?>
    <div class="content-item">
      <div class='content-item-photo'> 
      	<a href='<?php if($row['slika']!= '0'){ echo 'http://www.dksg.rs/'.$row['slika'];} else echo "#"?>'> 
        	<img  src='<?php if($row['slika']!= '0'){echo 'http://www.dksg.rs/'.$row['slika'];} else echo "http://www.dksg.rs/images/osnovne/belo.png"?>'> </a> 
      </div>
      <div class="content-item-content"> 
	  	<?php
		//ako je stariji dogadja prikazi samo skrTekst ako je noviji prikazi sva polja 
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
        <div class="opsirnije"><a href='http://www.dksg.rs/oneEventDisplay.php?id=<?php echo ($row['id']);?>'>opširnije...</a></div>
      </div>
      <div class="clear"></div>
    </div>
    <?php
	}//kraj petlje koja lista dogadjaje
 }//kraj uslova ako ima dogadjaja?>
    <p></p>
  </DIV>
  <div id="footer"> 
    <!--footer-->
    <!--?php include_once("footer.php");?-->
</div>
<!--footer-->
</DIV>
<!--container-->
</body>
</html>
