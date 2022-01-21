<?php
include("database.php");

$opt=$_GET['opt'];
$clCode=$_GET['clCode'];

$q=mysql_query("update customer set actStatus='$opt' where IdClient='$clCode'");
?>
