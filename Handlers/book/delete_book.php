<?php 

    include '../../connection.php';

    $result = $con->query("SELECT file_name FROM Book WHERE book_id = ".$_GET['id']);
    $result = $result->fetch();
    unlink($result['file_name']);

    $con->query("DELETE FROM Uploaded_Book WHERE book_id = ".$_GET['id']);
    
    $query = 'DELETE FROM Book WHERE book_id = :id';
    $statement = $con->prepare($query);

    $res = $statement->execute(array(":id" => $_GET['id']));

    if($res)
        header("location:../../pages/show books.php?delete=true");
    else
        header("location:../../pages/show books.php?delete=false");