<?php 
session_start();
if (!isset($_SESSION['user'])) {   
die("Niste prijavljeni!<br />
 <a href='login.php'>Prijava</a>
<br />");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pretraga stare arhive</title>
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

</script>
</head>

<body>
<span class="naslov">Unesite parametre pretrage:</span><br />
<br />
<form action="searchArchiveResult.php" method="post">
  <table>
    <tr>
      <td>Ključna reč:</td>
      
      <td><input type="text" value="unesite reč" name="rec"></td>
      <td><select name="kolona">
          <option value="autor" selected="selected">autor</option>
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
      <td>Traži po:</td>
      <td><select name="izbor">
          <option value="poReci" selected="selected">po re&#269;i</option>
          <option value="poDatumu"> po datumu</option>
          <option value="oba">i po re&#269;i i po datumu</option>
        </select></td>
    </tr>
  </table>

<br />
<input name="submit" type="submit" value="Tra&#382;i" />
<br /></form>
</body>
</html>