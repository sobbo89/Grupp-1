<?php 
error_reporting(0);
//error_reporting(E_ALL^E_NOTICE);
// db connect
include "../inc/db.inc.php";

for ($x = 1; $x <= 9; $x++){
$results = mysql_query("SELECT f".$x." FROM chefsutvtabell") or die(mysql_error());
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
}

// $Id: chefsutv.php,v 1.3 2002/08/31 20:03:46 aditus Exp $
// Horiontal bar graph with image maps
include ("../../jpgraph/src/jpgraph.php");
include ("../../jpgraph/src/jpgraph_bar.php");

// Setup the basic parameters for the graph
$graph = new Graph(400,700);
$graph->SetAngle(90);
$graph->SetScale("textlin");

// The negative margins are necessary since we
// have rotated the image 90 degress and shifted the 
// meaning of width, and height. This means that the 
// left and right margins now becomes top and bottom
// calculated with the image width and not the height.
$graph->img->SetMargin(-80,-80,210,210);

$graph->SetMarginColor('white');

// Setup title for graph
$graph->title->Set('Horizontal bar graph');
$graph->title->SetFont(FF_FONT2,FS_BOLD);
$graph->subtitle->Set("With image map\nNote: The URL just points back to this image");

// Setup X-axis.
$graph->xaxis->SetTitle("X-title",'center');
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetAngle(90);
$graph->xaxis->SetTitleMargin(30);
$graph->xaxis->SetLabelMargin(15);
$graph->xaxis->SetLabelAlign('right','center');

// Setup Y-axis

// First we want it at the bottom, i.e. the 'max' value of the
// x-axis
$graph->yaxis->SetPos('max');

// Arrange the title
$graph->yaxis->SetTitle("Turnaround (mkr)",'center');
$graph->yaxis->SetTitleSide(SIDE_RIGHT);
$graph->yaxis->title->SetFont(FF_FONT2,FS_BOLD);
$graph->yaxis->title->SetAngle(0);
$graph->yaxis->title->Align('center','top');
$graph->yaxis->SetTitleMargin(30);

// Arrange the labels
$graph->yaxis->SetLabelSide(SIDE_RIGHT);
$graph->yaxis->SetLabelAlign('center','top');

// Create the bar plots with image maps
$b1plot = new BarPlot($data1y);
$b1plot->SetFillColor("orange");

$b2plot = new BarPlot($data2y);
$b2plot->SetFillColor("blue");

$b3plot = new BarPlot($data3y);
$b3plot->SetFillColor("red");

// Create the accumulated bar plot
$abplot = new AccBarPlot(array($b1plot,$b2plot,$b3plot));
$abplot->SetShadow();

// We want to display the value of each bar at the top
$abplot->value->Show();
$abplot->value->SetFont(FF_FONT1,FS_NORMAL);
$abplot->value->SetAlign('left','center');
$abplot->value->SetColor("black","darkred");
$abplot->value->SetFormat('%.1f mkr');

// ...and add it to the graph
$graph->Add($abplot);

// Send back the HTML page which will call this script again
// to retrieve the image.
$graph->Stroke();

?>
