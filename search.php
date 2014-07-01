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
.container{
	width: 60%;
	max-width:600px;
	min-width:600px;
	margin:0 auto;
	overflow:hidden;
	}
td{
	padding:10px;
	}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pretraga po datumu</title>
</head>
<body style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; background-color: #FF9;">
<div class="container">
<br />
<div align="center">Pretraga baze sajta dksg.rs</div>
<br />
<form action="searchResult.php" method="post">
  <table width="100%" border="0" cellpadding="0" cellspacing="0"  >
    <tbody>
      <tr style="background:#09C">
        <td align="center" rowspan="3">Pretraga baze po datumu</td>
        <td width="136" align="left">Dan</td>
        <td width="315" align="left">
        <select id="dan" name="dan"/>
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
        </td>
        <td width="300" rowspan="3" align="left"><input type="submit" name="Traži" value="Traži"  /></td>
      </tr>
      <tr style="background-color:#09C">
        
        <td align="left">Mesec</td>
        <td align="left"><select id="mesec" name="mesec"/>
        <option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option>
            </select> 
        </td>        
      </tr>
      <tr style="background-color:#09C">
        <td align="left">Godina</td>
        <td align="left"><select id="godina" name="godina" /><option>2018</option><option>2017</option><option>2016</option><option>2015</option><option>2014</option><option selected="selected">2013</option><option>2012</option>            <option>2011</option>            <option>2010</option>            <option>2009</option>            <option>2008</option>            <option>2007</option>            <option>2006</option>            <option>2005</option>            <option>2004</option>            <option>2003</option>            <option>2002</option>            <option>2001</option>            <option>2000</option>            <option>1999</option>            <option>1998</option>            <option>1997</option>            <option>1996</option>            <option>1995</option>            <option>1994</option>            <option>1993</option>            <option>1992</option>            <option>1991</option>            <option>1990</option>            <option>1989</option>            <option>1988</option>            <option>1987</option>            <option>1986</option>            <option>1985</option>            <option>1984</option>            <option>1983</option>            <option>1982</option>            <option>1981</option>            <option>1980</option>            <option>1979</option>            <option>1978</option>            <option>1977</option>            <option>1976</option>            <option>1975</option>            <option>1974</option>            <option>1973</option>            <option>1972</option>            <option>1971</option>     <option>1970</option>            <option>1969</option>            <option>1968</option>            <option>1967</option>            <option>1966</option>            <option>1965</option>            <option>1964</option>            <option>1963</option>            <option>1962</option>            <option>1961</option>
          </select></td>
      </tr>
       
       <!-- </tbody>
  </table>-->
</form>
<tr style="background-color: #FF9; height:20px">
<form action="search2Result.php" method="post">
<!--<table style="background-color:#096" width="100%" border="0" cellspacing="0" cellpadding="0">-->
  <tr style="background-color:#093">
    <td rowspan="2">Napredna pretraga*   <td width="65">Ključna reč ili ID broj</td>
    <td width="300"><input type="text" name="rec" />
      <select name="kolona">
        <option value="tekst"  selected="selected">tekst</option>
        <option value="ucesnici">učesnici i autori</option>
        <option value="program">program</option>
        <option value="imePrograma">naslov</option>
        <option value="podnaslov">podnaslov</option>
        <option value="napomene">napomene</option>
        <option value="signature">signature</option>
      </select></td>
    <td rowspan="2">Traži po:
      <select name="izbor">
        <option value="poReci" selected="selected">po re&#269;i</option>
        <option value="poDatumu"> po datumu</option>
        <option value="oba">i po re&#269;i i po datumu</option>
        <option value="po_id_broju">po ID broju </option>
      </select>
      <input name="submit" type="submit" value="Tra&#382;i" /></td>
  </tr>
  <tr style="background-color:#093">
    <td>Datum</td>
    <td><select id="mesec2" name="mesec2"/>
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
      <select id="godina" name="godina" /><option>2018</option><option>2017</option><option>2016</option><option>2015</option><option>2014</option><option selected="selected">2013</option><option>2012</option>            <option>2011</option>            <option>2010</option>            <option>2009</option>            <option>2008</option>            <option>2007</option>            <option>2006</option>            <option>2005</option>            <option>2004</option>            <option>2003</option>            <option>2002</option>            <option>2001</option>            <option>2000</option>            <option>1999</option>            <option>1998</option>            <option>1997</option>            <option>1996</option>            <option>1995</option>            <option>1994</option>            <option>1993</option>            <option>1992</option>            <option>1991</option>            <option>1990</option>            <option>1989</option>            <option>1988</option>            <option>1987</option>            <option>1986</option>            <option>1985</option>            <option>1984</option>            <option>1983</option>            <option>1982</option>            <option>1981</option>            <option>1980</option>            <option>1979</option>            <option>1978</option>            <option>1977</option>            <option>1976</option>            <option>1975</option>            <option>1974</option>            <option>1973</option>            <option>1972</option>            <option>1971</option>     <option>1970</option>            <option>1969</option>            <option>1968</option>            <option>1967</option>            <option>1966</option>            <option>1965</option>            <option>1964</option>            <option>1963</option>            <option>1962</option>            <option>1961</option>
      </select>
      </form>
    </td>
    </tr>
    <tr style="background-color: #FF9; height:20px">
<form action="eventEdit.php" method="get">
<!--<table style="background-color:#096" width="100%" border="0" cellspacing="0" cellpadding="0">-->
  <tr style="background-color:#093">
    <td>Pretraga po id broju<td width="65"></td>
    <td width="300"><input type="text" name="id" />
</td>
    <td>
      <input name="submit" type="submit" value="Tra&#382;i" /></td>
  </tr>
  </form>
    </tr>
    
    
    
    
    </tbody>

</table>
<p>*moguće je izvršiti pretragu po <br />
  1) ključnoj reči sa izborom gde se pojavljuje reč (tekst, naslov...) <br />
  2) po mesecu, odnosno mogu se izlistati svi događaji iz određenog meseca<br />
  3) ključnoj reči sa izborom meseca i godine kada se pojavljuje ta reč<br />
  4) po ID broju
  <br />
  <br />
<a href="adminIndex.php">Glavni meni</a>
</p>
</form>
</div>
</body>
</html>
