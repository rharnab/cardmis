<?php 
    include('../db/dbconnect.php');
    //session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | Card Charge </title>
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
        <!-- date picker -->
        <link rel="stylesheet" type="text/css" href="../../../css/jquery-ui.css">

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
                    <h1>Charge Rate List</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Card Charge</a></li>
                        <li class="active">Rate List</li>
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
                                   <table class="table dataTable  table-bordered">
									  <thead style="background-color: #5D9ED1">
									    <tr>
									     
									      <th>SL</th>
									      <th>Rate</th>
									      <th>Rate Date</th>
									      
									    </tr>
									  </thead>
									  <tbody>
									  	<?php 
									  	   $q =mysql_query("SELECT * FROM `rate_tb` where rate <> '' ");
									  	   $sl=1;
									  	   while( $result = mysql_fetch_array($q))
									  	   {
									  	   	?>

									  	   		 <tr>
									
												      <td><?php echo $sl++; ?></td>
												      <td><?php echo $result['rate'] ?></td>
												      <td><?php echo $result['rate_date'] ?></td>
                              <!-- <td width="20">

                                    <input type="button" id="<?php echo $result['id'] ?>" class="btn btn-primary edit" value="EDIT" name="editrate">
                              </td> -->
												 
												    </tr>

									  	   	<?php
									  	   }


									  	 ?>


									   
									  </tbody>
									</table>
                                  </div>

                                  <!-- from -->
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!--Edit Modal Start-->

         <div id="add_data_Modal" class="modal fade">  
          <div class="modal-dialog">  
               <div class="modal-content">  
                    <div class="modal-header">  
                         <button type="button" class="close" data-dismiss="modal">&times;</button>  
                         <h4 class="modal-title">Edit Rate</h4>  
                    </div>  
                    <div class="modal-body">  
                         <form method="post"  id="insert_form" action="update_rate.php">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                Rate <span class="symbol required"></span>
                                                            </label>
                                                            <input type="text" placeholder="" class="form-control" id="rate" name="rate">
                                                              <div class="text-danger" id="rate_error" style="font-size: 10;"></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                               Rate Date <span class="symbol required"></span>
                                                            </label>
                                                            <input type="text" placeholder="" class="form-control" id="rate_date" name="rate_date">
                                                        </div>
                                                        
                                                        
                                                        
                                                    </div>
                                                   
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-8">
                                                    </div>
                                                    <div class="col-md-4">
                                                     <input type="hidden" name="id" id="id"/>  
                                                      <input type="button" name="update" id="insert" value="Insert" class="btn btn-success" />
                                                        
                                                    </div>
                                                </div>
                                            </form> 
                                         </div>  
                                      <div class="modal-footer">  
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                                      </div>  
                                   </div>  
                                </div>  
                             </div>

        <!--End Modal-->


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
        <script src="../../../js/jquery-ui.js"></script>
        <!-- datatable --> 
        <script type="text/javascript">$('.dataTable').DataTable();</script>
       <script>

        $(document).ready(function(){

            $('#rate_date').datepicker({ dateFormat : 'yy-mm-dd' })
      });


        /*amount  validation */
        $('#rate').keypress(function (event) {
                   var amt_validation= isNumber(event, this);
                   if(amt_validation == false)
                   {
                    $("#rate_error").html("<span style='font-size: 12px'> SORRY ! ONLY NUMBER IS ALLOWED </span>");
                   }else{

                       $("#rate_error").html('');
                   }
          });

          // THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
          function isNumber(evt, element) {
              var charCode = (evt.which) ? evt.which : event.keyCode
              if (            
                  (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
                  (charCode < 48 || charCode > 57))
                  return false;
                  return true;
          }
        /*end amount validation */
        
        $(document).ready(function(){

            $('.edit').on('click', function(){

                var id =$(this).attr('id');
                if(id !='')
                {
                    $.ajax({
                        type:"post",
                        url:"find_rate.php",
                        data:{id: id},
                        dataType:"json",  
                        success:function(data)
                        {
                            $('#rate').val(data.rate);
                            $('#rate_date').val(data.rate_date);
                            $('#id').val(data.id);
                            $('#insert').val('Update');
                            $('#add_data_Modal').modal('show');
                             
                        }

                    })
                }
            });
        })

        //update function
        $('#insert').on('click', function(){

          var  rate = $('#rate').val();
          var  rate_date = $('#rate_date').val();
          var  id = $('#id').val();
          var  error = false;

          if(rate == '')
          {
            $('#rate').css('border-color', 'red');
             error = true;
          }else{
            $('#rate').css('border-color', '#ccc');
          }

          if(rate_date == '')
          {
            $('#rate_date').css('border-color', 'red');
             error = true;
          }else{
            $('#rate_date').css('border-color', '#ccc');
          }

         var rate_error  =$('#rate_error').html().trim();

         if(rate_error !='')
         {
            swal("RATE MUST BE DIGIT");
         }
          if(error == false && rate_error =='')
          {
            $.ajax({
              url: "update_rate.php",
              type:'post',
              data:{
                'rate':rate,
                'rate_date': rate_date,
                'id': id
              },
              success:function(data)
              {
                 swal(data)
                 .then((value)=>{

                   location.reload();
                 });
                

              }
            })
          }

        });

       </script>
    </body>
</html>