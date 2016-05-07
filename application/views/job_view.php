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
                                 <div class="form-group">
                            <label for="shop_map" class="col-md-2">Shop Map
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-6">
                                <div id="map-canvas" style="width:530px;height:380px;"></div>
                            </div>
                        </div>
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
                            <tr>
                                <td>Description 1</td>
                                <td><?php echo $job->desc1; ?></td>
                            </tr>
                            <tr>
                                <td>Price 1</td>
                                <td><?php echo $job->price1; ?></td>
                            </tr>
                            <tr>
                                <td>Description 2</td>
                                <td><?php echo $job->desc2; ?></td>
                            </tr>
                            <tr>
                                <td>Price 2</td>
                                <td><?php echo $job->price2; ?></td>
                            </tr>
                            <tr>
                                <td>Description 3</td>
                                <td><?php echo $job->desc3; ?></td>
                            </tr>
                            <tr>
                                <td>Price 3</td>
                                <td><?php echo $job->price3; ?></td>
                            </tr>
                            <tr>
                                <td>Description 4</td>
                                <td><?php echo $job->desc4; ?></td>
                            </tr>
                            <tr>
                                <td>Price 4</td>
                                <td><?php echo $job->price4; ?></td>
                            </tr>
                            <tr>
                                <td>Description 5</td>
                                <td><?php echo $job->desc5; ?></td>
                            </tr>
                            <tr>
                                <td>Price 5</td>
                                <td><?php echo $job->price5; ?></td>
                            </tr>
                            <tr>
                                <td>Description 6</td>
                                <td><?php echo $job->desc6; ?></td>
                            </tr>
                            <tr>
                                <td>Price 6</td>
                                <td><?php echo $job->price6; ?></td>
                            </tr>
                            <tr>
                                <td>Description 7</td>
                                <td><?php echo $job->desc7; ?></td>
                            </tr>
                            <tr>
                                <td>Price 7</td>
                                <td><?php echo $job->price7; ?></td>
                            </tr>
                            <tr>
                                <td>Description 8</td>
                                <td><?php echo $job->desc8; ?></td>
                            </tr>
                            <tr>
                                <td>Price 8</td>
                                <td><?php echo $job->price8; ?></td>
                            </tr>
                            <tr>
                                <td>Description 9</td>
                                <td><?php echo $job->desc9; ?></td>
                            </tr>
                            <tr>
                                <td>Price 9</td>
                                <td><?php echo $job->price9; ?></td>
                            </tr>
                            <tr>
                                <td>Description 10</td>
                                <td><?php echo $job->desc10; ?></td>
                            </tr>
                            <tr>
                                <td>Price 10</td>
                                <td><?php echo $job->price10; ?></td>
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
