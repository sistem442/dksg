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
    <?php include_once("heder.php") ?>
</DIV>
  <div id="menu"> 
    <?php include("menu.php"); ?>
  </div>
  <DIV id="image">
    <?php include_once("slider.php"); ?>
    <br/>
  </DIV>
  <div id="vesti"> 
    <?php
        $query = ("SELECT idTabele,naslovVesti,slika,skrTekst FROM vesti 
				   ORDER BY `vesti`.`g1` DESC, `vesti`.`m1` DESC,`vesti`.`d1` DESC LIMIT 0,7 ;"); 
		$result = mysql_query($query);
		if($result == 'false'){echo "<table width='180px'><tr><td></td></tr></table>";}
			else{
				while($row = mysql_fetch_array($result)){
						echo"<div style='background-color: #fff;border-bottom:3px solid #cbcac6; width:175px; margin-bottom:10px; padding-bottom:10px;'>";
						/*if($row['slika']!= '0')
							{echo "<img width=180px;  src='http://www.dksg.rs/".$row['slika']."'/><br/><br/>";}*/
						echo "<strong><a style='color:#000; text-transform:uppercase;' href='javascript:showNews(".$row['idTabele'].")'>".$row['naslovVesti']."</strong></a>";
							/*if($row['skrTekst'] != 'NULL')
								{echo "<br /><br/>".$row['skrTekst']."...";
							}*/
							echo "</div>";
    			}
			}?>
  </div>
  <DIV id="main">
    <?php 
		if(strlen($dan)==1){$dan='0'.$dan;}
	    if(strlen($mesec)==1){$mesec='0'.$mesec;}
		$datum = $godina.$mesec.$dan;
			if(($datum == 20131201) || (($datum > 20140101) && ($datum <20140107)))
				echo "Dom kulture Studentski grad neće raditi za vreme Nove godine i Božićnih praznika od 31. 12. 2013. do 07. 01. 2014. godine.";
			else{  			
				$query = ("SELECT * FROM event 
				WHERE(dan = $dan && mesec = $mesec && godina = $godina) 
				OR (id IN (SELECT id FROM opseg WHERE ($datum BETWEEN prviDatum AND drugiDatum) AND periodicni = 'ne')) 
				OR ((id IN (SELECT id FROM periodicni WHERE ($danNedelje2 = 1)) 
				AND id IN (SELECT id FROM opseg WHERE ($datum BETWEEN prviDatum AND drugiDatum)))) 
				ORDER BY `event`.`prioritet` ASC;");
				//echo $query;
				$result = mysql_query($query);
				if((mysql_num_rows($result) == 0))
					{echo "Nema nijednog događaja za prikazivanje.";}
				else
					{
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
        <div class="opsirnije"><a href='http://www.dksg.rs/event/<?php echo ($row['id']);?>'>opširnije...</a></div>
      </div>
      <div class="clear"></div>
    </div>
    <?php
					}//kraj uslova za novu godinu
	}//kraj petlje koja lista dogadjaje
 }//kraj uslova ako ima dogadjaja?>
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
