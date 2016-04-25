
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
                    <h3 class="box-title">Administrator Settings Log</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">



                        <table class="table">
                            <tr>
                                <th>Email <br />address</th>
                                <th>Agent <br />Commission</th>
                                <th>User <br /> Commission</th>
                                <th>Referral <br /> Commission</th>
                                <th>Admin <br /> Commission</th>
                                <th>Contact <br /> Address</th>
                                <th>Update by</th>
                                <th>Time</th>
                            </tr>

                            <?php foreach($settingsLog->result() as $row){ ?>
                            <tr>
                                <td><?php echo $row->default_email; ?></td>
                                <td><?php echo $row->agent_commision; ?>%</td>
                                <td><?php echo $row->user_commision; ?>%</td>
                                <td><?php echo $row->referral_commision; ?>%</td>
                                <td><?php echo $row->admin_commision; ?>%</td>
                                <td><?php echo nl2br($row->contact_address); ?></td>
                                <td><?php echo $row->first_name.' '.$row->last_name; ?></td>
                                <td><?php echo date('d/m/Y h:i A', $row->updated_at); ?></td>
                            </tr>
                            <?php } ?>

                        </table>





                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <!--<div class="box-footer">
                                            <button type="submit" name="update" class="btn btn-primary">
                                                <i class="fa fa-edit"></i> Update
                                            </button>
                                        </div>-->
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

