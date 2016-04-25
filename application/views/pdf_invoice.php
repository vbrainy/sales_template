<?php foreach($invoiceQuery ->result() as $invoice); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php if(isset($title)) echo $title.' | '; ?>  Sales agent management software (SAMS) </title>
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <style>
        body{
            font-size: 12px; !important;
            background: #ffffff !important;
        }
    </style>
</head>


<section class="content invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <table class="table no-border" style="width: 100%">
                <tr>
                    <td><h3><?php echo get_admin_settings()->company_name; ?></h3>  </td>
                    <td>Date: <?php echo date('d/m/Y', $invoice->created_at); ?>< </td>
                </tr>
            </table>

        </div><!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info" style="border-bottom: 1px solid #f4f4f4; border-top: 1px solid #f4f4f4" >
        <table class="table no-border" style="width: 100%">
            <tr>
                <td>
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
                </td>

                <td>
                    To
                    <address>
                        <strong>
                            <?php echo $invoice->userFirstName.' '.$invoice->userLastName; ?>
                        </strong><br>

                        <?php echo nl2br($invoice->userStreetAddress).'<br/>';
                        echo 'Phone: '.$invoice->userContactNo.'<br/>';
                        echo 'Email: '.$invoice->userEmail.'<br/>';
                        ?>
                    </address>
                </td>
                <td>
                    <b>Invoice No: #<?php echo $invoice->id; ?></b><br/>
                </td>
            </tr>
        </table>

        <br />
    </div><!-- /.row -->


    <br />

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12" >
            <table class="table table-striped" style="width: 100%">
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

                    <tr>
                        <th colspan="4" style="text-align: right">Total</th>
                        <td  style="text-align: left"><?php echo number_format(array_sum($totalPrice), 2); ?></td>
                    </tr>
                </tbody>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->


    <br>
    <?php echo get_option('invoice_information') != ''? '<p style="text-align: center">'.get_option('invoice_information').'</p><br />' : ''; ?>

    <?php echo get_option('invoice_terms') != ''? '<p style="text-align: center">'.get_option('invoice_terms').'</p>' : ''; ?>

</section><!-- /.content -->



</body>
</html>

