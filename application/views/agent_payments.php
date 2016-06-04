
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
                    <h3 class="box-title">Agent Payments</h3>
                    <div class="clearfix"></div>
                    Please enter the information below.
                    <hr>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">

                        <div class="form-group <?php if(form_error('first_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">Task Id
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                            	<select name="task_id" id="task_id" class="form-control">
                            		<option value="">Select Task Id</option>
                            		<?php foreach ($task_list as $key => $value) { ?>
                            			<option value="<?= $value['id'] ?>"><?= $value['unique_name'] ?></option>
                            		<?php } ?>
                            	</select>
                            	<?php ?>
                                <?php echo form_error('task_id') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('task_title')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">Task Title</label>
                            <div class="col-md-8">
                                <input type="text"  id="task_title" name="task_title" class="form-control" value="<?php echo set_value('last_name'); ?>" placeholder="Enter Last Name">
                                <?php echo form_error('task_title') ?>
                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group <?php if(form_error('agent_address1')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">Agent
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" id="agent_name"  name="agent_name" class="form-control" value="<?php echo set_value('agent_address1'); ?>" placeholder="Address 1">
                               
                                 <?php echo form_error('agent_address1') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('agent_address2')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">Agent's Paypal Email
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-8">
                               <input type="text" id="agent_paypal" name="agent_address2" class="form-control" value="<?php echo set_value('agent_address2'); ?>" placeholder="Address 2">
                                <?php echo form_error('agent_address2') ?>
                            </div>
                        </div>
                        <!--
                        <div class="form-group <?php if(form_error('city')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">Pay Date<span class="text-red">*</span></label>
                            <div class="col-md-8">

                                <input type="text" name="city" class="form-control" value="<?php echo set_value('city'); ?>" placeholder="City">
                                
                                <?php echo form_error('city') ?>
                            </div>
                        </div>
                           <div class="form-group <?php if(form_error('county')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">Trans Id<span class="text-red">*</span></label>
                            <div class="col-md-8">

                                <input type="text" name="county" class="form-control" value="<?php echo set_value('county'); ?>" placeholder="County">
                                
                                <?php echo form_error('county') ?>
                            </div>
                        </div>
                        
                          <div class="form-group <?php if(form_error('postal_code')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">Total Paid<span class="text-red">*</span></label>
                            <div class="col-md-8">

                                <input type="text" name="postal_code" class="form-control" value="<?php echo set_value('postal_code'); ?>" placeholder="Post Code">
                                
                                <?php echo form_error('postal_code') ?>
                            </div>
                        </div>-->
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->
                    <table class="table table-bordered table-striped table-hover dataTable">
                    	<thead>
                    	<th>Job Id</th>
                    	<th>Shop Name</th>
                    	<th>Job Description</th>
                    	<th>Total Due</th>
                    	<th>Part Payment</th>
                    	<th>Pay Amt</th>
                    	<th>Hold</th>
                    	<th>Pay</th>
						</thead>
						<tbody id="table_body">
							<?php /* foreach ($task_list as $key => $value) { ?>
								<tr>
									<td><?= isset($value['job_id']) ? $value['job_id'] : '' ?></td>
								</tr>
								<tr>
									<td><?= isset($value['shop_name']) ? $value['shop_name'] : '' ?></td>
								</tr>
							<?php } */?>
						</tbody>
                    </table>
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
        	$('#task_id').change(function(){
        		$('#table_body').html('');
				$.ajax({
	                type: "POST",
	                url: "<?php echo base_url('agent/getTaskDetails') ?>",
	                data: {task_id: $(this).val()},
	            })
	            .done(function (data) {
	            	data = JSON.parse(data);
	            	$('#task_title').val(data[0].title);
	            	$('#agent_name').val(data[0].first_name +' '+data[0].last_name);
	            	$('#agent_paypal').val(data[0].paypal_email);
	            	var Html='';
	            	$(data).each(function(key, value)
	            	{
	            		//console.log(value);
	            		Html += "<tr><td>"+value.job_unique_name+"</td><td>"+value.job_at_shop+"</td><td>"+value.description+"</td><td></td><td></td><td></td><td></td><td></td></tr>";
	            	})
	            	$('#table_body').append(Html);
	            });
        	});

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

