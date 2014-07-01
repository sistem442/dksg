<?php
//konekcija sa bazom
require_once("database_connect.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
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
<script type="text/javascript">

$(document).ready(function(){

  $('div.dropdown').each(function() {
    var $dropdown = $(this);

    $("a.dropdown-link", $dropdown).click(function(e) {
      e.preventDefault();
      $div = $("div.dropdown-container", $dropdown);
      $div.toggle();
      $("div.dropdown-container").not($div).hide();
      return false;
    });

});
    
  $('html').click(function(){
    $("div.dropdown-container").hide();
  });
     
});

</script> 
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
</HEAD>
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
  <DIV id="mainBig">
  <?php 
  	$z = 1;
  	$godina22 = date('Y');
  	$meseci = array("Januar","Februar","Mart","April","Maj",
  				"Jun","Jul","Avgust","Septembar","Oktobar","Novembar","Decembar");
  	$redakcije = array("Forum","Pozorište","Književnost","Likovni program","Muzika","Film","AFC","Biblioteka");
	$kreator = array("milos","lada","Tamara","maida","milan.d","igor","milan","nevena");
	echo '<div class="arrowlistmenu">';
			for($i=date("n");$i>=1;$i--){
				$z++;
				$query = ("SELECT id FROM event WHERE mesecUnosa =".$i."  AND event.godinaUnosa = ".$godina22);
				//echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
				$result = mysql_query($query);
				$brojrezultata = mysql_num_rows($result);?>
                
				<h3 class="menuheader expandable"><?php echo $meseci[$i-1]." (".$brojrezultata.")";?></h3>
                	<ul class="categoryitems">
  				<?php
				
				
				for($j=0;$j<8;$j++){					
					$query = ("SELECT event.id,event.s_opis, event.dan,event.mesec,event.godina,event.imePrograma, event.program FROM event INNER JOIN korisnici ON korisnici.username = event.kreator WHERE mesecUnosa =".$i." AND kreator = '".$kreator[$j]."' AND event.godinaUnosa = ".$godina22." ORDER BY event.id DESC");
					//echo $query;
					//echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
					$result = mysql_query($query);
					$brojrezultata = mysql_num_rows($result);
					echo "<li><a href='#' class='subexpandable'>".$redakcije[$j]." (".$brojrezultata.")</a>
							<ul class='subcategoryitems' style='margin-left: 15px'> ";
						while($row = mysql_fetch_array($result)){
							if( is_null($row['s_opis'])){
								$program = $row['program'];
								  switch($program)
								  {
									  case 'likovni':
									  $program2 = 'Likovni program';
									  break;
									  case 'filmski':
									  $program2 = 'Filmski program';
									  break;
									  case 'pozorisni':
									  $program2 = 'Pozorišni program';
									  break;
									  case 'muzicki':
									  $program2 = 'Muzički program';
									  break;
									  case 'biblioteka':
									  $program2 = 'Biblioteka';
									  break;
									  case 'afc':
									  $program2 = 'Akademski filmski centar';
									  break;
									  case 'forum':
									  $program2 = 'Forum';
									  break;
									  case 'ostali':
									  $program2 = 'Ostali programi';
									  break;
									  case 'radionica':
									  $program2 = 'Radionica';
									  break;
									  case 'obavestenje':
									  $program2 = 'Obaveštenje';
									  break;
									  case 'knjizevni':
									  $program2 = 'Književni program';
									  break;
									  case 'politicki':
									  $program2 = 'Društveno politički program';
									  break;
									  case 'naucni':
									  $program2 = 'Naučno obrazovni program';
									  break;
									  case 'kontakt':
									  $program2 = 'Kontakt program';
									  break;
									  default:
									   echo' ';  				 
								  	}
									$outup_row = $dan.'.'. $mesec.'.'.$row['godina'].' | '.$program2.' | '.$row['imePrograma'];
									}
									else{
										$outup_row = $dan.'.'. $mesec.'.'.$row['godina'].' | '.$row['s_opis'];
										}
									$dan = $row['dan'];
									$mesec = $row['mesec'];
									if($dan < 10){$dan='0'.$dan;}
									if(strlen($mesec)==1){$mesec='0'.$mesec;}?>
									<li><a  href='oneEventDisplay.php?id=<?php echo ($row['id']);?>'><?php echo $outup_row;?> </a></li>
                     <?php 
					 }echo '</ul>
					 </li>
					 '; //kraj petlje koja koja lista dogadjaje koje su uneli urednici
				}//kraj petlje koja lista redakcije
					
				$query2 = ("SELECT event.id,event.s_opis, event.dan,event.mesec,event.godina,event.imePrograma, event.program FROM event INNER JOIN korisnici ON korisnici.username = event.kreator WHERE mesecUnosa =".$i." AND (kreator = 'ivana' OR kreator = 'ivan' OR kreator = 'obrad' OR kreator = 'boris') AND event.godinaUnosa = ".$godina22." ORDER BY event.id DESC");
				//echo $query2;
				//echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
				$result2 = mysql_query($query2);
				$brojrezultata2 = mysql_num_rows($result2);
				echo "<li><a href='#' class='subexpandable'>Arhiv (".$brojrezultata2.")</a>
						<ul class='subcategoryitems' style='margin-left: 15px'> ";
					while($row = mysql_fetch_array($result2)){
						$program = $row['program'];
			  switch($program)
			  {
				  case 'likovni':
				  $program2 = 'Likovni program';
				  break;
				  case 'filmski':
				  $program2 = 'Filmski program';
				  break;
				  case 'pozorisni':
				  $program2 = 'Pozorišni program';
				  break;
				  case 'muzicki':
				  $program2 = 'Muzički program';
				  break;
				  case 'biblioteka':
				  $program2 = 'Biblioteka';
				  break;
				  case 'afc':
				  $program2 = 'Akademski filmski centar';
				  break;
				  case 'forum':
				  $program2 = 'Forum';
				  break;
				  case 'ostali':
				  $program2 = 'Ostali programi';
				  break;
				  case 'radionica':
				  $program2 = 'Radionica';
				  break;
				  case 'obavestenje':
				  $program2 = 'Obaveštenje';
				  break;
				  case 'knjizevni':
				  $program2 = 'Književni program';
				  break;
				  case 'politicki':
				  $program2 = 'Društveno politički program';
				  break;
				  case 'naucni':
				  $program2 = 'Naučno obrazovni program';
				  break;
				  case 'kontakt':
				  $program2 = 'Kontakt program';
				  break;
				  default:
				   echo' ';  				 
			  }
						if( is_null($row['s_opis'])){
							$outup_row = $dan.'.'. $mesec.'.'.$row['godina'].' | '.$program2.' | '.$row['imePrograma'];
							}
							else{
								$outup_row = $dan.'.'. $mesec.'.'.$row['godina'].' | '.$row['s_opis'];
								}
						$dan = $row['dan'];
						$mesec = $row['mesec'];
						if($dan < 10){$dan='0'.$dan;}
						if(strlen($mesec)==1){$mesec='0'.$mesec;}?>
						<li><a  href='oneEventDisplay.php?id=<?php echo ($row['id']);?>'><?php echo $outup_row;?> </a></li>
			<?php	}echo '</ul>
					 </li>
					 </ul>
					 ';//kraj petlje koja koja lista dogadjaje koja je unela arhiva				
			}//kraj petlje koja lista mesece?>
            </div>
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