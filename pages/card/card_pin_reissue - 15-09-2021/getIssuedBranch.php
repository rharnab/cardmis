<?php include('../database.php') ?>
<?php 
$accnumber = $_POST['accnumber'];

$branch_code = substr($accnumber, 0, 4);

$query =mysql_query("SELECT br_title, id   from branches where br_code='$branch_code' ");
$branch_name = mysql_fetch_assoc($query);

echo json_encode($branch_name)








 ?>