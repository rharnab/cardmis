<?php include("../database.php"); ?>
<?php

$role_name = $_POST['role_name'];
$menus_sl = $_POST['menu_name'];
$succcess = '' ;

if(!empty($role_name))
{
	$role_insert = mysql_query("INSERT INTO role (role_name) values ('$role_name') ");

	if($role_insert)
	{
		//get role id
		$role_query = mysql_query("SELECT id from role where role_name= '$role_name' order by id desc  ");
		$reuslt = mysql_fetch_assoc($role_query);
		$role_id =  $reuslt['id'];
		
		foreach($menus_sl as $menu_id)
		{
			$menu_query = mysql_query("SELECT role from menu_table where sl= '$menu_id' ");
			$menu_result = mysql_fetch_assoc($menu_query);
			$menu_rule = $menu_result['role'];

			$role_array = explode(',', $menu_rule);

			if(!in_array($role_id, $role_array))
			{
				$new_role = $menu_rule.",".$role_id; //add new role with old role

				$update = mysql_query("UPDATE menu_table set role='$new_role' where sl='$menu_id' ");
				if($update)
				{

					 $succcess= 1;
				}
			}


		}


	}else{
		echo "Sorry role id not inserted";
	}
}else{
		echo "Sorry Menu name not seleted";
	}

if(!empty($succcess))
{
	echo "Role created successful";
}else{
	echo "Sorry !! Role not create yet";
}



 ?>