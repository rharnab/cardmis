<?php include("database.php"); ?>

<?php 
function sendSMS($account_no)
{
	$sql = mysql_query("SELECT accphone, accotherphone, accotheremail from debit_card_api where accountno='$account_no' ");
	$result = mysql_fetch_assoc($sql);
	 $accphone = "0".$result['accphone'];
	 $accotherphone = "0".$result['accotherphone'];

	/*if(!empty($result['accphone']))
	{
		  $response = SMS($accphone, $account_no);

	}

	if(!empty($result['accotherphone']))
	{
		  $response = SMS($accotherphone, $account_no);
		
	}*/

	/*if(!empty($result['accotheremail']))
	{
		echo $result['accotheremail']."<br>";
	}*/

	if(!empty($accphone) && !empty($accotherphone))
	{
		$phoneNumber = $accphone.",".$accotherphone;
	}else{

		$phoneNumber = $accphone;
	}

	if(!empty($phoneNumber))
	{
		$response = SMS($phoneNumber, $account_no);
	}	


}

//sendSMS('1234567899871');

// sms function

function SMS($phoneNumber, $account_no)
{

	$curl = curl_init();

    //$phone_number = "01517822138";

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.mobireach.com.bd/SendTextMessage?Username=sbacsms&Password=SbacMizan@321&From=SBAC%20BANK&To=".$phoneNumber."&Message=Vsl",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_SSL_VERIFYHOST => false,
	  CURLOPT_SSL_VERIFYPEER => false,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'GET',
	));
	$response = curl_exec($curl);
	if(curl_errno($curl))
	{
		 $eroormsg= curl_errno($curl);
	}

	curl_close($curl);
	//echo $response;
	
    $sms_response =  json_encode(simplexml_load_string($response));
    
	$success =explode('success', $response);
	$send_date = date('Y-m-d h:i:s');
	if(!empty($success))
	{
		$success_flag = 1;
	}else{
		$success_flag = 0;
	}

	$insert= mysql_query("INSERT INTO sms_send_record (account_no, phone_no, send_date, response, success) values ('$account_no', '$phoneNumber', '$send_date', '$sms_response', '$success_flag') ");
	if($insert)
	{
		return true;
	}else{
		return false;
	}
	
}




 ?>