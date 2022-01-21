<?php 
ini_set('max_execution_time', '0'); // for infinite time of execution 
//error_reporting(0);
include("database.php");
$count=0;

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
         $sql = "INSERT  IGNORE INTO   sbac_all_card_list ";
         $sql .= "(`client_id`, `card_holder_name`, `card_no`, `ac_no`,  `card_status`,`name_on_card`, `phone`, `email`, `upload_dt`, `file_upload_by`) VALUES ";
         //insert query

         //temp table insert query
         $temp_sql = "INSERT   INTO   sbac_all_card_list_temp ";
         $temp_sql .= "(`client_id`, `card_holder_name`, `card_no`, `ac_no`,  `card_status`,`name_on_card`, `phone`, `email`, `upload_dt`, `file_upload_by`) VALUES ";
         //insert query

         

         $query_parts = array();
         $temp_query_parts = array();
       

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
               
           
               
               
                  $query_parts [] = "('$client_id','$card_holder_name','$card_no','$ac_no', '$card_status', '$name_on_card', '$phone', '$email', '$upload_date', '$upload_by')";

                  $temp_query_parts [] = "('$client_id','$card_holder_name','$card_no','$ac_no', '$card_status', '$name_on_card', '$phone', '$email', '$upload_date', '$upload_by')";
                    

             }
            
          }


         }


        

                

              

         $sql .= implode(",", $query_parts);
         $q_insert = mysql_query($sql);
         //temp query
          $temp_sql .= implode(",", $query_parts);
          $temp_insert = mysql_query($temp_sql);
         //temp query

       
         


           

        }else{
          echo "File must be txt file";
        }


        // re-store update card list in sbac_all_card_list from sbac_all_card_list_temp
        $temp_table_sql = mysql_query(" SELECT  sbt.card_status as temp_card_status, sbt.ac_no, sbt.card_no, sb.card_status as old_card_status   from sbac_all_card_list  sb
        left join sbac_all_card_list_temp sbt on sbt.ac_no = sb.ac_no
        where sb.ac_no = sbt.ac_no and sb.card_no = sbt.card_no and sb.card_status != sbt.card_status ");

        while($temp_result = mysql_fetch_assoc($temp_table_sql))
        {
            $temp_card_stutas= $temp_result['temp_card_status'];
            $temp_ac_no = $temp_result['ac_no'];
            $temp_card_no = $temp_result['card_no'];
            $old_card_status = $temp_result['old_card_status'];

            $tem_pull_success = mysql_query("UPDATE sbac_all_card_list set  card_status = '$temp_card_stutas' where ac_no = '$temp_ac_no' and  card_no='$temp_card_no' and card_status='$old_card_status' ");
        }

         mysql_query("TRUNCATE table sbac_all_card_list_temp ");
        

        //update forwarding card number 

      
        
       
         print " Data Upload Successful ";
  






  
   }

    

  






 ?>