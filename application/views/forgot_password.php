<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title><?php if(isset($title)) echo $title.' | '; ?>  Sales agent management software (SAMS) </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/admin'); ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header"><i class="fa  fa-sign-in"></i> Password Retrieval</div>
            <?php echo form_open(); ?>
                <div class="body bg-gray">
                    <div class="form-group">
                        <?php echo flash_msg(); ?>
                        <?php if($this->session->flashdata('loggedIn_fail')){ ?>
                        <div class="alert alert-danger alert-dismissable">
                            <i class="fa fa-ban"></i>
                            <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                            <b>Alert!</b> <?php echo $this->session->flashdata('loggedIn_fail'); ?>
                        </div>
                        <?php } ?>

                        <?php if(validation_errors()){
                            echo '<div class="alert alert-danger" style="margin-left: 0;"> '.validation_errors().' </div>';
                        } ?>

                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-send-o"></i> </div>
                            <input type="email" name="email" class="form-control" placeholder="Email"/>
                        </div>
                    </div>

                </div>
                <div class="footer">
                    <button type="submit" class="btn bg-olive btn-block" name="submitBtn" value="submitBtn"><i class="fa  fa-lock"></i> Get Password</button>

                   <!-- <p><a href="#"><i class="fa fa-info-circle"></i> I forgot my password</a></p>-->

                    <a href="<?php echo base_url() ?>" class="text-center"><i class="fa fa-sign-in"></i> Back to Sign In</a> <br />
                    <a href="<?php echo base_url('welcome/registerUser') ?>" class="text-center"><i class="fa fa-plus-square-o"></i> Register a new membership</a>
                </div>
            </form>

        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>
