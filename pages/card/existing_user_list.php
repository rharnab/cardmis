<?php require_once('../../login-authentication.php');?>
<?php 
    include('db/dbconnect.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | MIS Existing user list</title>
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
                        All Existing users
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Admin</a></li>
                        <li class="active">All Existing users</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>User Name</th>
                                                <th>User ID</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Branch</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $select_users = mysql_query("SELECT u.*, r.role_name, br_title FROM users u 
                                                            left join role r on r.id = u.role_id
                                                            left join branches br on br.id = u.branch_id order by u.uid desc ");
                                            $sl=1;

                                            
                                            
                                            while($rowData = mysql_fetch_assoc($select_users)){
                                               
                                        ?>  
                                            <tr>
                                                <td><?php echo $sl++; ?></td>
                                                
                                                <td>
                                                    <?php 
                                                        echo $rowData['user_fname'].''.$rowData['user_lname'];
                                                    ?>   
                                                </td>
                                                <td><?php echo $rowData['access_id'];?></td>
                                                <td><?php echo $rowData['phone'];?></td>
                                                <td><?php echo $rowData['email'];?></td>
                                                <td><?php echo $rowData['br_title'];?></td>
                                                <td><?php echo $rowData['role_name'];?></td>
                                                <td>  <?php echo ($rowData['status']=='0') ? 'Inactive': 'Active'  ?>  </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary edit" id="<?php echo $rowData['uid'] ?>"> Edit</button>
                                                </td>

                                            </tr>
                                        <?php
                                            }
                                        ?>  
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- Modal -->
        <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Branch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
                 <!-- form start -->
                <form method="post" id="updateform">
                    <div class="box-body">
                        <div class="col-md-6 form-group">
                            <label for="user_fname">User First Name &nbsp;&nbsp;<span id="fnameNotice"></span></label>
                            <input type="text" id="user_fname" name="user_fname" placeholder="Enter User name" class="form-control">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="user_lname">User Last Name &nbsp;&nbsp;<span id="lnameNotice"></span></label>
                            <input type="text" id="user_lname" name="user_lname" placeholder="Enter User name" class="form-control">
                        </div>

                       <!--  <div class="col-md-6 form-group">
                            <label for="user_id">User Id &nbsp;&nbsp;<span id="user_idNotice"></span></label>
                            <input type="text" id="user_id" name="user_id" placeholder="Enter User code" class="form-control">
                        </div> -->

                          <div class="col-md-6 form-group">
                            <label for="status">User Status</label>
                            <select id="status" name="status" class="form-control">
                                <option value="">Select status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <span id="statusNotice"></span>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="brPhone">Phone &nbsp;&nbsp;<span id="phoneNotice"></span></label>
                            <input type="text" id="phone" name="phone" placeholder="Enter  phone number" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="brEmail">Email &nbsp;&nbsp;<span id="emailNotice"></span></label>
                            <input type="email" id="email" name="email" placeholder="Enter  email address" class="form-control">
                        </div>

                         <div class="col-md-6 form-group">
                            <label for="brEmail">User ID &nbsp;&nbsp;<span id="accessIdNotice"></span></label>
                            <input type="text" id="access_id" name="access_id" placeholder="Enter  email address" class="form-control">
                        </div>




                        <div class="col-md-6 form-group">
                            <?php 

                            $br_select = $conn->prepare("SELECT  br_title, id FROM branches where br_title <> '' order by br_title asc ");
                            $br_select->execute();
                            $br_data = '';
                            while($rowData = $br_select->fetch(PDO::FETCH_ASSOC)){
                                $br_data.="
                                    <option value='$rowData[id]'>$rowData[br_title]</option>
                                "; 
                            }

                             ?>

                            <label for="brDivi">Branch <span id="brnameNotice"></span></label>
                            <select id="branch_id" name="branch_id" class="form-control">
                                <option value="">Select Branch</option>
                                <?php echo $br_data;?>
                            </select>
                            <span id="branchNOtice"></span>
                        </div>



                         <div class="col-md-6 form-group">
                            <?php 

                            $role_select = mysql_query("SELECT  * FROM role where role_name <> '' order by role_name asc ");
                            $role_data = '';
                            while($rowData = mysql_fetch_assoc($role_select)){
                                $role_data.="
                                    <option value='$rowData[id]'>$rowData[role_name]</option>
                                "; 
                            }

                             ?>

                            <label for="brDivi">Role <span id="role_idNotice"></span></label>
                            <select id="role_id" name="role_id" class="form-control">
                                <option value="">Select Role</option>
                                <?php echo $role_data;?>
                            </select>
                            <span id="branchNOtice"></span>
                        </div>

                      

                         <input type="hidden" name="edit_id" id="edit_id">

                    </div><!-- /.box-body -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="submitBtn" class="btn btn-primary">Update</button>
                      </div>
                </form>


              </div>
              
            </div>
          </div>
        </div>


        <!-- modal -->


        <!-- jQuery 2.0.2 -->
       <script src="../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>

        <script src="../../js/sweetalert.min.js"></script>

        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });


             //branch edit data

            $('.edit').click(function(){

                var id =  $(this).attr('id');

                //$('#userModal').modal('show');


                if(id != '')
                {
                     $('.fetch_district').hide();
                     $('.select_district').show();
                    $.ajax({
                        type:'post',
                        url:'user_update/fetch_user_info.php',
                        data:{'id': id},
                        dataType: 'json',
                        success:function(data)
                        {
                            $("#user_fname").val(data.user_fname);
                            $("#user_lname").val(data.user_lname);
                            $("#status").val(data.status);
                            $("#brPhone").val(data.br_phone);
                            $("#phone").val(data.phone);
                            $("#email").val(data.email);
                            $("#access_id").val(data.access_id);
                            $("#branch_id").val(data.branch_id);
                            $("#edit_id").val(data.uid);
                            $("#role_id").val(data.role_id);
                            
                            $('#userModal').modal('show');
                            console.log(data);
                        }

                    })
                }

            }); // branch edit

            // select branch district //
                $("#brDivi").change(function(){
                    var value = $(this).val();
                    $.ajax({
                        url:'allaction/br_district_select.php',
                        type:'post',
                        data:{value:value},
                        success:function(res){
                            $('.fetch_district').show();
                            $('.select_district').hide();

                            var jsonData = JSON.parse(res);
                            $('#brDis').html('<option value="">Select Branch District</option>');
                            for(i = 0; i<jsonData.length;i++){
                                $("#brDis").append('<option value="'+jsonData[i].br_city+'">'+jsonData[i].br_city+'</option>');
                            }
                        }
                    });
                }); 



            //user update submit
            $(document).on('submit','#updateform',function(event){
                    event.preventDefault();
                    var brname   = $('#branch_id').val();
                    var fname    = $('#user_fname').val();
                    var lname    = $('#user_lname').val();
                    var phone    = $('#phone').val();
                    var email    = $('#email').val();
                    var accPer   = $('#role_id').val();
                    var access_id   = $("#access_id").val();
                    var status   = $("#status").val();
                    var edit_id   = $("#edit_id").val();
                    if(brname == ''){
                       $("#brnameNotice").fadeIn('fast').text('This field are required!').css("color", "red").fadeOut(2000); 
                    }else if(phone == ''){
                        $('#phoneNotice').fadeIn('fast').text('Phone number are required!').css("color", "red").fadeOut(2000);
                    }else if(email == ''){
                        $('#emailNotice').fadeIn('fast').text('Email address are required!').css("color", "red").fadeOut(2000);
                    }else if(access_id == ''){
                        $('#acc_id').fadeIn('fast').text('Please enter access ID !').css("color", "red").fadeOut(2000);
                    }else if(status == ''){
                        $('#statusNotice').fadeIn('fast').text('Please select Status !').css("color", "red").fadeOut(2000);
                    }else{

                        swal({
                          title: "DO YOU WANT TO EDIT THIS USER ?? ",
                          icon: "success",
                          buttons: true,
                          dangerMode: true,
                        })
                        .then((value)=>{

                            if(value)
                            {

                                $.ajax({
                                    url:'user_update/update_user.php',
                                    type:"post",
                                    data:{fname:fname,lname:lname,phone:phone,email:email,accPer:accPer,brname:brname, access_id:access_id, status: status, edit_id:edit_id},
                                    success:function(resData){
                                        
                                        swal(resData)
                                        .then((value)=>{
                                            location.reload();

                                        });

                                        
                                    }
                                });


                            }

                        });






                        
                    }
               });


        </script>

    </body>
</html>