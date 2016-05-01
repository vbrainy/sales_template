
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
                    <span class="box-title">
                        <div>
                            Unique Identifier :<?php echo $task->unique_name ; ?>
                        </div>
                        <div>
                            Task :<?php echo $task->title; ?>
                        </div>
                    </span>
                </div>
                <hr>
                <div class="box-header">
                   
                    
                    
                </div><!-- 52.37.147.104 /.box-header -->
                

<!--                <div class="box-header">
                    <span class="box-title"><a class="btn btn-info editBtn" title="Add Task" data-toggle="tooltip" href="<?php echo base_url(); ?>tasks/add_task">

<i class="fa fa-edit"></i> Add Task</a></span>
                </div> /.box-header -->

                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                        <tr>
                            <th>Unique Identifier</th>
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
                            <th>Unique Identifier</th>
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
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?php echo base_url('jobs/jobsListJson'); ?>",
                    "data": function ( d ) {
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

