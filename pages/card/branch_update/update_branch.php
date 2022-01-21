<?php include('../database.php') ?>

<?php 

//print_r($_POST);die;

$brName = $_POST['brName'];
$brCode = $_POST['brCode'];
$brPhone = $_POST['brPhone'];
$brEmail = $_POST['brEmail'];
$brSwiftCode = $_POST['brSwiftCode'];
$brDivi = $_POST['brDivi'];
$brDis = $_POST['brDis'];
$brAddress = $_POST['brAddress'];
$branch_id = $_POST['branch_id'];

 $sql = "SELECT * from branches where id = '$branch_id' ";
 $query = mysql_query($sql);
 $data  = mysql_fetch_assoc($query);

 $update_id = $data['id'];

 if(empty($brDis))
  {
  	$brDis = $data['br_city'];
  }


 if(!empty($data))
 {
 	$update=mysql_query("UPDATE branches set br_title= '$brName', br_code='$brCode', br_address='$brAddress', br_city='$brDis', br_division='$brDivi', br_phone='$brPhone', br_email='$brEmail', swift_code='$brSwiftCode' where id= '$update_id' ");

 	if($update_id)
 	{
 		echo  "Branch update successful";
 	}
 }








 ?>