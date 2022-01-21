<?php	
//if(!($mylink=mysql_connect("localhost","root","RtgsRoot123")))
	if(!($mylink=mysql_connect("localhost","root","vsl@123")))
 {
	print "<h3>couldnot connect database</h3>\n";
	exit;
	}	
	@mysql_select_db("cardmis", $mylink ) or die ("unable to locate database");

	date_default_timezone_set('Asia/Dhaka');
?>