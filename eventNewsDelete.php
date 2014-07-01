<?php
session_start();
if (!isset($_SESSION['user'])) {
	echo "Niste prijavljeni!<br />
 <a href='login.php'>Prijava</a>
<br />";
}
else{
$id = $_GET['idTabele'];
//konekcija sa bazom
require_once("database_connect.php");
//SQL izraz
$query = ("SELECT * FROM vesti WHERE (idTabele = $id)");
$result = mysql_query($query);
if(!$result){
	die ("Došlo je do greške prilikom pretrage!</br>
		 <a href='searchNews.php'>Povratak</a>");
}
$row = mysql_fetch_array($result);
$path1 = $row["slika"];
if($path1 != '0'){
unlink($path1);
}
$query2 ="DELETE FROM `vesti` WHERE (idTabele = $id);";
$result2 = mysql_query($query2);

if(!$result2){
	die ("Došlo je do greške prilikom brisanja!</br>
		 <a href='searchNews.php'>Povratak</a>");
}
/*$a = "Location: http://www.dksg.rs/searchNews.php";
header( "$a" ) ;
*/
}

?>
