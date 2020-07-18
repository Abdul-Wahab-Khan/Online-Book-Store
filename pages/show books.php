<?php 
    include '../connection.php';
    session_start();
    if(empty($_SESSION['user'])) {
        header('location:../Forms/user/log in.php');
    }
    $books = $con->query("SELECT * FROM Book");
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
            
            <main role="main">

                <section class="jumbotron text-center">
                    <div class="container">
                    <h1>Book Store</h1>
                    <p class="lead text-muted">
                        Online book store for every kind of book for free and paid types.
                    </p>
                    <p>
                        <a href="../Forms/book/create book.php" class="btn btn-outline-success my-2">Add Book</a>
                    </p>
                    </div>
                </section>

                <div class="album py-5 bg-light">
                    <div class="container">

                    <div class="row">
                        <?php
                            foreach($books as $book) {
                        ?>
                        <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c"/>
                                <image href="<?php echo $book['file_name'] ?>" width="100%" />
                                    {{-- <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text> --}}
                            </svg>
                            <div class="card-body">
                                <p class="card-text"><?php echo $book['name'] ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                <a type="button" href="../Handlers/book/read_book.php?id=<?php echo $book['book_id'] ?>" class="btn btn-sm btn-outline-secondary">View</a>
                                <a type="button" href="../Forms/book/edit book.php?id=<?php echo $book['book_id'] ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <a type="button" href="../Handlers/book/download book.php?id=<?php echo $book['book_id'] ?>" class="btn btn-sm btn-outline-secondary">Download</a>
                                <a type="button" href="../Handlers/book/read book.php?id=<?php echo $book['book_id'] ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                            </div>
                        </div>
                        </div>
                            <?php } ?>
                    </div>
                    </div>
                </div>

            </main>

            <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../Handlers/update_book.php?id=<?php echo $id ?>">
                        <input type="hidden" name="" id="id">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" class="form-control" id="price" name="price">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="save">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function(){
            $("#book_table").DataTable();
        })
        $(function(){
            $(".edit").click(function() {
                id = $(this).attr("id");

                $.ajax({
                    url: '../Handlers/Ajax Handlers/edit_book_data.php',
                    method: 'get',
                    dataType: 'json',
                    data: {id:id},
                }).done(function(data){
                    $("#name").val(data.name);
                    $("#description").val(data.description);
                    $("#price").val(data.price);
                    $("#id").val(id);

                    $("#editModal").modal("show");
                }).fail(function(data){
                    alert('failed to get data');
                })
                $("#editModal").modal("show");
            })

            $("#save").click(function() {
                name = $("#name").val();
                description = $("#description").val();
                price = $("#price").val();
                id = $("#id").val();

                data = { name: name, description: description, price: price };
                $.ajax({
                    url: '../Handlers/book/update_book.php',
                    method: 'post',
                    data: {data: data, id: id}
                }).done(function(data){
                    $("#showResultBody").html("<h3>"+data+"</h3>");
                    $("#editModal").modal("hide");
                    $("#resultModal").modal("show");
                }).fail(function(data){
                    alert("Failed to update");
                })
            })

            $(".delete").click(function(){
                id = $(this).attr("id");

                $.ajax({
                    url: "../Handlers/book/delete_book.php",
                    data: {id: id},
                    method: 'get'
                }).done(function(data){
                    $("#showResultBody").html("<h3>"+data+"</h3>");
                    $("#resultModal").modal("show");
                })
            })

            $(".show").click(function(){
                id = $(this).attr("id");

                $.ajax({
                    url: "../Handlers/book/read_book.php",
                    method: 'get',
                    data: {id:id},
                }).done(function(data) {
                    $("#showResultBody").html(data);
                    $("#resultModal").modal("show");
                }).fail(function(data) {
                    $("#showResultBody").html("<h3>Error occured</h3>");
                    console.log(data);
                    $("#resultModal").modal("show");
                })
            })
        })
    </script>
</body>
</html>