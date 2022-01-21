<?php
include("database.php");
 
$failed="";
$cnt=0;
$emailStrin="";
// sending email........................................
require 'PHPMailerAutoload.php';

//$stmtDt="24/11/2016";
$stmtDt=$_GET['dt'];
$q=mysql_query("select *, c.IdClient clientCode from stmt_info stmt 
    left join customer c on c.IdClient=stmt.IdClient 
    left join customer_contact cc on cc.IdClient=c.IdClient 
    where STATEMENT_DATE='$stmtDt' and cc.email like '%@%' and cc.actStatus='1'
	order by Client");
	
if(mysql_num_rows($q)<=0)
{
	echo "Sorry, No Data Found";
	exit;
}

$email='';

while($r=mysql_fetch_array($q))
{
	$emailSort=explode(',', $r['email']);
    $ClientCode=$r['clientCode'];
    $clName=$r['Client'];
    $card=$r['MAIN_CARD'];
		
	$mail = new PHPMailer(true);
	$send_using_gmail='1';

	//Send mail using gmail
 
 
	if($send_using_gmail)
	{
   		$mail->IsSMTP(); // telling the class to use SMTP
   		$mail->SMTPAuth = true; // enable SMTP authentication
   		$mail->SMTPSecure = "ssl"; // sets the prefix to the servier
   		$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
   		$mail->Port = "465"; //465; // set the SMTP port for the GMAIL server
   		$mail->Username = "arif1280@gmail.com"; // GMAIL username
   		$mail->Password = "fira@arif1280"; //GMAIL password
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
    	// $mail->SMTPSecure = 'tls';
    	$mail->Username = "e.statement@sbacbank.com";
    	$mail->Password = "eSt@tement!23";
	//	$mail->SMTPDebug = 1;
	}
 

	$mail->setFrom('e.statement@sbacbank.com', 'SBAC BANK CARD DIVISION');
	$mail->addReplyTo('e.statement@sbacbank.com', 'SBAC BANK CARD DIVISION');
	
	for($e=0; $e<COUNT($emailSort); $e++)
	{	
		$email=ltrim($emailSort[$e],' ');
		$email=rtrim($email,' ');

		$mail->addAddress($email, $clName);
	
		$mail->Subject = 'SBAC Bank Credit Card E-Statement';
		$mail->msgHTML(file_get_contents('core/contents.html'), dirname(__FILE__));
		$mail->AltBody = 'Confidential';
		
		$acc=mysql_query("select * from account_summary where IdClient='$ClientCode' and CARD_LIST='$card' and STATEMENT_DATE='$stmtDt'");
    	while($rAcc=mysql_fetch_array($acc))
    	{
    	$pdfLink="core/PDF/".date('d-M-Y', strtotime($r['STATEMENT_DATE_SORT']))."/".$ClientCode."/".$rAcc['ACCOUNTNO'].".pdf";
    	$fileName=$pdfLink;
    	$mail->addAttachment($fileName);
		}

		if (!$mail->send()) 
		{
		$failed=$failed.$pdfLink.' Email: '.$email.'<br>';
		}
		else
			{
			$cnt++; 
			//$emailString=$emailString.','.$email;
			}
	}
}
      

if($failed)
{
	echo "Email sending failed for the following customers:<br>".$failed;                                 
}
else
{
	echo " E-Statement has been sent to the ".$cnt." accounts";//.$emailString;
}                                      
?> 