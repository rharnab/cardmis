<?php  include('../../database.php'); ?>

<?php 
$branch_id =  $_GET['branch_id'];
/*$frm = date('Y-m-d', strtotime($_GET['frm_dt']));
$to = date('Y-m-d', strtotime($_GET['to_dt']));*/

$frm_dt = explode('/', $_GET['frm_dt']);
$frm = $frm_dt[2]."-".$frm_dt[1]."-".$frm_dt[0];
$to_dt = explode('/', $_GET['to_dt']);
$to = $to_dt[2]."-".$to_dt[1]."-".$to_dt[0];

if($branch_id !='')
{
	$branch_sql = " and branch_id='$branch_id' ";
}else{

	$branch_sql = '';
}

$today = date('Y-m-d');
$user = $_SESSION['login_id'];

$update= mysql_query("UPDATE branch_debit_charge set status='3', authorize_by='$user', authorize_dt='$today' where upload_dt between '$frm' and '$to' and status ='0' $branch_sql ");


if($update)
{
	//echo "<script>alert('Charges successfully authorize'); window.location.href='auth_charge.php';</script>";

	 $url = "auth_charge.php?".$_SERVER['QUERY_STRING'];
	 header("HTTP/1.1 301 Moved Permanently"); 
	 header("Location: $url");

}else{
	//echo "<script>alert('Sorry ! Authorize not Complete yet '); window.location.href='auth_charge.php';</script></script>";

	 $url = "auth_charge.php?".$_SERVER['QUERY_STRING'];
	 header("HTTP/1.1 301 Moved Permanently"); 
	 header("Location: $url");

}

 ?>