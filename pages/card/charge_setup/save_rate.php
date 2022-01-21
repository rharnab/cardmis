<?php  include("../database.php"); ?>

<?php 
$rate = $_POST['rate'];
$rate_date_array = explode('/', $_POST['rate_date']);
$rate_date = $rate_date_array[2]."-".$rate_date_array[1]."-".$rate_date_array[0];
$today = date('Y-m-d');
$user= $_SESSION['id'];

$insert =mysql_query("INSERT INTO rate_tb (rate, rate_date, create_by, create_date) values ('$rate', '$rate_date', '$user', '$today') ");

if($insert)
{
	echo  "RATE HAS BEEN SUCCSESSFULLY CREATED";

}else{
	echo  "SORRY ! RATE NOT CREATE YET";
}



 ?>