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
   $rate = $_POST['rate'];
   $ex_end_dt = explode('/',  $_POST['ex_end_dt']);
   $ex_end_dt= $ex_end_dt[2]."-".$ex_end_dt[1]."-".$ex_end_dt[0];
   $today = date('Y-m-d');


$du_sql = mysql_query("SELECT file_name from auto_debit_charge where file_name='$file_name' ");
$dup_result = mysql_fetch_array($du_sql);

if($dup_result['file_name'] === $file_name)
{
  

echo " Sorry this is duplicate file ";

}else{


  $ext = explode(".", $file_name);
  if($ext[1] =='TXT' or $ext[1] =='txt')
  {

          //read text file
          $fp = fopen($_FILES['input_file']['tmp_name'],'r'); 
          // Add each line to an array
          if ($fp) {
             $data = explode("\n", fread($fp, filesize($_FILES['input_file']['tmp_name'])));
          }
          
           foreach($data as $key => $val)
           {
              //real data start 
              if($key > 13)
              {

                   $data_value =explode('|', $val);
                   $card_no =  $data_value[1];
                   $card_holder_name =  $data_value[2];
                   $account_number =  $data_value[3];
                   $payment_instruction =  $data_value[4];
                   $outstanding_balacne =  str_replace(',', '', str_replace('-', '', $data_value[5]));
                   $due_amount =  str_replace(',', '', str_replace('-', '', $data_value[6]));
                   $payment_amount =  str_replace(',', '', str_replace('-', '', $data_value[7]));
                   $net_due_amount =  str_replace(',', '', str_replace('-', '', $data_value[8]));

                  if($rate != '')
                   {
                        $payable_amount= $net_due_amount * $rate;
                   }else{
                        $payable_amount = $net_due_amount;
                        
                   }


                   if($card_no !='' && $card_holder_name !='' && $account_number !=''  && $net_due_amount !='' && $account_number !='N/A')
                   {

                      $insert = mysql_query("INSERT INTO auto_debit_charge(card_holder_name, card_no, account_no, payment_instruction, outstanding_balacne, due_amount, payment_amount, net_due_amount, payable_amount,  paid_fee_amt, due_fee_amt, process_dt, exc_till_date, usd_rate, remarks, entry_dt, file_name, status) VALUES ('$card_holder_name','$card_no','$account_number','$payment_instruction','$outstanding_balacne', '$due_amount', '$payment_amount', '$net_due_amount', '$payable_amount',  '0.00', '$payable_amount', '0000-00-00', '$ex_end_dt', '$rate', ' ', '$today', '$file_name', '0')");
                      if($insert)
                      {
                        $count++;
                      }

                   }

              } 

           }
        

          //end read text file

           

        }else{
          echo "File must be txt file";
        }

         print "$count card charge  Created ";
  

}




  
   }

    

  






 ?>