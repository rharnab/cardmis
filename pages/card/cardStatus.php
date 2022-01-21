<?php require_once('../../login-authentication.php');?>
<?php 
    include('db/dbconnect.php');
    $select_status = $conn->prepare("SELECT * FROM card_status");
    $select_status->execute();
    $status = '';
    while($rowData = $select_status->fetch(PDO::FETCH_OBJ)){
        $status.="
            <option value='$rowData->id'>$rowData->status_type</option>
        ";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | MIS Existing user list</title>
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
                    <h1>Card Status</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Requisition</a></li>
                        <li class="active">Card Status</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Account No</th>
                                                <th>Account Type</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            
                                            $debit_card = $conn->prepare("SELECT * FROM `debit_card_api`");
                                            $debit_card->execute();
                                            while($rowData = $debit_card->fetch(PDO::FETCH_ASSOC)){
                                        ?>  
                                            <tr>
                                                <td class="accountClass"><?php echo $rowData['accountno'];?></td>
                                                <td><?php echo $rowData['customerid'];?></td>
                                                <td><?php echo $rowData['actypecode']?></td>

                                                <td>
                                                    <select class="update_status">
                                                        <option value="">Update Card Status</option>
                                                        <option value="new">Approve</option>
                                                        <option value="decline">Decline</option>
                                                        
                                                    </select> 
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

                // updating card status using ajax //
                $(document).on("change",".update_status",function(){
                   var update_id =  $(this).val();
                  
                  var id = $('.accountClass').val();
                  console.log(id);

                    /*$.ajax({
                        url:'allaction/status-update-action.php',
                        type:'post',
                        data:{statusId:update_id},
                        success:function(resData){
                            console.log(resData);
                        }
                    });*/
                });
            });
        </script>

    </body>
</html>