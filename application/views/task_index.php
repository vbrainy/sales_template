
<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    
      <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />


<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">

                <div class="box-header">
                    <span class="box-title">
                        <a class="btn btn-info editBtn" style="color: #fff;" title="Add Task" data-toggle="tooltip" href="<?php echo base_url(); ?>tasks/add_task">

<i class="fa fa-plus"></i> Add Task</a>
                        <a class="btn btn-success" style="color: #fff;" title="Active Task" data-toggle="tooltip" href="#">

<i class="fa "></i> Active Task</a>

                    </span>
                    <div class="col-md-6" style="padding-top: 10px;">



                        <div class="form-inline">


                            <div class="form-group">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" id="reservation" name="searchByNameInput" placeholder="Search within date range">
                                </div>
                            </div>
                            <button type="submit" id="searchByDateBtn" class="btn btn-primary">Search</button>

                        </div>
                    </div>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                        <tr>
                            <th width="15%">Task Title</th>
                            <th width="15%">Task ID</th>

                            <th width="15%">Agent Name</th>
                            <th width="15%">Agent Area</th>
                            <th width="10%">Add Job</th>
                            

<!--                            <th>Created at</th>
                            <th>Modified at</th>-->
                            <th width="30%">Action</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>Task Title</th>
                            <th>Task ID</th>

<th>Agent Name</th>
                            <th>Agent Area</th>
                            <th>Add Job</th>

<!--                            <th>Created at</th>
                            <th>Modified at</th>-->

                            <th>Action</th>
                        </tr>
                        </tfoot>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->

<?php function page_js(){ ?>



    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $("#example").dataTable({
//                "processing": true,
//                "serverSide": true,
                "ordering": true,
                "searching": true,
                "destroy": true,
                "ajax": "<?php echo base_url('tasks/tasksListJson'); ?>",
                "language": {
                    "zeroRecords": "No Records Found",
                    "info":           "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty":      "Showing 0 to 0 of 0 entries",
                }
            });
        });

    </script>

<script>

    $('body').on('click', 'a.deleteBtn', function () {
        var agentId = $(this).attr('id');
        var currentItem = $(this);
        var verifyConfirm = confirm('Are you sure?'); //confirm

        if(verifyConfirm) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('tasks/deleteAjax') ?>",
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
        if(buttonValue == 1){
            var status = 'Active';
        }else if(buttonValue == 0){
            var status = 'In Active';
        }

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('tasks/setBlockUnblock') ?>",
            data: {id: agentId, buttonValue : buttonValue, status : status}
        })
        .done(function (msg) {
            if(buttonValue == 1){
                currentItem.removeClass('btn-success');
                currentItem.addClass('btn-warning');
                currentItem.html('<i class="fa fa-lock"></i>');
                currentItem.attr( 'title','In Active');
                currentItem.val(0);
            }else if(buttonValue == 0){
                currentItem.removeClass('btn-warning');
                currentItem.addClass('btn-success');
                currentItem.html('<i class="fa fa-unlock-alt"></i>');
                currentItem.attr( 'title','Active');
                currentItem.val(1);
            }
        });
    });



</script>


    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->
    <!-- bootstrap time picker -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <!-- Page script -->
    <script type="text/javascript">
        $(function() {
            //Date range picker
            $('#reservation').daterangepicker({ format: 'YYYY-MM-DD' });
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        });
    </script>


<?php } ?>

