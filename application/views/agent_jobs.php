<?php include('header.php'); ?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <span class="box-title"><a class="btn btn-info editBtn" style="color: #fff;" title="Back" data-toggle="tooltip" href="<?php echo base_url(); ?>agent/agent_tasks/<?php echo $agent_id; ?>">
<i class="fa fa-backward"></i> Back</a></span>
<div class="clearfix"></div>
                </div><!-- /.box-header -->
                    <div class="box-body">
                                 
                        <table class="table table-striped">
                            <tr>
                                <th>Job ID</th>
                                <th>Description</th>
                                <th>Status</th>
                            </tr>
                            <?php 
                            if($jobs->num_rows() > 0)
                            {
                                foreach($jobs->result() as $c){
                                   ?>
                                <tr>
                                    <td><?php echo $c->unique_name; ?></td>
                                    <td><?php echo $c->description; ?></td>
                                    <td><?php echo ($c->job_status == 0) ? "In Progress" : "Completed"; ?></td>
                                </tr>
                            <?php 
                                }
                            } 
                            else
                            {
                                ?>
                                <tr>
                                    <td>No Jobs Found</td>
                                </tr>
                                <?php 
                            }
                            ?>
                            
                        </table>
                        

                    </div><!-- /.box-body -->
                    
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
