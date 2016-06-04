<?php include('header.php');

?>
<input type="hidden" value="<?php echo $job_details->geo_location; ?>" id="geolocation">
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            
          
            
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
                        Task Title: <?php echo $tasks->title; ?>
                    </h3>
                   
           
           
                </div><!-- /.box-header -->
                <div class="box-header">
                   
                    <h3 class="box-title">
                         Task ID: <?php echo $tasks->unique_name; ?>
                        </h3>  
                     
           
           
                </div><!-- /.box-header -->
                <div class="box-header">
                   
                    <h3 class="box-title">
                         Job ID: <?php echo $job_details->unique_name; ?>
                        </h3>  
                     
           
           
                </div><!-- /.box-header -->
                <div
                    class="box-body">
                    <div class="form-group">
                        <label for="shop_map" class="col-md-2">Shop Map
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-6">
                            <div id="map-canvas" style="width:530px;height:380px;"></div>
                        </div>
                    </div>
                    
                    
                    
                    
                    <table class="table table-striped">
                        
               
                        <tr>
                            <th>Job unique name:</th>
                            <th><?php //echo ; ?></th>
                        </tr>
                        <tr>
                            <td>Job at shop:</td>
                            <td><?php echo $job_details->job_at_shop; ?></td>
                        </tr>
                        <tr>
                            <td>Job add1:</td>
                            <td><?php echo $job_details->job_add1; ?></td>
                        </tr>

                        <tr>
                            <td>Job Add2:</td>
                            <td><?php echo $job_details->job_add2; ?></td>
                        </tr>
                        <tr>
                            <td>City:</td>
                            <td><?php echo $job_details->city; ?></td>
                        </tr>
                        <tr>
                            <td>Postcode:</td>
                            <td><?php echo $job_details->postcode; ?></td>
                        </tr>
                        <tr>
                            <td>Phone:</td>
                            <td><?php echo $job_details->phone; ?></td>
                        </tr>

                        <tr>
                            <td>Description 1:<?php echo $job_details->desc1; ?></td>
                            <td>price :<?php echo $job_details->price1; ?></td>
                        </tr>

                        <tr>
                            <td>Description 2:<?php echo $job_details->desc2; ?></td>
                            <td>price :<?php echo $job_details->price2; ?></td>
                        </tr>


                        <tr>
                            <td>Description 3:<?php echo $job_details->desc3; ?></td>
                            <td>price :<?php echo $job_details->price3; ?></td>
                        </tr>


                        <tr>
                            <td>Description 4:<?php echo $job_details->desc4; ?></td>
                            <td>price :<?php echo $job_details->price4; ?></td>
                        </tr>


                        <tr>
                            <td>Description 5:<?php echo $job_details->desc5; ?></td>
                            <td>price :<?php echo $job_details->price5; ?></td>
                        </tr>


                        <tr>
                            <td>Description 6:<?php echo $job_details->desc6; ?></td>
                            <td>price :<?php echo $job_details->price6; ?></td>
                        </tr>


                        <tr>
                            <td>Description 7:<?php echo $job_details->desc7; ?></td>
                            <td>price :<?php echo $job_details->price7; ?></td>
                        </tr>


                        <tr>
                            <td>Description 8:<?php echo $job_details->desc8; ?></td>
                            <td>price :<?php echo $job_details->price8; ?></td>
                        </tr>


                        <tr>
                            <td>Description 9:<?php echo $job_details->desc9; ?></td>
                            <td>price :<?php echo $job_details->price9; ?></td>
                        </tr>

                        <tr>
                            <td>Description 10:<?php echo $job_details->desc10; ?></td>
                            <td>price :<?php echo $job_details->price10; ?></td>
                        </tr>


                        <tr>
                            <td>Total Price :  <?php echo $job_details->total_price; ?></td>
                        </tr>
                         <tr>
                            <td>Job Status :<?php  if($job_details->job_status == 1){ echo "Complete" ;}else { echo "Pending";} ?> </td>
                        </tr>




                    </table>
                     <?php if (empty($job_details->job_status)) { ?>
                     <?php echo form_open_multipart('myjobs/update_status/'. $job_details->id, ['role' => 'form', 'class' => 'form-horizontal']); ?>
                            <div class="form-group <?php if(form_error('shop_signature_complete')) echo 'has-error'; ?>">
                            <label for="shop_signature_complete" class="col-md-2">Upload Signature
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-8">
                                <?php //echo form_upload('shop_nameplate'); ?>
                                
                                <input type="file" id="inputFile" name="shop_signature_complete"  />
                                
                                <div id="image_preview_div" style="display: none;">
                                    <img height="200px;" width="200px;" id="image_upload_preview" /><a style="position: absolute;" href="javascript: void(0)" onclick="removeImage();"><i class="fa fa-remove"></i></a>
                                </div>
                                <?php echo form_error('shop_signature_complete') ?>
                            </div>
                        </div>

                </div><!-- /.box-body -->
               
                  
                 <button type="submit" name="submit" value="job_compelete" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Complete Job
                        </button>
                
                 </form>
<?php }
?>

            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php

function page_js() { ?>
    <script type="text/javascript">
        $(function () {
            
            
           // alert(geolocation);
            function initialize() {
                var geolocation = $("#geolocation").val();
            
               
                var myLatlng = new google.maps.LatLng(geolocation);
                
                
                var myOptions = {
                    zoom: 10,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
                addMarker(myLatlng, 'Default Marker', map);
                map.addListener('click', function (event) {
                    //addMarker(event.latLng, 'Click Generated Marker', map);
                });
            }
            function addMarker(latlng, title, map) {
                var marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    title: title,
                    draggable: true
                });


            }
            ;

            initialize();

        });
        
        
        
  




    </script>

<?php } ?>