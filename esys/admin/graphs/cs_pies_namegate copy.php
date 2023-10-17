<?php
//error_reporting(0);
//error_reporting(E_ALL^E_NOTICE);

// functions
function str_thr($numdata){
if($numdata > 0) $numdata = ''.$numdata; else $numdata = '';
return $numdata;
}

// include jpgraph
//include ("../../jpgraph/src/jpgraph.php");
//include ("../../jpgraph/src/jpgraph_pie.php");
//include "../inc/db.inc.php";

// BUILD headlines
if($FORETAG) $hl = mysql_fetch_array(mysql_unbuffered_query("SELECT Foretagsnamn FROM foretag WHERE ID=".$FORETAG));
if($GruppID) $hl = mysql_fetch_array(mysql_unbuffered_query("SELECT gruppnamn FROM grupptabell WHERE ID=".$GruppID));
if($AnvID) $hl = mysql_fetch_array(mysql_unbuffered_query("SELECT username FROM respondent WHERE ID=".$AnvID));
$headline = $hl[0];
if($kon == 'Man') $kon = 'Män'; elseif($kon == 'Kvinna') $kon = 'Kvinnor'; else $kon = 'Alla';
$headline2 = ' '.$kon;
if($baraklara) $headline2 .= ' klara';
if($alderstart) $headline2 .= ' från '.$alderstart;
if($alderstopp) $headline2 .= ' till '.$alderstopp;
if($alderstart or $alderstopp) $headline2 .= ' år';
if($tillfallestart) $headline2 .= ' från tillfälle '.$tillfallestart;
if($tillfallestopp) $headline2 .= ' till tillfälle '.$tillfallestopp;
$headline2 .= "  (".date("Y-m-d")."  ".date("H:i").")";

// GET variables and protect from reg globals on
if($FORETAG) $FORETAG = $FORETAG; else $FORETAG = null;
if($GruppID) $GruppID = $GruppID; else $GruppID = null;
if($AnvID) $AnvID = $AnvID; else $AnvID = null;
if($kon) $kon = $kon; else $kon = null;
if($alderstart) $alderstart = $alderstart; else $alderstart = null;
if($alderstopp) $alderstopp = $alderstopp; else $alderstopp = null;
if($baraklara) $baraklara = $baraklara; else $baraklara = null;
if($tillfallestart) $tillfallestart = $tillfallestart; else $tillfallestart = null;
if($tillfallestopp) $tillfallestopp = $tillfallestopp; else $tillfallestopp = null;

// Preset tillfällen
if(!$tillfallestart) $tillfallestart = 1;
if(!$tillfallestopp) $tillfallestopp = 3;

// BUILD query
if($GruppID) $queryinsert .= " AND c.GruppID = $GruppID";
if($FORETAG) $queryinsert .= " AND c.GruppID = g.ID AND g.FORETAG = $FORETAG";
if($kon OR $alderstart OR $alderstopp) $queryinsert .= " AND c.Anvnamn = l.Anvnamn";
if($kon AND $kon != 'Alla') $queryinsert .= " AND l.f2 = '$kon'";
if($alderstart) $minalder = abs($alderstart-date("Y"));
if($alderstopp) $maxalder = abs($alderstopp-date("Y"));
if($minalder) $queryinsert .= " AND l.f3 <= $minalder";
if($maxalder) $queryinsert .= " AND l.f3 >= $maxalder";
if($baraklara) $queryinsert .= " AND c2.Anvnamn = l.Anvnamn AND c2.Tillfalle = $tillfallestopp";
if($baraklara) $tableinsert .= ", cstabell c2";
if($kon OR $alderstart OR $alderstopp OR $baraklara) $tableinsert .= ", livsstil l";
if($FORETAG) $tableinsert .= ", grupptabell g";

// AnvID overwrites the previous (now unneeded) inserts
if($AnvID){ 
$tableinsert = null;
$queryinsert = " AND AnvID = $AnvID";
}

// LOOPING OVER THE CACHE IMAGE NAME
for ($f = 1; $f <= 6; $f++){ // frågor loop
for ($x = $tillfallestart; $x <= $tillfallestopp; $x++){ // tillfällen loop
$query = "SELECT c.f".$f." FROM cstabell c".$tableinsert." WHERE c.tillfalle = ".$x.$queryinsert;
$results = mysql_unbuffered_query($query);
//if($f == 1)$crows[$x] = mysql_num_rows($results);
while($row = mysql_fetch_array($results)){
if($row[0] > 7){ $data[4]++; 
}elseif($row[0] > 5){ $data[3]++; 
}elseif($row[0] > 4){ $data[2]++; 
}elseif($row[0] > 2){ $data[1]++; 
}elseif($row[0] > 1){ $data[0]++; 
}else{ $nodata++;
}
} // end while
if(array_sum($data) > 0){ // show pie or not
$cimgstr .= implode($data);
unset($data);
} // end show pie or not
} // end frågor loop
} // end tillfällen loop
// pack all the numbers in 36-base for the cimg file name
$cimgstr = base_convert($cimgstr,10,36);
// WRITING OUT THE CACHE IMAGE NAME
if(!$AnvID){
$cimgn = 'cspies_';
if($FORETAG) $cimgn .= 'f'.$FORETAG.'_';
if($GruppID) $cimgn .= 'g'.$GruppID.'_';
if($kon) $cimgn .= $kon.'_';
if($alderstart) $cimgn .= 'fr'.$alderstart.'_';
if($alderstopp) $cimgn .= 't'.$alderstopp.'_';
if($tillfallestart) $cimgn .= 'tsta'.$tillfallestart.'_';
if($tillfallestopp) $cimgn .= 'tsto'.$tillfallestopp.'_';
if($baraklara) $cimgn .= 'bk'.$baraklara.'_';
$cimgn .= $cimgstr.'.png';
}elseif($AnvID){ 
$cimgn = 'cspies_a_'.$AnvID.'_'.$cimgstr.'.png';
}
//if(file_exists('../../cache/'.$cimgn)) 
die('<img src="../../../cache/'.$cimgn.'"/><br/>'.$cimgn);

?>