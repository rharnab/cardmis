<?php require_once('../../login-authentication.php');?>
<?php 
    include('db/dbconnect.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | Branch Debit Card Status</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Coustom StyleSheet -->
        <link rel="stylesheet" href="../../css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <?php
            include("database.php");
        ?>
        <!-- header logo: style can be found in header.less -->
        <?php include("../../header.php");?>        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
             <?php include("../../menu.php");?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Debit Card Status</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Requisition</a></li>
                        <li class="active">Debit Card Status</li>
                    </ol>
                </section>

                <section style="margin:10px 10px 10px 15px; float:left;">
                    <form action="allaction/br_debit_excel_create.php">
                        <div id="excelMsg"></div>
                        <button type="submit" id="excelBtn" class="btn btn-primary">Create EXCEL</button>
                    </form>
                </section>

                <section style="margin:10px 10px 10px 5px; float:left;">
                    <form action="allaction/br_debit_pdf_create.php">
                        <div id="excelMsg"></div>
                        <button type="submit" id="pdfBtn" class="btn btn-primary">Create PDF</button>
                    </form>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Customer ID</th>
                                                <th>Acc Name</th>
                                                <th>Account No</th>
                                                <th><span class="glyphicon glyphicon-pencil"></span>&nbsp; Name On Card</th>
                                                <th><span class="glyphicon glyphicon-pencil"></span>&nbsp; Phone</th>
                                                <th><span class="glyphicon glyphicon-pencil"></span>&nbsp; Email</th>
                                                <th>Address</th>
                                                <th>Request Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $debit_card_api = $conn->prepare("SELECT * FROM debit_card_api");
                                            $debit_card_api->execute();
                                            while($rowData = $debit_card_api->fetch(PDO::FETCH_ASSOC)){
                                        ?>  
                                            <tr>
                                                <td><?php echo $rowData['customerid'];?></td>
                                                <td><?php echo $rowData['accountname'];?></td>
                                                <td><?php echo $rowData['accountno'];?></td>
                                                <td contenteditable>
                                                    <?php echo $rowData['accnameoncard'];?>   
                                                </td>
                                                <td contenteditable>
                                                    <?php echo '0'.$rowData['accphone'];?>
                                                    <br>
                                                    <?php 
                                                        echo $rowData['accotherphone']<=0? "": $rowData['accotherphone'];
                                                    ?>    
                                                </td>
                                                <td contenteditable><?php echo $rowData['accotheremail'];?></td>
                                                <td><?php echo $rowData['accaddress'];?></td>
                                                <td>
                                                    <?php
                                                     $date = $rowData['requestDate'];
                                                     echo date('d-m-Y',strtotime($date));
                                                     ?>    
                                                </td>
                                            </tr>
                                        <?php
                                            }
                                        ?>  
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
                
            });
        </script>
    </body>
</html>