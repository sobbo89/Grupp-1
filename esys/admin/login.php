<?php
error_reporting(E_ALL ^E_WARNING ^E_NOTICE ^E_DEPRECATED);

if($_POST['username']) $username = $_POST['username']; else $username = null;
if($_POST['password']) $password = $_POST['password']; else $password = null;

//////////////////////////////////////
// DB CONNECT
///////////////////
// connect to MySQL
$connect = mysql_connect("161.97.144.27:8016", "root", "skairyprairy") or die (mysql_error());
//$connect = mysql_connect("localhost", "whatfor_phpesp", "3nk4t3r") or die (mysql_error());
// set charset for connection
mysql_set_charset("UTF8", $connect);
// select db
mysql_select_db("whatfor_phpesp18");
// remote:
// set text encoding 
mysql_query("SET NAMES utf8");
//////////////////////////////////////

if($username AND $password){ 
$results = mysql_query("SELECT * FROM coachtabell WHERE coachlogin = '".$username."' AND coachlosen = '".$password."'") or die(mysql_error());
$rows=mysql_fetch_array($results);
extract($rows);
	if(($coachlogin AND $coachlosen) AND ($coachlogin = $username AND $coachlosen = $password)){ 
	setcookie('niana', $coachlogin.','.$coachlosen, time()+32400, '/', false, 0);
	}else{ $_SESSION['tries']++;
	}
}
usleep(500000);
header("location: index.php");
?>