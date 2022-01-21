<?php include("../../../database.php");?>
<?php include('../../../database.php') ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | Account type Report </title>
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
                font-size: 18px;
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
                            <?php  
                             if(!empty($account_type_sql))
                             {

                             	?>
                          
                            <table class="table  userlistTable" style="font-size: 11px">
                                        <thead style="background-color: #009688; color: white; text-transform: uppercase;">
                                            
                                          <tr class="t-border">
                                                <th class="t-border">SL</th>
                                                <th class="t-border">Account Type</th>
                                                <th class="t-border">Account NO</th>
                                                <th class="t-border">Account Name</th>
                                                <th class="t-border">Phone</th>
                                                <th class="t-border">Request type</th>
                                                <th class="t-border">Reason</th>
                                                <th class="t-border">Issue Brnch</th>
                                                <th class="t-border">Request Branch</th>
                                                <th class="t-border">Receiving Branch</th>
                                                <th class="t-border">Approve</th>
                                                <th class="t-border">Dishonor</th>
                                                
                                            </tr>

                                        </thead>
                                        <tbody>


                                               	<?php 

                                        		$debit_card_api = mysql_query("SELECT dcp.*, en.user_fname, en.user_lname, br.br_title as request_branch, rcvbr.br_title as receiving_branch, issue.br_title as issue_branch,
                                                    app.user_fname as app_fname, app.user_lname as app_lname, brapp.user_fname as brapp_fname, brapp.user_lname as brapp_lname
                                                    from debit_card_api dcp
                                                    left join users en on en.user_id = dcp.entry_by_id
                                                    left join branches br on br.id = dcp.branch_id
                                                    left join branches rcvbr on rcvbr.id = dcp.receive_branch
                                                    left join branches issue on issue.id = dcp.issue_branch
                                                    left join users app on app.user_id = dcp.approve_by_id
                                                    left join users brapp on brapp.user_id = dcp.br_approve_id
                                                    where dcp.approve_date between '$frm_dt' and '$to_dt' and  dcp.accountno <> '' $branch_sql $account_type_sql group by dcp.accountno ");

                                                   
                                        		$sl=1;
                                           
                                        		$total_approve = 0;
                                        		$total_dishonor = 0;


                         
				                                while($rowData = mysql_fetch_array($debit_card_api)){

                                           //for showing card request
                                            if(trim($rowData['request_type']) == 2)
                                            {
                                               $request_type = 'Re-issue'; 

                                            }else if(trim($rowData['request_type']) == 3){
                                                $request_type = 'Card Active'; 
                                            }else if(trim($rowData['request_type']) == 4){
                                                $request_type = 'Card Block'; 
                                            }else if(trim($rowData['request_type']) == 5){
                                                $request_type = 'PIN Re-issue'; 
                                            }else if(trim($rowData['request_type']) == 1){
                                                $request_type = 'New Card'; 
                                            }else{
                                                $request_type = '';
                                            }


                                            // resone condition

                                            //for showing card request
                                            if(trim($rowData['reason']) == 1)
                                            {
                                               $reason = 'Stolen'; 

                                            }else if(trim($rowData['reason']) == 2){
                                                $reason = 'Lost'; 
                                            }else if(trim($rowData['reason']) == 3){
                                                $reason = 'Damaged'; 
                                            }else if(trim($rowData['reason']) == 4){
                                                $reason = 'Surname Change'; 
                                            }else if(trim($rowData['reason']) == 5){
                                                $reason = 'Expired'; 
                                            }else{
                                                $reason = '';
                                            }

				                                  
				                                 	?>


				                                 	<tr class="t-border">
				                                 		<td class="t-border"><?php echo $sl++; ?></td>
		                                                <td class="t-border"><?php echo $rowData['accounttype'];?></td>
		                                                <td class="t-border"><?php echo $rowData['accountno'];?></td>

		                                                <td class="t-border"><?php echo $rowData['accountname'];?></td>
                                                    <td class="t-border">
                                                        <?php echo '0'.$rowData['accphone'];?>
                                                        <br>
                                                        <?php 
                                                            echo $rowData['accotherphone']<=0? "": $rowData['accotherphone'];
                                                        ?>    
                                                    </td>

                                                <td class="t-border"> <span style="font-weight: bold; color:blue; text-transform: uppercase;"><?php echo $request_type ?> </span></td>

                                                <td class="t-border"><span style="font-weight: bold; color:blue; text-transform: uppercase;"><?php echo $reason ?> </td>

                                                     <td class="t-border"><?php echo $rowData['issue_branch'] ?></td>
                                                     <td class="t-border"><?php echo $rowData['request_branch'] ?></td>
                                                    <td class="t-border"><?php echo $rowData['receiving_branch'] ?></td>
                                          
                                                        <td class="t-border">
                                                            <?php
                                                                if(trim($rowData['card_status']) == 'approve' )
                                                                {
                                                                	$total_approve++;
                                                                    ?>

                                                                 <span style="color: #009688; font-weight: bold;">APPROVE</span>

                                                                    <?php
                                                                }

                                                             ?>
                                                        </td>

                                                         <td class="t-border">
                                                            <?php
                                                                if(trim($rowData['card_status']) == 'dishonour')
                                                                {
                                                                	$total_dishonor++;
                                                                    ?>
                                                                     <span style="color: red; font-weight: bold;">DISHONOUR</span>
                                                                    <?php
                                                                }
                                                              ?>
                                                        </td>
		                                               
		                                            </tr>


				                                 	<?php
				                                 }

                                        		 ?>

                                        		 <tr class="t-border">
                                        		 	<td style="text-align: right;" class="st-total t-border" colspan="10" style="font-weight: bold;"><span>total</span></td>
                                        		 	<td class="st-total t-border"><span style="color: #009688; font-weight: bold;">Approve  </span>  <strong> = <?php echo $total_approve; ?></strong></td>
                                        		 	<td class="st-total t-border" > <span style="color: red; font-weight: bold;">Dishonour </span>   <strong> = <?php echo $total_dishonor; ?></strong></td>
                                        		 </tr>
                                               
                                        </tbody>
                                    </table>
                                    <?php
                                	}else{
                                      	//for all type account 
                                      	$acc_type_query = mysql_query("SELECT accounttype FROM debit_card_api where accounttype <> '' group by accounttype ");
                                      	while($acc_type_result = mysql_fetch_assoc($acc_type_query))
                                      	{
                                      		$acc_type = $acc_type_result['accounttype'];
                                      		?>

                                      		<table class="table  userlistTable" style="font-size: 11px">
                                        <thead style="background-color: #009688; color: white; text-transform: uppercase;">
                                            
                                          <tr class="t-border">
                                                <th class="t-border">SL</th>
                                                <th class="t-border">Account Type</th>
                                                <th class="t-border">Account NO</th>
                                                <th class="t-border">Account Name</th>
                                                <th class="t-border">Phone</th>
                                                <th class="t-border">Request type</th>
                                                <th class="t-border">Reason</th>
                                                <th class="t-border">Issue Brnch</th>
                                                <th class="t-border">Request Branch</th>
                                                <th class="t-border">Receiving Branch</th>
                                                <th class="t-border">Approve</th>
                                                <th class="t-border">Dishonor</th>
                                                
                                            </tr>

                                        </thead>
                                        <tbody>


                                               	<?php 

                                        		$debit_card_api = mysql_query("SELECT dcp.*, en.user_fname, en.user_lname, br.br_title as request_branch, rcvbr.br_title as receiving_branch, issue.br_title as issue_branch,
                                                    app.user_fname as app_fname, app.user_lname as app_lname, brapp.user_fname as brapp_fname, brapp.user_lname as brapp_lname
                                                    from debit_card_api dcp
                                                    left join users en on en.user_id = dcp.entry_by_id
                                                    left join branches br on br.id = dcp.branch_id
                                                    left join branches rcvbr on rcvbr.id = dcp.receive_branch
                                                    left join branches issue on issue.id = dcp.issue_branch
                                                    left join users app on app.user_id = dcp.approve_by_id
                                                    left join users brapp on brapp.user_id = dcp.br_approve_id
                                                    where dcp.approve_date between '$frm_dt' and '$to_dt' and  dcp.accountno <> '' and dcp.accounttype= '$acc_type'  $branch_sql  ");

                                                  
                                        		$sl=1;
                                           
                                        		$total_approve = 0;
                                        		$total_dishonor = 0;


                         
				                                while($rowData = mysql_fetch_array($debit_card_api)){

                                                   //for showing card request
                                                    if(trim($rowData['request_type']) == 2)
                                                    {
                                                       $request_type = 'Re-issue'; 

                                                    }else if(trim($rowData['request_type']) == 3){
                                                        $request_type = 'Card Active'; 
                                                    }else if(trim($rowData['request_type']) == 4){
                                                        $request_type = 'Card Block'; 
                                                    }else if(trim($rowData['request_type']) == 5){
                                                        $request_type = 'PIN Re-issue'; 
                                                    }else if(trim($rowData['request_type']) == 1){
                                                        $request_type = 'New Card'; 
                                                    }else{
                                                        $request_type = '';
                                                    }


                                                    // resone condition

                                                    //for showing card request
                                                    if(trim($rowData['reason']) == 1)
                                                    {
                                                       $reason = 'Stolen'; 

                                                    }else if(trim($rowData['reason']) == 2){
                                                        $reason = 'Lost'; 
                                                    }else if(trim($rowData['reason']) == 3){
                                                        $reason = 'Damaged'; 
                                                    }else if(trim($rowData['reason']) == 4){
                                                        $reason = 'Surname Change'; 
                                                    }else if(trim($rowData['reason']) == 5){
                                                        $reason = 'Expired'; 
                                                    }else{
                                                        $reason = '';
                                                    }

				                                  
				                                 	?>


				                                 	<tr class="t-border">
				                                 		<td class="t-border"><?php echo $sl++; ?></td>
		                                                <td class="t-border"><?php echo $rowData['accounttype'];?></td>
		                                                <td class="t-border"><?php echo $rowData['accountno'];?></td>

		                                                <td class="t-border"><?php echo $rowData['accountname'];?></td>
                                                    <td class="t-border">
                                                        <?php echo '0'.$rowData['accphone'];?>
                                                        <br>
                                                        <?php 
                                                            echo $rowData['accotherphone']<=0? "": $rowData['accotherphone'];
                                                        ?>    
                                                    </td>

                                                <td class="t-border"> <span style="font-weight: bold; color:blue; text-transform: uppercase;"><?php echo $request_type ?> </span></td>

                                                <td class="t-border"><span style="font-weight: bold; color:blue; text-transform: uppercase;"><?php echo $reason ?> </td>

                                                     <td class="t-border"><?php echo $rowData['issue_branch'] ?></td>
                                                     <td class="t-border"><?php echo $rowData['request_branch'] ?></td>
                                                    <td class="t-border"><?php echo $rowData['receiving_branch'] ?></td>
                                          
                                                        <td class="t-border">
                                                            <?php
                                                                if(trim($rowData['card_status']) == 'approve' )
                                                                {
                                                                	$total_approve++;
                                                                    ?>

                                                                 <span style="color: #009688; font-weight: bold;">APPROVE</span>

                                                                    <?php
                                                                }

                                                             ?>
                                                        </td>

                                                         <td class="t-border">
                                                            <?php
                                                                if(trim($rowData['card_status']) == 'dishonour')
                                                                {
                                                                	$total_dishonor++;
                                                                    ?>
                                                                     <span style="color: red; font-weight: bold;">DISHONOUR</span>
                                                                    <?php
                                                                }
                                                              ?>
                                                        </td>
		                                               
		                                            </tr>


				                                 	<?php
				                                 }

                                        		 ?>

                                        		 <tr>
                                        		 	<td style="text-align: right;" class="st-total t-border" colspan="10" style="font-weight: bold;"><span>total</span></td>
                                        		 	<td class="st-total t-border"><span style="color: #009688; font-weight: bold;">Approve  </span>  <strong> = <?php echo $total_approve; ?></strong></td>
                                        		 	<td class="st-total t-border" > <span style="color: red; font-weight: bold;">Dishonour </span>   <strong> = <?php echo $total_dishonor; ?></strong></td>
                                        		 </tr>
                                               
                                        </tbody>
                                    </table>


											<?php
                                      	}

                                      	?>


                                      	<?php
                                      }

                                     ?> 
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


