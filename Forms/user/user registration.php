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
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
        <br>  <div>
                    <h3 class="text-center">Create Your Account</h3>

            <hr>

            <div class="row">
            <div class="col-md-4"></div>
            <aside class="col-sm-4">
                <div class="card">
                <article class="card-body">
                <a href="log in.php" class="float-right btn btn-outline-primary">Log In</a>
                <h4 class="card-title mb-4 mt-1">Sign up</h4>
                <form action="../../Handlers/user/user_registration.php" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" placeholder="Username" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>

                    <input type="password" name="confirmPassword" id="confirmPassword" class="form-control">
                </div>
                <button class="btn btn-outline-primary" type="submit" id="register">Register</button>
                </form>
            </article>
        </div> 
        </div>
    </div>


    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Registration</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h3 id="resultMessage"></h3>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>

    <script>
        $(function(){
            $("#confirmPassword").keyup(function(){
                password = $("#password").val();
                confirmPassword = $("#confirmPassword").val();

                if(password != confirmPassword || password.length < 8) 
                    $("#register").attr("disabled","disabled"); 
                else
                    $("#register").removeAttr("disabled");
            });

            $("#email").keyup(function(){
                email = $(this).val();

                $.ajax({
                    url: "../../Handlers/Ajax Handlers/check_email.php",
                    method: "Post",
                    data: {email: email},
                }).done(function(data){
                    if(data === 'exist') {
                        $("#emailAlert").removeAttr("hidden");
                    } else {
                        $("#emailAlert").attr("hidden","hidden");
                    }
                }).fail(function(){
                    alert("Email verification failed please try again later");
                })
            })
            
            // $("#register").click(function(){
            //     username = $("#username").val();
            //     email = $("#email").val();
            //     password = $("#password").val();

            //     $.ajax({
            //         url: "../Handlers/user/user_registration.php",
            //         type: "post",
            //         data: {username: username, email: email, password: password}
            //     }).done(function(data){
            //         $("#resultMessage").text(data);
            //         $("#resultModal").modal("show");
            //     })
            // })
        })
    </script>
</body>
</html>