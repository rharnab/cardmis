
<?php include("../database.php"); 
ini_set('max_execution_time', '0'); // for infinite time of execution  ?>


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


	 	  // <... Do your work with the line ...>
         // echo "<pre>";
         // print_r($rowArray);
           if(!empty($rowArray[1]) and !empty($rowArray[6]) and !empty($rowArray[3]))
           {
            
             if(is_numeric(trim($rowArray[1])) and is_numeric(trim($rowArray[6])) and is_numeric(trim($rowArray[3])))
             {
             	if(trim($rowArray[13]) =='Embossed')
             	{

             		//$client_id=trim($rowArray[1]);
	                //$card_holder_name=mysql_real_escape_string(trim($rowArray[2]));
	                $card_no=trim($rowArray[3]);
	                //$name_on_card=mysql_real_escape_string(trim($rowArray[4]));
	                $ac_no=trim($rowArray[6]);
	                $card_status=mysql_real_escape_string(trim($rowArray[13]));
	                $phone = str_replace(')', '', substr($rowArray[10], 5, 16));

	                $forward_sql = mysql_query(" SELECT accountno,  accphone from debit_card_api where accountno <> '' and   ( forword_card_number ='' or forword_card_number is null) and accountno='$ac_no'   ");

	          

		            $forward_result  = mysql_fetch_assoc($forward_sql);

		           
		            $accphone = $forward_result['accphone'];
		            $db_account_no = $forward_result['accountno'];

		            if( $db_account_no == $ac_no )
		            {
		            	$success = mysql_query("UPDATE debit_card_api set forword_card_number='$card_no' where accountno='$db_account_no' and  accphone='$accphone' ");
		            	if($success)
		            	{

		            	 $count++;
		            	}
		            	
		            }





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