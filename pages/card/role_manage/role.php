<?php require_once('../../../login-authentication.php');?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | MIS Existing user list</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="../../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- select css -->
        <link href="../../../css/select2.min.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <?php
            include("../database.php");
        ?>    
    
        <!-- header logo: style can be found in header.less -->
        <?php include("../../../header.php");?>        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
             <?php include("../../../menu.php");?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>All Exsiting role</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Role</a></li>
                        <li class="active">All Exsiting role</li>
                    </ol>
                </section>  
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        
                        <div class="col-xs-4">
                            <div class="box">
                                 <!-- form start -->
                                <form id="roleSubmit" role="form" method="post" action="save_role.php">
                                    <div class="box-body">
                                        <div class="col-md-12" style="margin-top: 15px;">
                                            <div class="form-group">
                                                <label for="role_name">Role Name</label>
                                                <strong class="pull-right" style="color:red; margin-top:5px;">*</strong>
                                                <input type="text" id="role_name" name="role_name" placeholder="please enter Role" class="form-control">
                                                <span id="errorMsg"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="menu_name">Menu Name</label>
                                                <strong class="pull-right" style="color:red; margin-top:5px;">*</strong>
                                               <select  multiple="multiple"  name="menu_name[]" class="form-control menu_name">
                                                    <option value="">Select  Menu</option>

                                                    <?php 
                                                    $menus = mysql_query("SELECT menu_name, sl from menu_table where menu_name <> '' ");
                                                    while($result = mysql_fetch_assoc($menus))
                                                    {
                                                        ?>
                                                        <option value=" <?php echo $result['sl'] ?> "><?php echo $result['menu_name'] ?></option>

                                                        <?php
                                                    }

                                                     ?>
                                                   
                                                </select>
                                                <span id="nocErrorMsg"></span>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /box-body -->

                                    <div class="box-footer">
                                        <button type="" name="submit" class="btn btn-primary" id="submitbtn" style="width: 100%">Submit</button>
                                    </div>
                                </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- jQuery 2.0.2 -->
         <script src="../../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="../../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../../js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- select css -->
        <script src="../../../js/select2.min.js" type="text/javascript"></script>

        <script src="../../../js/sweetalert.min.js"></script>

        <!-- page script -->
        <script type="text/javascript">
            $(document).ready(function(){
                $('select').select2();

            });

            $('#submitbtn').click(function(e){

                 e.preventDefault();
                 
                 var role_name = $('#role_name').val();
                 var menu_name = $('.menu_name').val();

                 if(role_name == '')
                 {
                    swal('Please give role name');
                    return false;
                 }


                 $.ajax({
                        url:'save_role.php',
                        type:'post',
                        data:{role_name, menu_name},
                        success:function(recData){

                            swal(recData)
                            .then((value)=>{

                                location.reload();

                            });
                            
                        }
                    });
                 
                 
            })


           /* $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });

                // permission submit //
                $("#roleSubmit").click(function(e){
                    e.preventDefault();
                    var role = $("#role").val();
                    if(role==""){
                        $("#roleMsg").text("Please type role name!").fadeIn(100).css('color','red').fadeOut(4000);
                    }else{
                        $.ajax({
                            url:'allaction/permissionCreateAction.php',
                            type:'post',
                            data:{role:role},
                            success:function(recData){
                                console.log(recData);
                            }
                        });
                    }
                });

            });*/
        </script>

    </body>
</html>