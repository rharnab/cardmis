<?php 
    include('../db/dbconnect.php');
    //session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | Request Details</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Coustom StyleSheet -->
        <link rel="stylesheet" href="../../../../css/style.css">
        <link rel="stylesheet" type="text/css" href="../../../../css/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="../../../../css/select2.min.css">

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
                    <h1>Find Debit Card Request Details</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Card Request Details</li>
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
  .info-title{
        font-size: 15px;
        font-weight: 600;
        color: #367fa9;  
    }

    .field_title {
        color: blue;
        font-weight: bold;
        font-size: 15px;
    }
</style>
                <!-- style -->
                <?php 
                if(isset($_GET['account_number']))
                {
                    $acc_no = trim($_GET['account_number']);
                }else{
                    $acc_no ='';
                }

                 ?>
                <!-- Main content -->
                <section class="content">
                     <img src="../img/loader.gif" class="page_loader" alt="Page loader">
                    <div class="row">
                        <div class="col-xs-6 col-xs-offset-3">
                            <div class="box">
                               <div class="box-header">
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                  <!-- from -->
                                   <div class="tile-body">
                                     <form id="defaultForm" class="form-horizontal" name="info" action="?" method="get" enctype="multipart/form-data">
                                  <div class="form-group row">
                                        <label class="col-md-12">Account Or Card Number</label>
                                        <div class="col-md-10">
                                          <input class="form-control" type="text"  name="account_number" placeholder="Account Or Card Number" id="account_number" value="<?php echo $acc_no; ?>">
                                        </div>
                                  </div>      

                                   <div class="tile-footer">
                                    <div class="row">
                                      <div class="col-md-8 col-md-offset-3">
                                        <button class="btn btn-primary" type="submit" id="downloadbtn_"><i class="fa fa-fw fa-lg fa-check-circle"></i>Search</button></div>
                                      </div>
                                    </div>
                                  </form>
                                  </div>

                                  <!-- from -->
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>

                        <?php 
                        if(isset($_GET['account_number']))
                        {
                            $account_number = trim($_GET['account_number']);

                            $query = mysql_query("SELECT dcp.*, en.user_fname, en.user_lname, br.br_title as request_branch, rcvbr.br_title as receiving_branch, issue.br_title as issue_branch,
                                                    app.user_fname as app_fname, app.user_lname as app_lname, brapp.user_fname as brapp_fname, brapp.user_lname as brapp_lname
                                                    from debit_card_api dcp
                                                    left join users en on en.user_id = dcp.entry_by_id
                                                    left join branches br on br.id = dcp.branch_id
                                                    left join branches rcvbr on rcvbr.id = dcp.receive_branch
                                                    left join branches issue on issue.id = dcp.issue_branch
                                                    left join users app on app.user_id = dcp.approve_by_id
                                                    left join users brapp on brapp.user_id = dcp.br_approve_id
                                                    where   dcp.accountno <> '' and (dcp.accountno = '$account_number' or card_number='$account_number' ) ");
                            $rowData = mysql_fetch_assoc($query);

                            //approve status
                            if($rowData['card_status'] =='' && $rowData['status']== '0')
                            {
                                $sts = "PENDING";
                            }else if($rowData['card_status'] =='' && $rowData['status']== '1')
                            {
                                $sts = "BRANCH AUTHORIZED";
                            }else if($rowData['card_status'] =='dishonour' && $rowData['status']== '5')
                            {
                                $sts = "DISHONOURED";
                            }else if($rowData['status']== '5')
                            {
                                $sts = "DISHONOURED";
                            }else{
                                $sts ='APPROVED';
                            }

                            //Request type
                            if($rowData['request_type'] == '1')
                            {
                                $req_type = 'New Card Requisition';
                            }else if($rowData['request_type'] == '2')
                            {
                                $req_type = 'Re-issue';
                            }else if($rowData['request_type'] == '3')
                            {
                                $req_type = 'Card Activation';
                            }else if($rowData['request_type'] == '4')
                            {
                                $req_type = 'Card Blocked';
                            }else if($rowData['request_type'] == '5')
                            {
                                $req_type = 'Pin Changed';
                            }else{
                                $req_type = '';
                            }


                            //request for
                           if(trim($rowData['reason']) == 1)
                            {
                               $reason = 'Stolen'; 

                            }else if(trim($rowData['reason']) == 2){
                                $reason = 'Lost'; 
                            }else if(trim($rowData['reason']) == 3){
                                $reason = 'Damaged'; 
                            }else if(trim($rowData['reason']) == 4){
                                $reason = 'Surname Change'; 
                            }else if(trim($rowData['reason']) == 5){
                                $reason = 'Expired'; 
                            }else{
                                $reason = '';
                            }

                            ?>

                         <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <span class="info-title">Personal Information</span>
                                             <table id="example1" class="table table-bordered table-striped table-hover table-responsive" style="margin-top: 10px">
                                                <tr>
                                                    <td>Name</td>
                                                    <td><?php echo $rowData['accountname'] ?></td>
                                                </tr>

                                                 <tr>
                                                    <td>Father Name</td>
                                                    <td><?php echo $rowData['accfather'] ?></td>
                                                </tr>

                                                 <tr>
                                                    <td>Mother Name</td>
                                                     <td><?php echo $rowData['accmother'] ?></td>
                                                </tr>


                                                 <tr>
                                                    <td>Date Of Birth</td>
                                                     <td><?php echo $rowData['accdateofbirth'] ?></td>
                                                </tr>

                                                <tr>
                                                    <td>Gender</td>
                                                   <td><?php echo $rowData['accsex'] ?></td>
                                                </tr>

                                                 <tr>
                                                    <td>Address</td>
                                                     <td><?php echo $rowData['accaddress'] ?></td>
                                                </tr>

                                                <tr>
                                                    <td>Phone Number</td>
                                                    <td><?php echo $rowData['accphone'] ?></td>
                                                </tr>

                                                <tr>
                                                    <td>Email</td>
                                                     <td><?php echo $rowData['accotheremail'] ?></td>
                                                </tr>
                                            </table>
                                            
                                        </div>

                                         <div class="col-md-6">
                                             <span class="info-title">Account Information</span>
                                            <table id="example1" class="table table-bordered table-striped table-hover table-responsive" style="margin-top: 10px">
                                                <tr>
                                                    <td>Account No</td>
                                                    <td><?php echo $rowData['accountno'] ?></td>
                                                </tr>

                                                <tr>
                                                    <td>Account Type</td>
                                                    <td><?php echo $rowData['accounttype'] ?></td>
                                                </tr>

                                                 <tr>
                                                    <td>Account Status</td>
                                                     <td><?php echo $rowData['accstatus'] ?></td>
                                                </tr>

                                                 <tr>
                                                    <td>Card NO</td>
                                                     <td><?php echo $rowData['card_number'] ?></td>
                                                </tr>

                                                 <tr>
                                                    <td>Name On Card</td>
                                                     <td><?php echo $rowData['accnameoncard'] ?></td>
                                                </tr>

                                                 <tr>
                                                    <td>Card Type</td>
                                                     <td><?php echo $rowData['card_type'] ?></td>
                                                </tr>

                                                 <tr>
                                                    <td>Request Date</td>
                                                    <td><?php echo $rowData['requestDate'] ?></td>
                                                </tr>

                                                 <tr>
                                                    <td>Approve Date</td>
                                                    <td><?php echo $rowData['approve_date']." ".$rowData['ho_auth_time'] ?></td>
                                                </tr>
                                            </table>
                                            
                                        </div>
                                    </div>
                                    <br>
                                      <span class="info-title">Other Information</span>
                                       <table id="example1" class="table table-bordered table-striped table-hover table-responsive" style="margin-top: 10px">

                                        <tr style="text-align: center;">
                                            <td style="background-color: #367fa9; color: white;">Approve Status</td>
                                            <td  colspan="6" style="background-color: #367fa9; color: white;">


                                                <?php echo $sts; ?></td>
                                        </tr>

                                         <tr>
                                            <td class="field_title">Request Type</td>
                                            <td><?php echo $req_type; ?></td>
                                            <td class="field_title">Reason</td>
                                            <td><?php echo $reason ?></td>
                                            <td class="field_title">Remarks</td>
                                            <td><?php echo $rowData['remarks'] ?></td>

                                        </tr>

                                        <tr>
                                            <td class="field_title">Request Branch</td>
                                            <td><?php echo $rowData['request_branch'] ?></td>

                                            <td class="field_title">Issue Branch</td>
                                            <td><?php echo $rowData['issue_branch'] ?></td>

                                            <td class="field_title">Receiving Branch</td>
                                            <td><?php echo $rowData['receiving_branch'] ?></td>
                                        </tr>

                                        <tr>
                                            <td class="field_title">Request By</td>
                                            <td><?php echo $rowData['user_fname']."  ".$rowData['user_lname'] ?></td>

                                            <td class="field_title">Branch Authorized By</td>
                                           <td><?php echo $rowData['brapp_fname']."  ".$rowData['brapp_lname'] ?></td>

                                            <td class="field_title">Head Office Authorized By</td>
                                               <td><?php echo $rowData['app_fname']."  ".$rowData['app_lname'] ?></td>
                                        </tr>

                                       
                                       </table>


                                   
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>


                            <?php
                        }


                         ?>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="../../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../../js/sweetalert.min.js"></script>
        <script src="../../../js/jquery-ui.js"></script>
        <script src="../../../js/select2.min.js"></script>

        <script>

            $(document).ready(function(){

                 $('.page_loader').hide();
            });
            
        </script>
    </body>
</html>