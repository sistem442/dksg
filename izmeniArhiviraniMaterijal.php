<?php session_start();
if (isset($_SESSION['user'])) {
	$id = $_GET['id'];	
	
		//konekcija sa bazom
require_once("database_connect.php");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
//izbor baze
mysql_select_db("dksg_3120", $con);
//SQL izraz 
$query = ("SELECT * FROM vrstamaterijala WHERE (id = $id);");
				 echo "$query<br />";
$result = mysql_query($query);
if(!$result){
	die ("Došlo je do greške prilikom pretrage baze ");
	}
$row = mysql_fetch_array($result);
$plakat = $row['plakat'];
$pozivnica = $row['pozivnica'];
$katalog = $row['katalog'];
$fotografija = $row['fotografija'];
$video = $row['video'];
$zvuk = $row['zvuk'];
$publikacija = $row['publikacija'];

if($plakat == 'da') $plakat='checked="checked"'; else $plakat='';
if($pozivnica == 'da') $pozivnica='checked="checked"'; else $pozivnica='';
if($katalog == 'da') $katalog='checked="checked"'; else $katalog='';
if($fotografija == 'da') $fotografija='checked="checked"'; else $fotografija='';
if($video == 'da') $video='checked="checked"'; else $video='';
if($zvuk == 'da') $zvuk='checked="checked"'; else $zvuk='';
if($publikacija == 'da') $publikacija='checked="checked"'; else $publikacija='';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Izmena opsega dogadjaja</title>
<link href="http://dksg.rs/main.css" rel="stylesheet" type="text/css" />
</head>
<body style="color:black; font-family:Arial, Helvetica, sans-serif;">
<form action="izmeniArhiviraniMaterijalResult.php"  method="post" enctype="multipart/form-data" name="eventForm" >
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
          Vrsta materijala koji postoji u arhivi</td><td align="left">
                <input name="plakat" type="checkbox" <?php echo $plakat;?>/>
                Plakat<br />
                <input name="pozivnica" type="checkbox" <?php echo $pozivnica;?>/>
                Pozivnica<br />
                <input name="katalog" type="checkbox" <?php echo $katalog;?>/>
                Katalog<br />
                <input name="fotografija" type="checkbox" <?php echo $fotografija;?>/>
                Fotografija<br />
                <input name="zvuk" type="checkbox" <?php echo $zvuk;?>/>
                Audio zapis<br />
                <input name="video" type="checkbox" <?php echo $video;?>/>
                Video zapis<br />
                <input name="publikacija" type="checkbox" <?php echo $publikacija;?>/>
                Publikacije<br />
            </td>
            </tr>
      
      <tr>
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