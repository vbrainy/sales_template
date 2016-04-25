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
                                        <?php echo $c_user->first_name.' '. $c_user->last_name; ?>
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
                                            <tr>
                                                <th>Full Name</th>
                                                <th><?php echo $c_user->first_name.' '. $c_user->last_name; ?></th>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td><?php echo $c_user->email; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Contact No.</td>
                                                <td><?php echo $c_user->contactno; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Gender</td>
                                                <td><?php echo $c_user->gender; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Date of birth</td>
                                                <td><?php echo $c_user->date_of_birth; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Profession</td>
                                                <td><?php echo $c_user->profession; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Street Address</td>
                                                <td><?php echo $c_user->street_address; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Country</td>
                                                <td><?php echo $c_user->country; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Postal Code</td>
                                                <td><?php echo $c_user->postal_code; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Referral Code</td>
                                                <td><?php echo $c_user->referral_code; ?></td>
                                            </tr>
                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <a href="<?php echo base_url('user/profile_edit') ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="<?php echo base_url('user/log') ?>" class="label label-warning"><i class="fa fa-bar-chart"></i> Log</a>
                                        <a href="<?php echo base_url('activity') ?>" class="label label-info"><i class="fa fa-check-square-o"></i> Activity</a>

                                    </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
