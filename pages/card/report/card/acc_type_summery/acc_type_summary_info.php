<?php include("../../../database.php");?>
<?php include('../../../database.php') ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | Account type Summery Report </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../../../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../../../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="../../../../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../../../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Coustom StyleSheet -->
        <link rel="stylesheet" href="../../../../../css/style.css">
        

        <style>
            
            .ref{
                
                font-size: 16px;
            }
            .branch{
                font-size: 16px;
                font-weight: bold;
            }
            .sub{
                 font-size: 16px;
                position: relative;
            }

           .underline {
                margin-top: 0px;
                margin-bottom: 20px;
                border: 0;
                border-top: 1.5px solid black;
                margin-left: 4%;
                margin-right: 70%;
                
            }
            .tract-title{
                text-align: center;
                font-size: 16px;
                font-weight: bold;
            }
           	.t-border{
                border:1px solid #000 !important;
            }
            .head-title{
            	font-weight: bold;
            	font-size: 21px;
            }
            .st-total{
        		font-weight: bold;
                font-size: 15px;
                text-transform: capitalize;
        	}

            
        </style>
    </head>



    <body class="skin-blue">

         					<?php
                              $frm = explode('/', $_GET['frm']);
                               $frm_dt = $frm[2]."-".$frm[1]."-".$frm[0];

                               $to = explode('/', $_GET['to']);
                               $to_dt = $to[2]."-".$to[1]."-".$to[0];

                                

                                $account_type = $_GET['account_type'];

                                if($account_type !='')
                                {
                                    $account_type_sql = "and dcp.accounttype= '$account_type'  ";
                                }else{
                                    $account_type_sql='';
                                }


                                $branch =  $_GET['branch'];

                                if($branch !='')
                                {
                                    $branch_sql = "and dcp.branch_id= '$branch'  ";
                                }else{
                                    $branch_sql='';
                                }

                                $count_branch =  $_GET['branch'];

                                if($count_branch !='')
                                {
                                    $count_branch_sql = "and branch_id= '$count_branch'  ";
                                }else{
                                    $count_branch_sql='';
                                }





                            
                                 
                        ?>
                        <button onclick="printDiv()" class="print_btn btn btn-primary" type="button">Print</button>
                        <div class="col-xs-12" id='DivIdToPrint'>
                           
                           <div class="row">

                           	<div class="col-xs-5">
                           		
                           	</div>

                           	<div class="col-xs-7">
                           		<span class="head-title">Daily Debit Card Possition </span>
      
                           </div>

                           </div>

                           <div class="row">

                           	<div class="col-xs-5">
                           		
                           	</div>

                           	<div class="col-xs-6">

                           		<?php 
                           		   $br_query = mysql_query("SELECT id, br_title from branches where  id = '$branch' ");
                           		   $br_result  =  mysql_fetch_assoc($br_query); 

                           		   if(!empty($br_result))
                           		   {
                           		   	 $br_name =  $br_result['br_title'];
                           		   }else{
                           		   	 $br_name =  "Head Office";
                           		   }
                           		?>

                           		<span style="margin-left: 20px;" class="head-title"> <?php echo $br_name; ?></span>
      
                           </div>

                           </div>

                            <div class="row">

                           	<div class="col-xs-5">
                           		
                           	</div>

                           	<div class="col-xs-7">
                           		<span class="head-title">Date : <?php echo date('d-m-Y') ?></span>
      
                           </div>

                           </div>
                           	
                           </div>

                            <!-- for single account type data show -->
                          
                            <table class="table  userlistTable" style="font-size: 12px; text-align: center;">
                                        <thead style="background-color: #009688; color: white; text-transform: uppercase;">
                                            
                                          <tr class="t-border">
                                                <th style="text-align: center;" class="t-border">SL</th>
                                                <th style="text-align: center;" class="t-border">Account Type</th>
                                                <th style="text-align: center;" class="t-border">Number of A/C</th>
                                                <th style="text-align: center;" class="t-border">Approve</th>
                                                <th style="text-align: center;" class="t-border">Dishonor</th>
                                                <th style="text-align: center;" class="t-border">Total</th>
                                                
                                            </tr>

                                        </thead>
                                        <tbody>


                                               	<?php 

                                        		$debit_card_api = mysql_query("SELECT accounttype, count(accounttype) as t_request from debit_card_api dcp
                                                    where dcp.approve_date between '$frm_dt' and '$to_dt' and  dcp.accountno <> '' $branch_sql $account_type_sql and dcp.status in (2,3,5) group by dcp.accounttype  ");


                                        		$sl=1;
                                           
                                        		$total_approve = 0;
                                        		$total_dishonor = 0;
                                            $grand_total = 0;


                         
				                                while($rowData = mysql_fetch_array($debit_card_api)){

                                          $acc_type = trim($rowData['accounttype']);

                                          $approve_query = mysql_query("SELECT  count(card_status) as approve_sts  from debit_card_api
                                          where approve_date between '$frm_dt' and '$to_dt' and accounttype='$acc_type'  and card_status='approve'
                                          $count_branch_sql group by card_status");
                                          $approve_result = mysql_fetch_assoc($approve_query);



                                           $dishonour_query = mysql_query("SELECT  count(card_status) as dishonour_sts  from debit_card_api
                                          where approve_date between '$frm_dt' and '$to_dt' and accounttype='$acc_type' and card_status='dishonour'
                                          $count_branch_sql group by card_status");
                                          $dishonour_result = mysql_fetch_assoc($dishonour_query);

                                          if(!empty($approve_result['approve_sts']))
                                          {
                                            $total_approve = $approve_result['approve_sts'] + $total_approve;
                                          }

                                          if(!empty($dishonour_result['dishonour_sts']))
                                          {
                                            $total_dishonor = $dishonour_result['dishonour_sts'] + $total_dishonor;
                                          }

                                          $grand_total = $total_approve + $total_dishonor;
				                                  
				                                 	?>


				                                 	<tr class="t-border">
				                                 		<td class="t-border"><?php echo $sl++; ?></td>
		                                                <td class="t-border"><?php echo $rowData['accounttype'];?></td>
		                                                <td class="t-border"><?php echo $rowData['t_request'];?></td>

		                                                
                                          
                                                        <td class="t-border">
                                                            

                                                                 <span style="color: #009688; font-weight: bold;"><?php echo $approve_result['approve_sts'] ?></span>

                                                                  
                                                        </td>

                                                         <td class="t-border">
                                                            
                                                                     <span style="color: red; font-weight: bold;"><?php echo $dishonour_result['dishonour_sts'] ?></span>
                                                                   
                                                        </td>
                                                        <td class="t-border"><?php echo $approve_result['approve_sts'] + $dishonour_result['dishonour_sts'] ?></td>
		                                               
		                                            </tr>


				                                 	<?php
				                                 }

                                        		 ?>

                                            <tr>
                                              <td colspan="3" style="text-align: right;" class="st-total t-border"  style="font-weight: bold;"><span>total</span></td>
                                              <td class="st-total t-border"> <strong> <?php echo $total_approve; ?></strong></td>
                                              <td class="st-total t-border" > <strong>  <?php echo $total_dishonor; ?></strong></td>
                                              <td class="st-total t-border" > <strong>  <?php echo $grand_total; ?></strong></td>
                                             </tr>

                                        		
                                               
                                        </tbody>
                                    </table>
                                    

                                    <br><br>


                            <div class="row">
                                <div class="col-xs-4">

                                    <span>--------------------</span>
                                    <br>
                                    <span class="branch">Maker</span>
                                    
                                </div>

                                <div class="col-xs-4">

                                    <div>
                                        
                                         <span>--------------------</span>
                                         <br>
                                        <span class="branch">Checker</span>

                                    </div>
                                   
                                        
                                   
                                    
                                </div>

                                <div class="col-xs-4">

                                    <div>
                                        
                                         <span>-------------------------------------------------</span>
                                         <br>
                                        <span class="branch">GB INC. / Oparation Mang. / Manager </span>

                                    </div>
                                   
                                        
                                   
                                    
                                </div>
                                 
                             </div> 


                            
                        </div>

                        



      <!-- jQuery 2.0.2 -->
        <script src="../../../../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../../../../js/bootstrap.min.js" type="text/javascript"></script>

        <script>
      $(document).ready(function() {

        //window.print();

         
   
}); // end document ready

function printDiv()
{
    $('.print_btn').hide();
     window.print();
}

</script>

    </body>

    </html>


