<?php session_start();
include_once"database_connect.php";
if (isset($_SESSION['user'])) {
	if (isset($_GET['id'])){
		$id = $_GET['id'];		 
		$query = ("SELECT imePrograma FROM event WHERE (id = $id)");
		//echo "$query<br />";
		$result = mysql_query($query);
		$ime_dogadjaja = mysql_result($result, 0);	
	}
	else {
		$id = '';
		$ime_dogadjaja = "";
	}
	?>
<!-- 
Izmene 
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Unos klipinga</title>
<link href="backEnd.css" rel="stylesheet" type="text/css" />
<!-- Link na script za formatiranje teksta-->
<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/event.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$( '#eventForm' ).each(function(){this.reset();});//resetuje formu
});
function ukljuci_sliku(){
	 document.getElementById("slika").disabled = false;
	 document.getElementById("kod").disabled = true;
	 document.getElementById("flag").value = 'slika';
	}
function ukljuci_kod(){
	 document.getElementById("slika").disabled = true;
	 document.getElementById("kod").disabled = false;
	 document.getElementById("flag").value = 'kod';
	}

</script>
</head>
<body>
<div class="container2">
<br />
<a href='adminIndex.php'>Glavni meni</a>
<form action="kliping_entry_result.php"  method="post" 
	  enctype="multipart/form-data" name="kliping_form" id="kliping_form" >
      
	<input type="hidden" id="flag" name="flag" value="slika"/>      
  <div class="title">Unos klipinga</div>
  
    <div class="left">Kategorija</div>
  <div class="right">
    <select name="kategorija" >
		<option selected="selected">normal</option>
        <option> 40</option>
    </select>
  </div>
  <div class="clearfloat"></div>
  <div class="left">Datum klipinga</div>
  <div class="right500">
		dan
        <select name="dan_unosa"  id="dan"   >
          <option>01</option>
          <option>02</option>
          <option>03</option>
          <option>04</option>
          <option>05</option>
          <option>06</option>
          <option>07</option>
          <option>08</option>
          <option>09</option>
          <option>10</option>
          <option>11</option>
          <option>12</option>
          <option>13</option>
          <option>14</option>
          <option>15</option>
          <option>16</option>
          <option>17</option>
          <option>18</option>
          <option>19</option>
          <option>20</option>
          <option>21</option>
          <option>22</option>
          <option>23</option>
          <option>24</option>
          <option>25</option>
          <option>26</option>
          <option>27</option>
          <option>28</option>
          <option>29</option>
          <option>30</option>
          <option>31</option>
        </select>
        mesec
        <select name="mesec_unosa" id="mesec" >
          <option>01</option>
          <option>02</option>
          <option>03</option>
          <option>04</option>
          <option>05</option>
          <option>06</option>
          <option>07</option>
          <option>08</option>
          <option>09</option>
          <option>10</option>
          <option>11</option>
          <option>12</option>
        </select>
        godina
        <select name="godina_unosa"  id="godina" >
          <option>2018</option>
          <option>2017</option>
          <option>2016</option>
          <option>2015</option>
          <option>2014</option>
          <option selected="selected">2013</option>
          <option>2012</option>
          <option>2011</option>
          <option>2010</option>
          <option>2009</option>
          <option>2008</option>
          <option>2007</option>
          <option>2006</option>
          <option>2005</option>
          <option>2004</option>
          <option>2003</option>
          <option>2002</option>
          <option>2001</option>
          <option>2000</option>
          <option>1999</option>
          <option>1998</option>
          <option>1997</option>
          <option>1996</option>
          <option>1995</option>
          <option>1994</option>
          <option>1993</option>
          <option>1992</option>
          <option>1991</option>
          <option>1990</option>
          <option>1989</option>
          <option>1988</option>
          <option>1987</option>
          <option>1986</option>
          <option>1985</option>
          <option>1984</option>
          <option>1983</option>
          <option>1982</option>
          <option>1981</option>
          <option>1980</option>
          <option>1979</option>
          <option>1978</option>
          <option>1977</option>
          <option>1976</option>
          <option>1975</option>
          <option>1974</option>
          <option>1973</option>
          <option>1972</option>
          <option>1971</option>
          <option>1970</option>
          <option>1969</option>
          <option>1968</option>
          <option>1967</option>
          <option>1966</option>
          <option>1965</option>
          <option>1964</option>
          <option>1963</option>
          <option>1962</option>
          <option>1961</option>
        </select>
      </div>
  <div class="clearfloat"></div>
    <div class="left" id='arhiv2'>ID događaja (ako postoji)</div>
  <div class="right" id='arhiv3'>
    <input style="width:100px" type="number" id="id_dogadjaja_2" name="id_dogadjaja_2" />
  </div>
  <div class="clearfloat"></div>
    <div class="left" id='arhiv2'>Link</div>
  <div class="right" id='arhiv3'>
    <input style="width:680px" type="text" id="id_dogadjaja" name="id_dogadjaja" value="http://www.dksg.rs/event/<?php echo $id; ?>" />
  </div>
  <div class="clearfloat"></div>
  <div class="left">Naslov klipinga</div>
  <div class="right">
    <input style="width:680px" type="text" id="naslov_klipinga" name="naslov_klipinga"  />
  </div>
  <div class="clearfloat"></div>
  <div class="left" id='arhiv4'>Naslov dogadjaja</div>
  <div class="right" id='arhiv5'>
    <input style="width:680px" type="text" id="naslov_dogadjaja" name="naslov_dogadjaja" value="<?php echo $ime_dogadjaja; ?>" />
  </div>
  <div class="clearfloat"></div>
  <div class="left" id='arhiv6'>Strana</div>
  <div class="right" id='arhiv7'>
    <input style="width:680px" type="text" id="strana" name="strana" value="0" />
  </div>
  <div class="clearfloat"></div>
  <div class="left"> Medij</div>
  <div class="right">
    <select name="medij">
   <?php $result0 = mysql_query("SELECT ime FROM mediji");while($row0 = mysql_fetch_array($result0)) echo '<option>'.$row0['ime'].'</option>';?>
   </select>
  </div>
  <div class="clearfloat"></div>
  <div class="left" id='arhiv14'>Slika </div>
  <div class="right id='arhiv15'">
    <input type="radio" name="izbor" style="width:30px; float:left; height:15px"  onclick="ukljuci_sliku()"/><input style="width:480px" type="hidden" name="MAX_FILE_SIZE" value="1048576">
    <input type="file" name="slika" id="slika" width="300px" disabled="disabled" />
    maksimalna veličina je 1MB</div>
   
  <div class="clearfloat"></div>
  
    <div class="left">YouTube ili SoundCloud</div>
  <div class="right">
    <input type="radio" name="izbor" style="width:30px; float:left; height:15px" onclick="ukljuci_kod()"/>
    <textarea style="width:580px; height:100px" id="kod" name="kod" disabled="disabled"></textarea>
  </div>
  <div class="clearfloat"></div>
  <div class="right id='arhiv15'">
    <input style="width:300px; height:50px" type="submit" name="posalji" value="Pošalji" id="posalji"  />
    </div>
	<div class="clearfloat"></div>
   <div id="validnost" class="right">
    <a href='adminIndex.php'>Glavni meni</a> </div>
  	</div>
  </div>
</form>
</div>
</body>
</html>
<?php }
else { // Ako korisnik nije prijavljen na sistem
 echo "Niste prijavljeni!<br />
 <a href='login.php'>Prijava</a>
<br />";
}
?>