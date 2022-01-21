<?php 
include('../database.php');
include('branch_common.php');
//error_reporting(0);
$today = date('Y-m-d');

$ch_query = mysql_query("SELECT charge_amount, sl,  paid_fee_amt, due_fee_amt, account_no, card_no   FROM branch_debit_charge  WHERE account_no <> '' and due_fee_amt <> '0' and status <> 1 and status=3  ");

while($ch_result = mysql_fetch_array($ch_query))
{
	$payable_amount = $ch_result['charge_amount'];
	$paid_fee_amt = $ch_result['paid_fee_amt'];
	$due_fee_amt = $ch_result['due_fee_amt'];
	$account_no_file = $ch_result['account_no'];
	$card_no_file = $ch_result['card_no'];
	$debit_sl = $ch_result['sl'];

	
	if($payable_amount != $paid_fee_amt)
	{

			   
			   $api_balance = balanceCheck($account_no_file, $debit_sl);
			   
			   $error= $api_balance['error'];
			   $balance = $api_balance['balance'];


				if($error =='N')
				{
				 $balance = str_replace(',', '',  $balance);
			     $log_balance = str_replace(',', '',  $balance);

				 //check balance upper total card fee
				 if($balance > $payable_amount)
				 {

					if($balance >= $due_fee_amt)
					{
						$l_balance = $balance - $due_fee_amt;

						$balance = number_format($l_balance, 2);

						$paid_amt = $paid_fee_amt + $due_fee_amt;
						$paid_fee_amt = number_format($paid_amt, 2);
						$log_paid = number_format($due_fee_amt,2);
						$due_fee_amt = number_format(0,2);
						$sts = '1';

						
						$log_due = number_format(0,2);
						$log_balance = number_format($log_balance,2);

					}else{
						
						 $due_fee_amt = $due_fee_amt - $balance;
						 $paid_amt = $paid_fee_amt+ $balance;
						 $paid_fee_amt = number_format($paid_amt, 2);
						 $due_fee_amt = number_format($due_fee_amt, 2);
						 $sts = '2';

						 $log_paid = number_format($balance,2);
						 $balance= 0;
						 $balance = number_format($balance,2);
						 $log_due = number_format($due_fee_amt,2);
						 $log_balance = number_format($log_balance,2);
					}

						$api_data = chargeBalance($account_no_file, $log_paid, $debit_sl, $payable_amount);
						$bnk_error = $api_data['bnk_error'];

						$bnk_error ="N";
						
						
						
						if($bnk_error == 'N')
						{
							$paid_fee_amt = str_replace(',', '', $paid_fee_amt);
							$due_fee_amt = str_replace(',', '', $due_fee_amt);

							//update auto_debit_charge table 
							$charge_update = mysql_query("UPDATE branch_debit_charge set paid_fee_amt = '$paid_fee_amt', due_fee_amt='$due_fee_amt', status='$sts' where sl='$debit_sl' ");

							if($charge_update)
							{
								//from cbs 
								
								$batch_no = mysql_real_escape_string($api_data['batch_no']);
								$msg = mysql_real_escape_string($api_data['msg']);
								$TraceNoList_0 = mysql_real_escape_string($api_data['TraceNoList_0']);
								$TraceNoList_1 = mysql_real_escape_string($api_data['TraceNoList_1']);
								$payable_amount = $api_data['payable_amount'];

								$payable_amount = str_replace(',', '', $payable_amount);
								$log_balance = str_replace(',', '', $log_balance);
								$log_paid = str_replace(',', '', $log_paid);
								$log_due = str_replace(',', '', $log_due);


								//insert histroy log for applied charge
								$log_query = mysql_query("INSERT into branch_card_charge_histry_log (card_no, acc_no, balance_amt, paid_amt, due_amt, charge_date, msg,batch_no,TraceNoList_0, TraceNoList_1, debit_sl, entry_date, charge_amount) values ('$card_no_file', '$account_no_file',  '$log_balance', '$log_paid', '$log_due', '$today', '$msg', '$batch_no', '$TraceNoList_0', '$TraceNoList_1',  '$debit_sl', '$today', '$payable_amount') ");

								


								if($log_query)
								{
									$msg = "success";
								} 
								 
							}
						}
						
						
					
				 	}
				}
			   
			   
			   
			   
			
			    
			 

		
		
	}
	
	
}

if(isset($msg))
{
	echo $msg;
}







 ?>