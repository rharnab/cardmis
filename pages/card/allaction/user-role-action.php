<?php 
	include('../db/dbconnect.php');

	$roleName = '';
	$menuName = '';
	$subName  = '';

	if(isset($_POST['name'])){
		$roleName = $_POST['name'];
	}

	if(isset($_POST['pmenu'])){
		$menuName = $_POST['pmenu'];
	}
	if(isset($_POST['sname'])){
		$subName = $_POST['sname'];
	}

	if(!empty($roleName) && !empty($menuName) && !empty($subName)){
		$user_role_insert = $conn->prepare("INSERT INTO user_role SET role_name=?,menu_id=?,sub_menu_id=?");
		$user_role_insert->bindParam(1,$roleName);
		$user_role_insert->bindParam(2,$menuName);
		$user_role_insert->bindParam(3,$subName);
		if($user_role_insert->execute()){
			echo '<p class="alert alert-success">Successfully created user roles!</p>';
		}else{
			echo '<p class="alert alert-danger">System error!</p>';
		}
	}else{
		echo '<p class="alert alert-warning">Please fillup all input field!</p>';
	}
?>