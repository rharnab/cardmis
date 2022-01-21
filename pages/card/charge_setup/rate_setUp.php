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
                    <h1>Rate Set Up</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Card Charge</a></li>
                        <li class="active">Rate Set Up </li>
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
                                    <form id="defaultForm" class="form-horizontal" name="info" action="save_rate.php" method="post" enctype="multipart/form-data">
                                      

                                      <div class="form-group row">
                                        <label class="control-label col-md-3">Rate</label>
                                        <div class="col-md-8">
                                          <input class="form-control" type="text" placeholder="Give Rate" name="rate" id="rate">

                                           <!-- error div -->
                                        <div class="text-danger" id="rate_error" style="font-size: 10;"></div>
                                        </div>
                                      </div>

                                       <div class="form-group row">
                                        <label class="control-label col-md-3">Date</label>
                                        <div class="col-md-8">
                                          <input class="form-control" type="text" placeholder="Date" name="rate_date" id="rate_date">
                                           <!-- error div -->
                                        <div class="text-danger" id="card_no_error" style="font-size: 10;"></div>
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
     
      $(document).ready(function(){

            $('#rate_date').datepicker({ dateFormat : 'dd/mm/yy' })
      });


      /*amount  validation */
        $('#rate').keypress(function (event) {
                   var amt_validation= isNumber(event, this);
                   if(amt_validation == false)
                   {
                    $("#rate_error").html("<span style='font-size: 12px'> SORRY ! ONLY NUMBER IS ALLOWED </span>");
                   }else{

                       $("#rate_error").html('');
                   }
          });

          // THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
          function isNumber(evt, element) {
              var charCode = (evt.which) ? evt.which : event.keyCode
              if (            
                  (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
                  (charCode < 48 || charCode > 57))
                  return false;
                  return true;
          }
        /*end amount validation */

        /*form submit*/

        $('#submitbtn').on('click', function(){

          var  rate = $('#rate').val();
          var  rate_date = $('#rate_date').val();
          var  error = false;

          if(rate == '')
          {
            $('#rate').css('border-color', 'red');
             error = true;
          }else{
            $('#rate').css('border-color', '#ccc');
          }

          if(rate_date == '')
          {
            $('#rate_date').css('border-color', 'red');
             error = true;
          }else{
            $('#rate_date').css('border-color', '#ccc');
          }

         var rate_error  =$('#rate_error').html().trim();

         if(rate_error !='')
         {
            swal("RATE MUST BE DIGIT");
         }
          if(error == false && rate_error =='')
          {
            $.ajax({
              url: "save_rate.php",
              type:'post',
              data:{
                'rate':rate,
                'rate_date': rate_date
              },
              success:function(data)
              {
                 swal(data)
                 .then((value)=>{

                   location.reload();
                 });
                

              }
            })
          }

        });


       </script>
    </body>
</html>