<?php 
include('../database.php');



function balanceCheck($acc_no, $debit_sl)
{
	$transaction_date = date('Y-m-d');

	// cbs amount check api
	$customerClient          = new SoapClient("http://172.19.11.5:801/FloraService.svc?wsdl");
	$customerAccountResponse = $customerClient->OFSCustomerDrawableAmt(
		array(
			"commonInfo" => array(
				"TrnBranchCode"   => "0001",
				"OfsUserID"=>"sbacOfs",
				"OfsUserPassword"=>"123456",
				"UserId"          => 106,
				"TransactionDate" => $transaction_date,
				"Password"        => "Test@123"
			),
			"accountno" => $acc_no,
			
		)
	);

	$customerAccountArray = json_decode(json_encode($customerAccountResponse), True);
	$acc_response = json_encode($customerAccountResponse);
	$balance = $customerAccountArray['OFSCustomerDrawableAmtResult']['Balance'];
	$error = $customerAccountArray['OFSCustomerDrawableAmtResult']['Error'];
	date_default_timezone_set('Asia/Dhaka');
	$currentTimeStamp = date('Y-m-d H:i:s');
	
	
	$acc_response = mysql_real_escape_string($acc_response);
    $error= mysql_real_escape_string($error);
	$acc_response = mysql_real_escape_string($acc_response);
			   
	//store log for balance check
	$send_data = array('account_no' => $acc_no, 'debit_sl' =>$debit_sl);
	$insert_cvs_log  = mysql_query("INSERT INTO auto_card_cvs_charge_log (log_id, error, cvs_log, log_type, logTimeStamp, send_data) values ('$debit_sl', '$error', '$acc_response', '0', '$currentTimeStamp', '$send_data') ");

	return $balance_data = array('error'=> $error, 'balance'=>$balance);
}

function chargeBalance($acc_no, $pId_amt, $debit_sl, $payable_amount)
{

	$transaction_date = date('Y-m-d');
	$branch_code = substr($acc_no, 0, 4);
	//check gl for credit
	if($rate != '0.00')
	{
		$gl = "9238001";
		$remarks = "Auto debit Fee for USD";
	}else{
		$gl = "9238001";
		$remarks = "Auto debit Fee for Taka ";
	}
	
	file_put_contents('ram.txt', $gl.'---'.$remarks.PHP_EOL, FILE_APPEND);
	// Multiple Transaction
		$bankClient = new SoapClient("http://172.19.11.5:801/FloraService.svc?wsdl");
		$bankResponse=$bankClient->DoMultipleTransaction(
			array(
				"transactionList" => array(
					// customer account which account debited
					array(
						"AccountNo"  => $acc_no,
						"Amount"     => $pId_amt,
						//"Amount"     => '0.00',
						"DrCr"       => "DR",
						"ChequeNo"   => " ",
						"Remarks"    => "Auto debit Fee ",
						"BranchCode" => $branch_code
					),
					// Bank Account which account credited for card  charge fee
					array(
						"AccountNo"  => $gl,
						"Amount"     => $pId_amt,
						//"Amount"     => '0.00',
						"DrCr"       => "CR",
						"ChequeNo"   => " ",
						"Remarks"    => $remarks,
						"BranchCode" => "0014"			
					),


					
				),
				"commonInfo" => array(			
					"TrnBranchCode"   => "0001",
					"OfsUserID"=>"sbacOfs",
					"OfsUserPassword"=>"123456",
					"UserId"          => 106,
					"Password"        => "Test@123",
					"TransactionDate" => $transaction_date,
				)
			)
		);
		$response = json_decode(json_encode($bankResponse), True);
		$batch_no = $response['DoMultipleTransactionResult']['BatchNo'];
		$message = $response['DoMultipleTransactionResult']['Message'];
		$TraceNoList_0 = $response['DoMultipleTransactionResult']['TraceNoList']['string'][0];
		$TraceNoList_1 = $response['DoMultipleTransactionResult']['TraceNoList']['string'][1];
		$bnk_error = $response['DoMultipleTransactionResult']['Error'];
		$bnk_response = json_encode($bankResponse);
	   date_default_timezone_set('Asia/Dhaka');
	   $currentTimeStamp = date('Y-m-d H:i:s');
	   $bnk_error = mysql_real_escape_string($bnk_error);
	   $bnk_response = mysql_real_escape_string($bnk_response);
	  
		//store log for caharge apply
	    $send_data = array('account_no' => $acc_no, 'debit_sl' =>$debit_sl, 'pId_amt'=> $pId_amt, 'payable_amount' => $payable_amount);
			$insert_cvs_log  = mysql_query("INSERT INTO auto_card_cvs_charge_log (log_id, error, cvs_log, log_type, logTimeStamp, send_data) values ('$debit_sl', '$bnk_error', '$bnk_response', '1', '$currentTimeStamp', '$send_data') ");
		
		return $api_data = array('batch_no' => $batch_no, 'msg'=> $message, 'TraceNoList_0'=> $TraceNoList_0, 'TraceNoList_1' => $TraceNoList_1, 'bnk_error'=> $bnk_error, 'payable_amount' => $payable_amount);

		
		
		
		}

 ?>