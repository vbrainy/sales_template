

<?php function page_css(){ ?>
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />
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
                    <h3 class="box-title">Add New Payment</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">

                        <div class="form-group <?php if(form_error('payee_referralCode')) echo 'has-error'; ?>">
                            <label for="payee_referralCode" class="col-md-3">Select Payee
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">

                                <div class="input-group">
                                    <div class="input-group-addon referralFa">
                                        <i class="fa fa-warning"></i>
                                    </div>

                                    <select name="payeeID" class="form-control" required="">
                                        <option value=""> Select Customer</option>
                                        <?php foreach($users->result() as $user){
                                            echo '<option value="'.$user->id.'"> '.user_full_name($user).' </option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <?php echo form_error('payee_referralCode') ?>
                                <span id="customerName"></span>
                                <span id="customerAddress"></span>
                                <span id="referralCodeStatus"></span>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Amount</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-addon"> $ </div>
                                    <input type="number" name="amount" step="0.01" min="0" class="form-control" value="<?php echo set_value('amount'); ?>" placeholder="Enter Amount">
                                </div>
                                <?php echo form_error('amount') ?>
                            </div>
                        </div>



                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="make_payment" class="btn btn-primary">
                            <i class="fa fa-credit-card"></i> Make Payment
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>
    <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
<script>
    $(function(){
        $('[name="payeeID"]').change(function(){
            var iSelector = $(this);
            var customerID = iSelector.val();
            $('.referralFa').html('<i class="fa fa-refresh fa-spin"></i>');

            $.ajax({
                type : "POST",
                url : "<?php echo base_url('product/validateCustomerCodeApi'); ?>",
                data : { customerID : customerID }
            })
                .done(function(response){
                    var msg = JSON.parse(response);
                    if(msg.status == 'true'){
                        $('.referralFa').html('<i class="fa fa-check"></i>');
                        iSelector.closest('.input-group').removeClass('has-error');
                        iSelector.closest('.input-group').addClass('has-success');
                        $('#customerName').html(msg.customerName+'<br />');
                        $('#customerAddress').html(msg.customerAddress);
                        //$('#referralCodeStatus').html('<span style="color: #3d9970">Referral code is valid</span>');
                        $('#referralCodeStatus').html('');
                    }else{
                        $('.referralFa').html('<i class="fa fa-ban"></i>');
                        iSelector.closest('.input-group').removeClass('has-success');
                        iSelector.closest('.input-group').addClass('has-error');
                        $('#customerName').text('');
                        $('#customerAddress').text('');
                        $('#referralCodeStatus').html('<span style="color: #ff0000">Payee ID is invalid</span>');
                    }
                    //alert(msg);
                });

        });

    });

</script>

<?php } ?>

