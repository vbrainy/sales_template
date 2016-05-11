<?php include('header.php'); 

?>
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
                                                <th>Registration Number</th>
                                                <th><?php echo $c_user->agent_registaration_no; ?></th>
                                            </tr>  
                                           
                                            <tr>
                                                <th>Full Name</th>
                                                <th><?php echo $c_user->first_name.' '. $c_user->last_name; ?></th>
                                            </tr>
                                            <tr>
                                                <td>Address 1</td>
                                                <td><?php echo $c_user->agent_address1; ?></td>
                                            </tr>
                                                <tr>
                                                <td>Address 2</td>
                                                <td><?php echo $c_user->agent_address2; ?></td>
                                            </tr>
                                           
                                                 <tr>
                                                <td>City</td>
                                                <td><?php echo $c_user->city; ?></td>
                                            </tr>
                                             <tr>
                                                <td>County</td>
                                                <td><?php echo $c_user->county; ?></td>
                                            </tr>
                                             <tr>
                                                <td>Postal Code</td>
                                                <td><?php echo $c_user->postal_code; ?></td>
                                            </tr> 
                                            
                                                <tr>
                                                <td>Country</td>
                                                <td><?php echo $c_user->country; ?></td>
                                            </tr>
                                            
                                            
                                             <tr>
                                                <td>Gender</td>
                                                <td><?php echo $c_user->gender; ?></td>
                                            </tr>
                                            
                                            
                                            
                                            
                                            <tr>
                                                <td>Nationality Origin </td>
                                                <td><?php echo $c_user->nationality_origin; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td><?php echo $c_user->email; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Contact No.</td>
                                                <td><?php echo $c_user->mobile_no_1; ?></td>
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
                                                <td>Postal Code</td>
                                                <td><?php echo $c_user->postal_code; ?></td>
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
