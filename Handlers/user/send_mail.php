<?php

    include '../../Libraries/vendor/autoload.php';
    include '../../connection.php';
    include 'authentication_info.php';

    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
            ->setUsername(EMAIL)
            ->setPassword(PASSWORD);
    $mailer = new Swift_Mailer($transport);

    if(!isset($_GET['password'])) {
        $activationCode = md5(rand());
        $con->query("UPDATE register_user SET user_activation_code = '$activationCode' WHERE user_email = '".$_GET['email']."'");
        $body = 'Please click <a href="http://localhost/Online-Book-Store/Handlers/user/email_confirmation.php?code='.$activationCode.'">here</a> to activate your account';
        $message = (new Swift_Message("PHP Project Email Confirmation Mail"))
                        ->setFrom([EMAIL => 'Khan'])
                        ->setTo([$_GET['email']])
                        ->setBody($body)
                        ->setContentType('text/html');

        try {
            if($mailer->send($message))
                echo "Check your email account for email confirmation";
            else
                echo "Error occured while email confirmation";
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    } else {
        $code = rand(1000, 9999);
    
        $statement = $con->query("SELECT register_user_id as id FROM register_user 
                                        WHERE user_email = '".$_POST['email']."'");
        $result = $statement->fetch();

        $id = $result['id'];

        $statement = $con->query("INSERT INTO user_emailed_code(register_user_id, code, verified)
                                    VALUES($id, $code, 0)");

        if($statement) {
            
            $body = "Please enter the following to renew your password <br> code: $code";
            $message = (new Swift_Message("PHP Project Password renewing"))
                            ->setFrom([EMAIL => 'Khan'])
                            ->setTo([$_POST['email']])
                            ->setBody($body)
                            ->setContentType('text/html');

            try {
                if($mailer->send($message))
                    echo $id;
                else
                    echo "failed"; 
            } catch(Exception $e) {
                echo $e->getMessage();
            }
        }


    }