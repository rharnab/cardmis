<?php	
include("database.php");
/*
$q=mysql_query("select * from customer_contact");
while($r=mysql_fetch_array($q))
{
	mysql_query("update customer set email='$r[email]' where IdClient='$r[IdClient]'");
}
*/

$q=mysql_query("select * from customer");
while($r=mysql_fetch_array($q))
{
	mysql_query("update customer_contact set email='$r[email]' where IdClient='$r[IdClient]'");
}
?>