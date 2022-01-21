<?php include("../../../database.php");?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>User Report</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../../../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../../../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="../../../../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../../../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Coustom StyleSheet -->
        <link rel="stylesheet" href="../../../../../css/style.css">
        <link rel="stylesheet" type="text/css" href="../../../../../css/jquery-ui.css">

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
        <?php //include("../../../../header.php");?>        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
             <?php //include("../../../../menu.php");?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side" style="margin-left: 0px !important;">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <!-- <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">CIB</a></li>
                        <li class="active">Error Report</li>
                    </ol> -->
                </section>

                <!-- style -->

                <!-- Main content -->
                <section class="content">
                  <!-- <img src="../../img/loader.gif" class="page_loader" alt="Page loader"> -->
                    <div class="row">
                       <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">

                                <?php
                              

                                $sts = $_GET['sts'];

                                if($sts !='')
                                {
                                	$condition = "and u.status= '$sts'  ";
                                }else{
                                	$condition='';
                                }


                                $branch = $_GET['branch'];

                                if($branch !='')
                                {
                                    $branch_sql = "and u.branch_id= '$branch'  ";
                                }else{
                                    $branch_sql='';
                                }


                               
                            
                                 
                                ?>

                          
                                <div class="table-responsive" style="overflow-x: auto">
                                  <table class="table table-bordered userlistTable" style="font-size: 12px">
                                        <thead style="background-color: #009688; color: white; text-transform: uppercase;">
                                          <tr>
                                                <th>SL</th>
                                                <th>User Name</th>
                                                <th>User ID</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Branch Name</th>
                                                <th>Role Name</th>
                                                <th>Status</th>
                                                
                                            </tr>

                                        </thead>
                                        <tbody>


                                        		<?php 

                                        		$user_query = mysql_query("SELECT u.user_fname, u.user_lname, u.access_id, u.phone, u.email, u.status, br.br_title, r.role_name from users u
                                                    left join branches br on br.id = u.branch_id
                                                    left join role r on r.id = u.role_id
                                                    where u.access_id <> ''  $branch_sql  $condition ");

                                                    $sl=1;



                         
				                                while($rowData = mysql_fetch_array($user_query)){

        				                           
				                                  
				                                 	?>


				                                 	<tr>
                                                        <td><?php echo $sl++; ?></td>
		                                                <td class="aaa"><?php echo $rowData['user_fname']." ".$rowData['user_lname'];?></td>

		                                                <td><?php echo $rowData['access_id'];?></td>
                                                        <td class="aaa"><?php echo $rowData['phone'];?></td>
                                                        <td class="aaa"><?php echo $rowData['email'];?></td>
                                                        <td class="aaa"><?php echo $rowData['br_title'];?></td>
                                                        <td class="aaa"><?php echo $rowData['role_name'];?></td>

		                                                  <td>
                                                            <?php
                                                                if(trim($rowData['status']) == '1' )
                                                                {
                                                                    ?>

                                                                 <span style=" font-weight: bold;">Active</span>

                                                                    <?php
                                                                }else{

                                                                    ?>
                                                                    <span style="font-weight: bold;">Inactive</span>

                                                                    <?php

                                                                }

                                                             ?>
                                                        </td>
		                                               
		                                            </tr>


				                                 	<?php
				                                 }

                                        		 ?>
                                        	   
                                        </tbody>
                                    </table> 
                                   
                                 </div> <!-- table-responsive -->
                                    
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
         <!-- DATA TABES SCRIPT -->
        <script src="../../../../../js/plugins/datatables-button/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../../../../../js/plugins/datatables-button/pdfmake-0.1.36/pdfmake.min.js" type="text/javascript"></script>
        <script src="../../../../../js/plugins/datatables-button/pdfmake-0.1.36/vfs_fonts.js" type="text/javascript"></script>
        <script src="../../../../../js/plugins/datatables-button/JSZip-2.5.0/jszip.min.js" type="text/javascript"></script>
        <script src="../../../../../js/plugins/datatables-button/datatables.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../../../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../../../../js/sweetalert.min.js"></script>
        <script src="../../../../../js/jquery-ui.js"></script>
        <!-- <script type="text/javascript">$('.userlistTable').DataTable();</script> -->
        <script src="../../../../js/sweetalert.min.js"></script>


        <script>
      $(document).ready(function() {



         $('.userlistTable').DataTable({

            dom: 'Blfrtip',
            buttons: [
                  'excel', 'pdf'
            ],
            lengthMenu: [ [50, 100, 150, -1], [50, 100, 150, "All"] ],

       });

   
}); // end document ready


</script>

    </body>

    </html>


