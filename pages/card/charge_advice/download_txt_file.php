<?php 
include('../db/dbconnect.php');
include("../database.php");

$file_name= 'chargeTxt.txt';

//$title = "Accountno | Amount_tk  | DR_CR  | Trn_br_Code | Acbranch_code | Remarks ";

$t_ac = "Accountno".str_repeat(" ", 19);//30
$t_amount  = "| Amount_tk".str_repeat(" ", 9);//20
$t_trna  = "| DR_CR".str_repeat(" ", 3);//10
$t_trn_br_code  = "| Trn_br_Code".str_repeat(" ", 2);//15
$t_ac_br_code  = "| Acbranch_code".str_repeat(" ", 2);//15
$t_remarks  = "| Remarks".str_repeat(" ", 91);//15

$title = $t_ac.$t_amount.$t_trna.$t_trn_br_code.$t_ac_br_code.$t_remarks;


$sql = mysql_query("SELECT branch_ac_no, holder_name, net_due_amount, rate, card_no from debit_advice_charge order by id asc");
if(mysql_num_rows($sql) > 0)
{
	file_put_contents($file_name, $title.PHP_EOL, FILE_APPEND);
	while($data = mysql_fetch_array($sql))
	{
		$account_no = $data['branch_ac_no'].str_repeat(" ", 30- strlen($data['branch_ac_no']));
		$amount_tk = $data['net_due_amount'] * $data['rate'];
		$amount_tk = $amount_tk.str_repeat(" ", 20- strlen($amount_tk));
		$transaction = "DR".str_repeat(" ", 7- 2 );
		$trn_br_Code = "0014".str_repeat(" ", 15 - 4 );

		$space = str_repeat(" ", 2);
		$ac_br_code= substr($data['branch_ac_no'], 0, 4).str_repeat(" ", 15- 4 );
		$remarks = $data['net_due_amount']."@".$data['rate']." ".$data['card_no'].$space."|"." ".$data['holder_name'];

		$remarks = $remarks.str_repeat(" ", 100 - strlen($remarks));


		$content = $account_no.",".$amount_tk.",".$transaction.",".$trn_br_Code.",".$ac_br_code.",".$remarks;
		file_put_contents($file_name, $content.PHP_EOL, FILE_APPEND);

		

	}



	//download
	header('Content-Type: application/zip');
	header("Content-Disposition: attachment; filename= $file_name ");
	header('Content-Length: ' . filesize($file_name));
	readfile($file_name);

    $delete = unlink($file_name);
    if($delete)
    {
    	 mysql_query("TRUNCATE table debit_advice_charge");
    }

   

}else{
	echo "<script> alert('Sorry data not imported yet'); window.location='/cardMis/pages/card/charge_advice/import_charge_advice.php' </script>";
}





 ?>