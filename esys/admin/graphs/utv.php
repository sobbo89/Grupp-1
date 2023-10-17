<?php 
error_reporting(0);
//error_reporting(E_ALL^E_NOTICE);
// db connect
include "../inc/db.inc.php";

// get headline
if($_GET['GruppID']) $hl = mysql_fetch_array(mysql_query("SELECT gruppnamn FROM grupptabell WHERE ID=".$_GET['GruppID'])) or die(mysql_error());
$headline = $hl[0];
$headline2 = date("Y-m-d")." kl ".date("H:i");


//name the cache img
$results = mysql_query("SELECT f1,f2,f3,f4,f5,f6,f7,f8,f9,f10 FROM utvtabell WHERE GruppID=".$_GET['GruppID']) or die(mysql_error());
while($row = mysql_fetch_array($results)){
for ($val = 2; $val <= 8; $val++){
if(!($data[$val])) $data[$val] = 0;
if(!($data[$val+10])) $data[$val+10] = 0;
if(!($data[$val+20])) $data[$val+20] = 0;
if(!($data[$val+30])) $data[$val+30] = 0;
if(!($data[$val+40])) $data[$val+40] = 0;
if(!($data[$val+50])) $data[$val+50] = 0;
if(!($data[$val+60])) $data[$val+60] = 0;
if(!($data[$val+70])) $data[$val+70] = 0;
if(!($data[$val+80])) $data[$val+80] = 0;
if(!($data[$val+90])) $data[$val+90] = 0;
if(round($row[0]) == $val) $data[$val]++;
if(round($row[1]) == $val) $data[$val+10]++;
if(round($row[2]) == $val) $data[$val+20]++;
if(round($row[3]) == $val) $data[$val+30]++;
if(round($row[4]) == $val) $data[$val+40]++;
if(round($row[5]) == $val) $data[$val+50]++;
if(round($row[6]) == $val) $data[$val+60]++;
if(round($row[7]) == $val) $data[$val+70]++;
if(round($row[8]) == $val) $data[$val+80]++;
if(round($row[9]) == $val) $data[$val+90]++;
}
}
$cimgn = 'utv_g_'.$_GET['GruppID'].'_'.implode($data).'.png';
unset($data);


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


// $Id: chefsutv.php,v 1.3 2002/08/31 20:03:46 aditus Exp $
// Horiontal bar graph with image maps
include ("../../jpgraph/src/jpgraph.php");
include ("../../jpgraph/src/jpgraph_bar.php");

// Setup the basic parameters for the graph
//$graph = new Graph(400,700);
$graph = new Graph(670,700,$cimgn);
$graph->SetAngle(90);
$graph->SetScale("textlin");

// The negative margins are necessary since we
// have rotated the image 90 degress and shifted the 
// meaning of width, and height. This means that the 
// left and right margins now becomes top and bottom
// calculated with the image width and not the height.
//$graph->img->SetMargin(l,r,t,b); (t,b,r,l) (1,2 tillsammans med motsatta värden 3,4 likaså)
//$graph->img->SetMargin(-80,-80,210,210);
$graph->img->SetMargin(-110,212,182,178);

$graph->SetMarginColor('white');

// Setup title for graph
$graph->title->Set($headline);
$graph->title->SetFont(FF_ARIAL,FS_BOLD,14);
$graph->title->SetMargin(15);
$graph->subtitle->Set($headline2);
$graph->subtitle->SetFont(FF_ARIAL,FS_ITALIC);

// Setup X-axis.
$graph->xaxis->SetTitle("Frågor",'center');
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetAngle(90);
$graph->xaxis->SetTitleMargin(30);
$graph->xaxis->SetLabelMargin(-350);
$graph->xaxis->SetLabelAlign('left','center');
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,9);
$graph->xaxis->SetTickLabels($lbl);

// Setup Y-axis

// First we want it at the bottom, i.e. the 'max' value of the
// x-axis
$graph->yaxis->SetPos('max');

// Arrange the title
$graph->yaxis->SetTitle("Andelar svar i %",'center');
$graph->yaxis->SetTitleSide(SIDE_RIGHT);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->yaxis->title->SetAngle(0);
$graph->yaxis->title->Align('center','top');
$graph->yaxis->SetTitleMargin(30);

// Arrange the labels
$graph->yaxis->SetLabelSide(SIDE_RIGHT);
$graph->yaxis->SetLabelAlign('center','top');

$graph->legend->SetFont(FF_ARIAL,FS_ITALIC,9);

// Create the bar plots
$b1plot = new BarPlot($data1y);
$b1plot->SetFillColor("orange");
$b1plot->value->Show();
$b1plot->value->SetFormat('%d%%');
$b1plot->value->SetFont(FF_ARIAL,FS_NORMAL,9);
$b1plot->SetValuePos('center');
$b1plot->SetLegend (utf8_decode("Instämmer inte alls"));

$b2plot = new BarPlot($data2y);
$b2plot->SetFillColor("blue");
$b2plot->value->Show();
$b2plot->value->SetFormat('%d%%');
$b2plot->value->SetFont(FF_ARIAL,FS_NORMAL,9);
$b2plot->SetValuePos('center');
$b2plot->SetLegend (utf8_decode("Instämmer delvis"));

$b3plot = new BarPlot($data3y);
$b3plot->SetFillColor("green");
$b3plot->value->Show();
$b3plot->value->SetFormat('%d%%');
$b3plot->value->SetFont(FF_ARIAL,FS_NORMAL,9);
$b3plot->SetValuePos('center');
$b3plot->SetLegend (utf8_decode("Instämmer"));

$graph ->legend->Pos( 0.02,0.92,"right" ,"top");

$b0plot = new BarPlot($data0);

// Create the accumulated bar plot
$abplot = new AccBarPlot(array($b1plot,$b2plot,$b3plot));
$abplot->SetShadow();

// ...and add it to the graph
$graph->Add($abplot);



// Send back the HTML page which will call this script again
// to retrieve the image.
$graph->Stroke();

?>
