<?php require_once('../../../../login-authentication.php');?>
<?php 
    include('../../db/dbconnect.php');
   //session_start();
?>
<?php
 include("../../database.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | All Payment Method</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="../../../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Coustom StyleSheet -->
        <link rel="stylesheet" href="../../../../css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        
        <!-- header logo: style can be found in header.less -->
        <?php include("../../../../header.php");?>        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
             <?php include("../../../../menu.php");?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>All Payment Method </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Utility</a></li>
                        <li><a href="#">Paremeter</a></li>
                        <li class="active">All Payment Method</li>
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
                                                <th>SL</th>
                                                <th>Value</th>
                                                <th>Description</th>
                                                <th>Option</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php 
                                                    $sql = mysql_query("SELECT * from payment_method where description<> '' order by payment_method_id desc ");
                                                    $sl=1;
                                                    while($result = mysql_fetch_array($sql))
                                                    {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $sl++; ?></td>
                                                                <td><?php echo  $result['value'] ?></td>
                                                                <td><?php echo  $result['description'] ?></td>
                                                                <td>  
                                                                    <button type="button"  id="<?php echo $result['payment_method_id'] ?>" class="btn btn-primary edit_contract">Edit</button>
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

                <!-- modal -->
               
                    <!-- The modal -->
                    <div class="modal" id="largeShoes" tabindex="-1" role="dialog" aria-labelledby="modalLabelLarge" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="modalLabelLarge">Edit Payment Method</h4>
                    </div>

                    <div class="modal-body">  

                        <form method="post" action="" id="formdeafult">
                                <div class="box-body">
                                    <div class="col-md-6 form-group">
                                        <label for="value">Value &nbsp;&nbsp;<span id="valueNotice"></span></label>
                                         <input type="text" id="value" name="value" placeholder="Enter Value" class="form-control">
                                    </div>
                                    
                                    <div class="col-md-6 form-group">
                                        <label for="description">Description &nbsp;&nbsp;<span id="descriptionNotice"></span></label>
                                        <input type="text" id="description" name="description" placeholder="Enter Description " class="form-control">
                                    </div>
                       
                                    <input type="hidden" name="hidden_id" id="hidden_id">
                                 </div><!-- /.box-body -->

                                <div class="box-footer">
                                    <button id="editbtn"  type="button" value="update" name="submit"  class="btn btn-primary" style="margin-left:15px">EDIT</button>
                                </div>
                      </form>

                    </div>

                    </div>
                    </div>
                    </div>
                <!-- end  modal -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
       <script src="../../../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="../../../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../../../js/sweetalert.min.js"></script>

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

            //fetch contract data
            $('.edit_contract').on('click', function(){

                var id = $(this).attr('id');

                $.ajax({
                    type:'Post',
                    data:{'id':id},
                    url:"fetch_payment_method.php",
                    dataType:"json",
                    success:function(data)
                    {
                       $('#value').val(data.value);
                       $('#description').val(data.description);
                       $('#hidden_id').val(data.payment_method_id);
                       $('#largeShoes').modal('show');
                    }
                })
                
            })


            //save contract phase data

             $('#editbtn').on('click', function(e){

              var form = $('#formdeafult')[0];
              var formdata = new FormData(form);
              var value_data = formdata.get('value');
              var description = formdata.get('description');

              if(value_data !='' && description !='')
              {

                $.ajax({
                    type:'Post',
                    data:formdata,
                    url:"edit_payment_method.php",
                    processData: false,
                    contentType: false,
                    
                    success:function(data)
                    {
                       swal(data)
                       .then((yes)=>{

                            location.reload();
                       })

                    }
                })

              }
               

                
                
            })

        </script>
    </body>
</html>