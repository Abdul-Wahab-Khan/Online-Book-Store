<?php

    include '../../connection.php';

    $id = $_GET['user'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <br>  <h3 class="text-center">Get your code From email</h3>
    <hr>

    <div class="row">
    <div class="col-md-4"></div>
    <aside class="col-sm-4">
        <div class="card">
        <article class="card-body">
        <h4 class="card-title mb-4 mt-1">Enter code here</h4>
        <form action="../../Handlers/user/code_validation.php?user=<?php echo $_GET['user'] ?>" method="post">
            <div class="form-group">
                <label for="code">Code:</label>
                <input class="form-control" name="code" id="code" placeholder="Code" type="number">
            </div> 
            <button id="check" name="check" class="btn btn-outline-secondary btn-block"> Check  </button>
        </form>
        </article>
        </div> 
    </div>
</div>
</body>
</html>