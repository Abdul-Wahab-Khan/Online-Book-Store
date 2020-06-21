<?php 
    session_start();
    if(empty($_SESSION['user'])) {
        header('location:../user/log in.php?retUrl='.$_SERVER['REQUEST_URI']);
    } 
?>
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
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid" id="container">
            
            <h3>Book Registration</h3>
            <form>
                <input type="hidden" value="<?php echo $_SESSION['email'] ?>">
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
                <div class="form-group">
                    <input type="button" value="Register" id="submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</body>

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
    $(document).ready(function() {
        $("#submit").click(function(){
            name = $("#name").val();
            description = $("#description").val();
            price = $("#price").val();

            $.ajax({
                url: "../../Handlers/book/create_book.php",
                method: "post",
                data: { name: name, description: description, price: price },
            })
            .done(function(data){
                $("#showResultBody").html('<h3>'+data+'</h3>');
                $("#resultModal").modal("show");
            })
            .fail(function(data){
                alert("Failed to send data");
            })
        })
    })
</script>

</html>