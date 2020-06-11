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
            <?php 
                // if(isset($_GET['success']))
                // {
                //     if($_GET['success'] == 'true')
                //     {
                //         echo "<div class='alert alert-success' role='alert'>
                //                 Created Successfully
                //             </div>";
                //     }
                //     else {
                //         echo "<div class='alert alert-danger' role='alert'>
                //                 Failed to Create
                //             </div>";
                //     }
                // } 
            ?>
            <h3>Book Registration</h3>
            <form>
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

<script>
    $(document).ready(function() {
        $("#submit").click(function(){
            name = $("#name").val();
            description = $("#description").val();
            price = $("#price").val();

            $.ajax({
                url: "../Handlers/create_ook.php",
                method: "post",
                data: { name: name, description: description, price: price },
            })
            .done(function(data){
                if(data === 'true') {
                    $("#container").prepend(
                        `<div class='alert alert-success' role='alert'>
                                    Created Successfully
                                </div> `
                        );
                } else {
                    $("#container").prepend(
                        `<div class='alert alert-danger' role='alert'>
                                    Failed to Create
                                </div> `
                        );
                }
            })
            .fail(function(data){
                alert("Failed to send data");
            })
        })
    })
</script>

</html>