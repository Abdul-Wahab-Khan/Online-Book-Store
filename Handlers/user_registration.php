<?php


include '../connection.php';

    require_once 'vendor/autoload.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM register_user WHERE user_email = :email";
    $statment = $con->prepare($query);

    $statment->execute(array(":email" => $email));

    if($statment->rowCount() > 0) {
        header("location:../Forms/user registration.php?user=exist");
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
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
                    ->setUsername('someone@domain.com')
                    ->setPassword('password');
            $mailer = new Swift_Mailer($transport);

            $body = 'Please click <a href="http://localhost/OBS/Online-Book-Store/Forms/email_confirmation.php?code=$activationCode">here</a> to activate your account';
            $message = (new Swift_Message("PHP Project Email Confirmation Mail"))
                            ->setFrom(['someone@domain.com' => 'name'])
                            ->setTo(['someone@domain.com'])
                            ->setBody($body)
                            ->setContentType('text/html');

            if($mailer->send($message))
                echo "Correct Now verify your email";
            else
                echo "Error occured while registration";
        } else {
            echo "Unknown error occured please try again later";
        }
    }