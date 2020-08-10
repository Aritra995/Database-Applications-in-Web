<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to AutosDatabase</title>
    <?php require_once "bootstrap.php"; ?>
    <link href="https://fonts.googleapis.com/css2?family=Chilanka&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <div class="container custom">
        <div class="jumbotron">
            <h1 class="text-center">Welcome to AutosDatabase</h1>
            <br>
            <br>
            <p>
                Please Log In
            </p>
            <p>
                <a href="login.php"><input type="submit" class="btn btn-success btn-lg" value="LogIn"></a>
            </p>
            <p>
            Attempt to go to <a href="autos.php">autos.php</a> without logging in- should fail with an error message.
            </p>
        </div>
    </div>
    
</body>
</html>