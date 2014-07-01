<?php
session_start();
if (!isset($_SESSION['user'])) {
	echo "Niste prijavljeni!<br />
 <a href='login.php'>Prijava</a>
<br />";
}
else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Glavni meni</title>
<link href="backEnd.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var korisnik = '<?php echo($_SESSION['user']); ?>';
	if( korisnik == 'admin'){
		$('#slider').css("display","block");
		$('#advertisement').css("display","block");
	}
	else{
		$('#slider').css("display","none");
		$('#advertisement').css("display","none");
	}
	});
</script>
</head>
<body class="container2">
<div class="container2">
<br />
<br />
<table width="1094" border="10" cellspacing="10" cellpadding="10">
  <tr>
    <td align="center" bgcolor="#CCCCCC">TEKSTOVI</td> 
    <td align="center">DOGAĐAJI</td>
    <td align="center" bgcolor="#CCCCCC">VESTI</td>
    <td align="center">ARHIVA</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><div class="result"><a class="result2" href='tekstUnos.php'>Novi unos</a></div></td>
    <td align="center"><div class="result"><a class="result2" href='eventEntry.php?arhiva="false"'>Novi unos</a></div></td>
    <td align="center" bgcolor="#CCCCCC"><div class="result"><a class="result2" href='eventEntryNews.php'>Unos vesti</a></div></td>
    <td align="center"><div class="result"><a class="result2" href='searchArchive.php'>Pretraga stare baze arhive</a></div></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><div class="result"><a class="result2" href='searchTekst.php'>Pretraga, izmena i brisanje tekstova</a></div></td>
    <td align="center"><div class="result"><a class="result2" href='search.php'>Pretraga, izmena i brisanje događaja</a></div></td>
    <td align="center" bgcolor="#CCCCCC"><div class="result"><a class="result2" href='searchNews.php'>Pretraga, izmena i brisanje vesti</a></div></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr><td style="border:0px"></td><td align="center"><div class="result"><a class="result2" href='eventEntry.php?arhiva=aaa'>Unos starih događaja</a></div></td>
</table>
<br />
<div class="result"><a class="result2" href='logout.php'>Izloguj se</a></div>
<div class="result"><a class="result2" href='csv.php'>Generiši listu za newsletter</a></div>
<div class="result"><a class="result2" href='kliping_search.php'>Izmena klipinga</a></div>
<div class="result"><a class="result2" href='kliping_entry.php'>Unos klipinga</a></div>
<div class="result"><a class="result2" href='kliping_mediji.php'>Unos i izmena medija za kliping</a></div>
<div id="slider" style="display:none">
	<a class="result2" href='slider_entry.php'>Slider</a>
    <form action="slider_search.php" method="POST">
    	Slider izmena i brisanje za mesec:<select name="mesec" id="mesec" >
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
          <option>6</option>
          <option>7</option>
          <option>8</option>
          <option>9</option>
          <option>10</option>
          <option>11</option>
          <option>12</option>
        </select>
        godina
        <select name="godina" id="godina" >
          <option>2018</option>
          <option>2017</option>
          <option>2016</option>
          <option>2015</option>
          <option>2014</option>
          <option selected="selected">2014</option>
          </select>
          <input type="submit" value="Traži"/>
    </form>
</div>

<br />
<form action="Dom_kulture_program.php" method="post">
<div style="background:#090; padding:10px">
	PRIKAZ STRANICE ZA PROGRAM 
    	<select name="program" id="program">
            <option value="likovni">likovni</option>
            <option value="filmski">filmski</option>
            <option value="muzicki">muzicki</option>
            <option value="pozorisni">pozorisni</option>
            <option value="forum">forum</option>
            <option value="knjizevni">knjizevni</option>
            <option value="afc">afc</option>
            <option value="biblioteka">biblioteka</option>
            <option selected="selected" value="program">Izaberite program</option>
        </select>
 mesec:
 		<select name="mesec"id="mesec" >
              <option selected="selected" value="program">Izaberite mesec</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>
              <option>7</option>
              <option>8</option>
              <option>9</option>
              <option>10</option>
              <option>11</option>
              <option>12</option>
        </select>
godinu:
		<select name="godina" id="godina" >
 			<option selected="selected" value="program">Izaberite godinu</option>
            <option>2015</option>
            <option>2014</option>
            <option>2013</option>
            <option>2012</option>
        </select> 
<input type="submit" value="Prikaži"/>
</div>
</form>
</div><!--container-->
</body>
</html>
<?php 
}
?>