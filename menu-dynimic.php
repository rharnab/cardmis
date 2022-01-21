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
        
        <ul class="sidebar-menu">
       

            <li class="active">
                <a href="/cardMis/dashboard.php">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
                </a>
            </li>
             
            
                <?php 
                    $role = $_SESSION['role_id'];
                    $main_query=mysql_query("SELECT * from menu_table where status='1' and parent='0' and role like '%$role%' ");
                    if(mysql_num_rows($main_query) > 0)
                    {
                        while($main_result = mysql_fetch_assoc($main_query))
                        {
                            $role_array = explode(',', $main_result['role']);
                            if(in_array($role, $role_array))
                            {
                                $menu_name=$main_result['menu_name'];
                                $link=$main_result['link'];
                                $main_menu_id=$main_result['sl'];
                                $icon=$main_result['icon'];

                                ?>
                                <!-- Card Report -->
                                <li class="treeview">
                                    <a href=" <?php echo $link ?> ">
                                        <i class="fa fa-table"></i> <span><?php echo $menu_name; ?></span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <?php 
                                        $sub_query=mysql_query("SELECT * from menu_table where status='2' and parent='$main_menu_id' and role like '%$role%' ");

                                        while($sub_menu_result = mysql_fetch_assoc($sub_query))
                                        {
                                            $sub_menu_name=$sub_menu_result['menu_name'];
                                            $sub_menu_link=$sub_menu_result['link'];
                                            $sub_menu_id=$sub_menu_result['sl'];


                                            $sub_sub_query=mysql_query("SELECT * from menu_table where (status='3' or status='4') and parent='$sub_menu_id' and role like '%$role%'");

                                                if(mysql_num_rows($sub_sub_query)==0)
                                                {
                                                    ?>
                                                        <li class="active"><a href="<?php echo  $sub_menu_link ?>"><i class="fa fa-angle-double-right"></i><?php echo  $sub_menu_name ?></a></li>

                                                    <?php   
                                                   
                                                }

                                                else
                                                {
                                                    
                                                        ?>

                                                         <!-- for card Requisition report -->
                                                         <li  class="active dropdown"><a style="text-transform: uppercase;" class="dropdown-toggle" data-toggle="dropdown"  href="#"><i class="fa fa-angle-double-right"></i><?php echo $sub_menu_name ?><b class="caret pull-right" style="margin-top: 10px;  margin-right: 8px;"></b></a>
                                                            <ul class="dropdown-menu" style="background-color: gainsboro; width: 100%; text-transform: capitalize;">

                                                                <?php 
                                                                    while($sub_sub_result = mysql_fetch_assoc($sub_sub_query))
                                                                    {
                                                                        $sub_sub_menu_name=$sub_sub_result['menu_name'];
                                                                        $sub_sub_menu_link=$sub_sub_result['link'];

                                                                        ?>

                                                                         <li class="dropdown dropdown-submenu">
                                                                            <a href="<?php echo $sub_sub_menu_link ?>" class="dropdown-toggle">&nbsp;&nbsp;
                                                                                 <i class="fa fa-circle-o" aria-hidden="true"></i> new <?php echo  $sub_sub_menu_name ?>
                                                                             </a>
                                                                        </li>

                                                                        <?php
                                                                    }


                                                                 ?>

                                                            </ul>
                                                         </li>
                                                          <!-- for Requisition  report--> 
                                                        <?php
 
                                                }//else

                                        } // sub menu while


                                         ?>

                                        

                                                               

                                    </ul>

                                </li>
                         <!-- /Card Report -->
                                <?php
                            }
                        }
                    }




                 ?>



                




          
            </ul>
    </section>
    <!-- /.sidebar -->
</aside