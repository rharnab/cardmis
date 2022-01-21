<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="STYLESHEET" href="print_static.css" type="text/css" />
</head>
<body>
<?php
include("../pdf/mpdf.php");
include("../database.php"); 
$sDt=$_GET['dt'];
$qstmt=mysql_query("select *, SUBSTRING(CARD_LIST, -4) pass from stmt_info where STATEMENT_DATE='$sDt'");
while($rStmt=mysql_fetch_array($qstmt))
{
ini_set("memory_limit", "116M");
ob_start(); 
$IdClient=$rStmt['IdClient'];
$cardNo=$rStmt['MAIN_CARD'];
$stmtDate=$rStmt['STATEMENT_DATE'];
$accCnt=0;
$qAcc=mysql_query("select ACCOUNTNO from account_summary where IdClient='$IdClient' and CARD_LIST='$cardNo' and STATEMENT_DATE='$stmtDate'");
while($rAcc=mysql_fetch_array($qAcc))
{
//ini_set("memory_limit", "116M");
//ob_start(); 
$accCnt++;

$accNo=$rAcc['ACCOUNTNO'];
$pass=$rStmt['pass'];

$cnt=0;
$qCnt=mysql_query("select * from operations where IdClient='$IdClient' and CARD_LIST='$cardNo' and STATEMENT_DATE='$stmtDate' and ACCOUNT='$accNo' order by O");
//if(!mysql_num_rows($qCnt))
//continue;
$cnt=(mysql_num_rows($qCnt)/32);
if(is_float($cnt))
$cnt=ceil($cnt);
$rowLimit1=0;
$rowLimit2=32;
if($cnt<1)
$cnt=1;
for($i=1; $i<=$cnt; $i++)
{
?>
<div id="body">
<div id="section_header">
</div>
 
<div id="content">
<div class="page">
<div style=" width:808px; height:1050px; background-image:url('estatement.jpg');  background-repeat:no-repeat;">
<?php
$q=mysql_query("select * from customer where IdClient='$IdClient'");
$r=mysql_fetch_array($q);
$q1=mysql_query("select * from stmt_info where IdClient='$IdClient' and MAIN_CARD='$cardNo' and STATEMENT_DATE='$stmtDate'");
$r1=mysql_fetch_array($q1);
$q2=mysql_query("select * from account_summary where IdClient='$IdClient' and CARD_LIST='$cardNo' and STATEMENT_DATE='$stmtDate' and ACCOUNTNO='$accNo'");
$r2=mysql_fetch_array($q2);
?>
<div style="margin-top:115px; margin-left: 50px; width:300px; float:left">
<table style="width: 100%; border-collapse: collapse" border="0">
	<tr>
		<td>
Client ID:
<?php echo $r['IdClient'].'<br><br>';
echo $r['Client'].'<br>';
$addrSort=explode(',', $r['StreetAddress']);
/*
if(COUNT($addrSort)>2)
{
	$addr=$addrSort[0].', '.$addrSort[1].'<br>'.$addrSort[2];
}
else
{
	$addr=$r['StreetAddress'].'<br>';
}
echo $addr; 
*/
$p=0;
for($addrCnt=0; $addrCnt<strlen($r['StreetAddress']); $addrCnt++)
{
	$p++;
	echo $r['StreetAddress'][$addrCnt];
	if($p==35)
	{
		$p=0;
		echo '<br>';
	}
	
}
echo "<br>";
if($r['Region']) { echo $r['Region'];} 
if($r['Country']) { 
	if(!$r['Region'])
		echo $r['Country'];
	else
		echo ", ".$r['Country'];
	
}?>
		</td>
	</tr>
</table>
</div>
<div style="margin-top:105px; margin-left:40px; width:400px; float: left; font-size:10pt">
	<div style="float:left; width:195px; text-align: center"><?php echo substr($cardNo, 0, -2);?></div>
	<div style="float:left; width:80px; text-align: center"><?php echo date("d M Y", strtotime($r1['STATEMENT_DATE_SORT'])); ?></div>
	<div style="float:left; width:90px; text-align: center; font-size:8pt">
	<?php 
	$crOutstanding=$r2['EBALANCE'];
	$clDrCr="CR";
	if($r2['EBALANCE']<0)
	{	$clDrCr="DR";
		$crOutstanding=$r2['EBALANCE']*(-1);
	}
	echo number_format($crOutstanding, 2).' '.$clDrCr;?></div>
</div>
<div style="clear:both">&nbsp;</div>
<div style="margin-top:35px; margin-left: 35px; width:750px; float:left">
	<div style="float:left; width:130px; margin-left:0px; text-align: center;"><?php echo $r2['ACURN'].' '.number_format($r2['CRD_LIMIT'],2);?></div>
	<div style="float:left; width:130px; margin-left:20px; text-align: center"><?php echo $r2['ACURN'].' '.number_format($r2['AVAIL_CRD_LIMIT'],2);?></div>
	<div style="float:left; width:130px; margin-left:20px; text-align: center"><?php echo $r2['ACURN'].' '.number_format($r2['AVAIL_CASH_LIMIT'],2);?></div>
	<div style="float:left; width:130px; margin-left:20px; text-align: center"><?php echo date("d-M-Y", strtotime($r1['PAYMENT_DATE_SORT'])); ?></div>
	<div style="float:left; width:130px; margin-left:20px; text-align: center"><?php echo $r2['ACURN'].' '.number_format($r2['MIN_AMOUNT_DUE'],2);?></div>
</div>
<div style="clear:both">&nbsp;</div>
<div style="margin-top:30px; margin-left: 35px; width:750px; float:left">
	<div style="float:left; width:90px; margin-left:0px; text-align: center;"><?php echo $r2['ACURN'].' '.number_format($r2['SBALANCE'],2);?></div>
	<div style="float:left; width:100px; margin-left:7px; text-align: center"><?php echo $r2['ACURN'].' '.number_format($r2['SUM_PURCHASE'],2);?></div>
	<div style="float:left; width:100px; margin-left:7px; text-align: center"><?php echo $r2['ACURN'].' '.number_format($r2['SUM_WITHDRAWAL'],2);?></div>
	<div style="float:left; width:100px; margin-left:4px; text-align: center"><?php $chrgs=$r2['SUM_INTEREST']+$r2['SUM_OTHER']; echo $r2['ACURN'].' '.number_format($chrgs);?></div>
	<div style="float:left; width:110px; margin-left:7px; text-align: center"><?php echo $r2['ACURN'].' '.number_format($r2['SUM_REVERSE'],2);?></div>
	<div style="float:left; width:85px; margin-left:7px; text-align: center"><?php echo $r2['ACURN'].' '.number_format($r2['SUM_CREDIT'],2);?></div>
	<div style="float:left; width:110px; margin-left:7px; text-align: center"><?php echo $r2['ACURN'].' '.number_format($r2['EBALANCE'],2);?></div>
</div>
<div style="clear:both">&nbsp;</div>
<div style="margin-top:40px; margin-left: 35px; width:750px; height:480px; float:left">
 <?php
 if($i==1)
 {
  $SBALANCE=$r2['SBALANCE'];
 $prvDrCr="";
 if($r2['SBALANCE']<0)
 {
	$prvDrCr="DR";
	$SBALANCE=$r2['SBALANCE']*(-1);
 }
 
 if($r2['SBALANCE']>0)
	$prvDrCr="CR";
	
 ?>
	<div style="float:left; width:90px; margin-left:0px; text-align:  center; clear:both">&nbsp;</div>
	<div style="float:left; width:350px; margin-left:10px; text-align: left">PREVIOUS BALANCE</div>
	<div style="float:left; width:45px; margin-left:4px; text-align: center">&nbsp;</div>
	<div style="float:left; width:80px; margin-left:4px; text-align:  right">&nbsp;</div>
	<div style="float:left; width:45px; margin-left:10px; text-align: center"><?php echo $r2['ACURN']; ?></div>
	<div style="float:left; width:80px; margin-left:4px; text-align:  right"><?php echo number_format($SBALANCE,2).'&nbsp;'.$prvDrCr; ?></div>
<?php
 }
$q3=mysql_query("select * from operations where IdClient='$IdClient' and CARD_LIST='$cardNo' and STATEMENT_DATE='$stmtDate' and ACCOUNT='$accNo' order by OD_SORT limit $rowLimit1, $rowLimit2");
while($r3=mysql_fetch_array($q3))
{
if($r3['A']<0)
	$r3['A']=$r3['A']*(-1);
$dscr=strtoupper($r3['D']);
if($dscr=='MONTHLY EMI')
{
	$dscrSort=explode(':', $r3['FR']);
	$dscr=strtoupper($dscrSort[0]);
}
?>
	<div style="float:left; width:90px; margin-left:0px; text-align:  center; clear:both"><?php
	if($r3['TD_SORT']>0) { echo date("d-M-Y", strtotime($r3['TD_SORT']));}
	else{ echo date("d-M-Y", strtotime($r3['OD_SORT']));}
	?>
	</div>
	<div style="float:left; width:350px; margin-left:10px; text-align: left"><?php echo $dscr.' ('.strtoupper($r3['DE'].'. '.$r3['TL']).')'?></div>
	<div style="float:left; width:45px; margin-left:4px; text-align: center"><?php if($r3['OC']) { echo $r3['OC'];} else{ echo "&nbsp;"; } ?></div>
	<div style="float:left; width:80px; margin-left:4px; text-align:  right"><?php if($r3['OA']>0) {echo number_format($r3['OA'],2).' '.$r3['AMOUNTSIGN'];} else{ echo "&nbsp;"; } ?></div>
	<div style="float:left; width:45px; margin-left:10px; text-align: center"><?php echo $r3['ACURN']; ?></div>
	<div style="float:left; width:80px; margin-left:4px; text-align:  right"><?php echo number_format($r3['A'],2).' '.$r3['AMOUNTSIGN'];?></div>
<?php
}
$rowLimit1=$rowLimit1+32;
?>
</div>
<div style="clear:both">&nbsp;</div>
<div style="margin-top:18px; margin-left:630px; width:200px; float:left">
 <?php
 if($i==$cnt)
 {
   $EBALANCE=$r2['EBALANCE'];
 $clDrCr="";
 if($r2['EBALANCE']<0)
 {
	$clDrCr="DR";
	$EBALANCE=$r2['EBALANCE']*(-1);
 }
 
 if($r2['EBALANCE']>0)
	$clDrCr="CR";
 ?>
	<div style="float:left; width:45px; margin-left:0px; text-align: center"><?php echo $r2['ACURN'];?></div>
	<div style="float:left; width:80px; margin-left:2px; text-align: right"><?php echo number_format($EBALANCE,2).'&nbsp;'.$clDrCr;?></div>
 <?php
 }
 else
 	echo "&nbsp;"
 ?>
</div>
<div style="clear:both">&nbsp;</div>
<div style="margin-top:10px; margin-left:40px; width:800px; float:left">
	If you have any dispute or query regarding any transaction in this statement, please inform us within 15 days from the statement date.
 </div>
</div>
	<?php
	 if($i<$cnt)
	 {
	 ?>
	<div><br><br><br><br><br><br><br>&nbsp;</div>
	<?php
	}
}
?>
</div><!-- end of page div-->
</div>
</div>
<?php
 }
  
$HTMLoutput =ob_get_contents();
ob_end_clean();
//==============================================================
//==============================================================

$mpd=new mPDF('utf-8', array(210,278),'','',-3,-3,-3,0,0,0);

$mpd->SetDisplayMode('fullpage');
$mpd->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
// LOAD a stylesheet
$stylesheet = file_get_contents('print_static.css');
//$stylesheet = $stylesheet.file_get_contents('common.css');
//$stylesheet = $stylesheet.file_get_contents('mpdfstyletables.css');


$mpd->WriteHTML($stylesheet,1); // The parameter 1 tells that this is css/style only and no body/html/text
$mpd->WriteHTML($HTMLoutput,2);

//$mpdf->SetProtection(array('copy','print'), $pass, $pass);
$dirDate=date("d-M-Y", strtotime($r1['STATEMENT_DATE_SORT']));

$dir='PDF/'.$dirDate.'/'.$IdClient;
if (!file_exists($dir)) {
    mkdir($dir, 0777, true);
}

//==============================================================
//==============================================================
//==============================================================
//$mpdf->debug = true;
$mpd->Output($dir.'/'.SBAC_Bank_eStatement .'.pdf','F'); // use 'I' to show in Browser, F for save
//exit;

}
?>
</body>
</html>

