<?php require_once('../../../login-authentication.php'); include('../database.php')?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | MIS Debit Card</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/select2.min.css" rel="stylesheet" type="text/css" />
        <!-- Custom StyleSheet -->
        <link rel="stylesheet" href="../../../css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include("../../../header.php");?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
             <?php include("../../../menu.php");?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Debit card Reissue</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Reissue</a></li>
                        <li class="active">Debit card Reissue</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-4" style="left: 0px; top: 0px">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <div id="successMsg" style="margin:5px;"></div>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form id="debitCardForm" role="form" method="post">
                                    <div class="box-body">
                                        <div class="col-md-12" style="margin-top: 15px;">
                                            <div class="form-group">
                                                <label for="accNo">Account Number</label>
                                                <strong class="pull-right" style="color:red; margin-top:5px;">*</strong>
                                                <input type="text" id="accNo" name="accNo" placeholder="please enter your 13 digits account number" class="form-control">
                                                <span id="errorMsg"></span>
                                            </div>
                                        </div>

                                         <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="card_number">Card Number</label>
                                                <strong class="pull-right" style="color:red; margin-top:5px;">*</strong>
                                                <input readonly="" type="text" id="card_number" name="card_number" placeholder="Enter card number" class="form-control">
                                                <span id="card_numberErrorMsg"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nocard">Name on card</label>
                                                <strong class="pull-right" style="color:red; margin-top:5px;">*</strong>
                                                <input type="text" id="nocard" name="nocard" placeholder="Enter name on card" class="form-control">
                                                <span id="nocErrorMsg"></span>
                                            </div>
                                        </div>

                                         <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="issue_branch">Issuing Branch</label>
                                                <strong class="pull-right" style="color:red; margin-top:5px;">*</strong>
                                                <select name="issue_branch" id="issue_branch" class="form-control">
                                                    <option value="">Issuing Branch</option> 
                                                </select>
                                                <span id="issue_branchErrorMsg"></span>
                                            </div>
                                        </div>


                                        <!-- <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="card_request">Card Request</label>
                                                <select name="card_request" id="card_request" class="form-control">
                                                    <option value="">Select Card Request</option>
                                                    <option value="3">Activation</option>}
                                                    <option value="4">Block</option>
                                                    <option value="5">Cancel</option>
                                                    
                                                    
                                                </select>
                                                <span id="card_requestErrorMsg"></span>
                                            </div>
                                        </div> -->


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="reason">Reason</label>
                                                <strong class="pull-right" style="color:red; margin-top:5px;">*</strong>
                                                <select name="reason" id="reason" class="form-control">
                                                    <option value="">Select Reason</option>
                                                    <option value="1">Stolen</option>
                                                    <option value="2">Lost</option>
                                                    <option value="3">Damaged</option>
                                                    <option value="4">Surname Change</option>
                                                    <option value="5">Expired</option>
                                                    
                                                    
                                                </select>
                                                <span id="reasonErrorMsg"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="rcv_branch">Receiving Branch</label>
                                                <select name="rcv_branch" id="rcv_branch" class="form-control">
                                                    <option value="">Select Branch</option>
                                                    <?php 
                                                    $br_sql =mysql_query("SELECT br_title, id from branches where br_title <> '' ORDER BY br_title asc ");
                                                    while($branch_result  = mysql_fetch_assoc($br_sql))
                                                    {
                                                        ?>
                                                        <option value="<?php echo $branch_result['id'] ?>"><?php echo $branch_result['br_title'] ?></option>

                                                        <?php
                                                    }

                                                     ?>
                                                    
                                                </select>
                                                <span id="rcv_branchErrorMsg"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="otherPhone">Other Phone</label>
                                                <input type="number" id="otherPhone" name="otherPhone" placeholder="Enter other phone number" class="form-control">
                                                <span id="phoneErrorMsg"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="otherEmail">Other Email</label>
                                                <input type="email" id="otherEmail" name="otherEmail" placeholder="Enter other email" class="form-control">
                                                <span id="emailErrorMsg"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="narration">Narration</label>
                                                <strong class="pull-right" style="color:red; margin-top:5px;">*</strong>
                                                <input type="text" id="narration" name="narration" placeholder="Enter other narration" class="form-control">
                                                <span id="narrationErrorMsg"></span>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /box-body -->

                                    <div class="box-footer">
                                        <button type="" name="submit" class="btn btn-primary" id="submitbtn" style="width: 100%">Submit Query</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div><!--/.col (left) -->
                        <div class="col-md-6" style="left: 0px; top: 0px">
                            <div class="box box-primary">
                                <div class="box-header text-center">
                                    <bi>Account Information</big>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-hover table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>Name: <strong id="name"></strong></td>
                                                <td>Customer ID: <strong id="customerId"></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Mobile No: <strong id="phone"></strong></td>
                                                <td>Father's name: <strong id="fathers"></strong></td>
                                            </tr>
                                             <tr>
                                                <td>Gender <strong id="gender"></strong></td>
                                                <td>Mother's name: <strong id="mothers"></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Balance <strong id="balance"></strong></td>
                                                <td>Account Status <strong id="acc_status"></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Address: <strong id="address"></strong></td>
                                                <td>Date of Birth: <strong id="dobirth"></strong></td>
                                            </tr>

                                             <tr>
                                                <td colspan="2">Account Type: <strong id="account_type"></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>  
                                </div>

                                <div class="box-body">
                                   
                                    <table class="table table-hover table-bordered">
                                        <tbody id="show_cardNo_list">
                                           
                                        </tbody>
                                    </table>  
                                </div>


                                <div class="box-footer"></div>
                            </div><!-- /.box -->
                        </div><!-- /right -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <script src="../../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../../js/AdminLTE/app.js" type="text/javascript"></script>
                <!-- InputMask -->
        <script src="../../../js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="../../../js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="../../../js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- date-range-picker -->
        <script src="../../../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- bootstrap color picker -->
        <script src="../../../js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
        <!-- bootstrap time picker -->
        <script src="../../../js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <!-- js custom funtions -->
        <script src="../../../js/functions/functions.js"></script>
        <!-- sweet alert -->
         <script src="../../../js/sweetalert.min.js"></script>
         <script src="../../../js/select2.min.js"></script>

        <script>

            $(document).ready(function(){
                $('#rcv_branch').select2();
                $('#card_request').select2();
                $('#reason').select2();

            });

            $( function(){

             
                // account number validation //
                $("#accNo").mouseout(function(){
                    checkNumberWithDigit("accNo",13,"errorMsg");
                });

                // account number details informations show //
                $(document).on("change","#accNo",function(){
                    var value = $("#accNo").val().trim();
                
                    if(value !=''){
                        $.ajax({
                            url:'viewDataFromFlora.php',
                            type:'post',
                            data:{accnumber:value},
                            success:function(res){
                                var jsonData = JSON.parse(res);
                                document.getElementById("name").innerHTML = jsonData.acname;
                                document.getElementById("customerId").innerHTML = jsonData.customer;
                                document.getElementById("phone").innerHTML = jsonData.pre_mobilno;
                                document.getElementById("fathers").innerHTML = jsonData.father_hus;
                                document.getElementById("address").innerHTML = jsonData.sub_head_addr;
                                document.getElementById("account_type").innerHTML = jsonData.glhead;

                                document.getElementById("gender").innerHTML = jsonData.sex;
                                document.getElementById("mothers").innerHTML = jsonData.mother_name;
                                var balance = parseFloat(jsonData.bal_tk);
                                document.getElementById("balance").innerHTML = balance;
                                document.getElementById("acc_status").innerHTML = jsonData.status;
                                var date =jsonData.dob;
                                var date_formate =date.substr(0, 10);
                                document.getElementById("dobirth").innerHTML = date_formate;
                                getCardNumbers(value);
                                getIssueBranch(value);
                                console.log(jsonData);
                            }


                        });
                    }
                });

                // Debit Card Create for submit requirements //
                $(document).on('submit','#debitCardForm',function(event){
                    event.preventDefault();
                    var acc = $("#accNo").val();
                    var noc = $("#nocard").val();
                    var otherPhone = $("#otherPhone").val();
                    var otherEmail = $("#otherEmail").val();
                    var rcv_branch = $("#rcv_branch").val();
                    var phone = /^-?\d*(\.\d+)?$/;
                    var card_number = $('#card_number').val();
                    var reason = $('#reason').val();
                    var issue_branch = $("#issue_branch").val();
                    var narration = $("#narration").val();


                    if(acc== '' && noc =='' &&  card_number == '' && reason== ''){
                        $("#errorMsg").text("Please enter account number!").css('color','red').fadeIn(100).fadeOut(1000);
                        $("#nocErrorMsg").text("Please enter name on card").css('color','red').fadeIn(100).fadeOut(1000);
                    }else if(acc== ''){
                        $("#errorMsg").text("Please enter account number!").css('color','red').fadeIn(100).fadeOut(1000);
                    }else if(noc ==''){
                        $("#nocErrorMsg").text("Please enter name on card").css('color','red').fadeIn(100).fadeOut(1000);
                    }else if(card_number ==''){
                        $("#card_numberErrorMsg").text("Sorry Card Number not found").css('color','red').fadeIn(100).fadeOut(1000);
                    }else if(issue_branch ==''){
                        $("#issue_branchErrorMsg").text("Sorry issue branch not found").css('color','red').fadeIn(100).fadeOut(1000);
                    }else if(reason ==''){
                        $("#reasonErrorMsg").text("Please select re-issue reason").css('color','red').fadeIn(100).fadeOut(1000);
                    }else if(noc.length > 19)
                    {
                        $("#nocErrorMsg").text("Please give only 19 character").css('color','red').fadeIn(100).fadeOut(1000);
                    }else if(!otherPhone.match(phone))
                    {
                         $("#phoneErrorMsg").text("Please enter valid phone number!").css('color','red').fadeIn(100).fadeOut(1000);
                    }else if(narration =='')
                    {
                         $("#narrationErrorMsg").text("Please give narraion").css('color','red').fadeIn(100).fadeOut(1000);
                    }else{

                        swal({
                          title: "DO YOU WANT TO CREATE  THIS  ?? ",
                          icon: "success",
                          buttons: true,
                          dangerMode: true,
                        })
                        .then((value)=>{

                            if(value)
                            {

                                 $.ajax({
                                    url:'getDebitDataFromFlora.php',
                                    type:'post',
                                    data:{data:acc,noc:noc,otherPhone:otherPhone,otherEmail:otherEmail, rcv_branch: rcv_branch,  card_number: card_number, reason:reason, issue_branch:issue_branch, narration:narration},
                                    success:function(responseData){
                                        swal(responseData)
                                        .then((value)=>{
                                            location.reload();

                                        });

                                        
                                    }
                                });

                            }

                        });

                       
                    }

                });
            });


            //fetch cardholder name

            function getCardNumbers(value)
            {
                if(value !='')
                {
                    $.ajax({
                            url:'getDebitCard.php',
                            type:'post',
                            data:{accnumber:value},
                            success:function(res){
                                
                                var card_list = $('#show_cardNo_list').html();
                                if(card_list != '')
                                {
                                    $('#show_cardNo_list').html(res);
                                     var name_on_card =$('.card_name').val();
                                     $('#nocard').val(name_on_card);
                                    
                                }

                                console.log(res);
                                
                               

                               
                            }
                        });
                }
            }


           

           
            //unselect not selected card number
            function SelectCardNumber(card_no)
            {

                if(card_no != '')
                {
                    $('#card_number').val(card_no);
                    $('#card_number').prop('disabled', true);

                    var id = '#'+card_no;

                    if($('#'+card_no).prop("checked") == false){
                        $('#'+card_no).prop('checked', true); 
                    }else{
                        
                        $('input[type="checkbox"]').not(id).prop('checked', false);
                    }

                     
                }
            }


             //issue branch code
            function  getIssueBranch(value)
            {
                

                if(value !='')
                {
                    $.ajax({
                            url:'getIssuedBranch.php',
                            type:'post',
                            data:{accnumber:value},
                            success:function(res){
                               var jsondata = JSON.parse(res);
                               id= jsondata.id;
                                title= jsondata.br_title;
                               $('#issue_branch').append($('<option selected>').val(id).text(title))
                               $('#issue_branch').attr('disabled', true);
                               //console.log(res); 
                            }
                        });
                }

            }

        </script>
    </body>
</html>