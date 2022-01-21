<?php 

	$dsn      = 'mysql:dbname=cardmis;host=localhost';
    $user     = 'root';
    $password = 'vsl@123';
    
	try{
		$conn = new PDO($dsn,$user,$password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $error){

		print "Database not found!: ".$error->getMessage();
        die();
	}

?>