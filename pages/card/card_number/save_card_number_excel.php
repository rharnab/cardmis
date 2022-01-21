
<?php include("../database.php");?>


<?php 

include 'vendor/autoload.php';

if(isset($_FILES['input_file']['name']))
{
	$file_name= $_FILES['input_file']['name'];
	$file_path ="upload/".$_FILES['input_file']['name'];

	 move_uploaded_file($_FILES['input_file']['tmp_name'], $file_name);
	 $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
     $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

    $spreadsheet = $reader->load($file_name);
	$data = $spreadsheet->getActiveSheet(1)->toArray();
	//$data = $spreadsheet->getSheetByName('FINAL')->toArray();
	$count = 0;

	foreach($data as $key => $val)
	{
		

				$card_number = $val[0];
				$account_number = $val[1];
				$accPhone = $val[2];

				 $info_query = mysql_query("SELECT accountno, card_number, accphone from debit_card_api where card_number is NULL and accountno='$account_number' and accphone='$accPhone' ");

				 $result = mysql_fetch_assoc($info_query);
				 $info_acc_no =  $result['accountno'];
				 $info_phone_no =  $result['accphone'];

				 if($result !='')
				 {
				 	 $update = mysql_query("UPDATE debit_card_api set card_number='$card_number'  where accountno='$info_acc_no' and accphone='$info_phone_no' ");

				 	 if($update)
					 {
					 	$count = $count + 1;
					 }
				 }


				

				
	}
	

}
unlink($file_name);

if($count !=0 )
{
	echo $count." Card number successfully updated";
}else{
	echo "Sorry card number not updated ";
}







 ?>