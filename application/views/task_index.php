
<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
<<<<<<< HEAD
                
                <div class="box-header">
                    
                    <h3 class="box-title">Task List</h3>
                    
                    <a class="btn btn-primary editBtn" title="Add Task" data-toggle="tooltip" href="http://localhost/sales_template/tasks/add_task">
Add Task
</a>
                    
                </div><!-- 52.37.147.104 /.box-header -->
                
=======
                <div class="box-header">
                    <h3 class="box-title">Task List</h3>
                </div><!-- /.box-header -->
>>>>>>> refs/remotes/origin/master
                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Unique Identifier</th>
<<<<<<< HEAD
                            <th>Agent Name</th>
                            <th>Agent Area</th>
                            <th>Add Job</th>
                            
=======
<!--                            <th>Created at</th>
                            <th>Modified at</th>-->
>>>>>>> refs/remotes/origin/master
                            <th width="20%">Action</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Unique Identifier</th>
<<<<<<< HEAD
<th>Agent Name</th>
                            <th>Agent Area</th>
                            <th>Add Job</th>
=======
<!--                            <th>Created at</th>
                            <th>Modified at</th>-->
>>>>>>> refs/remotes/origin/master
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
                "ajax": "<?php echo base_url('tasks/tasksListJson'); ?>"
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
            var status = 'Unblocked';
        }else if(buttonValue == 2){
            var status = 'Blocked';
        }

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('agent/setBlockUnblock') ?>",
            data: {id: agentId, buttonValue : buttonValue, status : status}
        })
        .done(function (msg) {
            if(buttonValue == 1){
                currentItem.removeClass('btn-success');
                currentItem.addClass('btn-warning');
                currentItem.html('<i class="fa fa-lock"></i>');
                currentItem.attr( 'title','Block');
                currentItem.val(2);
            }else if(buttonValue == 2){
                currentItem.removeClass('btn-warning');
                currentItem.addClass('btn-success');
                currentItem.html('<i class="fa fa-unlock-alt"></i>');
                currentItem.attr( 'title','Unblock');
                currentItem.val(1);
            }
        });
    });



</script>


<?php } ?>

