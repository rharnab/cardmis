<?php
	include_once("../db/dbconnect.php");
	include('../database.php');
	include('../re_issue_charge/common.php');
	date_default_timezone_set("Asia/Dhaka");

	function removeSpecialChar($str)
	{
		$str = str_replace(array('\'', '"', ',', ';', '<', '>', '/','-'), '', $str);
		return $str;
	}

	$type_query= mysql_query("SELECT actypecode, accounttype from  debit_card_api WHERE card_status !='dishonour' AND  card_status ='approve' and status = '2' and request_type='2' group by actypecode");
	while($type_result = mysql_fetch_assoc($type_query) ){

	$acc_type =$type_result['accounttype'];


	$sl_debit_card_api = $conn->prepare("SELECT * FROM debit_card_api WHERE card_status !='dishonour' AND  card_status ='approve' and status = '2' and request_type='2' and accounttype='$acc_type' group by accountno ");
	$sl_debit_card_api->execute();
	$rowCount = $sl_debit_card_api->rowCount();

	$today_date = date('Y-m-d h:i:s');
	$rand = mt_rand(1000,9999);
	$acc_type = removeSpecialChar($acc_type);
	$file = date("H-i-sA")."-".$rand."-"."reissue-".$acc_type;
	
	// Create DOM Object //
	$dom = new DOMDocument();
		$dom->encoding = 'utf-8';
		$dom->xmlVersion = '1.0';
		$dom->formatOutput = true;

	// structured foldering system //
	$xml_folder = "";
	$yearFolder = date('Y'); // Year
    if(is_dir("../xml_file/$yearFolder")){
    }else{
        mkdir("../xml_file/$yearFolder");    
    }
    $monthFolder = date("F"); // Month
    if(is_dir("../xml_file/$yearFolder/$monthFolder")){
    }else{
        mkdir("../xml_file/$yearFolder/$monthFolder");    
    }
    $dayFolder = date('d-M-Y')." - ".$acc_type; // Day
    if(is_dir("../xml_file/$yearFolder/$monthFolder/$dayFolder")){
    }else{
       $xml_folder = mkdir("../xml_file/$yearFolder/$monthFolder/$dayFolder"); 
    }

	$xml_file_name = "../xml_file/$yearFolder/$monthFolder/$dayFolder/$file.xml";

		$root = $dom->createElement('DebitCard');

		/*Data fetching & showing from debit_card_api table*/
		while($rowData = $sl_debit_card_api->fetch(PDO::FETCH_OBJ)){
			$card_node = $dom->createElement('customer');

			$attr_customer_id = new DOMAttr('customer_id', 'dynamic');

			$card_node->setAttributeNode($attr_customer_id);
			
			
			$child_node_nameoncard = $dom->createElement('NAMEONCARD', $rowData->accnameoncard);
			$card_node->appendChild($child_node_nameoncard);


			//for showing card request
            /*if(trim($rowData->reason) == 1)
            {
               $reason = 'Stolen'; 

            }else if(trim($rowData->reason) == 2){
                $reason = 'Lost'; 
            }else if(trim($rowData->reason) == 3){
                $reason = 'Damaged'; 
            }else if(trim($rowData->reason) == 4){
                $reason = 'Surname Change'; 
            }else if(trim($rowData->reason) == 5){
                $reason = 'Expired'; 
            }else{
                $reason = '';
            }*/

			$child_node_reason = $dom->createElement('REASON', $rowData->reason);
			$card_node->appendChild($child_node_reason);

			$child_node_pan = $dom->createElement('PAN', $rowData->card_number);
			$card_node->appendChild($child_node_pan);

			

			$child_node_mbr = $dom->createElement('MBR', 0);
			$card_node->appendChild($child_node_mbr);
			

			$root->appendChild($card_node);
		}

		$dom->appendChild($root);
	
	if($rowCount>0){
		$dom->save($xml_file_name);
		echo "<p class='alert alert-success'>".$acc_type."  XML File has been successfully created</p>";
	}else{
		echo "<p class='alert alert-danger'>You have no records!</p>";
	}

	// Batch select for doesn't create duplicate batch //
	$batch_select = $conn->prepare("SELECT * FROM debit_card_api_bk WHERE batch_cr_date=?");
	$batch_select->bindParam(1,$today_date);
	$batch_select->execute();
	$batchData = $batch_select->fetch(PDO::FETCH_ASSOC);	

	// Creating batch number //
	$batch_num    = mt_rand(111111,999999);
	$final_batch  = '';
	if($batchData['batch'] == ''){
        $final_batch = $batch_num;
    }else{
        $final_batch = $batchData['batch'];
    }

    $acc_type =$type_result['accounttype'];

	// Backup debit_card_api data //
	$select = mysql_query("SELECT accountno, id, accountname, card_number, request_type, reason FROM debit_card_api WHERE request_type='2' and card_status !='dishonour' AND card_status ='approve' and status = '2' and accounttype='$acc_type'  ");

	$charge_amt =re_issue_charge_fee();
	$card_fee = $charge_amt['charge_fee'];
	$vat = $charge_amt['vat'];
	$total_card_fee = $card_fee + $vat;
	
	while($row = mysql_fetch_assoc($select)){

		$id = $row['id'];
		$chrg_account = $row['accountno'];
		$chrg_acc_name = mysql_real_escape_string($row['accountname']);
		$chrg_card_no = $row['card_number'];
		$chrg_request_type = $row['request_type'];
		$chrg_reason = $row['reason'];
		

		 $create_charge = mysql_query("INSERT INTO re_issue_charge_deduction (card_holder_name, account_no_file, card_no_file,  card_fee, vat, total_card_fee,  due_fee_amt, payable_net_amount, payable_vat_amount, debit_amount, reason, request_type, narrition, posting_dt, entry_dt, status) values('$chrg_acc_name', '$chrg_account', '$chrg_card_no', '$card_fee', '$vat', '$total_card_fee', '$total_card_fee', '$total_card_fee', '$vat', '$card_fee', '$chrg_reason', '$chrg_request_type', 'Debit card Re-issue fee', '$today_date', '$today_date', '0') ");
			// delete debit_card_api data //
		 if($create_charge)
		 {
		 	$delete_api_data = mysql_query("UPDATE  debit_card_api set status='3'  WHERE request_type='2' and accounttype='$acc_type' and id= '$id' ");
		 }
			
			
		
		
	}

	if(file_exists($xml_file_name))
	{
		?>

		<a  href="<?php echo $xml_file_name ?>" download="" title="">Download</a>

		<?php

	}
}

?>