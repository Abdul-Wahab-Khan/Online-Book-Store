<?php

    $code = $_POST['code'];
    $id = $_GET['user'];

    include '../../connection.php';

    $result = $con->query("SELECT * FROM user_emailed_code WHERE register_user_id = $id AND code = $code");

    if($result->rowCount() > 0) {
        $result = $con->query('UPDATE user_emailed_code SET verified = 1 WHERE register_user_id = '.$id);
        if($result)
            header('location:../../Forms/user/new password.php?user='.$id);
        else 
            echo "Failed to validate please try again";
    } else {
        echo "Wrong code please try again";
    }