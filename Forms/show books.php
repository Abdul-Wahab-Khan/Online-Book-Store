<?php include '../connection.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
    <div class="wrapper">
        <div class="container">
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
                            $id = $book['book_id'];
                            $html.= '<tr>
                                        <td>'.$book['name'].'</td>
                                        <td>'.$book['description'].'</td>
                                        <td>'.$book['price'].'</td>
                                        <td>';
                                            $html.= '<button class="show" id="'.$id.'"><span class="fa fa-eye"> </span></button>';
                                            $html.= ' <button class="edit" id="'.$id.'"><span class="fa fa-edit"> </span> </button>';
                                            $html.= ' <button class="delete" id="'.$id.'"><span class="fa fa-trash"> </span> </button> 
                                        </td>
                                    </tr>';
                        }
                        echo $html;
                    ?>
                </tbody>
            </table>
        </div>
    </div>

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


    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Result</h5>
                </div>
                <div class="modal-body" id="showResultBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="resultClose">Close</button>
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
                    url: '../Handlers/update_book.php',
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
                    url: "../Handlers/delete_book.php",
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
                    url: "../Handlers/read_book.php",
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