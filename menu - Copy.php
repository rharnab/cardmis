<?php
    include_once("pages/card/db/dbconnect.php");
    include_once("pages/card/functions/functions.php");
    $select_role = $conn->prepare("SELECT * FROM role");
    $select_role->execute();
    $data = '';
    while($rowData = $select_role->fetch(PDO::FETCH_ASSOC)){
        $data.="
            <li>$rowData[role_name]</li>
        ";
    }
?>


s

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
                <img src="/cardMis/img/avatar3.png" class="img-circle" alt="User Image"/>
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
                <a href="/cardMis/dashboard.php">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
                </a>
            </li>
            <!-- Utility Setup -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>UTILITY SETUP</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/cardMis/pages/card/create_branch.php"><i class="fa fa-angle-double-right"></i>Create New Branch</a></li>
                    <li class="active"><a href="/cardMis/pages/card/all_br_view.php"><i class="fa fa-angle-double-right"></i>View All Branch</a></li>

                    <!-- ramjan utitlity set up -->
                    <!-- for contract phase -->
                     <li  class="active dropdown"><a class="dropdown-toggle" data-toggle="dropdown"  href="/cardMis/pages/card/peramiter/contract_phase/create_contract_phase.php"><i class="fa fa-angle-double-right"></i>Contract Phase <b class="caret pull-right" style="margin-top: 10px;  margin-right: 8px;"></b></a>
                        <ul class="dropdown-menu" style="background-color: gainsboro; width: 100%;">
                            <li class="dropdown dropdown-submenu">
                                <a href="/cardMis/pages/card/peramiter/contract_phase/create_contract_phase.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> Create Contract Phase
                                 </a>
                            </li>

                             <li class="dropdown dropdown-submenu">
                                <a href="/cardMis/pages/card/peramiter/contract_phase/all_contract_phase.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> All Contract Phase
                                 </a>
                            </li> 
                        </ul>
                     </li>
                      <!-- for contract phase -->

                    <!-- for contract type -->
                     <li  class="active dropdown"><a class="dropdown-toggle" data-toggle="dropdown"  href="/cardMis/pages/card/peramiter/contract_type/create_contract_type.php"><i class="fa fa-angle-double-right"></i>Contract type <b class="caret pull-right" style="margin-top: 10px;  margin-right: 8px;"></b> </a>
                        <ul class="dropdown-menu" style="background-color: gainsboro; width: 100%;">
                            <li class="dropdown dropdown-submenu">
                                <a href="/cardMis/pages/card/peramiter/contract_type/create_contract_type.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> Create Contract Type
                                 </a>
                            </li>

                             <li class="dropdown dropdown-submenu">
                                <a href="/cardMis/pages/card/peramiter/contract_type/all_contract_type.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> All Contract Type
                                 </a>
                            </li> 
                        </ul>
                     </li>
                      <!-- for contract type -->


                      <!-- for currency code -->
                     <li  class="active dropdown"><a class="dropdown-toggle" data-toggle="dropdown"  href="/cardMis/pages/card/peramiter/currency_code/create_currency_code.php"><i class="fa fa-angle-double-right"></i>Currency  <b class="caret pull-right" style="margin-top: 10px;  margin-right: 8px;"></b> </a>
                        <ul class="dropdown-menu" style="background-color: gainsboro; width: 100%;">
                            <li class="dropdown dropdown-submenu">
                                <a href="/cardMis/pages/card/peramiter/currency_code/create_currency_code.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> Create Currency
                                 </a>
                            </li>

                             <li class="dropdown dropdown-submenu">
                                <a href="/cardMis/pages/card/peramiter/currency_code/all_currency_code.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> All Currency
                                 </a>
                            </li> 
                        </ul>
                     </li>
                      <!-- for currency code -->


                       <!-- for periodicity -->
                     <li  class="active dropdown"><a class="dropdown-toggle" data-toggle="dropdown"  href="/cardMis/pages/card/peramiter/periodicity/create_currency_code.php"><i class="fa fa-angle-double-right"></i>Periodicity  <b class="caret pull-right" style="margin-top: 10px;  margin-right: 8px;"></b> </a>
                        <ul class="dropdown-menu" style="background-color: gainsboro; width: 100%;">
                            <li class="dropdown dropdown-submenu">
                                <a href="/cardMis/pages/card/peramiter/periodicity/create_periodicity.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> Create Periodicity
                                 </a>
                            </li>

                             <li class="dropdown dropdown-submenu">
                                <a href="/cardMis/pages/card/peramiter/periodicity/all_periodicity.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> All Periodicity
                                 </a>
                            </li> 
                        </ul>
                     </li>
                      <!-- for payment method  -->

                         <!-- for periodicity -->
                     <li  class="active dropdown"><a class="dropdown-toggle" data-toggle="dropdown"  href="/cardMis/pages/card/peramiter/payment_method/create_payment_method.php"><i class="fa fa-angle-double-right"></i>Payment Method  <b class="caret pull-right" style="margin-top: 10px;  margin-right: 8px;"></b> </a>
                        <ul class="dropdown-menu" style="background-color: gainsboro; width: 100%;">
                            <li class="dropdown dropdown-submenu">
                                <a href="/cardMis/pages/card/peramiter/payment_method/create_payment_method.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> Create Payment Method
                                 </a>
                            </li>

                             <li class="dropdown dropdown-submenu">
                                <a href="/cardMis/pages/card/peramiter/payment_method/all_payment_method.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> All Payment Method
                                 </a>
                            </li> 
                        </ul>
                     </li>
                      <!-- for payment method code -->

                    <!-- ramjan utitlity set up -->


                </ul>                            
            </li>
            <!-- Requisition-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>DEBIT CARD REQUISITION</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/cardMis/pages/card/debitCardCreate.php"><i class="fa fa-angle-double-right"></i>Create Debit Card</a></li>
                    <!-- Drop Down--->
                    <li class="treeview">
                        <a href="#"><i class="fa fa-angle-double-right"></i>
                            Requested Card Status
                        </a>
                        <ul class="treeview-menu">
                            <li class="active"><a href="/cardMis/pages/card/branch_debit_card_sts.php"><i class="fa fa-angle-double-right"></i>Requested Card List</a></li>
                            <li class="active"><a href="/cardMis/pages/card/approve_debit_card_sts.php"><i class="fa fa-angle-double-right"></i>Approve Card Status</a></li>  
                        </ul>
                    </li>
                    <!-- /Drop Down--->
                    <li class="active"><a href="/cardMis/pages/card/debit_card_auth.php"><i class="fa fa-angle-double-right"></i>Branch Authentication</a></li>
                    <li class="active"><a href="/cardMis/pages/card/debitCardStatus.php"><i class="fa fa-angle-double-right"></i>Generate XML for Debit Card</a></li>
                    <li class="active"><a href="/cardMis/pages/card/debit_card_sms.php"><i class="fa fa-angle-double-right"></i>Debit Card SMS</a></li>
                    <li class="active"><a href="/cardMis/pages/card/debit_card_email.php"><i class="fa fa-angle-double-right"></i>Debit Card E-mail</a></li>
                    
                </ul>                            
            </li>
            <!-- /Requisition-->
            <!-- Credit Card-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>CREDIT CARD REQUISITION</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/cardMis/pages/card/creditCardCreate.php"><i class="fa fa-angle-double-right"></i>Create New Card</a></li>
                    <li class="active"><a href="/cardMis/pages/card/cardStatus.php"><i class="fa fa-angle-double-right"></i>Existing Card Status</a></li>
                </ul>                            
            </li>
            <!-- /Credit Card-->
            <!-- Card Activation-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>CARD ACTIONS</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/cardMis/pages/card/card_activation.php"><i class="fa fa-angle-double-right"></i>Card Activation</a></li>
                </ul>                            
            </li>
            <!-- /Card Activation-->
            <!-- Card Payments-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>PAYMENTS</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/cardMis/pages/card/card_bill_payments.php"><i class="fa fa-angle-double-right"></i>Card Bill</a></li>
                </ul>                            
            </li>
            <!-- /Card Payments-->
            <!-- Access Manage -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>ACCESS MANAGEMENT</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/cardMis/pages/card/add_user_permission.php"><i class="fa fa-angle-double-right"></i>Add user permission</a></li>
                </ul>                            
            </li>
            <!-- /Access Manage -->
            <!-- Text File Read-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>TEXT FILE READ</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/cardMis/pages/card/uploadTextFile.php"><i class="fa fa-angle-double-right"></i>Upload Text File</a></li>
                    <li class="active"><a href="/cardMis/pages/card/get_csv_txt_excel.php"><i class="fa fa-angle-double-right"></i>Get File (csv,txt,excel)</a></li>
                    <li class="active"><a href="/cardMis/pages/card/text_file_report.php"><i class="fa fa-angle-double-right"></i>Get Report</a></li>
                </ul>                            
            </li>
            <!-- /Text File Read-->
            <!-- Role -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i><span>ROLE MANAGE</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/cardMis/pages/card/role.php"><i class="fa fa-angle-double-right"></i>User Roles</a></li>
                    <li class="active"><a href="/cardMis/pages/card/permission.php"><i class="fa fa-angle-double-right"></i>Permission</a></li>
                </ul>                            
            </li>
            <!-- /Role-->
            <!-- Campaign-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>SMS/EMAIL SERVICE</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/cardMis/pages/card/mobile_sms_campaign.php"><i class="fa fa-angle-double-right"></i>Mobile SMS</a></li>
                </ul>                            
            </li>
            <!-- /Campaign-->
            <!-- Bill Payment -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>BILL PAYMENT</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/cardMis/pages/card/bill_collection.php"><i class="fa fa-angle-double-right"></i> Cash Payment</a></li>
                    <li class="active"><a href="/cardMis/pages/card/bill_collection_transfer.php"><i class="fa fa-angle-double-right"></i> Fund Transfer</a></li>
                </ul>                            
            </li>
            <!-- /Bill Payment -->
            <!-- Bill Info -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>BILL INFO</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/cardMis/pages/card/bill_payment_his.php"><i class="fa fa-angle-double-right"></i> Bill Payment History</a></li>
                    <li class="active"><a href="/cardMis/pages/card/generate_bill.php"><i class="fa fa-angle-double-right"></i> Bill File Generate</a></li>
                </ul>                            
            </li>
            <!-- /Bill Info -->
            <!-- Card Report -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>CARD REPORT</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/cardMis/pages/card/customer.php"><i class="fa fa-angle-double-right"></i> Customer List</a></li>
                    <li class="active"><a href="/cardMis/pages/card/report_transaction.php"><i class="fa fa-angle-double-right"></i> Transaction List</a></li>
                    <li class="active"><a href="/cardMis/pages/card/report_overdue.php"><i class="fa fa-angle-double-right"></i> OverDue List</a></li>
                                                    
                </ul>
            </li>
            <!-- /Card Report -->
            <!-- Operation -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>OPERATION</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/cardMis/pages/card/uploadXml.php"><i class="fa fa-angle-double-right"></i>Upload XML</a></li>
                    <li class="active"><a href="/cardMis/pages/card/generatePDF.php"><i class="fa fa-angle-double-right"></i>Generate PDF Statement</a></li>
                    <li class="active"><a href="/cardMis/pages/card/sendStmtInd.php"><i class="fa fa-angle-double-right"></i>Send Individual Statement</a></li>
                    <li class="active"><a href="/cardMis/pages/card/sendStmt.php"><i class="fa fa-angle-double-right"></i>Send Group Statement</a></li>
                </ul>
            </li>
            <!-- / Operation -->
            <!-- ------------------------------------------------- Ramjan --------------------------------------------------------------->
             <!-- charge -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>CHARGE</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/cardMis/pages/card/card_charge/chargeFileUpload.php"><i class="fa fa-angle-double-right"></i>Import</a></li>
                    <li class="active"><a href="/cardMis/pages/card/card_charge/card_charge.php"><i class="fa fa-angle-double-right"></i>Debit Charge</a></li>

                    
                   
                </ul>
            </li>
            <!-- / charge -->


            <!-- cib -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>CIB Informatione</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">

                    <li class="active"><a href="/cardMis/pages/card/cib/import_subject.php"><i class="fa fa-angle-double-right"></i>Import MIS FILE</a></li>
                    <li class="active"><a href="/cardMis/pages/card/cib/import_contracts.php"><i class="fa fa-angle-double-right"></i>IMPORT CL FILE</a></li>
                     <li class="active"><a href="/cardMis/pages/card/cib/generate_cib.php"><i class="fa fa-angle-double-right"></i>Generate CIB</a></li>
                    <li class="active"><a href="/cardMis/pages/card/cib/download_cib.php"><i class="fa fa-angle-double-right"></i>DOWNLOAD CIB</a></li>
                     <li class="active"><a href="/cardMis/pages/card/cib/modify_subject.php"><i class="fa fa-angle-double-right"></i>MODIFY SUBJECT</a></li>
                    <li class="active"><a href="/cardMis/pages/card/cib/modify_contract.php"><i class="fa fa-angle-double-right"></i>MODIFY CONTRACTS</a></li>

                    
                   
                </ul>
            </li>
            <!-- / cib -->

            <!-- ------------------------------------------------- Ramjan --------------------------------------------------------------->
            <!-- Admin Panel -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>ADMIN PANEL</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/cardMis/pages/card/create_new_admin.php"><i class="fa fa-angle-double-right"></i>Create new admin</a></li>
                    <li class="active"><a href="/cardMis/pages/card/new_user_create.php"><i class="fa fa-angle-double-right"></i> Create new user</a></li>
                    <li class="active"><a href=/cardMis/pages/card/existing_user_list.php><i class="fa fa-angle-double-right"></i> Existing User List</a></li>
                    <li class="active"><a href=/cardMis/pages/card/existing_admin_list.php><i class="fa fa-angle-double-right"></i> Existing Admin List</a></li>
                </ul>                            
            </li>
            <!-- / Admin Panel -->
            </ul>
    </section>
    <!-- /.sidebar -->
</aside