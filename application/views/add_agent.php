
<?php function page_css(){ ?>
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
                <div class="box-header">
                    <h3 class="box-title">Add New Agent</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        
                         
                        
                             <div class="form-group <?php if(form_error('image')) echo 'has-error'; ?>">
                            <label for="shop_nameplate" class="col-md-2">Photo
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-8">
                                <?php //echo form_upload('shop_nameplate'); ?>
                                
                                <input type="file" id="inputFile" name="userfile"  />
                                
                                <div id="image_preview_div" style="display: none;">
                                    <img height="200px;" width="200px;" id="image_upload_preview" /><a style="position: absolute;" href="javascript: void(0)" onclick="removeImage();"><i class="fa fa-remove"></i></a>
                                </div>
                                <?php echo form_error('image') ?>
                            </div>
                        </div>
                        
                        
                        
<!--                        
                        <div class="form-group <?php if(form_error('agent_reg_no')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">Agent Registration Number
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="agent_reg_no" class="form-control" value="<?php echo set_value('agent_reg_no'); ?>" placeholder="Enter Agent Reg No">
                                <?php echo form_error('agent_reg_no') ?>
                            </div>
                        </div> -->
                        
                        
                     
                        
                        <div class="form-group <?php if(form_error('first_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">First Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="first_name" class="form-control" value="<?php echo set_value('first_name'); ?>" placeholder="Enter First Name">
                                <?php echo form_error('first_name') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('last_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">Last Name</label>
                            <div class="col-md-8">
                                <input type="text" name="last_name" class="form-control" value="<?php echo set_value('last_name'); ?>" placeholder="Enter Last Name">
                                <?php echo form_error('last_name') ?>
                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group <?php if(form_error('agent_address1')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">Address 1
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="agent_address1" class="form-control" value="<?php echo set_value('agent_address1'); ?>" placeholder="Address 1">
                               
                                 <?php echo form_error('agent_address1') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('agent_address2')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">Address 2
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-8">
                               <input type="text" name="agent_address2" class="form-control" value="<?php echo set_value('agent_address2'); ?>" placeholder="Address 2">
                                <?php echo form_error('agent_address2') ?>
                            </div>
                        </div>
                        
                                <div class="form-group <?php if(form_error('city')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">City<span class="text-red">*</span></label>
                            <div class="col-md-8">

                                <input type="text" name="city" class="form-control" value="<?php echo set_value('city'); ?>" placeholder="City">
                                
                                <?php echo form_error('city') ?>
                            </div>
                        </div>
                           <div class="form-group <?php if(form_error('county')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">County<span class="text-red">*</span></label>
                            <div class="col-md-8">

                                <input type="text" name="county" class="form-control" value="<?php echo set_value('county'); ?>" placeholder="County">
                                
                                <?php echo form_error('county') ?>
                            </div>
                        </div>
                        
                          <div class="form-group <?php if(form_error('postal_code')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">Post Code<span class="text-red">*</span></label>
                            <div class="col-md-8">

                                <input type="text" name="postal_code" class="form-control" value="<?php echo set_value('postal_code'); ?>" placeholder="Post Code">
                                
                                <?php echo form_error('postal_code') ?>
                            </div>
                        </div>
                        
                                 <div class="form-group <?php if(form_error('country')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">Country<span class="text-red">*</span></label>
                            <div class="col-md-8">
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
                                <input type="text" name="country" class="form-control" value="<?php echo set_value('country'); ?>" placeholder="Country">
                                
                                <?php echo form_error('country') ?>
                            </div>
                        </div>
                        
                        
                          


                      


                 
  <div class="form-group <?php if(form_error('gender')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">Gender <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <select name="gender" class="form-control">
                                    <option value=""> Select Gender </option>
                                    <option value="male" <?php echo set_select('gender', 'male') ?>>Male</option>
                                    <option value="female" <?php echo set_select('gender', 'female') ?>>Female</option>
                                </select>
                                <?php echo form_error('gender') ?>
                            </div>
                        </div>

                       
                         <div class="form-group <?php if(form_error('nationality_origin')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-2">Nationality Origin
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="nationality_origin" class="form-control" value="<?php echo set_value('nationality_origin'); ?>" placeholder="Nationality Origin">
                                <?php echo form_error('nationality_origin') ?>

                            </div>
                        </div>
                       
                           <div class="form-group <?php if(form_error('skill')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-2">Skills
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="skill" class="form-control" value="<?php echo set_value('skill'); ?>" placeholder="Enter skill">
                                Multiple can be added Comma (,) separated
                                <?php echo form_error('skill') ?>
                            </div>
                        </div>

                               <div class="form-group <?php if(form_error('mobile_no_1')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">Mobile No 1:
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="mobile_no_1" class="form-control" value="<?php echo set_value('mobile_no_1'); ?>" placeholder="Mobile No 1">
                                <?php echo form_error('mobile_no_1') ?>

                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('mobile_no_2')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">Mobile No 2:
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="mobile_no_2" class="form-control" value="<?php echo set_value('mobile_no_2'); ?>" placeholder="Mobile No 2">
                                <?php echo form_error('mobile_no_2') ?>

                            </div>
                        </div>
                        
                        
                        <div class="form-group <?php if(form_error('email')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-2">Email address
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>" placeholder="Enter email">
                                <?php echo form_error('email') ?>

                            </div>
                        </div>

                      
                        
                        
                        <div class="form-group <?php if(form_error('national_insurance_no')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">National Insurance No
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">

                                  
                                    <input class="form-control" name="national_insurance_no" type="text" placeholder="National Insurance No" value="<?php echo set_value('national_insurance_no'); ?>" />
                                
                                <?php echo form_error('national_insurance_no') ?>
                            </div>
                        </div>
                        

<!--                        <div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">Profession
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="profession" class="form-control" value="<?php echo set_value('profession'); ?>" placeholder="Profession">
                                <?php echo form_error('profession') ?>
                            </div>
                        </div>-->
                        
                                  <div class="form-group <?php if(form_error('date_of_birth')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">Date of birth
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input class="form-control" name="date_of_birth" type="text" value="<?php echo set_value('date_of_birth'); ?>" data-mask="" data-inputmask="'alias': 'yyyy-mm-dd'">
                                </div>
                                <?php echo form_error('date_of_birth') ?>
                            </div>
                        </div>
                        
                        
                         <div class="form-group <?php if(form_error('password')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-2">Password
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                                <?php echo form_error('password') ?>

                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('passconf')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-2">Password Confirmation
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="password" name="passconf" class="form-control" placeholder="Enter Confirmation Password">
                                <?php echo form_error('passconf') ?>

                            </div>
                        </div>
                        
                        
                        <div class="form-group <?php if(form_error('paypal_email')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">Paypal Email
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="paypal_email" class="form-control" value="<?php echo set_value('paypal_email'); ?>" placeholder="Paypal Email">
                                <?php echo form_error('paypal_email') ?>
                            </div>
                        </div>
                        


                        
                                 
                        
               
                        
                        
                               

                           
                        

                     



                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="add_agent" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Save
                        </button>
                        <a href="<?php echo base_url().'/agent' ?>">Back</a>
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

