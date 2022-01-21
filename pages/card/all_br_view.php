<?php require_once('../../login-authentication.php');?>

<?php 
    include('db/dbconnect.php');

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | All Branches View</title>
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
                    <h1>All Branches View</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Utility</a></li>
                        <li class="active">All Branches View</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Branch Code</th>
                                                <th>Branch Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>District</th>
                                                <th>Branch Address</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $branches_view = $conn->prepare("SELECT * FROM branches order by id desc");
                                            $branches_view->execute();
                                            while($rowData = $branches_view->fetch(PDO::FETCH_ASSOC)){
                                        ?>  
                                            <tr>
                                                <td><?php echo $rowData['br_code'];?></td>
                                                <td><?php echo $rowData['br_title'];?></td>
                                                <td><?php echo $rowData['br_phone'];?></td>
                                                <td><?php echo $rowData['br_email'];?></td>
                                                <td><?php echo $rowData['br_city'];?></td>
                                                <td><?php echo $rowData['br_address'];?></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary edit" id="<?php echo $rowData['id'] ?>"> Edit</button>   
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


        <!-- modal -->


        <!-- Modal -->
        <div class="modal fade" id="branchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            <label for="brName">Branch Name &nbsp;&nbsp;<span id="nameNotice"></span></label>
                            <input type="text" id="brName" name="brName" placeholder="Enter branch name" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="brCode">Branch Code &nbsp;&nbsp;<span id="codeNotice"></span></label>
                            <input type="text" id="brCode" name="brCode" placeholder="Enter branch code" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="brPhone">Branch Phone &nbsp;&nbsp;<span id="phoneNotice"></span></label>
                            <input type="text" id="brPhone" name="brPhone" placeholder="Enter branch phone number" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="brEmail">Branch Email &nbsp;&nbsp;<span id="emailNotice"></span></label>
                            <input type="email" id="brEmail" name="brEmail" placeholder="Enter branch email address" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="brSwiftCode">Branch swift code</label>
                            <input type="text" id="brSwiftCode" name="brSwiftCode" placeholder="Enter branch swift code" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <?php 

                            $br_select = $conn->prepare("SELECT DISTINCT br_division FROM branches where br_division <> '' ");
                            $br_select->execute();
                            $br_data = '';
                            while($rowData = $br_select->fetch(PDO::FETCH_ASSOC)){
                                $br_data.="
                                    <option value='$rowData[br_division]'>$rowData[br_division]</option>
                                "; 
                            }

                             ?>

                            <label for="brDivi">Branch Division</label>
                            <select id="brDivi" name="brDivi" class="form-control">
                                <option value="">Select Branch Division</option>
                                <?php echo $br_data;?>
                            </select>
                            <span id="brDiviNoti"></span>
                        </div>
                        <div class="col-md-6 form-group fetch_district">
                            <label for="brDis">Branch District</label>
                            <select id="brDis" name="brDis" class="form-control">
                                <option value="">Select Branch District</option>
                            </select>
                            <span id="brDisNoti"></span>

                        </div>

                         <div class="col-md-6 form-group select_district">
                            <label for="brDistrict">Branch District &nbsp;&nbsp;<span id="upazilaNotice"></span></label>
                            <input type="text" id="brDistrict" readonly="readonly" name="brDistrict" placeholder="Enter branch upazila name" class="form-control">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="brAddress">Branch Address &nbsp;&nbsp;<span id="addNotice"></span></label>
                            <input type="text" id="brAddress"  name="brAddress" placeholder="Enter branch address" class="form-control">
                        </div>

                         <input type="hidden" name="branch_id" id="branch_id">

                    </div><!-- /.box-body -->
                </form>


              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="submitBtn" class="btn btn-primary">Update</button>
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
        <script type="text/javascript">

            $(document).ready(function(){

                $('.fetch_district').hide();

            });



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

                // create xml file //
                $(document).on('click','#xmlBtn',function(){
                    $.ajax({
                        url:'allaction/xml_file_create.php',
                        success:function(res){
                            document.getElementById('xmlMsg').innerHTML = res;
                            $("#xmlMsg").fadeIn('fast').fadeOut(1000);
                            var url = window.location;
                            url.reload();
                        }
                    });
                });
            });

            //branch edit data

            $('.edit').click(function(){

                var id =  $(this).attr('id');

                if(id != '')
                {
                     $('.fetch_district').hide();
                     $('.select_district').show();
                    $.ajax({
                        type:'post',
                        url:'branch_update/fatch_branch_info.php',
                        data:{'id': id},
                        dataType: 'json',
                        success:function(data)
                        {
                            $("#brName").val(data.br_title);
                            $("#brCode").val(data.br_code);
                            $("#brPhone").val(data.br_phone);
                            $("#brEmail").val(data.br_email);
                            $("#brSwiftCode").val(data.swift_code);
                            $("#brDivi").val(data.br_division);
                            $("#brDistrict").val(data.br_city);
                            $("#brAddress").val(data.br_address);
                            $("#branch_id").val(data.id);
                            $('#branchModal').modal('show');
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



            //update branch
            $(document).ready(function(){
                $('#submitBtn').click(function(event){
                    event.preventDefault();
                    if($("#brName").val() == ''){
                        $("#nameNotice").fadeIn('fast').text("This field are required").css('color','red').fadeOut(2000);
                    }else if($("#brCode").val() == ''){
                        $("#codeNotice").fadeIn('fast').text("This field are required").css('color','red').fadeOut(2000);
                    }/*else if($("#brPhone").val() == ''){
                        $("#phoneNotice").fadeIn('fast').text("This field are required").css('color','red').fadeOut(2000);
                    }else if($("#brEmail").val() == ''){
                        $("#emailNotice").fadeIn('fast').text("This field are required").css('color','red').fadeOut(2000);
                    }*/else if($("#brAddress").val() == ''){
                        $("#addNotice").fadeIn('fast').text("This field are required").css('color','red').fadeOut(2000);
                    }else{
                        // send data //
                        var form = $('#updateform')[0];
                        var formdata = new FormData(form);

                        $.ajax({
                            url:'branch_update/update_branch.php',
                            type:'post',
                            data:formdata,
                            contentType:false,
                            processData:false,
                            success:function(resData){
                                swal(resData)
                                .then((value) =>{

                                     location.reload();
                                })
                                //console.log(resData);
                            }
                        });

                        

                        //console.log(formdata);


                    }//else        
                });
            });



        </script>
    </body>
</html>