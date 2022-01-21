<?php 

ini_set('max_execution_time', '0'); // for infinite time of execution 
include("../database.php");


require_once "../../../Spreadsheet/Excel/Writer.php";
require_once "../phpExcelLib/Classes/PHPExcel/IOFactory.php";
require_once "../plugins/dompdf/vendor/autoload.php";
/*check for invalid acccount*/
$found_query =mysql_query("SELECT account_no_file from card_charge_temp limit 1 ");
$result =mysql_fetch_assoc($found_query);

if(!empty($result))
{

	    /* end check for invalid acccount*/
		/*for excel file heading style sheet*/
		/*initial phpspreadsheet*/
		$phpExcel = new PHPExcel();
		$phpExcel->setActiveSheetIndex(0);
		$phpExcel->getActiveSheet()->setTitle("Sheet1");
		$currentDate = date('dmY');
		$currentTime = date('hisa');
		/*initial phpspreadsheet*/

		$filename    = "invalid_account_list_".$currentDate.$currentTime.'_' .".xlsx"; //file session_name

		$current_date  = date('F d,Y');
		$currentDate = date('dmY');
		$currentTime = date('hisa');

		//style set
		 $style = array(
		    'alignment' => array(
		        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
		    )
		);

		$style_r = array(
		    'alignment' => array(
		        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
		    )
		);

		 $style_r = array(
		    'alignment' => array(
		        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        )
		  );
		//end style set


		 //heading set
		 $phpExcel->getActiveSheet()->mergeCells('D1:E1');
		  $phpExcel->getActiveSheet()->SetCellValue('D1', 'INVALID ACCOUNT NUMBER');
		  $phpExcel->getActiveSheet()->getStyle("D1")->applyFromArray($style_r);

		   $phpExcel->getActiveSheet()->GetStyle("A1:G1")->getFont()->setBold(true);

		  $phpExcel->getActiveSheet()->mergeCells('D2:E2');
		  $phpExcel->getActiveSheet()->SetCellValue('D2', "Date: {$current_date}");
		  $phpExcel->getActiveSheet()->getStyle("D2")->applyFromArray($style_r);

		    
		  $phpExcel->getActiveSheet()->SetCellValue("A3",'Sl No.');
		  $phpExcel->getActiveSheet()->SetCellValue("B3",'Name');
		  $phpExcel->getActiveSheet()->SetCellValue("C3",'Card Number');
		  $phpExcel->getActiveSheet()->SetCellValue("D3",'Account Number');
		  $phpExcel->getActiveSheet()->SetCellValue("E3",'Debit Amount');
		  $phpExcel->getActiveSheet()->SetCellValue("F3",'vat');
		  $phpExcel->getActiveSheet()->SetCellValue("G3",'Net Charge');
		  $phpExcel->getActiveSheet()->SetCellValue("H3",'Upload Date');
		  
		  
		  

		  $phpExcel->getActiveSheet()->GetColumnDimension("A")->SetAutoSize(true);
		  $phpExcel->getActiveSheet()->GetColumnDimension("B")->SetAutoSize(true);
		  $phpExcel->getActiveSheet()->GetColumnDimension("C")->SetAutoSize(true);
		  $phpExcel->getActiveSheet()->GetColumnDimension("D")->SetAutoSize(true);
		  $phpExcel->getActiveSheet()->GetColumnDimension("E")->SetAutoSize(true);
		  $phpExcel->getActiveSheet()->GetColumnDimension("F")->SetAutoSize(true);
		  $phpExcel->getActiveSheet()->GetColumnDimension("G")->SetAutoSize(true);
		  $phpExcel->getActiveSheet()->GetColumnDimension("H")->SetAutoSize(true);
		 
		  $phpExcel->getActiveSheet()->GetStyle("A3:I3")->getFont()->setBold(true);
		  
		  $phpExcel->getActiveSheet()->GetStyle("A3:I3")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
		  $phpExcel->getActiveSheet()->getDefaultStyle()->applyFromArray($style);
		 //end heading set


		/*end for excel file heading style sheet*/

		$temp_query =mysql_query("SELECT * from card_charge_temp");
		$sl = 1;
		$i=4;
		$db_amt = 0;
		$net_amt = 0;
		$t_vat = 0;
		while($data = mysql_fetch_assoc($temp_query))
		{

			$db_amt += $data['debit_amount'];
		    $net_amt += $data['payable_net_amount'];
		    $t_vat += $data['payable_vat_amount'];

		    //echo $data['upload_dt']."<br>";

			$phpExcel->getActiveSheet()->SetCellValueExplicit("A".$i, $sl++ ,PHPExcel_Cell_DataType::TYPE_STRING);
			$phpExcel->getActiveSheet()->SetCellValueExplicit("B".$i, $data['card_holder_name'],PHPExcel_Cell_DataType::TYPE_STRING);
			$phpExcel->getActiveSheet()->SetCellValueExplicit("C".$i, $data['card_no_file'],PHPExcel_Cell_DataType::TYPE_STRING);
			$phpExcel->getActiveSheet()->SetCellValueExplicit("D".$i, $data['account_no_file'],PHPExcel_Cell_DataType::TYPE_STRING);
			$phpExcel->getActiveSheet()->SetCellValueExplicit("E".$i,  $data['debit_amount'] ,PHPExcel_Cell_DataType::TYPE_STRING);
			$phpExcel->getActiveSheet()->SetCellValueExplicit("F".$i,  $data['payable_vat_amount'],PHPExcel_Cell_DataType::TYPE_STRING);
			$phpExcel->getActiveSheet()->SetCellValueExplicit("G".$i,  $data['payable_net_amount'],PHPExcel_Cell_DataType::TYPE_STRING);
			$phpExcel->getActiveSheet()->SetCellValueExplicit("H".$i,  $data['upload_dt'],PHPExcel_Cell_DataType::TYPE_STRING);


			$i++;

		}





		/*excel footer*/
		$t_row = $i;
		$phpExcel->getActiveSheet()->SetCellValueExplicit("D".$t_row, "Total Amount : ",PHPExcel_Cell_DataType::TYPE_STRING);
		$phpExcel->getActiveSheet()->SetCellValueExplicit("E".$t_row, $db_amt,PHPExcel_Cell_DataType::TYPE_STRING);
		$phpExcel->getActiveSheet()->SetCellValueExplicit("F".$t_row, $t_vat,PHPExcel_Cell_DataType::TYPE_STRING);
		$phpExcel->getActiveSheet()->SetCellValueExplicit("G".$t_row, $net_amt,PHPExcel_Cell_DataType::TYPE_STRING);


		/*download script*/
		  $phpExcel->setActiveSheetIndex(0);
		        
		  // Redirect output to a client's web browser (Xlsx)
		  $objWriter = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
		  ob_end_clean();
		  // We'll be outputting an excel file
		  header('Content-type: application/vnd.ms-excel');
		  //header('Content-Disposition: attachment; filename="payroll.xlsx"');
		  header('Content-Disposition: attachment;filename="' . $filename . '"');
		  $objWriter->save('php://output');

		  mysql_query('TRUNCATE table card_charge_temp');
		  exit;
		/*end download script*/


	}else{

		header('Location: chargeFileUpload.php');
	}




 ?>