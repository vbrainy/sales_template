
<?php

function page_css() { ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php include('header.php'); ?>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">

                <hr>
                <!-- form start -->

                <div class="box-body">




                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="box box-solid">
                                <div class="box-header">
                                    <h3 class="box-title">Task Details</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="box-group" id="accordion">
                                        <?php foreach ($mytask as $i => $value) {
                                            
                                            ?>
                                            <div class="panel box box-primary">
                                                <div class="box-header">
                                                    <h4 class="box-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>">
                                                            <?php echo $value->unique_name; ?>
                                                        </a>
                                                    </h4>



                                                </div>
                                                <?php
                                                $in = '';
                                                if ($i == 0) {
                                                    $in = 'in';
                                                }
                                                ?>
                                                <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse <?php echo $in; ?>">
                                                   <?php $query = $this->job_model->jobsList("","", $value->id); ?>
                                                    <div class="box-body">
                                                        <table id="" class="table table-bordered table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>Job Name</th>
                                                                    <th>City</th>
                                                                    <th>Status</th>
                                                                    <th width="40%">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <?php
                                                            
                                                            if(!empty($query)){
                                                                
                                                            
                                                                
                                                                
                                                            
                                                            
                                                            
                                                            foreach($query->result() as $r){ ?>
                                                               <tr>
                                                                    <td><?php echo $r->unique_name; ?></td>
                                                                    <td><?php echo $r->city; ?></td>
                                                                    <td><?php  if($r->job_status == 1){ echo "Complete" ;}else { echo "Pending";} ?></td>
                                                                    <td>
                                                                        <a target="_blank" class="btn btn-primary editBtn" href="<?php echo base_url('myjobs/job_detail/'. $r->id) ?>" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>
                                                                        <a style="display:<?php if ($r->job_status == 0) { echo ""; }else { echo "none";} ?>" href="<?php echo base_url('myjobs/update_status/'.$r->id) ?>" class="btn btn-primary"><i class="fa"></i>  <?php echo !empty($job_details->job_status) ? "" :"Complete"; ?></a>
                                     
                                                                        
                                                                    </td>
                                                            </tr><?php } } else { 
                                                                echo "No Jobs Found";
                                                                ?>

 <?php } ?>
                                                        </table>
                                                     </div>
                                                </div>
                                            </div>

<?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- /.box-body -->


                <?php
                echo form_close();
                ?> 
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section>
<?php

function page_js() { ?>



    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $("#job").dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?php echo base_url('myjobs/jobsListJson'); ?>",
                    "data": function (d) {
                        d.task_id = $('#task_id').val();
                    }
                }
            });
        });

    </script>

    <script>

        $('body').on('click', 'a.deleteBtn', function () {
            var agentId = $(this).attr('id');
            var currentItem = $(this);
            var verifyConfirm = confirm('Are you sure?'); //confirm

            if (verifyConfirm) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('jobs/deleteAjax') ?>",
                    data: {id: agentId},
                })
                        .done(function (msg) {
                            currentItem.closest('tr').hide('slow');
                        });
            }
        });


        $('body').on('click', 'button.blockUnblock', function () {
            var agentId = $(this).attr('id');
            var buttonValue = $(this).val();
            //alert(buttonValue);
            //set type of action
            var currentItem = $(this);
            if (buttonValue == 1) {
                var status = 'Active';
            } else if (buttonValue == 0) {
                var status = 'In Active';
            }

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('jobs/setBlockUnblock') ?>",
                data: {id: agentId, buttonValue: buttonValue, status: status}
            })
                    .done(function (msg) {
                        if (buttonValue == 1) {
                            currentItem.removeClass('btn-success');
                            currentItem.addClass('btn-warning');
                            currentItem.html('<i class="fa fa-lock"></i>');
                            currentItem.attr('title', 'In Active');
                            currentItem.val(0);
                        } else if (buttonValue == 0) {
                            currentItem.removeClass('btn-warning');
                            currentItem.addClass('btn-success');
                            currentItem.html('<i class="fa fa-unlock-alt"></i>');
                            currentItem.attr('title', 'Active');
                            currentItem.val(1);
                        }
                    });
        });


    </script>


<?php } ?>

