<?php 

	$fileName = '';

	if(isset($_POST['fileName'])){
		$fileName = $_POST['fileName'];
	}

	echo $fileName;
?>