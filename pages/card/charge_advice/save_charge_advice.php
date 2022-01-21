<?php 
ini_set('max_execution_time', '0'); // for infinite time of execution 
error_reporting(0);
include("../database.php");
/*echo $_FILES['input_file']['name'];
echo print_r($_POST);*/
$count=0;

if(isset($_FILES['input_file']))
{
   $file_name = $_FILES['input_file']['name'];
   
   $upload_by = $_SESSION['login_id'];
   $upload_date = date('Y-m-d');
   $rate= $_POST['rate'];

$du_sql = mysql_query("SELECT file_name from debit_advice_charge where file_name ='$file_name' ");
$dup_result = mysql_fetch_array($du_sql);

if($dup_result['file_name'] === $file_name)
{
  

echo " Sorry this is duplicate file ";

}else{


  $ext = explode(".", $file_name);
  if($ext[1] =='TXT' or $ext[1] =='txt')
  {

         $fp= fopen($_FILES['input_file']['tmp_name'], "r");
         $file_array=explode("\n", fread($fp, filesize($_FILES['input_file']['tmp_name'])));
         $insert_data = 0;
         $file_row = count($file_array);
        //print_r($file_array);
         for($i=14; $i<$file_row; $i++)
         {
         	$data=explode('|', $file_array[$i]);
         	if($data[1] && $data[2] && $data[3] != '')
         	{
         		list($null, $card_no, $holder_name, $branch_ac_no, $payment_instruction, $outstandint_balance, $due_amount, $pay_amount, $net_due_amount)= $data;
         		$card_no = mysql_real_escape_string(trim($card_no));
         		$holder_name = mysql_real_escape_string(trim($holder_name));
         		$branch_ac_no = mysql_real_escape_string(trim($branch_ac_no));
         		$payment_instruction = mysql_real_escape_string(trim($payment_instruction));
         		$outstandint_balance = mysql_real_escape_string(trim($outstandint_balance));
         		$due_amount = mysql_real_escape_string(trim($due_amount));
         		$pay_amount = mysql_real_escape_string(trim($pay_amount));
         		$net_due_amount = mysql_real_escape_string(trim($net_due_amount));
         		$insert = mysql_query("INSERT INTO debit_advice_charge (card_no, holder_name, branch_ac_no, payment_instruction, outstanding_balance, due_amount, pay_amount, net_due_amount, upload_date, upload_by, file_name, rate) values ('$card_no', '$holder_name', '$branch_ac_no', '$payment_instruction', '$outstandint_balance', '$due_amount', '$pay_amount', '$net_due_amount', '$upload_date', '$upload_by', '$file_name', '$rate') ");
         		if($insert)
         		{
         			$insert_data +=1;
         		}
         		
         		
         	}
         	
         }
         

           

        }else{
          echo "File must be txt file";
        }

         print "$insert_data debit advice  charge  Created";
  

}




  
   }

    

  






 ?>