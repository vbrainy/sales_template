<?php
$currentAuthDta = loggedInUserData();
$currentUser = $currentAuthDta['role'];
?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo profile_photo_url($c_user->photo,$c_user->email); ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php echo $c_user->first_name .' '.$c_user->last_name; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>


        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li>
                <a href="<?php echo base_url('dashboard'); ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <?php
                if($currentUser == 'admin'){
            ?>

<!--            <li class="treeview <?php echo menu_li_active('category'); ?>">
                <a href="#">
                    <i class="fa fa-sitemap"></i>
                    <span>Category</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php echo menu_link('category', 'All Category'); ?>
                    <?php echo menu_link('category/add_category', 'Add Category'); ?>
                </ul>
            </li>

            <li class="treeview <?php echo menu_li_active('product'); ?>">
                <a href="#">
                    <i class="fa fa-support"></i>
                    <span>Product</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php echo menu_link('product', 'All Invoice'); ?>
                    <?php echo menu_link('product/new_product_sell', 'New product sell'); ?>
                </ul>
            </li>-->


            <li>
                <a href="<?php echo base_url('agent'); ?>">
                    <i class="fa fa-group"></i> <span>Agent</span>
                </a>
            </li>
            
            <li>
                <a href="<?php echo base_url("tasks"); ?>">
                    <i class="fa fa-tasks"></i>
                    <span>Task</span>
                </a>
            </li>

            <li class="treeview <?php echo menu_li_active('user'); ?>">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>My Profile</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php //echo menu_link('user', 'All user'); ?>
                    <?php echo menu_link('user/profile', 'Profile'); ?>
                    <?php echo menu_link('user/change_pass', 'Change Password'); ?>
                </ul>
            </li>


            <li class="treeview <?php echo menu_li_active('account'); ?>">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Account</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php echo menu_link('account/make_payment', 'Make Payment'); ?>
                    <?php echo menu_link('account', 'Earning'); ?>
                    <?php echo menu_link('account/withdrawal_payment', 'Withdrawal Payment'); ?>
                    <?php echo menu_link('account/agents_sales', 'Agent\'s Sales'); ?>
                    <?php echo menu_link('account/requested_payment_list', 'Requested Payment List'); ?>

                </ul>
            </li>


            <li class="treeview <?php echo menu_li_active('admin_settings'); ?>">
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span>Admin Settings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php echo menu_link('admin_settings', 'Default Settings'); ?>
                    <?php /*echo menu_link('admin_settings/settingsLog', 'Settings Changed Log');*/ ?>
                    <?php echo menu_link('admin_settings/addAdmin', 'Add Admin'); ?>
                    <?php echo menu_link('admin_settings/all_admin', 'Admin List'); ?>
                </ul>
            </li>

            <?php } elseif($currentUser == 'agent'){ ?>

<!--                <li class="treeview <?php echo menu_li_active('product'); ?>">
                    <a href="#">
                        <i class="fa fa-support"></i>
                        <span>Product</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php echo menu_link('product', 'All Invoice'); ?>
                        <?php echo menu_link('product/new_product_sell', 'New product sell'); ?>
                    </ul>
                </li>-->

                <li class="treeview <?php echo menu_li_active('user'); ?>">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>My Profile</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php echo menu_link('user/profile', 'Profile'); ?>
                        <?php echo menu_link('user/change_pass', 'Change Password'); ?>
                    </ul>
                </li>
                
                  <li>
                <a href="<?php echo base_url('myjobs'); ?>">
                    <i class="fa fa-briefcase"></i> <span>My Tasks</span>
                </a>
            </li>
                

                <li class="treeview <?php echo menu_li_active('account'); ?>">
                    <a href="#">
                        <i class="fa fa-money"></i>
                        <span>Account</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php echo menu_link('account', 'Earning'); ?>
                        <?php echo menu_link('account/withdrawal_payment', 'Withdrawal Payment'); ?>
                        <?php echo menu_link('account/request_payment', 'Request for Payment'); ?>
                        <?php echo menu_link('account/requested_payment_list', 'Requested Payment List'); ?>

                    </ul>
                </li>

            <?php } elseif($currentUser == 'user'){ ?>

                <li class="treeview <?php echo menu_li_active('product'); ?>">
                    <a href="#">
                        <i class="fa fa-support"></i>
                        <span>Product</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php echo menu_link('product', 'All Invoice'); ?>
                    </ul>
                </li>

                <li class="treeview <?php echo menu_li_active('user'); ?>">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>My Profile</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php echo menu_link('user/profile', 'Profile'); ?>
                        <?php echo menu_link('user/change_pass', 'Change Password'); ?>
                    </ul>
                </li>

                <li class="treeview <?php echo menu_li_active('account'); ?>">
                    <a href="#">
                        <i class="fa fa-money"></i>
                        <span>Account</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php echo menu_link('account', 'Earning'); ?>
                        <?php echo menu_link('account/withdrawal_payment', 'Withdrawal Payment'); ?>
                        <?php echo menu_link('account/request_payment', 'Request for Payment'); ?>
                    </ul>
                </li>

            <?php } ?>


        </ul>
    </section>
    <!-- /.sidebar -->
<?php creditsMhs(); ?>
</aside>
