<?php  include("../database.php"); ?>

<?php 

function latestRate()
{
	$query =mysql_query("SELECT rate, rate_date from  rate_tb order by id desc limit 1");
	$result =mysql_fetch_assoc($query);
	return $result;

}


 ?>