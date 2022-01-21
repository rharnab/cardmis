<?php 
	include_once("../db/dbconnect.php");
	session_start();

	$accNo = $_POST['accNo'];
	$accType = $_POST['accType'];
	$clPhone = $_POST['clPhone'];
	$clEmail = $_POST['clEmail'];
	$mailAddress = $_POST['mailAddress'];
	$datepicker = $_POST['datepicker'];
	$status_id = $_POST['request'];
	/*$clDocument = $_FILES['clDocument'];*/

	// date convert for mysql formate //
	$date = date('Y-m-d',strtotime($datepicker));
	$user_id = $_SESSION['id']; // login user ID //
	
	
	$insert = $conn->prepare("INSERT INTO `debit_card` SET acc_no=?,acc_type=?,user_id=?,status_id=?,cl_phone=?,cl_email=?,mailing_address=?,acc_open_date=?");
	$insert->bindValue(1,$accNo);
	$insert->bindValue(2,$accType);
	$insert->bindValue(3,$user_id);
	$insert->bindValue(4,$status_id);
	$insert->bindValue(5,$clPhone);
	$insert->bindValue(6,$clEmail);
	$insert->bindValue(7,$mailAddress);
	$insert->bindValue(8,$date);
	
	try{
		if($insert->execute()){
			echo "Hello";
		}else{
			echo "faidl";
		}
	}catch(PDOException $error){
		echo $error->getMessage();
	}


?>