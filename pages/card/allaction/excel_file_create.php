
<?php
	include_once('../phpExcelLib/Classes/PHPExcel/IOFactory.php');
	include_once('../db/dbconnect.php');


	$phpExcel = new PHPExcel();
	$phpExcel->setActiveSheetIndex(0);

	$date = date('d-M-Y');
	$fileName = $date."-mis_report.xls";

	$style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

	$phpExcel->getActiveSheet()->SetCellValue("A1",'Client Id');
	$phpExcel->getActiveSheet()->SetCellValue("B1",'Client Name');
	$phpExcel->getActiveSheet()->SetCellValue("C1",'Card Number');
	$phpExcel->getActiveSheet()->SetCellValue("D1",'Mobile');
	$phpExcel->getActiveSheet()->SetCellValue("E1",'Email');

	$phpExcel->getActiveSheet()->GetColumnDimension("A")->SetAutoSize(true);
	$phpExcel->getActiveSheet()->GetColumnDimension("B")->SetAutoSize(true);
	$phpExcel->getActiveSheet()->GetColumnDimension("C")->SetAutoSize(true);
	$phpExcel->getActiveSheet()->GetColumnDimension("D")->SetAutoSize(true);
	$phpExcel->getActiveSheet()->GetColumnDimension("E")->SetAutoSize(true);
	$phpExcel->getActiveSheet()->GetStyle("A1:E1")->getFont()->setBold(true);
	$phpExcel->getActiveSheet()->getDefaultStyle()->applyFromArray($style);


	$i = 2;
	$text_file_report = $conn->prepare(" SELECT cl_id,cl_name,card_number,mobile,email FROM `text_file_info` WHERE LENGTH(mobile) !=13 AND email ='' ");
	$text_file_report->execute();

	while($rowData = $text_file_report->fetch(PDO::FETCH_ASSOC)){
		$phpExcel->getActiveSheet()->SetCellValue("A".$i, $rowData['cl_id']);
		$phpExcel->getActiveSheet()->SetCellValue("B".$i, $rowData['cl_name']);
		$phpExcel->getActiveSheet()->SetCellValue("C".$i, $rowData['card_number']);
		$phpExcel->getActiveSheet()->SetCellValue("D".$i, $rowData['mobile']);
		$phpExcel->getActiveSheet()->SetCellValue("E".$i, $rowData['email']);
		$i++;
	}

	// Header Declaration // 
	header('Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition:attachment,filename="'.$fileName.'"');
	header('Cache-Control:max-age=0');
	
	$objwriter = new PHPExcel_writer_Excel2007($phpExcel);
	$objwriter->save('php://output');
?>