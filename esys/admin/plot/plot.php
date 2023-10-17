<?php
//---------------------
//class plot2D - 3/1/01
//version 0.5         
//By Nelson Rothermel  
//baatsaam@hotmail.com 
//modified by whatform 26/4/06
//version 0.8
//added utf8 decoding and 
//values print out at coordinates
//and bg image and some tweaks
//removed sum reporting and descriptions
//mail@whatform.se
//---------------------

class plot2D {
 var $img, $imgWidth, $imgHeight, $fontSize, $fontWidth, $fontHeight, $cBack, $acPlot, $maxCatLen, $aItems, $maxVal, $defMaxVal, $numItems, $maxNumItems, $maxLinesDesc, $numberY, $cBlack, $cGrid;
 var $graphX, $graphY, $graphWidth, $graphHeight;
 var $titleString, $titleFontSize, $cTitle, $titleWidth, $titleHeight;
 var $xDesc, $yDesc, $xDescLength, $yDescLength;
 function plot2D($imagefile, $width=640, $height=480, $fontSize=2, $red=0xFF, $green=0xFF, $blue=0xFF, $defMaxVal=0) {
  $this->img = imageCreateFromPng($imagefile);
  $this->imgWidth = $width-10;
  $this->imgHeight = $height;
  $this->cBack = imageColorAllocate($this->img, $red, $green, $blue);
  $this->cBlack = imageColorAllocate($this->img, 0, 0, 0);
  $this->cNavy = imageColorAllocate($this->img, 0x00, 0x00, 0x80);
  $this->botcol = imageColorAllocate($this->img, 204, 0, 21);
  $this->midcol = imageColorAllocate($this->img, 21, 150, 204);
  $this->topcol = imageColorAllocate($this->img, 83, 221, 53);
  $this->fontSize = $fontSize;
  $this->fontWidth = imageFontWidth($fontSize);
  $this->fontHeight = imageFontHeight($fontSize);
  $this->graphX = 0;
  $this->graphY = 0;
  $this->graphWidth = $this->imgWidth;
  $this->graphHeight = $this->imgHeight;
  $this->maxVal = $defMaxVal;
  $this->setGrid();
 }
 
 function setTitle($title, $fontSize=3, $red=0x00, $green=0x00, $blue=0x00) {
  $this->titleString = utf8_decode($title);
  $this->titleFontSize = $fontSize;
  $this->cTitle = imageColorAllocate($this->img, $red, $green, $blue);
  $this->titleWidth = imageFontWidth($fontSize) * strLen($title);
  $this->titleHeight = imageFontHeight($fontSize);
  $this->graphY = $this->graphY + ($this->titleHeight + 2);
  $this->graphHeight = $this->graphHeight - ($this->titleHeight + 2);
 }
 
 function setDescription($x, $y="") {
  if ($x) {
   $this->xDesc = utf8_decode($x);
   $this->xDescLength = $this->fontWidth * strLen($x);
   $this->graphHeight = $this->graphHeight - ($this->fontHeight + 2);
  }
  
  if ($y) {
   $this->yDesc = utf8_decode($y);
   $this->yDescLength = $this->fontWidth * strLen($y);
   $this->graphX = $this->graphX + ($this->fontHeight + 2);
   $this->graphWidth = $this->graphWidth - ($this->fontHeight + 2);
  }
 }
 
 function setGrid($number=5, $red=0xCC, $green=0xCC, $blue=0xCC) { //Horizontal grid
  $this->cGrid = imageColorAllocate($this->img, $red, $green, $blue);
  $this->numberY = $number;
 }
 
 function addCategory($description, $red, $green, $blue) {
  $description = utf8_decode($description);
  $this->acPlot[$description] = imageColorAllocate($this->img, $red, $green, $blue);
  if (strLen($description) > $this->maxCatLen)
   $this->maxCatLen = strLen($description);
 }
 
 function categoryExists($description) {
  $description = utf8_decode($description);
  if (isSet($this->acPlot[$description])) {
   return true;
  } else {
   return false;
  }
 }
 
 function addItem($category, $description, $value) {
  $category = utf8_decode($category);
  $description = utf8_decode($description);
  $this->aItems[$category][$description] = $value;
  $this->checkItem($category, $description, $this->aItems[$category][$description]);
 }
 
 function incrementItem($category, $description, $value) {
  $category = utf8_decode($category);
  $description = utf8_decode($description);
  if (!isSet($this->aItems[$category][$description]))
   $this->addItem($category, $description, $value);
  $this->aItems[$category][$description] = $this->aItems[$category][$description] + $value;
  $this->checkItem($category, $description, $this->aItems[$category][$description]);
 }
 
 function checkItem($category, $description, $value) {
  $category = utf8_decode($category);
  $description = utf8_decode($description);
  if ($value > $this->maxVal)
   $this->maxVal = $value;
  $this->numItems[$category]++;
  if ($this->numItems[$category] > $this->maxNumItems)
   $this->maxNumItems = $this->numItems[$category];
  if (sizeOf(explode("\n", $description)) > $this->maxLinesDesc)
   $this->maxLinesDesc = sizeOf(explode("\n", $description));
 }
 
 function destroy() {
  imageDestroy($this->img);
 }
 
 function printGraph($filename = 0,$thickness = 1) {
imagesetthickness($this->img,$thickness); 
  $this->graphHeight = $this->graphHeight - (($this->maxLinesDesc + 1) * ($this->fontHeight + 2)); //Adjust for bottom values
  $this->graphX = $this->graphX +(0.026 * $this->graphWidth); //Adjust left margin for values
$this->graphWidth = $this->graphWidth -(0.01 * $this->graphWidth);
  if ($this->titleString)
   imageString($this->img, $this->titleFontSize, $this->graphX + ($this->graphWidth / 2) - ($this->titleWidth / 2), 0, $this->titleString, $this->cTitle);
  if ($this->xDesc)
   imageString($this->img, $this->fontSize, $this->graphX + ($this->graphWidth / 2) - ($this->xDescLength / 2), $this->graphY + $this->graphHeight + (($this->maxLinesDesc + 1) * ($this->fontHeight - 5)), $this->xDesc, $this->cBlack);
  if ($this->yDesc)
   imageStringUp($this->img, $this->fontSize, 0, ($this->graphY + ($this->graphHeight / 2.4)) + ($this->xDescLength / 2), $this->yDesc, $this->cBlack);
  for ($i = 0; $i <= $this->numberY; $i++) { //Grid
    $yPos = $this->graphY + $i * ($this->graphHeight / ($this->numberY + 1));
   if ($i)
    imageLine($this->img, $this->graphX+1, $yPos, $this->graphX + $this->graphWidth - (0.007 * $this->graphWidth), $yPos, $this->cGrid);
   $yVal = floor($this->maxVal - (($this->maxVal / ($this->numberY + 1)) * $i) + .5);
  }  
  $c = 0;
  while (list($cDesc, $cColor) = each($this->acPlot)) { //Loop through categories
   $s=0;
   while (list($sKey, $sVal) = each($this->aItems[$cDesc])) { //Loop through items
    $sum[$cDesc] += $sVal; //Sum up values for each category
    $xPos = ($this->graphX + 4) + ((($this->graphWidth - 10) / ($this->maxNumItems - 1)) * $s);
    $yPos = $this->graphY + ($this->graphHeight - floor((($sVal / $this->maxVal) * $this->graphHeight) + .5));
    $strPos = $xPos - ((strLen($sVal) * $this->fontWidth) /2);
    if ($strPos < 50) $strPos = $strPos + ((strLen($sVal) * $this->fontWidth) /2.5);
    if ($this->graphWidth - $xPos < $this->graphWidth * 0.03) $xPos = $xPos -(0.003 * $this->graphWidth);
    if ($this->graphWidth - $xPos < $this->graphWidth * 0.03) $strPos = $strPos -(0.015 * $this->graphWidth);
    if ($sVal > 0) imageString($this->img, $this->fontSize, $strPos, $yPos + 5, $sVal, $cColor);
    if ($sVal > 0) imageFilledRectangle($this->img, $xPos - 2, $yPos - 2, $xPos + 2, $yPos + 2, $cColor);
    if ($s and $sVal > 0)
     imageLine($this->img, $prevX, $prevY, $xPos, $yPos, $cColor);
    $prevX = $xPos;
    $prevY = $yPos;
    $s++;
   }
   $c++;
  }
  if ($filename) {
   imagePNG($this->img, "$filename.png");
  } else {
   imagePNG($this->img);
  }
 }
}
?>