<?php 

    include '../connection.php';

    $query = 'DELETE FROM Book WHERE book_id = :id';
    $statement = $con->prepare($query);

    $res = $statement->execute(array(":id" => $_GET['id']));

    if($res)
        echo "Deleted";
    else
        echo "Error Deleting";