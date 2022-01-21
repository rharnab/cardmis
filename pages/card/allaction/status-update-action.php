<?php

	include_once("../db/dbconnect.php");
	session_start();
	$status_id = '';

	if(isset($_POST['statusId'])){
		echo "Your id :".$status_id = (int)trim(mysql_real_escape_string($_POST['statusId']));
	}




?>
