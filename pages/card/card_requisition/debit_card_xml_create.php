<?php
	include_once("../db/dbconnect.php");
	include('../database.php');

	//special charectier remove 
	function removeSpecialChar($str)
	{
		$str = str_replace(array('\'', '"', ',', ';', '<', '>', '/','-'), '', $str);
		return $str;
	}

	$type_query= mysql_query("SELECT actypecode, accounttype from  debit_card_api WHERE card_status !='dishonour' AND  card_status ='approve' and status = '2' and request_type='1' group by actypecode");
	while($type_result = mysql_fetch_assoc($type_query) ){

	$acc_type =$type_result['accounttype'];

	$sl_debit_card_api = $conn->prepare("SELECT dcp.*, issbr.br_title FROM debit_card_api dcp 
	left join branches issbr on issbr.id = dcp.issue_branch 
	WHERE dcp.card_status !='dishonour' AND  dcp.card_status ='approve' and dcp.status = '2' and dcp.request_type='1'  and dcp.accounttype='$acc_type' group by dcp.accountno ");
	$sl_debit_card_api->execute();
	$rowCount = $sl_debit_card_api->rowCount();

	date_default_timezone_set("Asia/Dhaka");
	$today_date = date('Y-m-d');
	$rand = mt_rand(1000,9999);
	$acc_type = removeSpecialChar($acc_type);
	
	$file = date("H-i-sA")."-".$rand."-"."requisition-".$acc_type;
	
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

		    $child_node_fio = $dom->createElement('FIO', str_replace('&', '&amp;', $rowData->accountname));

			$card_node->appendChild($child_node_fio);
			
			$child_node_sex = $dom->createElement('SEX', $rowData->accsex);

			$card_node->appendChild($child_node_sex);

			if($rowData->accsex == 'M' || $rowData->accsex == 'm'){
				$child_node_title = $dom->createElement('TITLE', 1);
			}else{
				$child_node_title = $dom->createElement('TITLE', 2);
			}

		/*$child_node_title = $dom->createElement('TITLE', 'MR');*/

			$card_node->appendChild($child_node_title);

			/*$child_node_latfio = $dom->createElement('LATFIO', $rowData->accountname);
			$card_node->appendChild($child_node_latfio);*/

			$child_node_nameoncard = $dom->createElement('NAMEONCARD', $rowData->accnameoncard);
			$card_node->appendChild($child_node_nameoncard);
			$child_node_acc = $dom->createElement('ACCOUNT', $rowData->accountno);
			$card_node->appendChild($child_node_acc);
			$child_node_acctype = $dom->createElement('ACCOUNTTP', $rowData->actypecode);
			$card_node->appendChild($child_node_acctype);
			$child_node_accstatus = $dom->createElement('ACCTSTAT', $rowData->accstatus);
			$card_node->appendChild($child_node_accstatus);
			$child_node_address = $dom->createElement('ADDRESS', str_replace('&', '&amp;', $rowData->accaddress));
			$card_node->appendChild($child_node_address);

			$issue_br =trim($rowData->br_title);
			$issue_br = str_replace('Branch', 'BR', $issue_br);
			$issue_br = str_replace('BRANCH', 'BR', $issue_br);
			$issue_br = str_replace('branch', 'BR', $issue_br);

			$corespon_address = "(".$issue_br.") ".$rowData->accaddress;

			$child_node_cores_address = $dom->createElement('CORADDRESS', str_replace('&', '&amp;', $corespon_address));
			$card_node->appendChild($child_node_cores_address);

			/*$cellphone=  "0".$rowData->accphone;
			$cellphone_number = '880('.substr($cellphone, 0, 6).")".substr($cellphone, 6, 5);*/
			$cellphone=  $rowData->accphone;
			$cellphone_number = '880('.substr($cellphone, 0, 5).")".substr($cellphone, 5, 5);
			$child_node_cellphone = $dom->createElement('CELLPHONE', $cellphone_number);
			$card_node->appendChild($child_node_cellphone);

			 $birth_day = date('d-M-Y', strtotime($rowData->accdateofbirth));

			$child_node_birthday = $dom->createElement('BIRTHDAY', $birth_day);
			$card_node->appendChild($child_node_birthday);

			$child_node_br_part = $dom->createElement('BRPART', substr($rowData->accountno, 0, 4));
			$card_node->appendChild($child_node_br_part);

			$child_node_clprop = $dom->createElement('CLIENTPROP');
			$child_node_propid = $dom->createElement('Prop');
			$attr_Prop_id = new DOMAttr('ID', 'MARKETBY');
			$attr_Prop_valstr = new DOMAttr('VALSTR', $rowData->markated_by);
			$child_node_propid->setAttributeNode($attr_Prop_id);
			$child_node_propid->setAttributeNode($attr_Prop_valstr);
			$child_node_clprop->appendChild($child_node_propid);
			
			$child_node_propid = $dom->createElement('Prop');
			$attr_Prop_id = new DOMAttr('ID', 'MOTHERNAME');
			$attr_Prop_valstr = new DOMAttr('VALSTR', $rowData->accmother);
			$child_node_propid->setAttributeNode($attr_Prop_id);
			$child_node_propid->setAttributeNode($attr_Prop_valstr);
			$child_node_clprop->appendChild($child_node_propid);
			
			$child_node_propid = $dom->createElement('Prop');
			$attr_Prop_id = new DOMAttr('ID', 'FATHERNAME');
			$attr_Prop_valstr = new DOMAttr('VALSTR', $rowData->accfather);
			$child_node_propid->setAttributeNode($attr_Prop_id);
			$child_node_propid->setAttributeNode($attr_Prop_valstr);
			$child_node_clprop->appendChild($child_node_propid);
			
			$card_node->appendChild($child_node_clprop);





		
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
	$batch_select = $conn->prepare("SELECT * FROM debit_card_api_bk WHERE  batch_cr_date=?");
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
	$select = mysql_query("SELECT * FROM debit_card_api WHERE request_type='1' and card_status !='dishonour' AND card_status ='approve' and status = '2' and accounttype='$acc_type'  ");
	
	while($row = mysql_fetch_assoc($select)){

		$id = $row['id'];
		
		// delete debit_card_api data //
		$delete_api_data = mysql_query("UPDATE  debit_card_api set status='3'  WHERE request_type='1' and accounttype='$acc_type' and id= '$id' ");
			
		
		
	}

	if(file_exists($xml_file_name))
	{
		?>

		<a href="<?php echo $xml_file_name ?>" download="" title="">Download</a>

		<?php

	}

}

?>