<?php
/**
 * This example shows sending a message using PHP's mail() function.
 */
require '../PHPMailerAutoload.php';

/* 
$IdClient='1317574';
$cardNo='410787******8132';
$dirDate='27-Oct-2016';
$accNo="707705000100000017";
$pass="8132";
 */
 
$mail = new PHPMailer(true);
$send_using_gmail='1';
//Send mail using gmail
if($send_using_gmail){
    $mail->IsSMTP(); // telling the class to use SMTP
    $mail->SMTPAuth = true; // enable SMTP authentication
    $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
    $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
    $mail->Port = 465; // set the SMTP port for the GMAIL server
    $mail->Username = "arif1280@gmail.com"; // GMAIL username
    $mail->Password = "fira@arif1280"; // GMAIL password
}

$mail->setFrom('arif1280@gmail.com', 'ARIF BILLAH');
//Set an alternative reply-to address
$mail->addReplyTo('arif1280@gmail.com', 'ARIF BILLAH');

//Set who the message is to be sent to
$mail->addAddress('arif1280@gmail.com', 'ARIF BILLAH');
$mail->addAddress('mizanur.rahman@sbacbank.com', 'Mizanur Rahman');
$mail->addAddress('na.khan@sbacbank.com', 'NA KHAN');
$mail->addAddress('shafiul.azam@sbacbank.com', 'Shafiul Azam');

//Set the subject line
$mail->Subject = 'SBAC Bank Credit Card E-Statement';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = 'Confidential';

//Attach an image file
$fileName='PDF/'.$dirDate.'/'.$IdClient.'/'.$accNo.'.pdf';
$mail->addAttachment($fileName);

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
?>