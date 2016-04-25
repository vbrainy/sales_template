<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

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

                    <table id="example" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Payee Name</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Details</th>
                                <th>Request by</th>
                                <th>Action</th>
                                <th>Time</th>
                            </tr>
                        </thead>

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
            $("#example").dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "<?php echo base_url('account/requestedPaymentListJson'); ?>"
            });

            $('body').on('click', '.status', function(){
                var paymentRequestID = $(this).attr('id');
                var value = $(this).val();
                $.ajax({
                    type : 'GET',
                    url : '<?php echo base_url('account/setPaymentRequestStatus') ?>',
                    data : { paymentRequestID : paymentRequestID, value : value },
                    success : function (data) {
                        $("#example").dataTable().fnDraw();
                    }
                });
            });

        });

    </script>

<?php } ?>

