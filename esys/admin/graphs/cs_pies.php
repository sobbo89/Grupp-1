<?php
error_reporting(0);
//error_reporting(E_ALL^E_NOTICE);

// functions
function str_thr($numdata){
if($numdata > 0) $numdata = ''.$numdata; else $numdata = '';
return $numdata;
}

// include jpgraph
include ("../../jpgraph/src/jpgraph.php");
include ("../../jpgraph/src/jpgraph_pie.php");
include "../inc/db.inc.php";

// BUILD headlines
if($_GET['FORETAG']) $hl = mysql_fetch_array(mysql_unbuffered_query("SELECT Foretagsnamn FROM foretag WHERE ID=".$_GET['FORETAG']));
if($_GET['GruppID']) $hl = mysql_fetch_array(mysql_unbuffered_query("SELECT gruppnamn FROM grupptabell WHERE ID=".$_GET['GruppID']));
if($_GET['AnvID']) $hl = mysql_fetch_array(mysql_unbuffered_query("SELECT username FROM respondent WHERE ID=".$_GET['AnvID']));
$headline = $hl[0];
if($_GET['kon'] == 'Man') $kon = 'Män'; elseif($_GET['kon'] == 'Kvinna') $kon = 'Kvinnor'; else $kon = 'Alla';
$headline2 = ' '.$kon;
if($_GET['baraklara']) $headline2 .= ' klara';
if($_GET['alderstart']) $headline2 .= ' från '.$_GET['alderstart'];
if($_GET['alderstopp']) $headline2 .= ' till '.$_GET['alderstopp'];
if($_GET['alderstart'] or $_GET['alderstopp']) $headline2 .= ' år';
if($_GET['tillfallestart']) $headline2 .= ' från tillfälle '.$_GET['tillfallestart'];
if($_GET['tillfallestopp']) $headline2 .= ' till tillfälle '.$_GET['tillfallestopp'];
$headline2 .= "  (".date("Y-m-d")."  ".date("H:i").")";

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

// Preset tillfällen
if(!$tillfallestart) $tillfallestart = 1;
if(!$tillfallestopp) $tillfallestopp = 3;

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
if(!$_GET['AnvID']){
$cimgn = 'cspies_';
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
$cimgn = 'cspies_a_'.$_GET['AnvID'].'_'.$cimgstr.'.png';
}



$ant = $tillfallestopp-$tillfallestart+1;
if($ant < 3) $ant = 3;
//echo $ant;
//die();
// BASIC SETTINGS FOR the chart
//height layout aspect
$hasp = 240;
$vasp = 185;
//$vasp = 190/2*$ant;
// pie size
$size=(0.09/$ant*3);
// Create the Pie Graph.
//$graph = new PieGraph(670,1500,$cimgn);
//$graph = new PieGraph(160*$ant+350-160,1500);
$graph = new PieGraph(160*$ant+350-160,1500,$cimgn);
$graph->SetAntiAliasing();
//$graph->SetFrame(false);
$graph->SetShadow();
// set pie legends
$legends = array("mkt dåligt","dåligt","normalt","bra","mkt bra");
// Setup title for graph
$graph->title->Set($headline);
$graph->title->SetFont(FF_ARIAL,FS_BOLD,14);
$graph->title->SetMargin(15);
$graph->subtitle->Set($headline2);
$graph->subtitle->SetFont(FF_ARIAL,FS_ITALIC);
$graph->legend->SetFont(FF_ARIAL,FS_ITALIC,8);
$graph->legend->SetAbsPos(10,15);
$graph->legend->SetReverse();
$graph->legend->SetFillColor();
$graph->legend->SetFrameWeight();
$graph->legend->SetShadow('gray',0);
$graph->legend->SetLineSpacing(10);
$graph->SetShadow('gray',0);



// LOOPING OVER THE GRAPH
for ($f = 1; $f <= 6; $f++){ // frågor loop

// labels
$fr = mysql_fetch_array(mysql_unbuffered_query("SELECT f".$f." FROM csfragor WHERE ID=1"));
$lbl[$f-1] = utf8_decode($fr[0]);
$caption = 'caption'.$f;
$$caption=new Text($f.'. '.$lbl[$f-1],32,($f*$hasp)-180);
$$caption->SetFont(FF_ARIAL,FS_BOLD,11);
$graph->AddText($$caption);
// end labels

for ($x = $tillfallestart; $x <= $tillfallestopp; $x++){ // tillfällen loop
$data[0] = 0;
$data[1] = 0;
$data[2] = 0;
$data[3] = 0;
$data[4] = 0;
$nodata = 0;
// get an incremental version of x that always starts at 1
$c = $x-$tillfallestart+1;
// set the pie name
$p = 'p'.$c;
// querytime
$query = "SELECT c.f".$f." FROM cstabell c".$tableinsert." WHERE c.tillfalle = ".$x.$queryinsert;
$results = mysql_unbuffered_query($query);
//if($f == 1)$grows[$x] = mysql_num_rows($results);
while($row = mysql_fetch_array($results)){ // gather data - if no results from query, while (and the conditions inside) wont execute
if($row[0] > 7){ $data[4]++; 
}elseif($row[0] > 5){ $data[3]++; 
}elseif($row[0] > 4){ $data[2]++; 
}elseif($row[0] > 2){ $data[1]++; 
}elseif($row[0] > 1){ $data[0]++; 
}else{ $nodata++;
}
} // end gather data
if(array_sum($data) > 0){ // show pie or not - if no results from above, this condition wont execute

// EXTREMELY DIRTY BUGFIX - MUST BE REPAIRED FOR REAL!!
if($f == 2 AND $x == 3 AND $data[0] == 1){ $data[0]++; $bugfix=true; }

// pies
$$p = new PiePlot($data);
$$p->SetGuideLines(false);
if($f < 2) $p1->SetLegends($legends);
$$p->SetSliceColors(array('#f90006','#870078','#0a00f7','#018c88','#00fd05'));
$$p->SetSize($size);
$$p->SetCenter(($c*$vasp)-85,($f*0.16)-0.05);
//$$p->SetCenter((($c*0.28)-0.13)/$ant*3,($f*0.16)-0.05);
$$p->value->SetFont(FF_ARIAL,FS_BOLD,10);
$$p->value->SetColor("black");
$$p->value->SetFormat('%d');
$$p->SetLabelPos(0.6);

// EXTREMELY DIRTY BUGFIX pt2 - MUST BE REPAIRED FOR REAL!!
if($bugfix)$data[0]--;
//

$lbl = array(str_thr($data[0]),str_thr($data[1]),str_thr($data[2]),str_thr($data[3]),str_thr($data[4]));
$$p->SetLabelType(PIE_VALUE_ABS);
$$p->SetLabels($lbl);
$graph->Add($$p);

// tillfällen labels
$text = 'text'.$f.$x;
if($c < 2){
$$text = new Text('tillfälle          '.$x,34,($f*$hasp)-157);
}else{ 
$$text = new Text($x.'',($c*$vasp)-97,($f*$hasp)-157);
}
$$text->SetFont(FF_ARIAL,FS_NORMAL,9);
$graph->AddText($$text);

} // end show pie or not
// clear some values for next go around
unset($piedata);
unset($data);
} // end tillfällen loop
} // end frågor loop

// draw the graph
//$graph->subtitle->Set($crows[1].'/'.$crows[2].'/'.$crows[3].'-'.$grows[1].'/'.$grows[2].'/'.$grows[3]);
$graph->Stroke();
?>