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
  

  

  <div id="vesti">
  
  </div>
  
  
  <DIV id="main">
PRETRAGA PO JEDNOM PARAMETRU I DATUMU
<form action="advancedSearchResult.php" method="post">
<input type="hidden" value="viseParametara" name="izbor"/>
  <table>
  <tr>
      <td>Traži po:</td>
      <td><select name="izbor">
          <option value="poReci" selected="selected">po re&#269;i</option>
          <option value="poDatumu"> po datumu</option>
          <option value="sveTri"> po datumu, reči i vrsti materijala</option>
          <option value="oba">i po reči i po datumu</option>
        </select></td>
    </tr>
    <tr>
      <td>Ključna reč:</td>
      
      <td><input type="text"  name="rec"></td>
      <td><select name="kolona">
          <option value="tekst" selected="selected">tekst</option>
          <option value="ucesnici" >učesnici i autori</option>
          <option value="program">program</option>
          <option value="naslov">naslov</option>
          <option value="podnaslov">podnaslov</option>
          <option value="napomene">napomene</option>
          <option value="signature">signature</option>          
        </select></td>
    </tr>
    <tr>
      <td>Mesec:</td>
      <td><input type="number" name="mesec"/></td>
    </tr>
    <tr>
      <td>Godina:</td>
      <td><input type="number" name="godina"/></td>
    </tr>
    <tr>
      <td align="left"> Vrsta materijala koji postoji u arhivi</td><td align="left">
                <input name="materijal" type="radio" value="plakat"  />
                Plakat<br />
            <input name="materijal" type="radio" value="pozivnica"/>
                Pozivnica<br />
            <input name="materijal" type="radio" value="katalog" />
                Katalog<br />
            <input name="materijal" type="radio" value="fotografija"/>
                Fotografija<br />
            <input name="materijal" type="radio" value="audio" />
                Audio zapis<br />
            <input name="materijal" type="radio" value="video" />
                Video zapis<br />
            <input name="materijal" type="radio" value="publikacija" />
                Publikacije<br />
            </td>
        </tr>
    
  </table>

<br />
<input name="submit" type="submit" value="Tra&#382;i" onclick="izbor()" />
<br /></form>
<br />
<br />
<br />
<br />
<br />
Unesite parametre pretrage:</span><br />
<br />
<form action="advancedSearchResult.php" method="post">
<input type="hidden" value="viseParametara" name="izbor"/>
  <table>
    <tr>
      <td><select name="parametar1">
          <option value="ucesnici">u&#269;esnici</option>
          <option value="program" selected="selected">program</option>
          <option value="imePrograma">naslov</option>
          <option value="podnaslov">podnaslov</option>
          <option value="nadnaslov">nadnaslov</option>
          <option value="tekst">tekst</option>
          <option value="napomene">napomene</option>
          <option value="signature">signature</option>
        </select></td>
      <td><input type="text" name="parametar1i"></td>
      <td><select name="parametar11">
          <option value="and">i</option>
          <option value="or">ili</option>
          <option value="!=">nije</option>
        </select></td>
    </tr>
    <tr>
      <td><select name="parametar2">
       <option value="ucesnici">u&#269;esnici</option>
          <option value="program">program</option>
          <option value="imePrograma" selected="selected">naslov</option>
          <option value="podnaslov">podnaslov</option>
          <option value="nadnaslov">nadnaslov</option>
          <option value="tekst">tekst</option>
          <option value="napomene">napomene</option>
          <option value="signature">signature</option>
        </select></td>
      <td><input type="text" name="parametar2i"></td>
      <td><select name="parametar22">
          <option value="and">i</option>
          <option value="or">ili</option>
          <option value="!=">nije</option>
        </select></td>
    </tr>
    <tr>
      <td><select name="parametar3">
         <option value="ucesnici">u&#269;esnici</option>
          <option value="program">program</option>
          <option value="imePrograma">naslov</option>
          <option value="podnaslov">podnaslov</option>
          <option value="nadnaslov">nadnaslov</option>
          <option value="tekst" selected="selected">tekst</option>
          <option value="napomene">napomene</option>
          <option value="signature">signature</option>
        </select></td>
      <td><input type="text" name="parametar3i"></td>
      <td><select name="parametar33">
          <option value="and">i</option>
          <option value="or">ili</option>
          <option value="!=">nije</option>
        </select></td>
    </tr>
    <tr>
      <td><select name="parametar4">
        <option value="ucesnici" selected="selected">u&#269;esnici</option>
          <option value="program">program</option>
          <option value="imePrograma">naslov</option>
          <option value="podnaslov">podnaslov</option>
          <option value="nadnaslov">nadnaslov</option>
          <option value="tekst">tekst</option>
          <option value="napomene">napomene</option>
          <option value="signature">signature</option>
        </select></td>
      <td><input type="text" name="parametar4i"></td>
      
    </tr>
  </table>
  <br />
  <input name="submit" type="submit" value="Tra&#382;i" onclick="izbor()"  />
<br />
Napomena:<br />
Ako nemate 4 parametra unesite više istih parametara.<br />
<br />
<br />
<table width="450" cellpadding="10" cellspacing="10">
<tr>
<td colspan="4">Unesite vremenski period pretrage<br />
<br />
</td>
</tr>
<tr><td colspan="2" width="100px">Početni datum</td><td colspan="2" width="100px">Krajnji datum</td>
<tr>
        <td align="left">Dan </td>
        <td align="left"><input style="width:100px" type="number" max="31" min="1" id="dan" name="d1" value="1" /></td>
         <td align="left">Dan </td>
        <td align="left"><input style="width:100px" type="number" max="31" min="1" id="dan" name="d2" value="31" /></td>
      </tr>
      <tr>
        <td align="left">Mesec</td>
        <td align="left"><input style="width:100px" type="number" max="12" min="1" id="mesec" name="m1" value="1"   /></td>
        <td align="left">Mesec </td>
        <td align="left"><input style="width:100px" type="number" max="12" min="1" id="mesec" name="m2" value="12"   /></td>
      </tr>
      </tr>
      <tr>
        <td align="left">Godina</td>
        <td align="left"><input style="width:100px" type="number" value="1975" id="godina" name="g1"   /></td>
        <td align="left">Godina </td>
        <td align="left"><input style="width:100px" type="number" value="2015" id="godina" name="g2"  /></td>
      </tr>
      </table>
</form>

  </DIV>
  <!--main-->
  
  
  
  
  
  
  
  <div id="footer">
    <!--footer-->
    <?php include_once("footer.php");?>
</div>
  <!--footer-->
</DIV>
<!--container-->
</body>
</html>


</body>
</html>
