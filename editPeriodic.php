<?php session_start();
if (isset($_SESSION['user'])) {
	$id = $_GET['id'];	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Izmena opsega dogadjaja</title>
<link href="http://dksg.rs/main.css" rel="stylesheet" type="text/css" />
</head>
<body style="color:black; font-family:Arial, Helvetica, sans-serif;">
<form action="editPeriodicResult.php"  method="post" enctype="multipart/form-data" name="eventForm" >
  <br />
  <br />
  <br />
  <div style="margin-right:400px; font-family:Arial; font-size:18px; color:#009"><br />
<br />
Unesite dane kada se pojavljuje događaj</div>
  <br>
  <table border="0" cellspacing="10px" style="padding-left:400px" >
    <tbody>
      <tr>
        <td align="left">
          <input type="hidden" value="<?php echo $id?>" id="id" name="id"/>
          <input type="checkbox" name="pon" value="pon" />
          Ponedeljak<br />
          <input type="checkbox" name="uto" value="uto" />
          Utorak<br />
          <input type="checkbox" name="sre" value="sre" />
          Sreda<br />
          <input type="checkbox" name="cet" value="cet" />
          Četvrtak<br />
          <input type="checkbox" name="pet" value="pet" />
          Petak<br />
          <input type="checkbox" name="sub" value="sub" />
          Subota<br />
          <input type="checkbox" name="ned" value="ned" />
          Nedelja<br /></td>
      </tr>
    
    <tr>
      <td align="left"><br />
        <br>
        <input type="submit" name="posalji" value="Pošalji" id="posalji"  />
        <br />
        <br />
        <a href='adminIndex.php'>Glavni meni</a>
        </div>
        <br /></td>
        </td>
  </table>
</form>
</body>
</html>
<?php }
else { // Ako korisnik nije prijavljen na sistem
 echo "Niste prijavljeni!<br />
 <a href='login.php'>Prijava</a>
<br />";
}
?>