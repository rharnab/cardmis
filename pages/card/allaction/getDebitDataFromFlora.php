<?php
	include_once("../db/dbconnect.php");
	include('../database.php');
	//session_start();
	$user_id = $_SESSION['login_id'];
	$branch_id = $_SESSION['branch_id'];
	$currentDate = date('Y-m-d'); // current date //
	$accNumber  = '';
	$noc        = '';
	$otherPhone = '';
	$otherEmail = '';

	if(isset($_POST['data'])){
		$accNumber = mysql_real_escape_string($_POST['data']);
	}
	if(isset($_POST['noc'])){
		$noc = mysql_real_escape_string($_POST['noc']);
	}
	if(isset($_POST['otherPhone'])){
		$otherPhone = mysql_real_escape_string($_POST['otherPhone']);
	}
	if(isset($_POST['otherEmail'])){
		$otherEmail = mysql_real_escape_string($_POST['otherEmail']);
	}

	// get data from flora api //
	$file_get_contents = file_get_contents("http://172.19.11.1/CBS_API/account_info?acc=$accNumber");
	$api_data = json_decode($file_get_contents,true); // creating array //

	if(empty($api_data)){
		echo "<p class='alert alert-warning'>Please enter valid account number!</p>";
	}else{

		$acc_no = $api_data['accountno'];
		$customerid = $api_data['customer'];
		$accounttype = $api_data['glhead'];
		$actypecode = substr($api_data['accountno'],4,3); // get  account type code //
		$accountname = $api_data['acname'];
		$accstatus = $api_data['status'];
		$accnameoncard = $noc;
		$accopendate = $api_data['opend'];
		$accfather = $api_data['father_hus'];
		$nationalid = $api_data['National_id'];
		$accphone = $api_data['pre_mobilno'];
		$accotheremail = $otherEmail;
		$accotherphone = $otherPhone;
		$accaddress = $api_data['sub_head_addr'];
		$accdateofbirth = $api_data['dob'];
		$accsex = $api_data['sex'];
		$bal_tk = $api_data['bal_tk'];
		$entry_by_id = $user_id;
		//$requestDate = '2021-07-15';



		$debit_insert = mysql_query(" INSERT INTO debit_card_api (accountno, customerid, accounttype, actypecode, accountname, accstatus, accnameoncard, accopendate, accfather, nationalid, accphone, accotheremail, accotherphone, accaddress, accdateofbirth,accsex, bal_tk, entry_by_id, requestDate, branch_id, status) VALUES ('$acc_no', '$customerid', '$accounttype', '$actypecode', '$accountname', '$accstatus', '$accnameoncard', '$accopendate', '$accfather', '$nationalid', '$accphone', '$accotheremail', '$accotherphone', '$accaddress', '$accdateofbirth', '$accsex', '$bal_tk','$entry_by_id', '$currentDate', '$branch_id', '0') ");


		

		

		/*$debit_insert->bindParam(1,$api_data['accountno']);
		$debit_insert->bindParam(2,$api_data['customer']);
		$debit_insert->bindParam(3,$api_data['glhead']);
		$debit_insert->bindParam(4,$substr);
		$debit_insert->bindParam(5,$api_data['acname']);
		$debit_insert->bindParam(6,$api_data['status']);
		$debit_insert->bindParam(7,$noc);
		$debit_insert->bindParam(8,$api_data['opend']);
		$debit_insert->bindParam(9,$api_data['father_hus']);
		$debit_insert->bindParam(10,$api_data['National_id']);
		$debit_insert->bindParam(11,$api_data['pre_mobilno']);
		$debit_insert->bindParam(12,$otherEmail);
		$debit_insert->bindParam(13,$otherPhone);
		$debit_insert->bindParam(14,$api_data['sub_head_addr']);
		$debit_insert->bindParam(15,$api_data['dob']);
		$debit_insert->bindParam(16,$api_data['sex']);
		$debit_insert->bindParam(17,$api_data['bal_tk']);
		$debit_insert->bindParam(18,$user_id);
		$debit_insert->bindParam(19,$currentDate);*/


	/*	$stmt = $dbh->prepare("INSERT INTO REGISTRY (name, value) VALUES (:name, :value)");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':value', $value);*/

		/*if($debit_insert){
			echo "<p class='alert alert-success'>You has been successfully created request!</p>";
		}else{
			echo "<p class='alert alert-danger'>System error occurred!</p>";
		}*/

		if($debit_insert){
			echo "You has been successfully created request!";
		}else{
			echo "System error occurred!";
		}
		
	}
?>