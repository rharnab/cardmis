<?php 
	include('../db/dbconnect.php');
	include('../database.php');

	$fname    = '';
	$lname    = '';
	$phone    = '';
	$email    = '';
	$accPer   = '';
	$brname   = '';
	$status   = '';
	$password = '';
	$access_id = '';
	
	if(isset($_POST['fname'])){
		$fname = $_POST['fname'];
	}

	if(isset($_POST['lname'])){
		$lname = $_POST['lname'];
	}
	if(isset($_POST['phone'])){
		$phone = $_POST['phone'];
	}
	if(isset($_POST['email'])){
		$email = $_POST['email'];
	}
	if(isset($_POST['accPer'])){
		$accPer = $_POST['accPer'];
	}
	if(isset($_POST['brname'])){
		$brname = $_POST['brname'];
	}
	if(isset($_POST['status'])){
		$status = $_POST['status'];
	}
	if(isset($_POST['status'])){
		$status = $_POST['status'];
	}

	if(isset($_POST['access_id'])){
		$access_id = $_POST['access_id'];
		
	}
	if(isset($_POST['password'])){
		$password = $_POST['password'];
		
	}
	$sha1Pass   = sha1($password);
	$random_num = $access_id.mt_rand(1000,9999);
	$cur_year   = date('Y');
	$auto_user_id = $cur_year.$random_num;
	$date = date('Y-m-d');

	$acc=mysql_query("SELECT access_id  from users where access_id= '$access_id' ");
	$dup_access_id =mysql_fetch_assoc($acc);

	if($dup_access_id == '')
	{
		$user_insert = mysql_query("INSERT INTO users (branch_id, user_fname, user_lname, user_id, user_pass, is_admin, phone, email, status, create_date, access_id, role_id) values ('$brname', '$fname', '$lname', '$auto_user_id', '$sha1Pass', '', '$phone', '$email', '$status','$date', '$access_id', '$accPer') ");

		if($user_insert){
				echo '<p class="alert alert-success">Successfully created user!</p>';
			}else{
				echo '<p class="alert alert-danger">System error!</p>';
		}
	}else{
		echo '<p class="alert alert-danger">Sorry user id is duplicate !</p>';
	}


	
	


?>