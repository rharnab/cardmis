<?php 
	include_once('db/dbconnect.php');
	include_once('functions/functions.php');

	$files = $_FILES['debitTxt'];
	
	$fopen = fopen($files['tmp_name'], "r");
	$i = 1;
	while ( $lineRead = fgets($fopen) ) {

		$cols = explode('|', $lineRead);

		if(count($cols) === 13 && ctype_digit(trim($cols[1]))){

			/*echo trim($cols[1]).' - '.trim($cols[2]).' - '.trim($cols[3]).' - '.trim($cols[7]).' - '.trim($cols[10]).' - '.removeParentheses(trim($cols[10])).' - '.substr(trim($cols[2]), 0,6)."<br>";*/

			// verify mobile number //
			$mobile = removeParentheses(trim($cols[10]));
			switch($mobile){
				case strlen($mobile) == 13 :
					$mobile = $mobile;
					break;
				case strlen($mobile) < 13 :
					$mobile = '';
					break;
				/*case strlen($mobile) > 13 :
					$mobile = $mobile;
					break;*/	
			}

			// Getting card title //
			$prefixOfCardNumber = substr(trim($cols[2]),0,6);
			if( $prefixOfCardNumber == '927001' || $prefixOfCardNumber == '927002' || $prefixOfCardNumber == '410803'){
				$title = "Debit";
			}else{
				$title = "Credit";
			}

			// select existing data //
			$select = $conn->prepare("SELECT * FROM text_file_info WHERE cl_id=?");
			$select->bindParam(1,trim($cols[1]));
			$select->execute();
			$rowData = $select->fetch(PDO::FETCH_ASSOC);

			if($rowData['cl_id'] == trim($cols[1])){

				if($rowData['mobile'] != $mobile){
					// just update phone number
					$update_info = $conn->prepare("UPDATE text_file_info SET mobile=? WHERE cl_id=?");
					$update_info->bindParam(1,$mobile);
					$update_info->bindParam(2,$rowData['cl_id']);
					if($update_info->execute()){
						echo "Mobile number has been update<br>";
					}else{
						echo "Mobile number update failed! <br>";
					}
				}
				echo "Already Exist<br>";
			}else{
				// if not exist information then run this query //
				$insert_info = $conn->prepare("INSERT INTO text_file_info SET cl_id=?,cl_name=?,card_number=?,card_title=?,mobile=?,card_status=?");
				$insert_info->bindParam(1,trim($cols[1]));
				$insert_info->bindParam(2,trim($cols[3]));
				$insert_info->bindParam(3,trim($cols[2]));
				$insert_info->bindParam(4,$title);
				$insert_info->bindParam(5,$mobile);
				$insert_info->bindParam(6,trim($cols[7]));
				if($insert_info->execute()){
					echo "Insert ID => ". trim($cols[1]);
					echo "<br />";
				}else{
					echo "Failed ID => ". trim($cols[1]);
					echo "<br />";
				}
			}

		}elseif(count($cols) === 44 && ctype_digit(trim($cols[2]))){
			/*echo trim($cols[2]).' - '.trim($cols[4]).' - '.trim($cols[5]).' - '.removeParentheses(trim($cols[24])).' - '.trim($cols[25]).' - '.trim($cols[33]).' - '.substr(trim($cols[33]), 0,6)."<br>";*/
			// verify mobile number //
			$mobile = removeParentheses(trim($cols[24]));
			switch($mobile){
				case strlen($mobile) == 13 :
					$mobile = $mobile;
					break;
				case strlen($mobile) < 13 :
					$mobile = '';
					break;
				/*case strlen($mobile) > 13 :
					$mobile = $mobile;
					break;*/	
			}

			// select existing data //
			$select = $conn->prepare("SELECT * FROM text_file_info WHERE cl_id=?");
			$select->bindParam(1,trim($cols[2]));
			$select->execute();
			$rowData = $select->fetch(PDO::FETCH_ASSOC);

			if($rowData['cl_id'] == trim($cols[2])){
				
				if($rowData['mobile'] == $mobile){
					// update Email & DOB
					$dob = trim($cols[5]);
					$dob = date('Y-m-d',strtotime($dob));
					$update_info = $conn->prepare("UPDATE text_file_info SET email=?,cl_dob=? WHERE cl_id=?");
					$update_info->bindParam(1,trim($cols[25]));
					$update_info->bindParam(2,$dob);
					$update_info->bindParam(3,$rowData['cl_id']);
					if($update_info->execute()){
						echo "Update Success! <br>";
					}else{
						echo "Update failed! <br>";
					}

				}else{
					// update email,dob,phone
					$dob = trim($cols[5]);
					$dob = date('Y-m-d',strtotime($dob));
					$update_info = $conn->prepare("UPDATE text_file_info SET mobile=?,email=?,cl_dob=? WHERE cl_id=?");
					$update_info->bindParam(1,$mobile);
					$update_info->bindParam(2,trim($cols[25]));
					$update_info->bindParam(3,$dob);
					$update_info->bindParam(4,$rowData['cl_id']);
					if($update_info->execute()){
						echo "All update has been success! <br>";
					}else{
						echo "All update failed! <br>";
					}
				}

			}else{
				/*
					Insert Data 
					Getting card title
				*/
				$prefixOfCardNumber = substr(trim($cols[33]),0,6);
				if( $prefixOfCardNumber == '927001' || $prefixOfCardNumber == '927002' || $prefixOfCardNumber == '410803'){
					$title = "Debit";
				}else{
					$title = "Credit";
				}

				$dob = trim($cols[5]); // date of birth
				$dob = date('Y-m-d',strtotime($dob));

				$insert_info = $conn->prepare("INSERT INTO text_file_info SET cl_id=?,cl_name=?,card_number=?,card_title=?,mobile=?,email=?,card_status=?,cl_dob=?");
				$insert_info->bindParam(1,trim($cols[2]));
				$insert_info->bindParam(2,trim($cols[4]));
				$insert_info->bindParam(3,trim($cols[33]));
				$insert_info->bindParam(4,$title);
				$insert_info->bindParam(5,$mobile);
				$insert_info->bindParam(6,trim($cols[25]));
				$insert_info->bindParam(7,trim($cols[37]));
				$insert_info->bindParam(8,$dob);
				if($insert_info->execute()){
					echo "Successfully Inserted! <br>";
				}else{
					echo "Insert Failed!";
				}

			}

		}

		// Counting total row //
		$i++;
	}

	fclose($fopen);
	echo "<br>Total Query row find out = ".$i;

?>