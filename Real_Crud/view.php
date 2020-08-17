<?php
    require_once "pdo.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <?php require_once "bootstrap.php";  ?>
</head>
<body>
    <div class="container">
        <?php
            if( isset($_SESSION['success']) ){
                echo('<p class="alert alert-success">' . htmlentities($_SESSION['success']). '</p>');
                unset($_SESSION['success']);
            }
            if( isset($_SESSION['error']) ){
                echo('<p class="alert alert-danger">' . htmlentities($_SESSION['error']). '</p>');
                unset($_SESSION['error']);
            }

            $stmt = $pdo->query('SELECT name,email,password,user_id FROM users');
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
    </div>

    <div class="container">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">User Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach( $rows as $row ){
                        echo('<tr>');
                        echo('<th scope="row">' . htmlentities($row['user_id']). '</th>');
                        echo('<td>' . htmlentities($row['name']). '</td>');
                        echo('<td>' . htmlentities($row['email']). '</td>');
                        echo('<td>' . htmlentities($row['password']). '</td>');
                        echo('<td> <a href="edit.php?user_id='. $row['user_id']. '">Edit</a>  ');
                        echo('<a href="delete.php?user_id='. $row['user_id'].'">Delete</a></td>');
                        echo('</tr>');
                    }
                ?>
            </tbody>
        
        </table>
        <a href="add.php" class="btn btn-lg btn-outline-success my-2 my-sm-0">Add New</a>
    </div>
    
</body>
</html>