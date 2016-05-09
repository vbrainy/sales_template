
<?php function page_css(){ ?>
    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Color Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/admin'); ?>/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />

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
                    <h3 class="box-title">Add New Task</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                      
                        <div class="form-group <?php if(form_error('title')) echo 'has-error'; ?>">
                            <label for="title" class="col-md-2">Title
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="title" class="form-control" value="<?php echo set_value('title'); ?>" placeholder="Enter Title">
                                <?php echo form_error('title') ?>
                            </div>
                        </div>
                        
                        
                        <div class="form-group <?php if(form_error('assign_to')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">Assign Agent<span class="text-red">*</span></label>
                            <div class="col-md-6">
                              <select name="assign_to" onChange="getcity(this.value);" class="form-control">
                                    <option value=""> Select Agent </option>
                                    <?php 
                                    if($agents->num_rows() > 0)
                                    {
                                        foreach($agents->result() as $c){
                                           // $selected = ($c->id == 19)? 'selected' : '';
                                            echo '<option value="'.$c->id.'"> '.$c->first_name . ' '. $c->last_name   .'</option>';
                                        }
                                    } 
                                    ?>

                                </select>
                                 
                                <?php echo form_error('assign_to') ?>
                            </div>
                        </div>
                            <div class="form-group <?php if(form_error('city')) echo 'has-error'; ?>">
                            <label for="agent_area" class="col-md-2">City
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="city" id="city" readonly="readonly"  class="form-control" value="" placeholder="City">
                                <?php echo form_error('city') ?>
                            </div>
                        </div>
<!--                        <div class="form-group <?php if(form_error('agent_area')) echo 'has-error'; ?>">
                            <label for="agent_area" class="col-md-3">Agent Area
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="agent_area" class="form-control" value="<?php echo set_value('agent_area'); ?>" placeholder="Enter Agent Area">
                                <?php echo form_error('agent_area') ?>
                            </div>
                        </div>-->
                           <div class="form-group <?php if(form_error('created_at')) echo 'has-error'; ?>">
                            <label for="agent_area" class="col-md-2">Task Date
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="created_at" class="form-control" id="date_element" value="<?php echo date("Y-m-d"); ?>">
                                <?php echo form_error('created_at') ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="add_task" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add Task
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
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Page script -->
    <script type="text/javascript">
        $(function() {
            //$('#date_element').datepicker();
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
    
    <script>
function getcity(val) {
    
    
	$.ajax({
	type: "POST",
	url: "<?php echo base_url('tasks/getAgentcity'); ?>",
	data:'id='+val,
        
	success: function(data){
           // alert(data);
		$("#city").val(data);
	}
	});
}
</script>

<?php } ?>

