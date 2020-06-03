<?php include '../connection.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $query = "SELECT * FROM Book WHERE book_id = :id";
        $statement = $con->prepare($query);

        $statement->execute(array(":id" => $_GET['id']));
        $book = $statement->fetch();
    ?>
    <h1><?php echo $book['name'] ?></h1>
    <h2><?php echo $book['description'] ?></h2>
    <h3><?php echo $book['price'] ?></h3>
</body>
</html>