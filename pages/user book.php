<?php 
    session_start();
    include '../connection.php';
    if(empty($_SESSION['user'])) {
        header('location:../Forms/user/log in.php');
    }

    $books = $con->query("SELECT * FROM Book 
                            JOIN Uploaded_Book USING(book_id) 
                            JOIN register_user USING(register_user_id) 
                            WHERE register_user_id = ".$_SESSION['userId']);
    $books = $books->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
    <?php include '../Shared/header.php' ?>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <?php
                    foreach ($books as $book) {
                        ?>
                        <div class="card" style="width: 18rem;">
                            <!-- <img src="..." class="card-img-top" alt="..."> -->
                            <div class="card-header">
                                <h5 class="card-title"><?php echo $book['name'] ?></h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><?php echo $book['description'] ?></p>
                            </div>
                            <div class="card-footer">
                                <h6><?php echo $book['price']."$   ";
                                    if($book['price'] > 0) {
                                        ?>
                                        <button class="btn btn-outline-danger float-right">
                                            Change
                                        </button>
                                        <?php
                                    }?> </h6>
                                <?php 
                                    
                                ?>
                            </div>
                        </div>
                <?php   }
                ?>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>

    
</body>
</html>