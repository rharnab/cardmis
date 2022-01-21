<?php require_once('../../login-authentication.php');?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | MIS</title>
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
		<script>
		
		function bill_gen()
			{
		
		 
				if(document.bala.cardno.value=="")
				{
				alert("Sorry, the Card No field must not be empty.")
				document.bala.cardno.focus();
				
				return false;
				}
				
				if(document.bala.card_name.value=="No cardno Found")
				{
				alert("Sorry, the Card Name field must not be empty.")
				document.bala.card_name.focus();
				
				return false;
				}
				
				if(document.bala.acc_no.value=="")
				{
				alert("Sorry, the Account No field must not be empty.")
				document.bala.card_name.focus();
				
				return false;
				}
				
	
				
				if(document.bala.amount.value=="")
				{
				alert("Sorry, the amount field must not be empty.")
				document.bala.amount.focus();
				
				return false;
				}
		
				
				document.bala.action='/cardMis/pages/card/bill_save.php';
				document.bala.submit();
				
			}

		
		
		function getCustomerInfo(cardno, parameterList)
		{
		var xmlhttp=false; //Clear our fetching variable
		        try {
		                xmlhttp = new ActiveXObject('Msxml2.XMLHTTP'); //Try the first kind of active x object…
		        } catch (e) {
		                try {
		                        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP'); //Try the second kind of active x object
		            } catch (E) {
		                xmlhttp = false;
		                        }
		        }
		        if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		                xmlhttp = new XMLHttpRequest(); //If we were able to get a working active x object, start an XMLHttpRequest
		        }
		        
		        var file = '/cardMis/pages/card/flora_info.php?cardno='; //This is the path to the file we just finished making *
		 
		var ref=new Date().getTime();
		var refr='&refresh=';
		
		xmlhttp.open('GET', file +cardno, true); //Open the file through GET, and add the page we want to retrieve as a GET variable **
		
		xmlhttp.onreadystatechange=function() {
		        if (xmlhttp.readyState==4) { //Check if it is ready to recieve data
		                var content = xmlhttp.responseText; //The content data which has been retrieved ***
		                if( content ){ //Make sure there is something in the content variable
		                	
		
		         					var contentSort=content.split('***');
		         					
		         					var parameterListSort=parameterList.split('*');
		         					for(var p=0; p<parameterListSort.length; p++)
		         					{
		         						if(parameterListSort[p]=='card_name')
		         							document.getElementById(parameterListSort[p]).value =contentSort[0];  //contentSort[0]=
		         							
		
		         					}
				
						}
		        }
		        }
		        xmlhttp.send(null) //Nullify the XMLHttpRequest;
		 return;
		
		}
		</script>        
		        
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
                    <h1>
                        Card Bill Payment - Transfer                         
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Forms</a></li>
                        <li class="active">Card Bill Payment - Transfer</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6" style="left: 0px; top: 0px">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="bala">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Card No</label>
                                            <input name="cardno" maxlength="16" class="form-control" id="cardno" placeholder="16 digit card no" onblur="getCustomerInfo(this.value, 'card_name')">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Card Account Holder</label>
                                            <input name="card_name" class="form-control" id="card_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Account No</label>
                                            <input name="acc_no" class="form-control" id="acc_no" maxlength="13" placeholder="Flora Account No" >
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Transaction Date</label>
                                            <input name="tdate" class="form-control" id="tdate" value="2016-03-22">
                                        </div>                                        
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Bill Amount</label>
                                            <input name="amount" maxlength="9" class="form-control" id="amount" placeholder="Bill amount">
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" onclick="bill_gen()">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->

                            <!-- Form Element sizes -->
                            <!-- /.box -->

                            <!-- /.box -->

                            <!-- Input addon -->
                            <!-- /.box -->

                        </div><!--/.col (left) -->
                        <!-- right column -->
                        <!--/.col (right) -->
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
                <!-- InputMask -->
        <script src="../../js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="../../js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="../../js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- date-range-picker -->
        <script src="../../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- bootstrap color picker -->
        <script src="../../js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
        <!-- bootstrap time picker -->
        <script src="../../js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>

        

    </body>
</html>