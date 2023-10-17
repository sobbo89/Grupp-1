<?php
function show($where = 'here', $template_file = 'template', $template_version = 1, $query = 'SELECT * from articles', $selected = null, $selected_template_version = 1, $template_solo_version = null, $qstr = null, $page = 1, $limit = null, $order = 'NULL', $lang = '', $calc8to5 = null,$countlivsstilXcoach = null,$countlivsstilXcoachForetag = null,$countlivsstil = null,$countuppfolj = null,$countutv = null)
{
global $$where;
$whererows = $where.'_rows';
global $$whererows;

$roundby = 1.6;
$roundat = 0;

// get template
include "tpl/".$template_file.".tpl"; 
// template version
$template = 'template'.$template_version;
// selected template version
$selected_template = 'template'.$selected_template_version;

// if pagination
if($limit){ 
$limitvalue = $page * $limit - ($limit); 
$limit_query = " ORDER BY $order LIMIT $limitvalue, $limit";
echo $query.$limit_query; die();
$results = mysql_query($query.$limit_query) or die(mysql_error());
$allrows = mysql_query($query) or die(mysql_error());
$numrows = mysql_num_rows($allrows);
$numofpages = ceil($numrows/$limit);
// create pag
$prev = $page-1;
$next = $page+1;
$pagtemplate = $template.'pag';
$pagtemplate_1 = $template.'pag_1';
$pagtemplate_2 = $template.'pag_2';
$pagtemplate_3 = $template.'pag_3';
$pagtemplate_4 = $template.'pag_4';
$pagwhere = $where.'_pag';
global $$pagwhere;
$output = $$pagtemplate;
if($page > 1) $output = str_replace('{prev}', $$pagtemplate_1.$prev.$$pagtemplate_2, $output); else $output = str_replace('{prev}', '', $output);
if($page < $numofpages) $output = str_replace('{next}', $$pagtemplate_3.$next.$$pagtemplate_4, $output); else $output = str_replace('{next}', '', $output);
$output = str_replace('{qstr}', $qstr, $output);
$$pagwhere = $output;
if($numrows < 2 and $template_solo_version) $template = 'template'.$template_solo_version;
} else {
// if not pagination
$results = mysql_query($query) or die(mysql_error());
}

//forward the number of gotten rows to where
$$whererows = mysql_num_rows($results);

// get language
$langtitle = $lang.'title';
$langtext_1 = $lang.'text_1';
$langtext_2 = $lang.'text_2';
$langtext_3 = $lang.'text_3';

// set template tags prefixes and suffixes
$template_1 = $template.'_1';
$template_2 = $template.'_2';
$template_3 = $template.'_3';
$template_4 = $template.'_4';

// loop data through template
while ($rows=mysql_fetch_array($results)) { 
	extract($rows);
	if($selected and ($ID == $selected or $id == $selected)) $output = $$selected_template; else $output = $$template;
	$output = str_replace('{ID}', $ID, $output);
	$output = str_replace('{id}', $id, $output);
	$output = str_replace('{title}', $$langtitle, $output);
	$output = str_replace('{text_1}', $$langtext_1, $output);
	$output = str_replace('{gruppnamn}', $gruppnamn, $output);
	$output = str_replace('{rollnamn}', $rollnamn, $output);
	$output = str_replace('{Anvnamn}', $Anvnamn, $output);
	$output = str_replace('{username}', $username, $output);
	$output = str_replace('{AnvID}', $AnvID, $output);
	$output = str_replace('{GruppID}', $GruppID, $output);
	$output = str_replace('{coachID}', $coachID, $output);
	$output = str_replace('{RollID}', $RollID, $output);
	$output = str_replace('{Tillfalle}', $Tillfalle, $output);
	$output = str_replace('{Datum}', $Datum, $output);
	$output = str_replace('{Kortdatum}', strftime("%F",strtotime($Datum)), $output);
	
	if($countlivsstilXcoach){
	$cresults = mysql_query("SELECT f43 FROM respondent r, livsstil l WHERE r.username = l.Anvnamn AND r.GruppID = $gruppID AND l.f43 = $coachID");
	$ccount = mysql_num_rows($cresults);
	if(!$ccount) $ccount = 0;
	$output = str_replace('{-coachcounter-}', $ccount, $output);
	}
	
	if($countlivsstil){
	$cresults = mysql_query("SELECT f43 FROM respondent r, livsstil l WHERE r.username = l.Anvnamn AND r.GruppID = $GruppID");
	$ccount = mysql_num_rows($cresults);
	if(!$ccount) $ccount = 0;
	$output = str_replace('{-livsstilcounter-}', $ccount, $output);
	}
	
	if($countuppfolj){
	$cresults = mysql_query("SELECT u.f1 FROM respondent r, uppfolj u WHERE r.username = u.Anvnamn AND r.GruppID = $id");
	$ccount = mysql_num_rows($cresults);
	if(!$ccount) $ccount = 0;
	$output = str_replace('{-uppfoljcounter-}', $ccount, $output);
	}
	
	if($countutv){
	$cresults = mysql_query("SELECT u.f1 FROM nyutvtabell u WHERE u.GruppID = $id");
	$ccount = mysql_num_rows($cresults);
	if(!$ccount) $ccount = 0;
	$output = str_replace('{-utvcounter-}', $ccount, $output);
	}
	
	if(!$f1) extract(mysql_fetch_array(mysql_query("SELECT f1 FROM livsstil WHERE Anvnamn IS NOT NULL AND Anvnamn = '".$Anvnamn."' OR Anvnamn = '".$username."'")));
	if(!$f1) $f1 = $Anvnamn;
	if(!$f1) $f1 = $username;
	$output = str_replace('{f0}', $f0, $output);	
for ($x = 1; $x <= 51; $x++) {
$f = 'f'.$x;
if($calc8to5 AND is_numeric($$f)) $output = str_replace('{f'.$x.'}', round($$f/$roundby,$roundat), $output); else $output = str_replace('{f'.$x.'}', $$f, $output);
}	
	$output = str_replace('{ft11}', $ft11, $output);
	$output = str_replace('{ft12}', $ft12, $output);
	$output = str_replace('{ft13}', $ft13, $output);
	$output = str_replace('{coachnamn}', $coachnamn, $output);
	$output = str_replace('{coachlogin}', $coachlogin, $output);
	$output = str_replace('{coachlosen}', $coachlosen, $output);
	$output = str_replace('{coachemail}', $coachemail, $output);
	$output = str_replace('{langs}', $langs, $output);
	$output = str_replace('{chefnamn}', $chefnamn, $output);
	$output = str_replace('{cheflogin}', $cheflogin, $output);
	$output = str_replace('{cheflosen}', $cheflosen, $output);
	$output = str_replace('{chefemail}', $chefemail, $output);
	$output = str_replace('{gruppnamn}', $gruppnamn, $output);
	$output = str_replace('{grupplogin}', $grupplogin, $output);
	$output = str_replace('{grupplosen}', $grupplosen, $output);
	$output = str_replace('{rollnamn}', $rollnamn, $output);
	$output = str_replace('{rolllogin}', $rolllogin, $output);
	$output = str_replace('{rolllosen}', $rolllosen, $output);
	$output = str_replace('{ulvl}', $ulvl, $output);
	$output = str_replace('{Foretagsnamn}', $Foretagsnamn, $output);
	$output = str_replace('{Foretagslank}', $Foretagslank, $output);
	$output = str_replace('{Maxantal}', $Maxantal, $output);
	$output = str_replace('{Status}', $Status, $output);
	$output = str_replace('{LvID}', $LvID, $output);
	$output = str_replace('{-qstr-}', $qstr, $output);
	$f1 = null;
	$Anvnamn = null;
	$username = null;
	$$where .= $output;
	}
}
?>