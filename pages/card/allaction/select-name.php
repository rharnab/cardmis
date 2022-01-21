<?php 
	include('../db/dbconnect.php');
	$designation = '';

	if(isset($_POST['data'])){
		$designation = trim($_POST['data']);
	}
	
	$select_name = $conn->prepare("SELECT uid,f_name,l_name,user_id FROM users WHERE designation=?");
	$select_name->bindParam(1,$designation);
	$select_name->execute();
	$rowData = $select_name->fetchAll(PDO::FETCH_OBJ);	
	echo json_encode($rowData);
?>