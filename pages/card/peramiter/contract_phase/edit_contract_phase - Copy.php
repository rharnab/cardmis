<?php
 include("../../database.php");
?>
<?php 
//update contracts


if(isset($_POST['value']))
{
    $id = trim($_POST['hidden_id']);
    $value = trim($_POST['value']);
    $description = trim($_POST['description']);

   $update =mysql_query("UPDATE `contract_phases` SET `value`='$value', `description`= '$description' where contr_phases_id='$id' ");

   if($update)
   {

        echo "data modify success";
   }else{
      echo "sorry not not modify yet";
   }

   

}


 ?>