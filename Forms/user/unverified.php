<?php

    $email = $_GET['email'];

    echo '<h3>Your email is not verified, Please verify your account first</h3>';
    echo 'If you have not recieved the code please click <a href="../../Handlers/user/send_mail.php?email='.$email.'">here</a>';