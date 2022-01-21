<?php 
    include('../../db/dbconnect.php');
    //session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | Card Charge </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Coustom StyleSheet -->
        <link rel="stylesheet" href="../../../../css/style.css">
        <!-- date picker -->
        <link rel="stylesheet" type="text/css" href="../../../../css/jquery-ui.css">
        <!-- Select2 -->
         <link rel="stylesheet" type="text/css" href="../../../../css/select2.min.css">
        
    </head>
    <body class="skin-blue">
        <?php
            include("../../database.php");
        ?>
        <!-- header logo: style can be found in header.less -->
        <?php include("../../../../header.php");?>        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
             <?php include("../../../../menu.php");?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Authorize Debit Charge</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Card Charge</a></li>
                        <li class="active">Charge Authorize</li>
                    </ol>
                </section>


                

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="box">
                               <div class="box-header">
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                  <!-- from -->
                                   <div class="tile-body">
                                    <form id="defaultForm" class="form-horizontal" name="info" action="show_charges.php" method="get" enctype="multipart/form-data">
                                      

                                      <div class="form-group row">
                                        <label class="control-label col-md-3">Branch Name</label>
                                        <div class="col-md-8">
                                          
                                          <select name="branch_id" id="branch_id" class="form-control">
                                            <option value="">ALL</option>
                                            <?php 
                                           $query =  mysql_query("SELECT  br_key, br_name  from branch where br_name <> '' ");
                                          while($data =  mysql_fetch_array($query))
                                          {
                                            ?>
                                            <option value="<?php echo $data['br_key'] ?>"><?php echo $data['br_name'] ?></option>

                                            <?php
                                          }


                                             ?>
                                            
                                          </select>
                                        </div>
                                      </div>

                                       <div class="form-group row">
                                        <label class="control-label col-md-3">Start Date</label>
                                        <div class="col-md-8">
                                          <input class="form-control" type="text" placeholder="Start Date" name="frm_dt" id="frm_dt">
                                        </div>
                                      </div>

                                       <div class="form-group row">
                                        <label class="control-label col-md-3">End Date</label>
                                        <div class="col-md-8">
                                          <input class="form-control" type="text" placeholder="End Date" name="to_dt" id="to_dt">
                                        </div>
                                      </div>

                                  <div class="tile-footer">
                                    <div class="row">
                                      <div class="col-md-8 col-md-offset-3">
                                        <button class="btn btn-primary" type="submit" id="submitbtn"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
                                      </div>
                                    </div>
                                  </div>
                                    </form>
                                  </div>

                                  <!-- from -->
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="../../../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../../../js/sweetalert.min.js"></script>
        <script src="../../../../js/jquery-ui.js"></script>
        <!-- select2 js -->
         <script src="../../../../js/select2.min.js"></script>
       <script>
        $(document).ready(function() {
       
         $("#frm_dt" ).datepicker();
         $("#to_dt" ).datepicker();
    });

       </script>
    </body>
</html>