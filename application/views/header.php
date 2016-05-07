<?php
$c_user = get_profile();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php if(isset($title)) echo str_replace('_',' ',$title).' | '; ?>Admin</title>

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <?php if(function_exists('page_css')) page_css() ; ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-blue">
<!-- header logo: style can be found in header.less -->
<header class="header">
    <a href="<?php echo base_url('dashboard'); ?>" class="logo">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        <?php echo get_option('company_name'); ?>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-right">
            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <span><?php echo $c_user->first_name .' '.$c_user->last_name; ?>
                            <i class="caret"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            <img src="<?php echo profile_photo_url($c_user->photo, $c_user->email); ?>" class="img-circle" alt="User Image" />
                            <p>
                                <?php echo $c_user->first_name .' '.$c_user->last_name. ' <br />';
                                    echo $c_user->profession;
                                ?>
                                <small>Member since <?php  date($c_user->created_at); ?></small>
                            </p>
                        </li>


                        <!-- helper links -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="<?php echo base_url('activity'); ?>">Activity</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="<?php echo base_url('product'); ?>">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="<?php echo base_url('user/log') ?>">Log</a>
                            </div>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo base_url('user/profile') ?>" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo base_url('dashboard/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">

    <?php include('admin_left_menu.php'); ?>

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php if(isset($title)) echo ucfirst(str_replace('_',' ',$title)); ?>
                <small><?php if(isset($small_title)) echo ucfirst($small_title); ?></small>
            </h1>
            <?php echo breadcrumb(); ?>
        </section>

        <?php echo flash_msg(); ?>