<?php
//============================================================+
// File name   : example_021.php
// Begin       : 2008-03-04
// Last Update : 2008-03-28
// 
// Description : Example 021 for TCPDF class
//               WriteHTML text flow
// 
// Author: Nicola Asuni
// 
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com s.r.l.
//               Via Della Pace, 11
//               09044 Quartucciu (CA)
//               ITALY
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML text flow.
 * @author Nicola Asuni
 * @copyright 2004-2008 Nicola Asuni - Tecnick.com S.r.l (www.tecnick.com) Via Della Pace, 11 - 09044 - Quartucciu (CA) - ITALY - www.tecnick.com - info@tecnick.com
 * @link http://tcpdf.org
 * @license http://www.gnu.org/copyleft/lesser.html LGPL
 * @since 2008-03-04
 */

require_once('../config/lang/eng.php');
require_once('../tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true); 

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor("Nicola Asuni");
$pdf->SetTitle("TCPDF Example 021");
$pdf->SetSubject("TCPDF Tutorial");
$pdf->SetKeywords("TCPDF, PDF, example, test, guide");

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 

//set some language-dependent strings
$pdf->setLanguageArray($l); 

//initialize document
$pdf->AliasNbPages();

// add a page
$pdf->AddPage();

// ---------------------------------------------------------

// set font
$pdf->SetFont("vera", "", 9);

// create some HTML content
$htmlcontent = "In the first-grade group, the ANOVA revealed a significant effect of lexical frequency, <em>F1</em> (1, 19)&nbsp;=&nbsp;165.69, <em>p</em>&nbsp;&lt;&nbsp;.001, <em>MSE</em> = 212; <em>F2</em> (1,118)&nbsp;=&nbsp;65.35, <em>p</em>&nbsp;&lt;&nbsp;.001, <em>MSE</em> = 1612. More high-frequency words than low-frequency words were identified (76% vs. 50%, respectively). A significant effect of fixation position was also found. There were more correct identifications when the viewing position corresponded to the middle of the word (79% in P2 and P3) than to the beginning (62% in P1) or the end (59% and 39% in P4 and P5, respectively), <em>F1</em> (4, 76)&nbsp;=&nbsp;69.25, <em>p</em> &lt; .001,<em>MSE</em>&nbsp;=&nbsp;158; <em>F2</em> (4, 472)&nbsp;=&nbsp;65.45,<em>p</em>&nbsp;&lt;&nbsp;.001, <em>MSE</em>&nbsp;=&nbsp;503. No interaction was found between the two factors (see Figure 1), <em>F1</em> (4,76)&nbsp;=&nbsp;1.89, <em>p</em>&nbsp;=&nbsp;.12, <em>MSE</em>&nbsp;=&nbsp;165;<em>F2</em> (4, 472)&nbsp;=&nbsp;1.86, <em>p</em>&nbsp;=&nbsp;.12,<em>MSE</em>&nbsp;=&nbsp;503.";

// output the HTML content
$pdf->writeHTML($htmlcontent, true, 0, true, 0);

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output();

//============================================================+
// END OF FILE                                                 
//============================================================+
?>