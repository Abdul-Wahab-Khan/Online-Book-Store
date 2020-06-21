<?php


    include '../../connection.php';

    // require_once 'vendor/autoload.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM register_user WHERE user_email = :email";
    $statment = $con->prepare($query);

    $statment->execute(array(":email" => $email));

    if($statment->rowCount() > 0) {
        echo "Email is registered";
    } else {

        $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);

        $activationCode = md5(rand());

        $query = "INSERT INTO register_user(user_name, user_email, user_password, user_activation_code, user_email_status) VALUES(:username, :email, :password, :activationCode, :status)";

        $statement = $con->prepare($query);

        $res = $statement->execute (
            array(
            ':username'   => $username,
            ':email'   => $email,
            ':password'  => $encryptedPassword,
            ':activationCode' => $activationCode,
            ':status' => 'not verified'
            )
        );
        if($res) {
            include '../../Libraries/vendor/autoload.php';
            include 'authentication_info.php';
        
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
                    ->setUsername(EMAIL)
                    ->setPassword(PASSWORD);
            $mailer = new Swift_Mailer($transport);
        
            $body = 'Please click <a href="http://localhost/Online-Book-Store/Handlers/user/email_confirmation.php?code='.$activationCode.'">here</a> to activate your account';
            $message = (new Swift_Message("PHP Project Email Confirmation Mail"))
                            ->setFrom([EMAIL => 'Khan'])
                            ->setTo([$email])
                            ->setBody($body)
                            ->setContentType('text/html');
        
            if($mailer->send($message))
                echo "Check your email account for email confirmation";
            else
                echo "Error occured while email confirmation";
        } else {
            echo "Registration failed please try again later";
        }
    }