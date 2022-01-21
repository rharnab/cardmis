<?php
 include("../../database.php");
?>
<?php 
//update contracts

if(isset($_POST['value']))
{
    $id = trim($_POST['hidden_id']);
    $value = strtoupper(trim($_POST['value']));
    $description = trim($_POST['description']);

    $fetch_data = mysql_query("SELECT * from contract_types where  contr_type_id = '$id' ");
    $fetch_result = mysql_fetch_array($fetch_data);

    $old_data = mysql_query("SELECT * from contract_types where `value`='$value' ");
    $old_result = mysql_fetch_array($old_data);

    if($old_result !='')
    {

      if($old_result['contr_type_id'] === $fetch_result['contr_type_id'])
      {
          $update =mysql_query("UPDATE `contract_types` SET `value`='$value', `description`= '$description' where contr_type_id='$id' ");

           if($update)
           {

                echo "data modify success";
           }else{
              echo "sorry not not modify yet";
           }
      }else{
        echo "sorry this is duplicate value";
      }     
    }else{
          $update =mysql_query("UPDATE `contract_types` SET `value`='$value', `description`= '$description' where contr_type_id='$id' ");

           if($update)
           {

                echo "data modify success";
           }else{
              echo "sorry not not modify yet";
           }
    }

}


 ?>