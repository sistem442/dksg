<?php session_start();
if (isset($_SESSION['user'])) {
	$id = $_GET['id'];	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Izmena opsega događaja</title>
<link href="http://dksg.rs/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function proveri(){
	var d1 = document.getElementById('d1').value;
	var m1 = document.getElementById('m1').value;
	var g1 = document.getElementById('g1').value;
	var d2 = document.getElementById('d2').value;
	var m2 = document.getElementById('m2').value;
	var g2 = document.getElementById('g2').value;
	
	if (d1 < 1 || d1 >31 ){
		document.getElementById("potvrda").innerHTML = "<span style='color:red'>Proverite prvi dan</span> ";
		}
		else if (m1 < 1 || m1 >12){
		document.getElementById("potvrda").innerHTML = "<span style='color:red'>Proverite prvi mesec</span> ";
		}
		else if (g1 < 1957 || g1 >2020){
		document.getElementById("potvrda").innerHTML = "<span style='color:red'>Proverite prvu godinu</span> ";
		}
		else if (d2 < 1 || d2 >31){
		document.getElementById("potvrda").innerHTML = "<span style='color:red'>Proverite drugi dan</span> ";
		}
		else if (m2 < 1 || m2 >12){
		document.getElementById("potvrda").innerHTML = "<span style='color:red'>Proverite drugi mesec</span> ";
		}
		else if (g2 < 1957 || g2 >2020){
		document.getElementById("potvrda").innerHTML = "<span style='color:red'>Proverite drugu godinu</span> ";
		}
		else document.getElementById("potvrda").innerHTML = "<span style='color:green'>Unete vrednosti su ispravne pritisnite dugme za unos</span> ";
		document.getElementById("posalji").disabled = false;
	}
</script>
</head>
<body style="color:black; font-family:Arial, Helvetica, sans-serif;" onload="document.forms[0].posalji.disabled=true;">
<form action="editRangeResult.php"  method="post" enctype="multipart/form-data" name="eventForm" >
  <br />
  <br />
  <br />
  <div style="margin-right:400px; font-family:Arial; font-size:18px; color:#009"><br />
    <br />
    Unesite opseg događaja</div>
  <br>
  <input type="hidden" value="<?php echo $id?>" id="id" name="id"/>
  <table border="0" cellspacing="10px" style="padding-left:400px" >
    <tbody>
      <tr>
        <td align="left"> Prvi dan </td>
        <td><input id="d1" name="d1" type="text" /></td>
      </tr>
      <tr>
        <td align="left"> Prvi mesec </td>
        <td><input type="text" name="m1" id="m1" /></td>
      </tr>
      <tr>
        <td align="left"> Prva godina </td>
        <td><input type="text" name="g1" id="g1" /></td>
      </tr>
      <tr>
        <td align="left"> Drugi dan </td>
        <td><input id="d2" name="d2" type="text" /></td>
      </tr>
      <tr>
        <td align="left"> Drugi mesec </td>
        <td><input id="m2" name="m2" type="text" /></td>
      </tr>
      <tr>
        <td align="left"> Druga godina </td>
        <td><input id="g2" name="g2" type="text" /></td>
      </tr>
      <tr>
        <td colspan="2" align="left"><br />
          <br>
          <input type="button" onclick="proveri()" value="Proveri podatke" />
          <br />
          <div id="potvrda"></div>
          <br />
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