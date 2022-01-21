<?php require_once('../../login-authentication.php');?>
<?php 
    include('db/dbconnect.php');
    
    // get branch name 
    $br_select = $conn->prepare("SELECT DISTINCT br_division FROM branches");
    $br_select->execute();
    $br_data = '';
    while($rowData = $br_select->fetch(PDO::FETCH_ASSOC)){
        $br_data.="
            <option value='$rowData[br_division]'>$rowData[br_division]</option>
        "; 
    }

    // Get Permission Data //
    $slug = '';
    $slug_select = $conn->prepare("SELECT * FROM slug_table");
    $slug_select->execute();
    while($slug_data = $slug_select->fetch(PDO::FETCH_ASSOC)){
        $slug .="
            <option value='$slug_data[id]'>$slug_data[menu_name]</option>
        ";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | MIS Add user permission</title>
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
                    <h1>Add User Permission</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Access Management</a></li>
                        <li class="active">Add User Permission</li>
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
                                    <div id="successMsg" style="margin:5px;"></div>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form id="debitCardForm" role="form" method="post">
                                    <div class="box-body">
                                        <div class="col-md-6 form-group">
                                            <label for="brDivi">Branch Division</label>
                                            <select id="brDivi" name="brDivi" class="form-control">
                                                <option value="">Select Branch Division</option>
                                                <?php echo $br_data;?>
                                            </select>
                                            <span id="brDiviNoti"></span>
                                       </div>
                                       <div class="col-md-6 form-group">
                                            <label for="brDis">Branch District</label>
                                            <select id="brDis" name="brDis" class="form-control">
                                                <option value="">Select Branch District</option>
                                            </select>
                                            <span id="brDisNoti"></span>
                                       </div>
                                       <div class="col-md-6 form-group">
                                            <label for="brname">Branch Name &nbsp;&nbsp;<span id="brnameNotice"></span></label>
                                            <select id="brname" name="brname" class="form-control">
                                                <option value="">Select Branch name</option>
                                            </select>
                                       </div>
                                       <div class="col-md-6 form-group">
                                            <label for="bruser">Branch User &nbsp;&nbsp;<span id="brnameNotice"></span></label>
                                            <select id="bruser" name="bruser" class="form-control">
                                                <option value="">Select Branch name</option>
                                            </select>
                                       </div>

                                       <div class="col-md-12 form-group">
                                            <label for="accPer">Permission</label>
                                            <select id="accPer" name="accPer" class="form-control">
                                                <option value="">Select a permission</option>
                                                <?php echo $slug;?>
                                            </select>
                                            <span id="accperNotice"></span>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button id="addBtn" type="submit" class="btn btn-primary" style="width:20%; margin-left:15px;">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div><!--/.col (left) -->
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
            $(document).ready(function(){
                // select branch district //
                $("#brDivi").change(function(){
                    var value = $(this).val();
                    $.ajax({
                        url:'allaction/br_district_select.php',
                        type:'post',
                        data:{value:value},
                        success:function(res){
                            var jsonData = JSON.parse(res);
                            $('#brDis').html('<option value="">Select Branch District</option>');
                            for(i = 0; i<jsonData.length;i++){
                                $("#brDis").append('<option value="'+jsonData[i].br_city+'">'+jsonData[i].br_city+'</option>');
                            }
                        }
                    });
                });

                // select branch name //
                $("#brDis").change(function(){ 
                    var dist = $(this).val();
                    $.ajax({
                        url:'allaction/br_name_select.php',
                        type:'post',
                        data:{value:dist},
                        success:function(res){
                            var jsonData = JSON.parse(res);
                            var rows = jsonData.length;
                            $('#brname').html('<option value="">Select branch name </option>');
                            for(i=0;i<rows;i++){
                                $("#brname").append('<option value="'+jsonData[i].id+'">'+jsonData[i].br_title+'</option>');
                            }
                        }
                    });
                });

                // select user name //
                $('#brname').change(function(){
                    var name = $(this).val();
                    $.ajax({
                        url:'allaction/user_name_select.php',
                        type:'post',
                        data:{data:name},
                        success:function(resp){
                            var jsonData = JSON.parse(resp);
                            var rows = jsonData.length;
                            $('#bruser').html('<option value="">Select branch name </option>');
                            for(i=0;i<rows;i++){
                                $("#bruser").append('<option value="'+jsonData[i].id+'">'+jsonData[i].user_fname+'</option>');
                            }
                        }
                    });

                });

                // add user permission 
                $("#addBtn").click(function(e){
                    e.preventDefault();
                    alert("Ok");
                });
            });

        </script>
    </body>
</html>