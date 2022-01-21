<?php 
	include('../db/dbconnect.php');

	$msg = '';
	$type = 'mobile';
	if(isset($_POST['data'])){
		$msg = trim(mysql_real_escape_string($_POST['data']));
	}

	if(!empty($msg)){
		
		if(strlen($msg) <= 160){

			$msg_insert = $conn->prepare("INSERT INTO debit_card_sms SET message=?,message_type=?");
			$msg_insert->bindParam(1,$msg);
			$msg_insert->bindParam(2,$type);

			if($msg_insert->execute()){
				echo "Successfully Save";
			}else{
				echo "Save Failed";
			}

		}else{
			echo "Your message to big!";
		}
	}else{
		echo "Please write a message!";

	}

 ?>