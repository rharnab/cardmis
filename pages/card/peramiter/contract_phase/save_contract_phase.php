<?php include("../../database.php"); ?>


<?php 

$formdata = $_POST['formData'];
if(isset($formdata[0]['value']))
{
	$value = strtoupper(trim($formdata[0]['value']));
	$description = trim($formdata[1]['value']);

	$duplicate = mysql_query("SELECT value from contract_phases where value= '$value' ");
	if(mysql_num_rows($duplicate) > 0)
	{
		echo "SORRY DUPLICATE  VLUE";
	}else{
		$insert = mysql_query("INSERT into  contract_phases (value, description) values ('$value', '$description') ");
		if($insert)
		{
			echo  "NEW DATA ADDED SUCCESSFUL";
		}else{
			echo "SORRY DATA NOT YET PLEASE TRY AGAIN";
		}
	}

}

 ?>