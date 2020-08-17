<?php
    session_start();
    require_once "pdo.php";
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
  <!-- Navbar content -->
  <h1>Welcome to Autos Database</h1>

</nav>
    <div class="container">
        

        <?php
            if( !isset($_SESSION['name']) ){ ?>
                <p>
                    <a href="login.php" class="btn btn-lg btn-outline-success my-2 my-sm-0">Please log in</a>
                </p>
                <p>Attempt to <a href="add.php">add data</a> without logging in</p>
         <?php   } else{ ?>
         <!-- logged in -->

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
                if( isset($_SESSION['loginsuccess']) ){
                    echo(
                        '<div class="alert alert-success alert-dismissible fade show" role="alert">'
                        .$_SESSION['loginsuccess'].
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
                    );
                    unset($_SESSION['loginsuccess']);
                }

                $stmt = $pdo->query('SELECT * FROM auto');
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
        </div>

        <div class="container">
            <?php 
            if( sizeof($rows) > 0 ){ ?>
                <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Make</th>
                        <th scope="col">Model</th>
                        <th scope="col">Year</th>
                        <th scope="col">Mileage</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach( $rows as $row ){
                            echo('<tr>');
                            echo('<th scope="row">' . htmlentities($row['make']). '</th>');
                            echo('<td>' . htmlentities($row['model']). '</td>');
                            echo('<td>' . htmlentities($row['year']). '</td>');
                            echo('<td>' . htmlentities($row['mileage']). '</td>');
                            echo('<td> <a href="edit.php?autos_id='. $row['autos_id']. '" class="btn btn-warning" >Edit</a>  ');
                            echo('<a href="delete.php?autos_id='. $row['autos_id'].'" class="btn btn-danger" >Delete</a></td>');
                            echo('</tr>');
                        }
                    ?>
                </tbody>
            </table>
            <?php }else{ ?>
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Oops!</h4>
                    <p>No rows found</p>
                    <hr>
                    <p class="mb-0">Try adding data and then returning to this page.</p>
                </div>
            <?php } ?>
            <a href="add.php" class="btn btn-lg btn-outline-primary my-2 my-sm-0">Add New Entry</a>
            <a href="logout.php" class="btn btn-lg btn-outline-danger my-2 my-sm-0">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-power" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5.578 4.437a5 5 0 1 0 4.922.044l.5-.866a6 6 0 1 1-5.908-.053l.486.875z"/>
                    <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z"/>
                </svg>
            </a>
        </div>
        <?php } ?>
    </div>
    
</body>
</html>