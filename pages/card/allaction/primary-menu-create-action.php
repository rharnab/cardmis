<?php 

include 'database.php';

$primaryMenu = '';
if(isset($_POST['pMenu'])){
	$primaryMenu = $_POST['pMenu'];
}

echo 'ok';

?>