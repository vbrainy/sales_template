<table style="height:100%;background-color:#F2F2F2;" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
    <tr>
        <td style="padding:40px 20px;" align="center" valign="top">
            <table style="width:600px;" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                <tr>
                    <td align="center" valign="top">
                        <h1> <?php echo get_option('company_name'); ?> </h1>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:30px;padding-bottom:30px;" align="center" valign="top">
                        <table style="background-color:#FFFFFF;border-collapse:separate;" border="0" cellpadding="0"
                               cellspacing="0" width="100%">
                            <tbody>
                            <tr>
                                <td class="bodyContent"
                                    style="color:#606060;font-family:Helvetica, Arial, sans-serif;font-size:15px;line-height:150%;padding-top:40px;padding-right:40px;padding-bottom:30px;padding-left:40px;text-align:center;"
                                    align="center" valign="top">
                                    <h1 style="color:#606060;font-family:Helvetica, Arial, sans-serif;font-size:40px;font-weight:bold;letter-spacing:-1px;line-height:115%;margin:0;padding:0;text-align:center;">
                                        Your Purchase Details</h1>
                                    <br>

                                    <h3 style="color:#606060;font-family:Helvetica, Arial, sans-serif;font-size:16px;letter-spacing:-.5px;line-height:115%;margin:0;padding:0;">
                                        Hi <?php echo user_full_name($userData);  ?>,</h3></br>

                                    <p style="color:#606060;font-family:Helvetica, Arial, sans-serif;font-size:14px; text-align: left;"><?php echo form_error('email_text_product_sales'); ?></p>

                                    <table style="color:#606060;font-family:Helvetica, Arial, sans-serif;font-size:14px;letter-spacing:-.5px;line-height:115%;margin:0 auto;padding:0;text-align:center; border-collapse: collapse" border="1">
                                        <tr>
                                            <th style="padding:5px;text-align:center;">Sl No.</th>
                                            <th style="padding:5px;text-align:center;">Product Name</th>
                                            <th style="padding:5px;text-align:center;">Price</th>
                                            <th style="padding:5px;text-align:center;">Quantity</th>
                                            <th style="padding:5px;text-align:center;">Subtotal</th>
                                        </tr>

                                        <?php echo $tableRow; ?>

                                    </table>

                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                            <tr>
                                <td class="footerContent"
                                    style="color:#606060;font-family:Helvetica, Arial, sans-serif;font-size:13px;line-height:125%;"
                                    align="center" valign="top">
                                    © <?php echo date('Y').' '.get_option('company_name'); ?>,
                                    All Rights Reserved.
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:30px;" align="center" valign="top">

                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>