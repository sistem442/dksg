<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>Dom kulture Studentski grad Newsletter</TITLE>
<link rel="shortcut icon" href="http://dksg.rs/favicon.ico" type="image/x-icon" />
<link rel="icon" href="http://dksg.rs/favicon.ico" type="image/ico" />
<META name="keywords" content="dom kulture, studentski grad, predstava, pozoriste, film, galerija, forum, knjizevnost, koncert, muzika, beograd">
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
function validateForm()
{
var x=document.forms["forma"]["email"].value;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
  alert("Email adresa nije validna!");
  return false;
  }
}
function validateForm2()
{
var x=document.forms["djava"]["email2"].value;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
  alert("Email adresa nije validna!");
  return false;
  }
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
  <div id="vesti">
  </div>
  
  
  <DIV id="main">
  <?php
  //konekcija sa bazom
require_once("database_connect.php");
//izbor baze
mysql_select_db("dksg_3120", $con);
if (isset($_REQUEST['email']))//if "email" is filled out, upisi email u bazu
  {
   $email = $_REQUEST['email'];
   $query = "INSERT INTO  `dksg_3120`.`mail` (`mail`)VALUES ('$email');";
   $result = mysql_query($query);
   echo "Uspešno ste prijavljeni na newsletter.";
  }
else if(isset($_REQUEST['email2']))//izbrisi mail iz v=baze ako je email za odjavu ipisan
  {
   $email2 = $_REQUEST['email2'];
   $query = "DELETE  FROM `dksg_3120`.`mail` WHERE mail = '$email2';";
   $result = mysql_query($query);
   echo "Uspešno ste odjavljeni.";
  }  
else
//if "email" is not filled out, display the form
  {
  echo "<form method='post' action='newsletter.php' onsubmit='return validateForm();' name='forma'>
            Email: <input name='email' type='text' id='email' /><input type='submit' value='Prijavi email adresu'/>
        </form>
        <form method='post' action='newsletter.php' onsubmit='return validateForm2();' name='odjava'>
            Email: <input name='email2' type='text' id='email2' /><input type='submit' value='Odjavi email adresu'/>
        </form>
  ";
  }
?>

  
<!--main-->  </DIV>
  <div id="footer">
    <!--footer-->
    <!--?php include_once("footer.php");?-->
</div>
  <!--footer-->
</DIV>
<!--container-->
</body>
</html>
