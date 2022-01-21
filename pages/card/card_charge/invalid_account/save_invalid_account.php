
<?php
	ini_set('max_execution_time', '0'); // for infinite time of execution 
    include("../../database.php");
	date_default_timezone_set('Asia/Dhaka');
	
?>


<?php 

include 'vendor/autoload.php';

if(isset($_FILES['invalid_file']['name']))
{
	$file_name= $_FILES['invalid_file']['name'];
	$file_path ="upload/".$_FILES['invalid_file']['name'];
	 $user = $_SESSION['login_id'];
	 $update_timeStamp = date('Y-m-d h:s:i');

	move_uploaded_file($_FILES['invalid_file']['tmp_name'], $file_name);
	$file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

    $spreadsheet = $reader->load($file_name);
	$data = $spreadsheet->getActiveSheet(1)->toArray();
	//$data = $spreadsheet->getSheetByName('FINAL')->toArray();
	/*echo "<pre>";
	print_r($data);die;*/
	
	$count=0;
	foreach($data as $key=>$val)
	{
		if($key > 2)
		{	

			 $name = $val[1];
			 $card_no = $val[2];
			 $account_number = $val[3];
			 $pay_amount = $val[6];
			 $upload_date = $val[7];

			 if(strlen($account_number) < 14)
			 {
			 	$account_number = str_repeat(0, 13 - strlen($account_number)).$account_number;
			 }

			 

			 

			 if(!empty($card_no) && !empty($account_number))
			 {

			 	//find debit charge account
				 $query= mysql_query("SELECT card_no_file, account_no_file, card_holder_name, payable_net_amount FROM debit_charge_deduction where card_no_file = '$card_no' and card_holder_name = '$name' and payable_net_amount ='$pay_amount' and status = '0' and entry_dt = '$upload_date' ");

				 $result =mysql_fetch_assoc($query);
				 $fetch_name =$result['card_holder_name'];
				 $fetch_card_no =$result['card_no_file'];
				 $fetch_pay_amount =$result['payable_net_amount'];
				 $fetch_account_no =$result['account_no_file'];
				//find debit charge account


				 /*update account no */
				  $update =mysql_query("UPDATE debit_charge_deduction set account_no_file='$account_number', update_by='$user', update_timestamp='$update_timeStamp' where card_no_file= '$fetch_card_no' and account_no_file='$fetch_account_no' and card_holder_name='$fetch_name' and payable_net_amount='$fetch_pay_amount' and entry_dt = '$upload_date' ");
				 /*end update account no */

				 if($update)
				 {
				 	$count += 1;
				 }

				 //print_r($val);

			 }

			
		}

		
	}
	print $count.' ACCOUNT NUMBER UPDATED';

}



 ?>