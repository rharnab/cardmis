<?php include('../database.php') ?>


<?php 

    
	
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
	/*if(isset($_POST['status'])){
		$status = $_POST['status'];
	}*/
	

	if(isset($_POST['access_id'])){
		$access_id = $_POST['access_id'];
		
	}

	/*if(isset($_POST['user_id'])){
		$user_id = $_POST['user_id'];
	}*/

	if(isset($_POST['status'])){
		$status = $_POST['status'];
	}


	if(isset($_POST['edit_id'])){
		$edit_id = $_POST['edit_id'];
	}
	
	$cur_year   = date('Y');
	$date = date('Y-m-d');

	$acc=mysql_query("SELECT access_id  from users where uid= '$edit_id' ");
	$dup_access_id =mysql_fetch_assoc($acc);

	if($dup_access_id != '')
	{
		$user_insert = mysql_query("UPDATE users set branch_id='$brname', user_fname='$fname', user_lname='$lname', status='$status', phone='$phone', email='$email', access_id='$access_id', role_id='$accPer' where uid= '$edit_id' ");

		if($user_insert){
				echo 'User Successfully updated!';
			}else{
				echo 'System error';
		}
	}else{
		echo 'Sorry user id not found  !';
	}


 ?>