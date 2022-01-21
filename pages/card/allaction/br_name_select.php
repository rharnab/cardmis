<?php 
	include('../db/dbconnect.php');

	$value = '';
	if(isset($_POST['value'])){
		$value = filter_var(mysql_real_escape_string($_POST['value']),FILTER_SANITIZE_STRING);
	}

	$select_br_name = $conn->prepare("SELECT id,br_title FROM branches WHERE br_city=?");
	$select_br_name->bindParam(1,$value);
	$select_br_name->execute();
	$rowData = $select_br_name->fetchAll(PDO::FETCH_OBJ);

	echo json_encode($rowData);
?>