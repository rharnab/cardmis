<?php include_once('../db/dbconnect.php');?>
<div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Customer ID</th>
                                                <th>Acc Name</th>
                                                <th>Account No</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Approve Date</th>
                                                <th style="background:yellow;">Current Status</th>
                                                <th>Status Date</th>
                                                <th>Update Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $debit_card = $conn->prepare("SELECT * FROM debit_card_api_bk");
                                            $debit_card->execute();
                                            while($rowData = $debit_card->fetch(PDO::FETCH_ASSOC)){
                                        ?>  
                                            <tr>
                                                <td><?php echo $rowData['customerid'];?></td>
                                                <td><?php echo $rowData['accountname'];?></td>
                                                <td><?php echo $rowData['accountno'];?></td>
                                                <td>
                                                    <?php echo '0'.$rowData['accphone'];?>
                                                   
                                                       
                                                </td>   
                                                <td><?php echo $rowData['accemail'];?></td>
                                                <td>
                                                    <?php
                                                     $date = $rowData['approveDate'];
                                                     echo date('d-m-Y',strtotime($date));
                                                     ?>    
                                                </td>
                                                <td style="background:yellow;">
                                                    <!-- if login br_id then show only status --->
                                                    <!-- if login admin then show current status and show status change options --->
                                                    <?php echo $rowData['status'];?>
                                                </td>

                                                <td>
                                                    <?php
                                                        if($rowData['status_date']=='0000-00-00'){
                                                            echo '';
                                                        }else{
                                                            $date = $rowData['status_date'];
                                                            echo date('d-m-Y',strtotime($date));
                                                        }
                                                     ?>    
                                                </td>
                                                <td>
                                                    <select class="sts_change">
                                                        <option>Select Status</option>
                                                        <option value="Delivery">Card On Delivery</option>
                                                        <option value="Plastic">Card On Plastic</option>
                                                        <option value="ITCl">Card On ITCl</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        <?php
                                            }
                                        ?>  
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->