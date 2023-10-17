<?php
error_reporting(0);
//error_reporting(E_ALL^E_NOTICE);
// db connect
include "../inc/db.inc.php";

// get headline
if($_GET['GruppID']) $hl = mysql_fetch_array(mysql_query("SELECT gruppnamn FROM grupptabell WHERE ID=".$_GET['GruppID'])) or die(mysql_error());
$headline = $hl[0];

$headline2 = date("Y-m-d")." kl ".date("H:i");

// loop the thing
for ($x = 1; $x <= 10; $x++){
// Data
$results = mysql_query("SELECT f".$x." FROM utvtabell WHERE GruppID=".$_GET['GruppID']) or die(mysql_error());
// Labels
$fr = mysql_fetch_array(mysql_query("SELECT f".$x." FROM utvfragor WHERE ID=1")) or die(mysql_error());
while($row = mysql_fetch_array($results)){
if($row[0] == 2) $data1[] = $row[0]; elseif($row[0] == 5) $data2[] = $row[0]; elseif($row[0] == 8) $data3[] = $row[0]; else $data4[] = $row[0];
}
$data1y[$x-1] = count($data1);
$data2y[$x-1] = count($data2);
$data3y[$x-1] = count($data3);
$data4y[$x-1] = count($data4);
unset($data1);
unset($data2);
unset($data3);
unset($data4);

// Setup labels
$lbl[$x-1] = utf8_decode($fr[0]);

// same number of data points as above, all 0 (for 0 plot or extra label)
$data0[$x-1] = 0;

// recalculate to percent on commited responses
$datatot = $data1y[$x-1] + $data2y[$x-1] + $data3y[$x-1];
$data1y[$x-1] = $data1y[$x-1] / $datatot * 100;
$data2y[$x-1] = $data2y[$x-1] / $datatot * 100;
$data3y[$x-1] = $data3y[$x-1] / $datatot * 100;
// end percent
}
// end the loop

include ("../../jpgraph/src/jpgraph.php");
include ("../../jpgraph/src/jpgraph_pie.php");

// Some data

// Create the Pie Graph.
$graph = new PieGraph(350,300,"auto");
$graph->SetShadow();

// Set A title for the plot
$graph->title->Set("Multiple - Pie plot");
$graph->title->SetFont(FF_FONT1,FS_BOLD);

// Create plots
$size=0.13;
$p1 = new PiePlot($data1y);
$p1->SetLegends(array("Jan","Feb","Mar","Apr","May"));
$p1->SetSize($size);
$p1->SetCenter(0.25,0.32);
$p1->value->SetFont(FF_FONT0);
$p1->title->Set("2001");

$p2 = new PiePlot($data2y);
$p2->SetSize($size);
$p2->SetCenter(0.65,0.32);
$p2->value->SetFont(FF_FONT0);
$p2->title->Set("2002");

$p3 = new PiePlot($data3y);
$p3->SetSize($size);
$p3->SetCenter(0.25,0.75);
$p3->value->SetFont(FF_FONT0);
$p3->title->Set("2003");

$graph->Add($p1);
$graph->Add($p2);
$graph->Add($p3);

$graph->Stroke();

?>