
<?php function page_css(){ ?>

<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Add New Agent</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">

                        <div class="form-group ">
                            <label for="firstName" class="col-md-3">Payment Method
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <label> <input type="radio" class="simple" name="payment_method" value="paypal" <?php echo set_checkbox('payment_method', 'paypal', true); ?> />
                                    Paypal
                                </label>
                                <label> <input type="radio" class="simple" name="payment_method" value="skrill" <?php echo set_checkbox('payment_method', 'skrill'); ?> />
                                    Skrill
                                </label>
                                <label> <input type="radio" class="simple" name="payment_method" value="payoneer" <?php echo set_checkbox('payment_method', 'payoneer'); ?> />
                                    Payoneer
                                </label>
                                <label> <input type="radio" class="simple" name="payment_method" value="bank"
                                        <?php echo set_checkbox('payment_method', 'bank'); ?> />
                                    Bank Transfer
                                </label>
                            </div>
                        </div>

                        <div id="amount">
                            <div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
                                <label for="amount" class="col-md-3">Amount</label>
                                <div class="col-md-9">

                                    <div class="col-md-3">
                                        <select name="currency" class="form-control">
                                            <option value="usd">USD</option>
                                        </select>
                                    </div>

                                    <div class="col-md-9">
                                        <input type="number" name="amount" class="form-control" placeholder="Amount to pay">
                                    </div>

                                    <?php echo form_error('currency') ?>
                                    <?php echo form_error('amount') ?>
                                </div>
                            </div>
                        </div>


                        <div id="payment_method_email" style="display: <?php echo set_checkbox('payment_method', 'bank') ? 'none': 'block'; ?>;">
                            <div class="form-group <?php if(form_error('payment_method_email')) echo 'has-error'; ?>">
                                <label for="payment_method_email" class="col-md-3">Payment Method Email</label>
                                <div class="col-md-9">
                                    <input type="email" name="payment_method_email" class="form-control" placeholder="Payment Method Email Address">
                                    <?php echo form_error('payment_method_email') ?>
                                </div>
                            </div>
                        </div>

                        <div id="bankDetails" style="display: <?php echo set_checkbox('payment_method', 'bank') ? 'block': 'none'; ?>;" >

                            <div class="form-group <?php if(form_error('account_name')) echo 'has-error'; ?>">
                                <label for="exampleInputEmail1" class="col-md-3">Name of A/C
                                    <span class="text-red">*</span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" name="account_name" class="form-control" placeholder="Name of Account" value="">
                                    <?php echo form_error('account_name') ?>
                                </div>
                            </div>


                            <div class="form-group <?php if(form_error('iban')) echo 'has-error'; ?>">
                                <label for="firstName" class="col-md-3">IBAN
                                    <span class="text-red">*</span>
                                </label>
                                <div class="col-md-9">
                                    <input class="form-control" name="iban" type="text" value="" placeholder="iBan" >
                                    <?php echo form_error('iban') ?>
                                </div>
                            </div>

                            <div class="form-group <?php if(form_error('swift')) echo 'has-error'; ?>">
                                <label for="firstName" class="col-md-3">Swift
                                    <span class="text-red">*</span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" name="swift" class="form-control" value="" placeholder="Swift">
                                    <?php echo form_error('swift') ?>
                                </div>
                            </div>



                            <div class="form-group <?php if(form_error('bank_name')) echo 'has-error'; ?>">
                                <label for="firstName" class="col-md-3">Bank Name
                                    <span class="text-red">*</span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" name="bank_name" value="" class="form-control" placeholder="Bank Name" />
                                    <?php echo form_error('bank_name'); ?>
                                </div>
                            </div>



                            <div class="form-group <?php if(form_error('bank_address')) echo 'has-error'; ?>">
                                <label for="firstName" class="col-md-3">Bank Address
                                    <span class="text-red">*</span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" name="bank_address" value="" class="form-control" placeholder="Bank Address" />
                                    <?php echo form_error('bank_address'); ?>
                                </div>
                            </div>


                            <div class="form-group <?php if(form_error('bank_branch_name')) echo 'has-error'; ?>">
                                <label for="firstName" class="col-md-3"> Branch Name
                                    <span class="text-red">*</span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" name="bank_branch_name" value="" class="form-control" placeholder="Branch Name">
                                    <?php echo form_error('bank_branch_name') ?>
                                </div>
                            </div>

                            <div class="form-group <?php if(form_error('bank_provenance')) echo 'has-error'; ?>">
                                <label for="firstName" class="col-md-3"> Bank City / Provenance / State
                                    <span class="text-red">*</span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" name="bank_provenance" value="" class="form-control" placeholder=" Bank City / Provenance / State">
                                    <?php echo form_error('bank_provenance') ?>
                                </div>
                            </div>


                            <div class="form-group <?php if(form_error('bank_country')) echo 'has-error'; ?>">
                                <label for="firstName" class="col-md-3"> Country
                                    <span class="text-red">*</span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" name="bank_country" value="" class="form-control" placeholder="Country" />
                                    <?php echo form_error('bank_country') ?>
                                </div>
                            </div>

                        </div>


                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="add_agent" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Request for Payent
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>
    <!-- Page script -->
    <script type="text/javascript">
        $(function() {
            $('[name="payment_method"]').click(function(){
               var methodValue = $(this).val();

                switch (methodValue)
                {
                    case 'bank':
                        $('#payment_method_email').hide();
                        $('#bankDetails').show();
                        break;
                    default :
                        $('#payment_method_email').show();
                        $('#bankDetails').hide();
                        break;
                }


            });
        });
    </script>

<?php } ?>

