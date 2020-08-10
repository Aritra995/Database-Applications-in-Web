<?php
    require_once "pdo.php";
    if( isset($_POST['cancel'])){
        header("Location: index.php");
        return;
    }
    $salt = 'XyZzy12*_';
    $stored_hash = hash('md5','XyZzy12*_php123');
    $failure= false;
    // $success = false;

    if( isset($_POST['name']) && isset($_POST['password'])){
        if(strlen($_POST['name'])<1 || strlen($_POST['password'])<1){
            // echo('<p class="text-danger">Username and password is required!</p>');
            $failure = "Username and password is required!";
        }elseif(strpos($_POST['name'], "@") === false){
            $failure = "username must contain @";
        }else{
            $check = hash('md5',$salt.$_POST['password']);
            if($check == $stored_hash){
                // $success = "Login success";
                error_log("Login success".$_POST['name']);
                header("Location: autos.php?name=".$_POST['name']);
                return;
            }else{
                $failure = "Incorrect password";
                error_log("Login fail ".$_POST['name']." $check");
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to the Aritra's database</title>
    <?php  require_once "bootstrap.php"; ?>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <div class="container custom">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="jumbotron">
        <?php
            echo('<p class="text-danger">'.htmlentities($failure).'</p>');
            // echo('<p class="text-success">'.htmlentities($success).'</p>');
           
        ?>
            
                <form action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">User Name *</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="username" name="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password *</label>
                        <input class="form-control" id="exampleInputEmail1" placeholder="Password" name="password">
                    </div>
                    <input type="submit" class="btn btn-success btn-lg" value="LogIn" name="login">
                    <input type="submit" class="btn btn-warning btn-lg" value="cancel" name="cancel">
                </form>
        </div>
    </div>
    <div class="col-md-3"></div>
    </div>
    
</body>
</html>