
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
                    <h3 class="box-title">Add New Category</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">

                        <div class="form-group <?php if(form_error('category_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Category Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="category_name" class="form-control" value="<?php echo set_value('category_name'); ?>" placeholder="Enter Category Name">
                                <?php echo form_error('category_name') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('commission_percent')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Commission</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-addon"> % </div>
                                    <input type="number" name="commission_percent" step="0.01" min="0" class="form-control" value="<?php echo set_value('commission_percent'); ?>" placeholder="Enter Commission">
                                </div>
                                <?php echo form_error('commission_percent') ?>
                            </div>
                        </div>



                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="add_category" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add Category
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

<?php } ?>

