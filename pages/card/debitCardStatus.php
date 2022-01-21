<?php require_once('../../login-authentication.php');?>
<?php 
    include('db/dbconnect.php');
    //session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | MIS Debit card XML</title>
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
                    <h1>Create XML file for generate new  debit card</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Requisition</a></li>
                        <li class="active">Debit Card Status</li>
                    </ol>
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
                                                <th>Account No</th>
                                                <th>Customer ID</th>
                                                <th>Acc Name</th>
                                                <th>Phone</th>
                                                <th>Acc Type</th>
                                                <th>Status</th>
                                                <th>Open Date</th>
                                                <th>Fatehr's Name</th>
                                                <th>Balance</th>
                                                <th>Approved By</th>
                                                <th>Approved Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $debit_card_api = $conn->prepare("SELECT * FROM debit_card_api WHERE card_status !='dishonour' AND card_status !='' and status = '2' ");
                                            $debit_card_api->execute();
                                            while($rowData = $debit_card_api->fetch(PDO::FETCH_ASSOC)){
                                                $appr_id = $conn->prepare("SELECT user_fname,user_lname FROM users WHERE user_id=?");
                                                $appr_id->bindParam(1,$rowData['approve_by_id']);
                                                $appr_id->execute();
                                                $appRowData = $appr_id->fetch(PDO::FETCH_ASSOC);

                                        ?>  
                                            <tr>
                                                <td><?php echo $rowData['accountno'];?></td>
                                                <td><?php echo $rowData['customerid'];?></td>
                                                <td><?php echo $rowData['accountname'];?></td>
                                                <td>
                                                    <?php
                                                        echo '0'.$rowData['accphone']."<br>";
                                                        echo $rowData['accotherphone']<=0?"":$rowData['accotherphone'];
                                                     ?>    
                                                </td>
                                                <td><?php echo $rowData['accounttype']?></td>
                                                <td><?php echo $rowData['accstatus'];?></td>
                                                <td>
                                                    <?php
                                                    $date = $rowData['accopendate'];
                                                    echo date('d-m-Y',strtotime($date));
                                                    ?>        
                                                </td>
                                                <td><?php echo $rowData['accfather'];?></td>
                                                
                                                <td><?php echo $rowData['bal_tk'];?></td>
                                                <td><?php echo $appRowData['user_fname'].' '.$appRowData['user_lname'];?></td>
                                                <td>
                                                    <?php
                                                     $date = $rowData['approve_date'];
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
                  <section style="margin:15px; float:left;">
                    <div id="xmlMsg"></div>
                    <!-- <button id="xmlBtn" class="btn btn-primary">Create XML</button> -->
                     <a  class="btn btn-primary" href="allaction/debit_card_xml_create.php" title="">Create XML</a>
                </section>
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

                // create xml file //
                $(document).on('click','#xmlBtn',function(){
                    $.ajax({
                        url:'allaction/debit_card_xml_create.php',
                        success:function(res){
                            document.getElementById('xmlMsg').innerHTML = res;
                            $("#xmlMsg").fadeIn('fast').fadeOut(10000);
                            var url = window.location;
                            url.reload();
                        }
                    });
                });
            });
        </script>
    </body>
</html>