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
    
    function activeInactiveCustomerContact(opt, clCode)
    {
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
        var file = 'activeInactiveCustomerContact.php?opt='; //This is the path to the file we just finished making *
 
	var ref=new Date().getTime();
	var refr='&refresh=';

	xmlhttp.open('GET', file +opt+'&clCode='+clCode+refr+ref, true); //Open the file through GET, and add the page we want to retrieve as a GET variable **

	xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4) { //Check if it is ready to recieve data
                var content = xmlhttp.responseText; //The content data which has been retrieved ***
                if( content ){ //Make sure there is something in the content variable
                	
         					alert(content);
         					
				}
        }
        }
        xmlhttp.send(null) //Nullify the XMLHttpRequest;
 	return;

    }
    
    
    
    function showDynamicUpdateField(updDiv, keyCode, colName)   // selectOptionDetails= tableNAme$AB$MatchCol***matchColVal
	{
	crVal=document.getElementById(updDiv).innerHTML;
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
        var file = 'showDynamicUpdateField.php?keyCode='; //This is the path to the file we just finished making *
 
	var ref=new Date().getTime();
	var refr='&refresh=';

	xmlhttp.open('GET', file +keyCode+'&crVal='+crVal+'&colName='+colName+'&updDiv='+updDiv+refr+ref, true); //Open the file through GET, and add the page we want to retrieve as a GET variable **

	xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4) { //Check if it is ready to recieve data
                var content = xmlhttp.responseText; //The content data which has been retrieved ***
                if( content ){ //Make sure there is something in the content variable
                	
         					//alert(content);
         					document.getElementById(updDiv).innerHTML =content;
				}
        }
        }
        xmlhttp.send(null) //Nullify the XMLHttpRequest;
 	return;
	}

	 function updateData(updDiv, oldVal, val, col, clCode)
	 {
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
        var file = 'updateCustomerData.php?clCode='; //This is the path to the file we just finished making *
 
	var ref=new Date().getTime();
	var refr='&refresh=';

	xmlhttp.open('GET', file +clCode+'&col='+col+'&val='+val+refr+ref, true); //Open the file through GET, and add the page we want to retrieve as a GET variable **

	xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4) { //Check if it is ready to recieve data
                var content = xmlhttp.responseText; //The content data which has been retrieved ***
                if( content ){ //Make sure there is something in the content variable
                	
         					var cnt=content.split('@');
         					//alert(cnt[0]);
         					if(cnt[1]=='1')
         						document.getElementById(updDiv).innerHTML =val;
							else
								document.getElementById(updDiv).innerHTML =oldVal;
							
         					
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
                    <h1>
                        Customer Data
                        <small>summary</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Tables</a></li>
                        <li class="active">Data tables</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- /.box -->                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Customar List</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 27px">Email Status</th>
                                                <th style="width: 119px">ClientID</th>
                                                <th style="width: 371px">Client_Name</th>
                                                <th style="width: 667px">Address</th>
                                                <th style="width: 164px">Contact</th>
                                                <th style="width: 170px">email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        //$q=mysql_query("select *, c.IdClient clientCode from customer c left join customer_contact cc on cc.IdClient=c.IdClient order by Client");
                                        $q=mysql_query("select * from customer order by IdClient");
                                        while($r=mysql_fetch_array($q))
                                        {
                                        $ClientCode=$r['IdClient'];
                                        $actStatus=$r['actStatus'];
                                        $contact='';
                                        if($r['Mobile'])
                                        	$contact='Cell: '.$r['Mobile'];
                                        if($r['Telephone'])
                                        	$contact=$contact.', Tel: '.$r['Telephone'];
                                        if($r['Fax'])
                                        	$contact=$contact.', Fax: '.$r['Fax'];

                                        ?>
                                            <tr>
                                                <td style="width: 27px">
                                                <select name="act" onchange="activeInactiveCustomerContact(this.value, '<?php echo $ClientCode?>')">
                                                	<?php if($actStatus=='1') 
                                                	{?>
                                                	<option value="1">Enable</option>
                                                	<?php
                                                	}
                                                	 
                                                	?>
                                                	<option value="0">Disable</option>
                                                	<option value="1">Enable</option>
                                                	
												</select>
                                                <!--
                                                <input type="checkbox" onclick="activeInactiveCustomerContact(this.checked, '<?php echo $ClientCode?>')" name="" <?php if($actStatus=='1') {?> checked="checked"<?php }?>>
                                                -->
                                                </td>
                                                <td style="width: 119px"><?php echo $ClientCode;?></td>
                                                <td style="width: 371px"><?php echo $r['Client'];?></td>
                                                <td style="width: 667px"><?php echo $r['Address'];?></td>
                                                <td id="contact<?php echo $ClientCode?>" 
                                                ondblclick="showDynamicUpdateField('contact<?php echo $ClientCode?>', '<?php echo $ClientCode ?>', 'contact');
												" style="width: 164px">
												<?php echo $contact;?>&nbsp;</td>

                                                 
                                                 <td id="email<?php echo $ClientCode?>" 
                                                ondblclick="showDynamicUpdateField('email<?php echo $ClientCode?>', '<?php echo $ClientCode ?>', 'email');
												">
												<?php echo $r['email'];?>&nbsp;</td>

                                                 
                                            </tr>
                                         <?php
                                         }
                                         ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="width: 27px">&nbsp;</th>
                                                <th style="width: 119px">&nbsp;</th>
                                                <th style="width: 371px">&nbsp;</th>
                                                <th style="width: 667px">&nbsp;</th>
                                                <th style="width: 164px">&nbsp;</th>
                                                <th style="width: 170px">&nbsp;</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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