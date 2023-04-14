<?php

function sendmail($to, $subject, $body ) {

//    $body = addslashes($body);

    $prog = '/usr/bin/sudo /usr/local/bin/sendEmail';
    $from = '-f "'.SMTP_FROM_NAME.' <'.SMTP_FROM.'>"';
    $subject = '=?ISO-8859-1?Q?'.imap_8bit($subject).'?=';
    $subject = '-u "'.($subject).'"';

    if (is_array($to)) {

        foreach ($to as $t) {

            $to .= "-t $t ";

        }

    } else {

        $to = "-t $to";

    }

    $server = '-s '.SMTP_SERVER;

    if (SMTP_AUTH) {
        $user = '-xu '.SMTP_USER;
        $pass = '-xp '.SMTP_PASS;
    }

    $tmpfilename = tempnam('/tmp', 'jalil_');
      
    file_put_contents($tmpfilename, "<html><body>$body</body></html>");

    $body = "-o message-file=$tmpfilename";
    $header = '-o message-header="Content-Type: multipart/related; boundary=\"----MIME delimiter for sendEmail-\""';

    $envio = shell_exec("$prog $from $subject $to $server $user $pass $header $body 2>&1");

    unlink($tmpfilename);

    return strstr($envio, 'successfully');
    
}

/*
function sendmail($to, $subject, $body ) {

//    $body = addslashes($body);

    $mailer = new PHPMailer();

    $mailer->From = SMTP_FROM;
    $mailer->FromName = SMTP_FROM_NAME;
    $mailer->Sender = SMTP_FROM;

    if (is_array($to)) {
        
        foreach ($to as $t) {
            
            $mailer->AddAddress($t);
            
        }
        
    } else {
        
        $mailer->AddAddress($to);

    }

    $mailer->Subject = $subject;

    //$mailer->IsSendmail();
    
    $mailer->IsSMTP();
    $mailer->Host = SMTP_SERVER;
    $mailer->SMTPAuth = SMTP_AUTH;
    $mailer->Username = SMTP_USER;
    $mailer->Password = SMTP_PASS;
    $mailer->SMTPDebug = false;
    
  
    $mailer->IsHTML(true);

    $mailer->Body = $body;

    return $mailer->Send();

}
*/
?>
