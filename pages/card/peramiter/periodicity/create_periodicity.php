<?php require_once('../../../../login-authentication.php');?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | Create Periodicity</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../../../css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->          
    </head>

    <body class="skin-blue">
	    <?php
		    include("../../database.php");
	    ?>    
        <!-- header logo: style can be found in header.less -->
		<?php include("../../../../header.php");?>		
		<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
             <?php include("../../../../menu.php");?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Create Periodicity</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Utility</a></li>
                        <li class="active">Parameter</li>
                        <li class="active">Periodicity </li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-10" style="left: 0px; top: 0px">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <div id="succMsg"></div>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form method="post" action="save_periodicity.php">
                                    <div class="box-body">
                                        <div class="col-md-6 form-group">
                                            <label for="value">Value &nbsp;&nbsp;<span id="valueNotice"></span></label>
                                            <input type="text" id="value" name="value" placeholder="Enter Value" class="form-control">
                                        </div>
                                        
                                        <div class="col-md-6 form-group">
                                            <label for="description">Description &nbsp;&nbsp;<span id="descriptionNotice"></span></label>
                                            <input type="text" id="description" name="description" placeholder="Enter Description " class="form-control">
                                        </div>
                                       

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button id="submitBtn"  class="btn btn-primary" style="margin-left:15px">Create Periodicity</button>
                                    </div>
                                </form>
                            </div>
                        </div><!--/.col (left) -->
                        <!-- right column -->
                        <!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- jQuery 2.0.2 -->
        <script src="../../../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../../../js/AdminLTE/app.js" type="text/javascript"></script>
               
        <script src="../../../../js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="../../../../js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="../../../../js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- date-range-picker -->
        <script src="../../../../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- bootstrap color picker -->
        <script src="../../../../js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
        <!-- bootstrap time picker -->
        <script src="../../../../js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="../../../../js/sweetalert.min.js"></script>

        <script>
            
            $(document).ready(function(){
                $('#submitBtn').click(function(event){
                    event.preventDefault();
                    if($("#value").val() == ''){
                        $("#valueNotice").fadeIn('fast').text("This field are required").css('color','red').fadeOut(2000);
                    }else if($("#description").val() == ''){
                        $("#descriptionNotice").fadeIn('fast').text("This field are required").css('color','red').fadeOut(2000);
                    }else{
                        // send data //
                        var formData = $("form").serializeArray();
                        swal({
                              title: "DO YOU WANT TO CREATE THIS",
                              icon: "success",
                              buttons: true,
                             
                            })
                        .then((yes)=>{
                            if(yes){

                                $.ajax({
                                url:'save_periodicity.php',
                                type:'post',
                                data:{formData},
                                success:function(data){
                                    swal(data)
                                    .then((yes)=>{
                                        location.reload();
                                    })
                                }
                              });

                            }else{

                            }
                        })
                        
                    }        
                });
            });

        </script>
        
    </body>
</html>