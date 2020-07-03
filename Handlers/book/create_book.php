<?php
    session_start();
    include '../../connection.php';

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $con->beginTransaction();

    if(isset($_FILES['book'])) {
        if($_FILES['book']['type'] != 'image/png') {
            echo 'The file extension is png ';
            return;
        }
    
        if($_FILES['book']['size'] > 102400) {
            echo 'File bigger then 100kb not allowed';
            return;
        }

        $fileDirectory = '../../Files/';
        $uploadfile = $fileDirectory . basename($_FILES['book']['name']);
        $res;

        if(move_uploaded_file($_FILES['book']['tmp_name'], $uploadfile)) {
            $query = "INSERT INTO Book(name, description, price, file_name) VALUES(:name, :description, :price, :fileName)";
    
            $statement = $con->prepare($query);
        
            $res = $statement->execute(
                array (
                    ':name' => $name,
                    ':description' => $description,
                    ':price' => $price,
                    ':fileName' => $uploadfile
                )
            );
        } else {
            echo 'file not uploaded';
        }
    } else {
        echo 'set the file please';
        return;
    }


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
