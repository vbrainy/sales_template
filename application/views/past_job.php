
<?php 
function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php include('header.php'); ?>
    <input type="hidden" id="task_id" value="<?php echo $task_id; ?>"/>
    

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
   <div class="box-header">
       <span class="box-title"><a class="btn btn-info editBtn" style="color: #fff;" title="Back" data-toggle="tooltip" href="<?php echo base_url(); ?>tasks/index">
<i class="fa fa-backward"></i> Back</a></span>
<span class="box-title"><a class="btn btn-info editBtn" title="Add Job" style="color: #fff;" data-toggle="tooltip" href="<?php echo base_url(); ?>jobs/add_job/<?php echo $task_id ?>">
<i class="fa fa-plus"></i> Add Job</a></span>
<div class="clearfix"></div>
                    <span class="box-title">
                        <h3>
                            <p>Task ID: <?php echo getTaskClearName($task->unique_name); ?></p>
                            <p>Task Title: <?php echo $task->title; ?></p>
                        </h3>
                    </span>
                </div>
                <hr>
                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                        <tr>
                            <th>Job ID</th>
                            <th>City</th>
<!--                            <th>Agent Area</th>
                            <th>Add Job</th>-->
                            

<!--                            <th>Created at</th>
                            <th>Modified at</th>-->
                            <th width="20%">Action</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>Job ID</th>
                            <th>City</th>

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
                "ajax": {
                    "url": "<?php echo base_url('jobs/jobsListJson'); ?>",
                    "data": function ( d ) {
                        d.task_id = $('#task_id').val();
                    }
                },
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
        if(buttonValue == 1){
            var status = 'Active';
        }else if(buttonValue == 0){
            var status = 'In Active';
        }

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('jobs/setBlockUnblock') ?>",
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


<?php } ?>

