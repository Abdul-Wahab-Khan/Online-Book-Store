<?php

    include '../../connection.php';

    $id = $_GET['user'];
    $result = $con->query("SELECT * FROM user_emailed_code WHERE register_user_id = $id AND verified = 1");

    if($result->rowCount() > 0) {
        $password = $_POST['password'];
        $password = password_hash($password, PASSWORD_DEFAULT);
        $result = $con->query("UPDATE register_user SET user_password = '$password' WHERE register_user_id = $id");

        if($result) {
            $result = $con->query("DELETE FROM user_emailed_code WHERE register_user_id = $id");
            header('location:../../Forms/user/log in.php');
        } else {
            header('location:../../Forms/user/new password.php?failed=false');
        }
    }