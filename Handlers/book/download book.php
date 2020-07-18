<?php

    if(isset($_GET['id'])) {
        include '../../connection.php';

        $id = $_GET['id'];
        
        $book = $con->query("SELECT file_name FROM Book WHERE book_id = $id");
        $book = $book->fetch();

        $file = ($book['file_name']);

        $filetype=filetype($file);

        $filename=basename($file);

        header ("Content-Type: ".$filetype);

        header ("Content-Length: ".filesize($file));

        header ("Content-Disposition: attachment; filename=".$filename);

        readfile($file);
    }