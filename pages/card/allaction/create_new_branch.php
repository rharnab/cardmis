<?php
	include('../db/dbconnect.php');

	$currentDate = date('Y-m-d');
	$formData = $_POST['formData'];

	if(!empty($formData[0]['value'])){
		$br_insert = $conn->prepare("INSERT INTO `branches` SET br_title=?,br_code=?,br_address=?,br_city=?,br_division=?,br_phone=?,br_email=?,swift_code=?,created_at=?");

		$br_insert->bindParam(1,$formData[0]['value']); // title
		$br_insert->bindParam(2,$formData[1]['value']); // code
		$br_insert->bindParam(3,$formData[7]['value']); // address
		$br_insert->bindParam(4,$formData[6]['value']); // city
		$br_insert->bindParam(5,$formData[5]['value']); // division
		$br_insert->bindParam(6,$formData[2]['value']); // phone
		$br_insert->bindParam(7,$formData[3]['value']); // email
		$br_insert->bindParam(8,$formData[4]['value']); // swiftcode
		$br_insert->bindParam(9,$currentDate); // date

		if($br_insert->execute()){
			echo 'New branch has been successfully created';
		}else{
			echo 'New branch created failed!';
		}

	}else{
		echo 'Please try  againg !!!';
	}
	
?>