<?php 
    include('db/dbconnect.php');
    //session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | Download Cib</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Coustom StyleSheet -->
        <link rel="stylesheet" href="../../../css/style.css">
        <link rel="stylesheet" type="text/css" href="../../../css/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="../../../css/select2.min.css">

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
                    <h1>Find  Card Request</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dishonour Card Request</li>
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
                <!-- style -->

                <!-- Main content -->
                <section class="content">
                      <img src="img/loader.gif" class="page_loader" alt="Page loader">
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
                                        <label class="col-md-12">Account Number</label>
                                        <div class="col-md-10">
                                          <input class="form-control" type="text"  name="account_number" placeholder="Account Number" id="account_number">
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
                        	?>

                        	  <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Account No</th>
                                                <th>Acc Name</th>
                                                <th>Phone</th>
                                                <th>Acc Type</th>
                                                <th>Status</th>
                                                <th>Open Date</th>
                                                <th>Balance</th>
                                                <th>Balance</th>
                                                <th>Request By</th>
                                                <th>Request Date</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            //6 for head office branch
                                            
                                            $debit_card_api = $conn->prepare("SELECT * FROM debit_card_api WHERE accountno <> '' and card_status ='approve' and status='2'  and accountno='$account_number' ");
                                            $debit_card_api->execute();
                                            while($rowData = $debit_card_api->fetch(PDO::FETCH_ASSOC)){
                                                $req = $conn->prepare("SELECT user_fname,user_lname FROM users WHERE user_id=?");
                                                $req->bindParam(1,$rowData['entry_by_id']);
                                                $req->execute();
                                                $rs = $req->fetch(PDO::FETCH_ASSOC); 
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
                                                <td><?php echo $rowData['accounttype']?></td>
                                                <td><?php echo $rowData['accstatus'];?></td>
                                                <td>
                                                    <?php
                                                     $date = $rowData['accdateofbirth'];
                                                     echo date('d-m-Y',strtotime($date));
                                                     ?>
                                                </td>
                                                <td><?php echo $rowData['bal_tk'];?></td>
                                                <td>
                                                    
                                                    <?php
                                                    $branch_id = $rowData['branch_id'];
                                                     $sql=mysql_query("SELECT br_title from branches where id = '$branch_id' ");
                                                     $result =mysql_fetch_array($sql);
                                                     echo  $result['br_title'];


                                                     ?>
                                                </td>
                                                <td><?php echo $rs['user_fname'].' '.$rs['user_lname'];?></td>
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

                                                <td>

                                                    <button class="btn btn-danger" onclick="Authorize('dishonour', '<?php echo $rowData['accountno'] ?>')" type="button">Dishonour</button>
                                                    
                                                  
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

                        	<?php
                        }


                         ?>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../js/sweetalert.min.js"></script>
        <script src="../../js/jquery-ui.js"></script>
        <script src="../../js/select2.min.js"></script>

        <script>

            $(document).ready(function(){

                 $('.page_loader').hide();
            });
        	
            // authorize function

            function Authorize(status, accno)
            {
                
                if(status !='' && accno !='')
                {
                    swal({
                          title: "DO YOU WANT DISHONOUR THIS ?? ",
                          icon: "success",
                          buttons: true,
                          dangerMode: true,
                        })
                    .then((value)=>{

                        $.ajax({
                            url:'allaction/debit_card_approve.php',
                            type:'post',
                            data:{accno:accno,status:status},
                            beforeSend: function() {
                               $('.page_loader').show();
                            },
                            success:function(resp){

                                swal(resp)
                                .then((value)=>{
                                    
                                     location.reload();
                                });
                               
                                
                            }
                        });


                    });

                    
                    
                }
                
               
                

            }
        </script>
    </body>
</html>