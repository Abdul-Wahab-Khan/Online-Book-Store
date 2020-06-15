<?php

    include '../connection.php';

    $data = $_POST['data'];

    $query = "UPDATE Book SET name = :name, description = :description, price = :price WHERE book_id = :id";

    $statement = $con->prepare($query);

    $res = $statement->execute(
        array(
            ':name' => $data['name'],
            ':description' => $data['description'],
            ':price' => $data['price'],
            ':id' => $_POST['id']
        )
    );

    if($res)
        echo "updated";
    else
        echo "Not Updated";
