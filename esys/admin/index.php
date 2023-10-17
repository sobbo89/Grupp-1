<?php
error_reporting(E_ALL ^E_WARNING ^E_NOTICE ^E_DEPRECATED);
//////////////////////////////////////
// STARTUP
///////////////////
unset($GLOBALS);
// includes
include "inc/init.inc";
//////////////////////////////////////

//////////////////////////////////////
// COLLECT QUERY STRINGS
///////////////////
// zedit qstrs
if($_POST['cat_id']) $cat_id = $_POST['cat_id']; else $cat_id = null;
if($_GET['cat_id']) $cat_id = $_GET['cat_id'];
if($_GET['art_id']) $art_id = $_GET['art_id']; else $art_id = null;
if($_GET['page']) $page = $_GET['page']; else $page = 1;
if($_GET['action']) $action = $_GET['action']; else $action = null;
if($_POST['action']) $action = $_POST['action'];
if($_GET['subaction']) $subaction = $_GET['subaction']; else $subaction = null;
if($_POST['subaction']) $subaction = $_POST['subaction'];
if($_POST['key']) $key = $_POST['key']; else $key = null;
if($_GET['key']) $key = $_GET['key'];
// esys qstrs
if($_POST['FORETAG']) $FORETAG = $_POST['FORETAG']; else $FORETAG = null;
if($_GET['FORETAG']) $FORETAG = $_GET['FORETAG'];
if($_POST['ForetagID']) $ForetagID = $_POST['ForetagID']; else $ForetagID = null;
if($_GET['ForetagID']) $ForetagID = $_GET['ForetagID'];
if($_POST['GruppID']) $GruppID = $_POST['GruppID']; else $GruppID = null;
if($_GET['GruppID']) $GruppID = $_GET['GruppID'];
if($_POST['RollID']) $RollID = $_POST['RollID']; else $RollID = null;
if($_GET['RollID']) $RollID = $_GET['RollID'];
if($_POST['AnvID']) $AnvID = $_POST['AnvID']; else $AnvID = null;
if($_GET['AnvID']) $AnvID = $_GET['AnvID'];
if($_POST['CSID']) $CSID = $_POST['CSID']; else $CSID = null;
if($_GET['CSID']) $CSID = $_GET['CSID'];
if($_GET['coacher_CoachID']) $coacher_CoachID = $_GET['coacher_CoachID']; else $coacher_CoachID = null;
if($_POST['coacher_CoachID']) $coacher_CoachID = $_POST['coacher_CoachID'];
if($_GET['anv_AnvID']) $anv_AnvID = $_GET['anv_AnvID']; else $anv_AnvID = null;
if($_POST['anv_AnvID']) $anv_AnvID = $_POST['anv_AnvID'];
if($_GET['chefer_ChefID']) $chefer_ChefID = $_GET['chefer_ChefID']; else $chefer_ChefID = null;
if($_POST['chefer_ChefID']) $chefer_ChefID = $_POST['chefer_ChefID'];
if($_GET['grupper_GruppID']) $grupper_GruppID = $_GET['grupper_GruppID']; else $grupper_GruppID = null;
if($_POST['grupper_GruppID']) $grupper_GruppID = $_POST['grupper_GruppID'];
if($_GET['roller_RollID']) $roller_RollID = $_GET['roller_RollID']; else $roller_RollID = null;
if($_POST['roller_RollID']) $roller_RollID = $_POST['roller_RollID'];
if($_GET['kon']) $kon = $_GET['kon']; else $kon = null;
if($_GET['alderstart']) $alderstart = $_GET['alderstart']; else $alderstart = null;
if($_GET['alderstopp']) $alderstopp = $_GET['alderstopp']; else $alderstopp = null;
if($_GET['tillfallestart']) $tillfallestart = $_GET['tillfallestart'];
if($_GET['tillfallestopp']) $tillfallestopp = $_GET['tillfallestopp'];
if($_POST['baraklara']) $baraklara = $_POST['baraklara']; else $baraklara = null;
if($_GET['baraklara']) $baraklara = $_GET['baraklara'];
if(!$tillfallestart) $tillfallestart = 1;
if(!$tillfallestopp) $tillfallestopp = 3;
if($_GET['forutskrift']) $forutskrift = $_GET['forutskrift']; else $forutskrift = null;
//////////////////////////////////////


// begin authory
if($action == "logout"){ $_SESSION['authorized'] = 0; logout(1); }
if(($_SESSION['authorized']) > 0){

// session filter switching
if($subaction == 'filtergroups') $_SESSION['filtergroups'] = 1;
if($subaction == 'dontfiltergroups') $_SESSION['filtergroups'] = 0;

//////////////////////////////////////
// EDITOR MENUS HEADLINES LISTS
///////////////////
//if($_SESSION['ulvl'] > 3) $catlist_query = "SELECT * FROM categories"; else $catlist_query = "SELECT * FROM categories WHERE INVISIBLE IS NULL";
if($_SESSION['ulvl'] > 8) $catlist_query = "SELECT * FROM categories ORDER BY SORT"; else $catlist_query = "SELECT cat.* FROM categories cat, ulvlXcat ul WHERE ul.CatID = cat.ID AND ul.ulvl = ".$_SESSION['ulvl']." ORDER BY SORT";
// Make selectlist
show('selectlist', 'template', 4, $catlist_query);
// Get headline
if($cat_id){
$headline_query = "SELECT ".$lang."title FROM categories WHERE ID = $cat_id";
show('headline', 'template', 3, $headline_query);
}


// Get category specific
include "categories/".$cat_id.".cat";
$statistik = 'statistik_'.$cat_id;
if($action == "formular_edit") $formular = 'formular_edit_'.$cat_id; else $formular = 'formular_'.$cat_id;
$inline = 'inline_'.$cat_id;
$anvandare = 'anvandare_'.$cat_id;
if($altrows) $tableid = 'table'.$cat_id;

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="sv" />
<meta name="robots" content="noindex,nofollow" />
<title>webbutvecklarna : whatform : niana esys 2.0</title>
<link rel="icon" href="./favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
<script language="javascript" type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script src="script.js" type="text/javascript"></script>
</head>
<?php
echo '<body onload="'.$onload.'altrows(\''.$tableid.'\');">';
?>
<div id="menubar">&nbsp;</div>
<div id="main">

<!-- menu moved -->

<div id="mask">
<?php echo $headline; ?>
<?php 
if($_SESSION['ulvl'] > 4) echo $$statistik;
?>

<div id="content" name="content" style='display:show'>
<?php
// content
if($action or $cat_id){


// success handling
if($_GET['success']) echo '<em>'.$_GET['success'].'</em><br/><br/>';
if($success) echo '<script type="text/javascript">window.location=\'?GruppID='.$GruppID.'&AnvID='.$AnvID.'&cat_id='.$cat_id.'&FORETAG='.$FORETAG.'&success='.$success.'\';</script>';
//if($success) echo $success;

if($nav){
?>
<form name="nav" id="nav">
<?php

if($valjforetag) echo ' &nbsp; <select name="FORETAG" class="selector"><option value="">Välj Företag: &nbsp; </option>'.$valjforetag.'</select>';

if($selectforetag) echo '<select name="FORETAG" class="selector" onChange="if(this.selectedIndex!=0) document.nav.submit();"><option value="">Välj Företag: &nbsp; </option>'.$selectforetag.'</select>';

	if(!$hidegrupper){
if(($selectforetag AND ($GruppID OR $FORETAG)) OR !$selectforetag){
echo '
<select name="GruppID" class="selector"';
if(!$koncont or !$alder) echo ' onChange="if(this.selectedIndex!=0) document.nav.submit();"';
if($_SESSION['chef'] AND $_SESSION['ulvl'] == 4 AND $cat_id == 28) echo '><option value="">Visa alla grupper eller välj: &nbsp;</option>';
else echo '><option value="">Välj Grupp: &nbsp; </option>';
echo $grupper.$moreoptions.'
</select>';
	} // end if !$hidegrupper
if($csv_export_link) echo $csv_export_link;
}

if($koncont) echo ' &nbsp; <select name="kon" class="selector">'.$koncont.'</select>';
if($alder) echo $alder;
if($tillfallen) echo $tillfallen;
if($filtreragrupper) echo $filtreragrupper;
if($visaklara) echo $visaklara;
if($visaknapp) echo $visaknapp;

if(!$norespondents){
echo '
<select name="AnvID" class="selector" onChange="if(this.selectedIndex!=0) document.nav.submit();">
<option value="">Välj Individ: &nbsp; </option>
'.$respondent.'
</select>';
}

//if($csv_export_link) echo $csv_export_link;

echo '
<input type="hidden" name="cat_id" value="'.$cat_id.'"/>
</form>';
}
echo $$inline;

echo $$anvandare;

if($settillfalle > 0 AND $settillfalle < 8){ include ("forms/forms.inc"); echo $$formular; }

} else { echo "Välj aktivitet i menyerna ovan."; }
// end content

?>
</div>
</div>
<!-- menu moved here -->
<div id="menu">
<a title="Hem" class="buttop" id="m1" href="?">Startsida</a>
<a title="Klicka här och välj sedan en aktivitet i listan" class="listtop" id="m2" href="#" onclick="javascript:ShowOrHide('selectlist','mask');" onblur="setTimeout('ShowOrHide(\'selectlist\',\'mask\')',150);">VÄLJ aktivitet</a>
<div id="selectlist" class="linklist" name="selectlist" style='display:none'>
<?php 
// VERY TEMPORARY, TO ONLY LET STEFAN IN
if($_SESSION['chef']){
if($_SESSION['chef'] != 85) $selectlist = str_replace('<a class="listlink" href="?action=select&cat_id=41">CS Frisk eller Risk</a>','',$selectlist);
if($_SESSION['chef'] != 85 and $_SESSION['chef'] != 80) $selectlist = str_replace('<a class="listlink" href="?action=select&cat_id=42">CS Jämföra grupper</a>','',$selectlist);
}

elseif($_SESSION['chef'] and $_SESSION['chef'] != 80){
}

// END TEMPORARY
echo $selectlist; 
?>
</div>
<a title="Support" class="buttop"  id="m5" href="index.php?cat_id=21">Hjälp</a>
<a title="Logga ut här" class="buttop" id="m6" href="logout.php">Logga ut</a>
</div>
<?php

// end authory
}else{ login(); }
?>

</div>
</body>
</html>