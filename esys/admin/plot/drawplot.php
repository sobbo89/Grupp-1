<?php
import_request_variables("G", "dp_");
include ("plot.php");
//Example -- comment this out if you want to use the class on other pages.
header ("Content-type: image/png");  #Line added to ensure image displays correctly in browser

$plot = new plot2D($dp_imagefile, 601, 452, 3, 0xFF, 0xFF, 0xFF, $dp_res); #optional, default would be plot2D();
$plot->setTitle($dp_setTitle);
//$plot->setDescription($dp_setDescX, $dp_setDescY);
$plot->setGrid(7, 0xCC, 0xCC, 0xCC); #optional, default would be setGrid();
$plot->addCategory($dp_C1, $dp_red, $dp_blue, $dp_green);
 $plot->addItem($dp_C1, "1", $dp_C1v1);
 $plot->addItem($dp_C1, "2", $dp_C1v2);
 $plot->addItem($dp_C1, "3", $dp_C1v3);
$plot->printGraph("0","1");
$plot->destroy();
?>