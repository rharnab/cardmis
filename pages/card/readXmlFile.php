<?php 
	include_once('db/dbconnect.php');
	include_once('functions/functions.php');

	$file = $_FILES['readXmlFile'];

	$xml = simplexml_load_file($file['name']);
	/*echo "<pre>";
	var_dump($xml);*/

	foreach($xml->Statement as $value){
		echo $value->Client.' - '.$value->IdClient."<br>";
	}

?>