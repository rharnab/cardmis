<?php 
    
    include("../../database.php");

    require_once "../../../../Spreadsheet/Excel/Writer.php";
    require_once "../../phpExcelLib/Classes/PHPExcel/IOFactory.php";
    require_once "../../plugins/dompdf/vendor/autoload.php";


    if(isset($_GET['charge_id']) ){
       
    
       $charge_id = $_GET['charge_id'];

        $phpExcel = new PHPExcel();
        $phpExcel->setActiveSheetIndex(0);
        $phpExcel->getActiveSheet()->setTitle("Sheet1");
        $currentDate = date('dmY');
        $currentTime = date('hisa');


        $filename    = "Charge_details_REPORT".$currentDate.$currentTime.'_' .".xlsx";

        $current_date  = date('F d,Y');

        $currentDate = date('dmY');
        $currentTime = date('hisa');

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



      
        

        $phpExcel->getActiveSheet()->mergeCells('D1:E1');
        $phpExcel->getActiveSheet()->SetCellValue('D1', 'DEBIT CHARGE DETAILS REPORT');
        $phpExcel->getActiveSheet()->getStyle("D1")->applyFromArray($style_r);

         $phpExcel->getActiveSheet()->GetStyle("A1:G1")->getFont()->setBold(true);

        $phpExcel->getActiveSheet()->mergeCells('D2:E2');
        $phpExcel->getActiveSheet()->SetCellValue('D2', "Date: {$current_date}");
        $phpExcel->getActiveSheet()->getStyle("D2")->applyFromArray($style_r);

          
        $phpExcel->getActiveSheet()->SetCellValue("A4",'Sl No.');
        $phpExcel->getActiveSheet()->SetCellValue("B4",'Name');
        $phpExcel->getActiveSheet()->SetCellValue("C4",'Card Number');
        $phpExcel->getActiveSheet()->SetCellValue("D4",'Account Number');
        $phpExcel->getActiveSheet()->SetCellValue("E4",'Balance');
        $phpExcel->getActiveSheet()->SetCellValue("F4",' Paid Aount');
        $phpExcel->getActiveSheet()->SetCellValue("G4",'Total Due ');
        $phpExcel->getActiveSheet()->SetCellValue("H4",'Charge Date');
        $phpExcel->getActiveSheet()->SetCellValue("I4",'Status');
        
        

        $phpExcel->getActiveSheet()->GetColumnDimension("A")->SetAutoSize(true);
        $phpExcel->getActiveSheet()->GetColumnDimension("B")->SetAutoSize(true);
        $phpExcel->getActiveSheet()->GetColumnDimension("C")->SetAutoSize(true);
        $phpExcel->getActiveSheet()->GetColumnDimension("D")->SetAutoSize(true);
        $phpExcel->getActiveSheet()->GetColumnDimension("E")->SetAutoSize(true);
        $phpExcel->getActiveSheet()->GetColumnDimension("F")->SetAutoSize(true);
        $phpExcel->getActiveSheet()->GetColumnDimension("G")->SetAutoSize(true);
        $phpExcel->getActiveSheet()->GetColumnDimension("H")->SetAutoSize(true);
        $phpExcel->getActiveSheet()->GetColumnDimension("I")->SetAutoSize(true);
      
        



       
        $phpExcel->getActiveSheet()->GetStyle("A4:I4")->getFont()->setBold(true);
        

 

        $phpExcel->getActiveSheet()->GetStyle("A4:I4")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $phpExcel->getActiveSheet()->getDefaultStyle()->applyFromArray($style);


$sl = 1;
$total_paid = 0;
$total_due = 0;
$query  = mysql_query("select  cha.card_holder_name, cha.card_no_file, cha.account_no_file, log.balance_amt, log.paid_amt, log.due_amt, 					log.charge_date, cha.status
                    from debit_charge_deduction cha
                    inner join  card_charge_histry_log log on log.debit_sl = cha.sl 
                    where (cha.status='1' or cha.status='2') and log.debit_sl='$charge_id'");
$i = 5;

while($data = mysql_fetch_array($query))
{

  $total_paid = $total_paid + $data['paid_amt'];
  $sts =  $data['status'];

  if($data['status'] == '1')
  {
     $sts ="PAID";
  }else{
    $sts = "DUE";
  }
  

  $phpExcel->getActiveSheet()->SetCellValueExplicit("A".$i, $sl++ ,PHPExcel_Cell_DataType::TYPE_STRING);
  $phpExcel->getActiveSheet()->SetCellValueExplicit("B".$i, $data['card_holder_name'],PHPExcel_Cell_DataType::TYPE_STRING);
  $phpExcel->getActiveSheet()->SetCellValueExplicit("C".$i, $data['card_no_file'],PHPExcel_Cell_DataType::TYPE_STRING);
  $phpExcel->getActiveSheet()->SetCellValueExplicit("D".$i,  $data['account_no_file'] ,PHPExcel_Cell_DataType::TYPE_STRING);
  $phpExcel->getActiveSheet()->SetCellValueExplicit("E".$i,  $data['balance_amt'] ,PHPExcel_Cell_DataType::TYPE_STRING);
  $phpExcel->getActiveSheet()->SetCellValueExplicit("F".$i,  $data['paid_amt'],PHPExcel_Cell_DataType::TYPE_STRING);
  $phpExcel->getActiveSheet()->SetCellValueExplicit("G".$i,  $data['due_amt'] ,PHPExcel_Cell_DataType::TYPE_STRING);
  $phpExcel->getActiveSheet()->SetCellValueExplicit("H".$i,  $data['charge_date'] ,PHPExcel_Cell_DataType::TYPE_STRING);
  $phpExcel->getActiveSheet()->SetCellValueExplicit("I".$i,  $sts ,PHPExcel_Cell_DataType::TYPE_STRING);
  $i++;
}

           

        $t_row = $i;
        $phpExcel->getActiveSheet()->SetCellValueExplicit("D".$t_row, "Total Amount : ",PHPExcel_Cell_DataType::TYPE_STRING);
        $phpExcel->getActiveSheet()->SetCellValueExplicit("E".$t_row, number_format($total_paid, 2),PHPExcel_Cell_DataType::TYPE_STRING);
        // $phpExcel->getActiveSheet()->SetCellValueExplicit("F".$t_row, number_format($total_due, 2),PHPExcel_Cell_DataType::TYPE_STRING);
           


        
            
            
           
       
        
       


        $phpExcel->setActiveSheetIndex(0);
        
        // Redirect output to a client's web browser (Xlsx)
        $objWriter = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
        ob_end_clean();
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');
        //header('Content-Disposition: attachment; filename="payroll.xlsx"');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        $objWriter->save('php://output');
        

        exit;



    }


?>
</body>
</html>
 
      

