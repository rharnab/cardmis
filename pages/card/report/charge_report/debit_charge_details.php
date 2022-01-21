<?php require_once('../../../../login-authentication.php');?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | Charge Report</title>
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
            
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <!-- Right side column. Contains the navbar and content of the page -->
                <!-- Content Header (Page header) -->

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">
                                   
                                    <!-- <a class="btn btn-primary" href="/cardMis/pages/card/report/charge_report/chargeInfoXl.php">Export Excel</a>  -->
                                    <a class="btn btn-primary" href="<?php echo 'charge_detailsXl.php?'.$_SERVER['QUERY_STRING']; ?>">Export Excel</a> 

                                    <!-- <button class="btn btn-primary" type="button" onclick="exportExcel()">Export Excel</button> -->

                                     <table id="excelTable"   class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Name</th>
                                                <th>Card Number</th>
                                                <th>Account Number</th>
                                                <th>Balance</th>
                                                <th>Paid Aount</th>
                                                <th>Total Due</th>
                                                <th>Charge_date</th>
                                                <th>Status</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $charge_id = $_GET['charge_id'];
                                        $total_paid = 0;
                                        $total_due = 0;
                                        $query  = mysql_query("select  cha.card_holder_name, cha.card_no_file, cha.account_no_file, log.balance_amt, log.paid_amt, log.due_amt, log.charge_date, cha.status
                                                        from debit_charge_deduction cha
                                                        inner join  card_charge_histry_log log on log.debit_sl = cha.sl 
                                                        where (cha.status='1' or cha.status='2') and log.debit_sl='$charge_id'  ");
                                        $sl=1;
                                        while( $data = mysql_fetch_array($query))
                                        {
                                            $total_paid = $total_paid + $data['paid_amt'];
                                            // $total_due =  $data['due_amt'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $sl++; ?></td>
                                                    <td><?php echo $data['card_holder_name'] ?></td>
                                                    <td><?php echo $data['card_no_file'] ?></td>
                                                    <td><?php echo $data['account_no_file'] ?></td>
                                                    <td><?php echo $data['balance_amt'] ?></td>
                                                    <td><?php echo $data['paid_amt'] ?></td>
                                                    <td><?php echo $data['due_amt'] ?></td>
                                                    <td><?php echo $data['charge_date'] ?></td>
                                                    <td>
                                                        <?php 
                                                        if($data['status'] == 1)
                                                        {
                                                            echo "<span style='color: Green'>PAID</span>";
                                                        }else{
                                                              echo "<span style='color: RED'>DUE</span>";
                                                        }

                                                         ?>
                                                            
                                                    </td>
                                                   
                                                </tr>
                                            <?php
                                        }

                                        ?> 

                                                    <tr>
                                                        <td style="text-align: center" colspan="5"> <span style="font-weight: bold">Total</span> </td>
                                                        <td > <span style="font-weight: bold">  <?php echo number_format($total_paid, 2); ?> </span>  </td>
                                                       <!-- <td> <span style="font-weight: bold">  <?php echo number_format($total_due, 2); ?> </span>  </td> -->
                                                    </tr>                                             
                                        </tbody>
                                    </table>

                                    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="../../../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../../../js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- export excel -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="../../../../js/jquery.table2excel.js"></script>




        

    </body>
</html>






