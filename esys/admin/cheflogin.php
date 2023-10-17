<?php
error_reporting(E_ALL ^E_WARNING ^E_NOTICE ^E_DEPRECATED);
session_start();
unset($_SESSION['authory']);
unset($_SESSION['coach']);
unset($_SESSION['chef']);
unset($_SESSION['anv']);
unset($_SESSION['ulvl']);
unset($_SESSION['authorized']);
$coachlogin = 'logged';
$coachlosen = 'out';
setcookie('niana', $coachlogin.','.$coachlosen, time()-3600, '/', false, 0);
setcookie('niananv', $coachlogin.','.$coachlosen.','.$coachlosen, time()-3600, '/', false, 0);
setcookie('nianachef', $coachlogin.','.$coachlosen, time()-3600, '/', false, 0);
usleep(500000);
setcookie("niana", '', time()-32400);
setcookie("niananv", '', time()-32400);
setcookie("nianachef", '', time()-32400);
usleep(500000);
$_SESSION = array();
session_unset();
session_destroy();

if($_POST['username']) $username = $_POST['username']; else $username = null;
if($_POST['password']) $password = $_POST['password']; else $password = null;

//////////////////////////////////////
// DB CONNECT
///////////////////
// connect to MySQL
$connect = mysql_connect("localhost", "whatfor_phpesp", "3nk4t3r") or die (mysql_error());
// select db
mysql_select_db("whatfor_phpesp18");
// remote:
// set text encoding 
mysql_query("SET NAMES utf8");
//////////////////////////////////////

if($username AND $password){ 
$results = mysql_query("SELECT * FROM cheftabell WHERE cheflogin = '".$username."' AND cheflosen = '".$password."'") or die(mysql_error());
$rows=mysql_fetch_array($results);
extract($rows);
	if(($cheflogin AND $cheflosen) AND ($cheflogin = $username AND $cheflosen = $password)){ 
	setcookie('nianachef', $cheflogin.','.$cheflosen, time()+32400, '/', false, 0);
	usleep(500000);
	header("location: index.php");
	die();
	}else{ $_SESSION['tries']++; 
	}
}
header("location: ../login/index.php");
?>