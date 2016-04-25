<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Invoice List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-6">



                        <label>Date and time range:</label>
                        <div class="form-inline">


                            <div class="form-group">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" id="reservation" name="searchByNameInput" placeholder="Search within date range">
                                </div>
                            </div>
                            <button type="submit" id="searchByDateBtn" class="btn btn-primary">Search</button>

                        </div>
                    </div>

                    <div class="clearfix"></div>

<hr />

                    <table id="example" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Seller Name</th>
                                <th>Total Sales</th>
                                <th>Total Commission</th>
                                <th>Admin Commission</th>
                                <th>Agent Commission</th>
                                <th>User Commission</th>
                                <th>Referral Commission</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>Seller Name</th>
                                <th>Total Sales</th>
                                <th>Total Commission</th>
                                <th>Admin Commission</th>
                                <th>Agent Commission</th>
                                <th>User Commission</th>
                                <th>Referral Commission</th>
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
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            var oTable = $("#example").dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?php echo base_url('account/agentSalesListJson'); ?>",
                    "data": function ( d ) {
                        d.dateRange = $('[name="searchByNameInput"]').val();
                    }
                }
            });

            $('button#searchByDateBtn').on('click', function(){
                oTable.fnDraw();
            });

        });

    </script>



    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->
    <!-- bootstrap time picker -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <!-- Page script -->
    <script type="text/javascript">
        $(function() {
            //Date range picker
            $('#reservation').daterangepicker({ format: 'YYYY-MM-DD' });
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        });
    </script>







<?php } ?>





