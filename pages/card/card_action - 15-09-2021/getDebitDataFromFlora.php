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
	$rcv_branch = $_POST['rcv_branch'];
	$request_type = $_POST['card_request'];
	$card_number = $_POST['card_number'];
	$issue_branch = $_POST['issue_branch'];
	$narration = $_POST['narration'];
	//type 
	//$request_type = '3';// for new re-cancel/block/activation

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
		$mothers_name = $api_data['mother_name'];
		$entry_by_id = $user_id;
		



		$debit_insert = mysql_query(" INSERT INTO debit_card_api (accountno, customerid, accounttype, actypecode, accountname, accstatus, accnameoncard, accopendate, accfather, nationalid, accphone, accotheremail, accotherphone, accaddress, accdateofbirth,accsex, bal_tk, entry_by_id, requestDate, branch_id, status, receive_branch, request_type,  card_number, issue_branch, narration, accmother) VALUES ('$acc_no', '$customerid', '$accounttype', '$actypecode', '$accountname', '$accstatus', '$accnameoncard', '$accopendate', '$accfather', '$nationalid', '$accphone', '$accotheremail', '$accotherphone', '$accaddress', '$accdateofbirth', '$accsex', '$bal_tk','$entry_by_id', '$currentDate', '$branch_id', '0', '$rcv_branch', '$request_type',  '$card_number', '$issue_branch', '$narration', '$mothers_name') ");



		if($debit_insert){
			echo "You has been successfully created request!";
		}else{
			echo "System error occurred!";
		}
		
	}
?>