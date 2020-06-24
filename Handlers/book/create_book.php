<?php
    session_start();
    include '../../connection.php';

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $con->beginTransaction();

    $query = "INSERT INTO Book(name, description, price) VALUES(:name, :description, :price)";

    $statement = $con->prepare($query);

    $res = $statement->execute(
        array(
            ':name' => $name,
            ':description' => $description,
            ':price' => $price
        )
    );

    $bookId = $con->lastInsertId();
    $userId = $_SESSION['userId'];
    $now = date('Y-m-d');

    $query = "INSERT INTO Uploaded_Book(book_id, register_user_id, upload_date) 
                VALUES(:bookId, :userId, :date);";

    $statement = $con->prepare($query);

    $res2 = $statement->execute(array(":bookId" => $bookId, ":userId" => $userId, ":date" => $now));

    if($res && $res2)
    {
        $con->commit();
        echo "Created successfully";
    }
    else
    {
        $con->rollBack();
        echo "Failed to create";
    }
