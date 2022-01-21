<?php 

    $phoneNumber = $_POST['indi'];
	$msg         = $_POST['message'];

	$userName    = "sbacsms";
	$password    = "SbacMizan@321";
	$data        = 'Username='.$userName.'&Password='.$password.'&From=SBAC BANK&To=88'.$phoneNumber.'&Message='.$msg;
	

	$messageUrl  = "https://api.mobireach.com.bd/SendTextMessage?".$data;
	// $messageUrl = "https://api.myjson.com/bins/1359ww";

	echo $messageUrl;
	// $response = file_get_contents($messageUrl);
  	$xml = simplexml_load_file($messageUrl) or die("feed not loading");
  	// $Rate = $xml->ArrayOfServiceClass->Currency['1']->Rate;

	echo $xml;
?>