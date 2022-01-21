<?php
    include("database.php");
    
    $cardno=$_REQUEST['cardno'];
    $tdate=$_REQUEST['tdate'];
    $amount=$_REQUEST['amount'];        
	$traceno=(rand(100000,999999));

	$q=mysql_query("INSERT INTO card.bill_entry_log (card_no, trdate, amount, traceno) VALUES ('$cardno', '$tdate', '$amount', '$traceno')");
	

	if($q)
	{
		echo "<script>alert('Bill Paid successfully')</script>";
		echo "<script>window.location='/cardMis/dashboard.php'</script>";
	}
	else
	{
		echo "<script>alert('Bill cant process Contact Administrator')</script>";
		
	}
	


?>
