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
<style type="text/css">
.container {
	width: 60%;
	max-width:600px;
	min-width:600px;
	margin:0 auto;
	overflow:hidden;
}
td {
	padding:10px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pretraga Tekstova</title>
</head>
<body style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; background-color: #FF9;">
<div class="container"> <br />
  <div align="center">Pretraga baze sajta dksg.rs</div>
  <br />
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <form action="searchTekstResult.php" method="post">
      <tr style="background-color:#093">
        <td>Napredna pretraga* </td>
        <td width="65">Ključna reč</td>
        <td width="300"><input type="text" name="rec" />
          <select name="kolona">
            <option value="tekst"  selected="selected">tekst</option>
            <option value="opis">opis</option>
            <option value="naslov">naslov</option>
            <option value="kreator">kreator</option>
            <option value="editor">editor</option>
          </select></td>
        <td><input name="submit" type="submit" value="Tra&#382;i" /></td>
      </tr>
      <tr style="background-color: #FF9; height:20px"> </tr>
    </form>
    <form action="tekstEdit.php" method="get">
      <tr style="background-color:#093">
        <td>Pretraga po id broju 
        <td width="65"></td>
        <td width="300"><input type="text" name="id" /></td>
        <td><input name="submit" type="submit" value="Tra&#382;i" /></td>
      </tr>
    </form>
      </tr>
    
  </table>
  <br />
  <br />
  <a href="adminIndex.php">Glavni meni</a>
  </p>
  </form>
</div>
</body>
</html>
