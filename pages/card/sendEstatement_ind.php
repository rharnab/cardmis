<?php
include("database.php");
 
$failed="";
$cnt=0;
$emailStrin="";
// sending email........................................
require 'PHPMailerAutoload.php';
 

$email='';

 
	$clName=$_GET['clName'];
  	$emailSort=explode(',', $_GET['emailId']);
   
	$mail = new PHPMailer(true);
	$send_using_gmail=0;
	
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
	
	$c=0;
	$sucEmail='';
	for($e=0; $e<COUNT($emailSort); $e++)
	{
	$email=ltrim($emailSort[$e],' ');
	$email=rtrim($email,' ');

	$mail->addAddress($email, $clName);
	
	$mail->Subject = 'SBAC Bank Credit Card E-Statement';
	$mail->msgHTML(file_get_contents('core/contents.html'), dirname(__FILE__));
	$mail->AltBody = 'Confidential';
		
	$pdfLink=$_GET['lnk'];//"core/PDF/".date('d-M-Y', strtotime($r['STATEMENT_DATE_SORT']))."/".$ClientCode."/".$rAcc['ACCOUNTNO'].".pdf";
    $fileName=$pdfLink;
    $mail->addAttachment($fileName);
	$mail->addAttachment("core/PDF_ADV/SBAC Card Schedule Of Charge.pdf");
	$mail->addAttachment("core/PDF_ADV/SBAC Bank ATM Location.pdf");
	

	if ($mail->send()) 
	{
		$c++; 
		$sucEmail=$sucEmail.','.$email;
	}		
	
	}
	
	$sucEmail=trim($sucEmail, ',');
	
	 echo " E-Statement has been sent to the ".$c." Accounts: ".$sucEmail;//.$emailString;
	 
	
 
      
              
?> 