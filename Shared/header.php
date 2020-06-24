<?php session_start(); ?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="#">Book Store</a>

  <ul class="navbar-nav ml-auto">
    <?php
    if(!isset($_SESSION['user'])) {
        ?>
        <li class="nav-item">
            <a class="nav-link" href="http://localhost/Online-Book-Store/Forms/user/log in.php">Sign in</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="http://localhost/Online-Book-Store/Forms/user/user registration.php">Sign Up</a>
        </li>
    <?php
    }
   else {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="http://localhost/Online-Book-Store/pages/user book.php">Your Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://localhost/Online-Book-Store/Forms/book/create book.php">Have Book?</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Profile
                </a>
                <div class="dropdown-menu">
                    <h5><?php echo $_SESSION['user'] ?></h5>
                    <a class="dropdown-item" href="http://localhost/Online-Book-Store/pages/your profile.php">Your profile</a>
                    <a class="dropdown-item" href="http://localhost/Online-Book-Store/Forms/user/log out.php">Log out</a>
                </div>
            </li>
        <?php
        }

    ?>
  </ul>
</nav> 