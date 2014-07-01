<?php
require_once("database_connect.php");
$mesec = date('n');
$godina = date('Y');
$query = ("SELECT * FROM advertisement WHERE ((mesec < $mesec AND godina = $godina) || godina < $godina);");
$result = mysql_query($query);
while($row = mysql_fetch_array($result)){
	//brisanje slike iz foldera
	$query1 = "SELECT path FROM advertisement WHERE id=".$row['id'].";";
	$result1 = mysql_query($query1);
	$row1 = mysql_fetch_array($result1);
	$path1 = $row1["path"];
	if($path1 != '0'){
		unlink($path1);
	}
	//brisanje iz tabele slajd
	$query2 ="DELETE FROM `advertisement` WHERE (id = ".$row['id'].");";
	$result2 = mysql_query($query2);
}