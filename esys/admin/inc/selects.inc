<?php
// select from db for CATEGORY
$cat_query = "SELECT ID, $langtitle FROM categories";
$cat_query = sprintf($cat_query);
$results = mysql_query($cat_query) or die(mysql_error());
while ($rows=mysql_fetch_array($results)) { 
	extract($rows);
	if($ID == $edit_CATEGORY) $output = '<option value="'.$ID.'" selected="selected">'.$$langtitle.' </option>'; else $output = '<option value="'.$ID.'">'.$$langtitle.' </option>';
	$selectcat .= $output;
	}
	
// select from db for PARENT
$bok_query = "SELECT ID, $langtitle, ARTNR FROM articles WHERE CATEGORY > 2 AND CATEGORY < 7";
$bok_query = sprintf($bok_query);
$results = mysql_query($bok_query) or die(mysql_error());
while ($rows=mysql_fetch_array($results)) { 
	extract($rows);
	if($ID == $edit_PARENT) $output = '<option value="'.$ID.'" selected="selected">'.$$langtitle.' ('.$ARTNR.') </option>'; else $output = '<option value="'.$ID.'">'.$$langtitle.' ('.$ARTNR.') </option>';
	$selectparent .= $output;
	}

// select from db for REL_1
$forf_query = "SELECT ID, $langtitle FROM articles WHERE CATEGORY = 11";
$forf_query = sprintf($forf_query);
$results = mysql_query($forf_query) or die(mysql_error());
while ($rows=mysql_fetch_array($results)) { 
	extract($rows);
	if($ID == $edit_REL_1) $output = '<option value="'.$ID.'" selected="selected">'.$$langtitle.' </option>'; else $output = '<option value="'.$ID.'">'.$$langtitle.' </option>';
	$selectrel1 .= $output;
	}
	
// select from db for REL_2
$bok_query = "SELECT ID, $langtitle, ARTNR FROM articles WHERE CATEGORY > 2 AND CATEGORY < 7";
$bok_query = sprintf($bok_query);
$results = mysql_query($bok_query) or die(mysql_error());
while ($rows=mysql_fetch_array($results)) { 
	extract($rows);
	if($ID == $edit_REL_2) $output = '<option value="'.$ID.'" selected="selected">'.$$langtitle.' ('.$ARTNR.') </option>'; else $output = '<option value="'.$ID.'">'.$$langtitle.' ('.$ARTNR.') </option>';
	$selectrel2 .= $output;
	}
?>