<?php 

    include '../../connection.php';

    $query = 'DELETE FROM Book WHERE book_id = :id';
    $statement = $con->prepare($query);

    $res = $statement->execute(array(":id" => $_GET['id']));

    if($res)
        header("location:../Forms/show books.php?delete=true");
    else
        header("location:../Forms/show books.php?delete=false");