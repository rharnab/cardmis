<?php
	include_once('../phpExcelLib/Classes/PHPExcel/IOFactory.php');
	include_once('../db/dbconnect.php');

	$phpExcel = new PHPExcel();
	$phpExcel->setActiveSheetIndex(0);

	$date = date('d-M-Y');
	$fileName = $date."-debit_card_requisition.xlsx";

	$style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );


	$phpExcel->getActiveSheet()->SetCellValue("A1",'Customer ID');
	$phpExcel->getActiveSheet()->SetCellValue("B1",'Client Name');
	$phpExcel->getActiveSheet()->SetCellValue("C1",'Account Number');
	$phpExcel->getActiveSheet()->SetCellValue("D1",'Name On Card');
	$phpExcel->getActiveSheet()->SetCellValue("E1",'Client Phone');
	$phpExcel->getActiveSheet()->SetCellValue("F1",'Client Email');
	$phpExcel->getActiveSheet()->SetCellValue("G1",'Request Date');

	$phpExcel->getActiveSheet()->GetColumnDimension("A")->SetAutoSize(true);
	$phpExcel->getActiveSheet()->GetColumnDimension("B")->SetAutoSize(true);
	$phpExcel->getActiveSheet()->GetColumnDimension("C")->SetAutoSize(true);
	$phpExcel->getActiveSheet()->GetColumnDimension("D")->SetAutoSize(true);
	$phpExcel->getActiveSheet()->GetColumnDimension("E")->SetAutoSize(true);
	$phpExcel->getActiveSheet()->GetColumnDimension("F")->SetAutoSize(true);
	$phpExcel->getActiveSheet()->GetColumnDimension("G")->SetAutoSize(true);
	$phpExcel->getActiveSheet()->GetStyle("A1:G1")->getFont()->setBold(true);
	$phpExcel->getActiveSheet()->getDefaultStyle()->applyFromArray($style);


	$i = 2;
	$text_file_report = $conn->prepare("SELECT * FROM `debit_card_api`");
	$text_file_report->execute();

	while($rowData = $text_file_report->fetch(PDO::FETCH_ASSOC)){
		$phpExcel->getActiveSheet()->SetCellValue("A".$i, $rowData['customerid']);
		$phpExcel->getActiveSheet()->SetCellValue("B".$i, $rowData['accountname']);
		$phpExcel->getActiveSheet()->SetCellValue("C".$i, $rowData['accountno']);
		$phpExcel->getActiveSheet()->SetCellValue("D".$i, $rowData['accnameoncard']);
		$phpExcel->getActiveSheet()->SetCellValue("E".$i, $rowData['accphone'].','.$rowData['accotherphone']);
		$phpExcel->getActiveSheet()->SetCellValue("F".$i, $rowData['accotheremail']);
		$phpExcel->getActiveSheet()->SetCellValue("G".$i, $rowData['requestDate']);
		$i++;
	}

	// Header Declaration // 
	header('Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition:attachment,filename="'.$fileName.'"');
	header('Cache-Control:max-age=0');

	$objwriter = new PHPExcel_writer_Excel2007($phpExcel);
	$objwriter->save('php://output');
?>