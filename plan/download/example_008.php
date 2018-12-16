<?php
//============================================================+
// File name   : example_008.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 008 for TCPDF class
//               Include external UTF-8 text file
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
 * @abstract TCPDF - Example: Include external UTF-8 text file
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 008');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 008', PDF_HEADER_STRING);

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

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// set font
$pdf->SetFont('freeserif', '', 12);

// add a page
$pdf->AddPage();

// get esternal file content
$utf8text = '<table class="table table-hover table-bordered dataTable no-footer" id="myTable" role="grid">
    <thead>
      <tr role="row"><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 224px;">More Info</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 260px;">Learning Outcome</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 248px;">Topic to Learn</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 109px;">Teachers</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 93px;">Subject</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 73px;">Files Uploaded</th></tr>
    </thead>
    <tbody>
      	   
      	   
      	   
      	   
      	   
      	   
          <tr role="row" class="odd">
        <td>سوف يتم اختبار*
الطالب تحريري في
نهاية الاسبوع في
نفس الدرس</td>
        <td>حفظ الايات31-38 *</td>
        <td>تحضير درس بشارة ومواساة من صفحة 122- 127</td>
        <td>أ/سالم طارش  أ/سليمان المنهالي</td>
        <td>التربية الاسلامية</td>
        <td><a href="http://www.mutanabi.ae/school/uploads/a.jpg" download="">a.jpg</a></td>
        
        </tr><tr role="row" class="even">
        <td>اوراق العمل</td>
        <td>يُبيّنُ المَعْنى الإِجْمالِيَّ للنَّصِّ الشِّعْرِيِّ. يُفَسِّرُ أَسْماءً وأفعال لً بِمُرادِفاتِها وَأَضْدادِها يَتَعَرَّفُ الأَغْراضَ البَلاغِيَّةَ للأسْلوبِ الإِنْشائِيِّ الاسْتِفْهامُ</td>
        <td>أَميرَةُ الشَّجَرِ- الأسلوب الإنشائي</td>
        <td>أ/مختار عمار أ/عيد السمنودي أ/عبدالحي علي</td>
        <td>اللغة العربية</td>
        <td><a href="http://www.mutanabi.ae/school/uploads/" download=""></a></td>
        
        </tr><tr role="row" class="odd">
        <td></td>
        <td>يتعرف المفاهيم الواردة في الدرس يناقش مصادر المعرفة الجغرافية يشرح تأثير التكنولوجيا المتقدمة في نظم المعلومات الجغرافية</td>
        <td>نظم المعلومات الجغرافية GIS</td>
        <td>أ/محمد محمود أ/محمد فتحي</td>
        <td>المواد الاجتماعية</td>
        <td><a href="http://www.mutanabi.ae/school/uploads/" download=""></a></td>
        
        </tr><tr role="row" class="even">
        <td>-Please urge
your son to
read more and
to write a short
summary for
what he had
read.</td>
        <td>-Ss use the adjectives in the sentences. -Discover why people leave their homes to begin again in a new country.</td>
        <td>-To use word parts: analyze, identify and chapter. -Ss read and analyze: how does our past impact our future. -Find out why it is important to value the past.</td>
        <td>Mr.Ahmed  Mr.Adonis</td>
        <td>اللغة الانجليزية English</td>
        <td><a href="http://www.mutanabi.ae/school/uploads/" download=""></a></td>
        
        </tr><tr role="row" class="odd">
        <td>Students to complete homework activities for lesson 4 to 6 in workbook (page 4 to page 9)</td>
        <td>Apply the Distributive Property to simplify algebraic expressions Solve unusual problems using table drawing strategy Simplify algebraic expressions by combining like terms</td>
        <td>The Distributive Property Solving Investigation: Make a Table Simplify Algebraic Expressions Add Linear Expressions (Pages 375 – 403)</td>
        <td>Mr.Basyouny Mr.Tshepo Mr.Craig</td>
        <td>الرياضيات Mathematics</td>
        <td><a href="http://www.mutanabi.ae/school/uploads/" download=""></a></td>
        
        </tr><tr role="row" class="even">
        <td>Vocabulary:
Mechanical
wave
Electromagnetic
wave
Transverse
Wave
Longitudinal
Wave
Frequency
Amplitude
Refraction</td>
        <td>How do waves transfer energy through matter and through empty space?</td>
        <td>Chapter 6. Waves, Light and sound</td>
        <td>Mr.Gideon  Mr.Dennis</td>
        <td>العلوم Science</td>
        <td><a href="http://www.mutanabi.ae/school/uploads/" download=""></a></td>
        
        </tr></tbody>
  </table>';

// set color for text
$pdf->SetTextColor(0, 63, 127);

//Write($h, $txt, $link='', $fill=0, $align='', $ln=false, $stretch=0, $firstline=false, $firstblock=false, $maxh=0)

// write the text
$pdf->Write(5, $utf8text, '', 0, '', false, 0, false, false, 0);


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_008.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
