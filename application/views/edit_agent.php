
<?php 


function page_css(){ ?>
    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Color Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>

<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                
                <!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        
                            <span class="box-title"><a class="btn btn-info editBtn" title="Back" data-toggle="tooltip" href="<?php echo base_url(); ?>agent/index">
<i class="fa fa-backward"></i> Back</a></span>
                            <div class="form-group <?php if(form_error('image')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Photo
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-3">
                                <?php //echo form_upload('shop_nameplate'); ?>
                                
                                    <input type="file" id="inputFile" name="userfile" class="form-control" />
                                
                                <div id="image_preview_div" style="display: none;">
                                    <img id="image_upload_preview" /><a style="position: absolute;" href="javascript: void(0)" onclick="removeImage();"><i class="fa fa-remove"></i></a>
                                </div>
                                <?php echo form_error('image') ?>
                            </div>
                                    <div class="col-md-6">
                                <label for="firstName" class="col-md-3">Current Image
                              
                            </label>
                                
                                        <img alt="User Image" height="50px;" width="50px"class="img-circle" src="<?php  echo profile_photo_url($agent->photo,$agent->email); ?>">
                            </div>
                        </div>
                        

                        <div class="form-group <?php if(form_error('first_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">First Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="first_name" class="form-control" value="<?php echo $agent->first_name; ?>" placeholder="Enter First Name">
                                <?php echo form_error('first_name') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('last_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Last Name</label>
                            <div class="col-md-9">
                                <input type="text" name="last_name" class="form-control" value="<?php echo $agent->last_name ?>" placeholder="Enter Last Name">
                                <?php echo form_error('last_name') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('email')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Email address
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="email" name="email" class="form-control" readonly="readonly"  value="<?php echo $agent->email; ?>" placeholder="Enter email">
                                <?php echo form_error('email') ?>

                            </div>
                        </div>


                        <div class="form-group <?php if(form_error('mobile_no_1')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Mobile No 1:
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="mobile_no_1" class="form-control" value="<?php echo $agent->mobile_no_1; ?>" placeholder="Mobile No 1">
                                <?php echo form_error('mobile_no_1') ?>

                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('mobile_no_2')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Mobile No 2:
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="mobile_no_2" class="form-control" value="<?php echo $agent->mobile_no_2; ?>" placeholder="Mobile No 2">
                                <?php echo form_error('mobile_no_2') ?>

                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('password')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Password
                                
                            </label>
                            <div class="col-md-9">
                                <input type="password" name="password" autocomplete="off" class="form-control" placeholder="Enter Password">
                                <?php echo form_error('password') ?>

                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('passconf')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Password Confirmation
                               
                            </label>
                            <div class="col-md-9">
                                <input type="password" name="passconf" autocomplete="off" class="form-control" placeholder="Enter Confirmation Password">
                                <?php echo form_error('passconf') ?>

                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('gender')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Gender <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <select name="gender" class="form-control">
                                    <option value=""> Select Gender </option>
                                    <option <?php if($agent->gender=="male"){ ?>selected="selected"<?php } ?> value="male" <?php echo set_select('gender', 'male') ?>>Male</option>
                                    <option <?php if($agent->gender=="female"){ ?>selected="selected"<?php } ?> value="female" <?php echo set_select('gender', 'female') ?>>Fe-Male</option>
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
                                    <input class="form-control" name="date_of_birth" type="text" value="<?php echo $agent->date_of_birth; ?>" data-mask="" data-inputmask="'alias': 'yyyy-mm-dd'">
                                </div>
                                <?php echo form_error('date_of_birth') ?>
                            </div>
                        </div>
                        
                        
                        <div class="form-group <?php if(form_error('national_insurance_no')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">National Insurance No
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">

                                  
                                    <input class="form-control" name="national_insurance_no" type="text" placeholder="National Insurance No" value="<?php echo $agent->national_insurance_no ?>" />
                                
                                <?php echo form_error('national_insurance_no') ?>
                            </div>
                        </div>
                        

                        <div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Profession
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="profession" class="form-control" value="<?php echo $agent->profession; ?>" placeholder="Profession">
                                <?php echo form_error('profession') ?>
                            </div>
                        </div>



                        <div class="form-group <?php if(form_error('agent_address1')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Address 1
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="agent_address1" class="form-control" value="<?php echo $agent->agent_address1; ?>" placeholder="Address 1">
                               
                                <?php echo form_error('agent_address1') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('agent_address2')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Address 2
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                 <input type="text" name="agent_address2" class="form-control" value="<?php echo $agent->agent_address2; ?>" placeholder="Address 2">
                              
                                <?php echo form_error('agent_address2') ?>
                            </div>
                        </div>
                        
                        

                        
                        
                                                <div class="form-group <?php if(form_error('city')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">City<span class="text-red">*</span></label>
                            <div class="col-md-9">

                                <input type="text" name="city" class="form-control" value="<?php echo $agent->city; ?>" placeholder="City">
                                
                                <?php echo form_error('city') ?>
                            </div>
                        </div>

                               <div class="form-group <?php if(form_error('postal_code')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Postal Code<span class="text-red">*</span></label>
                            <div class="col-md-9">

                                <input type="text" name="postal_code" class="form-control" value="<?php echo $agent->postal_code; ?>" placeholder="Postal Code">
                                
                                <?php echo form_error('postal_code') ?>
                            </div>
                        </div>
                        
                         <div class="form-group <?php if(form_error('country')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Country<span class="text-red">*</span></label>
                            <div class="col-md-9">
<!--                                <select name="country" class="form-control">
                                    <option value=""> Select Country </option>
                                    <?php /*
                                    if($countries->num_rows() > 0)
                                    {
                                        foreach($countries->result() as $c){
                                            $selected = ($c->id == 19)? 'selected' : '';
                                            echo '<option value="'.$c->id.'" '.$selected.'> '.$c->country_name.'</option>';
                                        }
                                    } */
                                    ?>

                                </select>-->
                                <input type="text" name="country" class="form-control" value="<?php echo $agent->country; ?>" placeholder="Country">
                                
                                <?php echo form_error('country') ?>
                            </div>
                        </div>
                       

                     



                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="add_agent" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Update Agent
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

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
        
        
        
                   $(function() {
            $("#inputFile").change(function () {
                readURL(this);
              //  $(this).val('');
                $(this).hide();
                $('#image_preview_div').show();
            });
        });
        
            function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image_upload_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    
    function removeImage(){
        $('#image_upload_preview').attr('src', '');
        $('#inputFile').show();
        $('#image_preview_div').hide();
    }
    </script>

<?php } ?>

