<?php session_start();
if (isset($_SESSION['user'])) {?>
<!-- 
Izmene 
29.5.2013. ugradio sam da se odredjena polja sakrivaju ako se uloguje arhiv ili urednik, takodje na osnovu ovoga radi u validacija
30.5.2013. Podeseno da se prikazuje samo unos za jedan datum ako je ulogovana arhiva 
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Unos događaja</title>
<link href="backEnd.css" rel="stylesheet" type="text/css" />
<!-- Link na script za formatiranje teksta-->
<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/event.js"></script>
<script type="text/javascript">

var grupa = '#'+'<?php echo($_SESSION['grupa']); ?>';
var opis = 'nok';//koristi se kao flag za opis teksta
var datum77 = 'nok';//flag za datum
$(document).ready(function(){
	sakri(grupa);//sakriva input elemente za grupe korisnika
	$('#posalji').attr("disabled", true);
	update_chars_left(5, $('#skrTekst')[0], $('#text_chars_left'));
	count_characters(2, $('#skrTekst')[0], $('#text_chars_needed'));
	});

</script>
</head>
<body>
<div class="container2">
<br />
<a href='adminIndex.php'>Glavni meni</a>
<form action="eventEntryResult.php"  method="post" enctype="multipart/form-data" name="eventForm" >
  <div class="title">Unos teksta i fajlova za novi događaj</div>
  <!--div style="font-family:Arial; font-size:18px; width:900px; padding:20px; color:#000; background-color:#FF6600">Izmene na sajtu
    <p><br />
      U cilju preglednijeg prikaza sadržaja sajta od sada se više neće koristiti skraćeni tekst. Umesto njega koristi se kombinacija polja nadnaslov, naslov, podnaslov i opis. Opis mora biti dugacak izmedju 200 i 300 karaktera. <br />
      <br />
      Dodato je polje za unos za izmena u programu, izmene će se prikazivati crvenima slovima iznad nadnaslova. </p>
    <p><u>Tekst i dalje mora biti kompletan, znači sa naslovom, nadnaslovom, podnaslovom, vremenom i mestom zbog kompatibilnosti sa starijim unosima.</u></p>
  </div-->
  <div class="left"> Deskriptivan naslov</div>
  <div class="right">
    <input style="width:680px" type="text" id="izmena" name="izmena" />
  </div>
  <div class="clearfloat"></div>
  <div class="left" id='arhiv0'> Izmena</div>
  <div class="right" id='arhiv1'>
    <input style="width:680px" type="text" id="izmena" name="izmena" />
  </div>
  <div class="clearfloat"></div>
  <div class="left" id='arhiv2'> Nadnaslov</div>
  <div class="right" id='arhiv3'>
    <input style="width:680px" type="text" id="nadnaslov" name="nadnaslov" />
  </div>
  <div class="clearfloat"></div>
  <div class="left">Naslov</div>
  <div class="right">
    <input style="width:680px" type="text" id="imePrograma" name="imePrograma"  />
  </div>
  <div class="clearfloat"></div>
  <div class="left" id='arhiv4'> Podnaslov</div>
  <div class="right" id='arhiv5'>
    <input style="width:680px" type="text" id="podnaslov" name="podnaslov" />
  </div>
  <div class="clearfloat"></div>
  <div class="left" id='arhiv6'> Vreme i mesto</div>
  <div class="right" id='arhiv7'>
    <input style="width:680px" type="text" id="vreme_mesto" name="vreme_mesto" />
  </div>
  <div class="clearfloat"></div>
  <div class="left" id='arhiv8'> Opis događaja</div>
  <div class="right" id='arhiv9'>
    <textarea cols="83" rows="10"   id="skrTekst" name="skrTekst"></textarea>
    <br />
    <div id='text_chars_needed'></div>
    <br />
    Preostali broj karaktera:
    <div style="display:inline" id="text_chars_left"></div>
  </div>
  <div class="clearfloat"></div>
  <div class="left">Mesto</div>
  <div class="right">
    <select style="width:180px" name="mesto" id="mesto">
      <option value="mala sala" selected="selected">mala sala</option>
      <option value="velika sala">velika sala</option>
      <option value="galerija">galerija</option>
      <option value="klub magistrala">klub magistrala</option>
      <option value="studio 26">studio 26</option>
      <option value="studio 27">studio 27</option>
      <option value="studio 28">studio 28</option>
      <option value="velika galerija">velika galerija</option>
      <option value="amfiteatar">amfiteatar</option>
      <option value="letnja pozornica">letnja pozornica</option>
      <option value="biblioteka">biblioteka</option>
      <option value="e čitaonica">e čitaonica</option>
      <option value="donji hol v.g.">donji hol v.g.</option>
      <option value="sala na spratu">sala na spratu</option>
      <option value="van doma">van doma</option>
      <option value="tekst">TEKST</option>
    </select>
  </div>
  <div class="clearfloat"></div>
  <div class="left">Program</div>
  <div class="right">
    <input type="hidden" value="0" name="prioritet" id="prioritet" />
    <select name="program" id="program"  onblur="displayResult()" style="width:180px">
      <option value="radionica">RADIONICE</option>
      <option value="ostali">ostalo</option>
      <option value="likovni">likovni</option>
      <option value="filmski">filmski</option>
      <option value="muzicki">muzicki</option>
      <option value="pozorisni">pozorisni</option>
      <option value="forum">forum</option>
      <option value="knjizevni">knjizevni</option>
      <option value="afc">afc</option>
      <option value="biblioteka">biblioteka</option>
      <option value="obavestenje">obavestenje</option>
      <option selected="selected" value="program">Izaberite program</option>
    </select>
  </div>
  <div class="clearfloat"></div>
  <div class="left">Učesnici</div>
  <div class="right">
    <input style="width:680px" type="text" id="ucesnici" name="ucesnici" />
  </div>
  <div class="clearfloat"></div>
  <div class="left">Tekst i dalje mora biti kompletan, znači sa naslovom, nadnaslovom, podnaslovom, vremenom i mestom zbog kompatibilnosti sa starijim unosima. </div>
  <div class="right">
    <textarea id="elm1" name="tekst">
        </textarea>
  </div>
  <div class="clearfloat"></div>
  <div class="left"> Slika </div>
  <div class="right">
    <input style="width:480px" type="hidden" name="MAX_FILE_SIZE" value="1048576">
    <input type="file" name="slikaUzTekst" id="slikaUzTekst" width="300px" />
    maksimalna veličina je 1MB</div>
   
  <div class="clearfloat"></div>
   <div style="text-align:center; background-color:#999; width:900px%;"><h3>Unos vremenskog opsega događaja</h3></div>
   <div class="left400"> 
   	<input name="jedanDan" type="hidden" id="jedanDan" value="off" />
    <input style="width:400px; height:70px" type="button" name="button" id="button" value="Događaj traje jedan dan izaberite datum" onclick="enable1()" /></div>
   <div class="right500">
		dan
        <select name="dan"  disabled="disabled" class="redBack" id="dan"   >
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
        <select name="mesec" disabled="disabled" class="redBack" id="mesec" >
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
        <select name="godina"  disabled="disabled" class="redBack" id="godina" >
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
      <div class="left400" id="arhiv10">
      	<input name="viseDana" type="hidden" id="viseDana" value="off" />
        <input style="width:400px; height:70px" type="button" name="button2" id="button2" 
        	value="Događaj traje više dana izberite početni i poslednji datum" onclick="enable2()" 
            />
        </div>
      <div class="right500" id="arhiv11">    
        Početni datum: &nbsp;&nbsp;dan
        <select name="dan1"  disabled="disabled" class="redBack" id="dan1"  >
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
        <select name="mesec1" disabled="disabled" class="redBack" id="mesec1" >
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
        <select name="godina1"  disabled="disabled" class="redBack" id="godina1" >
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
        <br />
        Poslednji datum: dan
        <select name="dan2"  disabled="disabled" class="redBack" id="dan2">
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
        <select name="mesec2" disabled="disabled" class="redBack" id="mesec2" >
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
        <select name="godina2"  disabled="disabled" class="redBack" id="godina2" >
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
    <div class="left400" id="arhiv12">
    	<input style="width:400px; height:70px" type="button" name="button3" id="button3" 
        	value="Događaj se ponavlja određenim danima( za radionice)" onclick="enable3()" 
        />
        <br />
        <div id="napomena33" style="color:#009900; text-align:left; display:none">Napomena: <br />
Unesite početnji i poslednji datum događaja!</div>
        <input name="ponavljaSe" type="hidden" id="ponavljaSe" value="off" />
   </div>
   <div class="right500" id="arhiv13">
   		<input name="pon" type="checkbox" disabled="disabled" id="pon" value="pon" />
        Ponedeljak<br />
        <input name="uto" type="checkbox" disabled="disabled" id="uto" value="uto"/>
        Utorak<br />
        <input name="sre" type="checkbox" disabled="disabled" id="sre" value="sre"/>
        Sreda<br />
        <input name="cet" type="checkbox" disabled="disabled" id="cet" value="cet"/>
        Četvrtak<br />
        <input name="pet" type="checkbox" disabled="disabled" id="pet" value="pet"/>
        Petak<br />
        <input name="sub" type="checkbox" disabled="disabled" id="sub" value="sub"/>
        Subota<br />
        <input name="ned" type="checkbox" disabled="disabled" id="ned" value="ned"/>
        Nedelja<br />
        
    </div>
  <div class="clearfloat"></div>
  <div class="left"> Napomene</div>
  <div class="right">
    <input style="width:680px" type="text" id="napomene" name="napomene" />
  </div>
  <div class="clearfloat"></div>
  <div class="left" id="urednici4">Signature (Unosi arhiva)</div>
  <div class="right" id="urednici3">
    <input style="width:680px" type="text" id="signature" name="signature" />
  </div>
  <div class="clearfloat"></div>
  <div class="left">
    <div id="urednici1" style="display:block">Vrsta materijala koji postoji u arhivi</div>
  </div>
  <div class="right">
    <div id="urednici2" style="display:block">
      <input name="plakat" type="checkbox"  />
      Plakat<br />
      <input name="pozivnica" type="checkbox"/>
      Pozivnica<br />
      <input name="katalog" type="checkbox" />
      Katalog<br />
      <input name="fotografija" type="checkbox"/>
      Fotografija<br />
      <input name="audio" type="checkbox" />
      Audio zapis<br />
      <input name="video" type="checkbox" />
      Video zapis<br />
      <input name="publikacija" type="checkbox" />
      Publikacije<br />
      <input name="materijalProgram" type="checkbox" />
      Program<br />
    </div>
  </div>
  <div class="clearfloat"></div>
  <div class="left">Upload fajlova:</div>
  <div class="right">
    <input  type="hidden" name="brojFajlova" id="brojFajlova" value="0"/>
    <br />
    Ako ubacite slike one će biti prikazane ispod teksta a ako ubacite fajlove postojaće link za preuzimanje<br />
    <br />
    <p id="newInput0">&nbsp;</p>
    <p><a href="javascript:display()">Dodaj još fajlova</a> &nbsp;&nbsp; (slike, pdf, doc, mp3, flv...) </p>
    <br />
    <br />
  </div>
  <div class="clearfloat"></div>
   <div id="validnost" class="left"><span style="color:red">Da biste postavili sadržaj na sajt prvo proverite podatke!</span></div>
   <div class="right">
	<input type="button" onclick="funkcija31()" value="Proveri validnost podataka"/>
    <input type="submit" name="posalji" value="Pošalji" id="posalji"  />
    </div>
	<div class="clearfloat"></div>
   <div id="validnost" class="left">
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