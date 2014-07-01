<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>Napredna Pretraga</TITLE>
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
.left{float:left; text-align:left; padding:10px 10px 10px 0px; display:table-cell; width:100px}
.right{float:right; text-align:left; padding:10px; display:table-cell; width:310px}
.clearfloat {clear:both; height:0; font-size: 1px; line-height: 0px;}
input[type=text]{ width:300px}
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
function izbor(){
	document.getElementById("izbor").value = 'jedanParametar';
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
  <DIV id="image"></DIV>
  <div id="vesti"> </div>
  <DIV id="mainBig"> 
    <form action="advancedSearchResult.php" method="get">
      <input type="hidden" value="viseParametara" name="izbor"/>
      <div style="width:440px; margin: 0 auto">
      Unesite parametre pretrage:
      <br />
      <br />
      <div class="left"><select name="var1">
              <option value="ucesnici">u&#269;esnici</option>
              <option value="program" selected="selected">program</option>
              <option value="imePrograma">naslov</option>
              <option value="podnaslov">podnaslov</option>
              <option value="nadnaslov">nadnaslov</option>
              <option value="tekst">tekst</option>
              <option value="napomene">napomene</option>
              <option value="signature">signature</option>
              <option value="godina">godina</option>
              <option value="mesec">mesec</option>
            </select></div>
		<div class="right"><input type="text" name="var11"></div>
		<div class="clearfloat"></div>
        <div class="left"><select name="var2">
              <option value="ucesnici">u&#269;esnici</option>
              <option value="program">program</option>
              <option value="imePrograma" selected="selected">naslov</option>
              <option value="podnaslov">podnaslov</option>
              <option value="nadnaslov">nadnaslov</option>
              <option value="tekst">tekst</option>
              <option value="napomene">napomene</option>
              <option value="signature">signature</option>
              <option value="godina">godina</option>
              <option value="mesec">mesec</option>
            </select></div>
		<div class="right"><input type="text" name="var22"></div>
		<div class="clearfloat"></div>
        <div class="left"><select name="var3">
              <option value="ucesnici">u&#269;esnici</option>
              <option value="program">program</option>
              <option value="imePrograma">naslov</option>
              <option value="podnaslov">podnaslov</option>
              <option value="nadnaslov">nadnaslov</option>
              <option value="tekst" selected="selected">tekst</option>
              <option value="napomene">napomene</option>
              <option value="signature">signature</option>
              <option value="godina">godina</option>
              <option value="mesec">mesec</option>
            </select></div>
		<div class="right"><input type="text" name="var33"></div>
		<div class="clearfloat"></div>
        <div class="left"><select name="var4">
              <option value="ucesnici" selected="selected">u&#269;esnici</option>
              <option value="program">program</option>
              <option value="imePrograma">naslov</option>
              <option value="podnaslov">podnaslov</option>
              <option value="nadnaslov">nadnaslov</option>
              <option value="tekst">tekst</option>
              <option value="napomene">napomene</option>
              <option value="signature">signature</option>
              <option value="godina">godina</option>
              <option value="mesec">mesec</option>
            </select></div>
		<div class="right"><input type="text" name="var44"></div>
		<div class="clearfloat"></div>
         <div class="left" style="width:150px">Vrsta materijala u arhivi</div>
		<div class="right" style=" float:left; width:100px"><select name="var5">
              <option>Sve</option>
              <option value="mat_plakat">plakat</option>
              <option value="mat_pozivnica">pozivnica</option>
              <option value="mat_katalog">katalog</option>
              <option value="mat_fotografija">fotografija</option>
              <option value="mat_audio">audio zapis</option>
              <option value="mat_video">video zapis</option>
              <option value="mat_publikacija">publikacija</option>
              <option value="mat_program">program</option>
            </select></div>
		<div class="clearfloat"></div>
        <input style="width:430px; height:30px" name="submit" type="submit" value="Tra&#382;i"   />
        </div>  
        <br />
        <br />
    </form>
  </DIV>
  <!--main-->
  
</DIV>
<!--container-->
</body>
</html>

</body>
</html>
