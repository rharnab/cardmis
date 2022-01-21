<?php  include("../database.php");
    include_once('../db/dbconnect.php');
    include_once('../functions/functions.php');
    include('../common_script.php'); ?> 


<?php 
$status = $_POST['status'];
$account_array_list = $_POST['account_array_list'];
$accounts = implode(',', str_replace(' ','' , $account_array_list));

    
    //session_start();
    $approve_id  = $_SESSION['login_id'];
    $approveDate = date('Y-m-d');
    $batch_num   = mt_rand(111111,999999);

    $auth_time= date('h:i:s');
    

    foreach($account_array_list as $account_no)
    {
        $acc_num = trim($account_no);
        $select_batch = mysql_query("SELECT batch_num FROM debit_card_api  WHERE accountno= '$acc_num' and request_type='5' ");
        $rowData = mysql_fetch_assoc($select_batch);

        $fb_num = '';

        if($rowData['batch_num'] == ''){
            $fb_num = $batch_num;
        }else{
            $fb_num = $rowData['batch_num'];
        }

    }

    
   
    

    // update debit card api approve_date //
    if($_SESSION['branch_id'] =='1')
    {
 
        

       $update_aprrove =  mysql_query("UPDATE debit_card_api set card_status='$status', approve_by_id='$approve_id', approve_date='$approveDate', batch_num='$fb_num', status='2', ho_auth_time='$auth_time' where accountno in ($accounts) and request_type='5' ");

     if($update_aprrove)
      {

        // foreach($account_array_list as $account)
        // {

        //    sendSMS($account);
        // }

      }
       	
   
    }else{

    	$update_aprrove= mysql_query("UPDATE debit_card_api set status='1', br_approve_id='$approve_id', br_auth_time='$auth_time' where accountno in ($accounts) and request_type='5' ");

        if($update_aprrove)
          {

            // foreach($account_array_list as $account)
            // {

            //    sendSMS($account);
            // }

          }
     
    }

    
    
    if($update_aprrove){
        //send_mobile_sms($message,$phone);
        echo "Approve has been success!";
    }else{
        echo "Approve has been failed!";
    }




 ?>