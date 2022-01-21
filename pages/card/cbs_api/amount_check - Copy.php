<?php
// cbs amount check api
$customerClient          = new SoapClient("http://172.19.11.109:8081/FloraService.svc?wsdl");
$customerAccountResponse = $customerClient->OFSCustomerDrawableAmt(
	array(
		"commonInfo" => array(
			"TrnBranchCode"   => "0077",
			"UserId"          => 644,
			"TransactionDate" => "2020-01-01",
			"Password"        => "Test@123"
		),
		"accountno" => '0011120062081',
	)
);

$customerAccountArray = json_decode(json_encode($customerAccountResponse), True);  
echo "<pre>";
print_r($customerAccountArray);