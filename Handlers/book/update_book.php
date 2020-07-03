<?php

    include '../../connection.php';

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

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
            $result = $con->query("SELECT file_name FROM Book WHERE book_id = ".$_GET['id']);
            $result =  $result->fetch();
            unlink($result['file_name']);
            $query = "UPDATE Book SET name = :name, description = :description, price = :price,
                        file_name = :fileName WHERE book_id = :id";
    
            $statement = $con->prepare($query);
        
            $res = $statement->execute(
                array (
                    ':name' => $name,
                    ':description' => $description,
                    ':price' => $price,
                    ':fileName' => $uploadfile,
                    ':id' => $_GET['id'],
                )
            );

            if($res)
                header("location:../../pages/show books.php?edit=true");
            else
                header("location:../../pages/show books.php?edit=false");
        } else {
            echo 'file not uploaded';
        }
    } else {
        echo 'set the file please';
        return;
    }

    
