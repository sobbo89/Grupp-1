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

//error_reporting(0);
session_start();
if($_GET['action'] == 'csvexport'){
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/download");
header("Content-type: application/vnd.ms-excel");
//header("Content-type: text/plain; charset=ISO-8859-1");
header("Content-disposition: attachment;filename=".$_SESSION['csv']['filename'].".csv");
ob_clean();
if($_GET['csvmode'] == 'nstat') nstat_csv(amchartarr($_SESSION['csv']['query'],$_SESSION['csv']['amgraphs'],$_SESSION['csv']['tillfallestart'],$_SESSION['csv']['tillfallestopp']),$_SESSION['csv']['vocab'],$_SESSION['csv']['calctype']);
else csv_export($_SESSION['csv']['query'],$_SESSION['csv']['filename'],$_SESSION['csv']['table_column_names'],$_SESSION['csv']['csv_column_names'],$_SESSION['csv']['split_name']);
}

$_SESSION['csv'] = array();

//////////////////////////////////////
// AUTHENTICATION
///////////////////

//session_start();

unset($_SESSION['tries']);
$_SESSION['ulvl'] = 0;

$autho = explode(",", $_COOKIE["niana"]);

if(!($autho[0]) OR !($autho[1])){
$_SESSION['authorized'] = 0;
$autho = explode(",", $_COOKIE["niananv"]);
	if($autho[0] AND $autho[1] AND $autho[2]){
$_SESSION['authorized'] = 0;
$results = mysql_query("SELECT * FROM respondent r, grupptabell g WHERE r.GruppID = g.id AND g.id = ".$autho[2]." AND g.grupplosen = '".$autho[1]."' AND r.username = '".$autho[0]."'") or die(mysql_error());
$getuser = mysql_fetch_array($results);
$numrows = mysql_num_rows($results);
if($numrows < 1) header("location: ../index.php");
$_SESSION['anv'] = $getuser[0];
$_SESSION['ulvl'] = 1;
$_SESSION['authorized'] = 1;
	}else{
	$autho = explode(",", $_COOKIE["nianachef"]);
		if($autho[0] AND $autho[1]){
		$results = mysql_query("SELECT * FROM cheftabell WHERE cheflogin = '".$autho[0]."' AND cheflosen = '".$autho[1]."'") or die(mysql_error());
		$rows=mysql_fetch_array($results);
		extract($rows);
		$numrows = mysql_num_rows($results);
		if($numrows < 1) header("location: ../login/index.php");
		$_SESSION['chef'] = $id;
		$_SESSION['ulvl'] = $ulvl;
		$_SESSION['authorized'] = 1;
		}
	}
}elseif($autho[0] AND $autho[1]){
$_SESSION['authorized'] = 0;
$results = mysql_query("SELECT * FROM coachtabell WHERE coachlogin = '".$autho[0]."' AND coachlosen = '".$autho[1]."'") or die(mysql_error());
$rows=mysql_fetch_array($results);
extract($rows);
	if(($coachlogin AND $coachlosen) AND ($coachlogin = $autho[0] AND $coachlosen = $autho[1])){ 
		$_SESSION['coach'] = $id;
		$_SESSION['ulvl'] = $ulvl;
		$results = mysql_query("SELECT GruppID FROM coachXgruppTabell WHERE CoachID = '".$_SESSION['coach']."'") or die(mysql_error());
			while ($rows=mysql_fetch_array($results)) { 
			$output .= $rows[0].',';
			}
		$_SESSION['authory'] = $output;	
		$_SESSION['authorized'] = 1;
	}else{
	$_SESSION['authorized'] = 0;
		if($_SESSION['tries'] < 5){ $_SESSION['tries']++; login();
		}else{ logout(3); 
		}
	}
}else{
	$_SESSION['authorized'] = 0;
	if($_SESSION['tries'] < 9){ $_SESSION['tries']++; login();
	}else{ logout(3); 
	}
}

//////////////////////////////////////


//////////////////////////////////////
// DEFAULTS
///////////////////
$lang = '';
// remote
$base = 'http://www.whatform.se/niana_esys/'; 
// local
//$base = 'http://mb.local/~B/niana_esys/'; 
// only the plot functions that need this so far. 
// Another special need for the plot is that it needs register globals on - set in only that directory using htaccess. Both these dependancies can be fixed.
//////////////////////////////////////


//////////////////////////////////////
// GET FUNCTIONS
///////////////////
// functions
function login($username = null,$password = null){
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<head>
<title>Antingen login</title>
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body id="adminlogin">
<form name="login" method="post" action="login.php">
<fieldset id="admlogin"><legend><img src="../dimg/logga_84x29.png"/></legend>
<table id="logintable" border="0"><tr><td valign="top">
<label for="username">Anv&auml;ndarnamn:</label><br/><br/>
<label for="password">L&ouml;senord:</label>
</td><td valign="top">
<input type="text" name="username"/><br/>
<input type="password" name="password"/><br/>
<input type="submit" class="submit" onclick="document.login.submit()" value="Logga in"/><br/><br/>
</td></tr></table>
</fieldset>
</form>
</body>
</html>
';
exit;
}

function logout($kind){
header("location: logout.php");
exit;
}

function format_date($sqldate){
if($sqldate) return date("Y.m.d", strtotime($sqldate));
}

function quote_smart($value)
{
   // Stripslashes
   if (get_magic_quotes_gpc()) {
       $value = stripslashes($value);
   }
   // Quote if not a number or a numeric string
   if (!is_numeric($value)) {
       $value = "'" . mysql_real_escape_string($value) . "'";
   }
   return $value;
}

function filepreview($dir, $file, $area){
	if($file){
	$img_exts = array("gif", "jpg", "png", "bmp", "jpe", "jpeg");
	$dir = '../'.$dir.'/';
	$magick_dir = '../magick.php/';
	$file_ext = end(explode(".",$file));
	if(in_array(strtolower($file_ext), $img_exts)){ $result = "<img name=\"".$area."_cell\" src=\"".$magick_dir.$file."?resize(135x150)\">"; }
	elseif(strtolower($file_ext) == "mov"){ $result = "<object CLASSID=\"clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B\" width=\"176\" height=\"160\" codebase=\"http://www.apple.com/qtactivex/qtplugin.cab#version=6,0,2,0\"> <param name=\"src\" value=\"".$dir.$file."\"><param name=\"controller\" value=\"true\"><param name=\"autostart\" value=\"false\"><param name=\"name\" value=\"".$area."_cell\"><param name=\"bgcolor\" value=\"WHITE\"> <embed width=\"176\" height=\"160\" controller=\"true\" autostart=\"false\" src=\"".$dir.$file."\" type=\"video/quicktime\" name=\"".$area."_cell\" bgcolor=\"WHITE\"></embed> </object>"; }
	elseif(strtolower($file_ext) == "mp3"){ $result = "<embed width=\"176\" height=\"16\" name=\"".$area."_cell\" src=\"".$dir.$file."\" type=\"audio/mpeg\" autoplay=\"false\" controller=\"true\" bgcolor=\"WHITE\">"; }
	elseif(strtolower($file_ext) == "swf"){ $result = "<embed width=\"176\" height=\"144\" name=\"".$area."_cell\" src=\"".$dir.$file."\" type=\"application/x-shockwave-flash\" quality=\"high\" bgcolor=\"WHITE\">"; }
	elseif(strtolower($file_ext) == "flv"){ $result = "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0\" width=\"176\" height=\"144\" id=\"FLVPlayer\"> <param name=\"movie\" value=\"FLVPlayer_Progressive.swf\" /> <param name=\"salign\" value=\"lt\" /> <param name=\"quality\" value=\"high\" /> <param name=\"scale\" value=\"noscale\" /> <param name=\"name\" value=\"".$area."_cell\"> <param name=\"bgcolor\" value=\"WHITE\"> <param name=\"FlashVars\" value=\"&MM_ComponentVersion=1&skinName=Clear_Skin_1&streamName=".$dir.$file."&autoPlay=false&autoRewind=false\" /> <embed src=\"FLVPlayer_Progressive.swf\" flashvars=\"&MM_ComponentVersion=1&skinName=Clear_Skin_1&streamName=".$dir.$file."&autoPlay=false&autoRewind=false\" quality=\"high\" scale=\"noscale\" width=\"176\" height=\"144\" name=\"FLVPlayer\" salign=\"LT\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </object>"; }
	else{ $result = "<a href=\"".$dir.$file."\" target=\"_blank\"><img name=\"".$area."_cell\" src=\"img/".$file_ext.".gif\" border=\"0\"> ".$file."</a>"; }
	} else { $result = "<img name=\"".$area."_cell\" src=\"img/blank.gif\">"; }
	return $result;
}


function graphnamegate($gatename,$imagepath,$gQuestion = null){
include "graphs/".$gatename;
return $imagepath;
}

// CSV EXPORT
//* At the end of the function it executes the export, so no headers can be called prior to this function
//* Usage example:
//* $columns = "Name,Mail,Url";
//* $query = "SELECT $columns FROM reg_data";
//* $filename = "export";
//* $filename = $filename."_".date("Y-m-d_H-i");
//* csv_export($query,$filename,$table_column_names,[$csv_column_names,$split_name,$delimiter]);
//*
function csv_export($query,$filename,$column_headers,$column_names = null,$split_name = null,$delimiter = "\t"){
if(!$column_names) $column_names = $column_headers;
$column_names_arr = explode(',',$column_names);
$column_headers_arr = explode(',',$column_headers);
foreach($column_names_arr as $column){
$output .= $column.$delimiter;
}
$output = rtrim($output,$delimiter);
$output .= "\r\n";
$results = mysql_query($query);
while($rows= mysql_fetch_assoc($results)){
foreach($column_headers_arr as $column){
	if($split_name and $column == $split_name){
		$namearr = splitname($rows[$column]);
		$output .= $namearr['first'].$delimiter;
		$output .= $namearr['last'].$delimiter;
	}else{
		$output .= $rows[$column].$delimiter;
	}
}
$output = rtrim($output,$delimiter);
$output .= "\r\n";
}
print utf8_decode($output);
die();
}

function splitname($str){
$arr = explode(" ",$str);
$name['last'] = array_pop($arr);
$name['first'] = implode(" ",$arr);
return $name;
}

// interpolate an array ($arr) to input value ($par) between array values
function weigh($arr,$par){
ksort($arr);
foreach($arr as $key => $val){
	if($key == $par) return $val;
	if($key > $par){
		$botval = $preval + (($preval/$par)-($preval/$prekey));
		$topval = $val + (($val/$par)-($val/$key));
		for ($i = $prekey; $i <= $key; $i++) {
			if($par == $i){
				$steps_done_percent = ($i - $prekey) / ($key - $prekey);
				$steps_left_percent = ($key - $prekey - ($i - $prekey)) / ($key - $prekey);	
				$parval = ($steps_left_percent * $botval) + ($steps_done_percent * $topval);
				}
			}
		return round($parval,2);
		}
	$preval = $val;
	$prekey = $key;
	}
}

function age_gate($year){
$thisyear = date("Y");
if(strlen($year) == 4){ 
	return $thisyear - $year;
}elseif(strlen($year) == 2){ 
	$age = $thisyear - (1900 + $year); 
	if($age > 14 and $age < 80){ 
		return $age;
	}else{ 
		$age = $thisyear - (2000 + $year);
		if($age > 14 and $age < 80){ 
			return $age;
		}else{
			return 0;
		}
	}
}
}


/*TESTVARDE*/
// weigh($datatables[$individ[$key]['watt'].'w'][$individ[$key]['kon']],$individ[$key]['puls']) * weigh($datatables['agecor'],$individ[$key]['alder']);
function testvarde($watt,$kon,$puls,$alder,$vikt){
include "datatables/astrand.inc";
$kon = ucfirst(substr($kon,0,1));
if($watt and $kon and $puls and $alder and $vikt) return round(( 1000 * ( weigh($datatables[$watt.'w'][$kon],$puls) * weigh($datatables['agecor'],age_gate($alder)) ) ) / $vikt,2);
else return null;
}


/* used in AMCHARTARR to get the number of items with a not-null-value in a single array */
function countnotnull($arr){
foreach($arr as $item) if($item > 0) $i++;
return $i;
}


/* used in nstat_csv to avoid passing zeroes to excel, thus making sure avg calculations work*/
function nullnil($val){
if($val <> 0) return $val; else return null;
}


/* AMCHARTARR - Make an organised array for amchart 
- Should be quite expandable since any amount of graphs and calculated elements can be added
- No errors, all non values and failures result in null
$chart['graph'][tillfalle]	['values']	[] = each value
							['sum']		= array_sum($chart['graph'][tillfalle]['values']);
							['divisor']	= array_count($chart['graph'][tillfalle]['values']);
							['mean']	= $chart['graph'][tillfalle]['sum'] / $chart['graph'][tillfalle]['divisor'];
*/
function amchartarr($query,$graphs = array(),$tillfallestart = null,$tillfallestopp = null){
$results = mysql_unbuffered_query($query);
if(!$results) return false;
// db loop
while($rows=mysql_fetch_assoc($results)){
if($rows['Tillfalle'] >= $tillfallestart or !$tillfallestart){
if($rows['Tillfalle'] <= $tillfallestopp or !$tillfallestopp){
// anvid
	if($graphs['anvid']) $chart['anvid'][$rows['Tillfalle']]['values'][] = $rows['AnvID'];
// anvnamn
	if($graphs['anvnamn']) $chart['anvnamn'][$rows['Tillfalle']]['values'][] = $rows['Anvnamn'];
// testvärde
	if($graphs['testvarde']){
		$testvalue = testvarde($rows['f11'],$rows['kon'],$rows['f12'],$rows['ar'],$rows['f13']);
		if($testvalue > 0) $chart['testvarde'][$rows['Tillfalle']]['values'][] = $testvalue; else $chart['testvarde'][$rows['Tillfalle']]['values'][] = null;
	}
// testvärde - testvärden över eller lika med 35
	if($graphs['testvarde35over']){
		$testvalue = testvarde($rows['f11'],$rows['kon'],$rows['f12'],$rows['ar'],$rows['f13']);
		if($testvalue > 34) $chart['testvarde35over'][$rows['Tillfalle']]['values'][] = $testvalue; else $chart['testvarde35over'][$rows['Tillfalle']]['values'][] = null;
	}
// testvärde - testvärden under 35
	if($graphs['testvarde35under']){
		$testvalue = testvarde($rows['f11'],$rows['kon'],$rows['f12'],$rows['ar'],$rows['f13']);
		if($testvalue < 35) $chart['testvarde35under'][$rows['Tillfalle']]['values'][] = $testvalue; else $chart['testvarde35under'][$rows['Tillfalle']]['values'][] = null;
	}
// core index
	if($graphs['core']){
		$corevalue = ( ( $rows['f1']+$rows['f2']+$rows['f3']+$rows['f4']+$rows['f5']+$rows['f6'] ) / 6 ) or $corevalue = null;
		if($corevalue > 0) $chart['core'][$rows['Tillfalle']]['values'][] = $corevalue; else $chart['core'][$rows['Tillfalle']]['values'][] = null;
	}
// fys index
	if($graphs['fys']){
		$fysvalue = ( ( $rows['f7']+$rows['f8']+$rows['f9']+$rows['f10'] ) / 4 ) or $fysvalue = null;
		if($fysvalue > 0) $chart['fys'][$rows['Tillfalle']]['values'][] = $fysvalue; else $chart['fys'][$rows['Tillfalle']]['values'][] = null;
	}
// frisk
	if($graphs['frisk']){
	if($rows['f1'] >= 5 and $rows['f2'] >= 5 and $rows['f3'] >= 5) $chart['frisk'][$rows['Tillfalle']]['values'][] = 1;
	else $chart['frisk'][$rows['Tillfalle']]['values'][] = null;
	}
// risk	
	if($graphs['risk']){
	if((($rows['f1'] + $rows['f2'] + $rows['f3']) > 0) and ($rows['f1'] < 5 or $rows['f2'] < 5 or $rows['f3'] < 5)) $chart['risk'][$rows['Tillfalle']]['values'][] = 1;
	else $chart['risk'][$rows['Tillfalle']]['values'][] = null;
	}
// f1-f13
	for($n = 1; $n <= 13; $n++){
		if($graphs['f'.$n]){
			$chart['f'.$n][$rows['Tillfalle']]['values'][] = $rows['f'.$n] or $chart['f'.$n][$rows['Tillfalle']]['values'][] = null;
		}
	}
// antal (livsstil ID)
	if($graphs['antal'] and $rows['lID']) $chart['antal'][$rows['Tillfalle']]['values'][] = 1;
// kön
	if($graphs['kon']) $chart['kon'][$rows['Tillfalle']]['values'][] = $rows['kon'];
// ålder
	if($graphs['ar']) $chart['ar'][$rows['Tillfalle']]['values'][] = age_gate($rows['ar']);
// watt
	if($graphs['watt']) $chart['watt'][$rows['Tillfalle']]['values'][] = $rows['f11'];
// puls
	if($graphs['puls']) $chart['puls'][$rows['Tillfalle']]['values'][] = $rows['f12'];
// vikt
	if($graphs['vikt']) $chart['vikt'][$rows['Tillfalle']]['values'][] = $rows['f13'];
} // end if tillfallestop
} // end if tillfallestart
} // end db loop
// calculations loop
foreach($chart as $key => $value){
foreach($value as $key2 => $value2){
$chart[$key][$key2]['sum'] = array_sum($chart[$key][$key2]['values']) or $chart[$key][$key2]['sum'] = null;
$chart[$key][$key2]['divisor'] = countnotnull($chart[$key][$key2]['values']) or $chart[$key][$key2]['count'] = null;
$chart[$key][$key2]['mean'] = round($chart[$key][$key2]['sum'] / $chart[$key][$key2]['divisor'],2) or $chart[$key][$key2]['mean'] = null;
// friskriskdiff (v1)
/*
if($graphs['friskriskdiff'] and $chart['risk'][$key2]['sum'] and $chart['frisk'][$key2]['sum']){
$chart['friskriskdiff'][$key2]['sum'] = $chart['frisk'][$key2]['sum'] - $chart['risk'][$key2]['sum'];
}
*/
// friskriskdiff (v2)
if($graphs['friskriskdiff']){
$chart['friskriskdiff'][$key2]['sum'] = $chart['risk'][$key2]['sum'] - $chart['frisk'][$key2]['sum'] or $chart['friskriskdiff'][$key2]['sum'] = null;
}
} // end calcloop 2
} // end calcloop
return $chart;
}


/* AMCHARTXML - Parse chart array into xml for amchart*/
function amchartxml($chart, $vocab = array(), $style = array(), $calctype = array(), $compactxml = true){
if(!$chart) return false;
$i = 0;
// loop
foreach($chart as $key => $value){
if(!$calctype['graph'][$key]) $calctype['graph'][$key] = 'mean'; // default calctype (mean or sum) behaviour
$graphs .= "\t\t".'<graph title="'.$vocab['graph'][$key]['title'].'" '.$style['graph'][$key]['tagparams'].'>'."\n";
$i2 = 0;
foreach($value as $key2 => $value2){
if($i < 1) $series .= "\t\t".'<value xid="'.$i2.'">'.$vocab['series']['label'].' '.($i2+1).'</value>'."\n";

// replacing null with 0.01 if calctype is sum (quick avoiding null fix part 1)
if( !$chart[$key][$key2][$calctype['graph'][$key]] and $calctype['graph'][$key] == 'sum' ) $chart[$key][$key2][$calctype['graph'][$key]] = 0.01;


// experimental interpolation (if there are two good values other values can be interpolated)
// 1) if [T] is null but [T-1] and [T+1] is not null, T = ( [T-1] + [T+1] ) / 2
if( !$chart[$key][$key2][$calctype['graph'][$key]] and $chart[$key][$key2+1][$calctype['graph'][$key]] and $chart[$key][$key2-1][$calctype['graph'][$key]] ){
	$chart[$key][$key2][$calctype['graph'][$key]] = ( $chart[$key][$key2+1][$calctype['graph'][$key]] + $chart[$key][$key2-1][$calctype['graph'][$key]] ) / 2;


// 2) if [T] is null but [T+1] and [T+2] is not null, T = [T+1] - ( [T+2] - [T+1] )
}elseif( !$chart[$key][$key2][$calctype['graph'][$key]] and $chart[$key][$key2+1][$calctype['graph'][$key]] and $chart[$key][$key2+2][$calctype['graph'][$key]] ){
	$chart[$key][$key2][$calctype['graph'][$key]] = $chart[$key][$key2+1][$calctype['graph'][$key]] - ( $chart[$key][$key2+2][$calctype['graph'][$key]] - $chart[$key][$key2+1][$calctype['graph'][$key]] );

	// 2b) but if [T] > [T+1] then [T] = [T+1]
	if( $chart[$key][$key2][$calctype['graph'][$key]] > $chart[$key][$key2+1][$calctype['graph'][$key]] ) $chart[$key][$key2][$calctype['graph'][$key]] = $chart[$key][$key2+1][$calctype['graph'][$key]];


// 3) if [T] is null but [T-1] and [T-2] is not null, T = [T-1] + ( [T-1] - [T-2] )
}elseif( !$chart[$key][$key2][$calctype['graph'][$key]] and $chart[$key][$key2-1][$calctype['graph'][$key]] and $chart[$key][$key2-2][$calctype['graph'][$key]] ){
	$chart[$key][$key2][$calctype['graph'][$key]] = $chart[$key][$key2-1][$calctype['graph'][$key]] + ( $chart[$key][$key2-1][$calctype['graph'][$key]] - $chart[$key][$key2-2][$calctype['graph'][$key]] );
	
	// 3b but if [T] < [T-1] then [T] = [T-1]
	if( $chart[$key][$key2][$calctype['graph'][$key]] < $chart[$key][$key2-1][$calctype['graph'][$key]] ) $chart[$key][$key2][$calctype['graph'][$key]] = $chart[$key][$key2-1][$calctype['graph'][$key]];
}


// end experimental interpolation


// replacing 0.01 with 0 (quick avoiding null fix part 2)
if( $chart[$key][$key2][$calctype['graph'][$key]] == 0.01 ) $chart[$key][$key2][$calctype['graph'][$key]] = 0;

$graphs .= "\t\t\t".'<value xid="'.$i2.'">'.$chart[$key][$key2][$calctype['graph'][$key]].'</value>'."\n";
$i2++;
}
$graphs .= "\t\t".'</graph>'."\n";
$i++;
}
// put it together
$output = "<chart>\n\t<series>\n".$series."\t</series>\n\t<graphs>\n".$graphs."\t</graphs>\n</chart>";
// compact?
if($compactxml){
$output = str_replace("\"","'", $output);
$output = str_replace("\n","", $output);
$output = str_replace("\t","", $output);
}
return $output;
}


/* NSTAT_CSV - Parse amchartarr into cvs*/
function nstat_csv($chart, $vocab = array(), $calctype = array(), $delimiter = "\t"){
//print_r($vocab);
if(!$chart) return false;
// content
foreach($chart as $ckey => $graph){ // loop 1
//echo 'ckey: '.$ckey."\n";
if(!$calctype['graph'][$ckey]) $calctype['graph'][$ckey] = 'mean'; // default calctype (mean or sum) behaviour
	foreach($graph as $gkey => $tillf){ // loop 2
//echo 'gkey: '.$gkey."\n";
//echo 'graphtitle: '.$vocab['graph'][$ckey]['title']."\n";
	$output[$gkey] .= $gkey.$delimiter.$vocab['graph'][$ckey]['title'].$delimiter.$chart[$ckey][$gkey][$calctype['graph'][$ckey]].$delimiter.$delimiter.$gkey.$delimiter.$vocab['graph'][$ckey]['title'].$delimiter;
		foreach($tillf as $tkey => $value){ // loop 3
//echo 'tkey: '.$tkey."\n";
			foreach($value as $vkey => $singleval){ // loop 4
//echo 'vkey: '.$vkey."\n";
			$output[$gkey] .= nullnil($singleval).$delimiter;
			} // end loop 4
		} // end loop 3
	$output[$gkey] = rtrim($output[$gkey],$delimiter)."\r\n"; // line end
	} // end loop 2
} // end loop 1
$output[$gkey] = rtrim($output[$gkey],$delimiter)."\r\n"; // line end
// put it in order by tillfalle
foreach($output as $tillf){
$ordered .= 'Tillfälle'.$delimiter.'Variabel'.$delimiter.'Medel:'.$delimiter.$delimiter.'Tillfälle'.$delimiter.'Variabel'.$delimiter.'Individer:'."\r\n"; // headlines
$ordered .= $tillf; // content
$ordered .= "\r\n";
}
// output it
print utf8_decode($ordered);
die();
}


// db loop
include "show.inc";
// db stats
include "stats.inc";
//////////////////////////////////////
?>