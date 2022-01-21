<?php 
    include('pages/card/functions/functions.php');
    include_once("pages/card/db/dbconnect.php");
    include('pages/card/database.php');
    $cur_user_id = $_SESSION['id'];
    $cur_user = $conn->prepare("SELECT * FROM users WHERE uid=?");
    $cur_user->bindValue(1,$cur_user_id);
    $cur_user->execute();
    $rowData = $cur_user->fetch(PDO::FETCH_OBJ);

?>
        <header class="header">
            <a href="/cardMis/dashboard.php" class="logo">CardMIS</a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <?php 
                $branch_id = $_SESSION['branch_id'];
                 $query=mysql_query("SELECT br_title from branches where id = '$branch_id' ");
                 $br_result =mysql_fetch_assoc($query);

                 ?>
                 <a href="/cardMis/dashboard.php" class="logo" style="background-color: transparent; text-align: right; font-size: 15px;"> 
                 <?php echo $br_result['br_title']; ?></a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
						<!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning">1</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 1 notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-people info"></i> 10 new card issue
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
						<!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span><?php echo $rowData->user_fname." ".$rowData->user_lname; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-12 text-center">
                                        <a href="#"><?php echo "Admin Type ".$rowData->is_admin; ?></a>
                                    </div>
                                </li>							
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Change Password</a>
                                    </div>
                                    <div class="pull-right">
                                      <!--   <a href="<?php echo url('/logout.php');?>" class="btn btn-default btn-flat">Sign out</a> -->
                                        <a href="/cardMis/logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        
        </header>