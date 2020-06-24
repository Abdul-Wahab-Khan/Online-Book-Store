<?php

    include '../../connection.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM register_user WHERE user_email = :email";

    $statment = $con->prepare($query);

    $statment->execute(array(":email" => $email));

    if($statment->rowCount() > 0) {
        $result = $statment->fetch();
        if(password_verify($password, $result['user_password'])) {
            if($result['user_email_status'] !== 'verified') {
                header('location:../../Forms/user/unverified.php?email='.$result['user_email']);
            } else {
                if(isset($_POST['remember_me'])) {
                    setcookie('remember_user', $result['user_name'], time()+1*24*60*60, '/');
                    setcookie('email', $result['user_email'], time()+1*24*60*60, '/');
                    setcookie('userId', $result['register_user_id'], time()+1*24*60*60, '/');
                }
                session_start();
                $_SESSION['user'] = $result['user_name'];
                $_SESSION['email'] = $result['user_email'];
                $_SESSION['userId'] = $result['register_user_id'];
                if(isset($_GET['retUrl'])) {
                    header("location:http://localhost".$_GET['retUrl']);
                } else {
                    header('location:../../index.php');
                }
            }
            
        } else {
            echo "failed";
        }
    } else {
        echo "failed";
    }