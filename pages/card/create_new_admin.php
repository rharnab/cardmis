<?php require_once('../../login-authentication.php');?>
<?php 
	include("database.php");
	require_once('db/dbconnect.php');
 ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Card | MIS Create new admin</title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<!-- bootstrap 3.0.2 -->
		<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<!-- font Awesome -->
		<link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<!-- Ionicons -->
		<link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
		<!-- Theme style -->
		<link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->          
	</head>

	<body class="skin-blue">
		<?php include("../../header.php");?>

		<div class="wrapper row-offcanvas row-offcanvas-left">
			<!-- Left side column. contains the logo and sidebar -->
			 <?php include("../../menu.php");?>
			<!-- Right side column. Contains the navbar and content of the page -->
			<aside class="right-side">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>Create new admin</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
						<li><a href="#">admin</a></li>
						<li class="active">new admin</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content">
					<div class="row">
						<div id="msg">
							<p style="margin-left:30px;"></p>
						</div>
						<!-- left column -->
						<div class="col-md-6 col-md-offset-1" style="left: 0px; top: 0px">
							<!-- general form elements -->
							<div class="box box-primary">
								<div class="box-header">
								</div><!-- /.box-header -->
								<!-- form start -->
								<form id="admin_create" action="allaction/admin-create-action.php" method="post">
									<div class="box-body">
										<div class="form-group">
											<label for="admin_br">Admin Branch</label>
											<select id="admin_br" name="admin_br" class="form-control" required="">
												<option value="">Select admin branch</option>
												<?php echo $branch_name;?>
											</select>
											<span id="admin_br_id"></span>
										</div>
										<div class="form-group">
											<label for="admin_desg">Admin Designation</label>
											<select id="admin_desg" name="admin_desg" class="form-control" required="">
											<option value="">Select admin designation</option>

											</select>
											<span id="desg_id"></span>
									   </div>
									   <div class="form-group">
											<label for="admin_name">Admin Name</label>
											<select id="admin_name" name="admin_name" class="form-control" required="">
											<option value="">Select admin designation</option>
											</select>
											<span id="admin_name"></span>
									   </div>
									   <div class="form-group">
											<label for="admin_type">Admin Type</label>
											<select id="admin_type" name="admin_type" class="form-control" required="">
											<option value="">Select admin type</option>
											<option value="super_admin">Super admin</option>
											<option value="admin">Admin</option>
											<option value="branch_admin">Branch admin</option>
											</select>
											<span id="status_id"></span>
									   </div>
									   <div class="form-group">
											<label for="admin_status">Admin Status</label>
											<select id="admin_status" name="admin_status" class="form-control" required="">
											<option value="">Select admin status</option>
											<option value="active">Active</option>
											<option value="deactive">Deactive</option>
											</select>
											<span id="status_id"></span>
									   </div>
								</div><!-- /.box-body -->
								<div class="box-footer">
									<button type="submit" class="btn btn-primary" style="width: 100%">Create</button>
								</div>
								</form>
							</div>
						</div><!--/.col (left) -->
					</div>   <!-- /.row -->
				</section><!-- /.content -->
			</aside><!-- /.right-side -->
		</div><!-- ./wrapper -->
		<!-- jQuery 2.0.2 -->
		 <script src="../../js/jquery.min.js"></script>
		<!-- Bootstrap -->
		<script src="../../js/bootstrap.min.js" type="text/javascript"></script>
		<!-- AdminLTE App -->
		<script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
			   
		<script src="../../js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
		<script src="../../js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
		<script src="../../js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
		<!-- date-range-picker -->
		<script src="../../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
		<!-- bootstrap color picker -->
		<script src="../../js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
		<!-- bootstrap time picker -->
		<script src="../../js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>

		<script>
			$(document).ready(function(){
				/* This function also action: When change some item into branch input field, then select automatically branch wise designatin field */
				$("#admin_br").change(function(event){ 
					event.preventDefault();
					var branch = $("#admin_br").val();
					$.ajax({
						url:'allaction/select-designation.php',
						type:'post',
						data:{branch:branch},
						success:function(resData){
							var jsonData = JSON.parse(resData);
							var rowData = jsonData.length;
							$("#admin_desg").html("<option value=''>Select Designation</option>");
							for(var i=0;i<rowData;i++){
								$("#admin_desg").append('<option value="'+jsonData[i].designation+'">'+jsonData[i].designation+'</option>');
							}
						}
					});
				})
				/* This function also action: When change some item into designatin input field, then select automatically designatin wise admin field */
				$("#admin_desg").change(function(event){
					event.preventDefault();
					var recvVal = $(this).val();
					$.ajax({
						url:'allaction/select-name.php',
						type:'post',
						data:{data:recvVal},
						success:function(responseData){
							var jsonParseData = JSON.parse(responseData);
							var rowNumber = jsonParseData.length;
							$("#admin_name").html("<option value=''>Select user name</option>");
							for(var i = 0;i<rowNumber;i++){
								$("#admin_name").append('<option value="'+jsonParseData[i].uid+'">'+jsonParseData[i].f_name+' '+jsonParseData[i].l_name+'</option>');
							}
						}
					});	
				});
				// new admin creation //
				$(document).on('submit','#admin_create',function(event){
					event.preventDefault();
					var user_id = $("#admin_name").val();
					var user_type = $("#admin_type").val();
					var user_status = $("#admin_status").val();

					$.ajax({
						url:'allaction/admin-create-action.php',
						type:'post',
						data:{user_id:user_id,user_type:user_type,user_status:user_status},
						success:function(resData){
							document.getElementById("msg").innerHTML = resData;
							$("#msg").fadeOut(4000);
							$("#admin_br").val('');
							$("#admin_desg").val('');
							$("#admin_name").val('');
							$("#admin_type").val('');
					 		$("#admin_status").val('');
						}
					});
				});

			});

		</script>

	</body>
</html>