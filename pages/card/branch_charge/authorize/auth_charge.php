<?php 
    include('../../db/dbconnect.php');
    //session_start();


    if(isset($_GET['status']))
    {
      if($_GET['status'] == 1 )
      {
         echo "<script>alert('Charges successfully authorize');</script>";
      }else if($_GET['status'] == 2)
      {
        echo "<script>alert('Sorry ! Authorize not Complete yet ')</script>";

      }else if($_GET['status'] == 3)
      {
        echo "<script>alert('Charges successfully Deleted ')</script>";

      }else if($_GET['status'] == 4)
      {
        echo "<script>alert('Sorry ! Debit charges not deleted')</script>";

      }
     
    }
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
                                    <form id="defaultForm" class="form-horizontal" name="info" action="?" method="get" enctype="multipart/form-data">
                                      

                                      <div class="form-group row">
                                        <label class="control-label col-md-3">Branch Name</label>
                                        <div class="col-md-8">
                                          
                                          <select name="branch_id" id="branch_id" class="form-control">
                                            <option value="">ALL</option>
                                            <?php 
                                           $query =  mysql_query("SELECT  id, br_title  from branches where br_title <> '' ");
                                          while($data =  mysql_fetch_array($query))
                                          {
                                            ?>
                                            <option value="<?php echo $data['id'] ?>"><?php echo $data['br_title'] ?></option>

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
                  <!-- authorize section data -->
                <?php 
                if(isset($_GET['frm_dt']) && isset($_GET['to_dt']))
                {
                  ?>


                      <div class="col-xs-8">
                            <div class="box">
                               <div class="box-header">
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                     <div class="tile-body">
                                        <form action="confirm_authorize.php" method="post" accept-charset="utf-8">



                                          <div class="tile-footer" style="text-align: right;">
                                              <div class="row">
                                                <div class="col-md-12">
                                                  <button class="btn btn-primary" name="submit" type="submit" id="submitbtn"><i class="fa fa-fw fa-lg fa-check-circle"></i>Authorize</button>

                                                   <button class="btn btn-danger" name="decline" type="submit" id="submitbtn"><i class="fa fa-fw fa-lg fa-check-circle"></i>Decline</button>

                                                   <!-- <a class="btn btn-primary" style="color: white" href='<?php echo "all_charge_action.php?" . $_SERVER['QUERY_STRING']; ?>'>All Authorize</a> -->
                                                  
                                                </div>
                                              </div>
                                            </div>

                                            <br>
                                          <table class="table  table-bordered">
                                            <thead style="background-color: #5D9ED1; color: black">
                                              <tr>
                                                <th><a style="color: black" href='<?php echo "tempCostReportInfoXlsx.php?" . $_SERVER['QUERY_STRING']; ?>' target="_blank">All Authorize</a></th>
                                                <th>SL</th>
                                                <th>Account Number</th>
                                                <th>Card Number</th>
                                                <th>Amount</th>
                                                <th>Branch</th>
                                                <th>Upload Date</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <?php
                                                      $branch_id =  $_GET['branch_id'];
                                                      $url_frm =$_GET['frm_dt'];
                                                      $url_to = $_GET['to_dt'];
                                                      /*$frm = date('Y-m-d', strtotime($_GET['frm_dt']));
                                                      $to = date('Y-m-d', strtotime($_GET['to_dt']));*/
                                                      $frm_dt = explode('/', $_GET['frm_dt']);
                                                      $frm = $frm_dt[2]."-".$frm_dt[1]."-".$frm_dt[0];
                                                      $to_dt = explode('/', $_GET['to_dt']);
                                                      $to = $to_dt[2]."-".$to_dt[1]."-".$to_dt[0];
                                                      if($branch_id !='')
                                                      {
                                                        $branch_sql = " and branch_id='$branch_id' ";
                                                      }else{

                                                        $branch_sql = '';
                                                      }

                                                 $q =mysql_query("SELECT bdc.*, b.br_title from branch_debit_charge bdc
                                                                        left join branches b on bdc.branch_id = b.id
                                                                        where account_no <> '' and card_no <> '' and status='0'  and upload_dt between '$frm' and '$to' $branch_sql ");

                                                 $sl=1;

                                                if(mysql_num_rows($q) > 0)

                                                {

                                                 while( $result = mysql_fetch_array($q))
                                                 {
                                                  ?>

                                                     <tr>
                                                     <td><input  type="checkbox" class="blankCheck" name="auth_id[]" value="<?php echo $result['sl'] ?>"></td>
                                        
                                                              <td><?php echo $sl++; ?></td>
                                                      <td><?php echo $result['account_no'] ?></td>
                                                      <td><?php echo $result['card_no'] ?></td>
                                                      <td><?php echo $result['charge_amount'] ?></td>
                                                      <td><?php echo $result['br_title'] ?></td>
                                                      <td><?php echo $result['upload_dt'] ?></td>
                                                    
                    
                                                    </tr>

                                                  <?php
                                                 }

                                               }else{
                                                ?>

                                                  <tr style="color: red; text-align: center;">
                                                    <td colspan="7"><span> Data not found </span></td>
                                                  </tr>

                                                <?php
                                               }

                                               ?>

                                                       <input type="hidden" name="branch_id" value="<?php echo $branch_id; ?>">

                                                        <input type="hidden" name="frm" value="<?php echo $url_frm; ?>">
                                                        <input type="hidden" name="to" value="<?php echo $url_to; ?>">
                                                


                                             
                                            </tbody>
                                          </table>

                                        </form>
                                     </div>
                                 </div>
                            </div>
                      </div>


                    <?php
                  }

                   ?>

                     <!-- end  authorize section data -->






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
       
             $("#frm_dt" ).datepicker({dateFormat: 'dd/mm/yy'});
             $("#to_dt" ).datepicker({dateFormat: 'dd/mm/yy'});
        });



       </script>
    </body>
</html>