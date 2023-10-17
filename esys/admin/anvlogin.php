<?php
//die(header("location: ../index.php"));
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


if($_POST['username']) $p_username = $_POST['username']; else $p_username = null;
if($_POST['password']) $p_password = $_POST['password']; else $p_password = null;
if($_POST['GruppID']) $p_GruppID = $_POST['GruppID']; else $p_GruppID = null;

// //////////////////////////////////////
// // DB CONNECT
// ///////////////////
// // connect to MySQL
// $connect = mysql_connect("localhost", "whatfor_phpesp", "3nk4t3r") or die (mysql_error());
// // select db
// mysql_select_db("whatfor_phpesp18");
// // remote:
// // set text encoding 
// mysql_query("SET NAMES utf8");
// //////////////////////////////////////
include "inc/db.inc.php";

if($p_username AND $p_password AND $p_GruppID){ 
$results = mysql_query("SELECT r.username, g.grupplosen FROM respondent r, grupptabell g WHERE r.GruppID = g.id AND g.id = $p_GruppID AND g.grupplosen = '$p_password' AND r.username = '$p_username'") or die(mysql_error());
$rows = mysql_fetch_array($results);
extract($rows);
	if(($username AND $grupplosen) AND ($username = $p_username AND $grupplosen = $p_password)){ 
	setcookie('niananv', $username.','.$grupplosen.','.$p_GruppID, time()+32400, '/', false, 0);
	usleep(500000);
	header("location: index.php");
	die();
	}else{ $_SESSION['tries']++; 
	}
}
header("location: ../index.php");
?>