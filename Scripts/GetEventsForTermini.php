<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<html xmlns:fb="http://ogp.me/ns/fb#">
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
//get the q parameter from URL
$month = $_GET["month"];
$year = $_GET["year"];
//konekcija sa bazom
require_once("../database_connect.php");

//izmeni komentar u bazi
$query = "Select * FROM event WHERE mesec=".$month." AND godina=".$year." ;";
echo $query;
$result = mysql_query($query) or die('greska');
$mysqli_termini = new mysqli('p:'."localhost", "boris", "fubar.909", "termini");
//hosting
//$mysqli = new mysqli("db3.cpanelhosting.rs", "dksg_3120", "promenime123", "dksg_3120");

if ($mysqli_termini->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
$mysqli_termini->real_query("SET NAMES utf8");
$mysqli_termini->real_query("SET CHARACTER SET utf8");
$mysqli_termini->real_query("SET COLLATION_CONNECTION='utf8_slovenian_ci'");
while($row = mysql_fetch_array($result)){
    $datum = $row['datum'];
    $date["year"] = substr($datum, 0, 4);
    $date["month"] = substr($datum, 4,2);
    $date["day"] = substr($datum, 6);
    $date2 = $date["year"].'-'.$date["month"].'-'.$date["day"];
    
    echo "</br>";
    echo "datum prvi deo: ".$date['year']."</br>";
    echo "datum drugi deo: ".$date['month']."</br>";
    echo "treci prvi deo: ".$date['day']."</br>";
    
    $query = "INSERT INTO `termini`.`Event` (`name`, `date`, `location`, `time`, `remark`, `redaction`) 
        VALUES ('".$row['imePrograma']."', '".$date2."', '".$row['mesto']."', '".$row['time']."', '".$row['napomene']."', '".$row['program']."')";
    echo $query."</br>";
    $mysqli_termini->query($query);
}
	/*echo "
		
	
		<tr>
			  <td width='70px'>
			  ";
			  echo "<span style='font-size:10px;'>".($row['datum'].". ".$row['mesec'].". ".$row['dan']."</span> </td>
			  	<td width='100px' style='text-align:left; font-size:10px;'> <div style='width:80px'>".$row['program']."</div></td>
			  	<td width='250px'>
					<a href='#' OnClick = 'otvori_kliping(".$row['id'].")'><u>".$row['imePrograma']."</u></a></td>
			  	<td width='250px'> 
					<u>".$row['napomene']."</u></a></td>
		</tr>
		<tr><td colspan =4><hr/></td></tr>
");
    }
	echo "</table>";*/

?>
