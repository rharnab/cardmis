<?php 
	include_once('../db/dbconnect.php');
	session_start();
	$update_sts   = '';
	$accno        = '';
	$current_sts  = '';
	$status_by_id = $_SESSION['id'];
	$date         = date('Y-m-d');

	if(isset($_POST['update_sts'])){
		$update_sts = trim(mysql_real_escape_string($_POST['update_sts']));
	}
	if(isset($_POST['accno'])){
		$accno = trim(mysql_real_escape_string($_POST['accno']));
	}
	if(isset($_POST['current_sts'])){
		$current_sts = trim(mysql_real_escape_string($_POST['current_sts']));
	}

	$update_status = $conn->prepare("UPDATE debit_card_api_bk SET status=?,status_by_id=?,status_date=? WHERE accountno=? AND status=?");
	$update_status->bindParam(1,$update_sts);
	$update_status->bindParam(2,$status_by_id);
	$update_status->bindParam(3,$date);
	$update_status->bindParam(4,$accno);
	$update_status->bindParam(5,$current_sts);

	if($update_status->execute()){
		echo "Update";
	}else{
		echo "Failed";
	}


?>