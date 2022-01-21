<?php 
	include('../db/dbconnect.php');

	$value = '';
	if(isset($_POST['value'])){
		$value = filter_var(mysql_real_escape_string($_POST['value']),FILTER_SANITIZE_STRING);
	}

	$select_br_district = $conn->prepare("SELECT distinct br_city FROM `branches` WHERE br_division=?");
	$select_br_district->bindParam(1,$value);
	$select_br_district->execute();
	$rowData = $select_br_district->fetchAll(PDO::FETCH_OBJ);
	
	/*$result = [];

	while($rowData = $select_br_district->fetch(PDO::FETCH_ASSOC)){
		$result[] = $rowData['br_city'];
	}*/

	echo json_encode($rowData);
?>