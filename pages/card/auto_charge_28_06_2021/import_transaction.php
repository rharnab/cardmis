<?php 
ini_set('max_execution_time', '0'); // for infinite time of execution 
include("../database.php");
/*echo $_FILES['input_file']['name'];
echo print_r($_POST);*/
$count=0;

if(isset($_FILES['input_file']))
{
   $file_name = $_FILES['input_file']['name'];

$du_sql = mysql_query("SELECT file_name from debit_charge_deduction where file_name='$file_name' ");
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
          //print "<pre>";
          // print_r($array);
          $data=array();
          foreach ($array as $key => $value) {
            if($key>12){
              $a = substr($value, 0, 46);
              //print "<pre>";
              //print_r($value);
               $postingDt=substr($a, 0, 10);
               $cardHolderName=trim(substr($a, 10));
              $b =substr($value, 46);
              $e = substr($b, 0, 33);
              $f=explode("    ", $e);
              $x=substr($b,33);
              $y=substr($x, 0,17);

              $cardStatus=trim($y);
              $z=substr($x, 17);
              //echo "<pre>";
              //print_r($b);
             // print $b."------".preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $b)."<br>";
              $b=preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $b);
            // print "<br>";
             // print_r($b);
              $c=explode(' ',$b);
            //  print_r($c);
              if(!empty($f[1]))
              {
                $acNo=$f[1];
                $cardNo=$f[0];
               $d=explode(' ',$z);
               
             // print_r($d);
              //$cardStatus=$d[0];
              $createdDt=$c[3];
              $expireDt=$c[4];
              $cardFee=str_replace(',', '', trim($c[5]));
              $vatAmt=str_replace(',', '', trim($c[6]));
              $totalCardFee=str_replace(',', '', trim($c[7]));
              $cardFeeRevAmt=str_replace(',', '', trim($c[8]));
              $vatRevAmt=str_replace(',', '', trim($c[9]));
              $totalCardFeeRevAmt=str_replace(',', '', trim($c[10]));
              $dt=date("Y-m-d");
            // print  $str=$postingDt.",".$cardHolderName.",".$cardNo.",".$acNo.",".$cardStatus.",".$createdDt.",".$expireDt.",".$cardFee.",".$vatAmt.",".$totalCardFee.",".$totalCardFee.",".$cardFeeRevAmt.",".$vatRevAmt.",".$totalCardFeeRevAmt;
             // print "$str <br>";
             
              $p_date = explode('/', $postingDt);
              $postingDt = $p_date[2]."-".$p_date[1]."-".$p_date[0];

              $c_date = explode('/', $createdDt);
              $createdDt = $c_date[2]."-".$c_date[1]."-".$c_date[0];
              $e_date = explode('/', $expireDt);
              $expireDt = $e_date[2]."-".$e_date[1]."-".$e_date[0];

              $q=mysql_query("INSERT INTO debit_charge_deduction (posting_dt, card_holder_name, card_no_file, account_no_file, card_status, created_dt, expiry_dt, card_fee, vat, total_card_fee, card_fee_rev, vat_rev, total_card_fee_rev, ac_from_flora, ac_from_tebonus, status, entry_dt, process_dt, remarks, file_name, due_fee_amt) VALUES ('$postingDt','$cardHolderName','$cardNo','$acNo','$cardStatus','$createdDt','$expireDt','$cardFee','$vatAmt','$totalCardFee','$cardFeeRevAmt','$vatRevAmt','$totalCardFeeRevAmt','','','0','$dt','','File Upload', '$file_name', '$totalCardFee')");

              if($q)
                $count++;

                /*echo $cardNo."--<br>";
                echo "<pre>";
                 print_r($value)."--<br>";*/
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