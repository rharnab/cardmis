
<?php include("../database.php");?>


<?php 



if(isset($_FILES['input_file']['name']))
{
	$file_name= $_FILES['input_file']['name'];
	$file_path ="upload/".$_FILES['input_file']['name'];
	$count = 0;
	$fopen = fopen($_FILES['input_file']['tmp_name'], 'r');
	 while ($line = fgets($fopen)) 
	 {
	 	 $rowArray=explode("|", $line);


	 	 if(!empty($rowArray[0]) && !empty($rowArray[1]) && !empty($rowArray[2]))
	 	 {


	 	 	$card_number = trim($rowArray[0]);
			$account_number = trim($rowArray[1]);
			$acphone_lngth = strlen(trim($rowArray[2]));
			$card_type = mysql_real_escape_string(trim($rowArray[3]));
			if($acphone_lngth == 11)
			{
				 $accPhone = substr($rowArray[2], 1, 10);
			}else{
				 $accPhone = $rowArray[2];
			}
			

			 $info_query = mysql_query("SELECT accountno, card_number, accphone from debit_card_api where card_number is NULL and accountno='$account_number' and accphone='$accPhone' ");


			 $result = mysql_fetch_assoc($info_query);
			 $info_acc_no =  $result['accountno'];
			 $info_phone_no =  $result['accphone'];

			 if($result !='')
			 {
			 	 $update = mysql_query("UPDATE debit_card_api set card_number='$card_number', card_type='$card_type'  where accountno='$info_acc_no' and accphone='$info_phone_no' ");

			 	 if($update)
				 {
				 	$count = $count + 1;
				 }
			 }


	 	 }

	 	
	 }

	

}


if($count !=0 )
{
	echo $count." Card number successfully updated";
}else{
	echo "Sorry card number not updated ";
}







 ?>