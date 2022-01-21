<?php require_once('../../login-authentication.php');?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | MIS Campaigns</title>
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
        <link rel="stylesheet" href="../../css//jquery-1.12.1.ui.css">
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
                    <h1>Mobile SMS Campaign</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Campaign</a></li>
                        <li class="active">Mobile SMS Campaign</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-8" style="left: 0px; top: 0px">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" method="post">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <input type="checkbox" id="debitSms" value="debitSms"> <strong>Debit</strong>
                                                    <input type="checkbox" id="creditSms" value="creditSms"> <strong>Credit</strong>
                                                    <input type="checkbox" id="IndividualSms" value="Individual"> <strong>Individual</strong>
                                                    <div id="debitOption"></div>
                                                    <div id="creditOption"></div>
                                                    <div id="IndividualOption"></div>
                                                    <style>
                                                        strong{ font-size: 16px;padding: 5px;}
                                                    </style>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="campname">Campaign Name</label>
                                                    <input type="text" id="campname" name="campname" placeholder="Campaign name here" class="form-control">
                                                    <span id=""></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="datepicker">Campaign Date</label>
                                                    <input type="text" id="datepicker" name="datepicker" placeholder="DD-MM-YYYY" class="form-control">
                                                    <span id=""></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="txt">Campaign Message</label>
                                                    <textarea name="message" id="camMessage" class="form-control"></textarea>
                                                    <span id="charMsg"></span>
                                                    <span id=""></span>
                                                    <div id="result" class="pull-right">
                                                        Characters : <span id="totalChars">0</span> Words : <span id="wordCount">0</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/box-body -->
                                    <div class="box-footer">
                                        <div class="row">
                                            <div class="col-sm-12">
                                            <button type="submit" id="sendCamp" name="submit" class="btn btn-primary">Run Campaign</button>
                                        </div>
                                        </div>
                                    </div>
                                </form>
                            </div><!--/box-->
                        </div><!--/col-->
                    </div><!--/row-->
                </section><!--/content-->
            </aside><!--/aside-->
        </div><!--/wrapper-->
        
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
        <script src="../../js//jquery-1.12.ui.js"></script>

        <script>
            $(function(){
                // characters counting //
                $('#camMessage').click(charCounter);
                $('#camMessage').change(charCounter);
                $('#camMessage').keydown(charCounter);
                $('#camMessage').keypress(charCounter);
                $('#camMessage').keyup(charCounter);
                $('#camMessage').blur(charCounter);
                $('#camMessage').focus(charCounter);
                // jquery date picker //
                jsDatePicker("datepicker");

                // debit card campaign //
                $("#debitSms").click(function(){
                    if($(this).is(':checked')){
                        // remove check item after check new item //
                        checkRemove('creditSms','creditOption','IndividualSms','IndividualOption');
                    }else{
                        if($(this).is(':checked') == false){
                            $("#debitOption").fadeOut("fast");
                        }
                    }
                });
                // credit card campaign //
                $("#creditSms").click(function(){
                    if($(this).is(":checked")){
                        // remove check item after check new item //
                        checkRemove('debitSms','debitOption','IndividualSms','IndividualOption');
                        $("#creditOption").html("<input type='checkbox' class='classic' name='classic' id='classic' value='classic'>&nbsp;&nbsp;Classic&nbsp;&nbsp;<input type='checkbox' class='gold' name='gold' id='gold' value='gold'>&nbsp;&nbsp;Gold&nbsp;&nbsp;<input type='checkbox' class='platinum' name='platinum' id='platinum' value='platinum'>&nbsp;&nbsp;Platinum&nbsp;&nbsp;").fadeIn("fast").css({
                            'margin':'10px 0 15px 0',
                            'font-size':'20px'});

                        // check phone,email,alldata //
                        selectItem('classic','gold','platinum');
                        selectItem('gold','classic','platinum');
                        selectItem('platinum','classic','gold');
                    }else{
                        if($(this).is(":checked")== false){
                            $("#creditOption").fadeOut("fast");
                        }
                    }
                    
                });
                // indivisula campaign //
                $("#IndividualSms").click(function(){
                    if($(this).is(":checked")){
                       // remove check item after check new item //
                        checkRemove('debitSms','debitOption','creditSms','creditOption');

                        $("#IndividualOption").html("<input type='text' id='phoneNumber' name='indi' placeholder='Enter mobile number'>").fadeIn('fast').css({
                            'margin':'10px 0 15px 0',
                            'font-size':'20px'});

                        $("#phoneNumber").mouseout(function(){
                            var nm = $(this).val();
                            console.log(nm);
                        });
                    }else{
                        if($(this).is(":checked")==false){
                            $("#IndividualOption").fadeOut("fast");
                        }
                    }
                    
                });
                
            });

            // remove check item after check new item //
            function checkRemove(prop_id1,fadeo_id1,prop_id2,fadeo_id2){
                $("#"+prop_id1).prop('checked', false);
                $("#"+fadeo_id1).fadeOut("fast");
                $("#"+prop_id2).prop('checked', false);
                $("#"+fadeo_id2).fadeOut("fast");
                return;
            }

            // checked & unchecked after checke //
            function selectItem(cl_id,rid1,rid2){
                // check classic,gold,platinum //
                $("."+cl_id).click(function(){
                    var data = $(this).attr('class');
                    if($(this).is(":checked")){
                        $("."+rid1).prop("checked",false);
                        $("."+rid2).prop("checked",false);
                    }
                });
            }


            // filter wise send sms //
            $("#sendCamp").click(function(){

                console.log(120);

            });

        </script>      
    </body>
</html>