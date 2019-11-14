<?php

//--------------------------------
// @author: Băcilă Andrei        |
//            (an4rei)           |
// @IDE: phpStorm                |
// @skype: freerunningparkour    |
//--------------------------------
/*

                                 ,--,
                               ,--.'|
                            ,--,  | :                   ,--,
                   ,---, ,---.'|  : '  __  ,-.        ,--.'|
               ,-+-. /  |;   : |  | ;,' ,'/ /|        |  |,
   ,--.--.    ,--.'|'   ||   | : _' |'  | |' | ,---.  `--'_
  /       \  |   |  ,"' |:   : |.'  ||  |   ,'/     \ ,' ,'|
 .--.  .-. | |   | /  | ||   ' '  ; :'  :  / /    /  |'  | |
  \__\/: . . |   | |  | |\   \  .'. ||  | ' .    ' / ||  | :
  ," .--.; | |   | |  |/  `---`:  | ';  : | '   ;   /|'  : |__
 /  /  ,.  | |   | |--'        '  ; ||  , ; '   |  / ||  | '.'|
;  :   .'   \|   |/            |  : ; ---'  |   :    |;  :    ;
|  ,     .-./'---'             '  ,/         \   \  / |  ,   /
 `--`---'                      '--'           `----'   ---`-'
*/
require('includes/config.php');

$cunt = json_decode(file_get_contents('php://input'), true);
$fuck = file_get_contents('php://input');

$stmt = $db->prepare('INSERT INTO logs (type, log, time, user) VALUES (1, :log, :date, :user)');
$stmt->execute(array(
    ':log' => $fuck,
    ':date' => date("Y-m-d H:i:s"),
    ':user' => $_SERVER['REMOTE_ADDR']
));

if(!empty($cunt)) {
    $status=$cunt['transaction']['status'];

    $user_em=$cunt['user']['emailAddress'];
    $user_ph=$cunt['user']['phoneNumber'];
    $user_id=$cunt['user']['userId'];
    $user_extref=$cunt['user']['externalRefId'];

    //KYC VALIDATION YES/NO

    if($cunt['eventName']=='KYCUpgrade') {
        $kyclevel = $cunt['nonTransactionData']['userKyc'];
        if(!empty($cunt['nonTransactionData']['comments'])){
            $comenturi=$cunt['nonTransactionData']['comments'];
        }else{
            $comenturi='no comments';
        }

        $stmt = $db->prepare('UPDATE members SET kycLevel= :status , kycRequest = :welp , kycComment= :welp2 WHERE username=:id_cur');
        $stmt->execute(array(
            ':welp' => $status,
            ':welp2' => $comenturi,
            ':status' => $kyclevel,
            ':id_cur' => $user_em
        ));

        if($kyclevel!='LEVEL_1'){
            $stmta = $db->prepare('SELECT username FROM orders WHERE usr_id=:ida');
            $stmta->execute(array(
                ':ida' => $user_id
            ));
            $prost = $stmta->fetch(PDO::FETCH_ASSOC);

            $to = $prost['username'];
            $subject = "Successful KYC Upgrade";
            $body = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">
<head>
<title></title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<style type=\"text/css\">
  body, .maintable { height:100% !important; width:100% !important; margin:0; padding:0; }
  img, a img { border:0; outline:none; text-decoration:none; }
  .imagefix { display:block; }
  p {margin-top:0; margin-right:0; margin-left:0; padding:0;}
  .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}
  .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;}
  img{-ms-interpolation-mode: bicubic;}
  body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}
</style>
<style type=\"text/css\">
@media only screen and (max-width: 600px) {
    .rtable {width: 100% !important; table-layout: fixed;}
    .rtable tr {height:auto !important; display: block;}
    .contenttd {max-width: 100% !important; display: block;}
    .contenttd:after {content: \"\"; display: table; clear: both;}
    .hiddentds {display: none;}
    .imgtable, .imgtable table {max-width: 100% !important; height: auto; float: none; margin: 0 auto;}
    .imgtable.btnset td {display: inline-block;}
    .imgtable img {width: 100%; height: auto; display: block;}
    table{float: none; table-layout: fixed;}
}
</style>
<!--[if gte mso 9]>
<xml>
  <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
  </o:OfficeDocumentSettings>
</xml>
<![endif]-->
</head>
<body style=\"overflow: auto; padding:0; margin:0; font-size: 14px; font-family: arial, helvetica, sans-serif; cursor:auto; background-color:#225ebe\">
<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" bgcolor=\"#225ebe\">
<tr>
<td style=\"FONT-SIZE: 0px; HEIGHT: 20px; LINE-HEIGHT: 0\"></td>
</tr>
<tr>
<td valign=\"top\">
<table class=\"rtable\" style=\"WIDTH: 600px; MARGIN: 0px auto\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\" border=\"0\">
<tr>
<td class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: transparent\">
<table style=\"WIDTH: 100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
<tr class=\"hiddentds\">
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 327px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 273px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
</tr>
<tr style=\"HEIGHT: 10px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 20px; TEXT-ALIGN: left; PADDING-TOP: 20px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\"><!--[if gte mso 12]>
    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"center\">
<![endif]-->
<table class=\"imgtable\" style=\"MARGIN: 0px auto\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" border=\"0\">
<tr>
<td style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=\"center\">
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr>
<td style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\"><img style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block\" alt=\"\" src=\"https://mailchef.s3.amazonaws.com/uploads/mailstyler/images/C87FF2AA-531D-1C9A-D167-5AC93230A9BD_Image_1_6a265d40-c636-4162-b9ea-7160744715c3.png\" width=\"293\" height=\"41\" hspace=\"0\" vspace=\"0\" /></td>
</tr>
</table>
</td>
</tr>
</table>
<!--[if gte mso 12]>
    </td></tr></table>
<![endif]--></th>
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: bottom; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 0px; TEXT-ALIGN: left; PADDING-TOP: 0px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">
<p style=\"FONT-SIZE: 16px; MARGIN-BOTTOM: 1em; FONT-FAMILY: arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #2d2d2d; LINE-HEIGHT: 19px; BACKGROUND-COLOR: #225ebe; mso-line-height-rule: exactly\" align=\"right\"><strong>Date:{$date}</strong></p>
</th>
</tr>
</table>
</td>
</tr>
<tr>
<td class=\"contenttd\" style=\"BORDER-TOP: #2f0fa3 5px solid; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">
<table style=\"WIDTH: 100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
<tr class=\"hiddentds\">
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 600px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
</tr>
<tr style=\"HEIGHT: 10px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 20px; TEXT-ALIGN: left; PADDING-TOP: 20px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\"><!--[if gte mso 12]>
    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"center\">
<![endif]-->
<table class=\"imgtable\" style=\"MARGIN: 0px auto\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" border=\"0\">
<tr>
<td style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=\"center\">
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr>
<td style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\"><img style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block\" alt=\"\" src=\"https://mailchef.s3.amazonaws.com/uploads/mailstyler/images/03D8C862-10C6-EE98-7CDC-AA9EF0F81D5D_Image_2_4f90588a-b531-4fac-88e5-14eece2ef192.jpg\" width=\"566\" height=\"377\" hspace=\"0\" vspace=\"0\" /></td>
</tr>
</table>
</td>
</tr>
</table>
<!--[if gte mso 12]>
    </td></tr></table>
<![endif]--></th>
</tr>
</table>
</td>
</tr>
<tr>
<td class=\"contenttd\" style=\"BORDER-TOP: #2f0fa3 5px solid; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">
<table style=\"WIDTH: 100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
<tr class=\"hiddentds\">
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 600px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
</tr>
<tr style=\"HEIGHT: 10px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 20px; TEXT-ALIGN: left; PADDING-TOP: 20px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">
<p style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 12px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"center\"><span style='FONT-SIZE: 36px; FONT-FAMILY: \"arial black\", gadget, sans-serif; LINE-HEIGHT: 43px'><strong>KYC Upgrade</strong></span></p>
<p style=\"FONT-SIZE: 14px; MARGIN-BOTTOM: 1em; FONT-FAMILY: arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 17px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"center\"><strong>We bring good news! <br>Your KYC documents just got <font color=\'green\'>validated</font> so we have lifted the limits from your account!</strong></p>
</th>
</tr>
</table>
</td>
</tr>
<tr>
<td class=\"contenttd\" style=\"BORDER-TOP: #225ebe 5px solid; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">
<table style=\"WIDTH: 100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
<tr class=\"hiddentds\">
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 600px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
</tr>
<tr style=\"HEIGHT: 20px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 10px; TEXT-ALIGN: left; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\"><!--[if gte mso 12]>
    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"center\">
<![endif]-->
<table class=\"imgtable btnset\" style=\"TEXT-ALIGN: center; MARGIN: 0px auto\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr>
<td class=\"contenttd\" style=\"VERTICAL-ALIGN: middle; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px\"> </td>
</tr>
</table>
<!--[if gte mso 12]>
    </td></tr></table>
<![endif]-->
<p style=\"FONT-SIZE: 24px; MARGIN-BOTTOM: 1em; FONT-FAMILY: geneve, arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #2d2d2d; LINE-HEIGHT: 36px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p style=\"FONT-SIZE: 14px; MARGIN-BOTTOM: 1em; FONT-FAMILY: arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #575757; LINE-HEIGHT: 21px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\"><span style=\"BACKGROUND-COLOR: #feffff\"><br />
</span><span style=\"FONT-SIZE: 9px; LINE-HEIGHT: 14px\"><span style=\"COLOR: #efefef\"><span style=\"COLOR: #959595\"><br />
&ldquo;Visa<span style=\"font-size:11px\">®</span> Prepaid card is issued by Wave Crest Holdings Limited pursuant to a license from Visa Europe. Visa is a registered trademark of Visa Incorporated. Wave Crest Holdings Limited is a licensed electronic money institution by the Financial Services Commission, Gibraltar. Streamflow Eood &copy; 2017, All Rights Reserved. Streamflow Eood is a company registered in Bulgaria UIC 202977139.&rdquo;</span></span></span><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
</th>
</tr>
<tr style=\"HEIGHT: 20px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 10px; TEXT-ALIGN: left; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\"></th>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td style=\"FONT-SIZE: 0px; HEIGHT: 8px; LINE-HEIGHT: 0\">&nbsp;</td>
</tr>
</table>
<!-- Created with MailStyler 2.0.1.300 -->
</body>
</html>";
            $mail = new Mail();
            $mail->setFrom(SITEEMAIL);
            $mail->addAddress($to);
            $mail->subject($subject);
            $mail->body($body);
            $mail->send();
        }else{
            $stmta = $db->prepare('SELECT username FROM orders WHERE usr_id=:ida');
            $stmta->execute(array(
                ':ida' => $user_id
            ));
            $prost = $stmta->fetch(PDO::FETCH_ASSOC);

            $to = $prost['username'];
            $subject = "Failed KYC Upgrade";
            $body = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">
<head>
<title></title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<style type=\"text/css\">
  body, .maintable { height:100% !important; width:100% !important; margin:0; padding:0; }
  img, a img { border:0; outline:none; text-decoration:none; }
  .imagefix { display:block; }
  p {margin-top:0; margin-right:0; margin-left:0; padding:0;}
  .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}
  .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;}
  img{-ms-interpolation-mode: bicubic;}
  body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}
</style>
<style type=\"text/css\">
@media only screen and (max-width: 600px) {
    .rtable {width: 100% !important; table-layout: fixed;}
    .rtable tr {height:auto !important; display: block;}
    .contenttd {max-width: 100% !important; display: block;}
    .contenttd:after {content: \"\"; display: table; clear: both;}
    .hiddentds {display: none;}
    .imgtable, .imgtable table {max-width: 100% !important; height: auto; float: none; margin: 0 auto;}
    .imgtable.btnset td {display: inline-block;}
    .imgtable img {width: 100%; height: auto; display: block;}
    table{float: none; table-layout: fixed;}
}
</style>
<!--[if gte mso 9]>
<xml>
  <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
  </o:OfficeDocumentSettings>
</xml>
<![endif]-->
</head>
<body style=\"overflow: auto; padding:0; margin:0; font-size: 14px; font-family: arial, helvetica, sans-serif; cursor:auto; background-color:#225ebe\">
<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" bgcolor=\"#225ebe\">
<tr>
<td style=\"FONT-SIZE: 0px; HEIGHT: 20px; LINE-HEIGHT: 0\"></td>
</tr>
<tr>
<td valign=\"top\">
<table class=\"rtable\" style=\"WIDTH: 600px; MARGIN: 0px auto\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\" border=\"0\">
<tr>
<td class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: transparent\">
<table style=\"WIDTH: 100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
<tr class=\"hiddentds\">
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 327px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 273px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
</tr>
<tr style=\"HEIGHT: 10px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 20px; TEXT-ALIGN: left; PADDING-TOP: 20px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\"><!--[if gte mso 12]>
    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"center\">
<![endif]-->
<table class=\"imgtable\" style=\"MARGIN: 0px auto\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" border=\"0\">
<tr>
<td style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=\"center\">
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr>
<td style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\"><img style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block\" alt=\"\" src=\"https://mailchef.s3.amazonaws.com/uploads/mailstyler/images/C87FF2AA-531D-1C9A-D167-5AC93230A9BD_Image_1_6a265d40-c636-4162-b9ea-7160744715c3.png\" width=\"293\" height=\"41\" hspace=\"0\" vspace=\"0\" /></td>
</tr>
</table>
</td>
</tr>
</table>
<!--[if gte mso 12]>
    </td></tr></table>
<![endif]--></th>
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: bottom; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 0px; TEXT-ALIGN: left; PADDING-TOP: 0px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">
<p style=\"FONT-SIZE: 16px; MARGIN-BOTTOM: 1em; FONT-FAMILY: arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #2d2d2d; LINE-HEIGHT: 19px; BACKGROUND-COLOR: #225ebe; mso-line-height-rule: exactly\" align=\"right\"><strong>Date:{$date}</strong></p>
</th>
</tr>
</table>
</td>
</tr>
<tr>
<td class=\"contenttd\" style=\"BORDER-TOP: #2f0fa3 5px solid; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">
<table style=\"WIDTH: 100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
<tr class=\"hiddentds\">
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 600px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
</tr>
<tr style=\"HEIGHT: 10px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 20px; TEXT-ALIGN: left; PADDING-TOP: 20px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\"><!--[if gte mso 12]>
    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"center\">
<![endif]-->
<table class=\"imgtable\" style=\"MARGIN: 0px auto\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" border=\"0\">
<tr>
<td style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=\"center\">
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr>
<td style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\"><img style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block\" alt=\"\" src=\"https://mailchef.s3.amazonaws.com/uploads/mailstyler/images/03D8C862-10C6-EE98-7CDC-AA9EF0F81D5D_Image_2_4f90588a-b531-4fac-88e5-14eece2ef192.jpg\" width=\"566\" height=\"377\" hspace=\"0\" vspace=\"0\" /></td>
</tr>
</table>
</td>
</tr>
</table>
<!--[if gte mso 12]>
    </td></tr></table>
<![endif]--></th>
</tr>
</table>
</td>
</tr>
<tr>
<td class=\"contenttd\" style=\"BORDER-TOP: #2f0fa3 5px solid; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">
<table style=\"WIDTH: 100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
<tr class=\"hiddentds\">
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 600px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
</tr>
<tr style=\"HEIGHT: 10px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 20px; TEXT-ALIGN: left; PADDING-TOP: 20px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">
<p style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 12px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"center\"><span style='FONT-SIZE: 36px; FONT-FAMILY: \"arial black\", gadget, sans-serif; LINE-HEIGHT: 43px'><strong>KYC Upgrade</strong></span></p>
<p style=\"FONT-SIZE: 14px; MARGIN-BOTTOM: 1em; FONT-FAMILY: arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 17px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"center\"><strong>After checking your documents we have decided to <font color=\'red\'>decline</font> your request <br>Make sure the documents are visible and everything is according to your account info and re-submit your application.</strong></p>
</th>
</tr>
</table>
</td>
</tr>
<tr>
<td class=\"contenttd\" style=\"BORDER-TOP: #225ebe 5px solid; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">
<table style=\"WIDTH: 100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
<tr class=\"hiddentds\">
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 600px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
</tr>
<tr style=\"HEIGHT: 20px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 10px; TEXT-ALIGN: left; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\"><!--[if gte mso 12]>
    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"center\">
<![endif]-->
<table class=\"imgtable btnset\" style=\"TEXT-ALIGN: center; MARGIN: 0px auto\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr>
<td class=\"contenttd\" style=\"VERTICAL-ALIGN: middle; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px\"> </td>
</tr>
</table>
<!--[if gte mso 12]>
    </td></tr></table>
<![endif]-->
<p style=\"FONT-SIZE: 24px; MARGIN-BOTTOM: 1em; FONT-FAMILY: geneve, arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #2d2d2d; LINE-HEIGHT: 36px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p style=\"FONT-SIZE: 14px; MARGIN-BOTTOM: 1em; FONT-FAMILY: arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #575757; LINE-HEIGHT: 21px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\"><span style=\"BACKGROUND-COLOR: #feffff\"><br />
</span><span style=\"FONT-SIZE: 9px; LINE-HEIGHT: 14px\"><span style=\"COLOR: #efefef\"><span style=\"COLOR: #959595\"><br />
&ldquo;Visa<span style=\"font-size:11px\">®</span> Prepaid card is issued by Wave Crest Holdings Limited pursuant to a license from Visa Europe. Visa is a registered trademark of Visa Incorporated. Wave Crest Holdings Limited is a licensed electronic money institution by the Financial Services Commission, Gibraltar. Streamflow Eood &copy; 2017, All Rights Reserved. Streamflow Eood is a company registered in Bulgaria UIC 202977139.&rdquo;</span></span></span><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
</th>
</tr>
<tr style=\"HEIGHT: 20px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 10px; TEXT-ALIGN: left; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\"></th>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td style=\"FONT-SIZE: 0px; HEIGHT: 8px; LINE-HEIGHT: 0\">&nbsp;</td>
</tr>
</table>
<!-- Created with MailStyler 2.0.1.300 -->
</body>
</html>";
            $mail = new Mail();
            $mail->setFrom(SITEEMAIL);
            $mail->addAddress($to);
            $mail->subject($subject);
            $mail->body($body);
            $mail->send();
        }



        echo 'KYCUpgrade event succesfully recorded in our database.';
    }elseif($cunt['eventName']=='CardCreate'){

        // CardCreate Event (null)
        $stmta = $db->prepare('SELECT auth_token FROM api WHERE id=1');
        $stmta->execute();
        $token = $stmta->fetch(PDO::FETCH_ASSOC);


        $proxy = $cunt['account']['proxy'];
        $kyc = $cunt['nonTransactionData']['userKyc'];


        $stmt = $db->prepare('UPDATE orders SET refId= :welp , proxy = :welp2 , usr_id=:usrid, pan = :pan WHERE username=:id_cur');
        $stmt->execute(array(
            ':welp' => $user_extref,
            ':welp2' => $proxy,
            ':usrid' => $user_id,
            ':pan' => "XXXXXXXXXXXX".$cunt['nonTransactionData']['maskedPan'],
            ':id_cur' => $user_em

        ));

        ////
        /// ACTIVATE CARD after order succesfull
        ///

        $data_string = '{
    "reasonCode":"220",
	"comment":"Card activated from API",
	"actMethod":"6"
}';


        $ch = curl_init();

        $ch = curl_init('https://wcapi.wavecrest.in:443/v3/services/users/' . $user_id . '/cards/' . $proxy. '/activate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $headers = array();
        $headers[] = "Developerid: 8k3np8hcj6chmo9sn45d";
        $headers[] = "Developerpassword: Vhkgidduif@123";
        $headers[] = "AuthenticationToken: {$token['auth_token']}";
        $headers[] = "Content-Type:	application/json";
        $headers[] = "ProgramName: MyChoiceUK";
        $headers[] = "X-Method-Override: login";

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

//start decoding response and insert into db

        $json_a = json_decode($result, true);


        if ($json_a['errorDetails'][0]['errorCode'] == 0) {
            $stmt = $db->prepare('UPDATE orders SET status_card= :status WHERE usr_id=:id_cur AND proxy=:proxy');
            $stmt->execute(array(
                ':status' => $json_a['newStatus'],
                ':proxy' => $proxy,
                ':id_cur' => $user_id
            ));
            if (1 == 1) {
////

                $stmta = $db->prepare('SELECT username FROM orders WHERE id=:ida');
                $stmta->execute(array(
                    ':ida' => $_GET['orderidd']
                ));
                $prost = $stmta->fetch(PDO::FETCH_ASSOC);
                //send email
                $date = date("Y-m-d");
                $to = $prost['username'];
                $subject = "Successful Card Order";
                $body = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">
<head>
<title></title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<style type=\"text/css\">
  body, .maintable { height:100% !important; width:100% !important; margin:0; padding:0; }
  img, a img { border:0; outline:none; text-decoration:none; }
  .imagefix { display:block; }
  p {margin-top:0; margin-right:0; margin-left:0; padding:0;}
  .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}
  .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;}
  img{-ms-interpolation-mode: bicubic;}
  body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}
</style>
<style type=\"text/css\">
@media only screen and (max-width: 600px) {
    .rtable {width: 100% !important; table-layout: fixed;}
    .rtable tr {height:auto !important; display: block;}
    .contenttd {max-width: 100% !important; display: block;}
    .contenttd:after {content: \"\"; display: table; clear: both;}
    .hiddentds {display: none;}
    .imgtable, .imgtable table {max-width: 100% !important; height: auto; float: none; margin: 0 auto;}
    .imgtable.btnset td {display: inline-block;}
    .imgtable img {width: 100%; height: auto; display: block;}
    table{float: none; table-layout: fixed;}
}
</style>
<!--[if gte mso 9]>
<xml>
  <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
  </o:OfficeDocumentSettings>
</xml>
<![endif]-->
</head>
<body style=\"overflow: auto; padding:0; margin:0; font-size: 14px; font-family: arial, helvetica, sans-serif; cursor:auto; background-color:#225ebe\">
<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" bgcolor=\"#225ebe\">
<tr>
<td style=\"FONT-SIZE: 0px; HEIGHT: 20px; LINE-HEIGHT: 0\"></td>
</tr>
<tr>
<td valign=\"top\">
<table class=\"rtable\" style=\"WIDTH: 600px; MARGIN: 0px auto\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\" border=\"0\">
<tr>
<td class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: transparent\">
<table style=\"WIDTH: 100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
<tr class=\"hiddentds\">
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 327px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 273px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
</tr>
<tr style=\"HEIGHT: 10px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 20px; TEXT-ALIGN: left; PADDING-TOP: 20px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\"><!--[if gte mso 12]>
    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"center\">
<![endif]-->
<table class=\"imgtable\" style=\"MARGIN: 0px auto\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" border=\"0\">
<tr>
<td style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=\"center\">
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr>
<td style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\"><img style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block\" alt=\"\" src=\"https://mailchef.s3.amazonaws.com/uploads/mailstyler/images/C87FF2AA-531D-1C9A-D167-5AC93230A9BD_Image_1_6a265d40-c636-4162-b9ea-7160744715c3.png\" width=\"293\" height=\"41\" hspace=\"0\" vspace=\"0\" /></td>
</tr>
</table>
</td>
</tr>
</table>
<!--[if gte mso 12]>
    </td></tr></table>
<![endif]--></th>
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: bottom; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 0px; TEXT-ALIGN: left; PADDING-TOP: 0px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">
<p style=\"FONT-SIZE: 16px; MARGIN-BOTTOM: 1em; FONT-FAMILY: arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #2d2d2d; LINE-HEIGHT: 19px; BACKGROUND-COLOR: #225ebe; mso-line-height-rule: exactly\" align=\"right\"><strong>Date:{$date}</strong></p>
</th>
</tr>
</table>
</td>
</tr>
<tr>
<td class=\"contenttd\" style=\"BORDER-TOP: #2f0fa3 5px solid; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">
<table style=\"WIDTH: 100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
<tr class=\"hiddentds\">
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 600px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
</tr>
<tr style=\"HEIGHT: 10px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 20px; TEXT-ALIGN: left; PADDING-TOP: 20px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\"><!--[if gte mso 12]>
    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"center\">
<![endif]-->
<table class=\"imgtable\" style=\"MARGIN: 0px auto\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" border=\"0\">
<tr>
<td style=\"PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px\" align=\"center\">
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr>
<td style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent\"><img style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block\" alt=\"\" src=\"https://mailchef.s3.amazonaws.com/uploads/mailstyler/images/03D8C862-10C6-EE98-7CDC-AA9EF0F81D5D_Image_2_4f90588a-b531-4fac-88e5-14eece2ef192.jpg\" width=\"566\" height=\"377\" hspace=\"0\" vspace=\"0\" /></td>
</tr>
</table>
</td>
</tr>
</table>
<!--[if gte mso 12]>
    </td></tr></table>
<![endif]--></th>
</tr>
</table>
</td>
</tr>
<tr>
<td class=\"contenttd\" style=\"BORDER-TOP: #2f0fa3 5px solid; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">
<table style=\"WIDTH: 100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
<tr class=\"hiddentds\">
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 600px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
</tr>
<tr style=\"HEIGHT: 10px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 20px; TEXT-ALIGN: left; PADDING-TOP: 20px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\">
<p style=\"FONT-SIZE: 10px; MARGIN-BOTTOM: 1em; FONT-FAMILY: arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 12px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"center\"><span style='FONT-SIZE: 36px; FONT-FAMILY: \"arial black\", gadget, sans-serif; LINE-HEIGHT: 43px'><strong>Card Order</strong></span></p>
<p style=\"FONT-SIZE: 14px; MARGIN-BOTTOM: 1em; FONT-FAMILY: arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #7c7c7c; LINE-HEIGHT: 17px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"center\"><strong>Your card order has been successfully completed. <br>The Fillit Prepaid Visa plastic card will be delivered to your declared delivery details in 5 to 10 business days.</strong></p>
</th>
</tr>
</table>
</td>
</tr>
<tr>
<td class=\"contenttd\" style=\"BORDER-TOP: #225ebe 5px solid; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff\">
<table style=\"WIDTH: 100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
<tr class=\"hiddentds\">
<td style=\"FONT-SIZE: 0px; HEIGHT: 0px; WIDTH: 600px; LINE-HEIGHT: 0; mso-line-height-rule: exactly\"></td>
</tr>
<tr style=\"HEIGHT: 20px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 10px; TEXT-ALIGN: left; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\"><!--[if gte mso 12]>
    <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tr><td align=\"center\">
<![endif]-->
<table class=\"imgtable btnset\" style=\"TEXT-ALIGN: center; MARGIN: 0px auto\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr>
<td class=\"contenttd\" style=\"VERTICAL-ALIGN: middle; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px\"> </td>
</tr>
</table>
<!--[if gte mso 12]>
    </td></tr></table>
<![endif]-->
<p style=\"FONT-SIZE: 24px; MARGIN-BOTTOM: 1em; FONT-FAMILY: geneve, arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #2d2d2d; LINE-HEIGHT: 36px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p style=\"FONT-SIZE: 14px; MARGIN-BOTTOM: 1em; FONT-FAMILY: arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #575757; LINE-HEIGHT: 21px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly\" align=\"left\"><span style=\"BACKGROUND-COLOR: #feffff\"><br />
</span><span style=\"FONT-SIZE: 9px; LINE-HEIGHT: 14px\"><span style=\"COLOR: #efefef\"><span style=\"COLOR: #959595\"><br />
&ldquo;Visa<span style=\"font-size:11px\">®</span> Prepaid card is issued by Wave Crest Holdings Limited pursuant to a license from Visa Europe. Visa is a registered trademark of Visa Incorporated. Wave Crest Holdings Limited is a licensed electronic money institution by the Financial Services Commission, Gibraltar. Streamflow Eood &copy; 2017, All Rights Reserved. Streamflow Eood is a company registered in Bulgaria UIC 202977139.&rdquo;</span></span></span><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
</th>
</tr>
<tr style=\"HEIGHT: 20px\">
<th class=\"contenttd\" style=\"BORDER-TOP: medium none; BORDER-RIGHT: medium none; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 10px; TEXT-ALIGN: left; PADDING-TOP: 10px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent\"></th>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td style=\"FONT-SIZE: 0px; HEIGHT: 8px; LINE-HEIGHT: 0\">&nbsp;</td>
</tr>
</table>
<!-- Created with MailStyler 2.0.1.300 -->
</body>
</html>";
                $mail = new Mail();
                $mail->setFrom(SITEEMAIL);
                $mail->addAddress($to);
                $mail->subject($subject);
                $mail->body($body);
                $mail->send();
            }
        }

        echo 'CardCreate event succesfully recorded in our database.';
    }elseif($cunt['eventName']=='RejectUser'){

        // RejectUser -> restriction(1/0) + comments

        if(!empty($cunt['nonTransactionData']['comments'])){
            $comenturi = $cunt['nonTransactionData']['comments'];
        }else{
            $comenturi = 'no comments';
        }

        $stmt = $db->prepare('UPDATE members SET restricted=1, restrictComments=:welp WHERE username=:id_cur');
        $stmt->execute(array(
            ':welp' => $comenturi,
            ':id_cur' => $user_em
        ));
        echo 'User restricted succesfully from our system.';
    }
    elseif($cunt['eventName']=='UserRegistration'){

        if(isset($cunt['transaction']['status']) AND $cunt['transaction']['status']=='FAILED'){
           $idus = $cunt['user']['userId'];
            $stmt = $db->prepare('UPDATE orders SET status_card= "fraud" WHERE usr_id=:id_cur');
            $stmt->execute(array(
                ':id_cur' => $idus

            ));

        }

    }
    else{
        echo 'Event not recognized by our system.';
    }







 }else{
    $stmt = $db->prepare('INSERT INTO logs (type, log, time, user) VALUES (1, :log, :date, :user)');
    $stmt->execute(array(
        ':log' => $fuck,
        ':date' => date("Y-m-d H:i:s"),
        ':user' => $_SERVER['REMOTE_ADDR']
    ));
}
