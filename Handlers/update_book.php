<?php

    include '../connection.php';

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $query = "UPDATE Book SET name = :name, description = :description, price = :price WHERE book_id = :id";

    $statement = $con->prepare($query);

    $res = $statement->execute(
        array(
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':id' => $_GET['id']
        )
    );

    if($res)
        echo "Successed";
    else
        echo "Failed";