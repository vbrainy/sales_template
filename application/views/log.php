<?php function page_css(){ ?>
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php
                        if( ! empty($logsOwner))
                        {
                            echo user_full_name($logsOwner).'\'s ';
                        }else{
                            echo user_full_name($c_user).'\'s ';
                        }
                        echo "<small> Last {$logs->num_rows()} Log's</small></h3>";
                        ?>

                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Ip Address</th>
                            <th>Device Info</th>
                            <th>Time</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        if($logs->num_rows() > 0){
                            foreach($logs->result() as $r){
                               echo '<tr>
                                    <td>'.$r->ip.'</td>
                                    <td>'.$r->device_info.'</td>
                                    <td>'.date('d/m/Y h:i A',$r->created_at).'</td>
                                </tr>';

                            }
                        }

                        ?>




                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Ip Address</th>
                            <th>Device Info</th>
                            <th>Time</th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div>
    </div>

</section><!-- /.content -->

<?php function page_js(){ ?>

    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $("#example1").dataTable();
            $('#example2').dataTable({
                "bPaginate": true,
                "bLengthChange": false,
                "bFilter": false,
                "bSort": true,
                "bInfo": true,
                "bAutoWidth": false
            });
        });
    </script>

<?php } ?>

