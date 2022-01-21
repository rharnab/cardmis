<?php
include("database.php");
 
 ?>
 <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>email</th>
                                                <th>view</th>
                                                <th style="width: 131px">ClientID</th>
                                                <th style="width: 357px">Client_Name</th>
                                                <th style="width: 170px">
												Main_Card</th>
                                                <th style="width: 94px">
												Pay_Due_Dt</th>
                                                <th style="width: 214px">Contact</th>
                                                <th style="width: 406px">email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sl=0;
                                        $stmtDt=$_GET['dt'];
                                        $q=mysql_query("select *, c.IdClient clientCode from stmt_info stmt 
                                        left join customer c on c.IdClient=stmt.IdClient 
                                        where STATEMENT_DATE_SORT='$stmtDt'
                                        order by Client");
                                        while($r=mysql_fetch_array($q))
                                        {
                                        $contact='';
                                        if($r['Mobile'])
                                        	$contact='Cell: '.$r['Mobile'];
                                        if($r['Telephone'])
                                        	$contact=$contact.', Tel: '.$r['Telephone'];
                                        if($r['Fax'])
                                        	$contact=$contact.', Fax: '.$r['Fax'];
                                    
                                        $email=$r['email'];
                                        $ClientCode=$r['clientCode'];
                                        $clName=$r['Client'];
                                        $card=$r['MAIN_CARD'];
										
										$pdfLink="core/PDF/".date('d-M-Y', strtotime($r['STATEMENT_DATE_SORT']))."/".$ClientCode."/SBAC_Bank_eStatement.pdf";
                                       ?>
										
										
										<tr>
                                                <td style="vertical-align:middle; text-align:center; background:#9B9B9B" id="">
                                                <a style="color:white" href="javascript: sendEstatement('<?php echo $pdfLink?>', '<?php echo $email?>', '<?php echo $clName?>')">
                                                <div id='emailBox'><i class='fa fa-envelope'>&nbsp;</i><div></a></td>
                                                <td style="vertical-align:middle; text-align:center; background:#9B9B9B"><a href="<?php echo $pdfLink;?>" target="_blank"><img alt="" src="../../img/PDF_icon.png"></a></td>
                                                <td style="width: 131px"><?php echo $r['clientCode'];?></td>
                                                <td style="width: 357px"><?php echo $r['Client'];?></td>
                                                <td style="width: 170px"><?php echo $r['MAIN_CARD'];?></td>
                                                 
                                                <td><?php echo date("d-M-Y", strtotime($r['PAYMENT_DATE_SORT'])); ?></td>
                                                <td><?php echo trim($contact, ',');?></td>
                                                <td><?php echo $email;?></td>
                                            </tr>
                                         <?php
										}
                                         ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th style="width: 131px">&nbsp;</th>
                                                <th style="width: 357px">&nbsp;</th>
                                                <th style="width: 170px">&nbsp;</th>
                                                <th style="width: 529px">&nbsp;</th>
                                                <th style="width: 214px">&nbsp;</th>
                                                <th style="width: 406px">&nbsp;</th>
                                            </tr>
                                        </tfoot>
                                    </table>