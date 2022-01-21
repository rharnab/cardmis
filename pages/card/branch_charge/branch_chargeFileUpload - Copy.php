<?php 
    include('../db/dbconnect.php');
    //session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | Card Charge </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="../../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Coustom StyleSheet -->
        <link rel="stylesheet" href="../../../css/style.css">
        <!-- date picker -->
        <link rel="stylesheet" type="text/css" href="../../../css/jquery-ui.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <?php
            include("../database.php");
        ?>
        <!-- header logo: style can be found in header.less -->
        <?php include("../../../header.php");?>        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
             <?php include("../../../menu.php");?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Debit Card Charge</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Card Charge</a></li>
                        <li class="active">Charge File Upload</li>
                    </ol>
                </section>


                

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="box">
                               <div class="box-header">
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                  <!-- from -->
                                   <div class="tile-body">
                                    <form id="defaultForm" class="form-horizontal" name="info" action="auto_import_transaction.php" method="post" enctype="multipart/form-data">
                                      

                                      <div class="form-group row">
                                        <label class="control-label col-md-3">Account Number</label>
                                        <div class="col-md-8">
                                          <input class="form-control" type="text" placeholder="Account Number" name="account_no" id="account_no" onblur="chkAccNumber()">

                                           <!-- error div -->
                                        <div class="text-danger" id="account_no_error" style="font-size: 10;"></div>
                                        </div>
                                      </div>

                                       <div class="form-group row">
                                        <label class="control-label col-md-3">Card Number</label>
                                        <div class="col-md-8">
                                          <input class="form-control" type="text" placeholder="Card Number" name="card_no" id="card_no ">
                                        </div>
                                      </div>

                                       <div class="form-group row">
                                        <label class="control-label col-md-3">Charge Amount</label>
                                        <div class="col-md-8">
                                          <input class="form-control" type="text" placeholder="Charge Amount" name="charge_amount" id="charge_amount ">
                                        </div>
                                      </div>

                                       <div class="tile-footer">
                                    <div class="row">
                                      <div class="col-md-8 col-md-offset-3">
                                        <button class="btn btn-primary" type="button" id="submitbtn"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
                                      </div>
                                    </div>
                                  </div>
                                    </form>
                                  </div>

                                  <!-- from -->
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="../../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="../../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../../js/sweetalert.min.js"></script>
        <script src="../../../js/jquery-ui.js"></script>

       <script>
        /*number validation */
        /*$("#account_no").keypress(function (e) {
              var account_number = $('#account_no').val();

               if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                  $("#account_no_error").html("<span> SORRY ! ONLY NUMBER IS ALLOWED </span>");
                  return false;
               }else{
                     $("#account_no_error").html(" ");
                      var a = account_number_api_check(account_number);
                      console.log(a);

              
               }
           });*/
        /*end number validation */
        

        //key up function
        function chkAccNumber()
        {
           var account_no = $('#account_no').val();

            if(account_no !='')
            {   
                //pass data to function
               find_api_ac_number(account_no);
              
            }else{
              $("#account_no_error").html(' ');
            }
        }

        //find data from api
        function find_api_ac_number(acc_number)
        {
          $.ajax({
              type: 'POST',
              url : 'check_valid_account_number.php',
              data:{'acc_number': acc_number},
              success:function(data)
              {
                //if data found
                if(data ==1)
                {
                 $("#account_no_error").html('ok');

                }else{
                   //if data found
                   $("#account_no_error").html('data not found');
                }
              }

          })
        }


        $('#submitbtn').on('click', function(){
             

        });



       </script>
    </body>
</html>