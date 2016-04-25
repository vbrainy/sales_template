<?php
foreach($earnings->result() as $earning);
foreach($referralEarnings->result() as $referralEarning);
foreach($withdrawal->result() as $withdraws);

$totalEarning = $earning->amount;
$refEarning = $referralEarning->amount;
$withdraw = $withdraws->amount;

$rowEarning = $totalEarning - $refEarning;
$credit     = $totalEarning - $withdraw;

$loggedInUser = loggedInUserData();
?>

<?php function page_css(){ ?>
    <!-- Morris chart -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php include('header.php'); ?>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?php  echo amountFormat($rowEarning); ?>
                                    </h3>
                                    <p>
                                        Earning
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?php echo base_url('account'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <?php  echo amountFormat($refEarning); ?>
                                    </h3>
                                    <p>
                                        Referral Earning
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="<?php echo base_url('account'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <?php  echo amountFormat($totalEarning); ?>
                                    </h3>
                                    <p>
                                        Total Earning
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="<?php echo base_url('account'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        <?php  echo amountFormat($withdraw); ?>
                                    </h3>
                                    <p>
                                        Total Withdraw
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="<?php echo base_url('account/withdrawal_payment'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->




                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>
                                        <?php  echo amountFormat($credit); ?>
                                    </h3>
                                    <p>
                                        Balance / Credit
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-cart-outline"></i>
                                </div>
                                <a href="<?php echo base_url('account/withdrawal_payment'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-purple">
                                <div class="inner">
                                    <h3>
                                        <?php echo $totalInvoice; ?>
                                    </h3>
                                    <p>
                                        <?php
                                            if($loggedInUser['role'] == 'admin')
                                            {
                                                echo 'Total Invoice';
                                            }
                                            elseif($loggedInUser['role'] == 'agent')
                                            {
                                                echo 'Total Sales Invoice';
                                            }
                                            elseif($loggedInUser['role'] == 'user')
                                            {
                                                echo 'Total Purchase Invoice';
                                            }

                                        ?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-briefcase-outline"></i>
                                </div>
                                <a href="<?php echo base_url('product'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <?php if($loggedInUser['role'] == 'admin') { ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-teal">
                                <div class="inner">
                                    <h3>
                                        <?php echo $totalAgent; ?>
                                    </h3>
                                    <p>
                                        Total Agent
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-alarm-outline"></i>
                                </div>
                                <a href="<?php echo base_url('agent'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-maroon">
                                <div class="inner">
                                    <h3>
                                        <?php echo $totalUser; ?>
                                    </h3>
                                    <p>
                                        Total User
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-pricetag-outline"></i>
                                </div>
                                <a href="<?php echo base_url('user'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <?php } ?>

                    </div><!-- /.row -->



                    <div class="row">
                        <section class="col-lg-12 connectedSortable">
                            <!-- Custom tabs (Charts with tabs)-->
                            <div class="nav-tabs-custom">
                                <!-- Tabs within a box -->
                                <ul class="nav nav-tabs pull-right">
                                    <li class="pull-left header"><i class="fa fa-inbox"></i> Sales Chart for <?php echo date('Y'); ?></li>
                                </ul>
                                <div class="tab-content no-padding">
                                    <div id="areaSales" style="height: 300px;"></div>
                                </div>
                            </div><!-- /.nav-tabs-custom -->
                        </section>
                    </div>



                </section><!-- /.content -->


<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!-- Morris.js charts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/morris/morris.min.js" type="text/javascript"></script>


    <script>
        Morris.Area({
            element: 'areaSales',
            data: <?php echo $salesGraphJson; ?>,
            parseTime: false,
            xkey: 'm',
            ykeys: ['amount'],
            labels: ['Sales Amount']
        });
    </script>



