<?php 
include("../database.php");

$account_no = $_POST['account_no'];
$card_no = $_POST['card_no'];
$charge_amount = $_POST['charge_amount'];
$today = date('Y-m-d');
$user = $_SESSION['login_id'];
$branch_id = $_SESSION['branch_id']; 

 $insert= mysql_query("INSERT INTO `branch_debit_charge`(`card_holder_name`, `card_no`, `account_no`, `charge_amount`, `paid_fee_amt`, `due_fee_amt`, `process_dt`, `status`, `remarks`, `entry_by`, `entry_dt`, `upload_dt`, `branch_id`) VALUES ('', '$card_no', '$account_no', '$charge_amount', '0.00', '$charge_amount', '0000-00-00', '0', '', '$user', '$today', '$today', '$branch_id')");

 if($insert)
 {
   echo 1;
 }else{
    echo 0;
 }

 ?>