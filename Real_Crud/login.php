<?php
    session_start();

    $salt = 'XxYyZz_';
    $stored_hash = hash('md5','XxYyZz_php123');;

    if( isset($_POST['email'])  && isset($_POST['pass']) ){
        if( strlen($_POST['email']) < 1 && strlen($_POST['pass']) < 1 ){
            $_SESSION['error'] = 'Username and Email is required';
            header('Location: login.php');
            return;
        }elseif( strpos($_POST['email'],'@') === false ){
            $_SESSION['error'] = 'Email must be of the format (xxx@xxx.com)';
            header('Location: login.php');
            return;
        }else{
            $check = hash('md5',$salt.$_POST['pass']);
            if( $check == $stored_hash ){
                error_log('Login success'.$_POST['email']);
                $_SESSION['name'] = $_POST['email'];
                $_SESSION['loginsuccess'] = 'Logged in successfully';
                header('Location: index.php');
                return;
            }else{
                error_log('Login fail'.$_POST['email'].'$check');
                $_SESSION['error'] = 'Incorrect password';
                header('Location: login.php');
                return;
            }

        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aritra Kumar DattaChaudhury's App</title>
    <?php require_once "bootstrap.php";  ?>
</head>
<body>
    <nav class="navbar navbar-primary bg-primary">
        <h1>Welcome to Autos Database</h1>

    </nav>
    <div class="container">
        <h3>Please Log In</h3>
    </div>

    <div class="container">
        <?php 
            if( isset($_SESSION['error']) ){
                echo('<p class="alert alert-danger">' . htmlentities($_SESSION['error']). '</p>');
                unset($_SESSION['error']);
            }
        ?>
    </div>

    <div class="container">
        <form action="" method="post">
            <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">User Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="User Name" name="email">
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" placeholder="password" name="pass">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10">
                    <input type="submit" class="btn btn-lg btn-outline-success my-2 my-sm-0" value="Log In">
                    <a href="index.php" class="btn btn-lg btn-outline-secondary my-2 my-sm-0">Cancel</a>
                </div>
            </div>
        </form>

            <div class="alert alert-primary alert-dismissible fade show" role="alert">
            For a password hint, view source and find a password hint in the HTML comments.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    </div>
    
</body>
</html>