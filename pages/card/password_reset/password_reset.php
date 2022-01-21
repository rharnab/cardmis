<?php require_once('../../../login-authentication.php'); include('../database.php')?>
<?php 

$user_query = mysql_query("SELECT access_id from users where access_id <> '' ");
$user_id_append = '';
while($user_info = mysql_fetch_assoc($user_query))
{
    $user_id_append.= '   <option value="'.$user_info['access_id']. '">'.$user_info['access_id'].'</option> ';
}

 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card |Password Reset </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/select2.min.css" rel="stylesheet" type="text/css" />
        <!-- Custom StyleSheet -->
        <link rel="stylesheet" href="../../../css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include("../../../header.php");?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
             <?php include("../../../menu.php");?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Password Reset</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">User & Security </a></li>
                        <li class="active">Password Reset</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-4 col-md-offset-3">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <div id="successMsg" style="margin:5px;"></div>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form id="debitCardForm" role="form" method="post">
                                    <div class="box-body">
                                       
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 font-weight-bold" style="font-size: 15px;" >USER ID </label>
                                                 <div class="col-md-9">
                                                   <select name="user_id" id="user_id" class="form-control">
                                                       <option value="">Select User ID</option>
                                                       <?php echo $user_id_append; ?>
                                                   </select>
                                               </div>
                                                <span id="user_idErrorMsg"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /box-body -->

                                    <div class="box-footer">
                                        <button type="button" name="submit" class="btn btn-primary" id="submitbtn" style="width: 100%">Reset</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div><!--/.col (left) -->
                        
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <script src="../../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../../js/AdminLTE/app.js" type="text/javascript"></script>
                <!-- InputMask -->
        <script src="../../../js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="../../../js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="../../../js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- date-range-picker -->
        <script src="../../../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- bootstrap color picker -->
        <script src="../../../js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
        <!-- bootstrap time picker -->
        <script src="../../../js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <!-- js custom funtions -->
        <script src="../../../js/functions/functions.js"></script>
        <!-- sweet alert -->
         <script src="../../../js/sweetalert.min.js"></script>
         <script src="../../../js/select2.min.js"></script>

        <script>

           $('#user_id').select2();

           $('#submitbtn').click(function(){

                var user_id = $('#user_id').val();
                if(user_id == '')
                {
                    swal('Please Select USER ID ');
                }else{
                    swal({
                      title: "Do you want reset Password ?? ",
                      icon: "success",
                      buttons: true,
                      dangerMode: true,
                    })
                    .then((yes=>{
                        if(yes)
                        {
                                 $.ajax({
                                    type:'post',
                                    url:'save_reset_password.php',
                                    data:{user_id: user_id},
                                    success:function(data){

                                        swal(data)
                                        .then((value)=>{

                                            location.reload();
                                        })
                                    }
                                })
                        }

                    }));
                   
                }

           });

        </script>
    </body>
</html>