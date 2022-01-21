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
    </head>
 <script>
    function showUploadWiseStmt(uplDate)   // selectOptionDetails= tableNAme$AB$MatchCol***matchColVal
	{
	document.getElementById('crInfo').innerHTML ="Please Wait......";

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
        var file = 'uploadWiseStatement.php?uplDate='; //This is the path to the file we just finished making *
 
	var ref=new Date().getTime();
	var refr='&refresh=';

	xmlhttp.open('GET', file +uplDate+refr+ref, true); //Open the file through GET, and add the page we want to retrieve as a GET variable **

	xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4) { //Check if it is ready to recieve data
                var content = xmlhttp.responseText; //The content data which has been retrieved ***
                if( content ){ //Make sure there is something in the content variable
                	
         					//alert(content);
         					document.getElementById('crInfo').innerHTML =content;
				}
        }
        }
        xmlhttp.send(null) //Nullify the XMLHttpRequest;
 	return;
	}
</script>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
		<?php include("../../header.php");?>
		<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
             <?php include("../../menu.php");
             
             include("database.php");

             ?>


            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Upload XML File
                         
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Forms</a></li>
                        <li class="active">General Elements</li>
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
                                <form role="form" name="info" action="core/xmlParse.php" enctype="multipart/form-data" method="post" target="_blank">
                                    <div class="box-body">
                                    	<!--<strong>Billing Date
                                    </strong>
                                    <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="dt" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                                        </div>
                                        -->
                                        <br> 
                                        <div class="form-group">
                                            <label for="exampleInputFile">Upload 
											XML File</label>
                                            <input type="file" id="fileToUpload" name="fileToUpload">
                                            <p class="help-block">Please Upload only XML file</p>
                                        </div>
                                       
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="" name="submit" class="btn btn-primary">Submit</button>
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
                        <div class="col-md-6" style="left: 0px; top: 0px">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                 
                              <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 281px">Upload Date</th>
                                                <th style="width: 281px">Stmt 
												Date</th>
                                                <th style="width: 780px">File Name</th>
                                                <th style="width: 371px"># of Statement</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $tCnt=0;
                                        //$q=mysql_query("SELECT * FROM `account_summary` where STATEMENT_DATE_SORT between '2018-08-01' and '2018-08-31' GROUP by `lastUpdOn` order by `STATEMENT_DATE_SORT` desc");
                                        $q=mysql_query("SELECT * FROM `account_summary`  GROUP by `lastUpdOn` order by `STATEMENT_DATE_SORT` desc limit 0,10 ");
                                        while($r=mysql_fetch_array($q))
                                        {
                                       	$q1=mysql_query("select COUNT(*) cnt from account_summary where lastUpdOn='$r[lastUpdOn]'");	 
                                        $r1=mysql_fetch_array($q1);
                                        
                                        $stmtDate='';
                                        $q2=mysql_query("select STATEMENT_DATE from account_summary where lastUpdOn='$r[lastUpdOn]' group by STATEMENT_DATE");	 
                                        while($r2=mysql_fetch_array($q2))
                                        {
                                        $stmtDate=$stmtDate.', '.$r2['STATEMENT_DATE'];

                                        }
                                        
                                        $stmtDate=trim($stmtDate, ',');
                                        ?>
                                            <tr>
                                                <td style="width: 281px"><a href="javascript:#" onclick="showUploadWiseStmt('<?php echo $r['lastUpdOn']?>')"><?php echo $r['lastUpdOn'];?></a></td>
                                                <td style="width: 281px"><?php echo $stmtDate; ?></td>
                                                <td style="width: 780px"><?php echo $r['uploadedFIleName'];?></td>
                                                <td style="width: 371px; padding-right:50px" align="right"><?php echo $r1['cnt']; $tCnt=$tCnt+$r1['cnt'];?></td>

                                                 
                                            </tr>
                                         <?php
                                         }
                                         ?>
                                            <tr style="font-weight:bold">
                                                <td colspan="3" style="text-align:center">Total</td>
                                                <td style="width: 371px; padding-right:50px" align="right"><?php echo $tCnt;?></td>

                                                 
                                            </tr>
                                        </tbody>
                                         
                                    </table>    
                            </div><!-- /.box -->

                            

                        </div>
                        <!--/.col (right) -->
                    </div>   <!-- /.row -->
                    
                    
                    
                     
                    
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12" style="left: 0px; top: 0px;">
                            <!-- general form elements -->
                            <div class="box box-primary" id="crInfo">
                            
                             
                              
                                

                                
                            </div><!-- /.box -->

                           
                        </div><!--/.col (left) -->
                        <!-- right column -->
                        
                        <!--/.col (right) -->
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