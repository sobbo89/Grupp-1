<?php
//error_reporting(0);
//error_reporting(E_ALL^E_NOTICE);
//include "../../jpgraph/src/jpgraph.php";
//include "../../jpgraph/src/jpgraph_line.php";
//include "../../jpgraph/src/jpgraph_scatter.php";
//include "../../jpgraph/src/jpgraph_regstat.php";
//include ("../../jpgraph/src/jpgraph_log.php");
//include "../inc/db.inc.php";

if($gQuestion) $f = $gQuestion;

// BUILD headlines
// Label
$fr = mysql_fetch_array(mysql_unbuffered_query("SELECT f".$f." FROM csfragor WHERE ID=1")) or die(mysql_error());
$headline = $f.'. '.$fr[0];
if($_GET['FORETAG']) $hl = mysql_fetch_array(mysql_unbuffered_query("SELECT Foretagsnamn FROM foretag WHERE ID=".$_GET['FORETAG']));
if($_GET['GruppID']) $hl = mysql_fetch_array(mysql_unbuffered_query("SELECT gruppnamn FROM grupptabell WHERE ID=".$_GET['GruppID']));
if($_GET['AnvID']) $hl = mysql_fetch_array(mysql_unbuffered_query("SELECT username FROM respondent WHERE ID=".$_GET['AnvID']));
$headline2 = $hl[0];
if($_GET['kon'] == 'Man') $kon = 'Män'; elseif($_GET['kon'] == 'Kvinna') $kon = 'Kvinnor'; else $kon = 'Alla';
$headline2 .= ' '.$kon;
if($_GET['baraklara']) $headline2 .= ' klara';
if($_GET['alderstart']) $headline2 .= ' fr '.$_GET['alderstart'];
if($_GET['alderstopp']) $headline2 .= ' t '.$_GET['alderstopp'];
if($_GET['alderstart'] or $_GET['alderstopp']) $headline2 .= ' år';
if($_GET['tillfallestart']) $headline3 = ' fr tillf '.$_GET['tillfallestart'];
if($_GET['tillfallestopp']) $headline3 .= ' t tillf '.$_GET['tillfallestopp'];
$headline3 .= "  (".date("Y-m-d")."  ".date("H:i").")";

// GET variables and protect from reg globals on
if($_GET['FORETAG']) $FORETAG = $_GET['FORETAG']; else $FORETAG = null;
if($_GET['GruppID']) $GruppID = $_GET['GruppID']; else $GruppID = null;
if($_GET['AnvID']) $AnvID = $_GET['AnvID']; else $AnvID = null;
if($_GET['kon']) $kon = $_GET['kon']; else $kon = null;
if($_GET['alderstart']) $alderstart = $_GET['alderstart']; else $alderstart = null;
if($_GET['alderstopp']) $alderstopp = $_GET['alderstopp']; else $alderstopp = null;
if($_GET['baraklara']) $baraklara = $_GET['baraklara']; else $baraklara = null;
if($_GET['tillfallestart']) $tillfallestart = $_GET['tillfallestart']; else $tillfallestart = null;
if($_GET['tillfallestopp']) $tillfallestopp = $_GET['tillfallestopp']; else $tillfallestopp = null;

// BUILD query
if($GruppID) $queryinsert .= " AND c.GruppID = $GruppID";
if($FORETAG) $queryinsert .= " AND c.GruppID = g.ID AND g.FORETAG = $FORETAG";
if($kon OR $alderstart OR $alderstopp) $queryinsert .= " AND c.Anvnamn = l.Anvnamn";
if($kon AND $kon != 'Alla') $queryinsert .= " AND l.f2 = '$kon'";
if($alderstart) $minalder = abs($_GET['alderstart']-date("Y"));
if($alderstopp) $maxalder = abs($_GET['alderstopp']-date("Y"));
if($minalder) $queryinsert .= " AND l.f3 <= $minalder";
if($maxalder) $queryinsert .= " AND l.f3 >= $maxalder";
//if($baraklara) $queryinsert .= " AND c2.Anvnamn = l.Anvnamn AND c2.Tillfalle = $tillfallestopp";
if($baraklara) $queryinsert .= " AND c2.Anvnamn = l.Anvnamn AND c2.Tillfalle = $tillfallestopp AND c2.GruppID = g.ID";
if($baraklara) $tableinsert .= ", cstabell c2";
if($kon OR $alderstart OR $alderstopp OR $baraklara) $tableinsert .= ", livsstil l";
if($FORETAG) $tableinsert .= ", grupptabell g";
// AnvID overwrites the previous (now unneeded) inserts
if($AnvID){ 
$tableinsert = null;
$queryinsert = " AND AnvID = $AnvID";
}
// Preset tillfällen
if(!$tillfallestart) $tillfallestart = 1;
if(!$tillfallestopp) $tillfallestopp = 3;


// LOOPING OVER THE CACHE IMAGE NAME
//for ($f = 1; $f <= 6; $f++){ // frågor loop
for ($x = $tillfallestart; $x <= $tillfallestopp; $x++){ // tillfällen loop
$query = "SELECT c.f".$f." FROM cstabell c".$tableinsert." WHERE c.tillfalle = ".$x.$queryinsert;
$results = mysql_unbuffered_query($query);
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
//} // end frågor loop
} // end tillfällen loop
// pack all the numbers in 36-base for the cimg file name
$cimgstr = base_convert($cimgstr,10,36);
// WRITING OUT THE CACHE IMAGE NAME
if(!$_GET['AnvID']){
$cimgn = 'csgraph_f'.$f.'_';
if($_GET['FORETAG']) $cimgn .= 'f'.$_GET['FORETAG'].'_';
if($_GET['GruppID']) $cimgn .= 'g'.$_GET['GruppID'].'_';
if($_GET['kon']) $cimgn .= $_GET['kon'].'_';
if($_GET['alderstart']) $cimgn .= 'fr'.$_GET['alderstart'].'_';
if($_GET['alderstopp']) $cimgn .= 't'.$_GET['alderstopp'].'_';
if($_GET['tillfallestart']) $cimgn .= 'tsta'.$_GET['tillfallestart'].'_';
if($_GET['tillfallestopp']) $cimgn .= 'tsto'.$_GET['tillfallestopp'].'_';
if($_GET['baraklara']) $cimgn .= 'bk'.$_GET['baraklara'].'_';
$cimgn .= $cimgstr.'.png';
}elseif($_GET['AnvID']){ 
$cimgn = 'csgraph_f'.$f.'_a_'.$_GET['AnvID'].'_'.$cimgstr.'.png';
}

if(file_exists('../cache/'.$cimgn)) $imagepath = '../cache/'.$cimgn;

?>