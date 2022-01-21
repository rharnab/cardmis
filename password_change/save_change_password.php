<?php 
include('../pages/card/database.php');
$access_id =  $_SESSION['access_id'];
$user_pass =  $_SESSION['user_pass'];

$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

$input_password = sha1($old_password);
$set_password = sha1($new_password);

if($input_password == $user_pass  )
{
	
	$query = mysql_query("SELECT access_id, user_pass, change_password_YN from users where access_id= '$access_id' and user_pass='$user_pass'  ");
	$resut = mysql_fetch_assoc($query);

	if($resut['change_password_YN'] == 'N')
	{
		$success = mysql_query("UPDATE users set change_password_YN='Y', user_pass = '$set_password' where access_id= '$access_id' and user_pass='$user_pass'   ");
		echo 1;

	}else{
		echo "Sorry try again ";
	}

}else{

	echo "Sorry old password not match ";
}









 ?>