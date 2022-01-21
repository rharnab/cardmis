<?php 

$permission = '';
if(isset($_POST['permission'])){
	echo $permission = mysql_real_escape_string($_POST['permission']);
}

$currentDate = date('Y-m-d');

?>