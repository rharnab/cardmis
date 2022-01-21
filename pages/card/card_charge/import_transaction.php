<?php 
ini_set('max_execution_time', '0'); // for infinite time of execution 
include("../database.php");
error_reporting(0);
$count=0;
if(isset($_FILES['input_file']))
{
   $file_name = $_FILES['input_file']['name'];
   $debit_amount = $_POST['debit_amount'];
   $narration = $_POST['narration'];
   $payable_net_amount = sprintf('%.2f', ($debit_amount * 115) / 100 );
   $payable_vat_amount  =sprintf('%.2f', $debit_amount * (15/100) );
   
$du_sql = mysql_query("SELECT file_name from debit_charge_deduction where file_name_='$file_name' ");
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
             $array = explode("\n", fread($fp, filesize($_FILES['input_file']['tmp_name'])));
          }
          /*for excel create*/
           $i=4;
           $sl=1;
           $db_amt = 0;
           $net_amt = 0;
           $t_vat = 0;
           $excel_data_checker = '';
           $invalid_ac = 0;
          /*for excel create*/



          //$data=array();
          foreach ($array as $key => $value) {
            if($key>12){
              $a = substr($value, 0, 46);
               $postingDt=substr($a, 0, 10);
               $cardHolderName=trim(substr($a, 10));
              $b =substr($value, 46);
              $e = substr($b, 0, 33);
              $f=explode("    ", $e);
              $x=substr($b,33);
              $y=substr($x, 0,17);

              $cardStatus=trim($y);
              $z=substr($x, 17);
              $b=preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $b);
              $c=explode(' ',$b);
              if(!empty($f[1]))
              {
                $acNo=$f[1];
                $cardNo=$f[0];
               $d=explode(' ',$z);
              
              $createdDt=$c[3];
              $expireDt=$c[4];
              $cardFee=str_replace(',', '', trim($c[5]));
              $vatAmt=str_replace(',', '', trim($c[6]));
              $totalCardFee=str_replace(',', '', trim($c[7]));
              $cardFeeRevAmt=str_replace(',', '', trim($c[8]));
              $vatRevAmt=str_replace(',', '', trim($c[9]));
              $totalCardFeeRevAmt=str_replace(',', '', trim($c[10]));
              $dt=date("Y-m-d h:i:s");
             
              $p_date = explode('/', $postingDt);
              $postingDt = $p_date[2]."-".$p_date[1]."-".$p_date[0];

              $c_date = explode('/', $createdDt);
              $createdDt = $c_date[2]."-".$c_date[1]."-".$c_date[0];
              $e_date = explode('/', $expireDt);
              $expireDt = $e_date[2]."-".$e_date[1]."-".$e_date[0];

              $q=mysql_query("INSERT INTO debit_charge_deduction (posting_dt, card_holder_name, card_no_file, account_no_file, card_status, created_dt, expiry_dt, card_fee, vat, total_card_fee, card_fee_rev, vat_rev, total_card_fee_rev, ac_from_flora, ac_from_tebonus, status, entry_dt, process_dt, remarks, file_name, due_fee_amt, debit_amount, payable_net_amount,payable_vat_amount, narrition) VALUES ('$postingDt','$cardHolderName','$cardNo','$acNo','$cardStatus','$createdDt','$expireDt','$cardFee','$vatAmt','$totalCardFee','$cardFeeRevAmt','$vatRevAmt','$totalCardFeeRevAmt','','','0','$dt','','File Upload', '$file_name', '$payable_net_amount', '$debit_amount', '$payable_net_amount', '$payable_vat_amount', '$narration')");

              if($q){
                $count++;
              }
            }

           /* invalid account findout*/
           
             if($key>12){

                  $b =substr($value, 46);
                  $acc=explode(' ', $b);
                  $flora_ac_chk = strlen($acc[4]);

                  if($flora_ac_chk != 13 &&  $acc[4] !='')
                  {
            
                    $flora_acc_number= $acc[4];
                    $upload_dt=date("Y-m-d h:i:s");

                    $insert =mysql_query("INSERT INTO card_charge_temp (card_holder_name, card_no_file, account_no_file, payable_net_amount, payable_vat_amount, debit_amount, upload_dt) values ('$cardHolderName', '$cardNo', '$flora_acc_number', '$payable_net_amount', '$payable_vat_amount', '$debit_amount', '$upload_dt') ");

                    if($insert)
                    {
                      $invalid_ac += 1;
                    }

                    
                   
                  } //not equal 13 digit
               } //initial if
              /* end invalid account findout */ 


              } //end start key for real data
            
            }//end read text file  foreach

                

           

        }else{
          echo "File must be txt file";
        }

         print "$count card charge  Created and $invalid_ac is invalid account";
  

}




  
   }
  






 ?>