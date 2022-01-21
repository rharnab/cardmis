<?php require_once('../../login-authentication.php');?>
<?php 
    include('db/dbconnect.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | MIS Approved Card Status</title>
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
                    <h1>Approved Card Status</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Requisition</a></li>
                        <li class="active">Approved Card Status</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box" id="showData">
                                
                            </div><!-- /.box -->
                        </div>
                    </div>
                    <div id="test"></div>
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
            $(document).ready(function(){

                // status change action //
                
                $(document).on("change",".sts_change",function(){
                    var update_sts  = $(this).val(); // get update status //
                    // get current status //
                    var current_sts = $(this).closest('td').prev().prev().text(); 
                    var accno  = $(this).closest('td').prev().prev().prev().prev().prev().prev().text();
                    var accno_trim  = accno.trim();
                    var current_sts = current_sts.trim();
                    var result    = confirm("Are you sure change "+current_sts+" status ?");
                    

                    if(result){
                        $.ajax({
                            url:'allaction/update.php',
                            type:'post',
                            data:{update_sts:update_sts,accno:accno_trim,current_sts:current_sts},
                            /*beforeSend: function() {
                                $("#loading-image").css('display','block');
                            },*/
                            success:function(res){
                                /*$("#loading-image").css('display','none');
                                document.getElementById('success').innerHTMl = resp;
                                $("#success").fadeIn('fast').fadeOut('slow');
                                window.location.reload();*/
                                fetchData();
                                console.log(res);

                            }
                        });
                    }else{
                        console.log(result);
                    }
                    
               });


                // Fetch All Existing data //
                function fetchData(){
                    $.ajax({
                        url:'allaction/debit_card_sts_update.php',
                        type:'post',
                        success:function(resp){

                            $('#showData').html(resp);
                            $("#example1").dataTable();
                            $('#example2').dataTable({
                                "bPaginate": true,
                                "bLengthChange": false,
                                "bFilter": false,
                                "bSort": true,
                                "bInfo": true,
                                "bAutoWidth": false
                            });
                        }
                    });
                }
                fetchData();

            });
        </script>
    </body>
</html>