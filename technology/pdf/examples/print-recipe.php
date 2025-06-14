<?php
//============================================================+
// File name   : example_011.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 011 for TCPDF class
//               Colored Table (very simple table)
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
 * @abstract TCPDF - Example: Colored Table
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

require_once('../../core/init.php');


$api = new Register();


$sch_id = htmlentities($_GET['sch_id']);

$api->SetSchId($sch_id);


$result = $api->getViewRecipePrint();


// extend TCPF with custom functions
class MYPDF extends TCPDF
{

  public function Header()
  {
    $this->SetFont('phetsarathot', '', 12);
    $this->Cell(0, 10, '', 0, true, 'C', 0, '', 0, false, 'M', 'M');
    $this->Cell(0, 10, 'ສາທາລະນະລັດ ປະຊາທີປະໄຕ ປະຊາຊົນລາວ', 0, true, 'C', 0, '', 0, false, 'M', 'M');
    $this->Cell(0, 10, 'ສັນຕີພາບ ເອກະລາດ ປະຊາທີປະໄຕ ເອກະພາບ ວັດທະນາຖາວອນ', 0, true, 'C', 0, '', 0, false, 'M', 'M');

    //  $this->Cell(0, 8, Language::getTranslate('report_title1'), 0, true, 'C', 0, '', 0, false, 'M', 'M');
    $this->Cell(0, 2, '', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
    //   $this->Cell(0, 20, Language::getTranslate('report_title2'), 0, true, 'C', 0, '', 0, false, 'M', 'M');
    //  $this->Cell(0, 8, '*****************', 0, true, 'C', 0, '', 0, false, 'M', 'M');
  }

  // Colored table
  public function ColoredTable($header, $result)
  {
    // Colors, line width and bold font
    $this->SetFont('phetsarathot', '', 11);
    /// Colors, line width and bold font
    $this->SetFillColor(255);
    $this->SetTextColor(0);
    $this->SetDrawColor(0, 0, 0);
    $this->SetLineWidth(0.1);
    // $this->SetFont('', 'B');
    // Header
    $w = array(10, 30, 40, 40, 60);
    // $w = array(5, 25, 40, 15, 20, 20, 7, 20, 20);
    $num_headers = count($header);
    for ($i = 0; $i < $num_headers; ++$i) {
      $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
    }
    $this->Ln();
    // Color and font restoration
    // $this->SetFillColor(200, 230, 255);
    $this->SetFillColor(255);
    $this->SetTextColor(0);
    $this->SetFont('phetsarathot', '', 10);
    // Data

    $fill = 0;
    $y = 0;

    $total_student = 0;
    $amount_student = 0;
 
    $total_price = 0;
    $amount_price = 0;

    foreach ($result as $odt) {
      $y++;


      $this->Cell($w[0], 7, $y, '1', 0, 'C', $fill);
      $this->Cell($w[1], 7, $odt['level_name'], '1', 0, 'C', $fill);
      $this->Cell($w[2], 7, number_format($odt['pay']), '1', 0, 'C', $fill);
      $this->Cell($w[3], 7, $odt['student'], '1', 0, 'C', $fill);
      $this->Cell($w[4], 7, number_format($odt['price']), '1', 0, 'C', $fill);
      $this->Ln();
      $fill = !$fill;
      $i++;

      $amount_price += $odt['price'];
      $amount_student += $odt['student'];
      
    };

    $total_price += $amount_price;
    $total_student += $amount_student;

    $this->Cell($w[0] + $w[1] + $w[2], 7, 'ລວມ: ', 1, 0, 'R', 0, '');
    $this->Cell($w[3], 7, number_format($total_student), 1, 0, 'C', 0, '');
    $this->Cell($w[4], 7, number_format($total_price), 1, 0, 'C', 0, '');

    $this->Ln();

    //   $this->Cell($w[0], 7, str_pad($y, '1', '0', STR_PAD_LEFT), '1', 0, 'C', $fill);

  }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->setAuthor('SYSTEM SCHOOL');
$pdf->setTitle('Report Score');
$pdf->setSubject('Report Score');
$pdf->setKeywords('Report Score');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 011', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
  require_once(dirname(__FILE__) . '/lang/eng.php');
  $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
// add a page
$pdf->AddPage('P');
// set font
// $pdf->SetFont('helvetica', '', 12);

//$pdf->Image('images/p_dms.jpg', 95, 3, 0, 0, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 0, false, false, false);

// $pdf->Image('images/favicon.png', 15, 5, 0, 0, 'png', 'http://www.tcpdf.org', '', true, 100, '', false, false, 0, false, false, false);
//      Set font
$pdf->SetFont('phetsarathot', '', 10);
// Title
//
$pdf->Cell(0, 0, '', 0, true, 'C', 0, '', 0, false, 'M', 'M');

foreach ($result as $row) {
}

$pdf->writeHTMLCell(0, 0, '', 25, '<h2><u>ລາຍຮັບ ' . $row['sch_name'] . '</u></h2>', 0, 0, 0, true, 'C', true);

//   $pdf->writeHTMLCell(0, 0, '', 35, '<h4>ວີຊາ: ' . $row['sub_name'] . ' </h4>', 0, 0, 0, true, 'L', true);
//   $pdf->writeHTMLCell(0, 0, '', 35, '<h4>ຫ້ອງ: ' . $row['class_name'] . ' </h4>', 0, 0, 0, true, 'C', true);
//   $pdf->writeHTMLCell(0, 0, '', 35, '<h4>ສົກຮຽນ : ' . $row['sch_name'] . ' </h4>', 0, 0, 0, true, 'R', true);


$pdf->writeHTMLCell(0, 0, '', 40, '', 0, 0, 0, true, 'C', true);

// column titles
$pdf->Ln(2);
$header = array('#', 'ຊັ້ນຮຽນ', 'ຄ່າຮຽນ', 'ນັກຮຽນ', 'ຈຳນວນເງິນລວມ');


// print colored table
$pdf->ColoredTable($header, $result);

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('report-order.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+