<?php session_start(); 
//konekcija sa bazom
require_once("database_connect.php");
$url = $_GET['url'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Dom kulture Studentski grad - Biblioteka</title>
<meta http-equiv="keywords" content=" dom ,kulture, studentski, grad, biblioteka">
<meta http-equiv="description" content="Biblioteka u domu kulture Studentski grad">
<link rel="icon" href="http://www.dksg.rs/favicon.ico" type="image/ico" />
<link rel="shortcut icon" href="http://www.dksg.rs/favicon.ico" type="image/ico" />
<META name="abstract" content="dom kulture u studentskom gradu u beogradu">
<LINK href="http://www.dksg.rs/reset.css" rel="stylesheet" type="text/css">
<LINK href="http://www.dksg.rs/main.css" rel="stylesheet" type="text/css">
<SCRIPT src="http://www.dksg.rs/jquery-1.2.6.min.js" type="text/javascript" charset="utf-8"></SCRIPT>
<SCRIPT src="http://www.dksg.rs/ui_nav.js" type="text/javascript" charset="utf-8"></SCRIPT>
<SCRIPT src="http://www.dksg.rs/ga.js" type="text/javascript"></SCRIPT>
<STYLE id="tmpStyle" type="text/css" disabled="">
#pic {
	-moz-opacity: 0.00;
	filter: alpha(opacity=0);
	opacity: 0;
	-khtml-opacity: 0;
}
</STYLE>
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
</head>
<body>
<div id="content">
  <div id="header">
    <?php include_once("heder.php") ?>
  </div>
  <div id="menu">
    <?php include_once("menu.php"); ?>
  </div>
  <div id="mainBig">
   <iframe src="<?php echo $url;?>" width="670" height="800"></iframe>
</div><!--container-->
</body>
</html>
