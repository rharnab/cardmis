<?php include("../../../database.php");?>
<?php include('../../../database.php'); error_reporting(0); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- <title>Card | Reprot</title> -->
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
        

        <style>
            
            .ref{
                
                font-size: 16px;
            }
            .branch{
                font-size: 16px;
                font-weight: bold;
            }
            .sub{
                 font-size: 16px;
                position: relative;
            }

           .underline {
                margin-top: 0px;
                margin-bottom: 20px;
                border: 0;
                border-top: 1.5px solid black;
                margin-left: 4%;
                margin-right: 70%;
                
            }
            .tract-title{
                text-align: center;
                font-size: 16px;
                font-weight: bold;
            }
           /* table.table-bordered > thead > tr > th{
              border:1px solid red;
            }
             table.table-bordered > tbody > tr > td{
              border:1px solid red;
            }*/

            .t-border{
                border:1px solid #000 !important;
            }
            
        </style>
    </head>



    <body class="skin-blue">

         <?php
                               $frm = explode('/', $_GET['frm']);
                               $frm_dt = $frm[2]."-".$frm[1]."-".$frm[0];

                               $to = explode('/', $_GET['to']);
                               $to_dt = $to[2]."-".$to[1]."-".$to[0];

                               

                                


                                $branch = $_GET['branch'];

                                if($branch !='')
                                {
                                    $branch_sql = "and dcp.issue_branch= '$branch'  ";
                                }else{
                                    $branch_sql='';
                                }


                                $rqst_type = $_GET['rqst_type'];

                                if($rqst_type !='')
                                {
                                    $request_type_sql = "and dcp.request_type in ($rqst_type) ";
                                }else{
                                    $request_type_sql='';
                                }


                                //find out branch name
                                if(!empty($branch))
                                {
                                      $sl_br_query= mysql_query("SELECT br_title, br_address from branches where id='$branch' ");
                                      $sl_branch_name= mysql_fetch_assoc($sl_br_query);
                                      

                                }
                              

                            
                                 
                        ?>
                        <button onclick="printDiv()" class="print_btn btn btn-primary" type="button">Print</button>
                        <div class="col-xs-12" id='DivIdToPrint'>
                           
                           <div class="row">
                                <div class="col-xs-4" style="float: right;">
                                   <img style="float: right;" src="../../../../../img/LOGO.png" width="130"  height="85"  alt=""/>
                                </div>
                            
                                <div class="col-xs-8">
                                    
                                     <span class="title">সাউথ  বাংলা  এগ্রিকালচার  কমার্স  ব্যাংক লিঃ </span>
                                    <br>
                                    <span class="ref">Ref: SBAC/HO/DFID/<?php echo date('Y') ?>/</span>
                                    <br>
                                    <span class="ref"><?php echo date('M  d, Y') ?></span>
                                    <br>
                                    <br>
                                    <br>
                                     <span class="ref">The Manager</span>
                                     <br>
                                     <span class="ref">SBAC Bank Ltd</span>
                                     <br>
                                     <?php 
                                     if(isset($sl_branch_name))
                                     {
                                        ?>
                                         <span class="branch"><?php echo $sl_branch_name['br_title']; ?></span>
                                         <br>

                                         <!-- addreass lenght short -->
                                         <?php 
                                             if(strlen($sl_branch_name['br_address']) > 60 )
                                            {
                                               $address_array =explode(',', $sl_branch_name['br_address']);

                                               $address_length =  count($address_array);
                                               $upozilla = $address_array[$address_length - 2];
                                               $district = $address_array[$address_length - 1];

                                               if($address_length > 1)
                                               {
                                                   $add1 = $address_array[0].", ".$address_array[1].", <br>";
                                                   $add2 = $address_array[2].", ".$upozilla.", ".$district;
                                                   $full_address = $add1.$add2;

                                               }else if($address_length > 2)
                                               {
                                                   $add1 = $address_array[0].", ".$address_array[1].", <br>";
                                                   $add2 = $address_array[3].", ".$upozilla.", ".$district;
                                                   $full_address = $add1.$add2;
                                               }else if($address_length > 3)
                                               {
                                                   $add1 = $address_array[0].", ".$address_array[1].", <br>";
                                                   $add2 = $address_array[4].", ".$upozilla.", ".$district;
                                                   $full_address = $add1.$add2;
                                               }else if($address_length > 4)
                                               {
                                                   $add1 = $address_array[0].", ".$address_array[1].", <br>";
                                                   $add2 = $address_array[5].", ".$upozilla.", ".$district;
                                                   $full_address = $add1.$add2;
                                               }else if($address_length > 5)
                                               {
                                                   $add1 = $address_array[0].", ".$address_array[1].", <br>";
                                                   $add2 = $address_array[5].", ".$upozilla.", ".$district;
                                                   $full_address = $add1.$add2;
                                               }else{
                                                $full_address = '';

                                               }

                                           
                                            }

                                          ?>
                                         <span class="ref">
                                           <?php  

                                            if(!empty($full_address))
                                            {
                                                echo $full_address;
                                            }else{
                                                echo $sl_branch_name['br_address'];
                                            }

                                             ?>
                                                
                                        </span>
                                         <br>

                                        <?php
                                     }else{
                                      ?>
                                      <span style="color: red">Branch Not found</span>

                                      <?php

                                     }

                                      ?>

                                      <br>
                                      
                                       <span class="sub">Sub: Debit Card Delivery to the Branch.</span>
                                       
                                         <br> <br><br>
                                       
                                   </div>
                             </div>
                           
                            <table class="table userlistTable" style="font-size: 12px">
                                        <thead style="background-color: #009688; color: white; text-transform: uppercase;">
                                            <tr class="t-border">
                                                <th  class="tract-title t-border" colspan="8"><span >Card Receiver Tracker</span></th>
                                            </tr>
                                          <tr class="t-border">
                                                <th class="t-border">SL</th>
                                                <th class="t-border">Card No</th>
                                                <th class="t-border">Name</th>
                                                <th class="t-border">A/C No</th>
                                                <th class="t-border">Issuing Branch</th>
                                                <th class="t-border">Receving Branch</th>
                                                <th class="t-border">Mobile No</th>
                                                <th class="t-border">Remarks</th>
                                               
                                                
                                                
                                            </tr>

                                        </thead>
                                        <tbody>


                                                <?php 

                                                $debit_card_api = mysql_query("SELECT dcp.*, en.user_fname, en.user_lname, br.br_title as request_branch, rcvbr.br_title as receiving_branch, issue.br_title as issue_branch_name
                                                    from debit_card_api dcp
                                                    left join users en on en.user_id = dcp.entry_by_id
                                                    left join branches br on br.id = dcp.branch_id
                                                    left join branches rcvbr on rcvbr.id = dcp.receive_branch
                                                    left join branches issue on issue.id = dcp.issue_branch
                                                    where  dcp.requestDate between '$frm_dt' and '$to_dt' and dcp.accountno <> ''  and dcp.card_status= 'approve'  $branch_sql $request_type_sql group by dcp.accountno ");

                                               

                                                $sl=1;

                                                while($rowData = mysql_fetch_array($debit_card_api)){

                                                 

                                                   if(empty($rowData['receiving_branch']))
                                                    {
                                                        $branch = $rowData['request_branch'];
                                                    }else{

                                                        $branch = $rowData['receiving_branch'];
                                                    }


                                                     $request_type = $rowData['request_type'];
                                                   
                                                     if($request_type == '1' || $request_type == '2')
                                                     {
                                                        $forward_card_number = $rowData['forword_card_number'];
                                                     }else{
                                                        $forward_card_number = $rowData['card_number'];
                                                     }
                                      
                                                  
                                                  
                                                    ?>


                                                    <tr class="t-border">
                                                        <td class="t-border"><?php echo $sl++; ?></td>
                                                      
                                                       
                                                        <td class="t-border"><?php echo $forward_card_number ;?></td>

                                                        <td class="t-border"><?php echo  $rowData['accountname'] ?></td>
                                                         <td class="t-border"><?php echo $rowData['accountno'];?></td>
                                                         <td class="t-border"><?php echo $rowData['issue_branch_name'] ?></td>
                                                         <td class="t-border"><?php echo $branch ?></td>
                                                        <td class="t-border">
                                                            <?php echo '0'.$rowData['accphone'];?>
                                                            <br>
                                                            <?php 
                                                                echo $rowData['accotherphone']<=0? "": $rowData['accotherphone'];
                                                            ?>    
                                                        </td>

                                                        <td class="t-border"></td>



                                                       
                                                        
                                                       
                                                    </tr>


                                                    <?php
                                                 }

                                                 ?>
                                               
                                        </tbody>
                                    </table>
                                    <br><br><br>


                            <div class="row">
                                <div class="col-xs-6">

                                    <span>--------------------</span>
                                    <br>
                                    <span class="branch">Prepared by</span>
                                    
                                </div>

                                <div class="col-xs-6">

                                    <div style="float: right;">
                                        
                                         <span>--------------------</span>
                                         <br>
                                        <span class="branch">Received by</span>

                                    </div>
                                   
                                        
                                   
                                    
                                </div>
                                 
                             </div> 


                            
                        </div>

                        



      <!-- jQuery 2.0.2 -->
        <script src="../../../../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../../../../js/bootstrap.min.js" type="text/javascript"></script>

        <script>
      $(document).ready(function() {

        //window.print();

         
   
}); // end document ready

function printDiv()
{
    $('.print_btn').hide();
     window.print();
}

</script>

    </body>

    </html>


