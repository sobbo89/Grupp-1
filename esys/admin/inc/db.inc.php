<?php
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
?>