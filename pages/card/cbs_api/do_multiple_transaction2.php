<?php

// Multiple Transaction
$bankClient = new SoapClient("http://172.19.11.5:801/FloraService.svc?wsdl");
$bankResponse=$bankClient->DoMultipleTransaction(
	array(
		"transactionList" => array(
			// customer account which account debited
			array(
				"AccountNo"  => '0011120121712',
				"Amount"     => "0",
				"DrCr"       => "DR",
				"ChequeNo"   => " ",
				"Remarks"    => "Invoice No - Test Card Bill",
				"BranchCode" => "0011"
			),
			// Bank Account which account credited
			array(
				"AccountNo"  => "0067111003209",
				"Amount"     => "0",
				"DrCr"       => "CR",
				"ChequeNo"   => " ",
				"Remarks"    => "Invoice No -  - Hasan ",
				"BranchCode" => "0067"			
			)
		),
		"commonInfo" => array(			
			"TrnBranchCode"   => "0001",
			"OfsUserID"=>"sbacOfs",
			"OfsUserPassword"=>"123456",
			"UserId"          => 106,
			"Password"        => "Test@123",
			"TransactionDate" => "2020-01-01",
		)
	)
);
$response = json_decode(json_encode($bankResponse), True);
echo "<pre>";
print_r($response);