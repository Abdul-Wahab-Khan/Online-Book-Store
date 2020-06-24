<?php

    $retUrlParameter = '';
    if(isset($_GET['retUrl'])) {
        $retUrlParameter .= '?retUrl='.$_GET['retUrl'];
    }

    if(isset($_COOKIE['remember_user'])) {
        session_start();
        $_SESSION['user'] = $_COOKIE['remember_user'];
        $_SESSION['email'] = $_COOKIE['email'];
        $_SESSION['userId'] = $_COOKIE['userId'];
        header('location:../../index.php');
    }
    

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
    <br>  <h3 class="text-center">Log in to your account</h3>
    <hr>

    <div class="row">
    <div class="col-md-4"></div>
    <aside class="col-sm-4">
        <div class="card">
        <article class="card-body">
        <a href="user registration.php" class="float-right btn btn-outline-primary">Sign up</a>
        <h4 class="card-title mb-4 mt-1">Sign in</h4>
            <form action="../../Handlers/user/log_in.php" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" name="email" id="email" placeholder="Email" type="email">
                </div> 
                <div class="form-group">
                    <a class="float-right" href="forgot password.php">Forgot?</a>
                    <label for="password">Password</label>
                    <input name="password" class="form-control" id="password" placeholder="******" type="password">
                </div>
                <div class="form-group"> 
                <div class="checkbox">
                <label> <input type="checkbox" name="remember_me"> Save password </label>
                </div> 
                </div>   
                <div class="form-group">
                    <button id="logIn" type="submit" class="btn btn-outline-secondary btn-block"> Login  </button>
                </div>   
            </form>                                                         
        </article>
        </div> 
    </div>
</div>
    <!-- <script>
        $(function(){
            $("#logIn").click(function(){
                email = $("#email").val();
                password = $("#password").val();

                $.ajax({
                    url: "../Handlers/log_in.php",
                    type: "post",
                    data: {email: email, password: password}
                }).done(function(data) {
                    console.log(email);
                    console.log(password);
                    console.log(data);
                })
            })
        })
    </script> -->
</body>
</html>