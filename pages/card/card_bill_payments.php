<?php require_once('../../login-authentication.php');?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | MIS Card Payments</title>
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
                    <h1>Payments</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Payments</a></li>
                        <li class="active">Payments</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-4" style="left: 0px; top: 0px">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <div id="successMsg" style="margin:5px;"></div>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form id="debitCardForm" role="form" method="post">
                                    <div class="box-body">
                                        <div class="col-md-12" style="margin-top: 15px;">
                                            <div class="form-group">
                                                <label for="accNo">Card Number</label>
                                                <strong class="pull-right" style="color:red; margin-top:5px;">*</strong>
                                                <input type="text" id="accNo" name="accNo" placeholder="please enter your 13 digits account number" class="form-control">
                                                <span id="errorMsg"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="accNo">Check Currency</label>
                                                <strong class="pull-right" style="color:red; margin-top:5px;">*</strong><br>
                                                <input type="radio"> BDT <input type="radio"> USD
                                            </div>
                                        </div>
                                        <div class="col-md-12 football" id="p">
                                            <div class="form-group">
                                                <label for="payamount">Payment Amount</label>
                                                <input type="text" id="payamount" name="payamount" placeholder="How much amount...?" class="form-control">
                                                <span id="nocErrorMsg"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nocard">Bearer Name</label>
                                                <input type="text" id="nocard" name="nocard" placeholder="Enter bearer name here..." class="form-control">
                                                <span id="nocErrorMsg"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="otherPhone">Bearer Phone</label>
                                                <input type="text" id="otherPhone" name="otherPhone" placeholder="Enter bearer phone number" class="form-control">
                                                <span id="phoneErrorMsg"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /box-body -->

                                    <div class="box-footer">
                                        <button type="" name="submit" class="btn btn-primary" style="width: 100%">Submit Query</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div><!--/.col (left) -->
                        <div class="col-md-6" style="left: 0px; top: 0px">
                            <div class="box box-primary">
                                <div class="box-header text-center">
                                    <bi>Account Information</big>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-hover table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>Name: <strong id="name"></strong></td>
                                                <td>Customer ID: <strong id="customerId"></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Mobile No: <strong id="phone"></strong></td>
                                                <td>Father's name: <strong id="fathers"></strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Address: <strong id="address"></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>  
                                </div>
                                <div class="box-footer"></div>
                            </div><!-- /.box -->
                        </div><!-- /right -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
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
        <script src="../../js/jquery-1.12.ui.js"></script>
        <script src="../../js/jquery.form.4.2.2min.js"></script>

        <script>
            $( function(){

                // jquery date picker //
                jsDatePicker("datepicker");

                // account number details informations show //
                $(document).on("change","#accNo",function(){
                    var value = $("#accNo").val();
                    if(value !=''){
                        $.ajax({
                            url:'allaction/viewDataFromFlora.php',
                            type:'post',
                            data:{accnumber:value},
                            success:function(res){
                                var jsonData = JSON.parse(res);
                                document.getElementById("name").innerHTML = jsonData.acname;
                                document.getElementById("customerId").innerHTML = jsonData.customer;
                                document.getElementById("phone").innerHTML = jsonData.pre_mobilno;
                                document.getElementById("fathers").innerHTML = jsonData.father_hus;
                                document.getElementById("address").innerHTML = jsonData.sub_head_addr;
                                //console.log(jsonData);
                            }
                        });
                    }
                });


                // count 5000 
                $("#payamount").mouseleave(function(){
                    var val = $(this).val();
                    var int = 1;
                    if(val >= 5000){
                        if(int){

                            $(".football").after('<div class="col-md-12"><div class="form-group"><label for="nid">Bearer NID</label><input type="text" id="nid" name="nid" placeholder="Enter bearer nid number" class="form-control"><span id="phoneErrorMsg"></span></div></div>');


                        }

                    }   
                    
                    /*var text = $(".football").length;
                    alert(text);*/

                });

            });
        </script>
    </body>
</html>