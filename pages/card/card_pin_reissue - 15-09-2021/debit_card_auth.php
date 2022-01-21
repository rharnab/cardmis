<?php require_once('../../../login-authentication.php');?>
<?php 
    include('../db/dbconnect.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | MIS Branch Card Authentication</title>
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
        <!-- Coustom StyleSheet -->
        <link rel="stylesheet" href="../../../css/style.css">

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
                    <h1>Authentication Debit Card Pin Request</h1>
                    <div id="success"></div>
                    <div id="loading-image" style="text-align: center; display: none;">
                        <img src="../load.gif" alt="img">
                    </div>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Requisition</a></li>
                        <li class="active">Authentication Debit Card</li>
                    </ol>
                </section>
                 <section style="margin:15px; float:left;">
                    <div id="xmlMsg"></div>
                    <?php 
                    if($_SESSION['branch_id'] =='1')
                    {
                        ?>
                         <button   onclick="all_authorize('approve')"  class="btn btn-primary">All Authorize</button>

                        <?php
                    }else{
                        ?>
                             <button  onclick="all_authorize('1')" id="1" class="btn btn-primary">All Authorize</button>
                        <?php
                    }

                     ?>
                   
                </section>

 <!-- style -->
<style type="text/css">
  .page_loader{
    position: absolute;
    z-index: 1;
    left: 27%;
    width: 37%
  }
</style>

                <!-- Main content -->
                <section class="content">
                     <img src="../img/loader.gif" class="page_loader" alt="Page loader">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Account No</th>
                                                <th>Acc Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Card Name</th>
                                                <th>Acc Type</th>
                                                <th>Status</th>
                                                <th>Open Date</th>
                                                <th>Balance</th>
                                                <th>Branch</th>
                                                <th>Receving Branch</th>
                                                <th>Request For</th>
                                                <th>Request By</th>
                                                <th>Request Date</th>
                                                <th>Option</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            //3 for head office branch
                                            $user_id = $_SESSION['login_id'];
                                            $branch_id = $_SESSION['branch_id'];
                                            if($_SESSION['branch_id'] == '1')
                                            {
                                                  $branch_sql = " and  dcp.status='1' and dcp.card_status= '' ";
                                            }else{
                                                  $branch_sql = "and  dcp.status='0' and dcp.branch_id = '$branch_id' ";
                                            }

                                            
                                            $debit_card_api = mysql_query("SELECT dcp.*, en.user_fname, en.user_lname, br.br_title as request_branch, rcvbr.br_title as receiving_branch
                                                from debit_card_api dcp
                                                left join users en on en.user_id = dcp.entry_by_id
                                                left join branches br on br.id = dcp.branch_id
                                                left join branches rcvbr on rcvbr.id = dcp.receive_branch where dcp.accountno <> '' and request_type='5' $branch_sql ");
                                            
                                            while($rowData = mysql_fetch_assoc($debit_card_api)){

                                            //for showing card request
                                            if(trim($rowData['request_type']) == 2)
                                            {
                                               $request_type = 'Re-issue'; 

                                            }else if(trim($rowData['request_type']) == 3){
                                                $request_type = 'Card Active'; 
                                            }else if(trim($rowData['request_type']) == 4){
                                                $request_type = 'Card Block'; 
                                            }else if(trim($rowData['request_type']) == 5){
                                                $request_type = 'PIN Re-issue'; 
                                            }else{
                                                $request_type = '';
                                            }
                                                
                                        ?>  
                                            <tr>
                                                <td class="aaa"><?php echo $rowData['accountno'];?></td>
                                                <td><?php echo $rowData['accountname'];?></td>
                                                <td>
                                                    <?php echo '0'.$rowData['accphone'];?>
                                                    <br>
                                                    <?php 
                                                        echo $rowData['accotherphone']<=0? "": $rowData['accotherphone'];
                                                    ?>    
                                                </td>
                                                <td><?php echo $rowData['accotheremail'] ?></td>
                                                <td><?php echo $rowData['accnameoncard'] ?></td>
                                                <td><?php echo $rowData['accounttype']?></td>
                                                <td><?php echo $rowData['accstatus'];?></td>
                                                <td>
                                                    <?php
                                                     $date = $rowData['accdateofbirth'];
                                                     echo date('d-m-Y',strtotime($date));
                                                     ?>
                                                </td>
                                                <td><?php echo $rowData['bal_tk'];?></td>

                                                <td> <span style="font-weight: bold; color:blue; text-transform: uppercase;"><?php echo $rowData['request_branch'] ?> </span>   </td>

                                                <td>  <?php echo $rowData['receiving_branch'] ?> </td>

                                                <td> <span style="font-weight: bold; color:blue; text-transform: uppercase;"><?php echo $request_type ?> </span></td>

                                                <td><?php echo $rowData['user_fname'].' '.$rowData['user_lname'];?></td>
                                                <td>
                                                    <?php
                                                     $date = $rowData['requestDate'];
                                                     echo date('d-m-Y',strtotime($date));
                                                     ?>    
                                                </td>
                                                <!-- <td>
                                                    <select class="status_action">
                                                        <option value="">Wait for approve</option>
                                                        <option value="approve">Approve</option>
                                                        <option value="dishonour">Dishonour</option>
                                                    </select>    
                                                </td> -->

                                                  <!-- Modal -->
                                                    <div class="modal fade acc_modal_<?php echo $rowData['accountno'] ?>"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Dishonour Remarks</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                            </button>
                                                          </div>
                                                          <div class="modal-body">
                                                            <input type="text" class="form-control" name="remarks" id="remarks" placeholder="Remarks" >
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                             <?php 
                                                            if($_SESSION['branch_id'] =='1')
                                                            {
                                                                ?>
                                                          
                                                            <button class="btn btn-primary" onclick="Authorize('dishonour', '<?php echo $rowData['accountno'] ?>')" type="button">Dishonour</button>

                                                                <?php
                                                            }else{
                                                                ?>
                                                            
                                                            <button class="btn btn-primary" onclick="Authorize('5', '<?php echo $rowData['accountno'] ?>')" type="button">Dishonour</button>

                                                                <?php

                                                            }
                                                             ?>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!-- Modal -->

                                                <td>
                                                    
                                                     <button class="btn btn-danger" id="<?php echo $rowData['accountno'] ?>" onclick="dishonourBtn(id)" type="button">Dishonour</button>
                                                  
                                                </td>
                                                
                                            </tr>

                                            <?php $account_no = trim($rowData['accountno']); ?>
                                            <input type="text" name="account_no[]"  value="<?php echo $account_no ?>  " class="accounts">
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

        <!-- jQuery 2.0.2 -->
        <script src="../../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="../../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../../js/sweetalert.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('.accounts').hide();
                 $('.page_loader').hide();
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
            });



            //dishonourbtn modal show

            function dishonourBtn(accno)
            {

               $('.acc_modal_'+accno).modal('show');

            }

            // authorize function

            function Authorize(status, accno)
            {

                var remarks = $('#remarks').val();

                swal({
                      title: "Do you want to Dishonour this ?? ",
                      icon: "success",
                      buttons: true,
                      dangerMode: true,
                    })
                    .then((value)=>{

                        if(value){

                            $.ajax({
                                url:'debit_card_approve.php',
                                type:'post',
                                data:{accno:accno,status:status, remarks:remarks},
                                beforeSend: function() {
                                     $('.page_loader').show();
                                },
                                success:function(resp){
                                    swal(resp)
                                    .then((value)=>{
                                        location.reload();
                                    })
                                    
                                }
                            });

                        }

                    });

            }

            //all authorize function
            function all_authorize(status){

            
                swal({
                  title: "Do you want to authorize these  ?? ",
                  icon: "success",
                  buttons: true,
                  dangerMode: true,
                })
                .then((value)=>{
                    if(value)
                    {

                        var account_array_list = new Array();

                        $('.accounts').each(function(){

                            account_array_list.push(this.value);
                        })

                        if(status !='')
                        {

                            $.ajax({

                                    url:'debit_card_approve_all.php',
                                    type:'post',
                                    data:{status, account_array_list},
                                    beforeSend: function() {
                                       $('.page_loader').show();
                                    },
                                    success:function(data)
                                    {
                                        swal(data)
                                        .then((value)=>{
                                            location.reload();
                                        })

                                        //console.log(data)
                                    }

                            });

                        }

                    }
                })

            };
        
        </script>
    </body>
</html>