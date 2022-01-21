<?php 
	include_once('../db/dbconnect.php');

	$fromDate = $_POST['fromDate'];
	$toDate   = $_POST['toDate'];
	
	$message = "Hye From , SBAC BANK LTD.";

	$select_number = $conn->prepare("SELECT `accphone` FROM `debit_card_api_bk` WHERE requestDate >= ? AND requestDate <= ?");
	$select_number->bindParam(1,$fromDate);
	$select_number->bindParam(2,$toDate);
	$select_number->execute();

	while($rowData = $select_number->fetch(PDO::FETCH_ASSOC)){
		$number = $rowData['accphone'];
		
		//$message  = urlencode($_POST['camMessage']);
		$userName = "sbacsms";
		$password = "SbacMizan@321";
		$data     = 'Username='.$userName.'&Password='.$password.'&From=SBAC BANK&To=880'.$number.'&Message='.$message;	

		//Api url which without any parameter
		$curl = curl_init('https://api.mobireach.com.bd/SendTextMessage?');  // init curl url // 
		curl_setopt($curl, CURLOPT_POST, 1); 
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data); //Set parameter to url 
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec ($curl);
	}

	$load   = simplexml_load_string($result);
	echo"<pre>";
	print_r($load);

	// variable with outpur example //
	$messageId = $load->ServiceClass->MessageId;//1547974865488091
	$Status = $load->ServiceClass->Status;//0
	$StatusText = $load->ServiceClass->StatusText;//success
	$ErrorCode = $load->ServiceClass->ErrorCode;//0
	$SMSCount = $load->ServiceClass->SMSCount;// 1
	$CurrentCredit = $load->ServiceClass->CurrentCredit; //35046.78

	curl_close ($curl); // close curl //

?>