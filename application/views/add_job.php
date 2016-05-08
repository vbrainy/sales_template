
<?php function page_css(){ ?>
    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Color Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/admin'); ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

<?php } ?>
<!--<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places" type="text/javascript"></script>-->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    
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
<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <span class="box-title"><a class="btn btn-info editBtn" style="color: #fff;" title="Back" data-toggle="tooltip" href="<?php echo base_url(); ?>tasks/index">
<i class="fa fa-backward"></i> Back</a></span>
                    <span class="box-title"><a class="btn btn-info editBtn" style="color: #fff;" title="View Jobs" data-toggle="tooltip" href="<?php echo base_url(); ?>jobs/index/<?php echo $this->uri->segment(3); ?>">
<i class="fa fa-eye"></i> View Jobs</a></span>
<div class="clearfix"></div>
                    <h3 class="box-title">
                        <p>
                        Task ID: <?php echo getTaskClearName($tasks->unique_name); ?>
                        </p>
                        <p>
                        Task Title: <?php echo $tasks->title; ?>
                        </p>
                        <p>
                        Job ID: <?php echo $jobUniqueName; ?>
                        </p>
                    </h3>
                    
                </div><!-- /.box-header -->
                <hr style="margin-top:0">
                <!-- form start -->
                <?php echo form_open_multipart('jobs/add_job/'.$this->uri->segment(3), ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        
                        <input type="hidden" name="unique_name" value="<?php echo $jobUniqueName; ?>"/>
                        <input type="hidden" name="task_id" value="<?php echo $tasks->id; ?>"/>
                        <div class="form-group">
                            <label class="col-md-2">Agent
                            </label>
                            <label class="col-md-8"><?php echo $agent->first_name . ' '.$agent->last_name;?>
                            </label>
                        </div>
                        
                        <div class="form-group <?php if(form_error('shop_nameplate')) echo 'has-error'; ?>">
                            <label for="shop_nameplate" class="col-md-2">Shop Nameplate
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <?php //echo form_upload('shop_nameplate'); ?>
                                <input type="file" id="inputFile" name="shop_nameplate" /><br />
                                <div id="image_preview_div" style="display: none;">
                                    <img id="image_upload_preview" /><a style="position: absolute;" href="javascript: void(0)" onclick="removeImage();"><i class="fa fa-remove"></i></a>
                                </div>
                                <?php echo form_error('shop_nameplate') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('job_at_shop')) echo 'has-error'; ?>">
                            <label for="job_at_shop" class="col-md-2">Job at shop
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="job_at_shop" class="form-control" value="<?php echo set_value('job_at_shop'); ?>" placeholder="Enter Job at shop">
                                <?php echo form_error('job_at_shop') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('job_add1')) echo 'has-error'; ?>">
                            <label for="job_add1" class="col-md-2">Job Address 1
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="job_add1" class="form-control" value="<?php echo set_value('job_add1'); ?>" placeholder="Enter Job Address 1">
                                <?php echo form_error('job_add1') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('job_add2')) echo 'has-error'; ?>">
                            <label for="job_add2" class="col-md-2">Job Address 2
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="job_add2" class="form-control" value="<?php echo set_value('job_add2'); ?>" placeholder="Enter Job Address 2">
                                <?php echo form_error('job_add2') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('city')) echo 'has-error'; ?>">
                            <label for="city" class="col-md-2">City
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="city" class="form-control" value="<?php echo set_value('city'); ?>" placeholder="Enter City">
                                <?php echo form_error('city') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('postcode')) echo 'has-error'; ?>">
                            <label for="postcode" class="col-md-2">Postcode
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="postcode" id="postcode" class="form-control" value="<?php echo set_value('postcode'); ?>" placeholder="Enter Postcode">
                                <?php echo form_error('postcode') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('mobile')) echo 'has-error'; ?>">
                            <label for="mobile" class="col-md-2">Mobile
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="mobile" class="form-control" value="<?php echo set_value('mobile'); ?>" placeholder="Enter Mobile">
                                <?php echo form_error('mobile') ?>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="shop_map" class="col-md-2">Shop Map
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <div id="map-canvas" style="width:710px;height:380px;"></div>
                            </div>
                        </div>
                        
                        <div class="form-group" <?php if(form_error('latitude')) echo 'has-error'; ?>>
                            <label for="Latitude" class="col-md-2">Latitude
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" id="lat" name="latitude" class="form-control" value="<?php echo set_value('latitude'); ?>" />
                                 <?php if(form_error('latitude')) echo 'has-error'; ?>
                            </div>
                        </div>
                        
                        <div class="form-group" <?php if(form_error('longitude')) echo 'has-error'; ?>>
                            <label for="Longitude" class="col-md-2">Longitude
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" id="lng" name="longitude" class="form-control" value="<?php echo set_value('longitude'); ?>" />
                                 <?php if(form_error('longitude')) echo 'has-error'; ?>
                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group <?php if(form_error('description')) echo 'has-error'; ?>">
                            <label for="description" class="col-md-2">Job Description
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <textarea name="description" class="form-control textareaWysih"  placeholder="Enter Descrption"><?php echo set_value('description'); ?></textarea>
                                <?php echo form_error('description') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('total_price')) echo 'has-error'; ?>">
                            <label for="total_price" class="col-md-2">Total Price
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="total_price" id="total_price" class="form-control" value="<?php echo set_value('total_price'); ?>" readonly>
                                <?php echo form_error('total_price') ?>
                            </div>
                        </div>
                    
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="box box-solid">
                                <div class="box-header">
                                    <h3 class="box-title">Parts of Job</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="box-group" id="accordion">
                        <?php for($i=1; $i<=10; $i++) { ?>
                        <div class="panel box box-primary">
                            <div class="box-header">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>">
                                        Part #<?php echo $i; ?>
                                    </a>
                                </h4>
                            </div>
                             <?php $in=''; if($i == 1) {  $in='in';  } ?>
                            <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse <?php echo $in; ?>">
                                                <div class="box-body">
                            <div class="form-group <?php if(form_error('desc'.$i)) echo 'has-error'; ?>">
                                <label for="desc<?php echo $i; ?>" class="col-md-2">Job 1/<?php echo $i; ?> Description
                                    <span class="text-red">*</span>
                                </label>
                                <div class="col-md-12">
                                    <textarea name="desc<?php echo $i; ?>" class="form-control"  placeholder="Enter Descrption <?php echo $i; ?>"><?php echo set_value('desc'.$i); ?></textarea>
                                    <?php echo form_error('desc'.$i) ?>
                                </div>
                            </div>
                            <div class="form-group <?php if(form_error('price'.$i)) echo 'has-error'; ?>">
                                <label for="price<?php echo $i; ?>" class="col-md-2">Price 1/<?php echo $i; ?>
                                    <span class="text-red">*</span>
                                </label>
                                <div class="col-md-12">
                                    <input type="text" name="price<?php echo $i; ?>" class="form-control price_number" value="<?php echo set_value('price'.$i); ?>" placeholder="Enter Price <?php echo $i; ?>">
                                    <?php echo form_error('price'.$i) ?>
                                </div>
                            </div>
                                                </div>
                            </div>
                                        </div>
                        
                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
<!--                        <div class="form-group <?php if(form_error('desc1')) echo 'has-error'; ?>">
                            <label for="desc1" class="col-md-2">Job 1/01 Description
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <textarea name="desc1" class="form-control" value="<?php echo set_value('desc1'); ?>" placeholder="Enter Descrption"></textarea>
                                <?php echo form_error('desc1') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('price1')) echo 'has-error'; ?>">
                            <label for="price1" class="col-md-2">Price 1/01
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="price1" class="form-control" value="<?php echo set_value('price1'); ?>" placeholder="Enter Price 1">
                                <?php echo form_error('price1') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('desc2')) echo 'has-error'; ?>">
                            <label for="desc2" class="col-md-2">Job 1/02 Description
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <textarea name="desc2" class="form-control" value="<?php echo set_value('desc2'); ?>" placeholder="Enter Descrption"></textarea>
                                <?php echo form_error('desc2') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('price2')) echo 'has-error'; ?>">
                            <label for="price2" class="col-md-2">Price 1/02
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="price2" class="form-control" value="<?php echo set_value('price2'); ?>" placeholder="Enter Price 2">
                                <?php echo form_error('price2') ?>
                            </div>
                        </div>
                        
                        
                        <div class="form-group <?php if(form_error('desc3')) echo 'has-error'; ?>">
                            <label for="desc3" class="col-md-2">Job 1/03 Description
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <textarea name="desc3" class="form-control" value="<?php echo set_value('desc3'); ?>" placeholder="Enter Descrption"></textarea>
                                <?php echo form_error('desc3') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('price3')) echo 'has-error'; ?>">
                            <label for="price3" class="col-md-2">Price 1/03
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="price3" class="form-control" value="<?php echo set_value('price3'); ?>" placeholder="Enter Price 3">
                                <?php echo form_error('price3') ?>
                            </div>
                        </div>

                        
                        <div class="form-group <?php if(form_error('desc4')) echo 'has-error'; ?>">
                            <label for="desc4" class="col-md-2">Job 1/04 Description
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <textarea name="desc4" class="form-control" value="<?php echo set_value('desc4'); ?>" placeholder="Enter Descrption"></textarea>
                                <?php echo form_error('desc4') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('price4')) echo 'has-error'; ?>">
                            <label for="price4" class="col-md-2">Price 1/04
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="price4" class="form-control" value="<?php echo set_value('price4'); ?>" placeholder="Enter Price 4">
                                <?php echo form_error('price4') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('desc5')) echo 'has-error'; ?>">
                            <label for="desc5" class="col-md-2">Job 1/05 Description
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <textarea name="desc5" class="form-control" value="<?php echo set_value('desc5'); ?>" placeholder="Enter Descrption"></textarea>
                                <?php echo form_error('desc5') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('price5')) echo 'has-error'; ?>">
                            <label for="price5" class="col-md-2">Price 1/05
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="price5" class="form-control" value="<?php echo set_value('price5'); ?>" placeholder="Enter Price 5">
                                <?php echo form_error('price5') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('desc6')) echo 'has-error'; ?>">
                            <label for="desc6" class="col-md-2">Job 1/06 Description
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <textarea name="desc6" class="form-control" value="<?php echo set_value('desc6'); ?>" placeholder="Enter Descrption"></textarea>
                                <?php echo form_error('desc6') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('price6')) echo 'has-error'; ?>">
                            <label for="price6" class="col-md-2">Price 1/06
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="price6" class="form-control" value="<?php echo set_value('price6'); ?>" placeholder="Enter Price 6">
                                <?php echo form_error('price6') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('desc7')) echo 'has-error'; ?>">
                            <label for="desc7" class="col-md-2">Job 1/07 Description
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <textarea name="desc7" class="form-control" value="<?php echo set_value('desc7'); ?>" placeholder="Enter Descrption"></textarea>
                                <?php echo form_error('desc7') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('price7')) echo 'has-error'; ?>">
                            <label for="price7" class="col-md-2">Price 1/07
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="price7" class="form-control" value="<?php echo set_value('price7'); ?>" placeholder="Enter Price 1">
                                <?php echo form_error('price7') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('part_price1')) echo 'has-error'; ?>">
                            <label for="part_price1" class="col-md-2">Job 1/08 Description
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <textarea name="description" class="form-control" value="<?php echo set_value('description'); ?>" placeholder="Enter Descrption"></textarea>
                                <?php echo form_error('part_price1') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('part_price1')) echo 'has-error'; ?>">
                            <label for="part_price1" class="col-md-2">Price 1/08
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="part_price1" class="form-control" value="<?php echo set_value('part_price1'); ?>" placeholder="Enter Price 1">
                                <?php echo form_error('part_price1') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('part_price1')) echo 'has-error'; ?>">
                            <label for="part_price1" class="col-md-2">Job 1/09 Description
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <textarea name="description" class="form-control" value="<?php echo set_value('description'); ?>" placeholder="Enter Descrption"></textarea>
                                <?php echo form_error('part_price1') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('part_price1')) echo 'has-error'; ?>">
                            <label for="part_price1" class="col-md-2">Price 1/09
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="part_price1" class="form-control" value="<?php echo set_value('part_price1'); ?>" placeholder="Enter Price 1">
                                <?php echo form_error('part_price1') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('part_price1')) echo 'has-error'; ?>">
                            <label for="part_price1" class="col-md-2">Job 1/10 Description
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <textarea name="description" class="form-control" value="<?php echo set_value('description'); ?>" placeholder="Enter Descrption"></textarea>
                                <?php echo form_error('part_price1') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('part_price1')) echo 'has-error'; ?>">
                            <label for="part_price1" class="col-md-2">Price 1/10
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="part_price1" class="form-control" value="<?php echo set_value('part_price1'); ?>" placeholder="Enter Price 1">
                                <?php echo form_error('part_price1') ?>
                            </div>
                        </div>-->

                        <input type="hidden" id="place_name" name="place_name" />
                        
                        
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="add_job" class="btn btn-primary">
                            <i class="fa fa-save"></i> Save
                        </button>
                        <button type="reset" value="clear" class="btn btn-primary">Clear
                        </button>
                    </div>
 <?php
    echo form_close();
    ?> 
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
    
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        
        $(function() {
        var address = "SW1A 2AA";    
        changeMap(address);
  	$('#postcode').on("change", function(){
            console.log("jjj");
            var address = $('#postcode').val();
            console.log(address);
            changeMap(address);
            });
  });
  
  
  var changeMap = function(address){
      var lat, lng;
            $.get("http://maps.googleapis.com/maps/api/geocode/json?address=" + address + "&sensor=true", function( data ) {
              lat = data.results[0].geometry.location.lat;
              lng = data.results[0].geometry.location.lng;
                $('#lat').val(lat);		
		$('#lng').val(lng);
	var myLatlng = new google.maps.LatLng(lat, lng);
	var myOptions = {
	  zoom: 10, 
	  center: myLatlng,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
	addMarker(myLatlng, 'Default Marker', map);
	map.addListener('click',function(event) {
		addMarker(event.latLng, 'Click Generated Marker', map);
	});
	});
	function addMarker(latlng,title,map) {
	var marker = new google.maps.Marker({
			position: latlng,
			map: map,
			title: title,
			draggable:true
	});
	marker.addListener('drag',function(event) {
		 $('#lat').val(event.latLng.lat())  ;
		$('#lng').val(event.latLng.lng())  ;
	});
	marker.addListener('dragend',function(event) {
		$('#lat').val(event.latLng.lat())  ;		
		$('#lng').val(event.latLng.lng())  ;
		var x=event.latLng.lat();
		var y=event.latLng.lng();
		$("#results").append($('<div>').text(event.latLng.toUrlValue()).data('latlng',event.latLng).click(function(){marker.setPosition($(this).data('latlng'));}));
	});
    }
      
  }
  
        
        $(function() {
            $(".textareaWysih").wysihtml5();
        });
        
        $(function() {
            $("#inputFile").change(function () {
                readURL(this);
                //$(this).val('');
                $(this).hide();
                $('#image_preview_div').show();
            });
        });

    
    </script>

    <!-- Page script -->
    <script type="text/javascript">
 
        $(function() {
            
            //Get total price from all the prices
            $('.price_number').change(function(){
                var a = 0;
                $(".price_number").each(function() {
                    if($(this).val() != '')
                    {
                        a += parseInt($(this).val());
                    }
                });
                $('#total_price').val(a);
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
    </script>

<?php } ?>

