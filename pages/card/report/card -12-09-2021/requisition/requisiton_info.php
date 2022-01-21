<?php include("../../../database.php");?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | Card Report</title>
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

                                $sts = $_GET['sts'];

                                if($sts !='')
                                {
                                	$condition = "and dcp.card_status= '$sts'  ";
                                }else{
                                	$condition='';
                                }


                                $branch = $_GET['branch'];

                                if($branch !='')
                                {
                                    $branch_sql = "and dcp.branch_id= '$branch'  ";
                                }else{
                                    $branch_sql='';
                                }


                                $rqst_type = $_GET['rqst_type'];

                                if($rqst_type !='')
                                {
                                    $request_type_sql = "and dcp.request_type= '$rqst_type'  ";
                                }else{
                                    $request_type_sql='';
                                }

                            
                                 
                                ?>

                          
                                <div class="table-responsive" style="overflow-x: auto">
                                    <!-- <a target="_blank" class="btn btn-primary" style="float: right;" href="<?php echo 'requisition_pdf.php?'.$_SERVER['QUERY_STRING'] ?>" title="">PDF</a> -->
                                  <table class="table table-bordered userlistTable" style="font-size: 12px">
                                        <thead style="background-color: #009688; color: white; text-transform: uppercase;">
                                          <tr>
                                                <th>SL</th>
                                                <th>Account No</th>
                                                <th>Acc Name</th>
                                                <th>Card Number</th>
                                                <th>Name on card</th>
                                                <th>Phone</th>
                                                <th>Acc Type</th>
                                                <!-- <th>Status</th>
                                                <th>Birth Date</th>
                                                <th>Balance</th> -->
                                                <th>Request type</th>
                                                <th>Reason</th>
                                                <th>Issue Brnch</th>
                                                <th>Request Branch</th>
                                                <th>Receiving Branch</th>
                                                <th>Request By</th>
                                                <th>Authorized By</th>
                                                <th>Branch Authorized By</th>
                                                <th>Narration</th>
                                                <th>Request Date</th>
                                                <th>Status</th>
                                                
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
                                                    where dcp.requestDate between '$frm_dt' and '$to_dt' and  dcp.accountno <> ''  $condition  $branch_sql $request_type_sql group by dcp.accountno ");

                                                    $sl=1;



                         
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


				                                 	<tr>
                                                        <td><?php echo $sl++; ?></td>
		                                                <td class="aaa"><?php echo $rowData['accountno'];?></td>

		                                                <td><?php echo $rowData['accountname'];?></td>
                                                        <td class="aaa"><?php echo $rowData['card_number'];?></td>
                                                         <td class="aaa"><?php echo $rowData['accnameoncard'];?></td>
		                                                <td>
		                                                    <?php echo '0'.$rowData['accphone'];?>
		                                                    <br>
		                                                    <?php 
		                                                        echo $rowData['accotherphone']<=0? "": $rowData['accotherphone'];
		                                                    ?>    
		                                                </td>
		                                                <td><?php echo $rowData['accounttype']?></td>
		                                                <!-- <td><?php echo $rowData['accstatus'];?></td>
		                                                <td>
		                                                    <?php
		                                                     $date = $rowData['accdateofbirth'];
		                                                     echo date('d-m-Y',strtotime($date));
		                                                     ?>
		                                                </td>
		                                                <td><?php echo $rowData['bal_tk'];?></td> -->

                                               <td> <span style="font-weight: bold; color:blue; text-transform: uppercase;"><?php echo $request_type ?> </span></td>

                                                <td><span style="font-weight: bold; color:blue; text-transform: uppercase;"><?php echo $reason ?> </td>

                                                     <td><?php echo $rowData['issue_branch'] ?></td>
                                                     <td><?php echo $rowData['request_branch'] ?></td>
                                                    <td><?php echo $rowData['receiving_branch'] ?></td>

		                                                <td><?php echo $rowData['user_fname'].' '.$rowData['user_lname'];?></td>
                                                        <td><?php echo $rowData['app_fname'].' '.$rowData['app_lname'];?></td>
                                                        <td><?php echo $rowData['brapp_fname'].' '.$rowData['brapp_lname'];?></td>
                                                        <td><?php echo $rowData['narration'] ?></td>
		                                                <td>
		                                                    <?php
		                                                    echo  $date = $rowData['requestDate'];
		                                                    
		                                                     ?>    
		                                                </td>
                                                        <td>
                                                            <?php
                                                                if(trim($rowData['card_status']) == 'approve' )
                                                                {
                                                                    ?>

                                                                 <span style="color: #009688; font-weight: bold;">APPROVE</span>

                                                                    <?php
                                                                }elseif(trim($rowData['card_status']) == 'dishonour')
                                                                {
                                                                    ?>
                                                                     <span style="color: red; font-weight: bold;">DISHONOR</span>
                                                                    <?php
                                                                }elseif(trim($rowData['status']) == '5')
                                                                {
                                                                    ?>
                                                                     <span style="color: red; font-weight: bold;">DISHONOR</span>
                                                                    <?php
                                                                }else{

                                                                    ?>
                                                                    <span style="color: deeppink; font-weight: bold;">PENDINFG</span>

                                                                    <?php

                                                                }

                                                             ?>
                                                        </td>
		                                               
		                                            </tr>


				                                 	<?php
				                                 }

                                        		 ?>
                                        	   
                                        </tbody>
                                    </table> 
                                   
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


