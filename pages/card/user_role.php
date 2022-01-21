<?php require_once('../../login-authentication.php');?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | MIS</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <!-- <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
        <!-- Ionicons -->
        <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />

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
                    <h1>
                        Create User Role                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Role</a></li>
                        <li class="active">User roles - Account</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div id="msg">
                            <p style="margin-left:30px"></p>
                        </div>
                        <!-- left column -->
                        <div class="col-md-6 col-md-offset-3" style="left: 0px; top: 0px">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form id="userRoleForm" action="" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="mainMenu">Main Menu</label>
                                            <select id="mainMenu" name="mainMenu" class="form-control">
                                                <option value="">Select Primary Menu</option>
                                                <option value="1">value 1</option>
                                                <option value="2">value 2</option>
                                            </select>
                                            <span id="roleMenu"></span>
                                       </div>
                                       <div class="form-group">
                                            <label for="subMenu">Sub Menu</label>
                                            <select id="subMenu" name="subMenu" class="form-control">
                                                <option value="">Select Sub Menu</option>
                                                <option value="3">value 3</option>
                                                <option value="4">value 4</option>
                                            </select>
                                            <span id="roleSmenu"></span>
                                       </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" id="userRoleBtn" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                                <div id="test">
                                    
                                </div>
                            </div>
                        </div><!--/.col (left) -->
                        <!-- right column -->
                        <!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
               
        <script src="../../js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="../../js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="../../js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- date-range-picker -->
        <script src="../../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- bootstrap color picker -->
        <script src="../../js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
        <!-- bootstrap time picker -->
        <script src="../../js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>

        <script>
            $(document).ready(function(){

                $(document).on('submit',"#userRoleForm",function(event){
                    event.preventDefault();
                    var roleName = $("#roleName").val();
                    var menuName = $("#mainMenu").val();
                    var subName  = $("#subMenu").val();

                    if(roleName == ''){
                        $('#roleNotice').fadeIn(1000).text('Please fillup!').css("color", "red").fadeOut(4000);
                    }else if(menuName == ''){
                        $('#roleMenu').fadeIn(1000).text('Please Select one!').css("color", "red").fadeOut(4000);
                    }else if(subName == ''){
                        $('#roleSmenu').fadeIn(1000).text('Please Select one!').css("color", "red").fadeOut(4000);
                    }else{
                       $.ajax({
                            url:'allaction/user-role-action.php',
                            type:"post",
                            data:{name:roleName,pmenu:menuName,sname:subName},
                            success:function(resData){
                                document.getElementById('msg').innerHTML = resData;
                                var roleName = $("#roleName").val(' ');
                                var menuName = $("#mainMenu").val(' ');
                                var subName  = $("#subMenu").val(' ');
                                $('#msg').fadeOut(2000);
                            }
                        });
                    }

                });
            });

        </script>

    </body>
</html>