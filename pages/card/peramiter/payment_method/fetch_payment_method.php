<?php include("../../database.php");  ?>
<?php 
if(isset($_POST['id']))
{
	$id = $_POST['id'];

	$sql =mysql_query("SELECT * from payment_method where payment_method_id ='$id' ");
	$data = mysql_fetch_array($sql);

	echo json_encode($data);

}

 ?>