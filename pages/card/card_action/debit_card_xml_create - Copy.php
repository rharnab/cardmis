<?php
	include_once("../db/dbconnect.php");
	include('../database.php');
	//special charectier remove 
	function removeSpecialChar($str)
	{
		$str = str_replace(array('\'', '"', ',', ';', '<', '>', '/','-'), '', $str);
		return $str;
	}


	$type_query= mysql_query("SELECT actypecode, accounttype from  debit_card_api WHERE card_status !='dishonour' AND  card_status ='approve' and status = '2'  and (request_type='3' or request_type='4') group by actypecode");
	while($type_result = mysql_fetch_assoc($type_query) ){

	$acc_type =$type_result['accounttype'];



	$sl_debit_card_api = $conn->prepare("SELECT * FROM debit_card_api WHERE card_status !='dishonour' AND  card_status ='approve' and status = '2' and (request_type='3' or request_type='4') and accounttype='$acc_type' group by accountno ");
	$sl_debit_card_api->execute();
	$rowCount = $sl_debit_card_api->rowCount();

	date_default_timezone_set("Asia/Dhaka");
	$today_date = date('Y-m-d');
	$rand = mt_rand(1000,9999);
	$acc_type = removeSpecialChar($acc_type);
	$file = date("H-i-sA")."-".$rand."-"."activision-".$acc_type;
	
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

			if(trim($rowData->request_type) == 3)
			{
				$SIGNSTAT = 4;
				$CRDSTAT = 1;
			}else if(trim($rowData->request_type) == 4){
				$SIGNSTAT = 18;
				$CRDSTAT = 1;
			}else{

				$SIGNSTAT = '';
				$CRDSTAT = '';
			}



			$card_node = $dom->createElement('customer');
			$attr_customer_id = new DOMAttr('customer_id', 'dynamic');

			$card_node->setAttributeNode($attr_customer_id);
		    $child_node_pan = $dom->createElement('PAN', $rowData->card_number);
			$card_node->appendChild($child_node_pan);

			$child_node_mbr = $dom->createElement('MBR', 0);
			$card_node->appendChild($child_node_mbr);

			$child_node_signstat = $dom->createElement('SIGNSTAT', $SIGNSTAT);
			$card_node->appendChild($child_node_signstat);

			$child_node_crdstat = $dom->createElement('CRDSTAT', $CRDSTAT);
			$card_node->appendChild($child_node_crdstat);


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

	// Backup debit_card_api data //
	$select = $conn->prepare("SELECT * FROM debit_card_api WHERE (request_type='3' or request_type='4') and accounttype='$acc_type' and card_status !='dishonour' AND card_status ='approve' and status = '2'   ");
	$select->execute();
	while($row = $select->fetch(PDO::FETCH_OBJ)){

		$insert_backup = $conn->prepare("INSERT INTO debit_card_api_bk SET accountno=?,customerid=?,accounttype=?,accountname=?,accstatus=?,accopendate=?,accfather=?,nationalid=?,accphone=?,accaddress=?,accdateofbirth=?,accsex=?,bal_tk=?,approveDate=?,approve_by_id=?,status=?,batch=?,batch_cr_date=?,approve_batch=?");
		$insert_backup->bindParam(1,$row->accountno);
		$insert_backup->bindParam(2,$row->customerid);
		$insert_backup->bindParam(3,$row->accounttype);
		$insert_backup->bindParam(4,$row->accountname);
		$insert_backup->bindParam(5,$row->accstatus);
		$insert_backup->bindParam(6,$row->accopendate);
		$insert_backup->bindParam(7,$row->accfather);
		$insert_backup->bindParam(8,$row->nationalid);
		$insert_backup->bindParam(9,$row->accphone);
		$insert_backup->bindParam(10,$row->accaddress);
		$insert_backup->bindParam(11,$row->accdateofbirth);
		$insert_backup->bindParam(12,$row->accsex);
		$insert_backup->bindParam(13,$row->bal_tk);
		$insert_backup->bindParam(14,$row->approve_date);
		$insert_backup->bindParam(15,$row->approve_by_id);
		$insert_backup->bindParam(16,$row->card_status);
		$insert_backup->bindParam(17,$final_batch);
		$insert_backup->bindParam(18,$today_date);
		$insert_backup->bindParam(19,$row->batch_num);
		
		if($insert_backup->execute()){
			// delete debit_card_api data //
			$delete_api_data = $conn->prepare("UPDATE  debit_card_api set status='3'  WHERE (request_type='3' or request_type='4') and accounttype='$acc_type' and id=?");
			$delete_api_data->bindParam(1,$row->id);
			if($delete_api_data->execute()){
			 //echo "Update!";
			}
		}else{
			//echo "Failed!";
		}
		
	}

	if(file_exists($xml_file_name))
	{
		?>

		<a href="<?php echo $xml_file_name ?>" download="" title="">Download</a>

		<?php

	}


}

?>