<?php
session_start();
if (!isset($_SESSION['user'])) {
	echo "Niste prijavljeni!<br />
 <a href='login.php'>Prijava</a>
<br />";
}
$parameter = mysql_real_escape_string(trim($_POST["parameter"]));
$value = mysql_real_escape_string(trim($_POST["value"]));
include ("class_lib.php");
$search_result = new search_result($parameter,$value);
$result=$search_result->get_search_result();
if(!is_resource($result)) echo "Ne postoji razlutat za zadati parametar";
?>
