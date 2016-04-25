
<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="callout callout-info">
                <h4>Note: To search an invoice, please place invoice id into search box.</h4>
            </div>

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Invoice List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                            <tr>
                                <th>Invoice ID</th>
                                <th>Customer Name</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Sales by</th>
                                <th>Time</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>Invoice ID</th>
                                <th>Customer Name</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Sales by</th>
                                <th>Time</th>
                                <th>Action</th>
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
            $("#example").dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "<?php echo base_url('product/invoiceListJson'); ?>"
            });
        });

    </script>

<script>

    $('body').on('click', 'a.deleteBtn', function () {
        var agentId = $(this).attr('id');
        var currentItem = $(this);
        var verifyConfirm = confirm('Are you sure?'); //confirm

        if(verifyConfirm) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('category/deleteAjax') ?>",
                data: {id: agentId},
            })
            .done(function (msg) {
                currentItem.closest('tr').hide('slow');
            });
        }
    });

</script>


<?php } ?>

