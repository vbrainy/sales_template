<?php foreach($invoiceQuery ->result() as $invoice); ?>
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

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div><!-- /.box-header -->
                <div class="box-body">


                    <!-- Main content -->
                    <section class="content invoice">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    <i class="fa fa-globe"></i> <?php echo get_admin_settings()->company_name; ?>
                                    <small class="pull-right">Date: <?php echo date('d/m/Y', $invoice->created_at); ?></small>
                                </h2>
                            </div><!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                Sales by
                                <address>
                                    <strong>
                                        <?php echo $invoice->agentFirstName.' '.$invoice->agentLastName; ?>
                                    </strong><br>

                                    <?php echo nl2br($invoice->agentStreetAddress).'<br/>';
                                    echo 'Phone: '.$invoice->agentContactNo.'<br/>';
                                    echo 'Email: '.$invoice->agentEmail.'<br/>';
                                    ?>
                                </address>
                            </div><!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                Client
                                <address>
                                    <strong>
                                        <?php echo $invoice->userFirstName.' '.$invoice->userLastName; ?>
                                    </strong><br>

                                    <?php echo nl2br($invoice->userStreetAddress).'<br/>';
                                    echo 'Phone: '.$invoice->userContactNo.'<br/>';
                                    echo 'Email: '.$invoice->userEmail.'<br/>';
                                    ?>
                                </address>
                            </div><!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>Invoice No: #<?php echo $invoice->id; ?></b><br/>
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Qty</th>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($invoiceItem->result() as $item){ ?>
                                    <tr>
                                        <td><?php echo $item->qty; ?></td>
                                        <td><?php echo $item->product_name; ?></td>
                                        <td><?php echo $item->categoryName; ?></td>
                                        <td><?php echo number_format($item->item_price, 2); ?></td>
                                        <td>
                                            <?php echo number_format($item->price, 2);
                                            $totalPrice[] = $item->price;
                                            ?>
                                        </td>
                                    </tr>
                                    <?php } ?>

                                    </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-xs-6">
                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                    <?php echo get_option('invoice_information'); ?>
                                </p>
                            </div><!-- /.col -->
                            <div class="col-xs-6">
                                <br />
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Total:</th>
                                            <td><?php echo number_format(array_sum($totalPrice), 2); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->


                        <?php echo get_option('invoice_terms') != ''? '<p style="text-align: center">'.get_option('invoice_terms').'</p>' : ''; ?>

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-xs-12">
                                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                                <a href="<?php echo base_url('product/pdf_invoice/'.$invoice->id) ?>" class="btn btn-primary" ><i class="fa fa-file-pdf-o"></i> Download PDF</a>
                            </div>
                        </div>
                    </section><!-- /.content -->


                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->

</body>
</html>

