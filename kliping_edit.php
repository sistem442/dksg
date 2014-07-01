<?php session_start();
if (isset($_SESSION['user'])) {
	$id = $_GET['id'];	
	//konekcija sa bazom
require_once("database_connect.php");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
//SQL izraz 
$query = ("SELECT * FROM kliping WHERE (id = $id);");
echo "$query<br />";
$result = mysql_query($query);
if(!$result){
	die ("Došlo je do greške pokušajte kasnije");
	}
$row = mysql_fetch_array($result);
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Izmena klipinga</title>
<link href="http://dksg.rs/main.css" rel="stylesheet" type="text/css" />
<link href="backEnd.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.warning {
	color:#F00;
}
</style>
<!-- Link na script za formatiranje teksta-->
<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
<script type="text/javascript">

//*************************************brisanje slike**********************************


function brisanjeSlike(){
var id = document.getElementById("id").value;//dobija vrednost iz hidden inputa na liniji 206
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("slika").innerHTML='<span style="color:green">Slika je obrisana!</span><br /><input style="width:180px" type="hidden" name="MAX_FILE_SIZE" value="1048576"><input type="file" name="slika" id="slika" value="Izaberite sliku" />Unesite sliku koja će se pojaviti sa desne strane teksta na naslovnoj strani maksimalna veličina je 1MB<br /><input type="hidden" value="nema" name="slikaUzTekstPostojeca" id="slikaUzTekstPostojeca" />';
    }
  }
xmlhttp.open("GET","Scripts/obrisi_sliku_kliping.php?id="+id,true);
xmlhttp.send();
}
</script>
</head>
<body style="color:black; font-family:Arial, Helvetica, sans-serif;" >
<form action="kliping_edit_result.php"  method="post" enctype="multipart/form-data" name="eventForm" >
  <input type="hidden" value="<?php echo $row['id']; //ovo sluzi za brisanje slike?>" id="id" name="id" />
  <br />
  <br />
  <br />
  <div style="margin-right:400px; font-family:Arial; font-size:18px;">Unos teksta i fajlova za novi događaj</div>
  <br>
  <table border="0" cellspacing="10px" >
    <tbody>
      <tr>
        <td align="left"> Kategorija</td>
        <td align="left"><select name="kategorija">
            <option <?php if($row['kategorija'] == 'nomal') echo "selected='selected'" ?>>normal</option>
            <option <?php if($row['kategorija'] == '40') echo "selected='selected'" ?>>40</option>                  
        </select></td>
      </tr>
       <tr>
        <td align="left">Dan</td>
        <td align="left"><input style="width:180px" type="number" max="31" min="1" id="dan" name="dan_unosa"  value="<?php echo $row['dan_unosa']; ?>" /></td>
      </tr>
      <tr>
        <td align="left">Mesec</td>
        <td align="left"><input style="width:180px" type="number" max="12" min="1" id="mesec" name="mesec_unosa"  onblur="ckeckIfEmty(this.value)" value="<?php echo $row['mesec_unosa']; ?>"/></td>
      </tr>
      <tr>
        <td align="left">Godina</td>
        <td align="left"><input style="width:180px" type="text" id="godina" name="godina_unosa" onblur="ckeckIfEmty(this.value)" value="<?php echo $row['godina_unosa']; ?>" /></td>
      </tr>
      <tr>
        <td width="100px" align="left">ID dogadjaja</td>
        <td width="100px" align="left"><input style="width:100px" type="number" id="id_dogadjaja_2" name="id_dogadjaja_2" value="<?php echo $row['id_dogadjaja_2']; ?>" />
          <br />
      </tr> 
      <tr>
        <td width="100px" align="left">Link</td>
        <td width="100px" align="left"><input style="width:680px" type="text" id="id_dogadjaja" name="id_dogadjaja" value="<?php echo $row['id_dogadjaja']; ?>" />
          <br />
      </tr>      
		<tr>
        <td align="left"> Naslov klipinga</td>
        <td align="left"><input style="width:680px" type="text" id="naslov_klipinga" name="naslov_klipinga"  value="<?php echo $row['naslov_klipinga']; ?>"/></td>
      </tr>
      <tr>
        <td width="100px" align="left">Strana</td>
        <td width="100px" align="left"><input style="width:680px" type="text" id="strana" name="strana" value="<?php echo $row['strana']; ?>" /></td>
      </tr>
      <tr>
        <td align="left"> Medij</td>
        <td align="left"><select name="medij">
        <?php $result0 = mysql_query("SELECT ime FROM mediji");
		$trenutni_medij = $row['medij'];
		while($row0 = mysql_fetch_array($result0)){ 
			if($trenutni_medij == $row0['ime'])
				echo '<option selected="selected">'.$row0['ime'].'</option>';
            else
				echo '<option>'.$row0['ime'].'</option>';
            
        }?>
        </select></td>
      </tr>
      <tr>
        <td width="100px" align="left">Naslov dogadjaja</td>
        <td width="100px" align="left"><input style="width:680px" type="text" id="naslov_dogadjaja" name="naslov_dogadjaja" value="<?php echo $row['naslov_dogadjaja']; ?>" />
          <br />
      </tr>
      
      <tr>
        <td> Trenutna slika uz tekst: flag jeste <?php echo $row['flag'];?></td>
        <td id="slika">
		      <?php 
 		        if($row['flag']== 'kod') {//ako slika nije uneta
			     echo('<span style="color:red">Trenutno nije uneta slika</span><br />
				     <input style="width:180px" type="hidden" name="MAX_FILE_SIZE" value="1048576">
                     <input type="file" name="slika" id="slika" value="Izaberite sliku" />
                     Unesite sliku, maksimalna veličina je 1MB
		             <input type="hidden" value="nema" name="slikaUzTekstPostojeca" 
					 id="slikaUzTekstPostojeca" />');//ako nema slike primi fajl 
				 }
                 else{// ako je uneta ponudi brisanje
				     echo ('<img src="'.$row['slika'].'" width="180px"/>');//prikazi sliku
                     //prosledi bazi path do stare slike
					 echo '<input type="hidden" value="'.$row['slika'].'" name="slikaUzTekstPostojeca" />';
				     //ponudi brisanje
				     echo "<input type="; if($row['slika']!= '0') 
					 {echo 'button';} else echo('hidden');echo" 
					 id='obrisiSliku' value='Obriši sliku' onclick='brisanjeSlike()' /></td>";
				}?>
    
          </td>
      </tr>
      <tr>
        <td width="100px" align="left">Sadrzaj klipinga</td>
        <td width="100px" align="left">
        	<textarea style="width:680px; height:100px" id="kod" name="kod"><?php if($row['flag']== 'kod')echo $row['sadrzaj']; ?></textarea>
 		</td>
      </tr>
    </tbody>
  </table>
  <table border="0" cellspacing="10px" >
    <tr>
      <td align="left"><br />
        <br>
        <input type="submit" name="posalji" value="Pošalji" id="posalji" />
        <br />
        <br />
        <a href='adminIndex.php'>Glavni meni</a>
        </div>
        <br />
        <br />
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