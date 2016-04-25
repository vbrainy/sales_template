<?php foreach($profile_Details->result() as $profile); ?>
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
                                        <?php echo $profile->first_name.' '. $profile->last_name; ?>
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
                                            <tr>
                                                <th width="20%">Full Name</th>
                                                <th><?php echo $profile->first_name.' '. $profile->last_name; ?></th>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td><?php echo $profile->email; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Password</td>
                                                <td><?php echo $profile->row_pass; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Contact No.</td>
                                                <td><?php echo $profile->contactno; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Gender</td>
                                                <td><?php echo $profile->gender; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Date of birth</td>
                                                <td><?php echo $profile->date_of_birth; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Profession</td>
                                                <td><?php echo $profile->profession; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Street Address</td>
                                                <td><?php echo $profile->street_address; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Country</td>
                                                <td><?php echo $profile->country; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Postal Code</td>
                                                <td><?php echo $profile->postal_code; ?></td>
                                            </tr>
                                            <tr>
                                                <td>User Type</td>
                                                <td><?php echo ucwords($profile->role); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Total Refers</td>
                                                <td><?php echo $profile->referralCount; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Referral Code</td>
                                                <td><?php echo $profile->referral_code; ?></td>
                                            </tr>


                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <a href="<?php echo base_url('user/profile_edit/'.$profile->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="<?php echo base_url('user/log/'.$profile->id ) ?>" class="label label-warning"><i class="fa fa-bar-chart"></i> Log</a>
                                        <a href="<?php echo base_url('activity/users/'.$profile->id) ?>" class="label label-info"><i class="fa fa-check-square-o"></i> Activity</a>
                                        <a href="<?php echo base_url('account/invoice/'.$profile->id) ?>" class="label label-success"><i class="fa fa-money"></i> Earning Report</a>
                                    </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
