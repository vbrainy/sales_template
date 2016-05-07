
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
                    <h3 class="box-title">Edit Task &nbsp; <b><?php echo $tasks->unique_name; ?></b> </h3> 
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">

                        <div class="form-group <?php if(form_error('title')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">Title
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="title" class="form-control" value="<?php echo $tasks->title; ?>" placeholder="Enter Title">
                                <?php echo form_error('title') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('assign_to')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-2">Assign Agent<span class="text-red">*</span></label>
                            <div class="col-md-6">
                              <select name="assign_to" class="form-control" onChange="getcity(this.value);">
                                    <option value=""> Select Agent </option>
                                    <?php 
                                    
                                    if($agents->num_rows() > 0)
                                    {
                                        foreach($agents->result() as $c){
                                            $selected = ($c->id == $tasks->assign_to)? "selected='selected'" : '';
                                            echo '<option value="'.$c->id.'" '.$selected.' > '.$c->first_name . ' '. $c->last_name   .'</option>';
                                        }
                                    } 
                                    ?>

                                </select>
                                 
                                <?php echo form_error('assign_to') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('city')) echo 'has-error'; ?>">
                            <label for="agent_area" class="col-md-2">Agent Area
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="city" id="city" value="<?php echo $tasks->agent_area; ?>" readonly="readonly"  class="form-control" value="" placeholder="City">
                                <?php echo form_error('city') ?>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="edit_task" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Update Task
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>
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

