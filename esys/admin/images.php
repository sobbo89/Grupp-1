<?PHP

error_reporting(E_ALL ^E_WARNING ^E_NOTICE ^E_DEPRECATED);
//error_reporting(0);

function fnameconv($str){
$str = trim($str);
$str = trim($str,"_");
$str = str_replace(',', '-', $str);
$str = str_replace('  ', '_', $str);
$str = str_replace(' ', '_', $str);
$str = str_replace('Ü', 'U', $str);
$str = str_replace('Å', 'A', $str);
$str = str_replace('Ä', 'A', $str);
$str = str_replace('Ö', 'O', $str);
$str = str_replace('ü', 'u', $str);
$str = str_replace('å', 'a', $str);
$str = str_replace('ä', 'a', $str);
$str = str_replace('ö', 'o', $str);
$str = str_replace(',', '_', $str);
$str = str_replace('%', '-', $str);
$str = str_replace('?', '-', $str);
$str = str_replace('#', '-', $str);
$str = str_replace('&', '-', $str);
$str = str_replace('+', '-', $str);
$str = str_replace('–', '-', $str);
$str = str_replace('—', '-', $str);
$str = str_replace('(', '-', $str);
$str = str_replace(')', '-', $str);
$str = str_replace('[', '-', $str);
$str = str_replace(']', '-', $str);
$str = str_replace('<', '-', $str);
$str = str_replace('>', '-', $str);
$str = str_replace('"', '', $str);
$str = str_replace('\'', '', $str);
$str = str_replace('”', '', $str);
$str = str_replace('´', '', $str);
$str = str_replace('`', '', $str);
$str = str_replace('\\', '', $str);
return $str;
}

// empty some stings (in case that pesky reg glob is on..)
$file = null;
$file_name = null;
$file_size = null;
$file_error = null;

//////////////////////////////////////
// COLLECT QUERY STRINGS
///////////////////
if($_GET['action']) $action = $_GET['action']; else $action = null;
if($_GET['basedir']) $basedir = $_GET['basedir']; else $basedir = null;
if($_GET['directory']) $directory = $_GET['directory']; else $directory = null;
if($_GET['pre_cell']) $pre_cell = $_GET['pre_cell']; else $pre_cell = null;
if($_GET['area']) $area = $_GET['area']; else $area = null;
if($_GET['whatform']) $whatform = $_GET['whatform']; else $whatform = null;
if($_POST['subaction']) $subaction = $_POST['subaction']; else $subaction = null;
if($_POST['overwrite']) $overwrite = $_POST['overwrite']; else $overwrite = null;
//////////////////////////////////////

// extensions
$file_exts = array("mov", "mp3", "swf", "flv", "pdf", "doc", "xls", "ppt", "zip", "rtf");
$image_exts = array("gif", "jpg", "png", "bmp", "tif", "jpe", "jpeg");
$all_exts = array_merge($file_exts, $image_exts);

// ini_set for uploads
ini_set("upload_max_filesize","40M");
ini_set("post_max_size","40M");
ini_set("memory_limit","40M");
// html file upload max filesize
$MAX_FILE_SIZE = 40960000;

//if($_COOKIE["siteurl"]){
//$this_dir = $_COOKIE["siteurl"].$_COOKIE['basedir'].'/'.$directory.'/';
//$magick_dir = $_COOKIE["siteurl"].$_COOKIE['basedir'].'/magick.php/';
//}else{
$this_dir = '../'.$_COOKIE['basedir'].'/'.$directory.'/';
$magick_dir = '../'.$_COOKIE['basedir'].'/magick.php/';
//}
//echo $this_dir.'<br/>';
//echo $magick_dir;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="sv" />
<meta name="robots" content="noindex,nofollow" />
<title>webbutvecklarna : whatform : zedit 3.5 BETA</title>
<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
<script type="text/javascript">
function altaas(id){
 if(document.getElementsByTagName){  
   var div = document.getElementById(id);  
   var aas = div.getElementsByTagName("div");  
   for(i = 0; i < aas.length; i++){          
 //manipulate rows
     if(i % 2 == 0){
       aas[i].className = "evenaas";
     }else{
       aas[i].className = "oddaas";
     }      
   }
 }
}
</script>
</head>
<body onload="altaas('inscroll')">
<div id="imageswindow">

<?php

if($action == "getfile"){

if($subaction == "upload"){
        if(!$file) $file = fnameconv($_FILES['file']['tmp_name']);
        if(!$file_name) $file_name = fnameconv($_FILES['file']['name']);
        if(!$file_size) $file_size = $_FILES['file']['size'];
        if(!$file_error) $file_error = $_FILES['file']['error'];
        
        if($file_error > 0) include "inc/errors.inc";
        
        $file_name_arr = explode(".",$file_name);
		$file_ext = end($file_name_arr);
        
        if($file_name == "") $file_result = "<br/><font color=red>Ingen bild vald för uppladdning !!!</font>";
       	elseif(!$overwrite and file_exists($this_dir.$file_name)) $file_result = "<br/><font color=red>En bild med detta namn finns redan !!!</font>";
       	elseif(!in_array(strtolower($file_ext), $all_exts)) $file_result = "<br/><font color=red>Den här filtypen är inte tillåten !!!</font>";
       	else @copy($file, $this_dir.$file_name) or $file_result = "<font color=red>Uppladdningen misslyckades</font><br />".$file_error;
        
        if(!$file_result and file_error < 1 and file_exists($this_dir.$file_name)) { 
        	$file_result = "<font color=green>Uppladdningen klar</font>";
			if(in_array(strtolower($file_ext), $image_exts)){ $file_result .= '<div id="aasrow"><a title="Använd denna bild" href="javascript:opener.document.'.$pre_cell.'.src=\''.$magick_dir.$file_name.'?resize(135x150)\';opener.document.'.$whatform.'.'.$area.'.value=\''.$file_name.'\';window.close();"><img width="24" src="'.$magick_dir.$file_name.'?resize(32x24)" border="0"/> '.$file_name.' (klicka för att använda denna)</a></div>'; }
        	elseif(in_array(strtolower($file_ext), $file_exts)){ $file_result .= '<div id="aasrow"><a title="Använd denna fil" href="javascript:opener.document.'.$pre_cell.'.src=\'img/'.$file_ext.'.gif\';opener.document.'.$whatform.'.'.$area.'.value=\''.$file_name.'\';window.close();"><img width="24" src="img/'.$file_ext.'.gif" border="0"/> '.$file_name.' (klicka för att använda denna)</a></div>'; }
        	}
        }


echo '<b>Ladda upp fil</b>
<form enctype="multipart/form-data" action="?action='.$action.'&directory='.$directory.'&pre_cell='.$pre_cell.'&area='.$area.'&whatform='.$whatform.'" method="POST">
    <input type="hidden" name="subaction" value="upload"/>
    <input type="hidden" name="MAX_FILE_SIZE" value="'.$MAX_FILE_SIZE.'"/>
    <input name="file" type="file"/>
    <input type="submit" value="Ladda upp"/><br/>
    <div id="fileresult"><input type="checkbox" name="overwrite" value="1"/> Skriv över om filen redan finns? &nbsp; &nbsp; &nbsp;'.$file_result.'</div>
</form>
<div id="inscroll">
';

$file_dir = opendir($this_dir);

while ($file = readdir($file_dir)) { 
$files_in_dir[] = $file; 
}

natcasesort($files_in_dir);
reset($files_in_dir);

foreach ($files_in_dir as $file) { 
$file_name_arr = explode(".",$file);
$file_ext = end($file_name_arr);
$file_size = filesize($this_dir.$file);
$total_size += $file_size;
$file_size = round($file_size/1024,0);
if(in_array(strtolower($file_ext), $image_exts)){ echo '<div id="aasrow"><a title="Använd denna bild" href="javascript:opener.document.'.$pre_cell.'.src=\''.$magick_dir.$file.'?resize(135x150)\';opener.document.'.$whatform.'.'.$area.'.value=\''.$file.'\';window.close();"><img width="24" src="'.$magick_dir.$file.'?resize(32x24)" border="0"/> '.$file.'</a> ('.$file_size.'KB)</div>'; }
elseif(in_array(strtolower($file_ext), $file_exts)){ echo '<div id="aasrow"><a title="Använd denna fil" href="javascript:opener.document.'.$pre_cell.'.src=\'img/'.$file_ext.'.gif\';opener.document.'.$whatform.'.'.$area.'.value=\''.$file.'\';window.close();"><img width="24" src="img/'.$file_ext.'.gif" border="0"/> '.$file.'</a> ('.$file_size.'KB)</div>'; }
}
} // end getfile
?>
</div>
<div id="imagesfooter">
<?php
echo 'Använt utrymme i den här mappen: '.round($total_size/1024/1024,0).'MB';
?>
</div>
</div>
</body>
</html>