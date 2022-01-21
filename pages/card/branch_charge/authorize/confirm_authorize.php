<?php  include('../../database.php'); ?>

<?php
if(isset($_POST['submit']))
{
	if($_POST['auth_id'] !='')

	{

		$all_check_id = $_POST['auth_id'];
		$branch_id = $_POST['branch_id'];

		$frm = $_POST['frm'];
		$to = $_POST['to'];

		if($branch_id !='')
		  {
		    $branch_sql = " and branch_id='$branch_id' ";
		  }else{

		    $branch_sql = '';
		  }
		 
		  
		$today = date('Y-m-d');
		$user = $_SESSION['login_id'];
		$sl_id = implode(',', $all_check_id); //sparate by semicolone
		$update= mysql_query("UPDATE branch_debit_charge set status='3', authorize_by='$user', authorize_dt='$today' where sl in ($sl_id) and status='0' $branch_sql  ");

		
		if($update)
		{
			  $url = "auth_charge.php?branch_id=$branch_id&frm_dt=$frm&to_dt=$to&status=1";
			  header("Location: $url");
		}else{
			
			 $url = "auth_charge.php?branch_id=$branch_id&frm_dt=$frm&to_dt=$to&status=0";
		     header("Location: $url");
		
		}

	}else{
		header("Location: auth_charge.php ");
	}


	
	
	
}else if(isset($_POST['decline'])){

	if($_POST['auth_id'] !='')
	{

		$all_check_id = $_POST['auth_id'];
		$branch_id = $_POST['branch_id'];
		 $frm = $_POST['frm'];
		 $to = $_POST['to'];

		if($branch_id !='')
		  {
		    $branch_sql = " and branch_id='$branch_id' ";
		  }else{

		    $branch_sql = '';
		  }
		$sl_id = implode(',', $all_check_id); //sparate by semicolone
		$delete= mysql_query("DELETE from branch_debit_charge where sl in ($sl_id) $branch_sql ");

		
		if($delete)
		{
			$url = "auth_charge.php?branch_id=$branch_id&frm_dt=$frm&to_dt=$to&status=3";
			  header("Location: $url");
		}else{
		
			 $url = "auth_charge.php?branch_id=$branch_id&frm_dt=$frm&to_dt=$to&status=4";
		     header("Location: $url");
		
		}

	}else{
		header("Location: auth_charge.php ");
	}

	
}


 ?>