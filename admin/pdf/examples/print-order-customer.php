<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
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
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');


require_once('../../core/init.php');

$api = new Order();
$order_id = htmlentities($_GET['order_id']);

$api->SetId($order_id);

$result = $api->getOrderReportCustomer();

/// create header
class MYPDF extends TCPDF
{
	public function Header()
	{
		//favicon.png logo
		$imageFile = K_PATH_IMAGES.'favicon.png';
		$this->Image($imageFile,94.5,10,30, '','PNG','','T',false,300,'',false,false,0,false,false,false);

		$this->Ln(35);
		// font name size style
		// $this->setFont('Phetsarath OT','B',12);
		$this->setFont('helvetica','B',12);
		//189 is total width of A4 page
		$this->Cell(189,5,'SONGTALE BREWHOUSE',0,1,'C');

		// $this->Ln(5);
		// $this->setFont('helvetica','',10);
		// //189 is total width of A4 page
		// $this->Cell(180,5,'Number Phone: +865 02023423423 ',0,1,'L');
		
	}

	public function Footer()
	{
		
	}
	
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);



// // set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('SONGTALE BREWHOUSE');
$pdf->setTitle('Report Order');
$pdf->setSubject('Report Order');
$pdf->setKeywords('Report Order');

// // set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 011', PDF_HEADER_STRING);
// $pdf->SetPrintHeader(false);
// $pdf->SetPrintFooter(false);

// // set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// // set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// // set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// // set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// // set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// // set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// // ---------------------------------------------------------

// // set default font subsetting mode
$pdf->setFontSubsetting(true);

// // Set font
// // dejavusans is a UTF-8 Unicode font, if you only need to
// // print standard ASCII chars, you can use core fonts like
// // helvetica or times to reduce file size.
$pdf->setFont('dejavusans', '', 12, '', true);


// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

foreach ($result as $row) {

$pdf->Ln(30);
$pdf->Cell(130,5,'ລະຫັດ: '.$row['order_no'],0,0);
$pdf->Cell(59,5,'ວັນທີ : '.date("d/m/Y", strtotime($row['created_date'])),0,1);
$pdf->Ln(3);
$pdf->Cell(59,5,'ລູກຄ້າ: '.$row['first_name'],0,1);
$pdf->Ln(3);
$pdf->Cell(130,5,'ທີ່ຢູ່ : '.$row['location'],0,1);
$pdf->Ln(5);

$pdf->Cell(20,5,'#',1,0,'C');
$pdf->Cell(45,5,'ຊື່ສີນຄ້າ',1,0,'C');
$pdf->Cell(30,5,'ປະເພດ',1,0,'C');
$pdf->Cell(30,5,'ລາຄາ',1,0,'C');
$pdf->Cell(30,5,'ຈຳນວນ',1,0,'C');
$pdf->Cell(30,5,'ຈຳນວນເງິນ',1,1,'C');
}


$total_qty=0;
$qty=0;
$i=0;


$api->setOrderNo($row['order_no']);
$order_detail = $api->getOrderDetail();
foreach ($order_detail as $odt) {
    $i++;

$pdf->Ln(2);
$pdf->Cell(20,5,$i,0,0,'C');
$pdf->Cell(45,5,$odt['product_name'],0,0,'C');
$pdf->Cell(30,5,$odt['type_name'],0,0,'C');
$pdf->Cell(30,5,$odt['product_price'],0,0,'C');
$pdf->Cell(30,5,$odt['qty'],0,0,'C');
$pdf->Cell(30,5,$odt['price_qty'],0,1,'C');



$qty= $odt['qty'];
$total_qty += $qty;


}

$pdf->Ln(5);
// $html = "<hr>";
// // $pdf->writeHTMLCell(189,5,9,'',$html,0,'C');
// $pdf->writeHTMLCell(185, 0, '', '', $html, 0, 1, 0, true, '', true);

$pdf->Ln(1);
$pdf->Cell(125,5,'ລວມ :','TR',0,'R','0','');
$pdf->Cell(30,5,$total_qty,1,0,'C');
$pdf->Cell(30,5,$row['paid_amount'],1,1,'C');

// ສ້າງຕາຕະລາງ

// $html = "
// <table>
//                         <thead>
//                             <tr>
// 							<th>#</th>
//                             <th>Product Name</th>
//                             <th>Type</th>
//                             <th>price</th>
//                             <th>Qty</th>
//                             <th>Cerate</th>
//                             </tr>
//                         </thead>
//                         <tbody>

// ";

// while ($row = $result) {  
// 	$b .= '<tr><td>'.$row['name'].'</td></tr>';
	
// 	} 

// $html.="
//                         </tbody>
//  </table>

//  <style>
//  table{
// 	 border-collapse:collapse;
//  }
//  th,td{
// 	 border: 1px solid #888; 
//      height: 30px;
//  }
//  table tr th{
// 	 background-color:#888;
// 	 color:#fff;
// 	 font-weight:bold;
     
//  }
//  </style>

// ";


// // set text shadow effect
// $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// // Set some content to print
// $pdf ->Cell(190,10,"SONGTALE BREWHOUSE",1,1,'C');
// $html = <<<EOD
// <h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
// <i>This is the first example of TCPDF library.</i>
// <p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
// <p>Please check the source code documentation and other examples for further information.</p>
// <p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
// EOD;

// // Print text using writeHTMLCell()
// $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// // ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
// $pdf->Output('example_001.pdf', 'I');
$pdf->Output('report-order.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
