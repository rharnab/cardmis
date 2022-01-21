<?php  include("../database.php"); ?>
<?php 

$rate_id = $_POST['id'];
$query =mysql_query("SELECT * FROM `rate_tb` where rate <> '' and id='$rate_id' ");
$data =mysql_fetch_assoc($query);

echo json_encode($data);

 ?>