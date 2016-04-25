
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
            <div class="box box-primary boxFormContainer">
                <div class="box-header">
                    <h3 class="box-title">New Sales</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">

                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <strong>Customer : </strong>
                                    <!--<div class="input-group">
                                        <div class="input-group-addon referralFa">
                                            <i class="fa fa-warning"></i>
                                        </div>
                                        <input type="text" name="customerID" class="form-control" placeholder="Customer ID" /> <br />
                                    </div>-->
                                    <select name="customerID" class="form-control">

                                        <option value=""> Select Customer</option>
                                        <?php foreach($users->result() as $user){
                                            echo '<option value="'.$user->id.'"> '.user_full_name($user).' </option>';
                                        }
                                        ?>

                                    </select>
                                    <p id="referralCodeStatus"></p>

                                </div><!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <strong>Customer Name:</strong>
                                    <address>
                                        <strong><span id="customerName"></span></strong><br>
                                        <p id="customerAddress"></p>
                                    </address>
                                </div><!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    Date: <?php echo date('d/m/Y') ?><br/>
                                </div><!-- /.col -->
                                <div class="clearfix"></div>
                                <hr />
                            </div><!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-xs-12 table-responsive">
                                    <table class="table table-striped newProductTable">
                                        <thead>
                                        <tr>
                                            <th>Qty</th>
                                            <th>Product Name</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>#</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr class="originalRow">
                                            <td>
                                                <input type="number" class="form-control" name="qty[]"  required="" style="width: 70px;" min="1" value="1" />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="productName[]"  placeholder="Enter Product Name..." />
                                            </td>
                                            <td>
                                                <select name="categories[]" class="form-control" required="" style="max-width: 200px">
                                                    <option value="">Select category</option>
                                                <?php
                                                    if($category -> num_rows() > 0)
                                                    {
                                                        foreach($category->result() as $r)
                                                        {
                                                            echo '<option value="'.$r->id.'">'.$r->name.'</option>';
                                                        }
                                                    }
                                                ?>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control individualPrice" name="price[]" step="0.01" required="" style="width: 100px;" />
                                            </td>
                                            <td>
                                                <p class="btn btn-danger removeProductRow" title="Remove" data-toggle="tooltip" data-original-title="Remove"><i class="fa fa-trash"></i> </p>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div><!-- /.col -->
                            </div><!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-xs-6">

                                </div><!-- /.col -->
                                <div class="col-xs-6">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th>Total:</th>
                                                <td><span id="totalPrice"></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div><!-- /.col -->
                            </div><!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-xs-12">
                                    <button class="btn btn-success pull-right" id="addTableRow"><i class="fa fa-credit-card"></i> Add Another Product</button>
                                </div>
                            </div>

                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="add_new_sell" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Save New Sales
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
        $('.boxFormContainer').change(function(){
            var iSelector = $('[name="customerID"]');
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
                    $('#customerName').text(msg.customerName);
                    $('#customerAddress').html(msg.customerAddress);
                    //$('#referralCodeStatus').html('<span style="color: #3d9970">Referral code is valid</span>');
                    $('#referralCodeStatus').html('');
                }else{
                    $('.referralFa').html('<i class="fa fa-ban"></i>');
                    iSelector.closest('.input-group').removeClass('has-success');
                    iSelector.closest('.input-group').addClass('has-error');
                    $('#customerName').text('');
                    $('#customerAddress').text('');
                    $('#referralCodeStatus').html('<span style="color: #ff0000">Customer ID is invalid</span>');
                }
                //alert(msg);
            });


            //Get Total Price
            var sum = 0;
            $('.individualPrice').each(function() {
                sum += Number($(this).val());
            });
            $('#totalPrice').text(sum.toFixed(2));

        });



        $('#addTableRow').click(function(e){



            e.preventDefault();

            $('table.newProductTable tbody tr td select').select2('destroy');
            var tableRow = $('table.newProductTable tbody tr.originalRow').html();

            $('table.newProductTable tbody').append('<tr>'+tableRow+'</tr>');
            $('select').select2();


        });
    });

</script>

<script>
    $(document).on('click', '.removeProductRow', function() {
        $(this).closest('tr').html('');

        var sum = 0;
        $('.individualPrice').each(function() {
            sum += Number($(this).val());
        });
        $('#totalPrice').text(sum.toFixed(2));

    });
</script>

<?php } ?>

