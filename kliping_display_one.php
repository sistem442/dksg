
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title>Press kliping Dom Kulture Studentski grad</title>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<?php
require_once("database_connect.php");

$id = $_GET['id'];
$query = ("SELECT * FROM kliping WHERE (id = $id);");
				 //echo "$query<br />";
$result = mysql_query($query);
if(mysql_num_rows($result)==0){
	die ("Došlo do greške prilikom pristupa tabeli kliping, obavestite sistem inzenjera");
	}
$row = mysql_fetch_array($result);
if($row['flag'] == 'slika'){
	echo "<img src=".$row['slika'].">";
	}
	else echo $row['sadrzaj'];


?>
</body>
</html>
