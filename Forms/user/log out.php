<?php

    session_start();
    if(isset($_SESSION['user'])) {
        session_destroy();
    }

    header("location:http://localhost/Online-Book-Store/index.php");