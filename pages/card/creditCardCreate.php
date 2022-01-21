<?php require_once('../../login-authentication.php');?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | MIS Credit Card</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- below two link use for datepicker -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <!-- Custom StyleSheet -->
        <link rel="stylesheet" href="../../css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include("../../header.php");?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
             <?php include("../../menu.php");?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Credit Card</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Requisition</a></li>
                        <li class="active">Credit Card</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12" style="left: 0px; top: 0px">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="post">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="accNo">Account Number</label>
                                                        <input type="text" id="accNo" name="accNo" placeholder="Please enter account number maximum digit 16" class="form-control">
                                                        <span id="errorMsg"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="nidpass">NID/Passport Number</label>
                                                        <input type="text" id="nidpass" name="nidpass" placeholder="Please Enter your NID/Passport Number" class="form-control">
                                                        <span id="nidErMsg"></span>
                                                    </div>
                                                </div> 
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="etin">ETIN/Tax Register Number</label>
                                                        <input type="text" id="etin" name="etin" placeholder="Please Enter your ETIN/TAX register number maximum(13) Digit" class="form-control">
                                                        <span id="errorMsgEtin"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="accType">Account Type</label>
                                                        <select id="accType" name="accType" class="form-control">
                                                            <option>Select account type</option>
                                                            <option>Business</option>
                                                            <option>Platinum</option>
                                                            <option>Gold</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="clEmail">Client Email</label>
                                                        <input type="email" id="clEmail" name="clEmail" placeholder="Enter client email address" class="form-control">
                                                        <span id="emailErMsg"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="clPhone">Client Phone</label>
                                                        <input type="text" id="clPhone" name="clPhone" placeholder="Enter client phone number" class="form-control">
                                                        <span id="phoneErrorMsg"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="acc-open-date">Acc Open Date</label>
                                                        <input type="text" id="datepicker" placeholder="DD-MM/YYYY" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="mailAddress">Mailing Address</label>
                                                        <input type="text" id="mailAddress" name="mailAddress" placeholder="Enter client address" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                 <div class="form-group">
                                                        <label for="clDocument">Upload Document</label>
                                                        <input type="file" id="clDocument" name="clDocument">
                                                    </div>
                                                </div>
                                            </div> <!-- left side-->
                                            <div class="col-sm-6">
                                                <h3 class="text-primary">Common Rquirements for credit cards</h3>
                                                <h6>( Check & Upload Files )</h6>

                                                <input type="checkbox" id="nidcheck">
                                                <p id="nidFile">NID/Passport.</p>
                                                <div id="nidbrowse"></div>

                                                <input type="checkbox" id="etincheck">
                                                <p>Personal E-TIN/Tax clearance certificate (not old more than 2 years).</p>
                                                <div id="etinbrowse"></div>

                                                <input type="checkbox" id="othercheck">
                                                <p>Other's verification document/Driving Licence/Employee Card.</p>
                                                <div id="otherbrowse"></div>
                                                <br>
                                                <style>
                                                    p{
                                                        margin-left: 28px;
                                                        margin-top: -20px; 
                                                        cursor: pointer;
                                                    }
                                                    .others{margin-left: 28px;}
                                                </style>
                                            </div>
                                        </div><!-- /form row -->  
                                    </div>
                                    <!-- /box-body -->
                                    <div class="box-footer">
                                        <div class="row">
                                            <div class="col-sm-12">
                                            <button id="submit" type="" name="submit" class="btn btn-primary pull-right">Submit Requirements</button>
                                        </div>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script> --> 
        <!-- jQuery 3.3.1 -->
        <script src="../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- InputMask -->
        <script src="../../js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="../../js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="../../js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- date-range-picker -->
        <script src="../../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- bootstrap color picker -->
        <script src="../../js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
        <!-- bootstrap time picker -->
        <script src="../../js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <!-- js custom funtions -->
        <script src="../../js/functions/functions.js"></script>
        <!-- below two script use for datepicker -->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script>
            $(function(){
                // jquery date picker //
                jsDatePicker("datepicker");

                // checkbox select //
                $("#nidcheck").click(function(){
                    if($(this).is(':checked')){
                        $("#nidbrowse").html("<input type='file' name='nid_file' id='nid_file' >").fadeIn('fast');
                    }else{
                        if($(this).is(':checked') == false){
                            $("#nidbrowse").fadeOut("fast");
                        }
                    }
                });

                // Etin checked //
                $("#etincheck").click(function(){
                    if($(this).is(':checked')){
                        $("#etinbrowse").html("<input type='file' id='etin_file' name='etin_file' >").fadeIn('fast');
                    }else{
                        if($(this).is(':checked') == false){
                            $("#etinbrowse").fadeOut("fast");
                        }
                    }
                });

                // others checked //
                $("#othercheck").click(function(){
                    if($(this).is(':checked')){
                       $("#otherbrowse").html("<input type='file' id='other_file' name='other_file' >").fadeIn('fast');
                    }else{
                        if($(this).is(':checked') == false){
                            $("#otherbrowse").fadeOut("fast");  
                        }
                   }
                });

                // multiple file uploading function //
                function file_uploading(id,fileId,fileName){
                   if($("#"+id).is(':checked')){
                       $("#"+fileId).html("<input type='file' name='fileName'>").fadeIn('fast'); 
                    }else{
                        if($("#"+id).is(':checked') == false){
                            $("#"+fileId).fadeOut("fast");  
                        }
                   } 
                }

                // submit data //
                $(document).on('click','#submit',function(e){
                    e.preventDefault();
                    var nid_file   = $("#nid_file").val();
                    var etin_file  = $("#etin_file").val();
                    var other_file = $("#other_file").val()

                    

                    if(typeof(nid_file) != 'undefined'){
                        console.log(nid_file);
                    }else{
                        console.log("Please choose file");
                    }
                   
                    if(typeof(etin_file) != 'undefined'){
                        console.log(etin_file);
                    }else{
                        console.log("Please choose etin file");
                    }

                    if(typeof(other_file) != 'undefined'){
                        console.log(other_file);
                    }else{
                        console.log("Please choose other file");
                    }                    

                });

            });

        </script>
    </body>
</html>