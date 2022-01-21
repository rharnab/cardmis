<?php include("../../../database.php");?>
<?php include('../../../database.php') ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | Reprot</title>
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
            table.table-bordered > thead > tr > th{
              border:1px solid black;
            }
             table.table-bordered > tbody > tr > td{
              border:1px solid black;
            }
            
        </style>
    </head>



    <body class="skin-blue">

         <?php
                               $frm = explode('/', $_GET['frm']);
                               $frm_dt = $frm[2]."-".$frm[1]."-".$frm[0];

                               $to = explode('/', $_GET['to']);
                               $to_dt = $to[2]."-".$to[1]."-".$to[0];

                                $sts = $_GET['sts'];

                                if($sts !='')
                                {
                                    $condition = "and dcp.card_status= '$sts'  ";
                                }else{
                                    $condition='';
                                }


                                $branch = $_GET['branch'];

                                if($branch !='')
                                {
                                    $branch_sql = "and dcp.branch_id= '$branch'  ";
                                }else{
                                    $branch_sql='';
                                }


                                $rqst_type = $_GET['rqst_type'];

                                if($rqst_type !='')
                                {
                                    $request_type_sql = "and dcp.request_type= '$rqst_type'  ";
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
                                    <span class="ref"><?php echo date('M  d, Y') ?>/</span>
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
                                         <span class="ref"><?php echo $sl_branch_name['br_address']; ?></span>
                                         <br>

                                        <?php
                                     }

                                      ?>

                                      <br>
                                      <br>
                                       <span class="sub">Sub: Debit Card Delivery to the Branch. <hr class="underline"></span>
                                       
                                         <br>
                                       
                                   </div>
                             </div>
                           
                            <table class="table table-bordered userlistTable" style="font-size: 12px">
                                        <thead style="background-color: #009688; color: white; text-transform: uppercase;">
                                            <tr>
                                                <th  class="tract-title" colspan="7"><span >Card Receiver Tracker</span></th>
                                            </tr>
                                          <tr>
                                                <th>SL</th>
                                                <th>Card No</th>
                                                <th>Name</th>
                                                <th>A/C No</th>
                                                <th>Receving Branch</th>
                                                <th>Mobile No</th>
                                                <th>Remarks</th>
                                                
                                            </tr>

                                        </thead>
                                        <tbody>


                                                <?php 

                                                $debit_card_api = mysql_query("SELECT dcp.*, en.user_fname, en.user_lname, br.br_title as request_branch, rcvbr.br_title as receiving_branch
                                                    from debit_card_api dcp
                                                    left join users en on en.user_id = dcp.entry_by_id
                                                    left join branches br on br.id = dcp.branch_id
                                                    left join branches rcvbr on rcvbr.id = dcp.receive_branch
                                                    where dcp.accountno <> ''  $condition  $branch_sql $request_type_sql group by dcp.accountno ");

                                                while($rowData = mysql_fetch_array($debit_card_api)){

                                                  $sl=1;

                                                   if(empty($rowData['receiving_branch']))
                                                    {
                                                        $branch = $rowData['request_branch'];
                                                    }else{

                                                        $branch = $rowData['receiving_branch'];
                                                    }
                                      
                                                  
                                                  
                                                    ?>


                                                    <tr>
                                                        <td><?php echo $sl++ ?></td>
                                                        <td><?php echo  $rowData['accountname'] ?></td>
                                                       
                                                        <td><?php echo $rowData['card_number'];?></td>
                                                         <td><?php echo $rowData['accountno'];?></td>
                                                         <td>

                                                            <?php echo $branch ?></td>
                                                        <td>
                                                            <?php echo '0'.$rowData['accphone'];?>
                                                            <br>
                                                            <?php 
                                                                echo $rowData['accotherphone']<=0? "": $rowData['accotherphone'];
                                                            ?>    
                                                        </td>

                                                        <td></td>
                                                        
                                                       
                                                    </tr>


                                                    <?php
                                                 }

                                                 ?>
                                               
                                        </tbody>
                                    </table>


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


