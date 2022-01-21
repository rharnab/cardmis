<?php 
    include('../pages/card/db/dbconnect.php');
    //session_start();
    error_reporting(0);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | Password Change </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Coustom StyleSheet -->
        <link rel="stylesheet" href="../css/style.css">
        <!-- date picker -->
        <link rel="stylesheet" type="text/css" href="../css/jquery-ui.css">

        <!-- select js -->
        <script src="../js/select2.min.css"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <?php
            include("../pages/card/database.php");
        ?>
        <!-- header logo: style can be found in header.less -->
        <?php include("../header.php");?>        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
               

                <!-- style -->

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-7 col-md-offset-2">
                            <div class="box">
                               <div class="box-header">
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                  <!-- from -->
                                   <div class="tile-body">
                                    <form id="defaultForm" class="form-horizontal" name="info" action="save_change_password.php" method="post" enctype="multipart/form-data">
                                      <div class="form-group row">
                                        <label class="control-label col-md-3">Old Password  <strong class="pull-right" style="color:red; margin-top:4px; margin-left: 6px; ">*</strong> </label>
                                         
                                        <div class="col-md-8">
                                          <input class="form-control" type="password"  name="old_password" id="old_password" placeholder="Old Password">

                                           <span id="oldErrorMsg"></span>
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                        <label class="control-label col-md-3">New Password <strong class="pull-right" style="color:red; margin-top:4px; margin-left: 6px; ">*</strong> </label>
                                          <strong class="pull-right" style="color:red; margin-top:5px;">*</strong>
                                        <div class="col-md-8">
                                          <input class="form-control" type="password" placeholder="New Password" name="new_password" id="new_password">

                                           <span id="newErrorMsg"></span>
                                        </div>
                                      </div>

                                       <div class="form-group row">
                                        <label class="control-label col-md-3">Confirm Password <strong class="pull-right" style="color:red; margin-top:4px; margin-left: 6px; ">*</strong> </label>
                                        <strong class="pull-right" style="color:red; margin-top:5px;">*</strong>
                                        <div class="col-md-8">
                                          <input class="form-control" type="password" placeholder="Confirm Password" name="confirm_password" id="confirm_password">

                                           <span id="confirmErrorMsg"></span>
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
        <script src="../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/sweetalert.min.js"></script>
        <script src="../js/jquery-ui.js"></script>

        <script>
            $('#submitbtn').click(function(){
                var old_password = $('#old_password').val();
                var new_password = $('#new_password').val();
                var confirm_password = $('#confirm_password').val();

                if(old_password == '')
                {
                    $("#oldErrorMsg").text("Please give old password").css('color','red').fadeIn(100).fadeOut(1500);
                }
                else if(new_password == '')
                {
                    $("#newErrorMsg").text("Please give new password").css('color','red').fadeIn(100).fadeOut(1500);
                } 
                else if(confirm_password == '')
                {
                    $("#confirmErrorMsg").text("Please give confirm password").css('color','red').fadeIn(100).fadeOut(1500);
                }

                else if(!(new_password == confirm_password))
                {
                    $("#confirmErrorMsg").text("Sorry confirm password not match").css('color','red').fadeIn(100).fadeOut(1900);
                }else{

                     swal({
                          title: "DO YOU WANT CHANGE THIS PASSWORD  ?? ",
                          icon: "success",
                          buttons: true,
                          dangerMode: true,
                        })
                        .then((value)=>{

                            if(value)
                            {

                                 $.ajax({
                                    url:'save_change_password.php',
                                    type:'post',
                                    data:{old_password, new_password, confirm_password},
                                    success:function(responseData){
                                        /*swal(responseData)
                                        .then((value)=>{
                                            location.reload();

                                        });*/
                                        if(responseData== 1)
                                        {
                                           window.location = '../index.php';
                                         }else{
                                          swal(responseData);
                                         }
                                       

                                        
                                    }
                                });

                            }

                        });

                }
            })
        </script>
    </body>
</html>