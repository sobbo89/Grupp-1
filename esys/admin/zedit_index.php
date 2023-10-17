<?php
//////////////////////////////////////
// STARTUP
///////////////////
// includes
include "inc/init.inc";
//////////////////////////////////////


//////////////////////////////////////
// COLLECT QUERY STRINGS
///////////////////
if($_GET['cat_id']) $cat_id = $_GET['cat_id']; else $cat_id = null;
if($_GET['art_id']) $art_id = $_GET['art_id']; else $art_id = null;
if($_GET['page']) $page = $_GET['page']; else $page = 1;
if($_GET['action']) $action = $_GET['action']; else $action = null;
if($_GET['key']) $key = $_GET['key']; else $key = null;
//////////////////////////////////////


if($action == "logout") logout(1);


//////////////////////////////////////
// EDITOR MENUS HEADLINES LISTS
///////////////////
// Make addlist
$catlist_query = "SELECT * FROM categories";
show('addlist', 'template', 1, $catlist_query);
//
// Make editlist
show('editlist', 'template', 2, $catlist_query);
//
// Get headline
if($cat_id){
$headline_query = "SELECT ".$lang."text_1 FROM categories WHERE ID = $cat_id";
show('headline', 'template', 4, $headline_query);
}
//
// Make article list
if($action == "list" and $cat_id){
$articlelist_query = "SELECT * FROM articles WHERE CATEGORY = $cat_id";
show('articlelist', 'template', 3, $articlelist_query);
}
//////////////////////////////////////

// upload directory
$directory = 'bilder';

// get language
$langtitle = $lang.'title';
$langtext_1 = $lang.'text_1';
$langtext_2 = $lang.'text_2';
$langtext_3 = $lang.'text_3';

include "inc/write.inc";


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="sv" />
<meta name="robots" content="noindex,nofollow" />
<title>webbutvecklarna : whatform : zedit 3.0</title>
<link rel="icon" href="./favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
<script language="javascript" type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script src="script.js" type="text/javascript"></script>
</head>
<body>
<div id="menubar">&nbsp;</div>
<div id="main">

<div id="menu">
<a title="Start page" class="buttop" id="m1" href="?">Home</a>
<a title="Click here and then click on a category in the list" class="listtop" id="m2" href="#" onclick="javascript:ShowOrHide('addlist','');" onblur="setTimeout('ShowOrHide(\'addlist\',\'\')',150);">ADD an article</a>
<div id="addlist" class="linklist" name="addlist" style='display:none'>
<?php echo $addlist; ?>
</div>
<a title="Click here and then click on a category in the list" class="listtop" id="m3" href="#" onclick="javascript:ShowOrHide('editlist','');" onblur="setTimeout('ShowOrHide(\'editlist\',\'\')',150);">EDIT articles</a>
<div id="editlist" class="linklist" name="editlist" style='display:none'>
<?php echo $editlist; ?>
</div>
<a title="Your settings" class="buttop" id="m4" href="index.php?mod=options&action=options">Options</a>
<a title="Documentation" class="buttop"  id="m5" href="index.php?mod=options&action=options">Manual</a>
<a title="This way out" class="buttop" id="m6" href="?action=logout">Logout</a>
</div>

<?php echo $headline; ?>

<div id="content">
<!--<form method=post name="zedit" action="">-->
<?php
if(!$action and !$_POST['action']){
echo "Choose from the menus above to add or edit articles.";
}
echo $success;
if($action == "add" and $cat_id){

// get editor context
$editor_query = "SELECT EDITOR FROM categories WHERE ID = $cat_id";
$editor_query = sprintf($editor_query);
$results = mysql_query($editor_query) or die(mysql_error());
$rows=mysql_fetch_array($results);
extract($rows);
$EDITARR = explode('|', $EDITOR);

include "inc/selects.inc";

//options
echo '<form method=post name=insert action="index.php">
<div class="rowAB"><span class="colA">Options</span><span class="colB">';
if(in_array('FEATURE', $EDITARR)) echo '<input type=checkbox name="FEATURE" value=""/> feature &nbsp;&nbsp;&nbsp; ';
if(in_array('INVISIBLE', $EDITARR)) echo '<input type=checkbox name="INVISIBLE" value=""/> archive ';
echo ' &nbsp;</span></div>';

if(in_array('SORT', $EDITARR)) echo '<div class="rowAB"><span class="colA">Sort</span><span class="colB"><input title="Sort order" type=text size="44" name="Sort" value=""/></span></div>';
if(in_array('PARENT', $EDITARR)) echo '<div class="rowAB"><span class="colA">Parent</span><span class="colB"> <select name="PARENT" class="selects"> <option value="none">None </option> '.$selectparent.' </select></span></div>';
if(in_array('REL_1', $EDITARR)) echo '<div class="rowAB"><span class="colA">Relation 1</span><span class="colB"> <select name="REL_1" class="selects"> <option value="none">None </option> '.$selectrel1.' </select></span></div>';
if(in_array('REL_2', $EDITARR)) echo '<div class="rowAB"><span class="colA">Relation 2</span><span class="colB"> <select name="REL_2" class="selects"> <option value="none">None </option> '.$selectrel2.' </select></span></div>';

//content
echo '<div class="rowAB"><span class="colA">Title</span><span class="colB">
<input title="Headline" type=text size="44" name="title" class="titlefield" value=""/></span></div>';

if(in_array('text_1', $EDITARR)) echo '<div class="rowAB"><span class="colA">Text 1</span><span class="colB"><textarea name="text_1" cols="49" rows="10"></textarea></span></div>';
if(in_array('text_2', $EDITARR)) echo '<div class="rowAB"><span class="colA">Text 2</span><span class="colB"><textarea name="text_2" cols="49" rows="10"></textarea></span></div>';
if(in_array('text_3', $EDITARR)) echo '<div class="rowAB"><span class="colA">Text 3</span><span class="colB"><textarea title="Infotext" name="text_3" cols="49" rows="3"></textarea></span></div>';
if(in_array('ARTNR', $EDITARR)) echo '<div class="rowAB"><span class="colA">ISBN</span><span class="colB"><input title="Article number" type=text size="44" name="ARTNR" value=""/></span></div>';

echo'<div class="rowAB"><span class="colA">&nbsp;</span><span class="colB">
<a title="Publish changes" class="buttinright" href="#" onclick="document.insert.submit();">Save changes</a>
<input type="hidden" name="action" value="insert"/>
<input type="hidden" name="key" value="42"/>
<input type="hidden" name="CATEGORY" value="'.$cat_id.'"/></form>
</span></div>


<table width="680">
<tr>
<td class="smborder" valign="top" align="center">
<input type=hidden name="file_1">
<a title="Add file 1" class="smbuttin" href="#" onclick="window.open(\'images.php?action=getfile&whatform=insert&directory='.$directory.'&area=file_1&pre_cell=file_1_cell\', \'_Addfile\', \'HEIGHT=500,resizable=yes,scrollbars=yes,WIDTH=390\');return false;">Add file 1</a>
<a title="Remove file 1" class="smbuttin" name="rfile_1" href="#rfile_1" onclick="document.insert.file_1.value=\'\';document.file_1_cell.src=\'img/blank.gif\'">Remove file 1</a><br/>
<img name="file_1_cell" src="img/blank.gif"><br/>
Info 1 <input title="Fileinfo 1" type=text size="20" name="fileinfo_1" value=""/></td>

<td class="smborder" valign="top" align="center">
<input type=hidden name="file_3">
<a title="Add file 3" class="smbuttin" href="#" onclick="window.open(\'images.php?action=getfile&whatform=insert&directory='.$directory.'&area=file_3&pre_cell=file_3_cell\', \'_Addfile\', \'HEIGHT=500,resizable=yes,scrollbars=yes,WIDTH=390\');return false;">Add file 3</a>
<a title="Remove file 3" class="smbuttin" name="rfile_3" href="#rfile_3" onclick="document.insert.file_3.value=\'\';document.file_3_cell.src=\'img/blank.gif\'">Remove file 3</a><br/>
<img name="file_3_cell" src="img/blank.gif"><br/>
Info 3 <input title="Fileinfo 3" type=text size="20" name="fileinfo_3" value=""/></td>

<td class="smborder" valign="top" align="center">
<input type=hidden name="file_5">
<a title="Add file 5" class="smbuttin" href="#" onclick="window.open(\'images.php?action=getfile&whatform=insert&directory='.$directory.'&area=file_5&pre_cell=file_5_cell\', \'_Addfile\', \'HEIGHT=500,resizable=yes,scrollbars=yes,WIDTH=390\');return false;">Add file 5</a>
<a title="Remove file 5" class="smbuttin" name="rfile_5" href="#rfile_5" onclick="document.insert.file_5.value=\'\';document.file_5_cell.src=\'img/blank.gif\'">Remove file 5</a><br/>
<img name="file_5_cell" src="img/blank.gif"><br/>
Info 5 <input title="Fileinfo 5" type=text size="20" name="fileinfo_5" value=""/></td>
</tr>

<tr>
<td class="smborder" valign="top" align="center">
<input type=hidden name="file_2">
<a title="Add file 2" class="smbuttin" href="#" onclick="window.open(\'images.php?action=getfile&whatform=insert&directory='.$directory.'&area=file_2&pre_cell=file_2_cell\', \'_Addfile\', \'HEIGHT=500,resizable=yes,scrollbars=yes,WIDTH=390\');return false;">Add file 2</a>
<a title="Remove file 2" class="smbuttin" name="rfile_2" href="#rfile_2" onclick="document.insert.file_2.value=\'\';document.file_2_cell.src=\'img/blank.gif\'">Remove file 2</a><br/>
<img name="file_2_cell" src="img/blank.gif"><br/>
Info 2 <input title="Fileinfo 2" type=text size="20" name="fileinfo_2" value=""/></td>

<td class="smborder" valign="top" align="center">
<input type=hidden name="file_4">
<a title="Add file 4" class="smbuttin" href="#" onclick="window.open(\'images.php?action=getfile&whatform=insert&directory='.$directory.'&area=file_4&pre_cell=file_4_cell\', \'_Addfile\', \'HEIGHT=500,resizable=yes,scrollbars=yes,WIDTH=390\');return false;">Add file 4</a>
<a title="Remove file 4" class="smbuttin" name="rfile_4" href="#rfile_4" onclick="document.insert.file_4.value=\'\';document.file_4_cell.src=\'img/blank.gif\'">Remove file 4</a><br/>
<img name="file_4_cell" src="img/blank.gif"><br/>
Info 4 <input title="Fileinfo 4" type=text size="20" name="fileinfo_4" value=""/></td>

<td class="smborder" valign="top" align="center">
<input type=hidden name="file_6">
<a title="Add file 6" class="smbuttin" href="#" onclick="window.open(\'images.php?action=getfile&whatform=insert&directory='.$directory.'&area=file_6&pre_cell=file_6_cell\', \'_Addfile\', \'HEIGHT=500,resizable=yes,scrollbars=yes,WIDTH=390\');return false;">Add file 6</a>
<a title="Remove file 6" class="smbuttin" name="rfile_6" href="#rfile_6" onclick="document.insert.file_6.value=\'\';document.file_6_cell.src=\'img/blank.gif\'">Remove file 6</a><br/>
<img name="file_6_cell" src="img/blank.gif"><br/>
Info 6 <input title="Fileinfo 6" type=text size="20" name="fileinfo_6" value=""/></td>
</tr>
</table>

</form>
';

}elseif($action == "list" and $cat_id){
?>
<div class="hrow"><span class="col1">Title</span><span class="col2">ID</span><span class="col3">created</span><span class="col4">changed</span><span class="col5">author</span><span class="col6">f</span><span class="col7">i</span><span class="col8">d</span></div><br/>
<?php
echo $articlelist;
}elseif($action == "edit" and $cat_id and $art_id){

// get editor context
$editor_query = "SELECT EDITOR FROM categories WHERE ID = $cat_id";
$editor_query = sprintf($editor_query);
$results = mysql_query($editor_query) or die(mysql_error());
$rows=mysql_fetch_array($results);
extract($rows);
$EDITARR = explode('|', $EDITOR);

// get article from db
$article_query = "SELECT * FROM articles WHERE ID = ".quote_smart($art_id);
$article_query = sprintf($article_query);
$results = mysql_query($article_query) or die(mysql_error());
$rows=mysql_fetch_array($results);
// set a prefix
extract($rows, EXTR_PREFIX_ALL, "edit");

include "inc/selects.inc";

// get language for article to edit
$langtitle = 'edit_'.$lang.'title';
$langtext_1 = 'edit_'.$lang.'text_1';
$langtext_2 = 'edit_'.$lang.'text_2';
$langtext_3 = 'edit_'.$lang.'text_3';

// stats
echo '<form method=post name=update action="index.php">
<div class="rowAB"><span class="colA">&nbsp;</span><span class="colB">
<em>Article ID '.$edit_ID.' created '.$edit_DATECREATED.' by '.$edit_Author.'. Modified '.$edit_DATECHANGED.'</em></span></div>';

//options
echo '<div class="rowAB"><span class="colA">Options</span><span class="colB">';
if(in_array('FEATURE', $EDITARR)) echo '<input type=checkbox name="FEATURE" value="'.$edit_FEATURE.'"/> feature &nbsp;&nbsp;&nbsp; ';
if(in_array('INVISIBLE', $EDITARR)) echo '<input type=checkbox name="INVISIBLE" value="'.$edit_INVISIBLE.'"/> archive ';
echo ' &nbsp;</span></div>';

if(in_array('SORT', $EDITARR)) echo '<div class="rowAB"><span class="colA">Sort</span><span class="colB"><input title="Sort order" type=text size="44" name="Sort" value="'.$edit_Sort.'"/></span></div>';
if(in_array('CATEGORY', $EDITARR)) echo '<div class="rowAB"><span class="colA">Category</span><span class="colB"> <select name="CATEGORY" class="selects"> <option value="none">None </option> '.$selectcat.' </select></span></div>';
if(in_array('PARENT', $EDITARR)) echo '<div class="rowAB"><span class="colA">Parent</span><span class="colB"> <select name="PARENT" class="selects"> <option value="none">None </option> '.$selectparent.' </select></span></div>';
if(in_array('REL_1', $EDITARR)) echo '<div class="rowAB"><span class="colA">Relation 1</span><span class="colB"> <select name="REL_1" class="selects"> <option value="none">None </option> '.$selectrel1.' </select></span></div>';
if(in_array('REL_2', $EDITARR)) echo '<div class="rowAB"><span class="colA">Relation 2</span><span class="colB"> <select name="REL_2" class="selects"> <option value="none">None </option> '.$selectrel2.' </select></span></div>';

//content
echo '<div class="rowAB"><span class="colA">Title</span><span class="colB">
<input title="Headline" type=text size="44" name="title" class="titlefield" value="'.$$langtitle.'"/></span></div>';

if(in_array('text_1', $EDITARR)) echo '<div class="rowAB"><span class="colA">Text 1</span><span class="colB"><textarea name="text_1" cols="49" rows="10">'.$$langtext_1.'</textarea></span></div>';
if(in_array('text_2', $EDITARR)) echo '<div class="rowAB"><span class="colA">Text 2</span><span class="colB"><textarea name="text_2" cols="49" rows="10">'.$$langtext_2.'</textarea></span></div>';
if(in_array('text_3', $EDITARR)) echo '<div class="rowAB"><span class="colA">Text 3</span><span class="colB"><textarea title="Infotext" name="text_3" cols="49" rows="3">'.$$langtext_3.'</textarea></span></div>';
if(in_array('ARTNR', $EDITARR)) echo '<div class="rowAB"><span class="colA">ISBN</span><span class="colB"><input title="Article number" type=text size="44" name="ARTNR" value="'.$edit_ARTNR.'"/></span></div>';

echo '<div class="rowAB"><span class="colA">&nbsp;</span><span class="colB">
<a title="Publish changes" class="buttinright" href="#" onclick="document.update.submit();">Save changes</a>
<input type="hidden" name="action" value="update"/>
<input type="hidden" name="art_id" value="'.$edit_ID.'"/>
<input type="hidden" name="key" value="42"/>
</span></div>

<div class="rowAB"><span class="colA">&nbsp;</span><span class="colB">
<a title="If you DELETE this article it can NOT be recovered!" class="buttinright" href="javascript:confirmDelete(\'index.php?action=delete&art_id='.$edit_ID.'&key=42\')">Delete article</a>
</span></div>';

echo '<table width="680">
<tr>
<td class="smborder" valign="top" align="center">
<input type=hidden name="file_1" value="'.$edit_file_1.'"/>
<a title="Add file 1" class="smbuttin" href="#" onclick="window.open(\'images.php?action=getfile&whatform=update&directory='.$directory.'&area=file_1&pre_cell=file_1_cell\', \'_Addfile\', \'HEIGHT=500,resizable=yes,scrollbars=yes,WIDTH=390\');return false;">Add file 1</a>
<a title="Remove file 1" class="smbuttin" name="rfile_1" href="#rfile_1" onclick="document.update.file_1.value=\'\';document.file_1_cell.src=\'img/blank.gif\'">Remove file 1</a><br/>';
echo filepreview($directory, $edit_file_1, 'file_1');
echo '<br/>
Info 1 <input title="Fileinfo 1" type=text size="20" name="fileinfo_1" value="'.$edit_fileinfo_1.'"/></td>

<td class="smborder" valign="top" align="center">
<input type=hidden name="file_3" value="'.$edit_file_3.'"/>
<a title="Add file 3" class="smbuttin" href="#" onclick="window.open(\'images.php?action=getfile&whatform=update&directory='.$directory.'&area=file_3&pre_cell=file_3_cell\', \'_Addfile\', \'HEIGHT=500,resizable=yes,scrollbars=yes,WIDTH=390\');return false;">Add file 3</a>
<a title="Remove file 3" class="smbuttin" name="rfile_3" href="#rfile_3" onclick="document.update.file_3.value=\'\';document.file_3_cell.src=\'img/blank.gif\'">Remove file 3</a><br/>';
echo filepreview($directory, $edit_file_3, 'file_3');
echo '<br/>
Info 3 <input title="Fileinfo 3" type=text size="20" name="fileinfo_3" value="'.$edit_fileinfo_3.'"/></td>

<td class="smborder" valign="top" align="center">
<input type=hidden name="file_5" value="'.$edit_file_5.'"/>
<a title="Add file 5" class="smbuttin" href="#" onclick="window.open(\'images.php?action=getfile&whatform=update&directory='.$directory.'&area=file_5&pre_cell=file_5_cell\', \'_Addfile\', \'HEIGHT=500,resizable=yes,scrollbars=yes,WIDTH=390\');return false;">Add file 5</a>
<a title="Remove file 5" class="smbuttin" name="rfile_5" href="#rfile_5" onclick="document.update.file_5.value=\'\';document.file_5_cell.src=\'img/blank.gif\'">Remove file 5</a><br/>';
echo filepreview($directory, $edit_file_5, 'file_5');
echo '<br/>
Info 5 <input title="Fileinfo 5" type=text size="20" name="fileinfo_5" value="'.$edit_fileinfo_5.'"/></td>
</tr>

<tr>
<td class="smborder" valign="top" align="center">
<input type=hidden name="file_2" value="'.$edit_file_2.'"/>
<a title="Add file 2" class="smbuttin" href="#" onclick="window.open(\'images.php?action=getfile&whatform=update&directory='.$directory.'&area=file_2&pre_cell=file_2_cell\', \'_Addfile\', \'HEIGHT=500,resizable=yes,scrollbars=yes,WIDTH=390\');return false;">Add file 2</a>
<a title="Remove file 2" class="smbuttin" name="rfile_2" href="#rfile_2" onclick="document.update.file_2.value=\'\';document.file_2_cell.src=\'img/blank.gif\'">Remove file 2</a><br/>';
echo filepreview($directory, $edit_file_2, 'file_2');
echo '<br/>
Info 2 <input title="Fileinfo 2" type=text size="20" name="fileinfo_2" value="'.$edit_fileinfo_2.'"/></td>

<td class="smborder" valign="top" align="center">
<input type=hidden name="file_4" value="'.$edit_file_4.'"/>
<a title="Add file 4" class="smbuttin" href="#" onclick="window.open(\'images.php?action=getfile&whatform=update&directory='.$directory.'&area=file_4&pre_cell=file_4_cell\', \'_Addfile\', \'HEIGHT=500,resizable=yes,scrollbars=yes,WIDTH=390\');return false;">Add file 4</a>
<a title="Remove file 4" class="smbuttin" name="rfile_4" href="#rfile_4" onclick="document.update.file_4.value=\'\';document.file_4_cell.src=\'img/blank.gif\'">Remove file 4</a><br/>';
echo filepreview($directory, $edit_file_4, 'file_4');
echo '<br/>
Info 4 <input title="Fileinfo 4" type=text size="20" name="fileinfo_4" value="'.$edit_fileinfo_4.'"/></td>

<td class="smborder" valign="top" align="center">
<input type=hidden name="file_6" value="'.$edit_file_6.'"/>
<a title="Add file 6" class="smbuttin" href="#" onclick="window.open(\'images.php?action=getfile&whatform=update&directory='.$directory.'&area=file_6&pre_cell=file_6_cell\', \'_Addfile\', \'HEIGHT=500,resizable=yes,scrollbars=yes,WIDTH=390\');return false;">Add file 6</a>
<a title="Remove file 6" class="smbuttin" name="rfile_6" href="#rfile_6" onclick="document.update.file_6.value=\'\';document.file_6_cell.src=\'img/blank.gif\'">Remove file 6</a><br/>';
echo filepreview($directory, $edit_file_6, 'file_6');
echo '<br/>
Info 6 <input title="Fileinfo 6" type=text size="20" name="fileinfo_6" value="'.$edit_fileinfo_6.'"/></td>
</tr>
</table>

</form>
';

}elseif($action == "delete" and $art_id and $key == 42){
$deletion_query = "DELETE FROM articles WHERE ID = ".quote_smart($art_id);
$deletion_query = sprintf($deletion_query);
$results = mysql_query($deletion_query) or die(mysql_error());
echo 'article '.$art_id.' was deleted'; 
};
?>
<br/><div class="hrow"><span class="col1">&nbsp;</span><span class="col2">&nbsp;</span><span class="col3">&nbsp;</span><span class="col4">&nbsp;</span><span class="col5">&nbsp;</span><span class="col6">&nbsp;</span><span class="col7">&nbsp;</span></div><br/>
<!--</form>-->
</div>

</div>
</body>
</html>