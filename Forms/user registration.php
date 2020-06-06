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
            <form action="../Handlers/user_registration.php" method="POST">
                <?php 
                    if(isset($_GET['user']))
                    {
                        if($_GET['user'] == 'true')
                        {
                            echo "<div class='alert alert-success' role='alert'>
                                    Registered Successfully
                                </div>";
                        }
                        else if($_GET['user'] == 'exist') {
                            echo "<div class='alert alert-warning' role='alert'>
                                    Email is already registered
                                </div>";
                        } else {
                            echo "<div class='alert alert-danger' role='alert'>
                                    Registration failed due to an unknown error
                                </div>";
                        }
                    } 
                ?>
                <div class="alert alert-primary">
                    <h2>User Registration</h2>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" name="confirmPassword" id="confirmPassword" class="form-control">
                </div>
                <div>
                    <input type="submit" value="Register" class="btn btn-info" disabled id="register">
                </div>
            </form>
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
        })
    </script>
</body>
</html>