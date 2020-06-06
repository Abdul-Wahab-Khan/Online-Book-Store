<?php


include '../connection.php';

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
            header("location:../Forms/user registration.php?user=true");
        } else {
            header("location:../Forms/user registration.php?user=unknown");
        }
    }