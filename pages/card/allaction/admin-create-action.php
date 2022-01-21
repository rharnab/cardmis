<?php 
	include('../db/dbconnect.php');

	$user_id = '';
	$user_type = '';
	$user_status = 0;
	
	if(isset($_POST['user_id'])){
		$user_id = trim(mysql_real_escape_string($_POST['user_id']));
	}
	if(isset($_POST['user_type'])){
		$user_type = trim(mysql_real_escape_string($_POST['user_type']));
	}
	if(isset($_POST['user_status'])){
		$user_status = trim(mysql_real_escape_string($_POST['user_status']));
	}

	if(!empty($user_id) && !empty($user_type) && !empty($user_status)){
		$insert = $conn->prepare("INSERT INTO admin SET admin_user_id=?,admin_type=?,admin_status=?");
		$insert->bindParam(1,$user_id,PDO::PARAM_INT);
		$insert->bindParam(2,$user_type,PDO::PARAM_STR);
		$insert->bindParam(3,$user_status,PDO::PARAM_INT);
		if($insert->execute()){
			echo '<p class="alert alert-success">Successfully created admin!</p>';
		}else{
			echo '<p class="alert alert-danger">System error!</p>';
		}
	}else{
		echo '<p class="alert alert-info">Please fillup all input field!</p>';
	}

?>