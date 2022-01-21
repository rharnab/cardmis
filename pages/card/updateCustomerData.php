  <?php
    include("database.php");
  $col=$_GET['col'];
  $val=$_GET['val'];
  $clCode=$_GET['clCode'];
  
  $q=mysql_query("update customer set $col='$val' where IdClient='$clCode'");
  
  $q1=mysql_query("select * from customer where IdClient='$clCode'");
  $r1=mysql_fetch_array($q1);
  
  if($r1[$col]==$val)
   	echo "Customar data updated@1";
  else
  	echo "Error!@0";
  
  ?>
