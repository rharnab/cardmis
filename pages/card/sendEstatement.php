<?php
set_time_limit(0);
include("database.php");
$dt=date('Y-m-d');
$failed="";
$cnt=0;
$failedCnt=0;
$emailStrin="";
// sending email........................................

require 'PHPMailerAutoload.php';

//$stmtDt="24/09/2020";

$stmtDt=$_GET['dt'];
$stmtDtSort=explode('/', $stmtDt);
$stmtDt1=$stmtDtSort[2].'-'.$stmtDtSort[1].'-'.$stmtDtSort[0];

/*
$q=mysql_query("select *, c.IdClient clientCode from stmt_info stmt 
    left join customer c on c.IdClient=stmt.IdClient 
    left join customer_contact cc on cc.IdClient=c.IdClient 
    where STATEMENT_DATE='$stmtDt' and cc.email like '%@%' and cc.actStatus='1'
	order by Client");
*/

$q=mysql_query("select *, c.IdClient clientCode from stmt_info stmt 
    left join customer c on c.IdClient=stmt.IdClient 
    where STATEMENT_DATE='$stmtDt' and c.email like '%@%' and c.actStatus='1'
	order by Client");
	
if(mysql_num_rows($q)<=0)
{
	echo "Sorry, No Data Found";
	exit;
}

$email='';

while($r=mysql_fetch_array($q))
{
	//if($r['email']!='arif@sbacbank.com')
		//continue;
	 
	$emailSort=explode(',', $r['email']);
    $ClientCode=$r['clientCode'];
    $clName=$r['Client'];
    $card=$r['MAIN_CARD'];
	$mail = new PHPMailer(false);
	$send_using_gmail=0;
	//Send mail using gmail
 
	if($send_using_gmail)
	{
   		$mail->IsSMTP(); // telling the class to use SMTP
   		$mail->SMTPAuth = true; // enable SMTP authentication
   		$mail->SMTPSecure = "ssl"; // sets the prefix to the servier
   		$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
   		$mail->Port = "465"; //465; // set the SMTP port for the GMAIL server
   		$mail->Username = "sbac.card.stmt@gmail.com"; // GMAIL username
   		$mail->Password = "Sbac@123"; //GMAIL password
	}
	else
	{
		$mail->SMTPOptions = array(
		
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
		);
		
		$mail->IsSMTP(); 
		$mail->Mailer = "smtp";
    	$mail->Host = "172.19.20.6";
    	$mail->Port = "25"; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
    	$mail->SMTPAuth = false;
		$mail->SMTPSecure = false;
    	// $mail->SMTPSecure = 'tls';
    	$mail->Username = "e.statement@sbacbank.com";
    	$mail->Password = "eSt@tement!23";
		$mail->SMTPDebug = 0;
	}
 
	$mail->setFrom('e.statement@sbacbank.com', 'SBAC BANK CARD DIVISION');
	$mail->addReplyTo('e.statement@sbacbank.com', 'SBAC BANK CARD DIVISION');
	
	for($e=0; $e<COUNT($emailSort); $e++)
	{	
		$email=ltrim($emailSort[$e],' ');
		$email=rtrim($email,' ');
		 
		 
		// check existing......
		$chk=mysql_query("select * from email_sent_record where  email_id='$email' and stmtDate='$stmtDt1'");
		if(mysql_num_rows($chk))
			continue;

		$mail->addAddress($email, $clName);
	
		$mail->Subject = 'SBAC Bank Credit Card E-Statement';
		$mail->msgHTML(file_get_contents('core/contents.html'), dirname(__FILE__));
		$mail->AltBody = 'Confidential';
		
		$acc=mysql_query("select * from account_summary where IdClient='$ClientCode' and CARD_LIST='$card' and STATEMENT_DATE='$stmtDt'");
    	while($rAcc=mysql_fetch_array($acc))
    	{
    	//$pdfLink="core/PDF/".date('d-M-Y', strtotime($r['STATEMENT_DATE_SORT']))."/".$ClientCode."/".$rAcc['ACCOUNTNO'].".pdf";
    	$pdfLink="core/PDF/".date('d-M-Y', strtotime($r['STATEMENT_DATE_SORT']))."/".$ClientCode."/SBAC_Bank_eStatement.pdf";
    	$fileName=$pdfLink;
    	$mail->addAttachment($fileName);
		}
		
		$mail->addAttachment("core/PDF_ADV/SBAC Card Schedule Of Charge.pdf");
		$mail->addAttachment("core/PDF_ADV/SBAC Bank ATM Location.pdf");
		

		if (!$mail->send()) 
		{
		//$failed=$failed.$pdfLink.' Email: '.$email.',';
		$failed=$failed.$email.',';
		$failedCnt++;
		echo "<span style='color: red'>".$failedCnt.". Not Sent to :".$email.'</span><br>';
		}
		else
			{
			$cnt++; 
			mysql_query("insert into email_sent_record values ('null', '$email', '$stmtDt1', '$dt', '0')");
			echo $cnt.". Sent to :".$email.'<br>'.$stmtDt1;
			//mysql_query("update ");
			//$emailString=$emailString.','.$email;
			}
	}
}
echo "<br><br>E-Statement has been sent to the ".$cnt." customers\n";//.$emailString;
if($failed)
{
	echo "Email sending failed for the following ".$failedCnt." customer(s):\n".$failed;                                 
}
echo "<br><br><br>";
?> 