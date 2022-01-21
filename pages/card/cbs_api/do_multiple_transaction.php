<?php

// Multiple Transaction
$bankClient = new SoapClient("http://172.19.11.5:801/FloraService.svc?wsdl");
$bankResponse=$bankClient->DoMultipleTransaction(
	array(
		"transactionList" => array(
			// customer account which account debited
			array(
				"AccountNo"  => '0011120130033',
				"Amount"     => "0",
				"DrCr"       => "DR",
				"ChequeNo"   => " ",
				"Remarks"    => "Invoice No - Test Card Bill",
				"BranchCode" => "0011"
			),
			// Bank Account which account credited
			array(
				"AccountNo"  => "9238001",
				"Amount"     => "0",
				"DrCr"       => "CR",
				"ChequeNo"   => " ",
				"Remarks"    => "Invoice No -  - Hasan ",
				"BranchCode" => "0014"		
			)
			
		),
		"commonInfo" => array(			
			"TrnBranchCode"   => "0001",
			"OfsUserID"=>"sbacOfs",
			"OfsUserPassword"=>"123456",
			"UserId"          => 106,
			"Password"        => "Test@123",
			"TransactionDate" => "2020-03-10",
		)
	)
);
$response = json_decode(json_encode($bankResponse), True);
echo "<pre>";
print_r($response);
 $barch_no = $response['DoMultipleTransactionResult']['BatchNo'];
 $message = $response['DoMultipleTransactionResult']['Message'];
 $TraceNoList = $response['DoMultipleTransactionResult']['TraceNoList']['string'][0];

