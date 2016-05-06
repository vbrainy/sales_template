<?php include('header.php'); ?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
                        <?php echo $job->unique_name; ?>
                    </h3>
                </div><!-- /.box-header -->
                    <div class="box-body">

                        <table class="table table-striped">
                            <tr>
                                <th>Shop Nameplate</th>
                                <th><?php echo $job->shop_nameplate; ?></th>
                            </tr>
                            <tr>
                                <td>Job At Shop</td>
                                <td><?php echo $job->job_at_shop; ?></td>
                            </tr>
                            <tr>
                                <td>Job Address 1</td>
                                <td><?php echo $job->job_add1; ?></td>
                            </tr>

                            <tr>
                                <td>Job Address 2</td>
                                <td><?php echo $job->job_add2; ?></td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td><?php echo $job->city; ?></td>
                            </tr>
                            <tr>
                                <td>Postcode</td>
                                <td><?php echo $job->postcode; ?></td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td><?php echo $job->phone; ?></td>
                            </tr>

                            <tr>
                                <td>Description</td>
                                <td><?php echo $job->description; ?></td>
                            </tr>
                            <tr>
                                <td>Total Price</td>
                                <td><?php echo $job->total_price; ?></td>
                            </tr>

                        </table>

                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <a href="<?php echo base_url('jobs/edit/'.$job->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                    </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
