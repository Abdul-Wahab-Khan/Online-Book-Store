<?php

    include '../../connection.php';

    $email = $_POST['email'];

    $query = "SELECT * FROM register_user WHERE user_email = :email";
    $statment = $con->prepare($query);

    $statment->execute(array(":email" => $email));

    if($statment->rowCount() > 0) 
        echo "exist";
    else 
        echo "Not exist";