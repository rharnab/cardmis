<?php include('../database.php') ?>

<?php 
$accnumber = $_POST['accnumber'];

$sql=mysql_query("SELECT * from sbac_all_card_list where ac_no= '$accnumber' order by sl desc ");

if(mysql_num_rows($sql) > 0)
{
	$table = '<tr>';
			$table.= '<td colspan="2"<span class="text-info">Existing Card Number List</span></td>';
    $table .= '</tr>';

	$sl=1;
	while($result = mysql_fetch_array($sql))
	{

		//for on card name in  input field
		$on_card =$result['name_on_card'];
		$name_on_card = '<input type="hidden" name="" class="card_name" value="'.$on_card.'">';

		$table .= '<tr>';
			$table.= '<td>'.$sl++.'</td>';
			$table.= '<td>'.$result['card_no'].'</td>';
			$table.= '<td>'.$result['card_status'].$name_on_card.'</td>';
		$table .= '</tr>';

	}
}else{

	$table = '<tr>';
			$table.= '<td colspan="2"<span class="text-info">Card Not found</span>  <input type="hidden" name="test" id="noCardExist" value="0"/>    </td>';
	$table .= '</tr>';
}

echo $table;

 ?>