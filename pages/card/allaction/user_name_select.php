<?php 
	include_once('../db/dbconnect.php');

	$data = '';
	if(isset($_POST['data'])){
		$data = mysql_real_escape_string($_POST['data']);
	}

	$select_user = $conn->prepare("SELECT * FROM users WHERE branch_id=?");
	$select_user->bindParam(1,$data);
	$select_user->execute();
	$rowData = $select_user->fetchAll(PDO::FETCH_OBJ);
	echo json_encode($rowData);
?>