<?php
    session_start();
    require_once "pdo.php";

    if( !isset($_SESSION['name']) ){
        die('ACCESS DENIED');
    }

    if( isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['mileage']) ){
        if( strlen($_POST['make']) < 1 || strlen($_POST['model']) < 1 ){ //resume from here
            $_SESSION['error'] = 'All the fields are required';
            header('Location: edit.php?autos_id='.$_POST['autos_id']);
            return;
        }elseif( !is_numeric($_POST['year']) || !is_numeric($_POST['mileage']) ){
            $_SESSION['error'] = 'Year and Mileage must be numeric';
            header('Location: edit.php?autos_id='.$_POST['autos_id']);
            return;
        }else{
            $sql = 'UPDATE auto SET make = :make,model = :model,year = :year,mileage = :mileage WHERE autos_id = :autos_id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':make' => $_POST['make'],
                ':model' => $_POST['model'],
                ':year' => $_POST['year'],
                ':mileage' => $_POST['mileage'],
                ':autos_id' => $_POST['autos_id']
            ));
            header('Location: index.php');
            return;
        }
    }

    if( !isset($_GET['autos_id']) ){
        $_SESSION['error'] = 'Automobile data missing';
        header('Location: index.php');
        return;
    }

    $sql = "SELECT * FROM auto WHERE autos_id = :xyz";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':xyz' => $_GET['autos_id']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if( $row === false ){
        $_SESSION['error'] = 'Bad value of Autos Id';
        header('Location: index.php');
        return;
    }
    //|| strlen($_POST['model']) < 1 || strlen($_POST['year']) < 1 || strlen($_POST['mileage']) < 1
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
        <h3>Editing Automobile</h3>
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
                <label for="make" class="col-sm-2 col-form-label">Make</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="make" name="make" value="<?php echo( htmlentities( $row['make'] )) ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="model" class="col-sm-2 col-form-label">Model</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="model" name="model" value="<?php echo( htmlentities( $row['model'] )) ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="year" class="col-sm-2 col-form-label">Year</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" size="10" placeholder="year" name="year" value="<?php echo( htmlentities( $row['year'] )) ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="mileage" class="col-sm-2 col-form-label">Mileage</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" size="10" placeholder="mileage" name="mileage" value="<?php echo( htmlentities( $row['mileage'] )) ?>">
                </div>
            </div>
            
            <input type="hidden" name="autos_id" value=" <?php  echo( $row['autos_id'] ) ?> ">

            <div class="form-group row">
                <div class="col-sm-10">
                    <input type="submit" class="btn btn-lg btn-outline-success my-2 my-sm-0" value="Save">
                    <a href="index.php" class="btn btn-lg btn-outline-warning my-2 my-sm-0">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    
</body>
</html>