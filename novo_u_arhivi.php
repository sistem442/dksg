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
		$meseci = array("Januar","Februar","Mart","April","Maj","Jun","Jul","Avgust","Septembar","Oktobar","Novembar","Decembar");
			for($i=date("m");$i>=1;$i--){
			$query = ("SELECT * FROM event WHERE godina < 2013 AND godinaUnosa = 2013 AND mesecUnosa =".$i." ORDER BY id DESC");
			$result = mysql_query($query);
			$brojrezultata = mysql_num_rows($result);
			echo "</br><h1>".$meseci[$i-1]." (".$brojrezultata.")</h1>";
			while($row = mysql_fetch_array($result)){
			$dan = $row['dan'];
			$mesec = $row['mesec'];
			if($dan < 10){$dan='0'.$dan;}
			if(strlen($mesec)==1){$mesec='0'.$mesec;}?>
    <div style="margin-top:10px;"> <!--class="content-item"--> 
      <a  href='oneEventDisplay.php?id=<?php echo ($row['id']);?>'> <?php echo $dan.'.'. $mesec.'.'.$row['godina'].' - '.$row['imePrograma'];?> </a>
      <div class="clear"></div>
    </div>
    <?php }}//kraj petlje koja lista dogadjaje?>
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
