<?php 
include('../database.php');

date_default_timezone_set('Asia/Dhaka');

function balanceCheck($acc_no, $debit_sl)
{
	$transaction_date = date('Y-m-d');

	// cbs amount check api
	$customerClient          = new SoapClient("http://10.0.16.71:801/FloraService.svc?wsdl");
	$customerAccountResponse = $customerClient->OFSCustomerDrawableAmt(
		array(
			"commonInfo" => array(
				"TrnBranchCode"   => "0001",
				"OfsUserID"=>"general",
				"OfsUserPassword"=>"Hom@gazi#kk710r",
				"UserId"          => 106,
				"TransactionDate" => $transaction_date,
				"Password"        => "Sbac@789"
			),
			"accountno" => $acc_no,
			
		)
	);

	$customerAccountArray = json_decode(json_encode($customerAccountResponse), True);
	$acc_response = json_encode($customerAccountResponse);
	$balance = $customerAccountArray['OFSCustomerDrawableAmtResult']['Balance'];
	$error = $customerAccountArray['OFSCustomerDrawableAmtResult']['Error'];
	$currentTimeStamp = date('Y-m-d h:i:s');
	
	
	$acc_response = mysql_real_escape_string($acc_response);
    $error= mysql_real_escape_string($error);
	$acc_response = mysql_real_escape_string($acc_response);
			   
	//store log for balance check
	$insert_cvs_log  = mysql_query("INSERT INTO card_cvs_charge_log (log_id, error, cvs_log, log_type, logTimeStamp ) values ('$debit_sl', '$error', '$acc_response', '0', '$currentTimeStamp') ");

	return $balance_data = array('error'=> $error, 'balance'=>$balance);
}

function chargeBalance($acc_no, $pId_amt, $debit_sl, $vat, $card_fee)
{

	$transaction_date = date('Y-m-d');
	$branch_code = substr($acc_no, 0, 4);
	
	// Multiple Transaction
		$bankClient = new SoapClient("http://10.0.16.71:801/FloraService.svc?wsdl");
		$bankResponse=$bankClient->DoMultipleTransaction(
			array(
				"transactionList" => array(
					// customer account which account debited
					array(
						"AccountNo"  => $acc_no,
						"Amount"     => $pId_amt,
						"DrCr"       => "DR",
						"ChequeNo"   => " ",
						"Remarks"    => "Card Annual Fee for ".date('Y-M'),
						"BranchCode" => $branch_code
					),
					// Bank Account which account credited for card  charge fee
					array(
						"AccountNo"  => "9238001",
						"Amount"     => $card_fee,
						"DrCr"       => "CR",
						"ChequeNo"   => " ",
						"Remarks"    => "INC. Debit Card Annual Fees",
						"BranchCode" => "0014"			
					),
					// Bank Account which account credited for card vat fee
					array(
						"AccountNo"  => "9029023",
						"Amount"     => $vat,
						"DrCr"       => "CR",
						"ChequeNo"   => " ",
						"Remarks"    => "VAT ON CARD FEES",
						"BranchCode" => "0014"			
					)
				),
				"commonInfo" => array(			
					"TrnBranchCode"   => "0001",
					"OfsUserID"=>"general",
					"OfsUserPassword"=>"Hom@gazi#kk710r",
					"UserId"          => 106,
					"Password"        => "Sbac@789",
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
	   $currentTimeStamp = date('Y-m-d h:i:s');
	   $bnk_error = mysql_real_escape_string($bnk_error);
	   $bnk_response = mysql_real_escape_string($bnk_response);
	  
		//store log for caharge apply
			$insert_cvs_log  = mysql_query("INSERT INTO card_cvs_charge_log (log_id, error, cvs_log, log_type, logTimeStamp ) values ('$debit_sl', '$bnk_error', '$bnk_response', '1', '$currentTimeStamp') ");
		
		return $api_data = array('batch_no' => $batch_no, 'msg'=> $message, 'TraceNoList_0'=> $TraceNoList_0, 'TraceNoList_1' => $TraceNoList_1, 'bnk_error'=> $bnk_error, 'card_fee'=> $card_fee, 'vat'=> $vat);

		
		
		
		}

 ?>