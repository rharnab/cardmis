<?php 

	include("database.php");
	$cardno=$_GET['cardno'];
	
	//$cardno='4107720100028130';


	$q=mysql_query("SELECT card_name FROM card_no_manual where card_no='$cardno'");		
	
	if(mysql_num_rows($q)>0)
	{
		$r=mysql_fetch_array($q);
		echo $r['card_name'].'***'.'';
	}
	else
	{
		echo 'No cardno Found'.'***'.'';
	}

?>
