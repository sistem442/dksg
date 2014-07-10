<?php
//$con = mysql_connect("db3.cpanelhosting.rs","dksg_3120","promenime123");
$con = mysql_connect('127.0.0.1','boris','fubar.909');
mysql_select_db("dksg_3120", $con);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET COLLATION_CONNECTION='utf8_slovenian_ci'");
$mysqli = new mysqli('p:'."localhost", "boris", "fubar.909", "dksg_3120");
//hosting
//$mysqli = new mysqli("db3.cpanelhosting.rs", "dksg_3120", "promenime123", "dksg_3120");

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
$mysqli->real_query("SET NAMES utf8");
$mysqli->real_query("SET CHARACTER SET utf8");
$mysqli->real_query("SET COLLATION_CONNECTION='utf8_slovenian_ci'");
?>
