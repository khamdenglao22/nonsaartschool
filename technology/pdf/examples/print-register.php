<?php
//============================================================+
// File name   : example_028.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 028 for TCPDF class
//               Changing page formats
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: changing page formats
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

require_once('../../core/init.php');

$api = new Register();

$st_id = htmlentities($_GET['student_id']);
$sch_id = htmlentities($_GET['sch_id']);

$api->SetStudentId($st_id);
$api->SetSchId($sch_id);

$result = $api->getReportRegister();


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('ໃບບິນ');
$pdf->SetSubject('ໃບບິນ');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(10, PDF_MARGIN_TOP, 10);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');

// set font
$pdf->SetFont('times', 'B', 20);

// $pdf->AddPage('P', 'A4');
// $pdf->Cell(0, 0, 'A4 PORTRAIT', 1, 1, 'C');

// $pdf->AddPage('L', 'A4');
// $pdf->Cell(0, 0, 'A4 LANDSCAPE', 1, 1, 'C');

// $pdf->AddPage('P', 'A5');
// $pdf->Cell(0, 0, 'A5 PORTRAIT', 1, 1, 'C');

// $pdf->AddPage('L', 'A5');
// $pdf->Cell(0, 0, 'A5 LANDSCAPE', 1, 1, 'C');

// $pdf->AddPage('P', 'A6');
// $pdf->Cell(0, 0, 'A6 PORTRAIT', 1, 1, 'C');


$pdf->AddPage('L', 'A6');
// $pdf->Cell(0, 0, 'ຊື່ ແລະ ນາມສະກຸນ............', 0, 1, 'L');
// $pdf->Cell(0, 0, 'A6 LANDSCAPE', 0, 1, 'L');
// $pdf->Cell(0, 0, 'A6 LANDSCAPE', 0, 1, 'L');
foreach ($result as $odt) {
$pdf->SetFont('phetsarathot', '',12);
$pdf->writeHTMLCell(0, 0, 10, 23, '<h4>ໃບບິນຮັບເງີນບູລະນະໂຮງຮຽນ ສົກຮຽນ: '.$odt['sch_name'].'</h4>', 0, 0, 0, true, 'C', true);


$pdf->writeHTMLCell(0, 0, 10, 36, '<h4>ຊື່ ແລະ ນາມສະກຸນ: ............................................ </h4>', 0, 0, 0, true, 'L', true);
$pdf->SetFont('phetsarathot', '',12);

$pdf->writeHTMLCell(0, 0, 50, 35, '<h4>'.$odt['st_name'].'</h4>', 0, 0, 0, true, 'L', true);

$pdf->writeHTMLCell(0, 0, 100, 36, '<h4>ຫ້ອງ: ...........</h4>', 0, 0, 0, true, 'L', true);
$pdf->writeHTMLCell(0, 0, 113, 35, '<h4>'.$odt['class_name'].'</h4>', 0, 0, 0, true, 'L', true);

$pdf->writeHTMLCell(0, 0, 10, 42, '<h4>ຈຳນວນເງີນ ສົມທົບທືນ, ບູລະນະ ແລະ ພັດທະນາໂຮງຮຽນ:</h4>', 0, 0, 0, true, 'L', true);
$pdf->writeHTMLCell(0, 0, 10, 49, '<h4>ຈຳນວນເງີນ: .........................</h4>', 0, 0, 0, true, 'L', true);
$pdf->writeHTMLCell(0, 0, 35, 48, '<h4>'.number_format($odt['pay']).' ກີບ</h4>', 0, 0, 0, true, 'L', true);
$pdf->writeHTMLCell(0, 0, 65, 49, '<h4>ວັນທີ່ຈ່າຍ: ..............................</h4>', 0, 0, 0, true, 'L', true);
$pdf->writeHTMLCell(0, 0, 85, 48, '<h4>'.date("d/m/Y", strtotime($odt['reg_date'])).'</h4>', 0, 0, 0, true, 'L', true);


// $pdf->writeHTMLCell(0, 0, 10, 36, '<h4>ຂື້ນຫ້ອງ: ມ2/1</h4>', 0, 0, 0, true, 'L', true);

$pdf->writeHTMLCell(0, 0, 10, 66, '<h4>ຜູ້ຮັບເງີນ</h4>', 0, 0, 0, true, 'L', true);
$pdf->writeHTMLCell(0, 0, 90, 66, '<h4>ຜູ້ມອບ</h4>', 0, 0, 0, true, 'L', true);


$pdf->writeHTMLCell(0, 0, 10, 73, '<h4>'.$odt['teach_name'].'</h4>', 0, 0, 0, true, 'L', true);
$pdf->writeHTMLCell(0, 0, 80, 73, '<h4>'.$odt['st_name'].'</h4>', 0, 0, 0, true, 'L', true);

}



// $pdf->writeHTMLCell(0, 0, '', 35, '<h2><u>Stock</u></h2>', 0, 0, 0, true, 'C', true);
// $pdf->writeHTMLCell(0, 0, '', 39, '<h4>ວັນທີ : </h4>', 0, 0, 0, true, 'L', true);
// $pdf->writeHTMLCell(0, 0, '', 42, '<h4>ຫາ : </h4>', 0, 0, 0, true, 'L', true);


// $pdf->AddPage('P', 'A7');
// $pdf->Cell(0, 0, 'A7 PORTRAIT', 1, 1, 'C');

// $pdf->AddPage('L', 'A7');
// $pdf->Cell(0, 0, 'A7 LANDSCAPE', 1, 1, 'C');



// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_028.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+