<?php foreach($settings->result() as $setting); ?>

<?php function page_css(){ ?>
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

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
                    <h3 class="box-title">Default Administrator Settings</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">

                        <div class="form-group <?php if(form_error('company_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Company Name</label>
                            <div class="col-md-9">
                                <input type="text" name="company_name" class="form-control" value="<?php echo get_option('company_name') ?>" placeholder="Company Name">
                                <?php echo form_error('company_name') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('default_email')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Default Email</label>
                            <div class="col-md-9">
                                <input type="email" name="default_email" class="form-control" value="<?php echo get_option('default_email'); ?>" placeholder="Default admin email">
                                <?php echo form_error('default_email') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('email_text_product_sales')) echo 'has-error'; ?>">
                            <label for="email_text_product_sales" class="col-md-3">Extra Information, email text when product sales</label>
                            <div class="col-md-9">
                                <textarea name="email_text_product_sales" class="form-control textareaWysih" rows="5"><?php echo get_option('email_text_product_sales'); ?></textarea>
                                <?php echo form_error('email_text_product_sales'); ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('invoice_information')) echo 'has-error'; ?>">
                            <label for="invoice_information" class="col-md-3">Invoice Information</label>
                            <div class="col-md-9">
                                <textarea name="invoice_information" class="form-control" rows="1"><?php echo get_option('invoice_information'); ?></textarea>
                                <?php echo form_error('invoice_information') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('invoice_terms')) echo 'has-error'; ?>">
                            <label for="invoice_terms" class="col-md-3">Invoice Terms</label>
                            <div class="col-md-9">
                                <textarea name="invoice_terms" class="form-control" rows="1"><?php echo get_option('invoice_terms'); ?></textarea>
                                <?php echo form_error('invoice_terms') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('agent_commision')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Agent Commision</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        %
                                    </div>
                                    <input type="number" name="agent_commision" class="form-control" value="<?php echo get_option('agent_commision'); ?>" placeholder="Agent Commission" step="0.1" min="0.1" />
                                </div>
                                <?php echo form_error('agent_commision') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('user_commision')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">User Commision</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-addon">  %  </div>
                                    <input type="number" name="user_commision" class="form-control" value="<?php echo get_option('user_commision'); ?>" placeholder="User Commission" step="0.1" min="0.1" />
                                </div>
                                <?php echo form_error('user_commision') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('referral_commision')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Refferal Commision</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-addon">  % </div>
                                    <input type="number" name="referral_commision" class="form-control" value="<?php echo get_option('referral_commision'); ?>" placeholder="Referral Commission" step="0.1" min="0.1" />
                                </div>
                                <?php echo form_error('referral_commision') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('admin_commision')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Admin Commision</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-addon"> % </div>
                                    <input type="number" name="admin_commision" class="form-control" value="<?php echo get_option('admin_commision'); ?>" placeholder="Admin Commission" step="0.1" min="0.1" />
                                </div>
                                <?php echo form_error('admin_commision') ?>
                            </div>
                        </div>


                        <div class="form-group <?php if(form_error('default_currency')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Default Currency</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-addon"> $ </div>
                                    <input type="text" name="default_currency" class="form-control" value="<?php echo get_option('default_currency'); ?>" placeholder="Default Currency"  />
                                </div>
                                <?php echo form_error('default_currency') ?>
                            </div>
                        </div>



                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="update" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Update
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $(".textareaWysih").wysihtml5();
        });
    </script>

<?php } ?>

