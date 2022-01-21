<?php require_once('../../login-authentication.php');?>
<?php
    include('db/dbconnect.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | MIS</title>
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
                    <h1>Get File</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Text File Read</a></li>
                        <li class="active">Get file (csv,txt,excel)</li>
                    </ol>
                </section>
                <section style="margin:10px;">
                    <form action="" method="">
                        <div class="col-sm-12">
                            <input type="checkbox" id="csv" name="check">
                            <strong>Create CSV</strong>
                            <input type="checkbox" id="txt" name="check">
                            <strong>Create TXT</strong>
                            <input type="checkbox" id="excel" name="check">
                            <strong>Create EXCEL</strong>
                            <div id="csvOptions"></div>
                            <div id="txtOptions"></div>
                            <div id="excelOptions"></div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <button class="btn btn-primary">Generate File</button>
                            </div>
                        </div>
                    </form>
                    <style>
                        strong{margin:0 3px 0 3px;}
                        button{margin:5px 0 5px 0;}
                    </style>
                </section>
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
       <script src="../../js/jquery-1.12.ui.js"></script>

        <script>
            $(function(){
                // CSV file checkbox //
                $("#csv").click(function(){
                    if($(this).is(':checked')){
                        // show query type check options //
                        showQueryOptions('csvOptions');
                        // remove check item after check new item //
                        checkRemove('txt','txtOptions','excel','excelOptions');
                        // check phone,email,alldata
                        selectItem('email','phone','phoneEmail','allData');
                        selectItem('phone','email','phoneEmail','allData');
                        selectItem('phoneEmail','email','phone','allData');
                        selectItem('allData','email','phone','phoneEmail');
                    }else{
                        if($(this).is(':checked') == false){
                            $("#csvOptions").fadeOut("fast");
                        }
                    }
                });

                // text file checkbox //
                $("#txt").click(function(){
                    if($(this).is(':checked')){
                        // show query type check options //
                        showQueryOptions('txtOptions');

                        // remove check item after check new item //
                        checkRemove('csv','csvOptions','excel','excelOptions');
                        // check phone,email,alldata //
                        selectItem('email','phone','phoneEmail','allData');
                        selectItem('phone','email','phoneEmail','allData');
                        selectItem('phoneEmail','email','phone','allData');
                        selectItem('allData','email','phone','phoneEmail');
                    }else{
                        if($(this).is(':checked') == false){
                            $("#txtOptions").fadeOut("fast");
                        }
                    }
                });
                // excel file checkbox //
                $("#excel").click(function(){
                    if($(this).is(':checked')){
                        // show query type check options //
                        showQueryOptions('excelOptions');
                        // remove check item after check new item //
                        checkRemove('csv','csvOptions','txt','txtOptions');
                       // check phone,email,alldata //
                        selectItem('email','phone','phoneEmail','allData');
                        selectItem('phone','email','phoneEmail','allData');
                        selectItem('phoneEmail','email','phone','allData');
                        selectItem('allData','email','phone','phoneEmail');
                    }else{
                        if($(this).is(':checked') == false){
                            $("#excelOptions").fadeOut("fast");
                        }
                    }
                });

            });// jquery end

            // remove check item after check new item //
            function checkRemove(prop_id1,fadeo_id1,prop_id2,fadeo_id2){
                $("#"+prop_id1).prop('checked', false);
                $("#"+fadeo_id1).fadeOut("fast");
                $("#"+prop_id2).prop('checked', false);
                $("#"+fadeo_id2).fadeOut("fast");
            }

            // show query type check options //
            function showQueryOptions(optionId){
                $("#"+optionId).html("<input type='checkbox' class='email' name='email'>&nbsp;&nbsp;Email&nbsp;&nbsp;<input type='checkbox' class='phone' name='phone'>&nbsp;&nbsp;Phone&nbsp;&nbsp;<input type='checkbox' class='phoneEmail' name='phone_email'>&nbsp;&nbsp;Email & Phone&nbsp;&nbsp;<input type='checkbox' class='allData' name='allData'>&nbsp;&nbsp;All Data").fadeIn('fast').css({
                            'margin':'10px 0 15px 0',
                            'font-size':'20px'});
            }
            // checked & unchecked after checked file type //
            function selectItem(cl_id,rid1,rid2,rid3){
                // check phone,email,alldata //
                $("."+cl_id).click(function(){
                    var data = $(this).attr('class');
                    if($(this).is(":checked")){
                        $("."+rid1).prop("checked",false);
                        $("."+rid2).prop("checked",false);
                        $("."+rid3).prop("checked",false);
                    }
                });
            }

        </script>
    </body>
</html>
