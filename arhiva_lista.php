<?php
//konekcija sa bazom
require_once("database_connect.php");
//citanje parametara
if(isset($_GET['godina'])){
   $godina = $_GET['godina'];
}

if(isset($_GET['program'])){
   $program = $_GET['program'];
}

?>
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
		
		$query = ("SELECT * FROM event WHERE(godina = $godina && program = $program) ORDER BY datum ASC");
		$result = mysql_query($query);
		if(($result == 'false'))
			{echo "Nema nijednog događaja za prikazivanje.";}
		else
			{
			while($row = mysql_fetch_array($result)){
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
				$dan = $row['dan'];
				$mesec = $row['mesec'];
    			if($dan < 10){$dan='0'.$dan;}
	    		if(strlen($mesec)==1){$mesec='0'.$mesec;}?>
    <div style="margin-top:10px;"> <!--class="content-item"--> 
    <?php if( is_null($row['s_opis'])){
			$outup_row = $dan.'.'. $mesec.'.'.$row['godina'].' | '.$program2.' | '.$row['imePrograma'];
			}
			else{$outup_row = $dan.'.'. $mesec.'.'.$row['godina'].' | '.$row['s_opis'];}
		?>
    
      <a  href='event/<?php echo ($row['id']);?>'> <?php echo $outup_row;?> </a>
      
      <div class="clear"></div>
    </div>
    <?php 
	
	}//kraj petlje koja lista dogadjaje<br />
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
