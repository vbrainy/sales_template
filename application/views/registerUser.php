<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title><?php if(isset($title)) echo $title.' | '; ?> Sales agent management software (SAMS) </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/admin'); ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />


        <!-- daterange picker -->
        <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="<?php echo base_url('assets/admin'); ?>/css/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Color Picker -->
        <link href="<?php echo base_url('assets/admin'); ?>/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
        <!-- Bootstrap time Picker -->
        <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header"><i class="fa fa-archive"></i> Registration</div>
            <?php echo form_open('', ['class' => 'form-horizontal']); ?>
                <div class="body bg-gray">

                    <div class="form-group">

                        <?php echo flash_msg(); ?>

                        <?php if($this->session->flashdata('loggedIn_fail')){ ?>
                        <div class="alert alert-danger alert-dismissable">
                            <i class="fa fa-ban"></i>
                            <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                            <b>Alert!</b> <?php echo $this->session->flashdata('loggedIn_fail'); ?>
                        </div>
                        <?php } ?>

                        <?php if(validation_errors()){
                            echo '<div class="alert alert-danger" style="margin-left: 0;"> '.validation_errors().' </div>';
                        } ?>

                    </div>

                    <div class="form-group <?php if(form_error('referredByCode')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Referral Code
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-addon referralFa">
                                    <i class="fa fa-warning"></i>
                                </div>
                                <input class="form-control" name="referredByCode" type="text" value="<?php echo set_value('referredByCode'); ?>" placeholder="Reference Code" />
                            </div>
                            <p id="referralCodeStatus"></p>
                            <?php echo form_error('referredByCode') ?>
                        </div>
                    </div>


                    <div class="form-group <?php if(form_error('first_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">First Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="first_name" class="form-control" value="<?php echo set_value('first_name'); ?>" placeholder="Enter First Name">
                            <?php echo form_error('first_name') ?>
                        </div>
                    </div>

                    <div class="form-group <?php if(form_error('last_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Last Name</label>
                        <div class="col-md-9">
                            <input type="text" name="last_name" class="form-control" value="<?php echo set_value('last_name'); ?>" placeholder="Enter Last Name">
                            <?php echo form_error('last_name') ?>
                        </div>
                    </div>

                    <div class="form-group <?php if(form_error('email')) echo 'has-error'; ?>">
                        <label for="exampleInputEmail1" class="col-md-3">Email
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>" placeholder="Enter email">
                            <?php echo form_error('email') ?>

                        </div>
                    </div>


                    <div class="form-group <?php if(form_error('password')) echo 'has-error'; ?>">
                        <label for="exampleInputEmail1" class="col-md-3">Password
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="password" name="password" class="form-control" placeholder="Enter Password">
                            <?php echo form_error('password') ?>

                        </div>
                    </div>

                    <div class="form-group <?php if(form_error('passconf')) echo 'has-error'; ?>">
                        <label for="exampleInputEmail1" class="col-md-3">Password Confirmation
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="password" name="passconf" class="form-control" placeholder="Enter Confirmation Password">
                            <?php echo form_error('passconf') ?>

                        </div>
                    </div>

                    <div class="form-group <?php if(form_error('contactno')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Contact No
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="contactno" class="form-control" value="<?php echo set_value('contactno'); ?>" placeholder="Contact No">
                            <?php echo form_error('contactno') ?>

                        </div>
                    </div>

                    <div class="form-group <?php if(form_error('gender')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Gender <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <select name="gender" class="form-control">
                                <option value=""> Select Gender </option>
                                <option value="male" <?php echo set_select('gender', 'male') ?>>Male</option>
                                <option value="female" <?php echo set_select('gender', 'female') ?>>Fe-Male</option>
                            </select>
                            <?php echo form_error('gender') ?>
                        </div>
                    </div>

                    <div class="form-group <?php if(form_error('date_of_birth')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Date of birth
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control" name="date_of_birth" type="text" value="<?php echo set_value('date_of_birth'); ?>" data-mask="" data-inputmask="'alias': 'yyyy-mm-dd'">
                            </div>
                            <?php echo form_error('date_of_birth') ?>
                        </div>
                    </div>

                    <div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Profession
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="profession" class="form-control" value="<?php echo set_value('profession'); ?>" placeholder="Profession">
                            <?php echo form_error('profession') ?>
                        </div>
                    </div>



                    <div class="form-group <?php if(form_error('street_address')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Street Address
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="street_address" value="<?php echo set_value('street_address'); ?>" class="form-control" placeholder="Street Address">
                            <?php echo form_error('street_address') ?>
                        </div>
                    </div>

                    <div class="form-group <?php if(form_error('country')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Country</label>
                        <div class="col-md-9">
                            <select name="country" class="form-control">
                                <option value=""> Select Country </option>
                                <?php
                                if($countries->num_rows() > 0)
                                {
                                    foreach($countries->result() as $c){
                                        $selected = ($c->id == 19)? 'selected' : '';
                                        echo '<option value="'.$c->id.'" '.$selected.'> '.$c->country_name.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('country') ?>
                        </div>
                    </div>


                    <div class="form-group <?php // if(form_error('street_address')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Photo
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" size="20" />
                            <p class="text-aqua">(Max size 2MB &amp; Width 1024px, Height 768px )</p>

                            <?php // echo form_error('street_address') ?>
                        </div>
                    </div>



                <div class="clearfix"></div>


                </div>
                <div class="footer">
                    <button type="submit" name="submit" value="userRegistration" class="btn bg-olive btn-block">
                        <i class="fa fa-edit"></i> Sign up
                    </button>

                    <p><a class="text-center" href="<?php echo base_url(); ?>"><i class="fa fa-info-circle"></i> I already have a membership</a></p>

                </div>
            </form>

        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>

<script>
    $(function(){
        $('input[name="referredByCode"]').keyup(function(){
            var iSelector = $(this);
            var referredByCode = iSelector.val();
            $('.referralFa').html('<i class="fa fa-refresh fa-spin"></i>');

            $.ajax({
                type : "POST",
                url : "<?php echo base_url('welcome/validateReferralCodeApi'); ?>",
                data : { referredByCode : referredByCode }
            })
                .done(function(msg){
                    if(msg == 'true'){
                        $('.referralFa').html('<i class="fa fa-check"></i>');
                        iSelector.closest('.input-group').removeClass('has-error');
                        iSelector.closest('.input-group').addClass('has-success');
                        $('#referralCodeStatus').html('<span style="color: #3d9970">Referral code is valid</span>');
                    }else{
                        $('.referralFa').html('<i class="fa fa-ban"></i>');
                        iSelector.closest('.input-group').removeClass('has-success');
                        iSelector.closest('.input-group').addClass('has-error');
                        $('#referralCodeStatus').html('<span style="color: #ff0000">Referral code is invalid</span>');
                    }
                    //alert(msg);
                });


        });
    });
</script>

        <!-- InputMask -->
        <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- date-range-picker -->
        <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- bootstrap color picker -->
        <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
        <!-- bootstrap time picker -->
        <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <!-- Page script -->
        <script type="text/javascript">
            $(function() {
                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();

                //Date range picker
                $('#reservation').daterangepicker();
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
                //Date range as a button
                $('#daterange-btn').daterangepicker(
                    {
                        ranges: {
                            'Today': [moment(), moment()],
                            'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                            'Last 7 Days': [moment().subtract('days', 6), moment()],
                            'Last 30 Days': [moment().subtract('days', 29), moment()],
                            'This Month': [moment().startOf('month'), moment().endOf('month')],
                            'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                        },
                        startDate: moment().subtract('days', 29),
                        endDate: moment()
                    },
                    function(start, end) {
                        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                    }
                );

                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal',
                    radioClass: 'iradio_minimal'
                });
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                });
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-red',
                    radioClass: 'iradio_flat-red'
                });

                //Colorpicker
                $(".my-colorpicker1").colorpicker();
                //color picker with addon
                $(".my-colorpicker2").colorpicker();

                //Timepicker
                $(".timepicker").timepicker({
                    showInputs: false
                });
            });
        </script>




    </body>
</html>
