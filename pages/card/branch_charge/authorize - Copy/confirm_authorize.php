<?php  include('../../database.php'); ?>

<?php 
if(isset($_POST['submit']))
{
	$all_check_id = $_POST['auth_id'];
	$today = date('Y-m-d');
	$user = $_SESSION['login_id'];
	$sl_id = implode(',', $all_check_id); //sparate by semicolone
	$update= mysql_query("UPDATE branch_debit_charge set status='3', authorize_by='$user', authorize_dt='$today' where sl in ($sl_id) and status='0' and branch_id= '$branch_id'  ");

	
	if($update)
	{
		echo "<script>alert('Charges successfully authorize'); window.location.href='auth_charge.php';</script>";
	}else{
		echo "<script>alert('Sorry ! Authorize not Complete yet '); window.location.href='auth_charge.php';</script></script>";
		


	}
	
	
	
}


 ?>