<?php
    include_once("pages/card/db/dbconnect.php");
    include_once("pages/card/functions/functions.php");
    include('pages/card/database.php');
    $select_role = $conn->prepare("SELECT * FROM role");
    $select_role->execute();
    $data = '';
    while($rowData = $select_role->fetch(PDO::FETCH_ASSOC)){
        $data.="
            <li>$rowData[role_name]</li>
        ";
    }
?>


<aside class="left-side sidebar-offcanvas">                
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <style>
            .dropdown-menu > li > a:hover {
                background: transparent;
                color: black
            }
        </style>
        <!-- Sidebar user panel -->
        
        <!-- <div class="user-panel">
            <div class="pull-left image">
                <img src="/test_cardMis/img/avatar3.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Hello...</p>                            
            </div>
        </div> -->
        
        <!-- search form -->
        <!--
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
       

            <li class="active">
                <a href="/test_cardMis/dashboard.php">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
                </a>
            </li>

            <?php 
            if($_SESSION['branch_id'] == '1')

            {

             ?>
            <!-- Utility Setup -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>UTILITY SETUP</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/test_cardMis/pages/card/create_branch.php"><i class="fa fa-angle-double-right"></i>Create New Branch</a></li>
                    <li><a href="/test_cardMis/pages/card/all_br_view.php"><i class="fa fa-angle-double-right"></i>View All Branch</a></li>

                    
                    <!-- ramjan utitlity set up -->
                    <li><a href="/test_cardMis/pages/card/upload_card_list.php"><i class="fa fa-angle-double-right"></i>upload Card List</a></li>

                </ul>                            
            </li>

            <?php 

            }

             ?>


             <!-- Requisition-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>DEBIT CARD REQUISITION</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php 
                    //maker 
                    if($_SESSION['role_id'] == '4')
                    {
                        ?>


                            <li><a href="/test_cardMis/pages/card/card_requisition/debitCardCreate.php"><i class="fa fa-angle-double-right"></i>New Debit Card</a></li>

                        <?php
                    }

                     ?>
                    
                    <!-- role check for br-checker and head-office -->
                    <?php  if($_SESSION['role_id'] == '5' || $_SESSION['role_id'] == '6')
                    {
                        ?>

                        <li class="active"><a href="/test_cardMis/pages/card/card_requisition/debit_card_auth.php"><i class="fa fa-angle-double-right"></i> Requisition Authentication  </a></li>
                        <?php

                    } 
                    ?>
                    <?php 
                    if($_SESSION['role_id'] == '6')
                    {
                        ?>

                        <!-- Drop Down--->
                        <!-- <li class="treeview">
                            <a href="#"><i class="fa fa-angle-double-right"></i>
                                Requested Card Status
                            </a>
                            <ul class="treeview-menu">
                                <li class="active"><a href="/test_cardMis/pages/card/branch_debit_card_sts.php"><i class="fa fa-angle-double-right"></i>Requested Card List</a></li>
                                <li class="active"><a href="/test_cardMis/pages/card/approve_debit_card_sts.php"><i class="fa fa-angle-double-right"></i>Approve Card Status</a></li>  
                            </ul>
                        </li> -->
                        <!-- /Drop Down--->
                        <li><a href="/test_cardMis/pages/card/card_requisition/debitCardStatus.php"><i class="fa fa-angle-double-right"></i>Requisition XML for Debit Card</a></li>
                       <!--  <li class="active"><a href="/test_cardMis/pages/card/debit_card_sms.php"><i class="fa fa-angle-double-right"></i>Debit Card SMS</a></li>
                        <li class="active"><a href="/test_cardMis/pages/card/debit_card_email.php"><i class="fa fa-angle-double-right"></i>Debit Card E-mail</a></li> -->

                       

                        

                        <?php
                    }

                     ?>
                    
                    
                </ul>                            
            </li>
            <!-- /Requisition-->

             <!-- RE-ISSUE-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>DEBIT CARD RE-ISSUE</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php 
                    //maker 
                    if($_SESSION['role_id'] == '4')
                    {
                        ?>


                            <li><a href="/test_cardMis/pages/card/card_reissue/debitCardCreate.php"><i class="fa fa-angle-double-right"></i>Debit Card Re-issue</a></li>

                        <?php
                    }

                     ?>
                    
                    <!-- role check for br-checker and head-office -->
                    <?php  if($_SESSION['role_id'] == '5' || $_SESSION['role_id'] == '6')
                    {
                        ?>

                        <li class="active"><a href="/test_cardMis/pages/card/card_reissue/debit_card_auth.php"><i class="fa fa-angle-double-right"></i>Re-issue Authentication  </a></li>
                        <?php

                    } 
                    ?>
                    <?php 
                    if($_SESSION['role_id'] == '6')
                    {
                        ?>

                        <li><a href="/test_cardMis/pages/card/card_reissue/debitCardStatus.php"><i class="fa fa-angle-double-right"></i>Re-issue XML for Debit Card</a></li>

                       
                        <?php
                    }

                     ?>
                    
                    
                </ul>                            
            </li>
            <!-- /RE-ISSUE-->


             <!-- ACTION-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>DEBIT CARD ACTIVISION</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php 
                    //maker 
                    if($_SESSION['role_id'] == '4')
                    {
                        ?>


                            <li><a href="/test_cardMis/pages/card/card_action/debitCardCreate.php"><i class="fa fa-angle-double-right"></i>Debit Card Activity</a></li>

                        <?php
                    }

                     ?>
                    
                    <!-- role check for br-checker and head-office -->
                    <?php  if($_SESSION['role_id'] == '5' || $_SESSION['role_id'] == '6')
                    {
                        ?>

                        <li><a href="/test_cardMis/pages/card/card_action/debit_card_auth.php"><i class="fa fa-angle-double-right"></i>Activity Authentication  </a></li>
                        <?php

                    } 
                    ?>
                    <?php 
                    if($_SESSION['role_id'] == '6')
                    {
                        ?>

                        <li><a href="/test_cardMis/pages/card/card_action/debitCardStatus.php"><i class="fa fa-angle-double-right"></i>Activity XML for Debit Card</a></li>

                        <?php
                    }

                     ?>
                    
                    
                </ul>                            
            </li>
            <!-- /Action-->

             <!-- PIN RE-ISSUE-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>DEBIT CARD PIN RE-ISSUE</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php 
                    //maker 
                    if($_SESSION['role_id'] == '4')
                    {
                        ?>


                            <li><a href="/test_cardMis/pages/card/card_pin_reissue/debitCardCreate.php"><i class="fa fa-angle-double-right"></i>Debit Card PIN Re-issue</a></li>

                        <?php
                    }

                     ?>
                    
                    <!-- role check for br-checker and head-office -->
                    <?php  if($_SESSION['role_id'] == '5' || $_SESSION['role_id'] == '6')
                    {
                        ?>

                        <li><a href="/test_cardMis/pages/card/card_pin_reissue/debit_card_auth.php"><i class="fa fa-angle-double-right"></i>Pin Re-issue Authentication  </a></li>
                        <?php

                    } 
                    ?>
                    <?php 
                    if($_SESSION['role_id'] == '6')
                    {
                        ?>

                        <li><a href="/test_cardMis/pages/card/card_pin_reissue/debitCardStatus.php"><i class="fa fa-angle-double-right"></i>Pin Re-issue XML for Debit Card</a></li>
                        
                        <?php
                    }

                     ?>
                    
                    
                </ul>                            
            </li>
            <!-- /PIN RE-ISSUE-->
            <?php  if($_SESSION['role_id'] == '5' || $_SESSION['role_id'] == '6')
            {
              ?>

                 <li>
                    <a href="/test_cardMis/pages/card/card_requisition/dishonour_card_request.php">
                        <i class="fa fa-dashboard"></i> <span>Dishonour Request</span> 
                    </a>
                </li>

              <?php
            }

            ?>

            <?php 
             if($_SESSION['role_id'] == '6')
             {
                ?>

                <!-- Role -->
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-table"></i><span>ROLE MANAGE</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/test_cardMis/pages/card/role_manage/role.php"><i class="fa fa-angle-double-right"></i>User Roles</a></li>
                        <li><a href="/test_cardMis/pages/card/permission.php"><i class="fa fa-angle-double-right"></i>Permission</a></li>
                    </ul>                            
                </li>
                <!-- /Role-->


                <?php
             }

             ?>
            
           
           
           
            
            <!-- Role -->
            <!-- <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i><span>ROLE MANAGE</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/test_cardMis/pages/card/role.php"><i class="fa fa-angle-double-right"></i>User Roles</a></li>
                    <li class="active"><a href="/test_cardMis/pages/card/permission.php"><i class="fa fa-angle-double-right"></i>Permission</a></li>
                </ul>                            
            </li> -->
            <!-- /Role-->




              <!-- CIB -->
            <!-- <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i><span>CIB REPORT</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                     <li class="dropdown dropdown-submenu">
                        <a href="/test_cardMis/pages/card/cib/import_contracts.php" class="dropdown-toggle">&nbsp;&nbsp;
                             <i class="fa fa-angle-double-right"></i> Import CL File
                         </a>
                    </li> 
                     <li class="dropdown dropdown-submenu">
                        <a href="/test_cardMis/pages/card/cib/generate_cib.php" class="dropdown-toggle">&nbsp;&nbsp;
                            <i class="fa fa-angle-double-right"></i> Generate CIB
                         </a>
                    </li>

                     <li class="dropdown dropdown-submenu">
                        <a href="/test_cardMis/pages/card/cib/download_cib.php" class="dropdown-toggle">&nbsp;&nbsp;
                            <i class="fa fa-angle-double-right"></i> Download CIB
                         </a>
                    </li> 

                    <li class="dropdown dropdown-submenu">
                        <a href="/test_cardMis/pages/card/cib/modify_subject.php" class="dropdown-toggle">&nbsp;&nbsp;
                             <i class="fa fa-angle-double-right"></i> Show Subject Data
                         </a>
                    </li>

                     <li class="dropdown dropdown-submenu">
                        <a href="/test_cardMis/pages/card/cib/modify_contract.php" class="dropdown-toggle">&nbsp;&nbsp;
                             <i class="fa fa-angle-double-right"></i> Show Contracts Data
                         </a>
                    </li> 

                   

                   

                     <li class="dropdown dropdown-submenu">
                        <a href="/test_cardMis/pages/card/cib/subject_error/cib_error_report.php" class="dropdown-toggle">&nbsp;&nbsp;
                            <i class="fa fa-angle-double-right"></i>  Subject Error
                         </a>
                    </li> -->


                   <!--  <li class="dropdown dropdown-submenu">
                        <a href="/test_cardMis/pages/card/cib/contract_error/cib_error_report.php" class="dropdown-toggle">&nbsp;&nbsp;
                            <i class="fa fa-angle-double-right"></i>  Contract Error
                         </a>
                    </li> -->

                   <!--  <li class="dropdown dropdown-submenu">
                        <a href="/test_cardMis/pages/card/cib/contract_error/cib_error_report.php" class="dropdown-toggle">&nbsp;&nbsp;
                            <i class="fa fa-angle-double-right"></i>  Contract Error
                         </a>
                    </li> -->

                   


                   <!--  <li class="dropdown dropdown-submenu">
                        <a href="/test_cardMis/pages/card/cib/bb_accept_files/bb_accept_files.php" class="dropdown-toggle">&nbsp;&nbsp;
                            <i class="fa fa-angle-double-right"></i> Upload BB files
                         </a>
                    </li> -->

                   

                   <!--    <li class="dropdown dropdown-submenu">
                        <a href="/test_cardMis/pages/card/cib/data_archive/show_subject_archive.php" class="dropdown-toggle">&nbsp;&nbsp;
                            <i class="fa fa-angle-double-right"></i>  Archive Subject Info
                         </a>
                    </li>

                     <li class="dropdown dropdown-submenu">
                        <a href="/test_cardMis/pages/card/cib/data_archive/show_contract_archive.php" class="dropdown-toggle">&nbsp;&nbsp;
                            <i class="fa fa-angle-double-right"></i>  Archive Contract Info
                         </a>
                    </li>

                     <li class="dropdown dropdown-submenu">
                        <a href="/test_cardMis/pages/card/cib/cib_merge/cib_merge.php" class="dropdown-toggle">&nbsp;&nbsp;
                            <i class="fa fa-angle-double-right"></i>  Merge CIB File
                         </a>
                    </li>


                     <li class="dropdown dropdown-submenu">
                        <a href="/test_cardMis/pages/card/cib/cib_report/previous_month.php" class="dropdown-toggle">&nbsp;&nbsp;
                            <i class="fa fa-angle-double-right"></i>  Previous CIB  Report
                         </a>
                    </li>  -->

                    <!--  <li class="dropdown dropdown-submenu">
                        <a href="/test_cardMis/pages/card/cib/error_report/error_report.php" class="dropdown-toggle">&nbsp;&nbsp;
                            <i class="fa fa-angle-double-right"></i> Error Report
                         </a>
                    </li> -->


               <!--  </ul>                            
            </li> -->
            <!-- /CIB-->
            


           
            
           
            <!-- Operation -->
            <!-- <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>OPERATION</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/test_cardMis/pages/card/uploadXml.php"><i class="fa fa-angle-double-right"></i>Upload XML</a></li>
                    <li class="active"><a href="/test_cardMis/pages/card/generatePDF.php"><i class="fa fa-angle-double-right"></i>Generate PDF Statement</a></li>
                    <li class="active"><a href="/test_cardMis/pages/card/sendStmtInd.php"><i class="fa fa-angle-double-right"></i>Send Individual Statement</a></li>
                    <li class="active"><a href="/test_cardMis/pages/card/sendStmt.php"><i class="fa fa-angle-double-right"></i>Send Group Statement</a></li>
 -->

                    
                    <!-- for card charge  -->
                    <!--  <li  class="active dropdown"><a style="text-transform: uppercase;" class="dropdown-toggle" data-toggle="dropdown"  href="#"><i class="fa fa-angle-double-right"></i>CHARGE <b class="caret pull-right" style="margin-top: 10px;  margin-right: 8px;"></b></a>
                        <ul class="dropdown-menu" style="background-color: gainsboro; width: 100%; text-transform: capitalize;">
                            <li class="dropdown dropdown-submenu">
                                <a href="/test_cardMis/pages/card/card_charge/chargeFileUpload.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> Import Charge File
                                 </a>
                            </li> -->

                             <!-- <li class="dropdown dropdown-submenu">
                                <a href="/test_cardMis/pages/card/card_charge/card_charge.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> Debit Charge
                                 </a>
                            </li>  -->
                            <!--  <li class="dropdown dropdown-submenu">
                                <a href="/test_cardMis/pages/card/auto_charge/auto_chargeFileUpload.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> Auto Debit Charge
                                 </a>
                            </li>

                             <li class="dropdown dropdown-submenu">
                                <a href="/test_cardMis/pages/card/branch_charge/branch_chargeFileUpload.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> Branch Debit Charge
                                 </a>
                            </li>

                            <?php 
                            if($_SESSION['branch_id'] == 1)
                            {
                                
                                ?>

                                     <li class="dropdown dropdown-submenu">
                                        <a href="/test_cardMis/pages/card/branch_charge/authorize/auth_charge.php" class="dropdown-toggle">&nbsp;&nbsp;
                                             <i class="fa fa-circle-o" aria-hidden="true"></i> Authorize Debit Charge
                                         </a>
                                    </li>

                                <?php

                            }
                             ?>

                            <li class="dropdown dropdown-submenu">
                                <a href="/test_cardMis/pages/card/charge_setup/rate_setUp.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> Rate Set Up
                                 </a>
                            </li>

                             <li class="dropdown dropdown-submenu">
                                <a href="/test_cardMis/pages/card/charge_setup/rate_list.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> Rate List
                                 </a>
                            </li>
                            

                        </ul>
                     </li> -->
                      <!-- for charge  -->

                     <!--  for debit advice -->
                      <!-- <li class="active"><a href="/test_cardMis/pages/card/charge_advice/import_charge_advice.php"><i class="fa fa-angle-double-right"></i>Debit Advice Charge</a></li> -->


                     <!--   <li  class="active dropdown"><a style="text-transform: uppercase;" class="dropdown-toggle" data-toggle="dropdown"  href="#"><i class="fa fa-angle-double-right"></i>Debit Advice Charge <b class="caret pull-right" style="margin-top: 10px;  margin-right: 8px;"></b></a>
                        <ul class="dropdown-menu" style="background-color: gainsboro; width: 100%; text-transform: capitalize;">
                            <li class="dropdown dropdown-submenu">
                                <a href="/test_cardMis/pages/card/charge_advice/import_charge_advice.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> Import Advice File
                                 </a>
                            </li>

                             <li class="dropdown dropdown-submenu">
                                <a href="/test_cardMis/pages/card/charge_advice/download_txt_file.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> Download text file
                                 </a>
                            </li> 
                        </ul>
                     </li> -->
                     <!--  for debit advice -->


               <!--  </ul>
            </li> -->
            <!-- / Operation -->
            <!-- ------------------------------------------------- Ramjan --------------------------------------------------------------->
        

            <!-- ------------------------------------------------- Ramjan --------------------------------------------------------------->
             <!-- Card Report -->
            <!-- <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>CARD REPORT</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/test_cardMis/pages/card/customer.php"><i class="fa fa-angle-double-right"></i> Customer List</a></li>
                    <li class="active"><a href="/test_cardMis/pages/card/report_transaction.php"><i class="fa fa-angle-double-right"></i> Transaction List</a></li>
                    <li class="active"><a href="/test_cardMis/pages/card/report_overdue.php"><i class="fa fa-angle-double-right"></i> OverDue List</a></li> -->

                     <!-- for card charge report -->
                    <!--  <li  class="active dropdown"><a style="text-transform: uppercase;" class="dropdown-toggle" data-toggle="dropdown"  href="#"><i class="fa fa-angle-double-right"></i>CHARGE REPORT <b class="caret pull-right" style="margin-top: 10px;  margin-right: 8px;"></b></a>
                        <ul class="dropdown-menu" style="background-color: gainsboro; width: 100%; text-transform: capitalize;">
                            <li class="dropdown dropdown-submenu">
                                <a href="/test_cardMis/pages/card/report/charge_report/charge_report.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> Charge Report
                                 </a>
                            </li>
                        </ul>
                     </li> -->
                      <!-- for charge  report-->



                    <!-- for card charge report -->
                     <!-- <li  class="active dropdown"><a style="text-transform: uppercase;" class="dropdown-toggle" data-toggle="dropdown"  href="#"><i class="fa fa-angle-double-right"></i>CIB REPORT <b class="caret pull-right" style="margin-top: 10px;  margin-right: 8px;"></b></a>
                        <ul class="dropdown-menu" style="background-color: gainsboro; width: 100%; text-transform: capitalize;">
                            <li class="dropdown dropdown-submenu">
                                <a href="/test_cardMis/pages/card/report/cib/download_history.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> Cib Download History 
                                 </a>
                            </li>
                        </ul>
                     </li> -->
                      <!-- for charge  report-->
                                                    
              <!--   </ul>
            </li> -->
            <!-- /Card Report -->
            <!-- Admin Panel -->
            <?php 
            if($_SESSION['branch_id'] == '1')

            {
                ?>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>CARD REPORT</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    
                     <!-- for card Requisition report -->
                     <li  class="dropdown"><a style="text-transform: uppercase;" class="dropdown-toggle" data-toggle="dropdown"  href="#"><i class="fa fa-angle-double-right"></i>Requisition<b class="caret pull-right" style="margin-top: 10px;  margin-right: 8px;"></b></a>
                        <ul class="dropdown-menu" style="background-color: gainsboro; width: 100%; text-transform: capitalize;">
                            <li class="dropdown dropdown-submenu">
                                <a href="/test_cardMis/pages/card/report/card/requisition/card_requisition.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> Request Report
                                 </a>
                            </li>
                        </ul>
                     </li>
                      <!-- for Requisition  report-->                        


                </ul>
            </li>

                <li class="treeview active">
                    <a href="#">
                        <i class="fa fa-table"></i> <span>ADMIN PANEL</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                       <!--  <li class="active"><a href="/test_cardMis/pages/card/create_new_admin.php"><i class="fa fa-angle-double-right"></i>Create new admin</a></li> -->
                        <li><a class="active" href="/test_cardMis/pages/card/new_user_create.php"><i class="fa fa-angle-double-right"></i> Create new user</a></li>
                        <li><a href=/test_cardMis/pages/card/existing_user_list.php><i class="fa fa-angle-double-right"></i> Existing User List</a></li>
                        <!-- <li class="active"><a href=/test_cardMis/pages/card/existing_admin_list.php><i class="fa fa-angle-double-right"></i> Existing Admin List</a></li> -->
                    </ul>                            
                </li>


                <?php
            }


             ?>
            
            <!-- / Admin Panel -->
            </ul>
    </section>
    <!-- /.sidebar -->
</aside