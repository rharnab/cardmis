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
        <!-- DATA TABLES -->
        <link href="../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    
    <script>
    function sendEstatement(lnk, emailId, clName)   // selectOptionDetails= tableNAme$AB$MatchCol***matchColVal
	{
	document.getElementById('emailBox').innerHTML ="Wait..";
	var xmlhttp=false; // Clear our fetching variable
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
        var file = 'sendEstatement_ind.php?emailId='; //This is the path to the file we just finished making *
 
	var ref=new Date().getTime();
	var refr='&refresh=';

	xmlhttp.open('GET', file +emailId+'&clName='+clName+'&lnk='+lnk+refr+ref, true); //Open the file through GET, and add the page we want to retrieve as a GET variable **

	xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4) { //Check if it is ready to recieve data
                var content = xmlhttp.responseText; //The content data which has been retrieved ***
                if( content ){ //Make sure there is something in the content variable
                			
							alert(content);
							
							document.getElementById('emailBox').innerHTML ="<i class='fa fa-envelope'>&nbsp;</i>";
							
         					
				}
        }
        }
        xmlhttp.send(null) //Nullify the XMLHttpRequest;
 	return;
	}

  
 function showIndCustomerWiseStatement(dt)   // selectOptionDetails= tableNAme$AB$MatchCol***matchColVal
	{
	document.getElementById('stmtInfo').innerHTML ="Please Wait....";

	var xmlhttp=false; // Clear our fetching variable
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
        var file = 'showIndCustomerWiseStatement.php?dt='; //This is the path to the file we just finished making *
 
	var ref=new Date().getTime();
	var refr='&refresh=';

	xmlhttp.open('GET', file +dt+refr+ref, true); //Open the file through GET, and add the page we want to retrieve as a GET variable **

	xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4) { //Check if it is ready to recieve data
                var content = xmlhttp.responseText; //The content data which has been retrieved ***
                if( content ){ //Make sure there is something in the content variable
                			
							 
         					document.getElementById('stmtInfo').innerHTML =content;
         					
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

				}
        }
        }
        xmlhttp.send(null) //Nullify the XMLHttpRequest;
 	return;
	}
 

    </script>
    </head>
    
    <?php
    include("database.php");
    ?>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
		<?php include("../../header.php");?>
		<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include("../../menu.php");?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                <form name="info">
                 <h4>Statement Date</h4>	
                   <div class="input-group">
                    
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                          
                                            <input type="date" name="dt" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask style="width: 300px"/>
                                           &nbsp;
                                            <input type="button" name="submit" value="Submit" onclick="showIndCustomerWiseStatement(document.info.dt.value)" class="btn btn-primary">

                                        </div>
                                        
</form>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- /.box -->
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Customar Wise eStatement</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive" id="stmtInfo">
                                    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
         <script src="../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>

        <!-- page script -->
        <script type="text/javascript">
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
        </script>

    </body>
</html>