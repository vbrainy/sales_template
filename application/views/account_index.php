<?php
foreach($earnings->result() as $earning);
foreach($referralEarnings->result() as $referralEarning);
foreach($withdrawal->result() as $withdraws);

$totalEarning = $earning->amount;
$refEarning = $referralEarning->amount;
$withdraw = $withdraws->amount;

$rowEarning = $totalEarning - $refEarning;
$credit     = $totalEarning - $withdraw;
?>
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

                    <table class="table table-bordered">
                        <tr>
                            <th>Earnings</th>
                            <th>Referral Earnings</th>
                            <th>Total Earnings</th>
                            <th>Withdraw</th>
                            <th>Credit</th>
                        </tr>
                        <tr>
                            <td>
                                <?php  echo amountFormat($rowEarning); ?>
                            </td>

                            <td>
                                <?php  echo amountFormat($refEarning); ?>
                            </td>

                            <td>
                                <?php  echo amountFormat($totalEarning); ?>
                            </td>
                            <td>
                                <?php  echo amountFormat($withdraw); ?>
                            </td>
                            <td>
                                <?php  echo amountFormat($credit); ?>
                            </td>

                        </tr>
                    </table>

                    <hr />

                    <table id="example" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Invoice ID</th>
                                <th>Amount</th>
                                <th>Earning For</th>
                                <th>Sales By</th>
                                <th>Time</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>Invoice ID</th>
                                <th>Amount</th>
                                <th>Earning For</th>
                                <th>Sales By</th>
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
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $("#example").dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "<?php echo base_url('account/earningListJson'); ?>"
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

