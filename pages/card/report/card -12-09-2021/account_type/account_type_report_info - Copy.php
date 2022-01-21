<?php include("../../../database.php");?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | Account type Report</title>
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
        <link rel="stylesheet" type="text/css" href="../../../../../css/jquery-ui.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="skin-blue">
       <?php
            include("../../../database.php");
        ?>
        <!-- header logo: style can be found in header.less -->
        <?php //include("../../../../header.php");?>        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
             <?php //include("../../../../menu.php");?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side" style="margin-left: 0px !important;">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <!-- <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">CIB</a></li>
                        <li class="active">Error Report</li>
                    </ol> -->
                </section>


                <style>
                	.st-total{
                		font-weight: bold;
                        font-size: 18px;
                        text-transform: capitalize;
                	}
                </style>

                <!-- style -->

                <!-- Main content -->
                <section class="content">
                  <!-- <img src="../../img/loader.gif" class="page_loader" alt="Page loader"> -->
                    <div class="row">
                       <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">

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

                          
                                <div class="table-responsive" style="overflow-x: auto">
                                   

                                    <!-- for single account type data show -->
                                    <?php  
                                     if(!empty($account_type_sql))
                                     {

                                     	?>

                                     
                                  <table class="table table-bordered userlistTable" style="font-size: 12px">
                                        <thead style="background-color: #009688; color: white; text-transform: uppercase;">
                                          <tr>
                                          		<th>SL</th>
                                                <th>Account Type</th>
                                                <th>Account NO</th>
                                                <th>Account Name</th>
                                                <th>Approve</th>
                                                <th>Dishonor</th>
                                                
                                                
                                            </tr>
                                            <tr></tr>

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
                                                    where dcp.requestDate between '$frm_dt' and '$to_dt' and  dcp.accountno <> '' $branch_sql $account_type_sql ");
                                        		$sl=1;
                                           
                                        		$total_approve = 0;
                                        		$total_dishonor = 0;


                         
				                                while($rowData = mysql_fetch_array($debit_card_api)){

				                                  
				                                 	?>


				                                 	<tr>
				                                 		<td><?php echo $sl++; ?></td>
		                                                <td class="aaa"><?php echo $rowData['accounttype'];?></td>
		                                                <td class="aaa"><?php echo $rowData['accountno'];?></td>

		                                                <td><?php echo $rowData['accountname'];?></td>
                                          
                                                        <td>
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

                                                         <td>
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
                                        		 	<td style="text-align: right;" class="st-total" colspan="4" style="font-weight: bold;"><span>total</span></td>
                                        		 	<td class="st-total"><span style="color: #009688; font-weight: bold;">Approve  </span>  <strong> = <?php echo $total_approve; ?></strong></td>
                                        		 	<td class="st-total" > <span style="color: red; font-weight: bold;">Dishonour </span>   <strong> = <?php echo $total_dishonor; ?></strong></td>
                                        		 </tr>
                                        	   
                                        </tbody>
                                    </table>
                                     <!-- end  for single account type data show -->
                                    	<?php

                                      }else{
                                      	//for all type account 
                                      	$acc_type_query = mysql_query("SELECT accounttype FROM debit_card_api where accounttype <> '' group by accounttype ");
                                      	while($acc_type_result = mysql_fetch_assoc($acc_type_query))
                                      	{
                                      		$acc_type = $acc_type_result['accounttype'];
                                      		?>

                                      		<table class="table table-bordered userlistTable" style="font-size: 12px">
                                        <thead style="background-color: #009688; color: white; text-transform: uppercase;">
                                          <tr>
                                          		<th>SL</th>
                                                <th>Account Type</th>
                                                <th>Account NO</th>
                                                <th>Account Name</th>
                                                <th>Approve</th>
                                                <th>Dishonor</th>
                                                
                                                
                                            </tr>
                                           <!--  <tr></tr> -->

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
                                                    where dcp.requestDate between '$frm_dt' and '$to_dt' and  dcp.accountno <> '' and dcp.accounttype= '$acc_type'  $branch_sql  ");
                                        		$sl=1;
                                           
                                        		$total_approve = 0;
                                        		$total_dishonor = 0;


                         
				                                while($rowData = mysql_fetch_array($debit_card_api)){

				                                  
				                                 	?>


				                                 	<tr>
				                                 		<td><?php echo $sl++; ?></td>
		                                                <td class="aaa"><?php echo $rowData['accounttype'];?></td>
		                                                <td class="aaa"><?php echo $rowData['accountno'];?></td>

		                                                <td><?php echo $rowData['accountname'];?></td>
                                          
                                                        <td>
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

                                                         <td>
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

                                        		<!--  <tr>
                                        		 	<td style="text-align: right;" class="st-total" colspan="4" style="font-weight: bold;"><span>total</span></td>
                                        		 	<td class="st-total"><span style="color: #009688; font-weight: bold;">Approve  </span>  <strong> = <?php echo $total_approve; ?></strong></td>
                                        		 	<td class="st-total" > <span style="color: red; font-weight: bold;">Dishonour </span>   <strong> = <?php echo $total_dishonor; ?></strong></td>
                                        		 </tr> -->
                                        	   
                                        </tbody>
                                    </table>


                                      		<?php
                                      	}

                                      	?>


                                      	<?php
                                      }

                                     ?> 

                                   
                                   
                                 </div> <!-- table-responsive -->
                                    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>


                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->





      <!-- jQuery 2.0.2 -->
        <script src="../../../../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../../../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
         <!-- DATA TABES SCRIPT -->
        <script src="../../../../../js/plugins/datatables-button/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../../../../../js/plugins/datatables-button/pdfmake-0.1.36/pdfmake.min.js" type="text/javascript"></script>
        <script src="../../../../../js/plugins/datatables-button/pdfmake-0.1.36/vfs_fonts.js" type="text/javascript"></script>
        <script src="../../../../../js/plugins/datatables-button/JSZip-2.5.0/jszip.min.js" type="text/javascript"></script>
        <script src="../../../../../js/plugins/datatables-button/datatables.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../../../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../../../../js/sweetalert.min.js"></script>
        <script src="../../../../../js/jquery-ui.js"></script>
        <!-- <script type="text/javascript">$('.userlistTable').DataTable();</script> -->
        <script src="../../../../js/sweetalert.min.js"></script>


        <script>
      $(document).ready(function() {



        $('.userlistTable').DataTable({

            dom: 'Blfrtip',
            buttons: [
                  'excel',

                  {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL' 
                 }
            ],
            lengthMenu: [ [50, 100, 150, -1], [50, 100, 150, "All"] ],

       });

   
}); // end document ready


</script>

    </body>

    </html>


