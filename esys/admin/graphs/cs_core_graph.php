<?php
error_reporting(0);
//error_reporting(E_ALL^E_NOTICE);
include "../../jpgraph/src/jpgraph.php";
include "../../jpgraph/src/jpgraph_line.php";
include "../../jpgraph/src/jpgraph_scatter.php";
include "../../jpgraph/src/jpgraph_regstat.php";
include ("../../jpgraph/src/jpgraph_log.php");
include "../inc/db.inc.php";

if($_GET['Question']) $f = $_GET['Question'];


// BUILD headlines
// Label
$headline = 'Core Index (frågor 1-6)';
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
for ($f = 1; $f <= 6; $f++){ // frågor loop
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
} // end frågor loop
} // end tillfällen loop
// pack all the numbers in 36-base for the cimg file name
$cimgstr = base_convert($cimgstr,10,36);
// WRITING OUT THE CACHE IMAGE NAME
if(!$_GET['AnvID']){
$cimgn = 'cs_core_graph_';
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
$cimgn = 'cs_core_graph_a_'.$_GET['AnvID'].'_'.$cimgstr.'.png';
}



// LOOPING FOR THE GRAPH
for ($x = $tillfallestart; $x <= $tillfallestopp; $x++){ // tillfällen loop
$isum[0] = 0;
$isum[1] = 0;
$isum[2] = 0;
$isum[3] = 0;
$isum[4] = 0;
$isum[5] = 0;
// Data
$query = "SELECT c.f1, c.f2, c.f3, c.f4, c.f5, c.f6 FROM cstabell c".$tableinsert." WHERE c.tillfalle = ".$x.$queryinsert;
$results = mysql_unbuffered_query($query);
while($row = mysql_fetch_array($results)){
for ($z = 0; $z <= 5; $z++){
if($row[$z] > 7){ $isum[$z] = $isum[$z] + 8;
}elseif($row[$z] > 5){ $isum[$z] = $isum[$z] + 6.5;
}elseif($row[$z] > 4){ $isum[$z] = $isum[$z] + 5;
}elseif($row[$z] > 2){ $isum[$z] = $isum[$z] + 3.5;
}elseif($row[$z] > 1){ $isum[$z] = $isum[$z] + 2;
}else{ $isum[$z] = $isum[$z] + 0;
}
}
}
$sum = array_sum($isum) / 6;
if($sum > 0){ $ydata[$x-$tillfallestart] = $sum / mysql_num_rows($results); $xdata[$x-$tillfallestart] = $x; }
else{ $ydata[$x-$tillfallestart] = 0; $xdata[$x-$tillfallestart] = $x; }
}

// Get the interpolated values by creating
// a new Spline object.
if($xdata[1] and $ydata[1]){ 
$spline = new Spline($xdata,$ydata);
// For the new data set we want 40 points to
// get a smooth curve.
list($newx,$newy) = $spline->Get(11);
}else{
$newx = $xdata[0];
$newy = $ydata[0];
}

// Create the graph
$graph = new Graph(331,280,$cimgn);
$graph->img->SetAntiAliasing();
//$graph->SetFrame(false);
$graph->SetMargin(30,20,40,30);
$graph->title->Set($headline);
$graph->title->SetFont(FF_ARIAL,FS_BOLD,12);
$graph->title->SetMargin(8);
$graph->subtitle->Set($headline2);
$graph->subsubtitle->Set($headline3);
$graph->subtitle->SetFont(FF_ARIAL,FS_ITALIC,7);
$graph->subsubtitle->SetFont(FF_ARIAL,FS_ITALIC,7);
$graph->SetMarginColor('white');

//$graph->img->SetAntiAliasing();

// We need a linlin scale since we provide both
// x and y coordinates for the data points.
$graph->SetScale('intint');
//$graph->SetScale('intint',1,5,1,3);

// We want 1 decimal for the X-label
$graph->xaxis->SetLabelFormat('%d');

// We use a scatterplot to illustrate the original
// contro points.
$splot = new ScatterPlot($ydata,$xdata);

// 
$splot->mark->SetFillColor('red@0.3');
$splot->mark->SetColor('red@0.5');
$splot->mark->SetType(MARK_IMG_BALL,'red');

// And a line plot to stroke the smooth curve we got
// from the original control points
$lplot = new LinePlot($newy,$newx);
$lplot->SetColor('navy');

// Add the plots to the graph and stroke
$graph->Add($lplot);
$graph->Add($splot);
$graph->Stroke();
?>