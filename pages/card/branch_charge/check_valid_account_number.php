<?php 


$str = '1234';

if ($str == $_POST['acc_number'])
 {
	echo 1;
 }else{
	echo 0;
 }

die;
$input_acc_no =$_POST['acc_number'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://172.19.11.143/FLORA_API/account_info?acc=$input_acc_no',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);
//echo $response;
curl_close($curl);
$account_info = json_decode($response);
//print_r($account_info);
$account_number =  trim($account_info->accountno);
 if ($input_acc_no == $account_number)
 {
	echo 1;
 }else{
	echo 0;
 }






  ?>
