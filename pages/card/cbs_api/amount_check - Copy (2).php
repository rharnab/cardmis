<?php
// cbs amount check api
$customerClient          = new SoapClient("http://172.19.11.5:801/FloraService.svc?wsdl");
$customerAccountResponse = $customerClient->OFSCustomerDrawableAmt(
	array(
	
		"commonInfo" => array(
				"TrnBranchCode"   => "0020",
				"OfsUserID"=>"utility",
				"OfsUserPassword"=>"Vtyu#88kkd@sbac",
				"UserId"          => 106,
				"TransactionDate" => "2020-01-01",
				"Password"        => "Test@321"
			),
			"accountno" => "0020120024960",
	)
);

$customerAccountArray = json_decode(json_encode($customerAccountResponse), True);  
echo "<pre>";
print_r($customerAccountArray);

echo $balance = $customerAccountArray['OFSCustomerDrawableAmtResult']['Balance'];

/*
"commonInfo" => array(
											"TrnBranchCode" => $balanceCheckUserBranchCode,
											"OfsUserID"=>"utility",
											"OfsUserPassword"=>"Vtyu#88kkd@sbac",
											"UserId"=> $balanceCheckUserId,
											"Password"=> $cbsApiPassword,
											"TransactionDate"=> $today, 
										),
										"accountno" =>  $agentGlAccCode,
										
										
										
										"OfsUserID"=>"sbacOfs",
				"OfsUserPassword"=>"123456",
										
										
										
										
										
										*/



