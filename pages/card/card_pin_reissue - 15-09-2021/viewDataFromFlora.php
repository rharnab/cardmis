<?php 

	$accNumber = '';
	if(isset($_POST['accnumber'])){

		$accNumber = $_POST['accnumber'];
	}

	$file_get_contents = file_get_contents("http://172.19.11.1/CBS_API/account_info?acc=$accNumber");
	$api_data = json_decode($file_get_contents,true); // creating array //
	echo $file_get_contents;
	

 ?>