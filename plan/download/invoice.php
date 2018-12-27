<?php

//============================================================+
// File name   : example_002.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 002 for TCPDF class
//               Removing Header and Footer
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
 * @abstract TCPDF - Example: Removing Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */
$id = $_REQUEST['id'];

include('../../xcrud/xcrud.php');

$db = Xcrud_db::get_instance();
$query_invoice = 'SELECT * FROM `invoice` WHERE `id`=' . $id;
$db->query($query_invoice);
$invoicedetail = $db->result();

$invoicedetail = $invoicedetail[0];
if($invoicedetail['id']){
$invoicedate = date('d-m-Y', strtotime($invoicedetail['invoice_date']));
$invoicefromdate = date('d-m-Y', strtotime($invoicedetail['from_date']));
$invoicetodate = date('d-m-Y', strtotime($invoicedetail['to_date']));

$cdentrylist = $invoicedetail['cd_entry_id'];

$query_cdentrylist = 'SELECT *,e.city_shortcode AS origin_city,c.city_shortcode AS destination_city FROM `courier_entry` a LEFT JOIN city e ON a.origin_id = e.city_id INNER JOIN city c ON a.dest = c.city_id   INNER JOIN service_tax d ON a.mode = d.id WHERE a.`consiment_no` IN (' . $cdentrylist . ')';


$db->query($query_cdentrylist);
$result_cdentrylists = $db->result();

$query_customer = 'SELECT * FROM `customer` WHERE `cust_id`=' . $invoicedetail['cust_id'];
$db->query($query_customer);
$customerdetail = $db->result();
$customerdetail = $customerdetail[0];
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$title = $id." ".$customerdetail["name"];
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle($title);
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}
$fontname = TCPDF_FONTS::addTTFfont('/path-to-font/FreeSerifItalic.ttf', 'TrueTypeUnicode', '', 96);

// ---------------------------------------------------------
// set font
$pdf->SetFont('pdfatimes', 'B', 20);


$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('pdfatimes', '', 12);

// add a page
$pdf->AddPage();

// set some text to print
$table = '
<table>
    <tbody>
        <tr>
            <td style="text-align: center; font-size: 16px; font-family: Arial Black;">
                <span style="font-weight: bold; text-align: center; text-transform: uppercase;">TIME BOUND LOGISTICS</span></td>
        </tr>
        <tr>
            <td style="text-align: center;font-family: Arial">
                <span style="font-weight: bold; text-transform: uppercase;">CARGO SERVICE BY AIR, TRAIN & ROAD</span></td>
        </tr>
        <tr>
            <td style="text-align: center;font-family: Arial">
                <span style="font-weight: bold; text-transform: uppercase;">206, JYOTI COMPLEX, VAPI CHAR RASTA, GIDC, VAPI-3969195 (GUJRAT)</span></td>
        </tr>
        <tr>
            <td style="text-align: center;font-family: Arial">
                <span style="font-weight: bold;">Phone No: 0260-6444372</span></td>
        </tr>
        <tr rowspan="3" ><td></td></tr>
 
    </tbody>
</table>

<table>
<tbody>
<tr style="font-weight: bold; text-transform: uppercase;">
<td style="text-align:left;text-transform: uppercase;">
               To</td>
            <td style="text-align:right;">
               INVOICE NO: ' . $invoicedetail["id"] . '</td></tr>
<tr style="font-weight: bold; text-transform: uppercase;">
            <td style="text-align:left;text-transform: uppercase;">
               ' . $customerdetail["name"] . '</td>
            <td style="text-align:right;">
              INVOICE DATE:  ' . $invoicedate . '</td></tr>
<tr style="font-weight: bold; text-transform: uppercase;">
            <td style="text-align:left;text-transform: uppercase;">
               GST NO: ' . $customerdetail["gst_no"] . '</td>
            <td style="text-align:right;">
              INVOICE PERIOD:  ' . $invoicefromdate . ' TO ' . $invoicetodate . '</td></tr>
                  <tr rowspan="3" ><td></td><td></td></tr>
        </tbody>
        </table>';
$pdf->writeHTML($table, '', 0, 'L', true, 0, false, false, 0);
$pdf->SetFont('pdfatimes', '', 8);

$table = '<table cellpadding="1" cellspacing="0" border="1">
    <tbody>
         <tr style="font-weight: bold;text-transform:uppercase;">
            <td style="font-size:12px;">
               SR.NO</td>
            <td>
               C/No</td>
            <td>
               DATE</td>
                 <td>
               ORIGIN</td>
            <td>
               DEST</td>
            <td>
               MODE</td>
            <td>
               PKTS</td>
           
            <td>ACT  Wt.</td>
            <td>CH. Wt.</td>
            <td>Rate/Kg</td>
            <td>FRGHT</td>
            <td>F.S.CH.</td>
            <td>T.PAY/FW</td>
            <td>PK/DL.</td>
            <td>DOC CH.</td>
            <td>OTH. CH.</td>
                  <td>LAB. CH.</td>
            <td>TOTAL</td>
        </tr>
     
';
$i = 0;
$packets = 0;
$actual_weight = 0;
$char_wt = 0;
$freight = 0;
$to_pay = 0;
$pkdel = 0;
$ot_chrg = 0;
$svc_tax_amt = 0;
$total = 0;
$amt = 0;
$svctaxval = 0;
$fuel = 0;
$docchrg = 0;
$octriochrg = 0;
foreach ($result_cdentrylists as $cdlist) {
    // $table .= '<tr><td>'.print_r($cdlist).'</td></tr>';
    $packets = $packets + $cdlist["packets"];
    $actual_weight = $actual_weight + $cdlist["actual_weight"];
    $fuel = $fuel + $cdlist["fuel_charges"];
    $to_pay = $to_pay + $cdlist["to_pay"];
    $pkdel = $pkdel + $cdlist["pick_delivery"];
    $docchrg = $docchrg + $cdlist["doc_charge"];
    $ot_chrg = $ot_chrg + $cdlist["other_charges"];
    $octriochrg = $octriochrg + $cdlist["octrio_charge"];
    $total = $total + $cdlist["total_amount"];
    $char_wt = $char_wt + $cdlist["chargeable_weight"];
    
                         $freight = $freight + $cdlist["net_amount"];
    // print_r($cdlist);
    $table .= '<tr>
    <td style="border: 1px solid black;text-align: center;style="font-size:6px;"">' . ($i = $i + 1) . '</td>
                    <td style=" border: 1px solid black;text-align: center;">' . $cdlist["consiment_no"] . '</td>
                    <td style=" border: 1px solid black;text-align: center;">' . date("d/m/Y", strtotime($cdlist["date"])) . '</td> 
                    <td style=" border: 1px solid black;text-align: center;text-transform: uppercase;">' . strtoupper($cdlist["origin_city"]) . '</td>  
                     <td style=" border: 1px solid black;text-align: center;text-transform: uppercase;">' . $cdlist["destination_city"] . '</td> 
                    <td style=" border: 1px solid black;text-align: center;">' . $cdlist["mode"] . '</td> 
                    <td style=" border: 1px solid black;text-align: center;">' . $cdlist["packets"] . '
                        </td>
                    <td style=" border: 1px solid black;text-align: center;">' . $cdlist["actual_weight"] . '
                        </td>   
                    <td style=" border: 1px solid black;text-align: center;">' . $cdlist["chargeable_weight"] . '
                      </td>          
                    <td style=" border: 1px solid black;text-align: center;">' . $cdlist["cust_rate"] . '</td>   
                    <td style=" border: 1px solid black;text-align: center;">' . $cdlist["net_amount"] . '</td>
                    <td style=" border: 1px solid black;text-align: center;">' . $cdlist["fuel_charges"] . '</td>
                    <td style=" border: 1px solid black;text-align: center;">' . number_format($cdlist["to_pay"],2) . '</td>
                    <td style=" border: 1px solid black;text-align: center;">' . number_format($cdlist["pick_delivery"],2) . '</td>
                    <td style=" border: 1px solid black;text-align: center;">' . number_format($cdlist["doc_charge"],2) . '</td>
                
                        <td style=" border: 1px solid black;text-align: center;">' . number_format($cdlist["other_chrgs"],2) . '</td>  
                        <td style=" border: 1px solid black;text-align: center;">' .number_format($cdlist["octrio_charge"],2) . '</td>   
                    <td style=" border: 1px solid black;text-align: center;">' . number_format($cdlist["total_amount"],2) . '</td>
                </tr>';
}


//$pdf->writeHTML($table, '', 0, 'L', true, 0, false, false, 0);
//$pdf->SetFont('freeserif', 'B', 8);

		$amt = $total;
               // print_r($total);
			$cgst = $invoicedetail['cgst'];
                        
			$sgst = $invoicedetail['sgst'];
                        
			$igst = $invoicedetail['igst'];
                        	$adjustment  = $invoicedetail['adjustment_amt'];
				$cgstamount = ($cgst*$total)/100;
				$sgstamount = ($sgst*$total)/100;
				$igstamount = ($igst*$total)/100;
				//$adjustment = $invoice->get_adjustment_amount();
				
				$grandtotal = round($amt+$adjustment+$cgstamount+$sgstamount+$igstamount,0);
				
            $table .='
            <tr>
                <th colspan="6" style=" border: 1px solid black;font-weight:bold;font-size:12px;">TOTAL</th>                
                <th style=" border: 1px solid black;text-align: center;font-weight:bold;font-size:10px;">'.number_format($packets,2).'</th>
                <th style=" border: 1px solid black;text-align: center;font-weight:bold;font-size:10px;">'.number_format($actual_weight,2).'</th>
                <th style=" border: 1px solid black;text-align: center;font-weight:bold;font-size:10px;">'.number_format($char_wt,2).'</th>
                <th></th>
                <th style=" border: 1px solid black;text-align: center;font-weight:bold;font-size:10px;">'.number_format($freight,2).'</th>
                <th style=" border: 1px solid black;text-align: center;font-weight:bold;font-size:10px;">'.number_format($fuel,2).'</th>
                <th style=" border: 1px solid black;text-align: center;font-weight:bold;font-size:10px;">'.number_format($to_pay,2).'</th>
                <th style=" border: 1px solid black;text-align: center;font-weight:bold;font-size:10px;">'.number_format($pkdel,2).'</th>
                <th style=" border: 1px solid black;text-align: center;font-weight:bold;font-size:10px;">'.number_format($docchrg,2).'</th>
             
                <th style=" border: 1px solid black;text-align: center;font-weight:bold;font-size:10px;">'.number_format($ot_chrg,2).'</th>
                <th style=" border: 1px solid black;text-align: center;font-weight:bold;font-size:10px;">'.number_format($octriochrg,2).'</th>
                <th style=" border: 1px solid black;text-align: center;font-weight:bold;font-size:10px;">'.number_format($total,2).'</th>
               

            </tr>';
          
// print a block of text using Write()
//$pdf->writeHTML($table, '', 0, 'L', true, 0, false, false, 0); 
            $table .='<tr>
            <td colspan="10" style="border-bottom:1px solid white; text-align:left;">
                <span style="color: rgb(51, 51, 51); font-family:  Helvetica, Arial, sans-serif; font-size: 12px; line-height:12px; background-color: rgb(255, 255, 255); text-align:left;">Term & condition:-    &nbsp;</span></td>
            <td style="text-align: right;border: 1px solid black;"  colspan="7" >
                <span style="color: rgb(51, 51, 51); font-family: Calibri; font-size: 12px; font-weight: bold; text-align: right;">NET Total : </span></td>
<td style="border:1px solid black;" rowspan="1"><span style="color: rgb(51, 51, 51); font-family: Calibri; font-size: 11px; font-weight: bold; line-height: 12px; text-align: right; ">'.number_format($amt,2).'</span></td>
        </tr>
        <tr>
            <td colspan="10" style="border-bottom:1px solid white; text-align:left;">
                <span style="color: rgb(51, 51, 51); font-family:  Helvetica, Arial, sans-serif; font-size: 12px; line-height: 12px;  border:none;">1 - Diffrence, if any,may be notified within 3 days of bill receipt</span></td>
                 <td style="text-align: right;border: 1px solid black;"  rowspan="1" colspan="7">
                <span style="color: rgb(51, 51, 51); font-family:  Helvetica, Arial, sans-serif; font-size: 12px; font-weight: bold; line-height: 12px; text-align: right; ">Adjustment : </span></td>
<td style="border:1px solid black;" rowspan="1"><span style="color: rgb(51, 51, 51); font-family: Calibri; font-size: 11px; font-weight: bold; line-height: 12px; text-align: right;">'.number_format($adjustment,2).'</span></td>
            
        </tr>
        <tr>
            <td colspan="10" style="border-bottom:1px solid white; text-align:left;">
             <span style="color: rgb(51, 51, 51); font-family:  Helvetica, Arial, sans-serif; font-size: 12px; line-height: 12px; background-color: rgb(255, 255, 255);">2 - All payment should me made by cheque or DD in favour of  "TIME BOUND LOGISTICS"                                                
</span>
             </td>
          <td style="text-align: right;border: 1px solid black;"  rowspan="1" colspan="7">
                <span style="color: rgb(51, 51, 51); font-family:  Helvetica, Arial, sans-serif; font-size: 12px; font-weight: bold; line-height: 12px; text-align: right; ">Sub Total :</span></td>
<td style="border: 1px solid black;" rowspan="1"><span style="color: rgb(51, 51, 51); font-family: Calibri; font-size: 11px; font-weight: bold; line-height: 12px; text-align: right; ">'.number_format($amt+$adjustment,2).'</span></td>
          
        </tr>
        <tr>
            
<td colspan="10" style="border-bottom:1px solid white; text-align:left;">
                <span style="color: rgb(51, 51, 51); font-family:  Helvetica, Arial, sans-serif; font-size: 12px; line-height: 12px; background-color: rgb(255, 255, 255);">3 - Rs. 500/- for bounce cheque and/or intrest 24%  P.A will be charged for non payment for the amount within 7 days after bill receipt </span></td>
                <td style="text-align: right;border: 1px solid black;"  rowspan="1" colspan="7">
                <span style="color: rgb(51, 51, 51); font-family: Helvetica, Arial, sans-serif; font-size: 12px; font-weight: bold; line-height: 12px; text-align: right; ">CGST ('.$cgst.'%) :</span></td>
<td style="border: 1px solid black;" rowspan="1"><span style="color: rgb(51, 51, 51); font-family: Calibri; font-size: 11px; font-weight: bold; line-height: 12px; text-align: right; ">'.number_format($cgstamount,2).'</span></td>
          
        </tr>
        <tr>
             <td colspan="10" style="border-bottom:1px solid white; text-align:left;"> 
                <span style="color: rgb(51, 51, 51); font-family:  Helvetica, Arial, sans-serif; font-size: 12px; line-height: 12px; background-color: rgb(255, 255, 255);">PAN NO -</span><span style="box-sizing: border-box;  color: rgb(51, 51, 51); font-family:  Helvetica, Arial, sans-serif; font-size: 12px; line-height: 12px; background-color: rgb(255, 255, 255);">&nbsp;AGZPA4894P</span></td>
           
             <td style="text-align: right;border: 1px solid black;"  rowspan="1" colspan="7">
                <span style="color: rgb(51, 51, 51); font-family:  Helvetica, Arial, sans-serif; font-size: 12px; font-weight: bold; line-height: 12px; text-align: right;">SGST ('.$sgst.'%): </span></td>
<td style="border: 1px solid black;" rowspan="1"><span style="color: rgb(51, 51, 51); font-family: Calibri; font-size: 11px; font-weight: bold; line-height: 12px; text-align: right;">'.number_format($sgstamount,2).'</span></td>
            
        </tr>
        <tr>
            <td colspan="10" style="border-bottom:1px solid white; text-align:left;"> 
                <span style="color: rgb(51, 51, 51); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 12px; background-color: rgb(255, 255, 255);">GST NO -</span><span style="box-sizing: border-box;  color: rgb(51, 51, 51); font-family:  Helvetica, Arial, sans-serif; font-size: 12px; line-height: 12px; background-color: rgb(255, 255, 255);">&nbsp;24AGZPA4894P1ZF</span></td>
                 <td style="text-align: right;border: 1px solid black;"  rowspan="1" colspan="7">
                <span style="color: rgb(51, 51, 51); font-family:  Helvetica, Arial, sans-serif; font-size: 12px; font-weight: bold; line-height: 12px; text-align: right;">IGST ('.$igst.'%): </span></td>
<td style="border: 1px solid black;" rowspan="1"><span style="color: rgb(51, 51, 51); font-family: Calibri; font-size: 11px; font-weight: bold; line-height: 12px; text-align: right; ">'.number_format($igstamount,2).'</span></td>
                
             
        </tr>

<tr>
            <td colspan="10" style="border-top:1px solid white; text-align:left;"> 
                </td>
                <td style="text-align: right;border: 1px solid black;"  rowspan="1" colspan="7">
                <span style="color: rgb(51, 51, 51); font-family:  Helvetica, Arial, sans-serif; font-size: 12px; font-weight: bold; line-height: 12px; text-align: right; ">Grand Total : </span></td>
<td rowspan="1" style="border: 1px solid black;"><span style="color: rgb(51, 51, 51); font-family: Calibri; font-size: 11px; font-weight: bold; line-height: 12px; text-align: right;">'.number_format($grandtotal,2).'</span></td>             
        </tr>
        <tr>
<td colspan="2" style="text-align:right;border: 1px solid black; font-weight: bold;">Rs. :-</td>
            <td colspan="19" style="border: 1px solid black;text-align:left;">
                <span style="box-sizing: border-box; font-weight: bold; color: rgb(51, 51, 51); font-family:  Helvetica, Arial, sans-serif; font-size: 10px; line-height: 12px; background-color: rgb(255, 255, 255);text-align:left;">'.strtoupper(no_to_words($grandtotal)).' ONLY</span></td>
           
        </tr>

    <tr>
   

 <td colspan="21" text-align="right"  style="border-right:1px solid black;text-align:right;">
            <span style="font-weight: bold; text-align: center;  float: right; padding-top: 5px;">FOR TIME BOUND LOGISTICS</span>     </td>
</tr> 
<tr>

 <td colspan="21" style="text-align:right;margin-right:10px;border-right:1px solid black;padding-right:10px;">
             
                   <img src="images/stamp.jpg" width="100" height="100" style="float:left;border-right:1px solid black;"></td>
</tr>
';
            $table .= "  </tbody>
        </table>";
// print a block of text using Write()
$pdf->writeHTML($table, '', 0, 'L', true, 0, true, false, 0);

// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output($title.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
}else{
    echo "Sorry Your Invoice doesn't exists";
}
function no_to_words($no)
{   
 $words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred &','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
    if($no == 0)
        return ' ';
    else {
	$novalue='';
	$highno=$no;
	$remainno=0;
	$value=100;
	$value1=1000;       
            while($no>=100)    {
                if(($value <= $no) &&($no  < $value1))    {
                $novalue=$words["$value"];
                $highno = (int)($no/$value);
                $remainno = $no % $value;
                break;
                }
                $value= $value1;
                $value1 = $value * 100;
            }       
          if(array_key_exists("$highno",$words))
              return $words["$highno"]." ".$novalue." ".no_to_words($remainno);
          else {
             $unit=$highno%10;
             $ten =(int)($highno/10)*10;            
             return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".no_to_words($remainno);
           }
    }
}