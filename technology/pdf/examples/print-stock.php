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
 $api = new Product();
$from_date = $api->getFormatDate(htmlentities($_GET['from_date']));
$to_date = $api->getFormatDate(htmlentities($_GET['to_date']));


$api->SetFromDate($from_date);
$api->SetToDate($to_date);

$result = $api->getStockReport();


// extend TCPF with custom functions
class MYPDF extends TCPDF {

    public function Header()
    {
        $this->SetFont('phetsarathot', '', 10);
        $this->Cell(0, 40, '', 0, true, 'C', 0, '', 0, false, 'M', 'M');

      //  $this->Cell(0, 8, Language::getTranslate('report_title1'), 0, true, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 2, '', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
     //   $this->Cell(0, 20, Language::getTranslate('report_title2'), 0, true, 'C', 0, '', 0, false, 'M', 'M');
      //  $this->Cell(0, 8, '*****************', 0, true, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Colored table
    public function ColoredTable($header,$result) {
        // Colors, line width and bold font
        $this->SetFont('phetsarathot', '', 8);
        /// Colors, line width and bold font
        $this->SetFillColor(0, 80, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.1);
        $this->SetFont('', 'B');
        // Header
        $w = array(20, 50, 30, 25, 20, 30);
        // $w = array(5, 25, 40, 15, 20, 20, 7, 20, 20);
        $num_headers = count($header);
        for ($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(200, 230, 255);
        $this->SetTextColor(0);
        $this->SetFont('phetsarathot', '', 10);
        // Data

        $price = 0;
        $total_price = 0;

        $qty = 0;
        $total_qty = 0;

        $price_qty = 0;
        $total_buy_price = 0;

        $total_price_qty=0;
        $total_discount =0;

        $fill = 0;
        $y=0;


        foreach ($result as $odt) {
            $y++;
            $this->Cell($w[0], 4, str_pad($y, '1', '0', STR_PAD_LEFT), '1', 0, 'C', $fill);
            $this->Cell($w[1], 4, $odt['product_name'], '1', 0, 'L', $fill);
            $this->Cell($w[2], 4, $odt['type_name'], '1', 0, 'C', $fill);
            $this->Cell($w[3], 4, $odt['price'], '1', 0, 'C', $fill);
            $this->Cell($w[4], 4, $odt['inventory_qty'], '1', 0, 'C', $fill);
            $this->Cell($w[5], 4, date("d/m/Y", strtotime($odt['created'])), '1', 0, 'C', $fill);
            // $this->Cell($w[6], 4, '', '1', 0, 'C', $fill);
            // $this->Cell($w[7], 4, '', '1', 0, 'C', $fill);
            // $this->Cell($w[8], 4,  '', '1', 0, 'C', $fill);


            // $y++;
            // $this->Cell($w[0], 4, str_pad($y, '1', '0', STR_PAD_LEFT), '1', 0, 'C', $fill);
            // $this->Cell($w[1], 4, $row['product_name'], '1', 0, 'L', $fill);
            // $this->Cell($w[2], 4, '', '1', 0, 'L', $fill);
            // $this->Cell($w[3], 4, '', '1', 0, 'C', $fill);
            // $this->Cell($w[4], 4, '', '1', 0, 'C', $fill);
            // $this->Cell($w[5], 4, number_format($row['price_qty']), '1', 0, 'C', $fill);
            // $this->Cell($w[6], 4, $row['qty'], '1', 0, 'C', $fill);
            // $this->Cell($w[7], 4, number_format($row['price']), '1', 0, 'C', $fill);
            // $this->Cell($w[8], 4,  '', '1', 0, 'C', $fill);


            $this->Ln();
            $fill = !$fill;
            $i++;


            $price_qty += $odt['price'];
            // $price += $odt['price_qty'];
            $qty += $odt['inventory_qty'];
            // $buy_price += $row['buy_price'] - $row['discount'];
            // $discount += $row['discount'];
        }
        $total_price_qty += $price_qty;
        // $total_price += $price;
        $total_qty += $qty;
        


        $this->SetFont('', 'B');
        $this->Cell($w[0]+$w[1]+$w[2], 4, 'ລວມ: ', 'TR', 0, 'R', 0, '');
        $this->Cell($w[3], 4, number_format($total_price_qty), 1, 0, 'C', 0, '');
        $this->Cell($w[4], 4, number_format($total_qty), 1, 0, 'C', 0, '');
        // $this->Cell($w[5], 4, number_format($total_price), 1, 0, 'C', 0, '');
        // $this->Cell($w[8], 4, number_format($total_discount), 1, 0, 'C', 0, '');
        $this->SetFont('', '');
        $this->Ln();

    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->setAuthor('SONGTALE BREWHOUSE');
$pdf->setTitle('Report Stock');
$pdf->setSubject('Report Stock');
$pdf->setKeywords('Report Stock');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 011', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
// add a page
$pdf->AddPage('P');
// set font
$pdf->SetFont('helvetica', '', 12);

//$pdf->Image('images/p_dms.jpg', 95, 3, 0, 0, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 0, false, false, false);

$pdf->Image('images/favicon.png', 15, 5, 0, 0, 'png', 'http://www.tcpdf.org', '', true, 100, '', false, false, 0, false, false, false);
//      Set font
$pdf->SetFont('phetsarathot', '', 8);
// Title
//
$pdf->Cell(0, 0, '', 0, true, 'C', 0, '', 0, false, 'M', 'M');

$pdf->writeHTMLCell(0, 0, 35, 7, '<h4>SONGTALE BREWHOUSE</h4>', 0, 0, 0, true, 'L', true);
// $pdf->writeHTMLCell(0, 0, 30, 11, '<h4>KV Shop Company Co., Ltd</h4>', 0, 0, 0, true, 'L', true);
$pdf->SetFont('phetsarathot', '', 8);
$pdf->writeHTMLCell(0, 0, 35, 15, '<h4>ເບີໂທລະສັບ: +85620 76661888</h4>', 0, 0, 0, true, 'L', true);
$pdf->writeHTMLCell(0, 0, 35, 19, '<h4>ອີເມວ: info@kv.com</h4>', 0, 0, 0, true, 'L', true);

$pdf->SetFont('phetsarathot', '', 8);
$pdf->writeHTMLCell(0, 0, 130, 11, '<h4>ເລກທີ............../ວດຊ</h4>', 0, 0, 0, true, 'L', true);
$pdf->writeHTMLCell(0, 0, 120, 15, '<h4>ນະຄອນຫຼວງວຽງຈັນ,ວັນທີ.............. /........../...............</h4>', 0, 0, 0, true, 'L', true);



$pdf->writeHTMLCell(0, 0, '', 35, '<h2><u>Stock</u></h2>', 0, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(0, 0, '', 39, '<h4>ວັນທີ : '.date("d/m/Y", strtotime($from_date)).' </h4>', 0, 0, 0, true, 'L', true);
$pdf->writeHTMLCell(0, 0, '', 42, '<h4>ຫາ : '.date("d/m/Y", strtotime($to_date)).'</h4>', 0, 0, 0, true, 'L', true);

$pdf->writeHTMLCell(0, 0, '', 44, '', 0, 0, 0, true, 'C', true);


// column titles
$pdf->Ln(2);
$header = array('#', 'ສິນຄ້າ', 'ປະເພດ', 'ລາຄາ', 'ຈ/ນ', 'ວ.ດ.ປ');


// print colored table
$pdf->ColoredTable($header, $result);

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('report-order.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+