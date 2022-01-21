<?php 
    include('../db/dbconnect.php');
    //session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | Charge file upload</title>
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
                    <h1>Charge File Upload</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Card Charge</a></li>
                        <li class="active">Charge File Upload</li>
                    </ol>
                </section>

<!-- style -->
<style type="text/css">
  .page_loader{
     position: absolute;
    z-index: 1;
    left: 27%;
    width: 37%;
  }
</style>
                <!-- style -->

                <!-- Main content -->
                <section class="content">
                  <img src="../img/loader.gif" class="page_loader" alt="Page loader">
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
                                        <label class="control-label col-md-3">File</label>
                                        <div class="col-md-8">
                                          <input class="form-control" type="file"  name="input_file" id="file">
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                        <label class="control-label col-md-3">Execution End date</label>
                                        <div class="col-md-8">
                                          <input class="form-control" type="text" placeholder="Execution End date" name="ex_end_dt" id="ex_end_dt">
                                        </div>
                                      </div>

                                       <div class="form-group row">
                                        <label class="control-label col-md-3">Rate</label>
                                        <div class="col-md-8">
                                          <input class="form-control" type="text" placeholder="Rate" name="rate" id="rate">
                                        </div>
                                      </div>

                                       <div class="tile-footer">
                                    <div class="row">
                                      <div class="col-md-8 col-md-offset-3">
                                        <button class="btn btn-primary" type="button" id="submitbtn"><i class="fa fa-fw fa-lg fa-check-circle"></i>Upload</button>
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
            $('.page_loader').hide();
            $("#ex_end_dt").datepicker({dateFormat: 'dd/mm/yy'});
      });

       

      $('#submitbtn').on('click', function(){

        var form = $('#defaultForm')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);



          var fileInput =  document.getElementById('file');
          var filePath = fileInput.value;
          var allowedExtensions =  /(\.txt|\.TXT)$/i;

          var ex_end_dt = $('#ex_end_dt').val();
          var rate = $('#rate').val();

          if(filePath == '')
          {
            swal('Please Choose file for auto debit charge');
            return false;
          }

          if(ex_end_dt == '')
          {
            swal('Please give exucution last date');
            return false;
          }


          //check reate value not empty
          if(chekUsdFIle() == true)
          {

            if(rate == '')
            {
               swal("PLEASE GIVE RATE");
               return false;
            }

          }else{
            if(rate != '')
            {
               swal("SORRY RETE NOT ALLOWED FOR BDT FILE");
               return false;
            }

          }

         

          if(filePath !='')
          {

            if(allowedExtensions.exec(filePath))
            {
              
               swal({
                  title: "DO YOU WANT TO  CREATE THIS AUTO CARD CHARGE  ?? ",
                  icon: "success",
                  buttons: true,
                  dangerMode: true,
                })
               .then((value)=>{
                 if(value)
                 {
                  $('.page_loader').show();
                  $.ajax({
                      url:'auto_import_transaction.php',
                      type:'POST',
                      data:formData,
                      contentType: false, 
                      processData: false,
                      success:function(data)
                      {
                        /*alert(data);
                        location.reload();*/
                        swal(data)
                        .then((value)=>{
                           location.reload();
                        })
                      }
                });

                 }else{

                 }
               })


            }else{
              swal('File must be Text File');

            } 


          }else{
            swal("Please Choose a File for Continue");
          }
          


        });



      //check rate for usd file
       function chekUsdFIle()
          {
             var filename = $('input[type=file]').val().split('\\').pop();

             //var a = "USD AUTO DEBIT 25052021.TXT";
             var  file_array = filename.split(" ");
             var usd_name = (file_array.indexOf('USD') > -1)
             
             return usd_name;
          }

       
    
    </script>
    </body>
</html>