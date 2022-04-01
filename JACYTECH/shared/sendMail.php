<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendMail($email_recipient_email, $email_recipient_name, $email_subject, $email_body, $returnUrl, $button_name)
{
  $debug = true;

  //Create a new PHPMailer instance
  $mail = new PHPMailer;
  //https://pepipost.com/tutorials/phpmailer-smtp-error-could-not-connect-to-smtp-host/
  /**
   * $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
   */
  //Tell PHPMailer to use SMTP
  $mail->isSMTP();

  //Enable SMTP debugging
  // SMTP::DEBUG_OFF = off (for production use)
  // SMTP::DEBUG_CLIENT = client messages
  // SMTP::DEBUG_SERVER = client and server messages
  $mail->SMTPDebug = SMTP::DEBUG_OFF;

  //Set the hostname of the mail server
  $mail->Host = 'smtp.gmail.com';
  // use
  // $mail->Host = gethostbyname('smtp.gmail.com');
  // if your network does not support SMTP over IPv6

  //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
  $mail->Port = 587;

  //Set the encryption mechanism to use - STARTTLS or SMTPS
  $mail->SMTPSecure = 'tls';

  //Whether to use SMTP authentication
  $mail->SMTPAuth = true;

  //Username to use for SMTP authentication - use full email address for gmail
  $mail->Username = 'csq3411@gmail.com';

  //Password to use for SMTP authentication
  $mail->Password = 'gvxxhiecsvxdzayy';

  //Set who the message is to be sent from
  $mail->setFrom('csq3411@gmail.com', 'JACYTECH Service');


  //Set who the message is to be sent to
  $mail->addAddress($debug == true ? 'csq3411@gmail.com' : $email_recipient_email, $email_recipient_name);

  //Set the subject line
  $mail->Subject = $email_subject;


  //Replace the plain text body with one created manually
  $mail->Body = '<!DOCTYPE html>
<html ⚡4email>
  <head>
    <meta charset="utf-8" />
    <style amp4email-boilerplate>
      body {
        visibility: hidden;
      }
    </style>
    <script async src="https://cdn.ampproject.org/v0.js"></script>

    <style amp-custom>
      @media only screen and (max-width: 600px) {
        p,
        ul li,
        ol li,
        a {
          font-size: 16px;
          line-height: 150%;
        }
        h1 {
          font-size: 30px;
          text-align: center;
          line-height: 120%;
        }
        h2 {
          font-size: 26px;
          text-align: center;
          line-height: 120%;
        }
        h3 {
          font-size: 20px;
          text-align: center;
          line-height: 120%;
        }
        h1 a {
          font-size: 30px;
        }
        h2 a {
          font-size: 26px;
        }
        h3 a {
          font-size: 20px;
        }
        .es-menu td a {
          font-size: 16px;
        }
        .es-header-body p,
        .es-header-body ul li,
        .es-header-body ol li,
        .es-header-body a {
          font-size: 16px;
        }
        .es-footer-body p,
        .es-footer-body ul li,
        .es-footer-body ol li,
        .es-footer-body a {
          font-size: 16px;
        }
        .es-infoblock p,
        .es-infoblock ul li,
        .es-infoblock ol li,
        .es-infoblock a {
          font-size: 12px;
        }
        *[class="gmail-fix"] {
          display: none;
        }
        .es-m-txt-c,
        .es-m-txt-c h1,
        .es-m-txt-c h2,
        .es-m-txt-c h3 {
          text-align: center;
        }
        .es-m-txt-r,
        .es-m-txt-r h1,
        .es-m-txt-r h2,
        .es-m-txt-r h3 {
          text-align: right;
        }
        .es-m-txt-l,
        .es-m-txt-l h1,
        .es-m-txt-l h2,
        .es-m-txt-l h3 {
          text-align: left;
        }
        .es-m-txt-r amp-img {
          float: right;
        }
        .es-m-txt-c amp-img {
          margin: 0 auto;
        }
        .es-m-txt-l amp-img {
          float: left;
        }
        .es-button-border {
          display: inline-block;
        }
        a.es-button {
          font-size: 20px;
          display: inline-block;
          border-width: 6px 25px 6px 25px;
        }
        .es-btn-fw {
          border-width: 10px 0px;
          text-align: center;
        }
        .es-adaptive table,
        .es-btn-fw,
        .es-btn-fw-brdr,
        .es-left,
        .es-right {
          width: 100%;
        }
        .es-content table,
        .es-header table,
        .es-footer table,
        .es-content,
        .es-footer,
        .es-header {
          width: 100%;
          max-width: 600px;
        }
        .es-adapt-td {
          display: block;
          width: 100%;
        }
        .adapt-img {
          width: 100%;
          height: auto;
        }
        .es-m-p0 {
          padding: 0px;
        }
        .es-m-p0r {
          padding-right: 0px;
        }
        .es-m-p0l {
          padding-left: 0px;
        }
        .es-m-p0t {
          padding-top: 0px;
        }
        .es-m-p0b {
          padding-bottom: 0;
        }
        .es-m-p20b {
          padding-bottom: 20px;
        }
        .es-mobile-hidden,
        .es-hidden {
          display: none;
        }
        .es-desk-hidden {
          display: table-row;
          width: auto;
          overflow: visible;
          float: none;
          max-height: inherit;
          line-height: inherit;
        }
        .es-desk-menu-hidden {
          display: table-cell;
        }
        table.es-table-not-adapt,
        .esd-block-html table {
          width: auto;
        }
        table.es-social {
          display: inline-block;
        }
        table.es-social td {
          display: inline-block;
        }
      }
      a[x-apple-data-detectors] {
        color: inherit;
        text-decoration: none;
        font-size: inherit;
        font-family: inherit;
        font-weight: inherit;
        line-height: inherit;
      }
      .es-desk-hidden {
        display: none;
        float: left;
        overflow: hidden;
        width: 0;
        max-height: 0;
        line-height: 0;
      }
      s {
        text-decoration: line-through;
      }
      body {
        width: 100%;
        font-family: arial, "helvetica neue", helvetica, sans-serif;
      }
      table {
        border-collapse: collapse;
        border-spacing: 0px;
      }
      table td,
      html,
      body,
      .es-wrapper {
        padding: 0;
        margin: 0;
      }
      .es-content,
      .es-header,
      .es-footer {
        table-layout: fixed;
        width: 100%;
      }
      p,
      hr {
        margin: 0;
      }
      h1,
      h2,
      h3,
      h4,
      h5 {
        margin: 0;
        line-height: 120%;
        font-family: arial, "helvetica neue", helvetica, sans-serif;
      }
      .es-left {
        float: left;
      }
      .es-right {
        float: right;
      }
      .es-p5 {
        padding: 5px;
      }
      .es-p5t {
        padding-top: 5px;
      }
      .es-p5b {
        padding-bottom: 5px;
      }
      .es-p5l {
        padding-left: 5px;
      }
      .es-p5r {
        padding-right: 5px;
      }
      .es-p10 {
        padding: 10px;
      }
      .es-p10t {
        padding-top: 10px;
      }
      .es-p10b {
        padding-bottom: 10px;
      }
      .es-p10l {
        padding-left: 10px;
      }
      .es-p10r {
        padding-right: 10px;
      }
      .es-p15 {
        padding: 15px;
      }
      .es-p15t {
        padding-top: 15px;
      }
      .es-p15b {
        padding-bottom: 15px;
      }
      .es-p15l {
        padding-left: 15px;
      }
      .es-p15r {
        padding-right: 15px;
      }
      .es-p20 {
        padding: 20px;
      }
      .es-p20t {
        padding-top: 20px;
      }
      .es-p20b {
        padding-bottom: 20px;
      }
      .es-p20l {
        padding-left: 20px;
      }
      .es-p20r {
        padding-right: 20px;
      }
      .es-p25 {
        padding: 25px;
      }
      .es-p25t {
        padding-top: 25px;
      }
      .es-p25b {
        padding-bottom: 25px;
      }
      .es-p25l {
        padding-left: 25px;
      }
      .es-p25r {
        padding-right: 25px;
      }
      .es-p30 {
        padding: 30px;
      }
      .es-p30t {
        padding-top: 30px;
      }
      .es-p30b {
        padding-bottom: 30px;
      }
      .es-p30l {
        padding-left: 30px;
      }
      .es-p30r {
        padding-right: 30px;
      }
      .es-p35 {
        padding: 35px;
      }
      .es-p35t {
        padding-top: 35px;
      }
      .es-p35b {
        padding-bottom: 35px;
      }
      .es-p35l {
        padding-left: 35px;
      }
      .es-p35r {
        padding-right: 35px;
      }
      .es-p40 {
        padding: 40px;
      }
      .es-p40t {
        padding-top: 40px;
      }
      .es-p40b {
        padding-bottom: 40px;
      }
      .es-p40l {
        padding-left: 40px;
      }
      .es-p40r {
        padding-right: 40px;
      }
      .es-menu td {
        border: 0;
      }
      a {
        font-family: arial, "helvetica neue", helvetica, sans-serif;
        font-size: 14px;
        text-decoration: underline;
      }
      h1 {
        font-size: 30px;
        font-style: normal;
        font-weight: normal;
        color: #333333;
      }
      h1 a {
        font-size: 30px;
      }
      h2 {
        font-size: 24px;
        font-style: normal;
        font-weight: normal;
        color: #333333;
      }
      h2 a {
        font-size: 24px;
      }
      h3 {
        font-size: 20px;
        font-style: normal;
        font-weight: normal;
        color: #333333;
      }
      h3 a {
        font-size: 20px;
      }
      p,
      ul li,
      ol li {
        font-size: 14px;
        font-family: arial, "helvetica neue", helvetica, sans-serif;
        line-height: 150%;
      }
      ul li,
      ol li {
        margin-bottom: 15px;
      }
      .es-menu td a {
        text-decoration: none;
        display: block;
      }
      .es-menu amp-img,
      .es-button amp-img {
        vertical-align: middle;
      }
      .es-wrapper {
        width: 100%;
        height: 100%;
      }
      .es-wrapper-color {
        background-color: #ffffff;
      }
      .es-content-body {
        background-color: #ffffff;
      }
      .es-content-body p,
      .es-content-body ul li,
      .es-content-body ol li {
        color: #333333;
      }
      .es-content-body a {
        color: #ee6c6d;
      }
      .es-header {
        background-color: transparent;
      }
      .es-header-body {
        background-color: transparent;
      }
      .es-header-body p,
      .es-header-body ul li,
      .es-header-body ol li {
        color: #333333;
        font-size: 14px;
      }
      .es-header-body a {
        color: #ee6c6d;
        font-size: 14px;
      }
      .es-footer {
        background-color: transparent;
      }
      .es-footer-body {
        background-color: #f7f7f7;
      }
      .es-footer-body p,
      .es-footer-body ul li,
      .es-footer-body ol li {
        color: #333333;
        font-size: 14px;
      }
      .es-footer-body a {
        color: #333333;
        font-size: 14px;
      }
      .es-infoblock,
      .es-infoblock p,
      .es-infoblock ul li,
      .es-infoblock ol li {
        line-height: 120%;
        font-size: 12px;
        color: #cccccc;
      }
      .es-infoblock a {
        font-size: 12px;
        color: #cccccc;
      }
      a.es-button {
        border-style: solid;
        border-color: #474745;
        border-width: 6px 25px 6px 25px;
        display: inline-block;
        background: #474745;
        border-radius: 20px;
        font-size: 16px;
        font-family: helvetica, "helvetica neue", arial, verdana, sans-serif;
        font-weight: normal;
        font-style: normal;
        line-height: 120%;
        color: #efefef;
        text-decoration: none;
        width: auto;
        text-align: center;
      }
      .es-button-border {
        border-style: solid solid solid solid;
        border-color: #474745 #474745 #474745 #474745;
        background: #474745;
        border-width: 0px 0px 0px 0px;
        display: inline-block;
        border-radius: 20px;
        width: auto;
      }
    </style>
  </head>
  <body>
    <div class="es-wrapper-color">
      <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="top">
            <table
              class="es-content"
              align="center"
              cellspacing="0"
              cellpadding="0"
            >
              <tr>
                <td align="center">
                  <table
                    class="es-content-body"
                    style="
                      border-left: 1px solid transparent;
                      border-right: 1px solid transparent;
                      border-top: 1px solid transparent;
                      border-bottom: 1px solid transparent;
                    "
                    align="center"
                    width="600"
                    cellspacing="0"
                    cellpadding="0"
                    bgcolor="#ffffff"
                  >
                    <tr>
                      <td class="es-p20t es-p40b es-p40r es-p40l" align="left">
                        <table width="100%" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="left" width="518">
                              <table
                                width="100%"
                                cellspacing="0"
                                cellpadding="0"
                                role="presentation"
                              >
                                <tr>
                                  <td
                                    class="es-p5b es-m-txt-c"
                                    align="center"
                                    style="font-size: 0px;"
                                  >
                                    <img
                                      src="https://i.imgur.com/ocAZIDM.png"
"
                                      alt="icon"
                                      style="display: block;"
                                      title="icon"
                                      width="30"
                                      height="29"
                                    ></amp-img>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="es-m-txt-c" align="center">
                                    <h2>Hey there!<br /></h2>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="es-m-txt-c es-p15t" align="left">
                           ' . $email_body . '
                                  </td>
                                </tr>
                                <tr>
                                  <td
                                    class="es-p20t es-p15b es-p10r es-p10l"
                                    align="center"
                                  >
                                    <span class="es-button-border"
                                      ><a
                                        href="' . $returnUrl . '"
                                        class="es-button"
                                        target="_blank"
                                        >' . $button_name . '</a
                                      ></span
                                    >
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            <table
              cellpadding="0"
              cellspacing="0"
              class="es-footer"
              align="center"
            >
              <tr>
                <td
                  style="background-color: #f7f7f7;"
                  bgcolor="#f7f7f7"
                  align="center"
                >
                  <table
                    class="es-footer-body"
                    width="600"
                    cellspacing="0"
                    cellpadding="0"
                    align="center"
                  >
                    <tr>
                      <td class="es-p20t es-p20b es-p20r es-p20l" align="left">
                        <table width="100%" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="560" valign="top" align="center">
                              <table
                                width="100%"
                                cellspacing="0"
                                cellpadding="0"
                                role="presentation"
                              >
                                <tr>
                                  <td align="center" class="es-p10t es-p10b">
                                    <p style="line-height: 150%;">
                                      You are receiving this email because you
                                      have visited our site.
                                    </p>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="es-p10t es-p10b" align="center">
                                    <p>© 2021</p>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            <table
              class="es-content"
              align="center"
              cellspacing="0"
              cellpadding="0"
            >
              <tr>
                <td align="center">
                  <table
                    class="es-content-body"
                    style="background-color: transparent;"
                    align="center"
                    width="600"
                    cellspacing="0"
                    cellpadding="0"
                  >
                    <tr>
                      <td class="es-p30t es-p30b es-p20r es-p20l" align="left">
                        <table width="100%" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center" width="560" valign="top">
                              <table
                                width="100%"
                                cellspacing="0"
                                cellpadding="0"
                                role="presentation"
                              >
                                <tr>
                                  <td
                                    class="es-infoblock made_with"
                                    align="center"
                                    style="font-size: 0px;"
                                  >
                                    <a
                                      target="_blank"
                                      href="http://' . $_SERVER['HTTP_HOST'] . substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], "/")) . 'index.php"
                                      ><img
                                        src="https://i.imgur.com/ocAZIDM.png"
"
                                        alt
                                        width="125"
                                        style="display: block;"
                                        height="121"
                                      ></img
                                    ></a>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </div>
    <div
      style="position: absolute; left: -9999px; top: -9999px; margin: 0px;"
    ></div>
  </body>
</html>
';
  $mail->isHTML(true);
  //send the message, check for errors
  if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    return false;
  } else {
    return true;
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
  }
}
//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
function save_mail($mail)
{
  //You can change 'Sent Mail' to any other folder or tag
  $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';

  //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
  $imapStream = imap_open($path, $mail->Username, $mail->Password);

  $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
  imap_close($imapStream);

  return $result;
}