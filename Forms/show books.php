<?php include '../connection.php' ?>
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
    <div class="wrapper">
        <div class="container">
            <?php 
                if(isset($_GET['delete']))
                {
                    if($_GET['delete'] == 'true')
                    {
                        echo "<div class='alert alert-success' role='alert'>
                                Deleted Successfully
                            </div>";
                    }
                    else {
                        echo "<div class='alert alert-danger' role='alert'>
                                Failed to Delete
                            </div>";
                    }
                }
                if(isset($_GET['edit']))
                {
                    if($_GET['edit'] == 'true')
                    {
                        echo "<div class='alert alert-success' role='alert'>
                                Edited Successfully
                            </div>";
                    }
                    else {
                        echo "<div class='alert alert-danger' role='alert'>
                                Failed to Edit
                            </div>";
                    }
                } 
            ?>
            <h3>All Books</h3>
            <table class="table table-hover" id="book_table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = "SELECT * FROM Book";
                        $statement = $con->prepare($query);
                        $books = $con->query($query);
                        $html = '';

                        while($book = $books->fetch())
                        {
                            $html.= '<tr>
                                        <td>'.$book['name'].'</td>
                                        <td>'.$book['description'].'</td>
                                        <td>'.$book['price'].'</td>
                                        <td>';
                                            $html.= '<a href="../Handlers/read_book.php?id='.$book['book_id'].'"><span class="fa fa-eye"> </span> </a>';
                                            $html.= ' <a href="edit book.php?id='.$book['book_id'].'"><span class="fa fa-edit"> </span> </a>';
                                            $html.= ' <a href="../Handlers/delete_book.php?id='.$book['book_id'].'"><span class="fa fa-trash"> </span> </a> 
                                        </td>
                                    </tr>';
                        }
                        echo $html;
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#book_table").DataTable();
        })
    </script>
</body>
</html>