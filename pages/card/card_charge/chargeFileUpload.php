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
  .invaild-title {
    color: red;
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
                                    <form id="defaultForm" class="form-horizontal" name="info" action="import_transaction.php" method="post" enctype="multipart/form-data">
                                      <div class="form-group row">
                                        <label class="control-label col-md-3">File</label>
                                        <div class="col-md-8">
                                          <input class="form-control" type="file"  name="input_file" id="file">
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                        <label class="control-label col-md-3">Debit Amount</label>
                                        <div class="col-md-8">
                                           <input class="form-control" type="text" placeholder="Debit Amount" name="debit_amount" id="debit_amount">

                                            <!-- error div -->
                                        <div class="text-danger" id="debit_amount_error" style="font-size: 10;"></div>
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                        <label class="control-label col-md-3">Narration</label>
                                        <div class="col-md-8">
                                          <input class="form-control" type="text" placeholder="Narration" name="narration">
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

                          <div class="col-xs-6">
                            <div class="box">
                               <div class="box-header">
                                    <div class="invaild-title">
                                          <!-- <h3>Invalid Account File</h3> -->
                                    </div>  
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                  <!-- from -->
                                   <div class="tile-body">
                                    <form id="InvaliDForm" class="form-horizontal" name="info" action="invalid_account/save_invalid_account.php" method="post" enctype="multipart/form-data">
                                      <div class="form-group row">
                                        <label class="control-label col-md-4 invaild-title">Invalid Account File</label>
                                        <div class="col-md-8">
                                          <input class="form-control" type="file"  name="invalid_file" id="invalid_file">
                                        </div>
                                      </div> <!-- form group end -->

                                       <div class="tile-footer">
                                          <div class="row">
                                            <div class="col-md-8 col-md-offset-4">
                                              <button class="btn btn-primary" type="button" id="invalidSubmit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Upload</button>
                                            </div>
                                          </div>
                                        </div> <!-- end title-footer -->
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

       <script>

      $(document).ready(function(){

          $('.page_loader').hide();

      });


       /*amount  validation */
        $('#debit_amount').keypress(function (event) {
                   var amt_validation= isNumber(event, this);
                   if(amt_validation == false)
                   {
                    $("#debit_amount_error").html("<span style='font-size: 12px'> SORRY ! ONLY NUMBER IS ALLOWED </span>");
                   }else{

                       $("#debit_amount_error").html('');
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
      

      /*submit function*/
      
      $('#submitbtn').on('click', function(){

        var form = $('#defaultForm')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);



          var fileInput =  document.getElementById('file');
          var filePath = fileInput.value;
          var allowedExtensions =  /(\.txt|\.TXT)$/i;

          if(filePath !='')
          {

            if(allowedExtensions.exec(filePath))
            {
              
               swal({
                  title: "DO YOU WANT TO  CREATE THIS CARD CHARGE  ?? ",
                  icon: "success",
                  buttons: true,
                  dangerMode: true,
                })
               .then((value)=>{
                 if(value)
                 {
                  $('.page_loader').show();
                  $.ajax({
                      url:'import_transaction.php',
                      type:'POST',
                      data:formData,
                      contentType: false, 
                      processData: false,
                      success:function(data)
                      {
                        $('.page_loader').hide();
                        /*alert(data);
                        location.reload();*/
                        swal(data)
                        .then((value)=>{

                         
                          window.location.href = "download_invalid_account.php";
                           //location.reload();
                        })

                        //console.log(data);
                        
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


  /*end submit function*/


  /*invalid account file upload*/
  $('#invalidSubmit').click(function(){

    form =$('#InvaliDForm')[0];
    formData = new FormData(form);

      var input_file  = document.getElementById('invalid_file');
      var file_name = input_file.value;
      var allowedExtensions = /(\.xlsx|\.xls)$/i;

      if(input_file !='')
      {
        if(allowedExtensions.exec(file_name))
        {
           $.ajax({
              type: 'post',
              url:"invalid_account/save_invalid_account.php",
              data:formData,
              contentType: false,
              processData: false,
              success:function(data)
              {
                swal(data)
                .then((value)=>{
                   location.reload();
                })

              }


           })

        }else{
         swal('File must be xlsx or xls File');
        }
      }else{
        swal("Please Choose a File for Continue");
      }



  })
  /*end invalid account file upload*/


       
    
    </script>
    </body>
</html>