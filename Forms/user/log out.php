<?php

    session_start();
    if(isset($_SESSION['user'])) {
        session_destroy();
    }

    if(isset($_COOKIE['remember_user'])) {
        unset($_COOKIE['remember_user']);
        unset($_COOKIE['email']);
        unset($_COOKIE['userId']);
        setcookie('remember_user', null, -1, '/');
        setcookie('email', null, -1, '/');
        setcookie('userId', null, -1, '/');
    }

    header("location:http://localhost/Online-Book-Store/index.php");