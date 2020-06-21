<?php
    session_start();
    if(empty($_SESSION['user'])) {
        header('location:http://localhost/Online-Book-Store/index.php');
    }

    echo '<h3>'.$_SESSION['user'].'</h3>';
    echo '<h3>'.$_SESSION['email'].'</h3>';
?>