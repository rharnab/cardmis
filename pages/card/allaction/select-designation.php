<?php 
	include('../db/dbconnect.php');
	$branch_name = '';

	if(isset($_POST['branch'])){
		$branch_name = trim($_POST['branch']);
	}
	
	$select_desig = $conn->prepare("SELECT designation FROM users WHERE branch=?");
	$select_desig->bindParam(1,$branch_name);
	$select_desig->execute();
	$rowData = $select_desig->fetchAll(PDO::FETCH_OBJ);	
	echo json_encode($rowData);
?>