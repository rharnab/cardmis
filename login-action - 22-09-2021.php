<?php
	include('pages/card/db/dbconnect.php');
	session_start();

	$userId   = '';
	$userPass = '';

	if(isset($_POST['loginId'])){
		$userId = mysql_real_escape_string($_POST['loginId']);
	}
	if(isset($_POST['password'])){
		$userPass = mysql_real_escape_string($_POST['password']);
	}

	if(!empty($userId) && !empty($userPass)){

		$sha1Pass    = sha1($userPass);
		$select_user = $conn->prepare("SELECT * FROM users WHERE access_id=? AND user_pass=?");
		$select_user->bindParam(1,$userId);
		$select_user->bindParam(2,$sha1Pass);
		$select_user->execute();
		$rowData     = $select_user->fetch(PDO::FETCH_ASSOC);

		if($userId == $rowData['access_id'] && $sha1Pass == $rowData['user_pass']){

			if($rowData['status'] == '1')
			{
				$_SESSION['admin_type'] = $rowData['is_admin']; // user admin type //
				$_SESSION['login_id']   = $rowData['user_id'];  // user login id //
				$_SESSION['id']         = $rowData['uid'];      // user table id //
				$_SESSION['branch_id']  = $rowData['branch_id'];      // user table id //
				$_SESSION['role_id']  = $rowData['role_id'];      // user table id //
				header('Location: dashboard.php');

			}else{

				$_SESSION['s'] = "<span class='alert alert-warning'>Sorry Contact to the Authority</span>";
			    header("Location:index.php");
			}

		}else{

			$_SESSION['s'] = "<span class='alert alert-warning'>Please enter valid ID or Password!</span>";
			header("Location:index.php");
		}

	}else{
		$_SESSION['s']=  "<span class='alert alert-warning'>Please fillup this form!</span>";
		header("Location:index.php");
	}
	
?>