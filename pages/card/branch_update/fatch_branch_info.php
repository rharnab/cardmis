<?php include('../database.php') ?>
<?php 

$id = $_POST['id'];
 $sql = "SELECT * from branches where id = '$id' ";
 $query = mysql_query($sql);
 $data  = mysql_fetch_assoc($query);

 echo json_encode($data);


 ?>