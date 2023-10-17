<?php 
error_reporting(0);
//error_reporting(E_ALL^E_NOTICE);
// db connect
include ("../../jpgraph/src/jpgraph.php");
include ("../../jpgraph/src/jpgraph_bar.php");
include "../inc/db.inc.php";

// get headline
if($_GET['GruppID']) $hl = mysql_fetch_array(mysql_unbuffered_query("SELECT gruppnamn FROM grupptabell WHERE ID=".$_GET['GruppID']));
elseif($_GET['FORETAG']) $hl = mysql_fetch_array(mysql_unbuffered_query("SELECT Foretagsnamn FROM foretag WHERE ID=".$_GET['FORETAG']));
if($_GET['Question']) $x = $_GET['Question'];
// Labels
$fr = mysql_fetch_array(mysql_unbuffered_query("SELECT f".$x." FROM nyutvfragor WHERE ID=1")) or die(mysql_error());
$headline = 'Fråga '.$x.': '.$fr[0];
$headline2 = $hl[0].' '.date("Y-m-d")." kl ".date("H:i");

//name the cache img
if($_GET['GruppID']) $results = mysql_unbuffered_query("SELECT f".$x." FROM nyutvtabell WHERE GruppID=".$_GET['GruppID']);
elseif($_GET['FORETAG']) $results = mysql_unbuffered_query("SELECT u.f".$x." FROM nyutvtabell u, grupptabell g WHERE u.GruppID = g.id AND g.FORETAG = ".$_GET['FORETAG']);
while($row = mysql_fetch_array($results)){
for ($val = 1; $val <= 10; $val++){
if(!($data[$val])) $data[$val] = 0;
if($row[0] == $val) $data[$val]++;
} // end for
} // end while
if($_GET['GruppID']) $cimgn = 'nyutv_g_'.$_GET['GruppID'].'_f_'.$x.'_'.implode($data).'.png';
elseif($_GET['FORETAG']) $cimgn = 'nyutv_f_'.$_GET['FORETAG'].'_f_'.$x.'_'.implode($data).'.png';
unset($data);

// Setup the basic parameters for the graph
$graph = new Graph(670,500,$cimgn);
$graph->SetAngle(90);
$graph->SetScale("textlin");
$graph->SetMargin(140,150,0,-30);
$graph->SetMarginColor('white');

// Setup title for graph
$graph->title->Set($headline);
$graph->title->SetFont(FF_ARIAL,FS_BOLD,13);
$graph->title->SetMargin(15);
$graph->subtitle->Set($headline2);
$graph->subtitle->SetFont(FF_ARIAL,FS_ITALIC);

// Setup X-axis.
$graph->xaxis->SetTitle("Värde",'low');
$graph->xaxis->title->SetFont(FF_ARIAL,FS_NORMAL);
$graph->xaxis->title->SetAngle(0);
$graph->xaxis->SetTitleMargin(-70);
$graph->xaxis->SetLabelMargin(20);
$graph->xaxis->SetLabelAlign('left','center');
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,9);
$graph->xaxis->SetPos('min');
$graph->xaxis->SetTitleSide(SIDE_UP);

// Setup Y-axis
$graph->yaxis->SetPos('max');
$a = array(10,9,8,7,6,5,4,3,2,1);
$graph->xaxis->SetTickLabels($a);
$graph->xaxis->SetFont(FF_FONT2);
$graph->xaxis->SetLabelMargin(20);
// Arrange the title
$graph->yaxis->SetTitle("Antal svar",'center');
$graph->yaxis->SetTitleSide(SIDE_RIGHT);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_NORMAL);
$graph->yaxis->title->SetAngle(0);
$graph->yaxis->title->Align('center','top');
$graph->yaxis->SetTitleMargin(30);

// Arrange the labels
$graph->yaxis->SetLabelSide(SIDE_RIGHT);
$graph->yaxis->SetLabelAlign('center','top');
$graph->yaxis->SetLabelMargin(10);
$graph->legend->SetFont(FF_ARIAL,FS_ITALIC,9);
$graph->legend->Pos( 0.02,0.92,"right" ,"top");
$graph->SetTickDensity(TICKD_VERYSPARSE);

$p = 'p'.$x;

// Data
if($_GET['GruppID']) $results = mysql_unbuffered_query("SELECT f".$x." FROM nyutvtabell WHERE GruppID=".$_GET['GruppID']);
elseif($_GET['FORETAG']) $results = mysql_unbuffered_query("SELECT u.f".$x." FROM nyutvtabell u, grupptabell g WHERE u.GruppID = g.id AND g.FORETAG = ".$_GET['FORETAG']);

while($row = mysql_fetch_array($results)){
for ($val = 1; $val <= 10; $val++){
if(!($data[$val-1])) $data[$val-1] = 0;
if($row[0] == $val) $data[$val-1]++;
}
}
$data = array_reverse($data,false);

// Create the bar plots
$$p = new BarPlot($data);
$$p->SetFillColor("yellow");
$$p->value->Show();
$$p->value->HideZero();
$$p->value->SetFormat('%d');
$$p->value->SetFont(FF_ARIAL,FS_NORMAL,9);
$$p->SetValuePos('center');

// Setup labels
$lbl[$x-1] = $x.'. '.(utf8_decode($fr[0]));

$graph->Add($$p);
$graph->Stroke();
?>