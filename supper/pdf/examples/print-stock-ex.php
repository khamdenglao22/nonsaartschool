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

$api = new Product();
$from_date = $api->getFormatDate(htmlentities($_GET['from_date']));
$to_date = $api->getFormatDate(htmlentities($_GET['to_date']));


$api->SetFromDate($from_date);
$api->SetToDate($to_date);

$result = $api->getStockReport();

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
$pdf->setTitle('Report Stock');
$pdf->setSubject('Report Stock');
$pdf->setKeywords('Report Stock');

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

$pdf->Ln(30);
$pdf->Cell(130,5,'ເບີໂທລະສັບ : +856 02023423423',0,0);
$pdf->Cell(59,5,'ວັນທີ : '.date("d/m/Y", strtotime($from_date)),0,1);
$pdf->Cell(130,5,'',0,0);
$pdf->Cell(59,5,'ຫາ : '.date("d/m/Y", strtotime($to_date)),0,1);

$pdf->Ln(5);

$pdf->Cell(20,5,'#',1,0,'C');
$pdf->Cell(40,5,'ຊື່ສີນຄ້າ',1,0,'C');
$pdf->Cell(30,5,'ປະເພດ',1,0,'C');
$pdf->Cell(30,5,'ລາຄາ',1,0,'C');
$pdf->Cell(30,5,'ຈຳນວນ',1,0,'C');
$pdf->Cell(30,5,'ວັນທີ',1,1,'C');

$i=0;
foreach ($result as $row) {
$i++;

$pdf->Cell(20,5,$i,1,0,'C');
$pdf->Cell(40,5,$row['product_name'],1,0,'C');
$pdf->Cell(30,5,$row['type_name'],1,0,'C');
$pdf->Cell(30,5,$row['price'],1,0,'C');
$pdf->Cell(30,5,$row['inventory_qty'],1,0,'C');
$pdf->Cell(30,5,date("d/m/Y", strtotime($row['created'])),1,1,'C');

}
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

// $i=0;
// foreach ($result as $row) {
// 	 $i++;
// $html.='
// 						<tr>
// 						<td>'.$i .'</td>
// 						<td>'.$row['product_name'].'</td>
// 						<td>'.$row['type_name'].'</td>
// 						<td>'.$row['price'].'</td>
// 						<td>'.$row['inventory_qty'].'</td>
// 						<td>'.date("d/m/Y", strtotime($row['created'])).'</td>
// 						</tr>
// ';
// }
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

// $pdf->writeHTMLCell(192,0,9,'',$html,0);
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
$pdf->Output('report-stock.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
