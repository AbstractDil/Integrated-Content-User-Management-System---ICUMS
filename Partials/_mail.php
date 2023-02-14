<?php



function member($to, $from, $from_name, $subject, $body)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true; 
 
        $mail->SMTPSecure = 'ssl'; 
        $mail->Host = 'mail.hostname.in';
        $mail->Port = '465';  
        $mail->Username = 'no-reply@hostname.in';
        $mail->Password = 'Password';   
   
   //   $path = "reseller.pdf";
   //   $mail->AddAttachment($path);
   
        $mail->IsHTML(true);
        $mail->From='no-reply@hostname.in';
        $mail->FromName=$from_name;
        $mail->Sender=$from;
        $mail->AddReplyTo($from, $from_name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($to);
        if(!$mail->Send())
        {
            $error ='Please try Later, Error Occured while Processing...';
            return $error; 
        }
        else 
        {
            $error = 'Email is sent.';  
            return $error;
        }
    }

    ?>
