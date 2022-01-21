<?php
	include('pages/card/db/dbconnect.php');
	include('pages/card/database.php');
	//session_start();

	$userId   = '';
	$userPass = '';

	if(isset($_SESSION['login_try']) &&  ($_SESSION['login_try'] > 3))
	{
		unset($_SESSION['login_try']);
	}
	

	if(isset($_POST['loginId'])){
		$userId = mysql_real_escape_string($_POST['loginId']);
	}
	if(isset($_POST['password'])){
		$userPass = mysql_real_escape_string($_POST['password']);
	}

	if(!empty($userId) && !empty($userPass)){

		$sha1Pass    = sha1($userPass);
		$select_user = $conn->prepare("SELECT * FROM users WHERE access_id=?");
		$select_user->bindParam(1,$userId);
		/*$select_user->bindParam(2,$sha1Pass);*/
		$select_user->execute();
		$rowData     = $select_user->fetch(PDO::FETCH_ASSOC);




		if($userId == $rowData['access_id'] && $sha1Pass == $rowData['user_pass'] && $rowData['change_password_YN'] == 'Y'){

			if($rowData['status'] == '1')
			{
				$_SESSION['login_try']=0;
				$_SESSION['admin_type'] = $rowData['is_admin']; // user admin type //
				$_SESSION['login_id']   = $rowData['user_id'];  // user login id //
				$_SESSION['id']         = $rowData['uid'];      // user table id //
				$_SESSION['branch_id']  = $rowData['branch_id'];      // user table id //
				$_SESSION['role_id']  = $rowData['role_id'];      // user table id //
				header('Location: dashboard.php');

			}else{

				$_SESSION['s'] = "<span class='alert alert-warning'>Sorry this user is blocked</span>";
			    header("Location:index.php");
			}


			

		}else if($userId == $rowData['access_id'] && $sha1Pass == $rowData['user_pass'] && $rowData['change_password_YN'] == 'N'){

			$_SESSION['access_id']  = $rowData['access_id'];
			$_SESSION['user_pass']  = $rowData['user_pass'];
			

			header("Location:password_change/change_password.php");


		}else if($userId == $rowData['access_id'] && $sha1Pass !== $rowData['user_pass']){

			if(isset($_SESSION['login_try']))
			{
				$_SESSION['login_try'] = $_SESSION['login_try']+1;
			}else{
				$_SESSION['login_try']=1;
			}

			if($_SESSION['login_try']==3)
			{
				 mysql_query("UPDATE users set status='0' where access_id='$userId' ");

				$_SESSION['s'] = "<span class='alert alert-warning'>Sorry this user is blocked</span>";
			    header("Location:index.php");
			}else{

				$_SESSION['s'] = "<span class='alert alert-warning'>Please enter valid ID or Password!</span>";
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