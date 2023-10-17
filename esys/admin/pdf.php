<?php
$basepath = 'tcpdf';

require_once($basepath.'/config/lang/eng.php');
require_once($basepath.'/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A3', true); 

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor("webbutvecklarna.se");
$pdf->SetTitle("Antingen Esys PDF");
$pdf->SetSubject(" Esys PDF Utskrift");
$pdf->SetKeywords(", PDF, Esys, utskrift, statistik");

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

//set margins
$pdf->SetMargins(10, 5, 10);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 5);

//set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 
$pdf->setImageScale(1);
$pdf->setJPEGQuality(100);  

//set some language-dependent strings
$pdf->setLanguageArray($l); 

//initialize document
$pdf->AliasNbPages();

// add a page
//$pdf->AddPage();

// ---------------------------------------------------------

// set font
$pdf->SetFont("FreeSerif", "", 11);

// create some HTML content
$htmlcontent = $html_output;

// output the HTML content
$pdf->writeHTML($htmlcontent, true, 0, true, 0);

// reset pointer to the last page
$pdf->lastPage();

//Close and output PDF document
//ob_clean();
ob_start();
$pdf->Output();
ob_end_flush();
//============================================================+
// END OF FILE                                                 
//============================================================+
?>