<?php

    include '../connection.php';

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $query = "INSERT INTO Book(name, description, price) VALUES(:name, :description, :price)";

    $statement = $con->prepare($query);

    $res = $statement->execute(
        array(
            ':name' => '$name',
            ':description' => '$description',
            ':price' => $price
        )
    );

    if($res)
        echo "Successed";
    else
        echo "Failed";