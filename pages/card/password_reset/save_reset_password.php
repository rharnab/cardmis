
<?php include('../database.php') ?>
<?php 
$user_id = $_POST['user_id'];
$query= mysql_query("SELECT access_id from users where access_id <> '' and access_id='$user_id' ");
$result = mysql_fetch_assoc($query);
$access_id = $result['access_id'];
$password  = '123456';
$enc_password = sha1($password);
$success = mysql_query("UPDATE users set user_pass='$enc_password', change_password_YN='N' where  access_id= '$access_id' ");
if($success)
{
	echo "Password Reset success and common password is 123456 ";
}else{
	echo " Sorry password not reset yet ";
}

 ?>