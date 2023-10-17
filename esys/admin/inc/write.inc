<?php
//////////////////////////////////////
// DB UPDATE QUERIES
///////////////////
//
if($action == "update" and $key and $cat_id == "15"){
$update_query = "UPDATE articles SET DATECHANGED = NOW()";
if($_POST['DATESTART']) $update_query .= ", DATESTART = ".quote_smart($_POST['DATESTART']);
if($_POST['DATESTOP']) $update_query .= ", DATESTOP = ".quote_smart($_POST['DATESTOP']);
if($_POST['Sort']) $update_query .= ", Sort = ".quote_smart($_POST['Sort']);
if($_POST['PARENT']) $update_query .= ", PARENT = ".quote_smart($_POST['PARENT']);
if($_POST['CATEGORY']) $update_query .= ", CATEGORY = ".quote_smart($_POST['CATEGORY']);
if($_POST['REL_1']) $update_query .= ", REL_1 = ".quote_smart($_POST['REL_1']);
if($_POST['REL_2']) $update_query .= ", REL_2 = ".quote_smart($_POST['REL_2']);
if($_POST['ARTNR']) $update_query .= ", ARTNR = ".quote_smart($_POST['ARTNR']);
if($_POST['title']) $update_query .= ", ".$lang."title = ".quote_smart($_POST['title']);
if($_POST['text_1']) $update_query .= ", ".$lang."text_1 = ".quote_smart($_POST['text_1']);
if($_POST['text_2']) $update_query .= ", ".$lang."text_2 = ".quote_smart($_POST['text_2']);
if($_POST['text_3']) $update_query .= ", ".$lang."text_3 = ".quote_smart(preg_replace("'\n'",'<br/>',$_POST['text_3']));
if($_POST['file_1']) $update_query .= ", file_1 = ".quote_smart($_POST['file_1']);
if($_POST['fileinfo_1']) $update_query .= ", fileinfo_1 = ".quote_smart($_POST['fileinfo_1']);
if($_POST['file_2']) $update_query .= ", file_2 = ".quote_smart($_POST['file_2']);
if($_POST['fileinfo_2']) $update_query .= ", fileinfo_2 = ".quote_smart($_POST['fileinfo_2']);
if($_POST['file_3']) $update_query .= ", file_3 = ".quote_smart($_POST['file_3']);
if($_POST['fileinfo_3']) $update_query .= ", fileinfo_3 = ".quote_smart($_POST['fileinfo_3']);
if($_POST['Author']) $update_query .= ", Author = ".quote_smart($_POST['Author']);
if($_POST['INVISIBLE']) $update_query .= ", INVISIBLE = ".quote_smart($_POST['INVISIBLE']);
if($_POST['FEATURE']) $update_query .= ", FEATURE = ".quote_smart($_POST['FEATURE']);
$update_query .= " WHERE ID = ".quote_smart($_POST['art_id']);
$update_query = sprintf($update_query);
//echo $update_query; die();
$result = mysql_query($update_query) or die(mysql_error());
$success = "<em>Changes saved in</em> \"".$_POST['title']."\"";
}elseif($_POST['action'] == "update" and (!$_POST['key'] or !$_POST['art_id'])){
logout(2);
}
//////////////////////////////////////


//////////////////////////////////////
// DB INSERT QUERIES
///////////////////
//
if($action == "insert" and $key and $cat_id == "15"){
$insert_query = "INSERT INTO articles VALUES(DEFAULT(ID), NOW(), DEFAULT(DATECHANGED)";
if($_POST['DATESTART']) $insert_query .= ", ".quote_smart($_POST['DATESTART']); else $insert_query .= ", DEFAULT(DATESTART)";
if($_POST['DATESTOP']) $insert_query .= ", ".quote_smart($_POST['DATESTOP']); else $insert_query .= ", DEFAULT(DATESTOP)";
if($_POST['Sort']) $insert_query .= ", ".quote_smart($_POST['Sort']); else $insert_query .= ", DEFAULT(Sort)";
if($_POST['PARENT']) $insert_query .= ", ".quote_smart($_POST['PARENT']); else $insert_query .= ", DEFAULT(PARENT)";
if($_POST['CATEGORY']) $insert_query .= ", ".quote_smart($_POST['CATEGORY']); else $insert_query .= ", DEFAULT(CATEGORY)";
if($_POST['REL_1']) $insert_query .= ", ".quote_smart($_POST['REL_1']); else $insert_query .= ", DEFAULT(REL_1)";
if($_POST['REL_2']) $insert_query .= ", ".quote_smart($_POST['REL_2']); else $insert_query .= ", DEFAULT(REL_2)";
if($_POST['ARTNR']) $insert_query .= ", ".quote_smart($_POST['ARTNR']); else $insert_query .= ", DEFAULT(ARTNR)";
if($_POST['title']) $insert_query .= ", ".quote_smart($_POST['title']); else $insert_query .= ", DEFAULT(".$lang."title)";
if($_POST['text_1']) $insert_query .= ", ".quote_smart($_POST['text_1']); else $insert_query .= ", DEFAULT(".$lang."text_1)";
if($_POST['text_2']) $insert_query .= ", ".quote_smart($_POST['text_2']); else $insert_query .= ", DEFAULT(".$lang."text_2)";
if($_POST['text_3']) $insert_query .= ", ".quote_smart(preg_replace("'\n'",'<br/>',$_POST['text_3'])); else $insert_query .= ", DEFAULT(".$lang."text_3)";
if($_POST['file_1']) $insert_query .= ", ".quote_smart($_POST['file_1']); else $insert_query .= ", DEFAULT(file_1)";
if($_POST['fileinfo_1']) $insert_query .= ", ".quote_smart($_POST['fileinfo_1']); else $insert_query .= ", DEFAULT(fileinfo_1)";
if($_POST['file_2']) $insert_query .= ", ".quote_smart($_POST['file_2']); else $insert_query .= ", DEFAULT(file_2)";
if($_POST['fileinfo_2']) $insert_query .= ", ".quote_smart($_POST['fileinfo_2']); else $insert_query .= ", DEFAULT(fileinfo_2)";
if($_POST['file_3']) $insert_query .= ", ".quote_smart($_POST['file_3']); else $insert_query .= ", DEFAULT(file_3)";
if($_POST['fileinfo_3']) $insert_query .= ", ".quote_smart($_POST['fileinfo_3']); else $insert_query .= ", DEFAULT(fileinfo_3)";
if($_POST['Author']) $insert_query .= ", ".quote_smart($_POST['Author']); else $insert_query .= ", DEFAULT(Author)";
if($_POST['INVISIBLE']) $insert_query .= ", ".quote_smart($_POST['INVISIBLE']); else $insert_query .= ", DEFAULT(INVISIBLE)";
if($_POST['FEATURE']) $insert_query .= ", ".quote_smart($_POST['FEATURE']); else $insert_query .= ", DEFAULT(FEATURE)";
$insert_query .= ")";
$insert_query = sprintf($insert_query);
//echo $insert_query; die();
$result = mysql_query($insert_query) or die(mysql_error());
$success = "<em>New article</em> \"".$_POST['title']."\" <em>saved in</em> <strong>".$_POST['CATEGORY']."</strong>";
}elseif($_POST['action'] == "insert" and (!$_POST['key'] or !$_POST['CATEGORY'])){
logout(2);
}
//////////////////////////////////////
?>