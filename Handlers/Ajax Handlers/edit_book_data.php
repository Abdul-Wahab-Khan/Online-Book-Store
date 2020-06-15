<?php

    include '../../connection.php';
    $id = $_GET['id'];
    $query = "SELECT * FROM Book WHERE book_id = :id";
    $statement = $con->prepare($query); 
    $statement->execute(array(":id" => $id));
    $book = $statement->fetch();

    $data = array("name" => $book['name'], "description" => $book['description'], "price" => $book['price']);

    $data = json_encode($data);

    echo $data;