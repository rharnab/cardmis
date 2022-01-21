<?php require_once('../../../../login-authentication.php');?>
<?php 
    include('../../db/dbconnect.php');
   //session_start();
?>
<?php
 include("../../database.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | CIB Download</title>
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

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        
        <!-- header logo: style can be found in header.less -->
        <?php include("../../../../header.php");?>        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
             <?php include("../../../../menu.php");?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>All CIB Download History</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Report</a></li>
                        <li><a href="#">CIB</a></li>
                        <li class="active">all Download History</li>
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
                                                <th>SL</th>
                                                <th>Download File</th>
                                                <th>Download By</th>
                                                <th>Reporting Date</th>
                                                <th>Download Date</th>
                                                <th>Download</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php 
                                                    $sql = mysql_query("SELECT cd.*, u.user_fname, u.user_lname from users u 
																		inner join cib_download_history cd on cd.download_by= u.user_id 
																		where download_file <> ''  order by cd.download_timestamp desc ");
                                                    $sl=1;
                                                    while($result = mysql_fetch_array($sql))
                                                    {
                                                    	 $file  =   $result['download_file'];
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $sl++; ?></td>
                                                                <td><?php $file_name = explode('/', $result['download_file']);
                                                                    echo $file_name[1];
                                                                 ?></td>
                                                                <td><?php echo  $result['user_fname']." ".$result['user_lname'] ?></td>
                                                                <td><?php echo date('Y-M', strtotime($result['reporting_date'])) ?></td>
                                                                <td><?php
                                                                 $download_date =   explode(' ', $result['download_timestamp']);
                                                                 echo $download_date[0];
                                                                  ?></td>
                                                                <td>  
                                                                     <a class="btn btn-primary" href="/cardMis/pages/card/cib/<?php echo $file; ?>" download>Download</a> 

                                                                  
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
       <script src="../../../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="../../../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../../../js/sweetalert.min.js"></script>

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