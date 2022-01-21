<?php 
ini_set('max_execution_time', '0'); // for infinite time of execution 
//error_reporting(0);
include("database.php");
$count=0;
$duplicate = 0;
//echo "<pre>";
if(isset($_FILES['input_file']))
{
   $file_name = $_FILES['input_file']['name'];
   
   $upload_by = $_SESSION['login_id'];
   $upload_date = date('Y-m-d');
   $ok=0;
   $dt=date("Y-m-d H:i:s");

  $ext = explode(".", $file_name);
  if($ext[1] =='TXT' or $ext[1] =='txt')
  {

         $fp= fopen($_FILES['input_file']['tmp_name'], "r");
         $insert_data = 0;

         //insert query
         $sql = "INSERT INTO  sbac_all_card_list ";
         $sql .= "(`client_id`, `card_holder_name`, `card_no`, `ac_no`, `upload_dt`, `file_upload_by`, `card_status`,`name_on_card`, `phone`, `email`) VALUES ";
         //insert query

         $query_parts = array();

         while ($line = fgets($fp)) {

            // <... Do your work with the line ...>
         $rowArray=explode("|", $line);
         // echo "<pre>";
         // print_r($rowArray);
           if(!empty($rowArray[1]) and !empty($rowArray[6]) and !empty($rowArray[3]))
           {
            
             if(is_numeric(trim($rowArray[1])) and is_numeric(trim($rowArray[6])) and is_numeric(trim($rowArray[3])))
             {
                $client_id=trim($rowArray[1]);
                $card_holder_name=mysql_real_escape_string(trim($rowArray[2]));
                $card_no=trim($rowArray[3]);
                $name_on_card=mysql_real_escape_string(trim($rowArray[4]));
                $ac_no=trim($rowArray[6]);
                $card_status=mysql_real_escape_string(trim($rowArray[13]));
                $phone = str_replace(')', '', substr($rowArray[10], 5, 16));

               if(isset($rowArray[16]))
               {
                  $email = trim($rowArray[16]);
               }else{

                  $email = trim($rowArray[15]);
               }
               

                $q_check=mysql_query("SELECT sl FROM sbac_all_card_list WHERE card_no='$card_no' AND ac_no='$ac_no'");

                 if(mysql_num_rows($q_check)==0)
                 {
                  $query_parts [] = "('$client_id','$card_holder_name','$card_no','$ac_no','$dt','$upload_by', '$card_status', '$name_on_card', '$phone', '$email')";
                    $count++;
                 }else{
                  $duplicate++;

                 }

             }
            
          }


         }

         $sql .= implode(",", $query_parts);
         $q_insert = mysql_query($sql);
           

        }else{
          echo "File must be txt file";
        }


         print "$count Card list successfully Uploaded 
                and duplicate Card number is $duplicate";
  






  
   }

    

  






 ?>