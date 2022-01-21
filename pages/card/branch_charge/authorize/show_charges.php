<?php 
    include('../../db/dbconnect.php');
    //session_start();

    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | Card Charge </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="../../../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Coustom StyleSheet -->
        <link rel="stylesheet" href="../../../../css/style.css">
        <!-- date picker -->
        <link rel="stylesheet" type="text/css" href="../../../../css/jquery-ui.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <?php
            include("../../database.php");
        ?>
        <!-- header logo: style can be found in header.less -->
        <?php include("../../../../header.php");?>        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
             <?php include("../../../../menu.php");?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Authorize Card Charge</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Card Charge</a></li>
                        <li><a href="#">Branch Debit Charge</a></li>
                        <li class="active">Authorize Charge</li>
                    </ol>
                </section>


                

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="box">
                               <div class="box-header">
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                  <!-- from -->
                               <form action="confirm_authorize.php" method="post" accept-charset="utf-8">
                 
                              
                                   <div class="tile-body">
				                     <table class="table  table-bordered">
				                    <thead style="background-color: #5D9ED1; color: black">
				                      <tr>
				                        <th><a style="color: black" href='<?php echo "tempCostReportInfoXlsx.php?" . $_SERVER['QUERY_STRING']; ?>' target="_blank">All Authorize</a></th>
				                        <th>SL</th>
				                        <th>Account Number</th>
				                        <th>Card Number</th>
				                        <th>Amount</th>
				                        <th>Branch</th>
				                        <th>Upload Date</th>
				                      </tr>
				                    </thead>
				                    <tbody>
				                      <?php
                                      $branch_id =  $_GET['branch_id'];
                                      $frm = date('Y-m-d', strtotime($_GET['frm_dt']));
                                      $to = date('Y-m-d', strtotime($_GET['to_dt']));
                                      if($branch_id !='')
                                      {
                                        $branch_sql = " and branch_id='$branch_id' ";
                                      }else{

                                        $branch_sql = '';
                                      }

				                         $q =mysql_query("SELECT bdc.*, b.br_title from branch_debit_charge bdc
                                                        left join branches b on bdc.branch_id = b.id
                                                        where account_no <> '' and card_no <> '' and status='0'  and upload_dt between '$frm' and '$to' $branch_sql ");
                                 
                                 echo "SELECT bdc.*, b.br_title from branch_debit_charge bdc
                                                        left join branches b on bdc.branch_id = b.id
                                                        where account_no <> '' and card_no <> '' and status='0'  and upload_dt between '$frm' and '$to' $branch_sql ";
				                         $sl=1;
				                         while( $result = mysql_fetch_array($q))
				                         {
				                          ?>

				                             <tr>
				                             <td><input  type="checkbox" class="blankCheck" name="auth_id[]" value="<?php echo $result['sl'] ?>"></td>
				                
                                              <td><?php echo $sl++; ?></td>
				                              <td><?php echo $result['account_no'] ?></td>
				                              <td><?php echo $result['card_no'] ?></td>
				                              <td><?php echo $result['charge_amount'] ?></td>
				                              <td><?php echo $result['br_title'] ?></td>
				                              <td><?php echo $result['upload_dt'] ?></td>
				                            
		
				                            </tr>

				                          <?php
				                         }


				                       ?>

                                       <input type="hidden" name="branch_id" value="<?php echo $branch_id; ?>">
                                       <input type="hidden" name="frm" value="<?php echo $frm; ?>">
                                       <input type="hidden" name="to" value="<?php echo $to; ?>">


				                     
				                    </tbody>
				                  </table>
                                  </div>
                                  <br>
                                  <div class="tile-footer">
                                    <div class="row">
                                      <div class="col-md-8">
                                        <button class="btn btn-primary" name="submit" type="submit" id="submitbtn"><i class="fa fa-fw fa-lg fa-check-circle"></i>Select Item Authorize</button>
                                         <button class="btn btn-primary" name="submit" type="submit" id="submitbtn"><i class="fa fa-fw fa-lg fa-check-circle"></i>Select Item Decline</button>

                                         <a class="btn btn-primary" style="color: white" href='<?php echo "tempCostReportInfoXlsx.php?" . $_SERVER['QUERY_STRING']; ?>' target="_blank">All Authorize</a>
                                      </div>
                                    </div>
                                  </div>
                                   </form>
                                  <!-- from -->
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        


        

        <!-- jQuery 2.0.2 -->
        <script src="../../../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="../../../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../../../js/sweetalert.min.js"></script>
        <script src="../../../../js/jquery-ui.js"></script>
        <!-- datatable --> 
       <!--  <script type="text/javascript">$('.userlistTable').DataTable();</script> -->

      
    </body>
</html>