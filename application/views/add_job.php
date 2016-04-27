
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
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places" type="text/javascript"></script>

<script type="text/javascript">
    function initialize() {
        var input = document.getElementById('searchTextField');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            document.getElementById('place_name').value = place.name;
            document.getElementById('latitude').value = place.geometry.location.lat();
            document.getElementById('longitude').value = place.geometry.location.lng();
            //alert("This function is working!");
            //alert(place.name);
           // alert(place.address_components[0].long_name);

        });
    }
    google.maps.event.addDomListener(window, 'load', initialize); 
</script>
<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Add New Job</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">

                        <div class="form-group <?php if(form_error('title')) echo 'has-error'; ?>">
                            <label for="title" class="col-md-3">Title
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="title" class="form-control" value="<?php echo set_value('title'); ?>" placeholder="Enter Title">
                                <?php echo form_error('title') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('description')) echo 'has-error'; ?>">
                            <label for="description" class="col-md-3">Job Description
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <textarea name="description" class="form-control" value="<?php echo set_value('description'); ?>" placeholder="Enter Descrption"></textarea>
                                <?php echo form_error('description') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('part_price1')) echo 'has-error'; ?>">
                            <label for="part_price1" class="col-md-3">Price 1
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="part_price1" class="form-control" value="<?php echo set_value('part_price1'); ?>" placeholder="Enter Price 1">
                                <?php echo form_error('part_price1') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('part_price2')) echo 'has-error'; ?>">
                            <label for="part_price2" class="col-md-3">Price 2
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="part_price2" class="form-control" value="<?php echo set_value('part_price2'); ?>" placeholder="Enter Price 2">
                                <?php echo form_error('part_price2') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('part_price3')) echo 'has-error'; ?>">
                            <label for="part_price3" class="col-md-3">Price 3
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="part_price3" class="form-control" value="<?php echo set_value('part_price3'); ?>" placeholder="Enter Price 3">
                                <?php echo form_error('part_price3') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('part_price4')) echo 'has-error'; ?>">
                            <label for="part_price4" class="col-md-3">Price 4
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="part_price4" class="form-control" value="<?php echo set_value('part_price4'); ?>" placeholder="Enter Price 4">
                                <?php echo form_error('part_price4') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('part_price5')) echo 'has-error'; ?>">
                            <label for="part_price5" class="col-md-3">Price 5
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="part_price5" class="form-control" value="<?php echo set_value('part_price5'); ?>" placeholder="Enter Price 5">
                                <?php echo form_error('part_price5') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('part_price6')) echo 'has-error'; ?>">
                            <label for="part_price6" class="col-md-3">Price 6
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="part_price6" class="form-control" value="<?php echo set_value('part_price6'); ?>" placeholder="Enter Price 6">
                                <?php echo form_error('part_price6') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('part_price7')) echo 'has-error'; ?>">
                            <label for="part_price7" class="col-md-3">Price 7
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="part_price7" class="form-control" value="<?php echo set_value('part_price7'); ?>" placeholder="Enter Price 7">
                                <?php echo form_error('part_price7') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('part_price8')) echo 'has-error'; ?>">
                            <label for="part_price8" class="col-md-3">Price 8
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="part_price8" class="form-control" value="<?php echo set_value('part_price8'); ?>" placeholder="Enter Price 8">
                                <?php echo form_error('part_price8') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('part_price9')) echo 'has-error'; ?>">
                            <label for="part_price9" class="col-md-3">Price 9
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="part_price9" class="form-control" value="<?php echo set_value('part_price9'); ?>" placeholder="Enter Price 9">
                                <?php echo form_error('part_price9') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('part_price10')) echo 'has-error'; ?>">
                            <label for="part_price10" class="col-md-3">Price 10
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="part_price10" class="form-control" value="<?php echo set_value('part_price10'); ?>" placeholder="Enter Price 10">
                                <?php echo form_error('part_price10') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('job_address1')) echo 'has-error'; ?>">
                            <label for="job_address1" class="col-md-3">Job Address 1
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="job_address1" class="form-control" value="<?php echo set_value('job_address1'); ?>" placeholder="Enter Job Address 1">
                                <?php echo form_error('job_address1') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('job_address2')) echo 'has-error'; ?>">
                            <label for="job_address2" class="col-md-3">Job Address 2
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="job_address2" class="form-control" value="<?php echo set_value('job_address2'); ?>" placeholder="Enter Job Address 2">
                                <?php echo form_error('job_address2') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('location')) echo 'has-error'; ?>">
                            <label for="location" class="col-md-3">Location
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input id="searchTextField" name="location" class="form-control" value="<?php echo set_value('location'); ?>" type="text" size="50" placeholder="Enter a location" autocomplete="on" runat="server" />  
                                <?php echo form_error('location') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('city')) echo 'has-error'; ?>">
                            <label for="city" class="col-md-3">City
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="city" class="form-control" value="<?php echo set_value('city'); ?>" placeholder="Enter City">
                                <?php echo form_error('city') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('postcode')) echo 'has-error'; ?>">
                            <label for="postcode" class="col-md-3">Postcode
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="postcode" class="form-control" value="<?php echo set_value('postcode'); ?>" placeholder="Enter Postcode">
                                <?php echo form_error('postcode') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('country')) echo 'has-error'; ?>">
                            <label for="country" class="col-md-3">Country<span class="text-red">*</span></label>
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

                        <div class="form-group <?php if(form_error('mobile')) echo 'has-error'; ?>">
                            <label for="mobile" class="col-md-3">Mobile
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="mobile" class="form-control" value="<?php echo set_value('mobile'); ?>" placeholder="Enter Mobile">
                                <?php echo form_error('mobile') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('notes')) echo 'has-error'; ?>">
                            <label for="notes" class="col-md-3">Notes
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <textarea name="notes" class="form-control" value="<?php echo set_value('notes'); ?>" placeholder="Enter Notes"></textarea>
                                <?php echo form_error('notes') ?>
                            </div>
                        </div>
                        <input type="hidden" id="place_name" name="place_name" />
                        <input type="hidden" id="latitude" name="latitude" />
                        <input type="hidden" id="longitude" name="longitude" />
                        
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="add_task" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add Job
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
    </script>

<?php } ?>

