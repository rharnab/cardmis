<?php require_once('../../login-authentication.php');?>
<?php 
    include_once('db/dbconnect.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | MIS Debit Card SMS</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- font Awesome -->
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Ionicons -->
        <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css"/>

        <!-- below two link use for datepicker -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <!-- Custom StyleSheet -->
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="../../css/custom-tab.css">
        
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
                    <h1>Debit Card SMS</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Requisition</a></li>
                        <li class="active">Debit Card SMS</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6" style="left: 0px; top: 0px">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="allaction/debit_sms_send.php" method="post">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="fromDate">From Date</label>
                                                    <input type="date" id="fromDate" name="fromDate" class="form-control">
                                                    <span id=""></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="toDate">To Date</label>
                                                    <input type="date" id="toDate" name="toDate" class="form-control">
                                                    <span id=""></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="camMessage">Write Message&nbsp;&nbsp; <span id="msg"></span></label>
                                                    <textarea name="camMessage" id="camMessage" class="form-control"></textarea>
                                                    <span id="charMsg"></span>
                                                    <div id="result" style="margin-top:5px;">
                                                        Characters : <span id="totalChars">0</span> Words : <span id="wordCount">0</span>
                                                        <button style="width:50px; font-weight: bold;" type="button" id="addMsg" class="btn btn-xs btn-secondary pull-right">Save</button>
                                                    </div>
                                                </div>
                                                <!-- <button type="button" class="btn btn-secondary removeBtn">- Remove</button> -->
                                            </div>
                                            <!-- message table -->
                                            <div class="col-sm-12" id="tabShowData">
                                                <ul id="tabs" style="margin-left: -40px; border: none;">
                                                    <?php
                                                        include_once('db/dbconnect.php');
                                                        $message_type = 'mobile'; 
                                                        $get_sms = $conn->prepare("SELECT * FROM debit_card_sms WHERE message_type=?");
                                                        $get_sms->bindParam(1,$message_type);
                                                        $get_sms->execute();
                                                        $totalRow = $get_sms->rowCount();
                                                        for($i=0;$i<$totalRow;$i++){
                                                            ?>
                                                                <li><a id="<?php echo'tab'.($i+1);?>">Message <?php echo $i+1;?></a></li>

                                                            <?php
                                                        }
                                                    ?>
                                                </ul>
                                                <?php
                                                    $i = 0;
                                                    while($result = $get_sms->fetch(PDO::FETCH_OBJ)){
                                                ?>
                                                    <div class="container" id="<?php echo'tab'.($i+1).'C';?>">
                                                        <?php echo $result->message;?>
                                                    </div>
                                                <?php
                                                    $i++;
                                                    }
                                                ?>
                                            </div>
                                            <!-- /message tab1C table -->
                                        </div>
                                    </div>
                                    <!--/box-body -->
                                    <div class="box-footer">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <button type="submit" id="sendCamp" name="submit" class="btn btn-primary">Send SMS</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div><!--/box-->
                        </div><!--/col-->
                        <!-- show sms history --> 
                        <div class="col-md-6" style="left: 0px; top: 0px">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h4 class="text-center">Debit Card SMS History ( <?php echo date("F - Y");?> )</h4>
                                </div>
                                <div class="box-body">
                                    <table id="example1" class="table table-hover table-striped table-bordered table-condensed">
                                        <thead>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Sun-10-Jan-2019</td>
                                                <td>Sent</td>
                                            </tr>
                                            <tr>
                                                <td>Mon-11-Jan-2019</td>
                                                <td>Pending...</td>
                                            </tr>
                                            <tr>
                                                <td>Tue-12-Jan-2019</td>
                                                <td>Sent</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="box-footer"></div>
                            </div>
                        </div>
                        <!-- /show sms history -->
                    </div><!--/row-->
                </section><!--/content-->
            </aside><!--/aside-->
        </div><!--/wrapper-->
        
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

                // Add message area start with ajax //
                $(document).on('click','#addMsg',function(){
                    var message = $("#camMessage").val();
                    $.ajax({
                        url:'allaction/mobile_sms_save.php',
                        type:'post',
                        data:{data:message},
                        success:function(res){
                            document.getElementById('msg').innerHTML = res;
                            $('#msg').fadeIn('fast').fadeOut(2000);
                            $('#tabShowData').load(location.href +  ' #tabShowData');
                            window.location.reload();// reload for get last save sms //
                        }
                    });
                    // empty message box //
                    $("#camMessage").val('');
                });

                /*
                    Message tab system.
                    tab active inactive js code
                */
                $('#tabs li a:not(:first)').addClass('inactive');
                $('.container').hide().removeClass('getVal');
                $('.container:first').show().addClass('getVal');   
                $('#tabs li a').click(function(){
                    var t = $(this).attr('id');
                    if($(this).hasClass('inactive')){ //this is the start of condition 
                        $('#tabs li a').addClass('inactive');           
                        $(this).removeClass('inactive');
                        $('.container').hide().removeClass('getVal');
                        $('#'+ t + 'C').fadeIn('fast').addClass('getVal');
                    }
                });
                /* end tab active inactive js code area */

                // sendig message with ajax //
                /*$("#sendCamp").click(function(evn){
                    evn.preventDefault();

                    if($('#tabShowData div').hasClass('getVal')){
                        var value = $('div .getVal').text();
                        alert(value);
                    }

                });*/

            });

        </script>  

    </body>
</html>