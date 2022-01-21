<?php //require_once('../../../login-authentication.php');?>
<?php 
    include('../../../db/dbconnect.php');
    //session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | User Report </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../../../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="../../../../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../../../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Coustom StyleSheet -->
        <link rel="stylesheet" href="../../../../../css/style.css">
        <link rel="stylesheet" type="text/css" href="../../../../../css/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="../../../../../css/select2.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <?php
            include("../../../database.php");
        ?>
        <!-- header logo: style can be found in header.less -->
        <?php include("../../../../../header.php");?>        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
             <?php include("../../../../../menu.php");?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> User Report </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Report</a></li>
                        <li class="active">User Report</li>
                    </ol>
                </section>

<!-- style -->
<style type="text/css">
  .page_loader{
    position: absolute;
    z-index: 1;
    left: 27%;
    width: 37%;
  }
</style>


<?php 
 if($_SESSION['branch_id'] == 1)
 {
   $branch =  '';

 }else{

   $branch = 'and id="'.$_SESSION['branch_id'].'" ';
 }

  $query = mysql_query("SELECT br_title, id from  branches where br_title <> '' $branch ");
  



  ?>
            <!-- style -->

                <!-- Main content -->
                <section class="content">
                  <!-- <img src="../../img/loader.gif" class="page_loader" alt="Page loader"> -->
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="box">
                               <div class="box-header">
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                  <!-- from -->
                                   <div class="tile-body">
                                     <form id="defaultForm" class="form-horizontal" name="info"  enctype="multipart/form-data">

                                  

                                     

                                      <label class="control-label" >Select  Branch</label>
                                      <div class="form-group row" style="margin-top: 10px;">
                                        <div class="col-md-10">
                                          <select name="branch" class="form-control" id="branch">
                                            <?php 
                                            if($_SESSION['role_id']=='6' || $_SESSION['role_id']=='1')
                                            {
                                              ?>
                                               <option value="">ALL</option>

                                              <?php
                                            }

                                             ?>
                                          
                                            <?php 
                                            while($result = mysql_fetch_assoc($query))
                                            {
                                              ?>
                                               <option value="<?php echo $result['id'] ?>"><?php echo $result['br_title'] ?></option>

                                              <?php
                                            }

                                             ?>
                                           
                                          </select>
                                        </div>
                                      </div>


                                      

                                      <label class="control-label" >Select  Status</label>
                                      <div class="form-group row" style="margin-top: 10px;">
                                        <div class="col-md-10">
                                          <select name="sts" class="form-control" id="sts">
                                           
                                          <option value="">ALL</option>
                                           <option value="1">Active</option>
                                           <option value="0">Inactive</option>
                                          </select>
                                        </div>
                                      </div>

                                       <div class="tile-footer">
                                    <div class="row">
                                      <div class="col-md-8">
                                        <button class="btn btn-primary" type="button" onclick="generateReport()"><i class="fa fa-fw fa-lg fa-check-circle"></i>Generate</button></div>
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
        <script src="../../../../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../../../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="../../../../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../../../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../../../../js/sweetalert.min.js"></script>
        <script src="../../../../../js/jquery-ui.js"></script>
        <script src="../../../../../js/select2.min.js"></script>


  <script>
      
     $(document).ready(function(){

     	$('#branch').select2();
     });

    function generateReport()
    {
      

      popupwindow = window.open("user_report_info.php?branch="+document.info.branch.value+'&sts='+document.info.sts.value, 'newWindow', 'top=200, width=800, height=500, left=500, scrollbars=1, toolbar=no, resizable=false');
    
    }

    
    </script>
    </body>
</html>