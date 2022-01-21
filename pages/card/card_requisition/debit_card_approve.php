<?php 
    include_once('../db/dbconnect.php');
    include_once('../functions/functions.php');
    include('../common_script.php');
    include("../database.php");
    
    $approve_id  = $_SESSION['login_id'];
    $approveDate = date('Y-m-d');
    $batch_num   = mt_rand(111111,999999);
    $status      = '';
    $acc_num     = "";

    if(isset($_POST['accno'])){
    	 $acc_num =  trim($_POST['accno']);
    }
    if(isset($_POST['status'])){
           $status = trim(mysql_real_escape_string($_POST['status']));
    }

    if($_POST['remarks'] !='')
    {
        $remarks = $_POST['remarks'];
    }else{
        $remarks= '';
    }
    

    $select_batch = mysql_query("SELECT batch_num FROM debit_card_api  WHERE accountno= '$acc_num' and request_type='1'");
   
    $rowData = mysql_fetch_assoc($select_batch);

    $fb_num = '';

    if($rowData['batch_num'] == ''){
        $fb_num = $batch_num;
    }else{
        $fb_num = $rowData['batch_num'];
    }
    
    

    // update debit card api approve_date for head office //
    if($_SESSION['branch_id'] =='1')
    {
       
        if(trim($status) =='dishonour')
        {
             $aut_status ='5';
        }else{

             $aut_status ='2';
        }

         $update_aprrove = mysql_query("UPDATE debit_card_api SET card_status='$status',approve_by_id='$approve_id',approve_date='$approveDate',batch_num='$fb_num', status='$aut_status', remarks='$remarks' WHERE accountno= '$acc_num' and request_type='1' ");
       
        //for sms send
        /*if(trim($status) =='approve')
        {
            sendSMS($acc_num);
        }*/

    }else{

        //update debit card api approve_date for branch
        $update_aprrove = mysql_query("UPDATE debit_card_api SET status='$status', approve_by_id= '$approve_id', remarks='$remarks' WHERE accountno='$acc_num' and request_type='1' ");
        
        /*if(trim($status)=='1')
        {
            sendSMS($acc_num);
        }*/
       
       
    }

    
    
    if($update_aprrove){
        //send_mobile_sms($message,$phone);
       echo   "Process has been success.";
    }else{
       echo   "Process has been failed.";
    }

?>