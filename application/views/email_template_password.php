<table style="height:100%;background-color:#F2F2F2;" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
    <tr>
        <td style="padding:40px 20px;" align="center" valign="top">
            <table style="width:600px;" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                <tr>
                    <td align="center" valign="top">
                        <h2><?php echo get_option('company_name'); ?></h2>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:30px;padding-bottom:30px;" align="center" valign="top">
                        <table style="background-color:#FFFFFF;border-collapse:separate;" border="0" cellpadding="0"
                               cellspacing="0" width="100%">
                            <tbody>
                            <tr>
                                <td class="bodyContent"
                                    style="color:#606060;font-family:Helvetica, Arial, sans-serif;font-size:15px;line-height:150%;padding-top:40px;padding-right:40px;padding-bottom:30px;padding-left:40px;"
                                     valign="top">
                                    <?php /*
                                    <h1 style="color:#606060;font-family:Helvetica, Arial, sans-serif;font-size:40px;font-weight:bold;letter-spacing:-1px;line-height:115%;margin:0;padding:0;text-align:center;">
                                        Thanks for registration! Your Account Successfully Created</h1> */
                                    $users = singleDbTableRow($email, 'users', 'email');

                                    ?>


                                    <p>Dear <?php echo user_full_name($users); ?>, </p>
                                    <p>Thank you for choosing <?php echo get_option('company_name'); ?>  </p>
                                    <p>Below are your account details. </p>

                                    <br>

                                    <h3 style="color:#606060;font-family:Helvetica, Arial, sans-serif;font-size:18px;letter-spacing:-.5px;line-height:115%;margin:0;padding:0;text-align:center;">
                                        Email : <?php echo $email;  ?></h3>
                                    <br>
                                    <h3 style="color:#606060;font-family:Helvetica, Arial, sans-serif;font-size:18px;letter-spacing:-.5px;line-height:115%;margin:0;padding:0;text-align:center;">
                                       Password: <?php echo $password;  ?></h3>
                                    <br>
                                    Click button below to login your account.
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-right:40px;padding-bottom:40px;padding-left:40px;" align="center"
                                    valign="middle">
                                    <table class="emailButton"
                                           style="background-color:#6DC6DD;border-collapse:separate;" border="0"
                                           cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td class="emailButtonContent"
                                                style="color:#FFFFFF;font-family:Helvetica, Arial, sans-serif;font-size:15px;font-weight:bold;line-height:100%;padding-top:18px;padding-right:15px;padding-bottom:15px;padding-left:15px;"
                                                align="center" valign="middle">
                                                <a href="<?php echo base_url(); ?>"
                                                   style="color:#FFFFFF;text-decoration:none;" target="_blank">Login Into Account</a>
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
                <tr>
                    <td align="center" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                            <tr>
                                <td class="footerContent"
                                    style="color:#606060;font-family:Helvetica, Arial, sans-serif;font-size:13px;line-height:125%;"
                                    align="center" valign="top">
                                    © <?php echo date('Y').' '. get_option('company_name'); ?>, All Rights Reserved.
                                    <br><a href="#" style="color:#606060;text-decoration:none;"><span
                                            style="color:#606060;"><?php echo get_option('default_email'); ?></span></a>
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