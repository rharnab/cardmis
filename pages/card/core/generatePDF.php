<?php ob_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="STYLESHEET" href="print_static.css" type="text/css" />
</head>
<body>
<div id="body">
<div id="section_header">
</div>
<?php include("../database.php");?>
<div id="content">
 
<div class="page" style="font-size: 7pt">
<table style="width: 100%;" class="header">
<tr>
<td><img alt="" src="sbac.png"></td>
<td><img alt="" src="visa.png" ></td>
</tr>
</table>

<?php
$IdClient='1356495';
$cardNo='410787******8158';
$stmtDate='24/11/2016';
$accNo="707705000100000121";
$pass="8158";

$q=mysql_query("select * from customer where IdClient='$IdClient'");
$r=mysql_fetch_array($q);

$q1=mysql_query("select * from stmt_info where IdClient='$IdClient' and CARD_LIST='$cardNo' and STATEMENT_DATE='$stmtDate'");
$r1=mysql_fetch_array($q1);

$q2=mysql_query("select * from account_summary where IdClient='$IdClient' and CARD_LIST='$cardNo' and STATEMENT_DATE='$stmtDate' and ACCOUNTNO='$accNo'");
$r2=mysql_fetch_array($q2);

?>
<br>
<table style="width: 100%; font-size: 8pt; font-weight:bold">
<tr>
 
<td style="vertical-align: text-top; width: 50%">
<table style="width: 100%; border-collapse: collapse" border="0">
	<tr>
		<td>
		
Client ID: 
<?php echo $r['IdClient'].'<br><br>';
echo $r['Client'].'<br>'; 
$addrSort=explode(',', $r['StreetAddress']);
if(COUNT($addrSort)>2)
{
	$addr=$addrSort[0].', '.$addrSort[1].'<br>'.$addrSort[2];
}
else
{
	$addr=$r['StreetAddress'].'<br>';
}
echo $addr; if($r['Region']) { echo ', '.$r['Region'];} if($r['Country']) { echo '<br>'.$r['Country'];}?>
		</td>
	</tr>
</table>
</td>
<td style=" vertical-align:top">
 <table style="width: 100%; font-weight:bold; border-collapse: collapse; background-color: #DBE7CF;" border="0">
	<tr>
		<td style="width: 173px; height: 20px; border-bottom: 0.9px solid silver;" class="right"><strong>Statement Date:&nbsp; </strong></td>
		<td style="height: 23px; border-bottom: 0.9px solid silver;"><?php echo date("d-M-Y", strtotime($r1['STATEMENT_DATE_SORT'])); ?></td>
	</tr>
	<tr>
		<td style="width: 173px; height: 20px; border-bottom: 0.9px solid silver;" class="right">Statement Period Starts:&nbsp; </td>
		<td style="height: 25px; border-bottom: 0.9px solid silver;"><?php echo date("d-M-Y", strtotime($r1['StartDateSort'])); ?></td>
	</tr>
	<tr>
		<td style="width: 173px; height: 20px; border-bottom: 0.9px solid silver;" class="right">Statement Period Ends:&nbsp; </td>
		<td style="height: 20px; border-bottom: 0.9px solid silver;"><?php echo date("d-M-Y", strtotime($r1['EndDateSort'])); ?></td>
	</tr>
	<tr>
		<td style="width: 173px; height: 20px; border-bottom: 0.9px solid silver;" class="right">Last Payment Date:&nbsp; </td>
		<td style="height: 23px; border-bottom: 0.9px solid silver;"><?php echo date("d-M-Y", strtotime($r1['PAYMENT_DATE_SORT'])); ?></td>
	</tr>
	<tr>
		<td style="width: 173px; height:20px; border-bottom: 0.9px solid silver;" class="right">Minimum Amount Due:&nbsp; </td>
		<td style="border-bottom: 0.9px solid silver;"><?php echo $r2['ACURN'].' '.$r2['MIN_AMOUNT_DUE']?></td>
	</tr>
	</table>


</td>
</tr>

<tr>
 
<td style="vertical-align: text-top; width: 251px;">
</td>
<td></td>
</tr>

</table>
<table style="width: 100%; background-color:#659530; border-top: 1px solid black; border-bottom: 1px solid black; font-size: 12pt;">
<tr>
<td><strong>Card No: <?php echo $cardNo;?></strong></td>
</tr>
</table>
<br>
<table style="width: 100%; background-color: #659530 ; border-top: 1px solid black; border-bottom: 1px solid black; font-size:15pt">
<tr>
<td style="width: 208px"><strong>Card Limit</strong></td>
<td style="width: 315px"><strong>Available Credit Limit</strong></td>
<td style="width: 297px"><strong>Available Cash Limit</strong></td>
<td style="width: 295px"><strong>Current Outstanding</strong></td>
</tr>

<tr>
<td style="width: 208px"><?php echo $r2['ACURN'].' '.$r2['CRD_LIMIT']?></td>
<td style="width: 315px"><?php echo $r2['ACURN'].' '.$r2['AVAIL_CRD_LIMIT']?></td>
<td style="width: 297px"><?php echo $r2['ACURN'].' '.$r2['AVAIL_CASH_LIMIT']?></td>
<td style="width: 295px"><?php echo $r2['ACURN'].' '.$r2['EBALANCE']?></td>
</tr>

</table>
<br>
<table style="width: 100%; border-top: 1px solid black; border-bottom: 1px solid black; font-size:18pt">
<tbody>
<tr >
<th style="width: 246px; height: 24px;">Transaction Date</th>
<th style="width: 228px; height: 24px;">Operation Date</th>
<th style="width: 776px; height: 24px;">Description of Transaction</th>
<th style="width: 68px; height: 24px;">Currency</th>
<th colspan="2" style="height: 24px">Amount</th>
</tr>
<tr style="background-color: #DBE7CF;">
<th colspan="2" style="height: 22px">&nbsp;</th>
<th style="width: 776px; height: 22px;">Previous Blance</th>
<th style="width: 68px; height: 22px;"><?php echo $r2['ACURN'];?></th>
<th style="text-align: right; border-right-style: none;"><?php echo $r2['SBALANCE']; ?></th>
<th class="change_order_unit_col" style="border-left-style: none;"> </th>

</tr>

<?php
$sl=0;
$q3=mysql_query("select * from operations where IdClient='$IdClient' and CARD_LIST='$cardNo' and STATEMENT_DATE='$stmtDate' and ACCOUNT='$accNo' order by O");
while($r3=mysql_fetch_array($q3))
{
$sl++;
if(($sl%2)==0)
	$cls="even_row";
else
	$cls="odd_row";
 
?>
<tr class="<?php echo $cls;?>">
<td style="text-align: center; width: 246px;">
	<?php 
	if($r3['TD_SORT']>0) { echo date("d-M-Y", strtotime($r3['TD_SORT']));}
	else{ echo date("d-M-Y", strtotime($r3['OD_SORT']));}
	?>
</td>
<td style="text-align: center; width: 228px;"><?php echo date("d-M-Y", strtotime($r3['OD_SORT']));?></td>
<td style="width: 776px"><?php echo $r3['D'];//.' '.$r3['DE']?></td>
<td style="text-align: center; width: 68px;"><?php echo $r3['ACURN']; ?></td>
<td style="text-align: right;"><?php echo $r3['A']; ?></td>
<td class="change_order_unit_col"><?php echo $r3['AMOUNTSIGN']; ?></td>
</tr>
<?php
}
?> 
  
</tbody>




<tr style="background-color: #DBE7CF;">
<th colspan="2" style="height: 22px">&nbsp;</th>
<th style="width: 776px; height: 22px;">Current Balance</th>
<th style="width: 68px; height: 22px;"><?php echo $r2['ACURN'];?></th>
<th style="text-align: right; border-right-style: none;"><?php echo $r2['EBALANCE']; ?></th>
<th class="change_order_unit_col" style="border-left-style: none;"><?php //echo $r3['AMOUNTSIGN']; ?></th>

</tr>
</table>

<br><br> 
<table style="width: 100%; border-top: 1px solid black; border-bottom: 1px solid black; font-size: 12pt;">
<tr>
<td><p style="font-size:9pt"><strong>N.B. </strong>If you have any dispute or query regarding any transaction in this statement, please inform us within 15 days from the statement date.</p>
</td>
</tr>
</table>

</div>


</div>
</div>


</body>
</html>
<?php
 
$HTMLoutput = ob_get_contents();
ob_end_clean();

//==============================================================
//==============================================================
include("../pdf/mpdf.php");

$mpdf=new mPDF('c','A4','','',8,8,2,5,0,0); //left, right, top, 

//$mpdf=new mPDF('c','A4-L');

//$mpdf=new mPDF('c','A4');

$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
// LOAD a stylesheet
$stylesheet = file_get_contents('print_static.css');
//$stylesheet = $stylesheet.file_get_contents('../../css/font-awesome.min.css');
//$stylesheet = $stylesheet.file_get_contents('mpdfstyletables.css');

/*
$mpdf->SetHTMLHeader('<table style="width: 100%;" class="header">
<tr>
<td><img alt="" src="sbac.png"></td>
<td><img alt="" src="visa.png" ></td>
</tr>
</table>
');
*/

$mpdf->SetHTMLFooter('<table style="width: 100%;">
<tr>
<td><img alt="" src="footer.jpg"></td>
</tr>
</table>
');

$mpdf->WriteHTML($stylesheet,1); // The parameter 1 tells that this is css/style only and no body/html/text
$mpdf->WriteHTML($HTMLoutput,2);

$mpdf->SetProtection(array('copy','print'), $pass, $pass);
$dirDate=date("d-M-Y", strtotime($r1['STATEMENT_DATE_SORT']));

$dir='PDF/'.$dirDate.'/'.$IdClient;
if (!file_exists($dir)) {
    mkdir($dir, 0777, true);
}

$mpdf->Output($dir.'/'.$accNo.'.pdf','I'); // use 'I' to show in Browser, F for save
exit;
//==============================================================
//==============================================================
//==============================================================

 
?>

