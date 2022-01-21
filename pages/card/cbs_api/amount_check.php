<?php
// cbs amount check api
$customerClient          = new SoapClient("http://172.19.11.5:801/FloraService.svc?wsdl");
$customerAccountResponse = $customerClient->OFSCustomerDrawableAmt(
	array(
	
		"commonInfo" => array(
				"TrnBranchCode"   => "0001",
				"OfsUserID"=>"sbacOfs",
				"OfsUserPassword"=>"123456",
				"UserId"          => 106,
				"TransactionDate" => "2020-01-01",
				"Password"        => "Test@123"
			),
			"accountno" => "0055111003034",
	)
);

$customerAccountArray = json_decode(json_encode($customerAccountResponse), True);  
echo "<pre>";
print_r($customerAccountArray);

echo $balance = $customerAccountArray['OFSCustomerDrawableAmtResult']['Balance'];
