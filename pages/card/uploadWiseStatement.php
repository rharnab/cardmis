<?php
    include("database.php");
    ?>
     <div class="box-body table-responsive">

    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 76px">#</th>
                                                <th style="width: 131px">ClientID</th>
                                                <th style="width: 357px">Client_Name</th>
                                                <th style="width: 170px">
												Main_Card</th>
                                                <th style="width: 529px">
												Account_No</th>
                                                <th style="width: 105px">
												Cr_Outstanding</th>
                                                <th style="width: 94px">Min_Due___</th>
                                                <th style="width: 406px">email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sl=1;
                                        $stmtDt="24/11/2016";
                                        
                                        $acc=mysql_query("select * from account_summary where lastUpdOn='$_GET[uplDate]'");
                                        while($rAcc=mysql_fetch_array($acc))
                                        	{
                                        	$cusQ=mysql_query("select * from customer where IdClient='$rAcc[IdClient]'");
                                        	$cus=mysql_fetch_array($cusQ);
                                        	
                                        ?>
                                            <tr>
                                                <td style="width: 76px"><?php echo $sl++;?></td>
                                                <td style="width: 131px"><?php echo $cus['IdClient'];?></td>
                                                <td style="width: 357px"><?php echo $cus['Client'];?></td>
                                                <td style="width: 170px"><?php echo $rAcc['CARD_LIST'];?></td>
                                                <td style="width: 529px"><?php echo $rAcc['ACCOUNTNO'].' ('.$rAcc['ACURN'].')';?></td>
                                                <td style="width: 105px; text-align: right"><?php echo $rAcc['EBALANCE']?></td>
                                                <td style="text-align: right"><?php echo $rAcc['MIN_AMOUNT_DUE']?></td>
                                                <td><?php echo $cus['email'];?></td>
                                            </tr>
                                         <?php
                                         	}
                                          
                                         ?>
                                        </tbody>
                                       
                                    </table>
                                    
                                    </div>