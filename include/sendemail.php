<?php

require_once('phpmailer/class.phpmailer.php');

$mail = new PHPMailer();

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    if( $_POST['template-contactform-name'] != '' AND $_POST['template-contactform-email'] != '' AND $_POST['template-contactform-message'] != '' ) {

        $name = $_POST['template-contactform-name'];
        $email = $_POST['template-contactform-email'];
        $phone = $_POST['template-contactform-phone'];
        $service = $_POST['template-contactform-service'];
        $subject = $_POST['template-contactform-subject'];
        $message = $_POST['template-contactform-message'];


        $subject = isset($subject) ? "Customer contact: $subject" : "Customer contact";

        $botcheck = $_POST['template-contactform-botcheck'];

        $toemail = 'contact@videritis.com'; // Your Email Address
        $toname = 'Videritis'; // Your Name

        if( $botcheck == '' ) {

            $mail->SetFrom( "contact@videritis.com" , "Videritis Website" );
            $mail->AddReplyTo( $email , $name );
            $mail->AddAddress( $toemail , $toname );
            $mail->Subject = $subject;

            $name = isset($name) ? "<strong>Name:</strong> $name<br>" : '';
            $email = isset($email) ? "<strong>Email:</strong> $email<br>" : '';
            $phone = isset($phone) ? "<strong>Phone:</strong> $phone<br>" : '';
            $service = isset($service) ? "<strong>Service:</strong> $service<br><br>" : '';
            $message = isset($message) ? "<strong>Message:</strong> $message<br>" : '';


            $remote_ip = $_SERVER['REMOTE_ADDR'] ? '<br><br>This message was sent from ' . $_SERVER['REMOTE_ADDR'] . ' through ' . $_SERVER['HTTP_REFERER'] : '';

            $body = "$name $email $phone $service $message $remote_ip";

            $mail->MsgHTML( $body );
            $sendEmail = $mail->Send();

            if( $sendEmail == true ):
                echo 'We have <strong>successfully</strong> received your message and will get back to you as soon as possible.';
            else:
                echo 'Email <strong>could not</strong> be sent due to some unexpected error. Please contact us directly through contact@videritis<br /><br /><strong>Reason:</strong><br />' . $mail->ErrorInfo . '';
            endif;
        } else {
            echo 'Bot <strong>Detected</strong>.! Clean yourself Botster.!';
        }
    } else {
        echo 'Please <strong>Fill up</strong> all the fields and try again.';
    }
} else {
    echo 'An <strong>unexpected error</strong> occured. Please try again later.';
}

?>