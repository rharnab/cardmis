<?php  include("../database.php"); ?>

<?php 
$rate = $_POST['rate'];
$rate_date= $_POST['rate_date'];
/*$rate_date_array = explode('-', $_POST['rate_date']);
$rate_date = $rate_date_array[2]."-".$rate_date_array[1]."-".$rate_date_array[0];*/
$id= $_POST['id'];

$insert =mysql_query("UPDATE rate_tb set rate='$rate', rate_date='$rate_date' where id='$id' ");

if($insert)
{
	echo  "RATE HAS BEEN SUCCSESSFULLY UPDATED";

}else{
	echo  "SORRY ! RATE NOT UPDATED YET";
}
