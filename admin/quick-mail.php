
<?php
include ("config/config.php");
require_once ("PHPMailer/PHPMailerAutoload.php");

 $email = $_POST['emailto'];
 $sub = $_POST['subject'];
 $message  = $_POST['msg'];
if($email)
	{
$admin_name = 'ETS Digital Classified';
$mail = new PHPMailer;
//$mail->SMTPDebug = 3;                               // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP

$mail->CharSet="iso-8859-1";
$mail->Host = 'box938.bluehost.com';                      // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'info@ets-demo.com';                    // SMTP username
$mail->Password = 'ets@12345';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->From = 'info@ets-demo.com';
$mail->FromName = 'Theetsindia';
$mail->addReplyTo('info@ets-demo.com');
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $sub;

/* .....Send Mail To Client......*/
$msg = "<html>
<head>
<title>Theetsindia | Digital Classified</title>
</head>

<body bgcolor='#8d8e90'>
<table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#fff'>
  <tr>
    <td><table width='600' border='0' cellspacing='0' cellpadding='0' bgcolor='#FFFFFF' align='center'>
        <tr>
          <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td width='18' height='133'>&nbsp;</td>
                <td width='244'><a href= 'http://theetsindia.com/' target='_blank'><img src='".BASE_URL."c/classified/dev/admin/bootstrap/ETS-Global-ISO-Logo-2015.png' width='100px' border='0' alt=''/></a></td>
                <td width='338'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
                    <tr>
                      <td height='46' align='right' valign='middle'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
                          <tr>
                            <td width='67%' align='right'>&nbsp;</td>
                            <td width='29%' align='right'>&nbsp;</td>
                            <td width='4%'>&nbsp;</td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td height='30'></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td align='center'>&nbsp;</td>
        </tr>
        <tr>
          <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td width='7%'>&nbsp;</td>
                <td width='93%' align='left' valign='top'>
                 	<b>Message:</b> ".$message."
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align='center'><a href='http://theetsindia.com/' target='_blank'>Theetsindia</a><br></td>
        </tr>
        <tr>
          <td><img src='".BASE_URL."c/classified/dev/admin/bootstrap/PROMO-GREEN2_07.jpg' width='598' height='7' style='display:block' border='0' alt=''/></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        
        <tr>
          <td width='4%' align='center'><a href='https://www.facebook.com/theetsindia' target='_blank'><img src='http://restaurantkitchen.sg/assets/img/icon-fb.png' alt='facebook' width='23' height='23' border='0' /></a> &nbsp;<a href='https://twitter.com/Eclipsetech12' target='_blank'><img src='http://restaurantkitchen.sg/assets/img/icon-tw.png' alt='twitter' width='23' height='23' border='0' /></a>&nbsp; <a href='#' target='_blank'><img src='http://restaurantkitchen.sg/assets/img/icon-yt.png' alt='linkedin' width='22' height='23' border='0' /></a>&nbsp; <a href='#' target='_blank'><img src='http://restaurantkitchen.sg/assets/img/icon-gp.png' alt='g+' width='23' height='23' border='0' /></a></td>
        </tr>
        <tr>
          <td align='center'><font style='font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#231f20; font-size:10px'><strong>Eclipse Technoconsulting Global (P) Ltd.<br>
 Chinar park, Rajarhat, Kolkata West Bengal 700157, India<br>
 +91 33 6555 0013 | +91 33 6050 3200 | +91 90 5133 1646 </strong></font></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
</div>
</div>
</div>
</body>
</html>";

$sendmail_admin = $mail->AddAddress($email,$admin_name); 
$mail->Body = $msg;     
$mail->Send(); 
$mail->ClearAddresses();

$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';	

if($sendmail_admin){
		echo "1";
}else {
		echo "2";
	}
} 
?>