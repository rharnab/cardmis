<?php require_once('../../login-authentication.php');?>
<?php 
    include('db/dbconnect.php');
    
    $br_select = $conn->prepare("SELECT DISTINCT br_division FROM branches where br_division <>'' ");
    $br_select->execute();
    $br_data = '';
    while($rowData = $br_select->fetch(PDO::FETCH_ASSOC)){
        $br_data.="
            <option value='$rowData[br_division]'>$rowData[br_division]</option>
        "; 
    }

    // get all role data //
    $role_select = $conn->prepare('SELECT * FROM role');
    $role_select->execute();
    $roleData = '';
    while($rowData = $role_select->fetch(PDO::FETCH_ASSOC)){
        $roleData.="
            <option value='$rowData[id]'>$rowData[role_name]</option>
        ";       
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | MIS Create new user</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
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
                    <h1>Create New User</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Admin Panel</a></li>
                        <li class="active">New User create</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-10" id="msg">
                            <p style="margin-left:30px"></p>
                        </div>
                        <!-- left column -->
                        <div class="col-md-10" style="left: 0px; top: 0px">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form id="userCreate" action="" method="post">
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
                                            <label for="accPer">Access Permission</label>
                                            <select id="accPer" name="accPer" class="form-control">
                                                <option value="">Permission roles</option>
                                                <?php echo $roleData;?>
                                            </select>
                                            <span id="accperNotice"></span>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label for="fname">First Name &nbsp;&nbsp;<span id="fnameNotice"></span></label>
                                            <input type="text" id="fname" name="fname" placeholder="Enter first name" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="lname">Last Name &nbsp;&nbsp;<span id="lnameNotice"></span></label>
                                            <input type="text" id="lname" name="lname" placeholder="Enter lirst name" class="form-control">
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label for="lname">User ID &nbsp;&nbsp;<span id="acc_id"></span></label>
                                            <input type="text" id="access_id" name="access_id" placeholder="Enter Usser ID" class="form-control">
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label for="phone">Phone &nbsp;&nbsp;<span id="phoneNotice"></span></label>
                                            <input type="text" id="phone" name="phone" placeholder="Enter user phone number" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="email">Email &nbsp;&nbsp;<span id="emailNotice"></span></label>
                                            <input type="email" id="email" name="email" placeholder="Enter user email address" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="password">Password &nbsp;&nbsp;<span id="passwordNotice"></span></label>
                                            <input type="password" id="password" name="password" maxlength="6" placeholder="Create password" class="form-control">
                                        </div>
                                        
                                        <div class="col-md-6 form-group">
                                            <label for="status">User Status</label>
                                            <select id="status" name="status" class="form-control">
                                                <option value="">Select status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            <span id="statusNotice"></span>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" style="width: 100%">Submit</button>
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
        <script src="../../js/jquery.min.js"></script>
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

                // create new users //
               $(document).on('submit','#userCreate',function(event){
                    event.preventDefault();
                    var brname   = $('#brname').val();
                    var fname    = $('#fname').val();
                    var lname    = $('#lname').val();
                    var phone    = $('#phone').val();
                    var email    = $('#email').val();
                    var password = $("#password").val();
                    var accPer   = $('#accPer').val();
                    var status   = $("#status").val();
                    var access_id   = $("#access_id").val();
                    if(brname == ''){
                       $("#brnameNotice").fadeIn('fast').text('Please select assigned branch').css("color", "red").fadeOut(2000); 
                    }else if(phone == ''){
                        $('#phoneNotice').fadeIn('fast').text('Phone number are required!').css("color", "red").fadeOut(2000);
                    }else if(email == ''){
                        $('#emailNotice').fadeIn('fast').text('Email address are required!').css("color", "red").fadeOut(2000);
                    }else if(password == ''){
                        $('#passwordNotice').fadeIn('fast').text('Please enter new password!').css("color", "red").fadeOut(2000);
                    }else if(access_id == ''){
                        $('#acc_id').fadeIn('fast').text('Please enter User ID !').css("color", "red").fadeOut(2000);
                    }else{
                        $.ajax({
                            url:'allaction/new_user_create.php',
                            type:"post",
                            data:{fname:fname,lname:lname,phone:phone,email:email,accPer:accPer,brname:brname,status:status,password:password, access_id:access_id},
                            success:function(resData){
                                document.getElementById('msg').innerHTML = resData;
                                $("#brDivi").val('');
                                $("#brDis").val('');
                                $('#fname').val('');
                                $('#lname').val('');
                                $('#phone').val('');
                                $('#email').val('');
                                $('#accPer').val('');
                                $('#brname').val('');
                                $("#password").val('');
                                $("#status").val('');
                                //$('#msg').fadeOut(4000);
                                //window.location.reload();

                                console.log(resData)
                            }
                        });
                    }
               });

            });

        </script>

    </body>
</html>