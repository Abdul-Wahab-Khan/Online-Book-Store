<?php

    include '../../connection.php';

    // require_once 'vendor/autoload.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT user_password, user_name, user_email_status, user_email FROM register_user WHERE user_email = :email";

    $statment = $con->prepare($query);

    $statment->execute(array(":email" => $email));

    if($statment->rowCount() > 0) {
        $result = $statment->fetch();
        if(password_verify($password, $result['user_password'])) {
            if($result['user_email_status'] !== 'verified') {
                header('location:../../Forms/user/unverified.php?email='.$result['user_email']);
            } else {
                session_start();
                $_SESSION['user'] = $result['user_name'];
                header("location:../../pages/show books.php");
            }
            
        } else {
            echo "failed";
        }
    } else {
        echo "failed";
    }